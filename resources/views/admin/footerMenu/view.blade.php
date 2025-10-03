@extends('layouts.adminlayout')
@section('content')
	<div class="header bg-primary pb-6">
		<div class="container-fluid">
			<div class="header-body">
				<div class="row align-items-center py-4">
					<div class="col-lg-6 col-7">
						<h6 class="h2 text-white d-inline-block mb-0">Manage Footer Menu</h6>
					</div>
					<div class="col-lg-6 col-5 text-right">
						<a href="<?php echo route('admin.footerMenu') ?>" class="btn btn-neutral"><i class="fa fa-arrow-left"></i> Back</a>
						<div class="dropdown" data-toggle="tooltip" data-title="More Actions">
							<a class="btn btn-neutral" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-ellipsis-v"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
								<!-- <a class="dropdown-item" href="<?php echo route('admin.footerMenu.edit', ['id' => $page->id]) ?>">
									<i class="fas fa-pencil-alt text-info"></i>
									<span class="status">Edit</span>
								</a> -->
								<div class="dropdown-divider"></div>
								<a
									class="dropdown-item _delete"
									href="javascript:;"
									data-link="<?php echo route('admin.footerMenu.delete', ['id' => $page->id]) ?>"
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
			<div class="col-xl-8 order-xl-1">
				<div class="card">
					<!--!! FLAST MESSAGES !!-->
					@include('admin.partials.flash_messages')
					<div class="card-header">
						<div class="row align-items-center">
							<div class="col-8">
								<h3 class="mb-0">Footer Menu</h3>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<!-- Projects table -->
						<table class="table align-items-center table-flush view-table">
							<tbody>
								<tr>
									<th>Id</th>
									<td><?php echo $page->id ?></td>
								</tr>
								<tr>
									<th>Title</th>
									<td><?php echo $page->key ?></td>
								</tr>
								<tr>
									<th>Link</th>
									<td><?php echo $page->value ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
