<?php 
use App\Models\Admin\CustomPageData;
use Illuminate\Support\Str;
?>
@extends('layouts.frontendlayout')
@section('content')
<?php $lang = app()->getLocale();?>
<section id="page-banner">
	<div class="single-page-title-area-bottom">
		<div class="auto-container">
			<div class="row">
				<div class="col-12 text-center">
					<div id="ost-container">
						<div class="ost-multi-header">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('home.index')}}">Home</a></li>
								<li class="breadcrumb-item active">Notice Detail</li>
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
<section id="blog" class="section-padding">
	<div class="container">	 
		<div class="row">
			<div class="col-12">
				<div class="blog-single-des">
					<div class="row mb-5">
						@if($lang == 'en')
						<div class="col-md-12 ser-page-into">
							<h4>{{ $notice->title ?? '' }}</h4>
						    @if(isset($notice->file_type))
							    @switch($notice->file_type)
							        @case('content')
							            <p>{!! $notice->description ?? '' !!}</p>
							        @break
							        @case('url')
							            @php
										    $url = $notice->url ?? '';
										    $videoId = '';

										    if (preg_match('/youtu\.be\/([^\?]+)/', $url, $matches)) {
										        $videoId = $matches[1]; // short URL
										    } elseif (preg_match('/v=([^\&]+)/', $url, $matches)) {
										        $videoId = $matches[1]; // normal URL
										    }
										@endphp

							            @if($videoId)
							                <div class="video-container" style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;">
										        <iframe src="https://www.youtube.com/embed/{{ $videoId }}"
										                frameborder="0"
										                allowfullscreen
										                style="position:absolute;top:0;left:0;width:100%;height:100%;">
										        </iframe>
										    </div>
							            @else
							                {{-- Normal Link --}}
							                <p><a href="{{ $url }}" target="_blank">{{ $url }}</a></p>
							            @endif
							        @break
							        @case('pdf')
							            @if(!empty($notice->pdf_file))
							                <div class="pdf-viewer" style="margin-bottom:15px;">
							                    <iframe src="{{ url($notice->pdf_file) }}"
							                            width="100%" height="600px" style="border:none;"></iframe>
							                </div>
							                <p><a href="{{ url($notice->pdf_file) }}" target="_blank" class="btn btn-primary">Download PDF</a></p>
							            @endif
							        @break

							        {{-- ✅ IMAGE TYPE (if added later) --}}
							        @case('image')
							            @if(!empty($notice->image))
							                <div class="image-preview">
							                    <img src="{{ url($notice->image) }}" alt="News Image" style="max-width:100%;height:auto;">
							                </div>
							            @endif
							        @break

							    @endswitch
							@endif

						</div>
						@else

						<div class="col-md-12 ser-page-into">
							<h4>{{isset($notice->title_hi) && $notice->title_hi ? $notice->title_hi : ''}}</h4>
							@if(isset($notice->file_type_hi))
						        @if($notice->file_type_hi == 'content_hi')
						            <p>{!! isset($notice->description_hi) && $notice->description_hi ? $notice->description_hi : '' !!}</p>

						        @elseif($notice->file_type_hi == 'url_hi')
						            @php
						                $url = $notice->url_hi ?? '';
										echo $url; die;
						                $isYoutube = Str::contains($url, ['youtube.com', 'youtu.be']);
						            @endphp

						            @if($isYoutube)
						                {{-- YouTube embed --}}
						                <div class="video-container" style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;">
						                    <iframe src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::afterLast(parse_url($url, PHP_URL_PATH), '/') }}"
						                        frameborder="0"
						                        allowfullscreen
						                        style="position:absolute;top:0;left:0;width:100%;height:100%;">
						                    </iframe>
						                </div>
						            @else
						                {{-- Normal link --}}
						                <p><a href="{{ $url }}" target="_blank">{{ $url }}</a></p>
						            @endif

						        @elseif($notice->file_type_hi == 'pdf_hi')
						            @if(!empty($notice->pdf_file_hi))
						                {{-- PDF embed --}}
						                <iframe src="{{ url($notice->pdf_file_hi) }}"
						                        width="100%" height="600px" style="border:none;"></iframe>
						                <p><a href="{{ url($notice->pdf_file_hi) }}" target="_blank">Download PDF</a></p>
						            @endif
						        @endif
						    @endif
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection