<?php
use App\Models\Admin\Gallery;

$lists = Gallery::where('status', '=', 1)->get();
$videos = json_decode($videos, true) ?? [];

$prefix = Route::current()->getPrefix();
$prefix = $prefix ? str_replace('/', '_', $prefix) : '';

?>
@extends('layouts.frontendlayout')
@section('content')
<style>
.video-container {
    position:relative;
    padding-bottom:56.25%;
    padding-top:30px;
    height:0;
    overflow:hidden;
}

.video-container iframe, .video-container object, .video-container embed {
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
}
</style>
<section id="page-banner">
    
    <div class="single-page-title-area-bottom">
        <div class="auto-container">
            <div class="row">
                <div class="col-12 text-center">
                    <div id="ost-container">
                        <div class="ost-multi-header">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home.index')}}">Home</a></li>
                                <li class="breadcrumb-item active">Video Gallery</li>
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
    
<section id="service" class="section-padding">
        <div class="container">  
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-lg-0 mb-md-0 mb-5 pr-lg-5 pr-md-5 pr-sm-2 pr-2">
                    <div class="row">
                        @if ($videos)
                            @foreach ($videos as $video)
                                @if (rand(0, 1))
                                    <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                                        <div class="video-container" style="position: relative;">
                                            <iframe loading="lazy"
                                                    src="{{ $video }}"
                                                    width="100%" height="315"
                                                    frameborder="0"
                                                    allowfullscreen="allowfullscreen">
                                            </iframe>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                                        <div class="video-container" style="position: relative;">
                                            <iframe loading="lazy"
                                                    src="{{ $video }}"
                                                    width="100%" height="315"
                                                    frameborder="0"
                                                    allowfullscreen="allowfullscreen">
                                            </iframe>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            Sorry, We don't have Videos yet.
                        @endif

                    </div>
                </div>
            <!-- end row -->
            </div>
        <!--- END CONTAINER -->
        </div>
    </section>
@endsection