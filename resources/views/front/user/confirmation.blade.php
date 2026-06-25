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
									<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('front.Home') }}</a></li>
									<li class="breadcrumb-item active">Register</li>
								</ol>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- END PAGE BANNER AND BREADCRUMBS -->
	
	<!-- START ABOUT PROMO SECTION -->
    <section id="faqpage" class="section-padding">
        <div class="container">	 
			<div class="row mb-5">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12 pr-lg-5 pr-md-5 pr-sm-0 pr-0 mb-lg-0 mb-md-0 mb-sm-5 mb-5 faq-page-into">
					<h6>Confirmation!</h6>
					<h3>Thank you for <span> Enroling & Registering</span></h3>
					<p>We have sent you a confirmation email on your official email. Please check and login</p>
				</div>					
			</div>
		</div>
	</section>
@endsection
