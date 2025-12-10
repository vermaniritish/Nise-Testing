@extends('layouts.adminlayout')
@section('content')
<div class="header bg-primary pb-6">
	<div class="container-fluid">
		<div class="header-body">
			<div class="row align-items-center py-4">
				<div class="col-lg-6 col-7">
					<h6 class="h2 text-white d-inline-block mb-0">Manage Districts</h6>
				</div>
				<div class="col-lg-6 col-5 text-right">
					<a href="<?php echo route('admin.district') ?>" class="btn btn-neutral"><i class="ni ni-bold-left"></i> Back</a>
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
				<!--!! FLAST MESSAGES !!-->
				@include('admin.partials.flash_messages')
				<div class="card-header">
					<div class="row align-items-center">
						<div class="col-8">
							<h3 class="mb-0">Create New District Here.</h3>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form method="post" action="<?php echo route('admin.district.add') ?>" class="form-validation">
						<!--!! CSRF FIELD !!-->
						{{ @csrf_field() }}
						<h6 class="heading-small text-muted mb-4">District information</h6>
						<div class="pl-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-type">State</label>
                                <select name="state_id" class="form-control" required>
                                    <option value="" selected disabled>Select State</option>
                                    @foreach($states as $s)
							      		<option value="{{ $s['id'] }}">{{ $s->name }}</option>
							  		@endforeach
                                </select>
                                @error('state_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
							<div class="form-group">
								<label class="form-control-label" for="input-first-name">Name</label>
								<input type="text" maxlength="100" class="form-control" name="name" required placeholder="Name" value="{{ old('name') }}">
								<small>You can enter up to 100 characters only.</small>
								@error('name')
								    <small class="text-danger">{{ $message }}</small>
								@enderror
							</div>
						</div>
						<hr class="my-4" />
						<!-- Address -->
						<h6 class="heading-small text-muted mb-4">Publish Information</h6>
						<div class="pl-lg-4">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<div class="custom-control">
											<label class="custom-toggle">
												<input type="hidden" name="status" value="0">
												<input type="checkbox" name="status" value="1" <?php echo (old('status') != '0' ? 'checked' : '') ?>>
												<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
											</label>
											<label class="custom-control-label">Do you want to publish this page ?</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<hr class="my-4" />
						<button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
							<i class="fa fa-save"></i> Submit
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
