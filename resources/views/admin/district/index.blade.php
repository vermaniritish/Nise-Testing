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
						<?php if(Permissions::hasPermission('district', 'create')): ?>
						<a href="<?php echo route('admin.district.add') ?>" class="btn btn-neutral">New</a>
						<?php endif; ?>
						@include('admin.district.filters')
					</div>
				</div>
			</div>
		</div>
	</div>

<div class="content_area">
	<div class="container-xxl flex-grow-1 container-p-y">
		<div class="row">
			<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				@include('admin.partials.flash_messages')
				<!--!!!!! DO NOT REMOVE listing-block CLASS. INCLUDE THIS IN PARENT DIV OF TABLE ON LISTING STATES !!!!!-->
				<div class="card listing-block">
			        <div class="card-header">
			        	<div class="heading">
							<h5 class="mb-0">Here Is Your Dsitrict Listing!</h5>
						</div>
						<div class="actions">
							<div class="input-group input-group-alternative input-group-merge">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-search"></i></span>
								</div>
								<input class="form-control listing-search" placeholder="Search" type="text" value="<?php echo (isset($_GET['search']) && $_GET['search'] ? $_GET['search'] : '') ?>">
							</div>
							<?php if(Permissions::hasPermission('district', 'delete')): ?>
							<div class="dropdown" data-toggle="tooltip" data-designation="Bulk Actions" >
								<a class="btn btn-sm btn-icon-only text-warning" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fas fa-ellipsis-v"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
		                            <a
		                            	href="javascript:void(0);"
		                            	class="waves-effect waves-block dropdown-item text-danger"
		                            	onclick="bulk_actions('<?php echo route('admin.district.bulkActions', ['action' => 'delete']) ?>', 'delete');">
											<i class="fas fa-times text-danger"></i>
											<span class="status text-danger">Delete</span>
		                            </a>
								</div>
							</div>
							<?php endif; ?>
						</div>
					</div>
			        <!--!!!!! DO NOT REMOVE listing-table, mark_all  CLASSES. INCLUDE THIS IN ALL TABLES LISTING STATES !!!!!-->
			        <div class="card-body p-0">
				        <div class="table-responsive text-nowrap">
				          	<table class="table listing-table">
				            	<thead class="thead-light">
					              	<tr>
					              		<th width="5%">
			              					<div class="form-check">
			              			        	<input type="checkbox" class="form-check-input mark_all" id="mark_all">
			              			        	<label class="form-check-label" for="mark_all"></label>
			              			      	</div>
					              		</th>
						                <th class="sort">
											<!--- MAKE SURE TO USE PROPOER FIELD IN data-field AND PROPOER DIRECTION IN data-sort -->
											Id
											@if(isset($_GET['sort']) && $_GET['sort'] == 'district.id' && isset($_GET['direction']) && $_GET['direction'] == 'asc')
											<i class="fas fa-sort-down active" data-field="district.id" data-sort="asc"></i>
											@elseif(isset($_GET['sort']) && $_GET['sort'] == 'district.id' && isset($_GET['direction']) && $_GET['direction'] == 'desc')
											<i class="fas fa-sort-up active" data-field="district.id" data-sort="desc"></i>
											@else
											<i class="fas fa-sort" data-field="district.id" data-sort="asc"></i>
											@endif
										</th>
										<th class="sort">
											State
											@if(isset($_GET['sort']) && $_GET['sort'] == 'states.name' && isset($_GET['direction']) && $_GET['direction'] == 'asc')
											<i class="fas fa-sort-down active" data-field="states.name" data-sort="asc"></i>
											@elseif(isset($_GET['sort']) && $_GET['sort'] == 'states.name' && isset($_GET['direction']) && $_GET['direction'] == 'desc')
											<i class="fas fa-sort-up active" data-field="states.name" data-sort="desc"></i>
											@else
											<i class="fas fa-sort" data-field="states.name"></i>
											@endif
										</th>
										<th class="sort">
											Title
											@if(isset($_GET['sort']) && $_GET['sort'] == 'district.title' && isset($_GET['direction']) && $_GET['direction'] == 'asc')
											<i class="fas fa-sort-down active" data-field="district.title" data-sort="asc"></i>
											@elseif(isset($_GET['sort']) && $_GET['sort'] == 'district.title' && isset($_GET['direction']) && $_GET['direction'] == 'desc')
											<i class="fas fa-sort-up active" data-field="district.title" data-sort="desc"></i>
											@else
											<i class="fas fa-sort" data-field="district.title"></i>
											@endif
										</th>
										<th class="sort">
											Status
											@if(isset($_GET['sort']) && $_GET['sort'] == 'district.status' && isset($_GET['direction']) && $_GET['direction'] == 'asc')
											<i class="fas fa-sort-down active" data-field="district.status" data-sort="asc"></i>
											@elseif(isset($_GET['sort']) && $_GET['sort'] == 'district.status' && isset($_GET['direction']) && $_GET['direction'] == 'desc')
											<i class="fas fa-sort-up active" data-field="district.status" data-sort="desc"></i>
											@else
											<i class="fas fa-sort" data-field="district.status"></i>
											@endif
										</th>
										<th class="sort">
											Created ON
											@if(isset($_GET['sort']) && $_GET['sort'] == 'district.created_at' && isset($_GET['direction']) && $_GET['direction'] == 'asc')
											<i class="fas fa-sort-down active" data-field="district.created_at" data-sort="asc"></i>
											@elseif(isset($_GET['sort']) && $_GET['sort'] == 'district.created_at' && isset($_GET['direction']) && $_GET['direction'] == 'desc')
											<i class="fas fa-sort-up active" data-field="district.created_at" data-sort="desc"></i>
											@else
											<i class="fas fa-sort" data-field="district.created_at"></i>
											@endif
										</th>
										<th>
											Actions
										</th>
					              	</tr>
				            	</thead>
				            	<tbody class="list">
				              		@if(!empty($listing->items()))
										@include('admin.district.listingLoop')
									@else
									<td align="left" colspan="7">
			                        	No records found!
			                        </td>
									@endif
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
					</div>
		    	</div>
			</div>
		</div>
	</div>
</div>
	
@endsection