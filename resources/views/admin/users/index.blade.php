@extends('layouts.adminlayout')
@section('content')
	<div class="header bg-primary pb-6">
		<div class="container-fluid">
			<div class="header-body">
				<div class="row align-items-center py-4">
					<div class="col-lg-6 col-7">
						<h6 class="h2 text-white d-inline-block mb-0">Manage Institutes</h6>
					</div>
					<div class="col-lg-6 col-5 text-right">
						<?php if(Permissions::hasPermission('users', 'create')): ?>
						<a href="<?php echo route('admin.users.add') ?>" class="btn btn-neutral"><i class="fas fa-plus"></i> New</a>
						<?php endif; ?>
						@include('admin.users.filters')
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
							<h3 class="mb-0">Here Is Your Institute Listing!</h3>
						</div>
						<div class="actions">
							<div class="input-group input-group-alternative input-group-merge">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-search"></i></span>
								</div>
								<input class="form-control listing-search" placeholder="Search" type="text" value="<?php echo (isset($_GET['search']) && $_GET['search'] ? $_GET['search'] : '') ?>">
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table align-items-center table-flush listing-table">
							<thead class="thead-light">
								<tr>
									<th class="checkbox-th">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input mark_all" id="mark_all">
											<label class="custom-control-label" for="mark_all"></label>
										</div>
									</th>
									<th class="sort">
										<!--- MAKE SURE TO USE PROPOER FIELD IN data-field AND PROPOER DIRECTION IN data-sort -->
										Id
										<?php if(isset($_GET['sort']) && $_GET['sort'] == 'users.id' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
										<i class="fas fa-sort-down active" data-field="users.id" data-sort="asc"></i>
										<?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'users.id' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
										<i class="fas fa-sort-up active" data-field="users.id" data-sort="desc"></i>
										<?php else: ?>
										<i class="fas fa-sort" data-field="users.id" data-sort="asc"></i>
										<?php endif; ?>
									</th>
									<th class="sort">
										Person Name
										<?php if(isset($_GET['sort']) && $_GET['sort'] == 'users.organisation_name' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
										<i class="fas fa-sort-down active" data-field="users.organisation_name" data-sort="asc"></i>
										<?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'users.organisation_name' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
										<i class="fas fa-sort-up active" data-field="users.organisation_name" data-sort="desc"></i>
										<?php else: ?>
										<i class="fas fa-sort" data-field="users.organisation_name"></i>
										<?php endif; ?>
									</th>
									<th class="sort">
										Email
										<?php if(isset($_GET['sort']) && $_GET['sort'] == 'users.email' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
										<i class="fas fa-sort-down active" data-field="users.email" data-sort="asc"></i>
										<?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'users.email' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
										<i class="fas fa-sort-up active" data-field="users.email" data-sort="desc"></i>
										<?php else: ?>
										<i class="fas fa-sort" data-field="users.email"></i>
										<?php endif; ?>
									</th>
									<th class="sort">
										Mobile Number
										<?php if(isset($_GET['sort']) && $_GET['sort'] == 'users.mobile' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
										<i class="fas fa-sort-down active" data-field="users.mobile" data-sort="asc"></i>
										<?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'users.mobile' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
										<i class="fas fa-sort-up active" data-field="users.mobile" data-sort="desc"></i>
										<?php else: ?>
										<i class="fas fa-sort" data-field="users.mobile"></i>
										<?php endif; ?>
									</th>
									<th class="sort">
										Status
										<?php if(isset($_GET['sort']) && $_GET['sort'] == 'users.status' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
										<i class="fas fa-sort-down active" data-field="users.status" data-sort="asc"></i>
										<?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'users.status' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
										<i class="fas fa-sort-up active" data-field="users.status" data-sort="desc"></i>
										<?php else: ?>
										<i class="fas fa-sort" data-field="users.status"></i>
										<?php endif; ?>
									</th>
									<th class="sort">
										Created ON
										<?php if(isset($_GET['sort']) && $_GET['sort'] == 'users.created' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
										<i class="fas fa-sort-down active" data-field="users.created" data-sort="asc"></i>
										<?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'users.created' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
										<i class="fas fa-sort-up active" data-field="users.created" data-sort="desc"></i>
										<?php else: ?>
										<i class="fas fa-sort" data-field="users.created"></i>
										<?php endif; ?>
									</th>
									<th>
										Actions
									</th>
								</tr>
							</thead>
							<tbody class="list">
								<?php if(!empty($listing->items())): ?>
									@include('admin.users.listingLoop')
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
@endsection
