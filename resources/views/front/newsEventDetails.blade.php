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
								<li class="breadcrumb-item active">News & Event Detail</li>
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
			<div class="col-lg-8 col-md-8 col-12 pr-lg-5 pr-md-5 pr-sm-0 pr-0 mb-lg-0 mb-md-4 mb-sm-4 mb-4">
				<div class="blog-single-des">
					<div class="row mb-5">
						<div class="col-12 ser-page-into lang-en">
							<h4>{{ $newsEvent->title ?? '' }}</h4>
						    @if(isset($newsEvent->file_type))
							    @switch($newsEvent->file_type)
							        @case('content')
							            <p>{!! $newsEvent->description ?? '' !!}</p>
							        @break
							        @case('url')
							            @php
										    $url = $newsEvent->url ?? '';
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
							            @if(!empty($newsEvent->pdf_file))
							                <div class="pdf-viewer" style="margin-bottom:15px;">
							                    <iframe src="{{ url($newsEvent->pdf_file) }}"
							                            width="100%" height="600px" style="border:none;"></iframe>
							                </div>
							                <p><a href="{{ url($newsEvent->pdf_file) }}" target="_blank" class="btn btn-primary">Download PDF</a></p>
							            @endif
							        @break

							        {{-- ✅ IMAGE TYPE (if added later) --}}
							        @case('image')
							            @if(!empty($newsEvent->image))
							                <div class="image-preview">
							                    <img src="{{ url($newsEvent->image) }}" alt="News Image" style="max-width:100%;height:auto;">
							                </div>
							            @endif
							        @break

							    @endswitch
							@endif

						</div>


						<div class="col-12 ser-page-into lang-hi" style="display:none;">
							<h4>{{isset($newsEvent->title_hi) && $newsEvent->title_hi ? $newsEvent->title_hi : ''}}</h4>
							@if(isset($newsEvent->file_type))
						        @if($newsEvent->file_type == 'content')
						            <p>{!! isset($newsEvent->description_hi) && $newsEvent->description_hi ? $newsEvent->description_hi : '' !!}</p>

						        @elseif($newsEvent->file_type == 'url')
						            @php
						                $url = $newsEvent->url ?? '';
						                $isYoutube = preg_match('/(youtube\.com|youtu\.be)/', $url);
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

						        @elseif($newsEvent->file_type == 'pdf')
						            @if(!empty($newsEvent->pdf_file))
						                {{-- PDF embed --}}
						                <iframe src="{{ asset('storage/'.$newsEvent->pdf_file) }}"
						                        width="100%" height="600px" style="border:none;"></iframe>
						                <p><a href="{{ asset('storage/'.$newsEvent->pdf_file) }}" target="_blank">Download PDF</a></p>
						            @endif
						        @endif
						    @endif
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-12 pr-lg-5 pr-md-5 pr-sm-0 pr-0 mb-lg-0 mb-md-4 mb-sm-4 mb-4">
				<div class="widget cat_wid mb-5">
					<h3 class="widget-title lang-en">Recent Notices</h3>
					<h3 class="widget-title lang-hi" style="display:none;">नवीनतम सूचनाएँ</h3>
						<div class="widget-inner mt-5">
							<!-- @if(isset($newsEvents) && $newsEvents)
								@foreach($newsEvents as $k => $newsE)
								<h6 class="blog-recTitle lang-en">
									<a href="{{route('newsEventDetails',['id' => $newsE->id])}}">{{isset($newsE->title) && $newsE->title ? Str::limit($newsE->title,35) : ''}}</a>
								</h6>
								<p class="posted-on lang-en">
									{{ isset($newsE->date) ? \Carbon\Carbon::parse($newsE->date)->format('d M Y') : '' }}
								</p>

								<h6 class="blog-recTitle lang-hi" style="display:none;" >
									<a href="{{route('newsEventDetails',['id' => $newsE->id])}}">{{isset($newsE->title_hi) && $newsE->title_hi ? Str::limit($newsE->title_hi,35) : ''}}</a>
								</h6>
								<p class="posted-on lang-hi" style="display:none;">
									{{ isset($newsE->date) ? \Carbon\Carbon::parse($newsE->date)->format('d M Y') : '' }}
								</p>
								<br/>
								@endforeach
							@endif -->
							@if(!empty($newsEvents))
							    @foreach($newsEvents as $newsE)
							        @php
							            // Determine the file URL based on file_type
							            $fileUrl = '#';
							            if ($newsE->file_type == 'pdf' && !empty($newsE->pdf_file)) {
							                $fileUrl = asset($newsE->pdf_file);
							            } elseif ($newsE->file_type == 'url' && !empty($newsE->url)) {
							                $fileUrl = $newsE->url;
							            } elseif ($newsE->file_type == 'content') {
							                $fileUrl = route('newsEventDetails', ['id' => $newsE->id]);
							            }

							            // Titles
							            $title_en = isset($newsE->title) ? Str::limit($newsE->title, 35) : '';
							            $title_hi = isset($newsE->title_hi) ? Str::limit($newsE->title_hi, 35) : '';

							            // Date
							            $date = isset($newsE->date) ? \Carbon\Carbon::parse($newsE->date)->format('d M Y') : '';
							        @endphp

							        <div class="blog-item">
							            {{-- English --}}
							            <h6 class="blog-recTitle lang-en">
							                <a href="{{ $fileUrl }}" target="_blank">{{ $title_en }}</a>
							            </h6>
							            <p class="posted-on lang-en">{{ $date }}</p>

							            {{-- Hindi --}}
							            <h6 class="blog-recTitle lang-hi" style="display:none;">
							                <a href="{{ $fileUrl }}" target="_blank">{{ $title_hi }}</a>
							            </h6>
							            <p class="posted-on lang-hi" style="display:none;">{{ $date }}</p>
							        </div>
							        <br/>
							    @endforeach
							@endif

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.querySelector('input[name="search"]');
    const notices = document.querySelectorAll('.blog-recTitle.lang-en, .blog-recTitle.lang-hi');

    searchInput.addEventListener("input", function () {
        const searchValue = this.value.toLowerCase();

        notices.forEach(function (notice) {
            const text = notice.innerText.toLowerCase();
            const parentBlock = notice.closest('h6').parentElement;

            if (text.includes(searchValue) || searchValue === "") {
                notice.style.display = "";
                // saath me date bhi dikhana
                let dateTag = notice.nextElementSibling;
                if (dateTag && dateTag.classList.contains('posted-on')) {
                    dateTag.style.display = "";
                }
            } else {
                notice.style.display = "none";
                let dateTag = notice.nextElementSibling;
                if (dateTag && dateTag.classList.contains('posted-on')) {
                    dateTag.style.display = "none";
                }
            }
        });
    });

    // Placeholder clear kare on focus
    searchInput.addEventListener("focus", function () {
        if (this.value === "") {
            this.value = "";
        }
    });

    // Default value restore kare on blur
    searchInput.addEventListener("blur", function () {
        if (this.value.trim() === "") {
            this.value = "";
        }
    });
});
</script>
@endsection