<?php

namespace App\Http\Controllers\admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {
        $acc = Auth::guard('admin')->user();
        return view('admin.profile', compact('acc'));
    }

    public function update_profile(Request $request, string $id)
    {
        $id = decrypt_string($id);

        $request->validate([
            'username' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'notel' => 'required|string',
        ]);

        $check_username = DB::table('admins')
                        ->where('admin_username', $request->username)
                        ->where('admin_id', '!=', $id)
                        ->exists();

        if($check_username){
            return back()->with([
                'icon' => '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" />',
                'alert' => 'danger',
                'message' => 'Username sudah wujud. Sila gunakan username lain',
            ]);
        }

        $admin = Admin::findOrFail($id);
        $admin->admin_username = $request->username;
        $admin->admin_name = $request->name;
        $admin->admin_notel = $request->notel;
        $admin->updated_at = now();

        if ($admin->save()) {
            return back()->with([
                'icon' => '<path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" />',
                'alert' => 'success',
                'message' => 'Profil berjaya dikemas kini.',
            ]);
        } else {
            return back()->with([
                'icon' => '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" />',
                'alert' => 'danger',
                'message' => 'Gagal dikemas kini. Sila cuba sebentar lagi.',
            ]);
        }
    }

    public function password()
    {
        $acc = Auth::guard('admin')->user();
        return view('admin.password', compact('acc'));
    }

    public function update_password(Request $request, string $id)
    {
        $id = decrypt_string($id);
        
        $request->validate([
            'current_password' => 'required',
            'new_password' => ['required','string','min:8','regex:/[A-Z]/','regex:/[a-z]/','regex:/[!@#$%^&*(),.?":{}|<>]/'],
            'verify_password' => 'required|same:new_password',
        ],[
            'new_password.min' => 'Kata laluan baru mestilah sekurang-kurangnya 8 aksara.',
            'new_password.regex' => 'Format kata laluan tidak sah',
            'verify_password.same' => 'Kata laluan tidak sepadan.',
        ]);

        $admin = Admin::findOrFail($id);

        if (Hash::check($request->current_password, $admin->admin_password)) {
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
        } else {
            return back()->withInput()->with([
                'icon' => '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" />',
                'alert' => 'danger',
                'message' => 'Kata laluan semasa tidak tepat.',
            ]);
        }
    }
}
