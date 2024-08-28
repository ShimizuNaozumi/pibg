<?php

namespace App\Http\Controllers\admin;

use App\Models\Fund;
use App\Models\User;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Donation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $acc = Auth::guard('admin')->user();

        $statUsers = User::count();
        $statStudents = Student::count();
        $statAdmins = Admin::count();
        $statFunds = Fund::count();
        $statDonations = DB::table('transactions')
                            ->join('donations', 'transactions.transaction_id', '=', 'donations.transaction_id')
                            ->where('transaction_status', '1')
                            ->sum('transaction_amount');

        $users = User::orderBy('created_at', 'desc')->limit(6)->get();
        $donors = DB::table('donations')
                  ->join('transactions', 'donations.transaction_id', 'transactions.transaction_id')
                  ->where('transaction_status', '1')
                  ->orderBy('transactions.created_at', 'desc')
                  ->limit(3)
                  ->get();

        
        $monthlyDonations = DB::table('transactions')
            ->join('donations', 'transactions.transaction_id', '=', 'donations.transaction_id')
            ->where('transaction_status', '1')
            ->select(DB::raw('YEAR(transaction_issued_date) as year'), DB::raw('MONTH(transaction_issued_date) as month'), DB::raw('SUM(transaction_amount) as total_amount'))
            ->groupBy(DB::raw('YEAR(transaction_issued_date)'), DB::raw('MONTH(transaction_issued_date)'))
            ->orderByRaw('YEAR(transaction_issued_date) DESC')
            ->orderByRaw('MONTH(transaction_issued_date) DESC')
            ->limit(8)
            ->get();

        // Prepare data for the chart
        $donationMonths = [];
        $donationAmounts = [];

        // Sort the collection numerically by year and then by month
        $sortedMonthlyDonations = $monthlyDonations->sort(function($a, $b) {
            if ($a->year === $b->year) {
                return $a->month <=> $b->month;
            }
            return $a->year <=> $b->year;
        });

        foreach ($sortedMonthlyDonations as $donation) {
            $donationMonths[] = sprintf("%02d.%02d", $donation->month, $donation->year % 100); // Format as "YYYY-MM"
            $donationAmounts[] = $donation->total_amount;
        }

        return view('admin.dashboard', compact(
            'acc', 'users', 'donors', 'statUsers', 'statStudents', 'statAdmins', 'statDonations', 'statFunds', 'donationMonths', 'donationAmounts'
        ));
    }
}
