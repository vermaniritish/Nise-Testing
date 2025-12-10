@extends('layouts.adminlayout')
@section('content')
	<div class="header bg-primary pb-6">
		<div class="container-fluid">
			<div class="header-body">
				<div class="row align-items-center py-4">
					<div class="col-lg-6 col-7">
						<h6 class="h2 text-white d-inline-block mb-0">Manage Slider Menu</h6>
					</div>
					<div class="col-lg-6 col-5 text-right">
						<a href="<?php echo route('admin.sliderMenu') ?>" class="btn btn-neutral"><i class="fa fa-arrow-left"></i> Back</a>
						<div class="dropdown" data-toggle="tooltip" data-title="More Actions">
							<a class="btn btn-neutral" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-ellipsis-v"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
								<a class="dropdown-item" href="<?php echo route('admin.sliderMenu.edit', ['id' => $page->id]) ?>">
									<i class="fas fa-pencil-alt text-info"></i>
									<span class="status">Edit</span>
								</a>
								<div class="dropdown-divider"></div>
								<a
									class="dropdown-item _delete"
									href="javascript:;"
									data-link="<?php echo route('admin.sliderMenu.delete', ['id' => $page->id]) ?>"
								>
									<i class="fas fa-times text-danger"></i>
									<span class="status text-danger">Delete</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Page content -->
	<div class="container-fluid mt--6">
		<div class="row">
			<div class="col-xl-6 order-xl-1">
				<div class="card">
					<!--!! FLAST MESSAGES !!-->
					@include('admin.partials.flash_messages')
					<div class="card-header">
						<div class="row align-items-center">
							<div class="col-8">
								<h3 class="mb-0">English</h3>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<!-- Projects table -->
						<table class="table align-items-center table-flush view-table">
							<tbody>
								<tr>
									<th width="25%">Id</th>
									<td><?php echo $page->id ?></td>
								</tr>
								<tr>
									<th>Title</th>
									<td><?php echo $page->heading ?></td>
								</tr>
								<tr>
									<th>Sub Title</th>
									<td><?php echo $page->title ?></td>
								</tr>
								<tr>
									<th>Button Title</th>
									<td><?php echo $page->button_title  ?></td>
								</tr>
                                <tr>
									<th>Button Link</th>
									<td><?php echo $page->button_link  ?></td>
								</tr>
                                <tr>
									<th>Button Status</th>
                                    <td><?php echo $page->button_status ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>' ?></td>
								</tr>
                                <tr>
									<th>Slider Status</th>
                                    <td><?php echo $page->status ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>' ?></td>
								</tr>
                                <tr>
                                    <th>Slider Image</th>
                                    <td><img src="<?php echo asset($page->image) ?>" alt="Slider Image" width="200"></td>
                                </tr>

							</tbody>
						</table>
					</div>
				</div>
			</div>

            <div class="col-xl-6 order-xl-1">
				<div class="card">
					<!--!! FLAST MESSAGES !!-->
					@include('admin.partials.flash_messages')
					<div class="card-header">
						<div class="row align-items-center">
							<div class="col-8">
								<h3 class="mb-0">Hindi</h3>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<!-- Projects table -->
						<table class="table align-items-center table-flush view-table">
							<tbody>
								<tr>
									<th width="25%">Id</th>
									<td><?php echo $page->id ?></td>
								</tr>
								<tr>
									<th>Title</th>
									<td><?php echo $page->heading_hi ?? "" ?></td>
								</tr>
								<tr>
									<th>Sub Title</th>
									<td><?php echo $page->title_hi ?? "" ?></td>
								</tr>
								<tr>
									<th>Button Title</th>
									<td><?php echo $page->button_title_hi ?? ""  ?></td>
								</tr>


							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
