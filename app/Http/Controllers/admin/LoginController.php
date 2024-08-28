<?php

namespace App\Http\Controllers\admin;

use App\Mail\ResetPassword;
use App\Mail\ResetUsername;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function login_admin()
    {
        return view('admin.login');
    }

    public function auth_admin(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginType = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'admin_email' : 'admin_username';

        $credentials = [
            $loginType => $request->input('login'),
            'password' => $request->input('password'),
        ];
    
        if (Auth::guard('admin')->attempt($credentials)) {

            $admin = Auth::guard('admin')->user();

            if ($admin->admin_status != 'active') {
                Auth::guard('admin')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->with([
                    'icon' => '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" />',
                    'alert' => 'danger',
                    'message' => 'Akaun anda telah dinyahaktifkan. Sila hubungi pentadbir untuk maklumat lanjut.',
                ]);
            }

            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
    
        return back()->with([
            'icon' => '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" />',
            'alert' => 'danger',
            'message' => 'Username/E-mel atau kata laluan tidak tepat.',
        ]);
    }

    public function forgot_username()
    {
        return view('admin.forgot_username');
    }
    public function email_forgot_username(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $acc = DB::table('admins')
                ->where('admin_email', $request->email)
                ->first();
        
        if($acc){
            Mail::to($acc->admin_email)->send(new ResetUsername([
                'id' => $acc->admin_id,
            ]));
            return back()->with([
                'icon' => '<path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" />',
                'alert' => 'success',
                'message' => 'E-mel telah dihantar',
            ]);

        }else{
            return back()->withInput()->with([
                'icon' => '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" />',
                'alert' => 'danger',
                'message' => 'E-mel tidak berdaftar.',
            ]);
        }
    }
    public function reset_username(string $id)
    {
        $id = decrypt_string($id);
        return view('admin.reset_username', compact('id'));
    }
    public function modify_username(Request $request, string $id)
    {
        $id = decrypt_string($id);
        
        $request->validate([
            'new_username' => 'required|string|max:255',
        ]);

        $check_username = DB::table('admins')
                        ->where('admin_username', $request->new_username)
                        ->where('admin_id', '!=', $id)
                        ->exists();

        if($check_username){
            return back()->withInput()->with([
                'icon' => '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" />',
                'alert' => 'danger',
                'message' => 'Username sudah wujud. Sila gunakan username lain',
            ]);
        }

        $admin = Admin::findOrFail($id);
        $admin->updated_at = now();
        $admin->admin_username = $request->new_username;

        if ($admin->save()) {
            return back()->with([
                'icon' => '<path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" />',
                'alert' => 'success',
                'message' => 'Username berjaya dikemas kini.',
            ]);
        } else {
            return back()->with([
                'icon' => '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" />',
                'alert' => 'danger',
                'message' => 'Gagal dikemas kini. Sila cuba sebentar lagi.',
            ]);
        }
    }
    public function forgot_password()
    {
        return view('admin.forgot_password');
    }
    public function email_forgot_password(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
        ]);

        $acc = DB::table('admins')
                ->where('admin_username', $request->username)
                ->first();
        
        if($acc){
            Mail::to($acc->admin_email)->send(new ResetPassword([
                'id' => $acc->admin_id,
            ]));
            return back()->with([
                'icon' => '<path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" />',
                'alert' => 'success',
                'message' => 'E-mel telah dihantar',
            ]);

        }else{
            return back()->withInput()->with([
                'icon' => '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" />',
                'alert' => 'danger',
                'message' => 'Username tidak wujud.',
            ]);
        }
    }
    public function reset_password(string $id)
    {
        $id = decrypt_string($id);
        return view('admin.reset_password', compact('id'));
    }
    public function modify_password(Request $request, string $id)
    {
        $id = decrypt_string($id);
        
        $request->validate([
            'new_password' => ['required','string','min:8','regex:/[A-Z]/','regex:/[a-z]/','regex:/[!@#$%^&*(),.?":{}|<>]/'],
            'verify_password' => 'required|same:new_password',
        ],[
            'new_password.min' => 'Kata laluan baru mestilah sekurang-kurangnya 8 aksara.',
            'new_password.regex' => 'Format kata laluan tidak sah',
            'verify_password.same' => 'Kata laluan tidak sepadan.',
        ]);

        $admin = Admin::findOrFail($id);
        $admin->updated_at = now();
        $admin->admin_password = Hash::make($request->new_password);

        if ($admin->save()) {
            return back()->with([
                'icon' => '<path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" />',
                'alert' => 'success',
                'message' => 'Kata laluan berjaya dikemas kini.',
            ]);
        } else {
            return back()->with([
                'icon' => '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" />',
                'alert' => 'danger',
                'message' => 'Gagal dikemas kini. Sila cuba sebentar lagi.',
            ]);
        }
    }
}
