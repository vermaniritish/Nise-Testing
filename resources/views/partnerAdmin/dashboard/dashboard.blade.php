@extends('layouts.partneradminlayout')
@section('content')
<section>
	<div class="header bg-primary pb-6">

		<div class="container-fluid">

			<div class="header-body">

				<div class="row align-items-center py-4">

					<div class="col-lg-8 col-7">

						<h6 class="h2 text-white d-inline-block mb-0">Dashboard : Welcome to NISE Suryamitra Partners Dashboard.</h6>

					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-3 col-md-6">
				  <div class="card card-stats">
					<!-- Card body -->
					<div class="card-body">
					  <div class="row">
						<div class="col">
						  <h5 class="card-title text-uppercase text-muted mb-0">No. of <br/>Participants</h5>
						  <span class="h2 font-weight-bold mb-0">{{$participantCount}}</span>
						</div>
						<div class="col-auto">
						  <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
							<i class="fa fa-users"></i>
						  </div>
						</div>
					  </div>
					  <p class="mt-3 mb-0 text-sm">
						<a href="#"><span class="text-nowrap">+ More Info</span></a>
					  </p>
					</div>
				  </div>
				</div>
				<div class="col-xl-3 col-md-6">
				  <div class="card card-stats">
					<!-- Card body -->
					<div class="card-body">
					  <div class="row">
						<div class="col">
						  <h5 class="card-title text-uppercase text-muted mb-0">Participants <br/>Trained</h5>
						  <span class="h2 font-weight-bold mb-0">620</span>
						</div>
						<div class="col-auto">
						  <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
							<i class="fa fa-graduation-cap"></i>
						  </div>
						</div>
					  </div>
					  <p class="mt-3 mb-0 text-sm">
						&nbsp;
					  </p>
					</div>
				  </div>
				</div>
				<div class="col-xl-3 col-md-6">
				  <div class="card card-stats">
					<!-- Card body -->
					<div class="card-body">
					  <div class="row">
						<div class="col">
						  <h5 class="card-title text-uppercase text-muted mb-0">Participants <br />Placed </h5>
						  <span class="h2 font-weight-bold mb-0">120</span>
						</div>
						<div class="col-auto">
						  <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
							<i class="far fa-id-card"></i>
						  </div>
						</div>
					  </div>
					  <p class="mt-3 mb-0 text-sm">
						&nbsp;
					  </p>
					</div>
				  </div>
				</div>
				<div class="col-xl-3 col-md-6">
				  <div class="card card-stats">
					<!-- Card body -->
					<div class="card-body">
					  <div class="row">
						<div class="col">
						  <h5 class="card-title text-uppercase text-muted mb-0">Participants  <br />Dropout </h5>
						  <span class="h2 font-weight-bold mb-0">21</span> 
						</div>
						<div class="col-auto">
						  <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
							<i class="fa fa-exclamation"></i>
						  </div>
						</div>
					  </div>
					  <p class="mt-3 mb-0 text-sm">
						&nbsp;
					  </p>
					</div>
				  </div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-xl-3 col-md-6">
				  <div class="card card-stats">
					<!-- Card body -->
					<div class="card-body">
					  <div class="row">
						<div class="col">
						  <h5 class="card-title text-uppercase text-muted mb-0">No. of <br/>Batches</h5>
						  <span class="h2 font-weight-bold mb-0">10</span>
						</div>
						<div class="col-auto">
						  <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
							<i class="fas fa-users-class"></i>
						  </div>
						</div>
					  </div>
					  <p class="mt-3 mb-0 text-sm">
						<a href="#"><span class="text-nowrap">+ More Info</span></a>
					  </p>
					</div>
				  </div>
				</div>
				<div class="col-xl-3 col-md-6">
				  <div class="card card-stats">
					<!-- Card body -->
					<div class="card-body">
					  <div class="row">
						<div class="col">
						  <h5 class="card-title text-uppercase text-muted mb-0">On-Going <br />Batchs</h5>
						  <span class="h2 font-weight-bold mb-0">8</span>
						</div>
						<div class="col-auto">
						  <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
							<i class="fas fa-users-class"></i>
						  </div>
						</div>
					  </div>
					  <p class="mt-3 mb-0 text-sm">
						<a href="#"><span class="text-nowrap">+ More Info</span></a>
					  </p>
					</div>
				  </div>
				</div>
				<div class="col-xl-3 col-md-6">
				  <div class="card card-stats">
					<!-- Card body -->
					<div class="card-body">
					  <div class="row">
						<div class="col">
						  <h5 class="card-title text-uppercase text-muted mb-0">Completed <br />Batches </h5>
						  <span class="h2 font-weight-bold mb-0">8</span>
						</div>
						<div class="col-auto">
						  <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
							<i class="fas fa-user-graduate"></i>
						  </div>
						</div>
					  </div>
					  <p class="mt-3 mb-0 text-sm">
						<a href="#"><span class="text-nowrap">+ More Info</span></a>
					  </p>
					</div>
				  </div>
				</div>
				<div class="col-xl-3 col-md-6">
				  <div class="card card-stats">
					<!-- Card body -->
					<div class="card-body">
					  <div class="row">
						<div class="col">
						  <h5 class="card-title text-uppercase text-muted mb-0">New <br />Batches </h5>
						  <span class="h2 font-weight-bold mb-0">821</span> 
						</div>
						<div class="col-auto">
						  <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
							<i class="fas fa-users-class"></i>
						  </div>
						</div>
					  </div>
					  <p class="mt-3 mb-0 text-sm">
						<a href="#"><span class="text-nowrap">+ More Info</span></a>
					  </p>
					</div>
				  </div>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-12 col-md-6 notices">
				<h6 class="h2 text-white d-inline-block mb-0">Notices</h6><br/><br/>
				
					@if(isset($notices) && $notices)
					    @foreach($notices as $key => $notice)
					        <p>
					        	<a href="
				        			@if($notice->file_type == 'pdf')
				                        {{ asset($notice->pdf_file) }}
				                    @elseif($notice->file_type == 'url')
				                        {{ $notice->url }}
				                    @else
				                        {{ route('noticeDetails', $notice->id) }}
				                    @endif
			                    ">{{ $notice->title ?? '' }}
			                    <br/>
					        		<span style="color: #000;"><strong>{{ isset($notice->date) ? \Carbon\Carbon::parse($notice->date)->format('d M Y') : '' }}</strong></span>
					        	</a>
					        </p>
					    @endforeach
					@endif
				</div>
			</div>
		</div>
	</div>
</section>

@endsection