<?php use App\Models\Admin\CustomPageData; ?>
@extends('layouts.frontendlayout')
@section('content')

<section id="page-banner">
		<div class="single-page-title-area-bottom">
			<div class="auto-container">
				<div class="row">
					<div class="col-12 text-center">
						<div id="ost-container">
							<div class="ost-multi-header">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{route('home.index')}}">Home</a></li>
									<li class="breadcrumb-item active">About us</li>
								</ol>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
		$aboutUsTitleEn  = CustomPageData::get('about_us_title');
		$aboutUsTitleHi  = CustomPageData::get('about_us_title_hi');

		$aboutUsDescEn  = CustomPageData::get('about_us_desc');
		$aboutUsDescHi  = CustomPageData::get('about_us_desc_hi');

		$directorTitleEn  = CustomPageData::get('director_title');
		$directorTitleHi  = CustomPageData::get('director_title_hi');

		$directorSubTitleEn  = nl2br(CustomPageData::get('sub_title'));
		$directorSubTitleHi  = nl2br(CustomPageData::get('sub_title_hi'));

		$directorDescEn  = nl2br(CustomPageData::get('director_desc'));
		$directorDescHi  = nl2br(CustomPageData::get('director_desc_hi'));
	?>
	<!-- START ABOUT PROMO SECTION -->
    <?php
		$aboutUsTitleEn  = CustomPageData::get('about_us_title');
		$aboutUsTitleHi  = CustomPageData::get('about_us_title_hi');

		$aboutUsDescEn  = CustomPageData::get('about_us_desc');
		$aboutUsDescHi  = CustomPageData::get('about_us_desc_hi');

		$feedbackTitleEn  = CustomPageData::get('feedback_title');
		$directorTitleHi  = CustomPageData::get('feedback_title_hi');

		$feedbackDescription  = nl2br(CustomPageData::get('feedback_description'));
		$directorDescHi  = nl2br(CustomPageData::get('feedback_description_hi'));

		$feedbackBtnTitle  = CustomPageData::get('feedback_button_title');
		$feedbackBtnLink  = CustomPageData::get('feedback_button_link');
	?>
	<section id="promot" class="section-padding">
	    <div class="auto-container">
		<div class="row">
			
			<div class="col-lg-6 col-md-6 col-12">
				<h6>About Us</h6>
				<!-- <h3> NISE <span>Testing Services</span></h3> -->
				<h3>{{ $aboutUsTitleEn }}</h3>
				<p><?php echo $aboutUsDescEn ?></p>
			</div>
			<div class="col-lg-6 col-md-6 col-12">				
				<div class="single-wcus-promo2">
					<div class="single-wcus-promo-inner">
						<h3>{{ $feedbackTitleEn }}</h3>
						<p>{!! $feedbackDescription !!}</p>
						<a href="{{$feedbackBtnLink}}" class="btn-style btn-border btn-border-2">{{$feedbackBtnTitle}}</a>
					</div>
				</div>
			</div>
			<!-- end col -->	
						
		</div>
	</div>
	<!--- END CONTAINER -->
	</section>
@endsection