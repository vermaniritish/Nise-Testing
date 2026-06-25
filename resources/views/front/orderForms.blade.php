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
									<li class="breadcrumb-item active">Order Forms</li>
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

	<!-- START NOTICE-LOGIN SECTION -->
    <section id="promot" class="section-padding">
        <div class="auto-container">
			<div class="row">
				
				<div class="col-lg-12 col-md-12 col-12">
					<table class="table table-bordered">
					    <thead>
					        <tr>
					            <th>S.No</th>
					            <th>Laboratory</th>
					            <th>Form No</th>
					            <th>Name</th>
					        </tr>
					    </thead>

					    <tbody>
					    @php $main = 1; @endphp

					    @foreach ($testSerCategories as $labId => $items)

					        @php
					            $labName = optional($items->first())->testing_service_title ?? 'Laboratory';
					            $rowspan = $items->count();
					            $child = 1; // reset child counter per lab
					        @endphp

					        @foreach ($items as $index => $item)
					            <tr>

					                {{-- Main S.No (1, 2, 3...) --}}
					                @if ($index == 0)
					                    <td rowspan="{{ $rowspan }}">{{ $main++ }}</td>
					                @endif

					                {{-- Laboratory Name --}}
					                @if ($index == 0)
					                    <td rowspan="{{ $rowspan }}">{{ $labName }}</td>
					                @endif

					                {{-- Form No (1.1, 1.2, 1.3...) --}}
					                <td>{{ $main-1 }}.{{ $child++ }}</td>

					                {{-- Name / File --}}
					                <td>
					                    @if ($item->sample_file)
					                        <a href="{{ asset($item->sample_file) }}" target="_blank">
					                            {{ $item->test_category_title }}
					                        </a>
					                    @else
					                        {{ $item->test_category_title }}
					                    @endif
					                </td>

					            </tr>
					        @endforeach

					    @endforeach
					    </tbody>
					</table>

					
				</div>
				
							
			</div>
        </div>
        <!--- END CONTAINER -->
    </section>
    <!-- END NOTICE-LOGIN SECTION -->
@endsection