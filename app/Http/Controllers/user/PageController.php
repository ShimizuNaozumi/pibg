<?php

namespace App\Http\Controllers\user;

use App\Models\Fund;
use App\Models\User;
use App\Models\Student;
use App\Models\Guardian;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        $funds = DB::table('funds')
                ->where('fund_status', 'active')
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get();
            
    $donations = DB::table('donations')
                ->join('transactions', 'donations.transaction_id', '=', 'transactions.transaction_id')
                ->select('donations.fund_id', DB::raw('SUM(transactions.transaction_amount) as total_donations'))
                ->where('transactions.transaction_status', 1)
                ->groupBy('donations.fund_id')
                ->get();

            
        // Map donations to funds
        $funds = $funds->map(function ($fund) use ($donations) {
                $donation = $donations->firstWhere('fund_id', $fund->fund_id);
                $fund->total_donations = $donation ? $donation->total_donations : 0;
                return $fund;
            });

        return view('user.index' , compact('funds'));
    }

    public function pibg()
    {
        $acc = Auth::user();

        $pibg = DB::table('fee_sessions')
                    ->get();
        
        $students = DB::table('students')
                    ->join('users', 'students.user_id', '=', 'users.user_id')
                    ->join('classes as c1', 'students.class_id', '=', 'c1.class_id') // Alias for the first join
                    ->join('streams', 'c1.stream_id', '=', 'streams.stream_id') // Join with the streams table
                    ->where('students.user_id', $acc->user_id)
                    ->get();
        
        $fees = DB::table('fee_payments')
                    ->join('transactions', 'fee_payments.transaction_id', '=', 'transactions.transaction_id')
                    ->join('students', 'fee_payments.student_id', '=', 'students.student_id')
                    ->where('fee_payments.student_id', '=', 'students.student_id')
                    ->where('transactions.transaction_status', 1)
                    ->sum('transaction_amount');
                

        $perdana = DB::table('students')
                    ->join('users', 'students.user_id', '=', 'users.user_id')
                    ->join('classes', 'classes.class_id', '=', 'students.class_id')
                    ->where('students.user_id' , $acc->user_id)
                    ->where('classes.stream_id', '=' , '1')
                    ->count();
        
        $ppki = DB::table('students')
                    ->join('users', 'students.user_id', '=', 'users.user_id')
                    ->join('classes', 'classes.class_id', '=', 'students.class_id')
                    ->where('students.user_id' , $acc->user_id)
                    ->where('classes.stream_id', '=' , '2')
                    ->count();

        $enam = DB::table('students')
                    ->join('users', 'students.user_id', '=', 'users.user_id')
                    ->join('classes', 'classes.class_id', '=', 'students.class_id')
                    ->where('students.user_id' , $acc->user_id)
                    ->where('classes.stream_id', '=' , '3')
                    ->count();

        return view('user.pibg' , compact('acc' , 'perdana' ,'ppki' ,'enam' , 'pibg' ,'students', 'fees'));
    }

    public function tabung()
    {
        $funds = DB::table('funds')
                ->where('fund_status', 'active')
                ->orderBy('created_at', 'desc')
                ->get();

        $donations = DB::table('donations')
                ->join('transactions', 'donations.transaction_id', '=', 'transactions.transaction_id')
                ->select('donations.fund_id', DB::raw('SUM(transactions.transaction_amount) as total_donations'))
                ->where('transactions.transaction_status', 1)
                ->groupBy('donations.fund_id')
                ->get();
            
        // Map donations to funds
        $funds = $funds->map(function ($fund) use ($donations) {
                $donation = $donations->firstWhere('fund_id', $fund->fund_id);
                $fund->total_donations = $donation ? $donation->total_donations : 0;
                return $fund;
            });
                
        return view('user.tabung' , compact('funds'));
    }
    
    public function login_user()
    {
        return view('user.login');
    }

    public function detail(string $id)
    {
        $id = decrypt_string($id);
        $details = Fund::find($id);
        $donors = DB::table('donations')
                ->join('transactions', 'donations.transaction_id', '=', 'transactions.transaction_id')
                ->where('donations.fund_id', $id)
                ->where('transactions.transaction_status', 1)
                ->count();

        $donations = DB::table('donations')
                   ->join('transactions', 'donations.transaction_id', '=', 'transactions.transaction_id')
                   ->where('donations.fund_id', $id)
                   ->where('transactions.transaction_status', 1)
                   ->sum('transaction_amount');

        return view('user.detail', compact('details','donors','donations'));

    }

    public function yuran(string $id)
    {
        $id = decrypt_string($id);
        $details = Student::find($id);
        $acc = Auth::user();
        return view('user.paymentpibg', compact('details' , 'acc'));
    }    

    public function sumbang(string $id)
    {
        $id = decrypt_string($id);
        $details = Fund::find($id);
        $acc = Auth::user();
        return view('user.payment', compact('details' , 'acc'));
    }

    public function edit()
    {
        $acc = Auth::user();
        return view('user.update', compact('acc'));
    }

    public function akaun()
    {
        $acc = Auth::user();
        $guardians =  DB::table('guardians')
                    ->join('users', 'guardians.user_id', '=', 'users.user_id')
                    ->where('guardians.user_id' , $acc->user_id)
                    ->get();
        $classes = DB::table('classes')
                    ->get();
        $students = DB::table('students')
                    ->join('users', 'students.user_id', '=', 'users.user_id')
                    ->join('classes as c1', 'students.class_id', '=', 'c1.class_id') // Alias for the first join
                    ->join('streams', 'c1.stream_id', '=', 'streams.stream_id') // Join with the streams table
                    ->where('students.user_id', $acc->user_id)
                    ->get();
                    // ->join('users', 'students.user_id', '=', 'users.user_id')
                    // ->join('classes', 'classes.class_id', '=', 'students.class_id')
                    // ->where('students.user_id' , $acc->user_id)
                    // ->get();
        $transactions = DB::table('transactions')
                    ->join('donations', 'transactions.transaction_id', '=', 'donations.transaction_id')
                    ->where('donations.donor_email' , $acc->user_email)
                    ->get();
        
        $transaction1s = DB::table('transactions')
                    ->join('fee_payments', 'transactions.transaction_id', '=', 'fee_payments.transaction_id')
                    ->where('fee_payments.fee_payment_email' , $acc->user_email)
                    ->get();
        
        return view('user.akaun' , compact('acc' , 'guardians' , 'classes', 'students' , 'transactions', 'transaction1s'));
    }
    
}
