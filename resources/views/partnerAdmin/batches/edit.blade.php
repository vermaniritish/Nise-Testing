@extends('layouts.partneradminlayout')
@section('content')

<section>

<div class="header bg-primary pb-6">

	<div class="container-fluid">

		<div class="header-body">

			<div class="row align-items-center py-4">

				<div class="col-lg-6 col-7">

					<h6 class="h2 text-white d-inline-block mb-0">Batch Management</h6>

				</div>

				<div class="col-lg-6 col-5 text-right">

					<a href="batchs.php" class="btn btn-neutral"><i class="ni ni-bold-left"></i> Back</a>

				</div>

			</div>

		</div>

	</div>

</div>

<!-- Page content -->

<div class="container-fluid mt--6">

	<div class="row">

		<div class="col-xl-12 order-xl-1">

	        <div class="card">

				<div class="flash-message">

	        </div>				
        	<div class="card-header">

					<div class="row align-items-center">

						<div class="col-8">

							<h3 class="mb-0">Edit/Update Batch Here.</h3>

						</div>

					</div>

				</div>

				<div class="card">
			    <div class="card-body">
				    <form action="{{ isset($batch) ? route('partnerAdmin.manageBatche.edit', $batch->id) : route('partnerAdmin.manageBatche.add') }}" method="post" enctype="multipart/form-data">
				        @csrf
				        <div class="row">

				            <!-- Center -->
				            <div class="form-group col-md-6">
				                <label>Center <span class="text-danger">*</span></label>
				                <select name="center_id" id="center_id" class="form-control" required>
				                    <option value="">Select Center</option>
				                    @foreach($centers as $center)
				                        <option value="{{ $center->id }}" {{ (isset($batch) && $batch->center_id == $center->id) ? 'selected' : '' }}>
				                            {{ $center->title }} ({{ $center->slug }})
				                        </option>
				                    @endforeach
				                </select>
				            </div>

				            <!-- Academic Session -->
				            <div class="form-group col-md-6">
				                <label>Academic Session <span class="text-danger">*</span></label>
				                <select name="academic_session" id="academic_session" class="form-control" required>
				                    <option value="">Select Session</option>
				                    @foreach($sessions as $session)
				                        <option value="{{ $session }}" {{ (isset($batch) && $batch->academic_session == $session) ? 'selected' : '' }}>
				                            {{ $session }}
				                        </option>
				                    @endforeach
				                </select>
				            </div>

				            <div class="form-group col-md-6">
							  <label>Sanction Year<span class="text-danger">*</span></label>
							    <select name="sanction_year" id="sanction_year" class="form-control" required>
			                        <option value="">Select Sanction</option>
			                        @foreach($sanctions as $sanction)
			                            <option value="{{ $sanction }}" {{ (isset($batch) && $batch->sanction_year == $sanction) ? 'selected' : '' }}>{{ $sanction }}</option>
			                        @endforeach
			                    </select>
							</div>

							<div class="form-group col-md-6">
							  <label>State<span class="text-danger">*</span></label>
							    <select name="state_id" id="state" class="form-control" required>
			                        <option value="">Select State</option>
			                        @foreach($states as $state)
			                            <option value="{{ $state->id }}" {{ (isset($batch) && $batch->state_id == $state->id) ? 'selected' : '' }}>{{ $state->name }}</option>
			                        @endforeach
			                    </select>
							</div>

				            <!-- Batch Strength -->
				            <div class="form-group col-md-6">
				                <label>Batch Strength <span class="text-danger">*</span></label>
				                <input type="number" name="batch_strength" class="form-control" placeholder="Enter Batch Strength" value="{{ $batch->batch_strength ?? old('batch_strength') }}" required>
				            </div>

				            <!-- Batch Title -->
				            <div class="form-group col-md-6">
				                <label>Batch Title [Centre_FY_Location] <span class="text-danger">*</span></label>
				                <input type="text" name="batch_title" class="form-control" placeholder="Enter Batch Title" value="{{ $batch->batch_title ?? old('batch_title') }}" required>
				            </div>

				            <!-- Start Date -->
				            <div class="form-group col-md-6">
				                <label>Start Date <span class="text-danger">*</span></label>
				                <input type="date" name="start_date" class="form-control" value="{{ isset($batch) ? \Carbon\Carbon::parse($batch->start_date)->format('Y-m-d') : old('start_date') }}" required>
				            </div>

				            <!-- End Date -->
				            <div class="form-group col-md-6">
				                <label>End Date <span class="text-danger">*</span></label>
				                <input type="date" name="end_date" class="form-control" value="{{ isset($batch) ? \Carbon\Carbon::parse($batch->end_date)->format('Y-m-d') : old('end_date') }}" required>
				            </div>

				            <div class="form-group col-md-6">
							  <label>Sanction Year<span class="text-danger">*</span></label>
							    <select name="status" id="status" class="form-control">
									<option value="">~~~~~~~Select status~~~~~~~</option>
									<option value="2" {{ (isset($batch) && $batch->status == 2) ? 'selected' : '' }}>Completed</option>
									<option value="1" {{ (isset($batch) && $batch->status == 1) ? 'selected' : '' }}>OnGoing</option>
									<option value="0" {{ (isset($batch) && $batch->status == 0) ? 'selected' : '' }}>Yet to Start/New</option>
									<!--<option value="Inactive" >Inactive</option>-->
							  </select>
							</div>

				            <!-- Submit -->
				            <div class="form-group col-md-12 mt-3">
				                <button type="submit" class="btn btn-primary">{{ isset($batch) ? 'Update' : 'Submit' }}</button>
				                <a href="{{ route('partnerAdmin.manageBatche') }}" class="btn btn-danger">Cancel</a>
				            </div>

				        </div>
				    </form>
				</div>

			</div>

		</div>

	</div>

</div>
</section>
@endsection