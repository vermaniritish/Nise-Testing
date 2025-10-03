<?php

namespace App\Http\Controllers\PartnerAdmin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Users;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\State;
use App\Models\Admin\District;

class ProfileController extends AppController
{
    function __construct()
    {
        parent::__construct();
    }

    public function update(Request $request, $id)
    {
        $user = Users::find($id);

        if (!$user) {
            $request->session()->flash('error', 'User not found.');
            return redirect()->back();
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            unset($data['_token']);

            // Validate request data
            $validator = Validator::make($data, [
                'organisation_name' => 'nullable|string|max:255',
                'pan'               => 'nullable|string|min:10|max:10|alpha_num',
                'gst'               => 'nullable|string|min:15|max:15|alpha_num',
                'address'           => 'nullable|string|max:255',
                'pin'               => 'nullable|string|max:10',
                'state_id'          => 'nullable|integer|exists:states,id',
                'district_id'       => 'nullable|integer|exists:district,id',
                'mobile'            => 'required|string|min:10|max:10',
                'email'             => 'required|email|max:255',
                'gender'            => 'nullable|in:male,female,other',
                'status'            => 'nullable|boolean',
                // File validation rules
                'organisation_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'pan_file'          => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'gst_file'          => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'image'             => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Handle file uploads
            if ($request->hasFile('organisation_file')) {
                $file = $request->file('organisation_file');
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('uploads/profile'), $filename);
                $data['organisation_file'] = $filename;
            }

            if ($request->hasFile('pan_file')) {
                $file = $request->file('pan_file');
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('uploads/profile'), $filename);
                $data['pan_file'] = $filename;
            }

            if ($request->hasFile('gst_file')) {
                $file = $request->file('gst_file');
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('uploads/profile'), $filename);
                $data['gst_file'] = $filename;
            }

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('uploads/profile'), $filename);
                $data['image'] = $filename;
            }

            $data['modified'] = now();

            // Update the user data
            $update = Users::modify($id, $data);

            if ($update) {
                $request->session()->flash('success', 'User updated successfully.');
                return redirect()->route('partnerAdmin.profile.update',['id' => $id]);
            } else {
                $request->session()->flash('error', 'Failed to update user. Please try again.');
                return redirect()->back()->withInput();
            }
        }

        // States & Districts dropdown ke liye
        $states = State::all();
        $districts = District::all();

        return view('partnerAdmin.profile.update', compact('user', 'states', 'districts'));
    }

}
