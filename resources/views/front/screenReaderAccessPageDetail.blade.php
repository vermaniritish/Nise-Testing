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
								<li class="breadcrumb-item active">{{isset($scrRedrAcc[0]->title) && $scrRedrAcc[0]->title ? $scrRedrAcc[0]->title : ''}}</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<!-- end row-->
		</div>
	</div>
</section>
<section id="blog" class="section-padding">
	<div class="container">	 
		<div class="row">
			<div class="col-lg-12 col-md-12 col-12 pr-lg-5 pr-md-5 pr-sm-0 pr-0 mb-lg-0 mb-md-4 mb-sm-4 mb-4">
				<div class="blog-single-des">
					<div class="row mb-5">
						<div class="col-12 ser-page-into">
							<h4>{{isset($scrRedrAcc[0]->title) && $scrRedrAcc[0]->title ? $scrRedrAcc[0]->title : ''}}</h4>
							{!! isset($scrRedrAcc[0]->description) && $scrRedrAcc[0]->description ? $scrRedrAcc[0]->description : '' !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection