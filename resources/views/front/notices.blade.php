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
								<li class="breadcrumb-item active">Notices</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>		
<div class="row">
	<div class="col-lg-1 col-md-1 col-12 pr-lg-5 pr-md-5 pr-sm-0 pr-0 mb-lg-0 mb-md-4 mb-sm-4 mb-4">&nbsp;</div>
	<div class="col-lg-10 col-md-10 col-12 pr-lg-5 pr-md-5 pr-sm-0 pr-0 mb-lg-0 mb-md-4 mb-sm-4 mb-4">
		<div class="table-responsive">
			<table class="bitland-table table table-striped table-hover">
				<thead>
					<tr>
						<th scope="col">
							<span class="lang-en">S.no.</span>
							<span class="lang-hi" style="display:none;">क्रम संख्या</span>
						</th>
						<th scope="col">
							<span class="lang-en">Notice</span>
							<span class="lang-hi" style="display:none;">सूचना</span>
						</th>
						<th scope="col">
							<span class="lang-en">Date</span>
							<span class="lang-hi" style="display:none;">तिथि</span>
						</th>
					</tr>
				</thead>
				<tbody>
					@if(isset($notices) && $notices)
					    @foreach($notices as $key => $notice)
					        <tr>
					            <td>{{ $key + 1 }}</td>
					            <td>
					                <a href="
					                    @if($notice->file_type == 'pdf')
					                        {{ asset($notice->pdf_file) }}
					                    @elseif($notice->file_type == 'url')
					                        {{ $notice->url }}
					                    @else
					                        {{ route('noticeDetails', $notice->id) }}
					                    @endif
					                " target="_blank" style="color:#000;">
					                    <span class="lang-en">
					                        {{ $notice->title ?? '' }}
					                    </span>
					                    @if($notice->is_new) 
						                    <img src="{{ asset('frontend/assets/img/new.png') }}">
						                @endif
					                    <span class="lang-hi" style="display:none;">
					                        {{ $notice->title_hi ?? '' }}
					                    </span>
					                </a>
					            </td>
					            <td>
					                <span style="color: #f7921a;">
					                    {{ isset($notice->date) ? \Carbon\Carbon::parse($notice->date)->format('d M Y') : '' }}
					                </span>
					            </td>
					        </tr>
					    @endforeach
					@endif

				</tbody>
			</table>
		</div>
		
		<div class="theme-pagination mb-lg-0 mb-md-0 mb-5">
			<div class="navbar justify-content-center">
			  <ul class="pagination">
				{{ $notices->links('pagination::bootstrap-4') }}
			  </ul>
			</div>
		</div>
		<!-- end blog pagination -->
	</div>
	<div class="col-lg-1 col-md-1 col-12 pr-lg-5 pr-md-5 pr-sm-0 pr-0 mb-lg-0 mb-md-4 mb-sm-4 mb-4">&nbsp;</div>
</div>
@endsection