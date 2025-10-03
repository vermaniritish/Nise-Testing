<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Admin\State;
use App\Models\Admin\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UsersController extends AppController
{
    public function partnerLoginForm()
    {
        return view('front.user.login');
    }

    public function mobileForm()
    {
        return view('front.user.mobile_form');
    }

    // public function sendMobileOtp(Request $request)
    // {
    //     $request->validate(['mobile' => 'required|digits:10|unique:users,mobile']);

    //     session(['mobile' => $request->mobile]);
    //     $otp = rand(100000, 999999);
        
    //     // TODO: Send OTP via SMS API (Twilio, MSG91, etc.)
    //     // Example: SmsService::send($request->mobile, "Your OTP is $otp");

    //     $verification = User::create([
    //         'mobile' => $request->mobile,
    //         'mobile_otp' => $otp
    //     ]);

    //     return back()->with('success', "OTP sent to {$request->mobile}")->with('id', $verification->id);
    // }

    public function sendMobileOtp(Request $request)
    {
        $request->validate([
            'mobile' => 'required|digits:10'
        ]);

        // Check if user already exists
        $user = User::where('mobile', $request->mobile)->first();

        if ($user && $user->is_mobile_verified) {
            // Already registered and verified
            return back()->with('error', 'This mobile number is already registered and verified.');
        }

        $otp = rand(100000, 999999);

        // If user exists but not verified → update OTP
        if ($user && !$user->is_mobile_verified) {
            $user->update(['mobile_otp' => $otp]);
        } else {
            // Create new user entry
            $user = User::create([
                'mobile' => $request->mobile,
                'mobile_otp' => $otp,
                'is_mobile_verified' => 0
            ]);
        }

        // Store mobile in session
        session(['mobile' => $request->mobile]);

        // TODO: Send OTP via SMS API
        // Example: SmsService::send($request->mobile, "Your OTP is $otp");

        return back()->with('success', "OTP sent to {$request->mobile}")->with('id', $user->id);
    }

    public function verifyMobileOtp(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'mobile_otp' => 'required|digits:6'
        ]);

        $verification = User::findOrFail($request->id);

        if ($verification->mobile_otp == $request->mobile_otp) {
            $verification->update(['is_mobile_verified' => true]);
            session()->forget('mobile');
            return redirect()->route('email.form', $verification->id)
                ->with('success', 'Mobile verified successfully!');
        }

        

        return back()->withErrors(['mobile_otp' => 'Invalid OTP']);
    }

    public function emailForm($id)
    {
        $verification = User::findOrFail($id);
        if (!$verification->is_mobile_verified) {
            return redirect()->route('mobile.form')->withErrors(['mobile' => 'Please verify mobile first']);
        }
        return view('front.user.email_form', compact('verification'));
    }

    public function sendEmailOtp(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'email' => 'required|email|unique:users,email'
        ]);

        $verification = User::findOrFail($request->id);

        $otp = rand(100000, 999999);

        // Send OTP via Email
        // Mail::raw("Your OTP is $otp", function ($message) use ($request) {
        //     $message->to($request->email)->subject('Email Verification OTP');
        // });

        $verification->update([
            'email' => $request->email,
            'email_otp' => $otp
        ]);

        return back()->with('success', "OTP sent to {$request->email}");
    }

    public function verifyEmailOtp(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'email_otp' => 'required|digits:6'
        ]);

        $verification = User::findOrFail($request->id);

        if ($verification->email_otp == $request->email_otp) {
            $verification->update(['is_email_verified' => true]);
            return redirect()->route('registration.form',['id'=>$request->id])->with('success', 'All verification steps completed!');
        }

        return back()->withErrors(['email_otp' => 'Invalid OTP']);
    }

    public function registrationForm($id)
    {
        $verification = User::findOrFail($id);
        if (!$verification->is_mobile_verified) {
            return redirect()->route('email.form')->withErrors(['email' => 'Please verify email first']);
        }
        $states = State::all();
        return view('front.user.registration', compact('verification','states'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id'          => 'required|exists:users,id',
            'organisation_name'  => 'required|string|max:255',
            'organisation_file'   => 'nullable|file|mimes:pdf,jpg,png|max:5120',
            'pan'        => 'required|string|max:10',
            'pan_file'   => 'nullable|file|mimes:pdf,jpg,png|max:5120',
            'gst'        => 'required|string|max:15',
            'gst_file'   => 'nullable|file|mimes:pdf,jpg,png|max:5120',
            'address'    => 'required|string|max:500',
            'pin'        => 'required|digits:6',
            'state_id'   => 'required|exists:states,id',
            'district_id'=> 'required|exists:district,id',
        ]);

        $panFile = $request->file('pan_file') ? $request->file('pan_file')->store('uploads/pan', 'public') : null;
        $gstFile = $request->file('gst_file') ? $request->file('gst_file')->store('uploads/gst', 'public') : null;
        $organisationFile = $request->file('organisation_file') ? $request->file('organisation_file')->store('uploads/organisation', 'public') : null;

        $user = User::findOrFail($request->id);
        $user->organisation_name  = $request->organisation_name;
        $user->organisation_file  = $organisationFile;
        $user->pan                = $request->pan;
        $user->pan_file           = $panFile;
        $user->gst                = $request->gst;
        $user->gst_file           = $gstFile;
        $user->address            = $request->address;
        $user->pin                = $request->pin;
        $user->state_id           = $request->state_id;
        $user->district_id        = $request->district_id;
        $user->mobile_otp = null;
        $user->email_otp  = null;

        $user->save();

        $uniqueNumber = str_pad($user->id, 5, '0', STR_PAD_LEFT); // like 00001
        $userIdSt = 'SM-INST-' . $uniqueNumber;
        $user->institute_code = $userIdSt;
        $user->save();

        return redirect()->route('registration.confirmation')->with('success', 'Registration successful!');
    }



    public function getDistricts($state_id)
    {
        $districts = District::where('state_id', $state_id)->get();
        return response()->json($districts);
    }

    public function confirmation()
    {
        return view('front.user.confirmation');
    }
}
