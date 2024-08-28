<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class ReceiptController extends Controller
{
    public function donation_receipt(string $id)
    {
        $id = decrypt_string($id);
        
        $summary = DB::table('donations')
                ->join('transactions', 'donations.transaction_id', '=', 'transactions.transaction_id')
                ->join('funds', 'donations.fund_id', '=', 'funds.fund_id')
                ->select('donations.*','transactions.*','funds.*')
                ->where('donations.donation_id', $id)
                ->first();

        if($summary->transaction_status != 1){
            return back()->with([
                'icon' => '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" />',
                'alert' => 'warning',
                'title' => 'Resit tidak wujud',
                'message' => 'Pembayaran belum disahkan / gagal.',   
            ]);
        }else{  
            $data = [
                'donation_invoiceno' => $summary->transaction_invoiceno,
                'donation_name' => $summary->fund_name,
                'donation_date' => date('d/m/Y h:i:s A', strtotime($summary->transaction_issued_date)),
                'donation_amount' => $summary->transaction_amount,
                'donor_name' => $summary->donor_name,
                'donor_email' => $summary->donor_email,
                'donor_notel' => $summary->donor_notel,
            ];        

            $html = view('admin.pdf.donation_receipt', $data)->render();
            $pdf = Pdf::loadHTML($html);
            return $pdf->stream();
        }
    }
}
