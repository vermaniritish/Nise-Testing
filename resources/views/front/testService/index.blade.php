<?php use App\Models\Admin\CustomPageData; ?>
@extends('layouts.frontendlayout')
@section('content')

<?php
	$serviceTitle  = CustomPageData::get('service_title');
	$serviceShortTitle   = CustomPageData::get('service_short_title');
	$parts = explode(' ', $serviceShortTitle, 2);
	$part1 = $parts[0];        // पहला word
	$part2 = $parts[1] ?? '';
?>
<section id="page-banner">
		
		<div class="single-page-title-area-bottom">
			<div class="auto-container">
				<div class="row">
					<div class="col-12 text-center">
						<div id="ost-container">
							<div class="ost-multi-header">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item active">Testing Services</li>
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
							<a href="service-photovoltaic-module.php" class="boxContent">
							<h5>{!! $notice->title !!}</h5>
							<p class="shortInfo">{{$notice->description}}</p>
							<p><a href="{{$notice->url}}">{{$notice->button_title}}</a></p>
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