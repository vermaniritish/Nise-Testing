<?php 
use App\Models\Admin\CustomPageData; 
$sliders = \App\Models\Admin\SliderMenu::where('status', 1)->orderBy('id', 'desc')->get();
$logos = CustomPageData::get('courses');
$logos = $logos ? json_decode($logos, true) : null;
?>
@extends('layouts.frontendlayout')
@section('content')
<style>
#more {display: none;}
</style>
	<div class="container-fluid" style="padding:0px;">
	<div class="row">
	<div class="col-lg-8 col-md-8 col-12" style="padding:0px;">
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
										<h2>{{ $s->title }}</h2>
										<p class="text-capitalize">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
										@if(isset($s->button_title) && $s->button_title)
										<div class="home-single-slide-button">
											<a href="{{ $s->button_link }}" class="btn-style btn-filled">{{ $s->button_title }}</a>
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
	<div class="col-lg-4 col-md-4 col-12 single-wcus-promo">
		<div class="row">
			<div class="col-12 text-left">
				<div class="section-title-2">
					<h3><span>Login</span></h3>
				</div>
				
				<form action="#">
				<div class="section-title-2">
				<div class="row">	
					<div class="form-group col-lg-12 mb-3">
						<label for="userphone">Please provide Registered Mobile Number</label>
						<input name="userphone" class="form-control" id="userphone" placeholder="Registered Mobile Number" required="required" type="tel" style="width: 93%;">
					</div>
					
					<div class="form-group col-lg-12 mb-3">
						<label for="txt_Captcha">OTP</label>
						<input name="userpass" class="form-control" id="userpass" placeholder="Password*" required="required" type="password" style="width: 93%;">
					</div>
					<div class="form-group col-lg-12 mb-3">
						<a href="userdasboard.php" title="Click here to submit your message!" class="btn-style btn-filled btn-filled-2">Submit</a>
					</div>
					
					<div class="form-group col-lg-12 mb-3">
						<p><b>New User?</b> <a href="sign-up.php">Register Here</a></p>
					</div>
				</div>
				</div>
				</form>								
			</div>
		</div>
	</div>
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

	$feedbackButtonTitle  = CustomPageData::get('feedback_button_title');
	$feedbackButtonLink  = CustomPageData::get('feedback_button_link');

	$serviceTitle  = CustomPageData::get('service_title');
	$serviceShortTitle   = CustomPageData::get('service_short_title');
?>
	<section id="promot" class="section-padding">
    <div class="auto-container">
			<div class="row">
				
				<div class="col-lg-6 col-md-6 col-12">
					<h6>{{ $homeAboutUsTitleEn }}</h6>
					<h3>{{ $homeAboutUsHeadingEn }}</h3>
					<p><b>{{ $homeAboutUsShortDescEn }}</b></p>
					<p style="margin-bottom: 0px;font-weight: 400;">{{ strip_tags($homeAboutUsDescEn) }}</p>
					@if(CustomPageData::get('home_about_us_button') == 1)
					<a href="<?php echo CustomPageData::get('home_about_us_button_link') ?>" class="faq-page-into-btn mt-4">
						{{ $homeAboutUsButtonTextEn }}<i class="icofont icofont-caret-right"></i>
					</a>
					@endif
				</div>
				<div class="col-lg-6 col-md-6 col-12">				
					<div class="single-wcus-promo2">
						<div class="single-wcus-promo-inner">
							<h3>{{$feedbackTitle}}</h3>
							<p>{!! $feedbackDesc !!}</p>
							<a href="{{$feedbackButtonLink}}" class="btn-style btn-border btn-border-2">{{$feedbackButtonTitle}}</a>
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
				<div class="col-lg-4 col-md-4 col-12 mb-lg-0 mb-md-0 mb-5">
					<div class="single-wprocess">
						
						<div class="single-wprocess-text">
							<a href="{{$notice->url}}" class="boxContent">
							<h5>{!! $notice->title !!}</h5>
							<p class="shortInfo">{{$notice->description}}</p>
							<p>
								<a href="{{$notice->url}}">{{$notice->button_title}}</a>
							</p>
							</a>
						</div>
						
					</div>
				</div>
				@endforeach
			</div>
     </div>
        <!--- END CONTAINER -->
    </section>      
	@endsection
<script>
function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Read more"; 
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Read less"; 
    moreText.style.display = "inline";
  }
}
</script>