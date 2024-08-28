<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Models\DonationBox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DonationBoxController extends Controller
{
    public function add_donation_box()
    {
        $acc = Auth::guard('admin')->user();
        return view('admin.add_donation_box', compact('acc'));
    }
    public function create_donation_box(Request $request)
    {
        $request->validate([
            'admin_id' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'target' => 'required|numeric|min:0',
            'image' => 'required|image|file|max:20480'
        ]);

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $path = 'uploads/images/';
        $file->move($path,$filename);

        DonationBox::create([
            'admin_id' => $request->admin_id,
            'name' => $request->name,
            'description' => $request->description,
            'target' => $request->target,
            'image_path' => $path.$filename,
        ]);

        return to_route('donation_box');
    }

    public function donation_box()
    {
        $acc = Auth::guard('admin')->user();
        $donation_boxes = DB::table('donation_boxes')
                        ->join('admins', 'donation_boxes.admin_id', '=', 'admins.id')
                        ->select('donation_boxes.*', 'admins.name as admin_name')
                        ->get();
                        
        return view('admin.donation_box', compact('acc','donation_boxes'));
    }
    public function edit_donation_box(string $id)
    {
        $acc = Auth::guard('admin')->user();
        $donation_box = DonationBox::find($id);
        return view('admin.edit_donation_box', compact('acc','donation_box'));
    }
    public function update_donation_box(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'target' => 'required|numeric|min:0',
            'image' => 'image|file|max:20480'
        ]);

        $donationBox = DonationBox::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($donationBox->image_path && file_exists(public_path($donationBox->image_path))) {
                unlink(public_path($donationBox->image_path));
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $path = 'uploads/images/';
            $file->move(public_path($path), $filename);
            $donationBox->image_path = $path . $filename;
        }

        
        $donationBox->name = $request->name;
        $donationBox->description = $request->description;
        $donationBox->target = $request->target;
        $donationBox->save();

        return to_route('donation_box');
    }

    public function publish_donation_box(string $id)
    {
        $donationBox = DonationBox::findOrFail($id);
        $donationBox->status = '2';
        $donationBox->save();

        return to_route('donation_box');
    }

    public function conceal_donation_box(string $id)
    {
        $donationBox = DonationBox::findOrFail($id);
        $donationBox->status = '1';
        $donationBox->save();

        return to_route('donation_box');
    }


}
