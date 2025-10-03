<?php
use App\Models\Admin\Gallery;

$lists = Gallery::where('status', '=', 1)->get();
$images = json_decode($images, true) ?? [];

$prefix = Route::current()->getPrefix();
$prefix = $prefix ? str_replace('/', '_', $prefix) : '';

?>
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
                                <li class="breadcrumb-item active">Photo Gallery</li>
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
    
<section id="gallery" class="section-padding">
    <div class="container">
        <div class="row">
            <!-- end col -->
            <div class="col-lg-9 col-md-9 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="grid">

                            @if ($images)
                                @foreach ($images as $image)
                                    @if (rand(0, 1))
                                        <!-- Randomly choose between 0 and 1 -->
                                        <div class="grid-item entry">
                                            <a href="{{ asset($image) }}" data-title="IMAGE TITLE 1"
                                                class="venobox info vbox-item" data-gall="galma">
                                                <img class="img-fluid" src="{{ asset($image) }}" alt="">
                                            </a>
                                        </div>
                                    @else
                                        <div class="grid-item grid-item--width2 entry">
                                            <a href="{{ asset($image) }}" data-title="IMAGE TITLE 2"
                                                class="venobox info vbox-item" data-gall="galma">
                                                <img class="img-fluid" src="{{ asset($image) }}" alt="">
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                Sorry, We don't have images yet.
                            @endif
                            </NAv>

                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    {{-- <div class="col-12">
                        <a href="#" class="btn-style btn-filled btn-filled-2 d-block text-center">Load
                            More...</a>
                    </div> --}}
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!--- END CONTAINER -->
</section>
@endsection