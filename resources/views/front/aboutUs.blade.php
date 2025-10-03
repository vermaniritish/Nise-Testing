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
    <section id="faqpage" class="section-padding">
        <div class="container">	 
			<div class="row mb-5">
				<div class="col-lg-6 col-md-6 col-sm-12 col-12 pr-lg-5 pr-md-5 pr-sm-0 pr-0 mb-lg-0 mb-md-0 mb-sm-5 mb-5 faq-page-into">
					<h6>About Us</h6>
					<h3>
						<span class="lang-en">{{ $aboutUsTitleEn }}</span>
						<span class="lang-hi" style="display:none;">{{ $aboutUsTitleHi }}</span>
					</h3>
					<span class="lang-en">{{ strip_tags($aboutUsDescEn) }}</span>
					<span class="lang-hi" style="display:none;">{{ strip_tags($aboutUsDescHi) }}</span>
				</div>
				<!-- end col -->
				<div class="col-lg-6 col-md-6 col-sm-12 col-12">
					<div class="faq-page-into-features mb-5">
						<div class="faq-page-into-features-icon">
							<img src="<?php echo url(CustomPageData::get('director_image')) ?>" alt="Dr. Mohammad Rihan" style="height: 120px;box-shadow: 0px 0px 20px 8px #eee;border-radius: 5px 5px 5px 5px;" />
						</div>
						<div class="faq-page-into-features-text">
							<h5 style="margin-bottom:5px;">
								<span class="lang-en">{{ $directorTitleEn }}</span>
								<span class="lang-hi" style="display:none;">{{ $directorTitleHi }}</span>
							</h5>
							<h6>
								<span class="lang-en">{{ $directorSubTitleEn }}</span>
								<span class="lang-hi" style="display:none;">{{ $directorSubTitleHi }}</span>
							</h6>
							<p style="margin-bottom: 0px;font-weight: 400;">
								<span class="lang-en">{{ strip_tags($directorDescEn) }}</span>
								<span class="lang-hi" style="display:none;">{{ strip_tags($directorDescHi) }}</span>
							</p>
							<button onclick="myFunction()" id="myBtn" class="faq-page-into-btn mt-4">Read more <i class="icofont icofont-caret-right"></i></button>	
						</div>
					</div>
				</div>
				<!-- end col -->					
			</div>
		</div>
	</section>
@endsection