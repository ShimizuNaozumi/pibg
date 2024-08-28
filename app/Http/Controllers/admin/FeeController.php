<?php

namespace App\Http\Controllers\admin;

use App\Models\Fee;
use App\Models\FeeSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FeeController extends Controller
{
    public function fee()
    {
        $acc = Auth::guard('admin')->user();

        // $fees = DB::table('fees')
        //                 ->join('transactions', 'fees.transaction_id', '=', 'transactions.id')
        //                 ->select('fees.*', 'transactions.*')
        //                 ->get();
                        
        return view('admin.fee',compact('acc'));
    }
    public function fee_session()
    {
        $acc = Auth::guard('admin')->user();

        $fee_sessions = FeeSession::get();
                        
        return view('admin.fee_session',compact('acc', 'fee_sessions'));
    }
    public function create_fee_session(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'session' => 'required',
        ]);

        FeeSession::create([
            'fee_session_name' => $request->name.' Tahun '.$request->session,
        ]);

        return back()->with([
            'icon' => '<path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" />',
            'alert' => 'success',
            'title' => 'Berjaya',
            'message' => 'Sesi berjaya ditambah.',
        ]);
    }
    public function read_fee(string $id)
    {
        $id = decrypt_string($id);

        $fee_session = FeeSession::find($id)->first();

        $fees = DB::table('fees')
                ->where('fee_session_id', $id)
                ->get();

        $acc = Auth::guard('admin')->user();
                        
        return view('admin.add_fee',compact('acc', 'fee_session', 'fees'));
    }
    public function create_fee(Request $request)
    {
        $request->validate([
            'session' => 'required',
            'name' => 'required|string',
            'category' => 'required|string',
            'amount' => 'required|integer',
        ]);

        Fee::create([
            'fee_session_id' => $request->session,
            'fee_name' => $request->name,
            'fee_amount' => $request->amount,
            'fee_specific' => $request->category,
        ]);

        return back()->with([
            'icon' => '<path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" />',
            'alert' => 'success',
            'title' => 'Berjaya',
            'message' => 'Perkara berjaya ditambah.',
        ]);
    }
}
