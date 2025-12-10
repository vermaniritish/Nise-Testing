@extends('layouts.adminlayout')
@section('content')
	<div class="header bg-primary pb-6">
		<div class="container-fluid">
			<div class="header-body">
				<div class="row align-items-center py-4">
					<div class="col-lg-6 col-7">
						<h6 class="h2 text-white d-inline-block mb-0">Manage Lab Managements</h6>
					</div>
					<div class="col-lg-6 col-5 text-right">
						<?php if(Permissions::hasPermission('lab_managements', 'create')): ?>
						<a href="<?php echo route('admin.labManagements.add') ?>" class="btn btn-neutral"><i class="fas fa-plus"></i>New</a>
						<?php endif;?>
						@include('admin.labManagements.filters')
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Page content -->
	<div class="container-fluid mt--6">
		<div class="row">
			<div class="col">
				<div class="card listing-block">
					<!--!! FLAST MESSAGES !!-->
					@include('admin.partials.flash_messages')
					<!-- Card header -->
					<div class="card-header border-0">
						<div class="heading">
							<h3 class="mb-0">Here Is Your Lab Management!</h3>
						</div>
						<div class="actions">
							<div class="input-group input-group-alternative input-group-merge">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-search"></i></span>
								</div>
								<input class="form-control listing-search" placeholder="Search" type="text" value="<?php echo (isset($_GET['search']) && $_GET['search'] ? $_GET['search'] : '') ?>">
							</div>
							<?php if(Permissions::hasPermission('lab_managements', 'delete')): ?>
							<div class="dropdown" data-toggle="tooltip" data-designation="Bulk Actions" >
								<a class="btn btn-sm btn-icon-only text-warning" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fas fa-ellipsis-v"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
		                            <a
		                            	href="javascript:void(0);"
		                            	class="waves-effect waves-block dropdown-item text-danger"
		                            	onclick="bulk_actions('<?php echo route('admin.labManagements.bulkActions', ['action' => 'delete']) ?>', 'delete');">
											<i class="fas fa-times text-danger"></i>
											<span class="status text-danger">Delete</span>
		                            </a>
								</div>
							</div>
							<?php endif; ?>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table align-items-center table-flush listing-table">
							<thead class="thead-light">
								<tr>
									<th class="checkbox-th" width="5%">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input mark_all" id="mark_all">
											<label class="custom-control-label" for="mark_all"></label>
										</div>
									</th>
									<th class="sort" width="5%">
										<!--- MAKE SURE TO USE PROPOER FIELD IN data-field AND PROPOER DIRECTION IN data-sort -->
										Id
										<?php if(isset($_GET['sort']) && $_GET['sort'] == 'lab_managements.id' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
										<i class="fas fa-sort-down active" data-field="lab_managements.id" data-sort="asc"></i>
										<?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'lab_managements.id' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
										<i class="fas fa-sort-up active" data-field="lab_managements.id" data-sort="desc"></i>
										<?php else: ?>
										<i class="fas fa-sort" data-field="lab_managements.id" data-sort="asc"></i>
										<?php endif; ?>
									</th>
									
									<th class="sort">
										Lab Name
										<?php if(isset($_GET['sort']) && $_GET['sort'] == 'lab_managements.name' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
										<i class="fas fa-sort-down active" data-field="lab_managements.name" data-sort="asc"></i>
										<?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'lab_managements.name' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
										<i class="fas fa-sort-up active" data-field="lab_managements.name" data-sort="desc"></i>
										<?php else: ?>
										<i class="fas fa-sort" data-field="lab_managements.name"></i>
										<?php endif; ?>
									</th>
									<th class="sort">
										Lab Location
										<?php if(isset($_GET['sort']) && $_GET['sort'] == 'lab_managements.location' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
										<i class="fas fa-sort-down active" data-field="lab_managements.location" data-sort="asc"></i>
										<?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'lab_managements.location' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
										<i class="fas fa-sort-up active" data-field="lab_managements.location" data-sort="desc"></i>
										<?php else: ?>
										<i class="fas fa-sort" data-field="lab_managements.location"></i>
										<?php endif; ?>
									</th>
									<th class="sort">
										Type
										<?php if(isset($_GET['sort']) && $_GET['sort'] == 'lab_managements.type_id' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
										<i class="fas fa-sort-down active" data-field="lab_managements.type_id" data-sort="asc"></i>
										<?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'lab_managements.type_id' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
										<i class="fas fa-sort-up active" data-field="lab_managements.type_id" data-sort="desc"></i>
										<?php else: ?>
										<i class="fas fa-sort" data-field="lab_managements.type_id"></i>
										<?php endif; ?>
									</th>
                                    <th class="sort">
										Created By
										<?php if(isset($_GET['sort']) && $_GET['sort'] == 'owner.first_name' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
										<i class="fas fa-sort-down active" data-field="owner.first_name" data-sort="asc"></i>
										<?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'owner.first_name' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
										<i class="fas fa-sort-up active" data-field="owner.first_name" data-sort="desc"></i>
										<?php else: ?>
										<i class="fas fa-sort" data-field="owner.first_name"></i>
										<?php endif; ?>
									</th>
                                    <th class="sort" width="15%">
										Status
										<?php if(isset($_GET['sort']) && $_GET['sort'] == 'lab_managements.status' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
										<i class="fas fa-sort-down active" data-field="lab_managements.status" data-sort="asc"></i>
										<?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'lab_managements.status' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
										<i class="fas fa-sort-up active" data-field="lab_managements.status" data-sort="desc"></i>
										<?php else: ?>
										<i class="fas fa-sort" data-field="lab_managements.status"></i>
										<?php endif; ?>
									</th>
									<th class="sort" width="15%">
										Created On
										<?php if(isset($_GET['sort']) && $_GET['sort'] == 'lab_managements.created' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
										<i class="fas fa-sort-down active" data-field="lab_managements.created" data-sort="asc"></i>
										<?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'lab_managements.created' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
										<i class="fas fa-sort-up active" data-field="lab_managements.created" data-sort="desc"></i>
										<?php else: ?>
										<i class="fas fa-sort" data-field="lab_managements.created"></i>
										<?php endif; ?>
									</th>
									<th class="text-center" width="10%">
										Actions
									</th>
								</tr>
							</thead>
							<tbody class="list">
								<?php if(!empty($listing->items())): ?>
									@include('admin.labManagements.listingLoop')
								<?php else: ?>
									<td align="left" colspan="7">
		                            	No records found!
		                            </td>
								<?php endif; ?>
							</tbody>
							<tfoot>
		                        <tr>
		                            <th align="left" colspan="20">
		                            	@include('admin.partials.pagination', ["pagination" => $listing])
		                            </th>
		                        </tr>
		                    </tfoot>
						</table>
					</div>
					<!-- Card footer -->
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
@endsection
