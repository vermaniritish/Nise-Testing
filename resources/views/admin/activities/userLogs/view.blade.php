@extends('layouts.adminlayout')
@section('content')
	<div class="header bg-primary pb-6">
		<div class="container-fluid">
			<div class="header-body">
				<div class="row align-items-center py-4">
					<div class="col-lg-6 col-7">
						<h6 class="h2 text-white d-inline-block mb-0">Activity User Logs</h6>
					</div>
					<div class="col-lg-6 col-5 text-right">
						<a href="<?php echo route('admin.activities.userLogs') ?>" class="btn btn-neutral"><i class="fa fa-arrow-left"></i> Back</a>
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
								<h3 class="mb-0">Activity Information</h3>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<!-- Projects table -->
						<table class="table align-items-center table-flush view-table">
							<tbody>
								<tr>
									<th>Id</th>
									<td><?php echo $userLog->id ?></td>
								</tr>
								<tr>
									<th>Organisation Name</th>
									<td><?php echo $userLog->organisation_name ?></td>
								</tr>
								<tr>
									<th>Mobile</th>
									<td><?php echo $userLog->mobile ?></td>
								</tr>
								<tr>
									<th>Mobile OTP</th>
									<td><?php echo $userLog->mobile_otp ?></td>
								</tr>
								<tr>
									<th>Email</th>
									<td><?php echo $userLog->email ?></td>
								</tr>
								<tr>
									<th>Email OTP</th>
									<td><?php echo $userLog->email_otp ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-xl-4 order-xl-1">
				<div class="card">
					<div class="card-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="mb-0">Access Information</h3>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<!-- Projects table -->
						<table class="table align-items-center table-flush view-table">
							<tbody>
								<tr>
									<th scope="row">
										Created On
									</th>
									<td>
										<?php echo _dt($userLog->created) ?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection