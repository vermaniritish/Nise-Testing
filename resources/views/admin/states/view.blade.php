@extends('layouts.adminlayout')
@section('content')
	<div class="header bg-primary pb-6">
		<div class="container-fluid">
			<div class="header-body">
				<div class="row align-items-center py-4">
					<div class="col-lg-6 col-7">
						<h6 class="h2 text-white d-inline-block mb-0">Manage News Events</h6>
					</div>
					<div class="col-lg-6 col-5 text-right">
						<a href="<?php echo route('admin.states') ?>" class="btn btn-neutral"><i class="fa fa-arrow-left"></i> Back</a>
						<?php if(Permissions::hasPermission('states', 'update') || Permissions::hasPermission('states', 'delete')): ?>
						<div class="dropdown" data-toggle="tooltip" data-title="More Actions">
							<a class="btn btn-neutral" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-ellipsis-v"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
								<?php if(Permissions::hasPermission('states', 'update')): ?>
								<a class="dropdown-item" href="<?php echo route('admin.states.edit', ['id' => $states->id]) ?>">
									<i class="fas fa-pencil-alt text-info"></i>
									<span class="status">Edit</span>
								</a>
								<?php endif; ?>
								<?php if(Permissions::hasPermission('states', 'delete')): ?>
								<div class="dropdown-divider"></div>
								<a
									class="dropdown-item _delete"
									href="javascript:;"
									data-link="<?php echo route('admin.states.delete', ['id' => $states->id]) ?>"
								>
									<i class="fas fa-times text-danger"></i>
									<span class="status text-danger">Delete</span>
								</a>
								<?php endif; ?>
							</div>
						</div>
						<?php endif; ?>
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
								<h3 class="mb-0">News Events Information</h3>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<!-- Projects table -->
						<table class="table align-items-center table-flush view-table">
							<tbody>
								<tr>
									<th width="25%">Id</th>
									<td><?php echo $states->id ?></td>
								</tr>
								<tr>
									<th>Title</th>
									<td><?php echo $states->name  ?></td>
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
										<?php echo $states->status ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>' ?>
									</td>
								</tr>
								<tr>
									<th scope="row">
										Created By
									</th>
									<td>
                                        <?php if (isset($states->owner) && $states->owner->first_name): ?>
                                            <a href="<?php echo route('admin.admins.edit', ['id' => $states->owner->id]); ?>">
                                                <?php echo $states->owner->first_name . ' ' . $states->owner->last_name; ?>
                                            </a>
                                        <?php endif; ?>
                                    </td>
								</tr>
                                <th scope="row">
                                    Date
                                </th>
                                <td>
                                    <?php echo _dt($states->date) ?>
                                </td>
								<tr>
									<th scope="row">
										Created On
									</th>
									<td>
										<?php echo _dt($states->created) ?>
									</td>
								</tr>
								<tr>
									<th scope="row">
										Last Modified
									</th>
									<td>
										<?php echo _dt($states->modified) ?>
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
