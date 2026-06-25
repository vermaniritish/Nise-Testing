<?php 
use App\Models\Admin\CustomPageData; 
$sliders = \App\Models\Admin\SliderMenu::where('status', 1)->orderBy('id', 'desc')->get();
$logos = CustomPageData::get('courses');
$logos = $logos ? json_decode($logos, true) : null;
$lang = app()->getLocale();
$lang = $lang ? $lang : 'hi';
?>
@extends('layouts.frontendlayout')
@section('content')
<style>
#more {display: none;}
.overlay:before {
    position: absolute;
    content: "";
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(...);
    z-index: 1;
}

.single-wprocess-text {
    position: relative;
    z-index: 2;
}

.overlay:before {
    pointer-events: none;
}

.overlay:before {
    pointer-events: none !important;
}
</style>
	<div class="container-fluid" style="padding:0px;">
	<div class="row">
	<div @if(!Auth::check()) class="col-lg-8 col-md-8 col-12" @else class="col-lg-12 col-md-12 col-12" @endif style="padding:0px;">
		<section class="slider-section">
			<div class="home-slides owl-carousel owl-theme ">
				@foreach($sliders as $s)
				<div class="home-single-slide" data-background="{{ url($s->image) }}">
					<div class="home-slide-overlay"></div>
					<div class="home-single-slide-inner">
						<div class="container">
							<div class="row">
								<div class="col-lg-8 col-md-8 col-12 mr-auto text-left">
									<div class="home-single-slide-dec">
										<h2>{{ $s['heading' . ($lang == 'hi' ? '_hi' : '')] }}</h2>
										<p class="text-capitalize">{{ $s['title' . ($lang == 'hi' ? '_hi' : '')] }} </p>
										@if(isset($s['button_title' . ($lang == 'hi' ? '_hi' : '')]) && $s['button_title' . ($lang == 'hi' ? '_hi' : '')])
										<div class="home-single-slide-button">
											<a href="{{ $s->button_link }}" class="btn-style btn-filled">{{ $s['button_title'. ($lang == 'hi'? '_hi' : '')] }}</a>
										</div>
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</section>
	<!-- END SLIDER SECTION  -->
	</div>
	@if(!Auth::check())
	<div class="col-lg-4 col-md-4 col-12 single-wcus-promo">
		<div class="row">
			<div class="col-12 text-left">
				<div class="section-title-2">
					<h3><span>{{ __('front.Login') }}</span></h3>
				</div>
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
        <form method="POST" action="{{ route('login.sendOtp') }}">
            @csrf
            <div class="form-group col-lg-12 mb-3">
                <label for="userphone"><b>{{__('front.login_section')}}</b></label>
                <input name="userphone" value="{{ old('mobile', session('mobile')) }}" class="form-control" placeholder="Registered Email/Mobile" required type="text">
            </div>
            <div class="form-group col-lg-12 mb-3">
                <button type="submit" class="btn-style btn-filled btn-filled-2">{{ __('front.Send OTP')}}</button>
            </div>
        </form>

        <!-- Step 2: Verify OTP -->
	        @if(session('login_id'))
	        <form method="POST" action="{{ route('login.verifyOtp') }}">
	            @csrf
	            <input type="hidden" name="id" value="{{ session('login_id') }}">
	            <div class="form-group col-lg-12 mb-3">
	                <label for="otp">{{ __('front.Enter OTP') }}</label>
	                <input name="otp" class="form-control" placeholder="{{ __('front.Enter OTP') }}" required type="text">
	            </div>
	            <div class="form-group col-lg-12 mb-3">
	                <button type="submit" class="btn-style btn-filled btn-filled-2">{{ __('front.Verify & Login') }}</button>
	            </div>
	        </form>
	        @endif								
			</div>
		</div>
	</div>
	@endif
</div>
<?php
	$homeAboutUsHeadingEn  = CustomPageData::get('home_about_us_heading');
	$homeAboutUsHeadingHi  = CustomPageData::get('home_about_us_heading_hi');

	$homeAboutUsTitleEn  = CustomPageData::get('home_about_us_title');
	$homeAboutUsTitleHi  = CustomPageData::get('home_about_us_title_hi');

	$homeAboutUsShortDescEn  = CustomPageData::get('home_about_us_short_desc');
	$homeAboutUsShortDescHi  = CustomPageData::get('home_about_us_short_desc_hi');

	$homeAboutUsDescEn  = CustomPageData::get('home_about_us_desc');
	$homeAboutUsDescHi  = CustomPageData::get('home_about_us_desc_hi');

	$homeAboutUsButtonTextEn  = CustomPageData::get('home_about_us_button_text');
	$homeAboutUsButtonTextHi  = CustomPageData::get('home_about_us_button_text_hi');

	$directorDesignationEn  = CustomPageData::get('director_designation');
	$directorDesignationHi  = CustomPageData::get('director_designation_hi');

	$feedbackTitle  = CustomPageData::get('feedback_title');
	$feedbackDesc   = CustomPageData::get('feedback_description');

	$feedbackTitleHi  = CustomPageData::get('feedback_title_hi');
	$feedbackDescHi   = CustomPageData::get('feedback_description_hi');

	$feedbackButtonTitle  = CustomPageData::get('feedback_button_title');
	$feedbackButtonLink  = CustomPageData::get('feedback_button_link');

	$feedbackButtonTitleHi  = CustomPageData::get('feedback_button_title_hi');
	$feedbackButtonLinkHi  = CustomPageData::get('feedback_button_link_hi');

	$serviceTitle  = CustomPageData::get('service_title');
	$serviceShortTitle   = CustomPageData::get('service_short_title');
?>
	<section id="promot" class="section-padding">
    	<div class="auto-container">
			<div class="row">
				
				<div class="col-lg-6 col-md-6 col-12">
					<h6>{{ $lang == 'hi' ? $homeAboutUsTitleHi : $homeAboutUsTitleEn }}</h6>
					<h3>{{ $lang == 'hi' ? $homeAboutUsHeadingHi : $homeAboutUsHeadingEn }}</h3>
					<p><b>{{ $lang == 'hi' ? $homeAboutUsShortDescHi : $homeAboutUsShortDescEn }}</b></p>
					<div><?php echo $lang == 'hi' ? $homeAboutUsDescHi : $homeAboutUsDescEn ?></div>
					@if(CustomPageData::get('home_about_us_button' . ($lang == 'hi' ? '_hi' : '')) == 1)
					<a href="<?php echo CustomPageData::get('home_about_us_button_link' . ($lang == 'hi' ? '_hi' : '')) ?>" class="btn-style btn-border btn-border-2 mt-2">
						{{ $lang == 'hi' ? $homeAboutUsButtonTextHi : $homeAboutUsButtonTextEn }}<i class="icofont icofont-caret-right"></i>
					</a>
					@endif
				</div>
				<div class="col-lg-6 col-md-6 col-12">				
					<div class="single-wcus-promo2">
						<div class="single-wcus-promo-inner">
							<h3>{{$lang == 'hi' ? $feedbackTitleHi : $feedbackTitle}}</h3>
							<div><?php echo $lang == 'hi' ? $feedbackDescHi : $feedbackDesc ?></div>
							@if($feedbackButtonTitle && $lang == 'en')
							<a href="{{$feedbackButtonLink}}" class="btn-style btn-border btn-border-2">{{$feedbackButtonTitle}}</a>
							@endif

							@if($feedbackButtonTitleHi && $lang == 'hi')
							<a href="{{$feedbackButtonLinkHi}}" class="btn-style btn-border btn-border-2">{{$feedbackButtonTitleHi}}</a>
							@endif
						</div>
					</div>
				</div>		
			</div>
    	</div>
  </section>
  <?php
  	$parts = explode(' ', $serviceShortTitle, 2);
		$part1 = $parts[0];        // पहला word
		$part2 = $parts[1] ?? '';
  ?>
	<!-- START NOTICE-LOGIN SECTION -->
    <section id="hworks" class="section-padding bg-gray section-back-image overlay" data-background="{{url('frontend/assets/img/bg/services-bg.jpg')}}">
        <div class="container">
			<div class="row">
				<div class="col-12 text-center">
					<div class="section-title">
						<h5 class="text-white">{{$serviceTitle}}</h5>
						<h3 class="text-white">{{$part1}} <span>{{$part2}}</span></h3>
					</div>
				</div>
			</div>
			<!-- end section title -->
			<div class="row">
				@foreach($notices as $notice)
				<a href="{{route('testServiceDetails',['slug'=> $notice->slug])}}">
				<div class="col-lg-4 col-md-4 col-12 mb-lg-0 mb-md-0 mb-5">
					<div class="single-wprocess">						
						<div class="single-wprocess-text">
							<h5>{!! $notice['main_heading'.($lang=='hi' ? '_hi' : '')] !!}</h5>
							<p class="shortInfo">{{ Str::limit(strip_tags($notice['description'.($lang=='hi' ? '_hi' : '')]),150) }}</p>
							<p>
								<a href="{{route('testServiceDetails',['slug'=> $notice->slug])}}">{{__('front.Read More')}}</a>
							</p>
						</div>
					</div>
				</div>
				</a>
				@endforeach
			</div>
     	</div>
        <!--- END CONTAINER -->
    </section> 
@endsection