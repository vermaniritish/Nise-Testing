<?php use App\Models\Admin\CustomPageData; ?>
@extends('layouts.frontendlayout')
@section('content')

<!-- START PAGE BANNER AND BREADCRUMBS -->
	<section id="page-banner">
		
		<div class="single-page-title-area-bottom">
			<div class="auto-container">
				<div class="row">
					<div class="col-12 text-center">
						<div id="ost-container">
							<div class="ost-multi-header">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('front.Home') }}</a></li>
									<li class="breadcrumb-item active">EOI Enrollment</li>
								</ol>
							</div>
						</div>
					</div>
				</div>
				<!-- end row-->
			</div>
		</div>
	</section>
	<!-- END PAGE BANNER AND BREADCRUMBS -->
	
		
	<!-- START NOTICE-LOGIN SECTION -->
    <section id="promot" class="section-padding">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="row w-100 justify-content-center">
            <!-- LEFT: Email Verification -->
            <div class="col-lg-7 col-md-7 col-12 pr-lg-5 pr-md-5 pr-0 mb-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="section-title-2">
                    <h3>Please Verify <span>Email</span></h3>
                </div>

                <div class="home-p-form-wrapper">
                    <div class="home-p-form">
                        
                        <form method="POST" action="{{ route('email.sendOtp') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $verification->id }}">

                            <div class="form-group col-lg-12 mb-3">
                                <label for="email">Enter Email</label>
                                <input type="email" name="email" class="form-control" 
                                       placeholder="Enter Email *" 
                                       value="{{ old('email', $verification->email) }}" required>
                            </div>

                            <div class="form-group col-lg-12 mb-3">
                                @if(!$verification->email_otp)
                                    <button type="submit" class="btn-style btn-filled btn-filled-2">Send OTP</button>
                                @endif
                            </div>
                        </form>

                        <!-- Step 2: Verify OTP -->
                        @if($verification->email && !$verification->is_email_verified)
                        <form method="POST" action="{{ route('email.verify') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $verification->id }}">

                            <div class="form-group col-lg-12 mb-3">
                                <label for="txt_otp">Enter Email OTP</label>
                                <input type="text" id="txt_otp" name="email_otp" maxlength="6" 
                                       class="form-control" placeholder="Enter OTP here">
                                <span class="alertmsg text-danger">@error('email_otp') {{ $message }} @enderror</span>
                            </div>

                            <div class="form-group col-lg-12 mb-3">
                                <button type="submit" class="btn-style btn-filled btn-filled-2">Verify</button>
                            </div>
                        </form>
                        @endif

                        <!-- Success message -->
                        @if($verification->is_email_verified)
                            <div class="alert alert-success">
                                ✅ Email verified successfully!
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- RIGHT: Login Box -->
            <!-- <div class="col-lg-5 col-md-5 col-12 pr-lg-5 pr-md-5 pr-0 mb-4">
                <div class="section-title-2">
                    <h3><span>Login</span> for EOI</h3>
                </div>

                <div class="home-p-form-wrapper">
                    <div class="home-p-form">
                        <form method="POST" action="{{ route('login.sendOtp') }}">
                            @csrf
                            <div class="form-group col-lg-12 mb-3">
                                <label for="userphone">Registered Email/Mobile</label>
                                <input name="userphone" class="form-control" placeholder="Registered Email/Mobile" required type="text">
                            </div>
                            <div class="form-group col-lg-12 mb-3">
                                <button type="submit" class="btn-style btn-filled btn-filled-2">Send OTP</button>
                            </div>
                        </form>
                        @if(session('login_id'))
                        <form method="POST" action="{{ route('login.verifyOtp') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ session('login_id') }}">
                            <div class="form-group col-lg-12 mb-3">
                                <label for="otp">Enter OTP</label>
                                <input name="otp" class="form-control" placeholder="Enter OTP" required type="text">
                            </div>
                            <div class="form-group col-lg-12 mb-3">
                                <button type="submit" class="btn-style btn-filled btn-filled-2">Verify & Login</button>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    <script>
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(el => {
                el.style.transition = "opacity 0.5s ease";
                el.style.opacity = "0";
                setTimeout(() => el.remove(), 500); // fade-out ke baad remove
            });
        }, 2000);
    </script>
</section>
@endsection