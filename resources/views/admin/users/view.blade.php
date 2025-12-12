<?php use App\Models\Admin\State; ?>
@extends('layouts.adminlayout')
@section('content')
	<div class="header bg-primary pb-6">
		<div class="container-fluid">
			<div class="header-body">
				<div class="row align-items-center py-4">
					<div class="col-lg-6 col-7">
						<h6 class="h2 text-white d-inline-block mb-0">Manage User</h6>
					</div>
					<div class="col-lg-6 col-5 text-right">
						<a href="<?php echo route('admin.users') ?>" class="btn btn-neutral"><i class="fa fa-arrow-left"></i> Back</a>
						<!-- <button class="btn btn-neutral" data-toggle="modal" data-target="#assignCentersModal">
						    <i class="fa fa-plus"></i> Assign Centers
						</button> -->
						{{-- <div class="dropdown" data-toggle="tooltip" data-title="More Actions">
							<a class="btn btn-neutral" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-ellipsis-v"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
								<a class="dropdown-item" href="<?php echo route('admin.users.edit', ['id' => $user->id]) ?>">
									<i class="fas fa-pencil-alt text-info"></i>
									<span class="status">Edit</span>
								</a>
								<div class="dropdown-divider"></div>
								<a
									class="dropdown-item _delete"
									href="javascript:;"
									data-link="<?php echo route('admin.users.delete', ['id' => $user->id]) ?>"
								>
									<i class="fas fa-times text-danger"></i>
									<span class="status text-danger">Delete</span>
								</a>
							</div>
						</div> --}}
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Page content -->
	<div class="container-fluid mt--6">
		<div class="row">
			<div class="col-xl-8 order-xl-1">
				<div class="card">
					<!--!! FLAST MESSAGES !!-->
					@include('admin.partials.flash_messages')
					<div class="card-header">
						<div class="row align-items-center">
							<div class="col-8">
								<h3 class="mb-0">User Information</h3>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<!-- Projects table -->
						<table class="table align-items-center table-flush view-table">
							<tbody>
								<tr>
									<th>Id</th>
									<td><?php echo $user->id ?></td>
								</tr>
								<tr>
									<th>Registration Type</th>
									<td><?php echo $user->registration_type ?></td>
								</tr>

								@if(isset($user->registration_type) && $user->registration_type == 'Company')
								<tr>
									<th>Company Name</th>
									<td><?php echo $user->company_name ?></td>
								</tr>
								@endif

								@if(isset($user->registration_type) && $user->registration_type == 'Company')
								<tr>
									<th>Authorize Person Name</th>
									<td><?php echo $user->person_name ?></td>
								</tr>
								@else
								<tr>
									<th>Individual Person Name</th>
									<td><?php echo $user->ind_contact_person_name ?></td>
								</tr>
								@endif

								@if(isset($user->registration_type) && $user->registration_type == 'Company')
								<tr>
									<th>Email</th>
									<td><?php echo $user->email ?></td>
								</tr>
								<tr>
									<th>Mobile Number</th>
									<td><?php echo $user->mobile ?></td>
								</tr>
								@else
								<tr>
									<th>Individual Email</th>
									<td><?php echo $user->ind_email ?></td>
								</tr>
								<tr>
									<th>Individual Mobile Number</th>
									<td><?php echo $user->ind_mobile_number ?></td>
								</tr>
								@endif
								@if(isset($user->registration_type) && $user->registration_type == 'Company')
								<tr>
									<th>Pan</th>
									<td>
									    <?php echo $user->pan; ?>

									    <?php if($user->pan_file): ?>
									        <br>
									        <a href="<?php echo url($user->pan_file); ?>" 
									           target="_blank" class="btn btn-sm btn-primary">
									           View PAN File
									        </a>
									    <?php endif; ?>
									</td>
								</tr>
								<tr>
									<th>GST</th>
									<td><?php echo $user->gst ?></td>
								</tr>
								<tr>
									<th>Tin Number</th>
									<td><?php echo $user->tin ?></td>
								</tr>
								<tr>
									<th>Registration Number</th>
									<td>
									    <?php echo $user->registration_number; ?>

									    <?php if($user->company_file): ?>
									        <br>
									        <a href="<?php echo url($user->company_file); ?>" 
									           target="_blank" class="btn btn-sm btn-primary">
									           View Company File
									        </a>
									    <?php endif; ?>
									</td>
								</tr>
								@else
								@endif

								@if(isset($user->registration_type) && $user->registration_type == 'Company')
								<?php
									$getState = State::find($user->state_id);
								?>
								<tr>
									<th>State Name</th>
									<td><?php echo $getState->name ?></td>
								</tr>
								@else
								<?php
									$getState = State::find($user->ind_state_id);
								?>
								<tr>
									<th>Individual State Name</th>
									<td><?php echo $getState->name ?></td>
								</tr>
								@endif

								@if(isset($user->registration_type) && $user->registration_type == 'Company')
								<tr>
									<th>City Name</th>
									<td><?php echo $user->city ?></td>
								</tr>
								@else
								<tr>
									<th>Individual City Name</th>
									<td><?php echo $user->ind_city_or_district ?></td>
								</tr>
								@endif

								@if(isset($user->registration_type) && $user->registration_type == 'Company')
								<tr>
									<th>Pincode</th>
									<td><?php echo $user->pincode ?></td>
								</tr>
								@else
								<tr>
									<th>Individual Pincode</th>
									<td><?php echo $user->ind_pin_code ?></td>
								</tr>
								@endif

								@if(isset($user->registration_type) && $user->registration_type == 'Company')
								<tr>
									<th>Address 1</th>
									<td><?php echo $user->address_1 ?></td>
								</tr>
								<tr>
									<th>Address 2</th>
									<td><?php echo $user->address_2 ?></td>
								</tr>
								@else
								<tr>
									<th>Individual Address 1</th>
									<td><?php echo $user->ind_address_1 ?></td>
								</tr>
								<tr>
									<th>Individual Address 2</th>
									<td><?php echo $user->ind_address_2 ?></td>
								</tr>
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-xl-4 order-xl-1">
				<?php if($user->image): ?>
				<div class="card">
					<div class="card-header">
						@include("admin.users.profile", ["id" => $user->id])
				    </div>
				</div>
				<?php endif; ?>
				<div class="card">
					<div class="card-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="mb-0">Other Information</h3>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<!-- Projects table -->
						<table class="table align-items-center table-flush view-table">
							<tbody>
								<tr>
									<th scope="row">
										Status
									</th>
									<td>
										<?php echo $user->status ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>' ?>
									</td>
								</tr>
								<tr>
									<th scope="row">
										Created On
									</th>
									<td>
										<?php echo _dt($user->created) ?>
									</td>
								</tr>
								<tr>
									<th scope="row">
										Last Modified
									</th>
									<td>
										<?php echo _dt($user->modified) ?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Assign Centers Modal -->
	<div class="modal fade" id="assignCentersModal" tabindex="-1" role="dialog" aria-labelledby="assignCentersModalLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <form action="{{ route('admin.users.assign-centers', $user->id) }}" method="POST">
	                @csrf
	                <div class="modal-header">
	                    <h5 class="modal-title" id="assignCentersModalLabel">Assign Centers</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                <div class="modal-body">
	                    <label for="center_ids">Select Centers</label>
	                    <select name="center_ids[]" id="center_ids" class="form-control" multiple>
	                        @foreach($centers as $center)
	                            <option value="{{ $center->id }}" 
	                                {{ in_array($center->id, $assignedCenters) ? 'selected' : '' }}>
	                                {{ $center->title }}
	                            </option>
	                        @endforeach
	                    </select>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	                    <button type="submit" class="btn btn-primary">Save changes</button>
	                </div>
	            </form>
	        </div>
	    </div>
	</div>

	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<script>
	$(document).ready(function() {
	    $('#centers').select2({
	        placeholder: "Select Centers",
	        width: '100%'
	    });
	});
	</script>

@endsection
