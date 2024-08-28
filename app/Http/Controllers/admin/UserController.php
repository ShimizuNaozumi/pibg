<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\UserRegistration;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function users()
    {
        $acc = Auth::guard('admin')->user();
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users', compact('acc','users'));
    }
    public function create_user(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        $generatedPassword = Str::password(8);

        if(User::where('user_email', $request->email)->exists()){
            return back()->with([
                'icon' => '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" />',
                'alert' => 'danger',
                'title' => 'Pendaftaran gagal',
                'message' => 'Akaun sudah berdaftar.',
            ]);
        }else{
            User::create([
                'user_name' => $request->name,
                'user_email' => $request->email,
                'user_password' => $generatedPassword,
            ]);
            
            Mail::to($request->email)->send(new UserRegistration([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $generatedPassword,
            ]));

            return back()->with([
                'icon' => '<path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" />',
                'alert' => 'success',
                'title' => 'Pendaftaran berjaya',
                'message' => 'Akaun berjaya didaftar.',
            ]);
        }
    }
    public function activate(string $id)
    {
        $id = decrypt_string($id);

        $user = User::findOrFail($id);
        $user->user_status = '1';
        $user->save();

        return back()->with([
            'icon' => '<path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" />',
            'alert' => 'success',
            'title' => 'Akaun diaktfikan',
            'message' => 'Akaun telah diaktifkan.',
        ]);
    }
    public function deactivate(string $id)
    {
        $id = decrypt_string($id);
        
        $user = User::findOrFail($id);
        $user->user_status = '2';
        $user->save();

        return back()->with([
            'icon' => '<path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" />',
            'alert' => 'success',
            'title' => 'Akaun dinyahaktfikan',
            'message' => 'Akaun telah dinyahaktifkan.',
        ]);
    }
}
