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
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="testing-services.php">Testing Services</a></li>
                                <li class="breadcrumb-item active">
                                    {{ $serviceDetail->title ?? '' }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- START SERVICE SECTION -->
<section id="service" class="section-padding">
    <div class="auto-container">    
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-12 mb-lg-0 mb-md-0 mb-5 pr-lg-5 pr-md-5 pr-sm-2 pr-2">
                <div class="widget cat_wid mb-5">
                    <h3 class="widget-title">Testing Service for:</h3>
                    <div class="widget-inner mt-4">
                        <div class="category-menu">
                            <ul>
                                @if(isset($testingServices) && $testingServices)
                                    @foreach($testingServices as $testServ)
                                        <li>
                                            <a href="{{ route('testServiceDetails', ['slug'=> $testServ->slug]) }}" class="active">
                                                {{ $testServ->title ?? '' }}
                                                <i class="float-right icofont icofont-thin-right"></i>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="widget bo_wid mb-3">
                    <h3 class="widget-title">Downloads</h3>
                    <div class="widget-inner mt-4">
                        <div class="category-menu">
                            <ul>
                                <li>
                                    <a href="https://nise.res.in/wp-content/uploads/2018/07/User-Manual-Online-Testing-Service-at-NISE-csc.pdf" target="_blank">
                                        User Manuals <i class="float-right icofont icofont-file-powerpoint"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="order-forms.php">
                                        Order Forms <i class="float-right icofont icofont-law-document"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @php 
                $userId = Auth::user();
            @endphp
            <div class="col-lg-8 col-md-8 col-12">
                <div class="row">
                    <div class="col-12 ser-page-into">
                        <h4>{{$serviceDetail->main_heading}}</h4>
                        {!! $serviceDetail->description ?? '' !!}
                        @if(isset($userId) && $userId)
                            <div style="background: #f1bf01; color:#ffffff; padding:13px 0;" class="text-center">
                                <p class="text-uppercase" style="display:inline-block; margin-bottom:0;">
                                    <strong>Select testing service to order:</strong>
                                </p>
                                <select class="selectpickerr show-tick" id="selectOption" 
                                    title="Select testing service" 
                                    onchange="window.location = jQuery('#selectOption option:selected').val();">
                                    <option value="">Select</option>
                                    @if(isset($testServCategories) && $testServCategories)
                                        @foreach($testServCategories as $testServCat)
                                            <option value="{{ route('testServiceCategoryDetails', ['slug'=> $testServCat->slug]) }}">
                                                {{ $testServCat->test_category_title ?? '' }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @else
                            <div class="col-lg-8 col-md-8 col-12">
                                <div class="alert alert-warning text-center mt-3">
                                    <strong>Please login to create an order.</strong> <br>
                                    <a href="{{ route('home.index') }}" class="btn btn-primary mt-2">Login Now</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
