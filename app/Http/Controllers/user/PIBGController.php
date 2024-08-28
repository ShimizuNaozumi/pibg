<?php

namespace App\Http\Controllers\user;

use Exception;
use GuzzleHttp\Client;
use App\Models\FeePayment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class PIBGController extends Controller
{

    public function feepayment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',    
            'email' => 'required|email',
            'notel' => 'required|string',
            'amount' => 'required|numeric|min:2',
            'tabung' => 'required|string|max:255',
            'fund_id' => 'required|integer',
        ]);

        try {
            $client = new Client([
                'verify' => storage_path('certificates/cacert.pem'),
            ]);

            $randomNumber = mt_rand(1000000000, 9999999999);

            $response = $client->post('https://dev.toyyibpay.com/index.php/api/createBill', [
                'form_params' => [
                    'userSecretKey' => env('TOYYIBPAY_API_KEY'),
                    'categoryCode' => env('TOYYIBPAY_CATEGORY_CODE'),
                    'billName' => 'Bayaran Yuran SKTTDI2',
                    'billDescription' => 'Bayaran Atas Pelajar ' . $request->tabung,
                    'billPriceSetting' => 1,
                    'billPayorInfo' => 1,
                    'billAmount' => $request->amount * 100,
                    'billReturnUrl' => route('return'),
                    'billCallbackUrl' => route('callBack'),
                    'billExternalReferenceNo' => 'PIBGSKTTDI2-' . $randomNumber,
                    'billTo' => $request->name,
                    'billEmail' => $request->email,
                    'billPhone' => $request->notel,
                    'billSplitPayment' => 0,
                    'billSplitPaymentArgs' => '',
                    'billPaymentChannel' => '2',
                    'billChargeToCustomer' => 1,
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            Log::info('ToyyibPay response: ', $data);

            $billData = $data[0];

            if (isset($billData['BillCode'])) {

                try {
                    $transaction = Transaction::create([
                        'transaction_code' => $billData['BillCode'],
                        'transaction_amount' => $request->amount,
                        'transaction_status' => '2',
                    ]);

                    if ($transaction) {
            
                        FeePayment::create([
                            'fee_payment_name' => $request->name,
                            'fee_payment_email' => $request->email,
                            'fee_payment_notel' => $request->notel,
                            'student_id' => $request->fund_id,
                            'transaction_id' => $transaction->transaction_id, 
                        ]);
            
                    } else {
                        Log::error('Failed to create transaction.');
                        return back()->withErrors(['msg' => 'Failed to create transaction.']);
                    }
                    return redirect('https://dev.toyyibpay.com/' . $data[0]['BillCode']);
                } catch (Exception $e) {
                    Log::error('Exception occurred: ' . $e->getMessage());
                    return back()->withErrors(['msg' => 'Error processing payment. Please try again later.']);
                }
            } else {
                Log::error('Error initiating payment: ', $data);
                return back()->withErrors(['msg' => 'Error initiating payment.']);
            }
        } catch (Exception $e) {
            Log::error('Exception occurred: ' . $e->getMessage());
            return back()->withErrors(['msg' => 'Error initiating payment. Please try again later']);
        }
    }

    public function return(Request $request)
{
    $billCode = $request->query('billcode');
    $statusId = $request->query('status_id');

    $client = new Client([
        'verify' => storage_path('certificates/cacert.pem'),
    ]);

    $response = $client->post('https://dev.toyyibpay.com/index.php/api/getBillTransactions', [
        'form_params' => [
            'userSecretKey' => env('TOYYIBPAY_API_KEY'),
            'billCode' => $billCode,
        ],
    ]);

    $data = json_decode($response->getBody(), true);

    $transactionData = [
        'transaction_invoiceno' => $data[0]['billpaymentInvoiceNo'],
        'transaction_status' => $statusId,
        'transaction_method' => $data[0]['billpaymentChannel'],
        'transaction_refno' => $data[0]['billExternalReferenceNo'],
        'transaction_issued_date' => date('Y-m-d H:i:s', strtotime($data[0]['billPaymentDate'])),
    ];

    $transaction = Transaction::where('transaction_code', $billCode)->first();
    $transaction->update($transactionData);

    if ($statusId == 1) {
        return redirect()->route('receipt', ['billCode' => $billCode])
            ->with(['message' => 'Terima kasih kerana telah membuat bayaran yuran.', 'title' => 'Berjaya', 'status' => 'success']);
    } elseif ($statusId == 3) {
        return to_route('index')->with(['message' => 'Proses pembayaran anda gagal.', 'title' => 'Gagal', 'status' => 'error']);
    } else {
        return to_route('index')->with(['message' => 'Pembayaran anda masih dalam proses.', 'title' => 'Info', 'status' => 'info']);
    }
}


public function receipt(Request $request)
{
    $billCode = $request->query('billCode');

    $transaction = Transaction::where('transaction_code', $billCode)->first();

    $summary = DB::table('fee_payments')
        ->join('transactions', 'fee_payments.transaction_id', '=', 'transactions.transaction_id')
        ->join('funds', 'fee_payments.student_id', '=', 'funds.fund_id')
        ->select('fee_payments.*', 'transactions.*', 'funds.*')
        ->where('transactions.transaction_code', $billCode)
        ->first();

    if (!$transaction) {
        return redirect()->route('index')->with(['message' => 'Transaksi tidak dijumpai.', 'title' => 'Gagal', 'status' => 'error']);
    } else {
        $data = [
            'fee_payment_invoiceno' => $summary->transaction_invoiceno,
            'fee_payment_date' => date('d/m/Y h:i:s A', strtotime($summary->transaction_issued_date)),
            'fee_payment_amount' => $summary->transaction_amount,
            'payer_name' => $summary->fee_payment_name,
            'payer_email' => $summary->fee_payment_email,
            'payer_notel' => $summary->fee_payment_notel,
            'student_name' => $summary->fund_name,
        ];        

        $html = view('user.receiptpibg', $data)->render();
        $pdf = Pdf::loadHTML($html);
        return view('user.receipt' , ['transaction' => $transaction]);
    }
}

public function showReceipt(Request $request)
{
    $billCode = $request->query('billCode');

    $transaction = Transaction::where('transaction_code', $billCode)->first();

    $summary = DB::table('fee_payments')
        ->join('transactions', 'fee_payments.transaction_id', '=', 'transactions.transaction_id')
        ->join('funds', 'fee_payments.student_id', '=', 'funds.fund_id')
        ->select('fee_payments.*', 'transactions.*', 'funds.*')
        ->where('transactions.transaction_code', $billCode)
        ->first();

    if (!$transaction) {
        return redirect()->route('index')->with(['message' => 'Transaksi tidak dijumpai.', 'title' => 'Gagal', 'status' => 'error']);
    } else {
        $data = [
            'fee_payment_invoiceno' => $summary->transaction_invoiceno,
            'fee_payment_date' => date('d/m/Y h:i:s A', strtotime($summary->transaction_issued_date)),
            'fee_payment_amount' => $summary->transaction_amount,
            'payer_name' => $summary->fee_payment_name,
            'payer_email' => $summary->fee_payment_email,
            'payer_notel' => $summary->fee_payment_notel,
            'student_name' => $summary->fund_name,
        ];

        $html = view('user.receiptpibg', $data)->render();
        $pdf = Pdf::loadHTML($html);

        // Define the absolute path to save the PDF in pibg\public\receipts
        $filePath = public_path('receipts/' . $summary->transaction_invoiceno . '.pdf');

        // Ensure the receipts directory exists or create it
        if (!file_exists(public_path('receipts'))) {
            mkdir(public_path('receipts'), 0777, true);
        }

        // Save the PDF
        $pdf->save($filePath);

        // Stream the PDF to the browser
        return $pdf->stream($summary->transaction_invoiceno . '.pdf');
    }
}


public function show($invoice)
{
    // Construct the file path
    $filePath = public_path("receipts/{$invoice}.pdf");

    // Check if file exists
    if (file_exists($filePath)) {
        return Response::file($filePath);
    } else {
        abort(404, 'Resit tidak dijumpai');
    }
}


}
