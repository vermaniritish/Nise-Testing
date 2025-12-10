<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Admin\State;
use App\Models\Admin\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

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

    public function registrationForm(Request $request)
    {
        $states = State::all();
        return view('front.user.registration', compact('states'));
    }

    public function store(Request $request)
    {
        $type = $request->input('registration_type');

        if ($type === 'Company') {
            $request->validate([
                'registration_type'  => 'required|in:Company,Individual',
                'company_name'       => 'required|string|max:255',
                'address_1'          => 'required|string|max:255',
                'address_2'          => 'nullable|string|max:255',
                'state_id'           => 'required|exists:states,id',
                'city'               => 'required|string|max:255',
                'pincode'            => 'required|digits:6',
                'pan'                => 'required|string|max:10',
                'pan_file'           => 'nullable|file|mimes:pdf,jpg,png|max:5120',
                'tin'                => 'required|string|max:50',
                'registration_number'=> 'required|string|max:100',
                'company_file'       => 'nullable|file|mimes:pdf,jpg,png|max:5120',
                'person_name'        => 'required|string|max:255',
                'mobile'             => 'required|string|max:15',
                'email'              => 'required|email|max:255|unique:users,email',
            ]);

            // File uploads
            $panFile = $request->file('pan_file') ? $request->file('pan_file')->store('uploads/pan', 'public') : null;
            $companyFile = $request->file('company_file') ? $request->file('company_file')->store('uploads/company', 'public') : null;

            // Create user
            $user = new User();
            $user->registration_type = 'Company';
            $user->company_name = $request->company_name;
            $user->company_file = $companyFile;
            $user->address_1 = $request->address_1;
            $user->address_2 = $request->address_2;
            $user->state_id = $request->state_id;
            $user->city = $request->city;
            $user->pincode = $request->pincode;
            $user->pan = strtoupper($request->pan);
            $user->pan_file = $panFile;
            $user->tin = $request->tin; 
            $user->registration_number = $request->registration_number;
            $user->person_name = $request->person_name;
            $user->mobile = $request->mobile;
            $user->email = $request->email;
            $user->save();

            // Create institute code like SM-INST-00001
            // $uniqueNumber = str_pad($user->id, 5, '0', STR_PAD_LEFT);
            // $user->institute_code = 'SM-INST-' . $uniqueNumber;
            $user->save();
        } elseif ($type === 'Individual') {
            $request->validate([
                'registration_type'     => 'required|in:Company,Individual',
                'ind_contact_person_name' => 'required|string|max:255',
                'ind_address_1'         => 'required|string|max:255',
                'ind_address_2'         => 'nullable|string|max:255',
                'ind_state_id'          => 'required|exists:states,id',
                'ind_city_or_district'  => 'required|string|max:255',
                'ind_pin_code'          => 'required|digits:6',
                'ind_mobile_number'                => 'required|string|max:15',
                'ind_email'                 => 'required|email|max:255|unique:users,email',
                'password'              => 'required|string|min:6',
            ]);

            $user = new User();
            $user->registration_type = 'Individual';
            $user->ind_contact_person_name = $request->ind_contact_person_name;
            $user->ind_address_1 = $request->ind_address_1;
            $user->ind_address_2 = $request->ind_address_2;
            $user->ind_state_id = $request->ind_state_id;
            $user->ind_city_or_district = $request->ind_city_or_district;
            $user->ind_pin_code = $request->ind_pin_code;
            $user->ind_mobile_number = $request->ind_mobile_number;
            $user->ind_email = $request->ind_email;
            $user->mobile = $request->ind_mobile_number;
            $user->email = $request->ind_email;
            $user->password = Hash::make($request->password);
            $user->save();

            // Generate code
            // $uniqueNumber = str_pad($user->id, 5, '0', STR_PAD_LEFT);
            // $user->institute_code = 'SM-IND-' . $uniqueNumber;
            $user->save();
        }

        return redirect()->route('registration.confirmation')
                    ->with('success', 'Registration successful!');
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
