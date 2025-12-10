<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LoginController extends AppController
{
    public function sendOtp(Request $request)
    {
        $request->validate([
            'userphone' => 'required',
        ]);

        $isEmail = filter_var($request->userphone, FILTER_VALIDATE_EMAIL);

        // Find user by mobile OR email
        $user = User::where('mobile', $request->userphone)
                    ->orWhere('email', $request->userphone)
                    ->first();

        if (!$user) {
            return back()->withErrors([
                'userphone' => $isEmail 
                    ? 'This email is not registered.' 
                    : 'This mobile number is not registered.'
            ]);
        }

        // ✅ Check if user is active
        if ($user->status != 1) {
            return back()->withErrors([
                'userphone' => 'Your account is inactive. Please contact support.'
            ]);
        }

        // ✅ Generate OTP
        $otp = rand(100000, 999999);

        if ($isEmail) {
            $user->email_otp = $otp;
            $sendTo = $user->email;
            // Mail::to($user->email)->send(new SendOtpMail($otp));
        } else {
            $user->mobile_otp = $otp;
            $sendTo = $user->mobile;
            // SmsService::send($user->mobile, "Your OTP is $otp");
        }

        // ✅ Store session data
        session(['mobile' => $request->userphone]);
        $user->save();
        Session::put('login_id', $user->id);
        Session::put('login_type', $isEmail ? 'email' : 'mobile');

        return redirect()->back()->with('success', "OTP sent to {$sendTo}");
    }
    
    public function verifyOtp(Request $request){
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        $userId    = Session::get('login_id');
        $loginType = Session::get('login_type');

        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('login.form')->withErrors([
                'otp' => 'Session expired, please try again.'
            ]);
        }

        $otpMatched = false;
        if ($loginType === 'email' && $user->email_otp == $request->otp) {
            $otpMatched = true;
            $user->email_otp = null;
        } elseif ($loginType === 'mobile' && $user->mobile_otp == $request->otp) {
            $otpMatched = true;
            $user->mobile_otp = null;
        }

        if (!$otpMatched) {
            return back()->withErrors(['otp' => 'Invalid OTP']);
        }

        $user->save();
        auth()->login($user);
        session()->forget('mobile');
        Session::forget(['login_id', 'login_type']);

        return redirect()->route('partner.dashboard')
            ->with('success', 'Login successful!');
    }


    public function logout(Request $request)
    {
        Auth::logout(); // user logout

        // session clear
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home.index')->with('success', 'You have been logged out successfully.');
    }
}
