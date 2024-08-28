<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function donation_report()
    {
        $acc = Auth::guard('admin')->user();
        
        $funds = DB::table('funds')
            ->join('admins', 'funds.admin_id', '=', 'admins.admin_id')
            ->select('funds.*', 'admins.*')
            ->get();

        return view('admin.donation_report', compact('acc', 'funds'));
    }

    public function generate_donation_report(string $id)
    {
        $id = decrypt_string($id);
        
        $donations = DB::table('donations')
                    ->join('transactions', 'donations.transaction_id', 'transactions.transaction_id')
                    ->join('funds', 'donations.fund_id', 'funds.fund_id')
                    ->where('transaction_status', 1)
                    ->where('donations.fund_id', $id)
                    ->get();

        if ($donations->isEmpty()) {
            return back()->with([
                'icon' => '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" />',
                'alert' => 'warning',
                'title' => 'Tiada Sumbangan',
                'message' => 'Tiada sumbangan dilakukan untuk tabung ini.',
            ]);
        }

        $fundName = $donations->first()->fund_name;
        $total_donation = $donations->sum('transaction_amount');

        $data = [
            'title' => 'Sumbangan Tabung ' . $fundName,
            'donations' => $donations,
            'total' => $total_donation,
        ];

        $html = view('admin.pdf.donation_report', $data)->render();
        $pdf = Pdf::loadHTML($html);
        return $pdf->stream();
    }
}
