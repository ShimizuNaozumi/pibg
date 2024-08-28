<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    public function donation()
    {
        $acc = Auth::guard('admin')->user();

        $donations = DB::table('donations')
                        ->join('transactions', 'donations.transaction_id', '=', 'transactions.transaction_id')
                        ->join('funds', 'donations.fund_id', '=', 'funds.fund_id')
                        ->select('donations.*', 'transactions.*', 'funds.*')
                        ->get();
                        
        return view('admin.donation',compact('acc', 'donations'));
    }

    public function show_donation(string $id)
    {
        $id = decrypt_string($id);
        
        $acc = Auth::guard('admin')->user();

        $donation = DB::table('donations')
                        ->join('transactions', 'donations.transaction_id', '=', 'transactions.transaction_id')
                        ->join('funds', 'donations.fund_id', '=', 'funds.fund_id')
                        ->select('donations.*', 'transactions.*', 'funds.*')
                        ->where('donation_id', $id)
                        ->first();
                        
                        
        return view('admin.details_donation',compact('acc', 'donation'));
    }
}
