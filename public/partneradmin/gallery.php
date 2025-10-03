<?php require_once 'header.php'; ?>
<?php require_once 'left.php'; ?>
<?php require_once 'header-bottom.php'; ?>
<section>
					<div class="header bg-primary pb-6">
		<div class="container-fluid">
			<div class="header-body">
				<div class="row align-items-center py-4">
					<div class="col-lg-6 col-7">
						<h6 class="h2 text-white d-inline-block mb-0">Manage Gallery</h6>
					</div>
					<div class="col-lg-6 col-5 text-right">
												<a href="add-gallery.php" class="btn btn-neutral"><i class="fas fa-plus"></i>New</a>
												<div class="dropdown filter-dropdown">
	<a class="btn btn-neutral dropdown-btn" href="#">
				<i class="fas fa-filter"></i> Filters
	</a>
	<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
		<form action="/admin/gallery" id="filters-form">
			<a href="javascript:;" class="float-right px-2 closeit"><i class="fa fa-times-circle"></i></a>
			
			<div class="dropdown-divider"></div>
			<div class="dropdown-item">
				<div class="row">
					<div class="col-md-12">
						<label class="form-control-label">Created By</label>
						<div class="dropdown bootstrap-select show-tick form-control"><select class="form-control" name="admins[]" multiple="" tabindex="-98">
					      						      		<option value="7">Super Admin</option>
					  							      		<option value="17">Super Admin</option>
					  							    </select><button type="button" class="btn dropdown-toggle btn-light bs-placeholder" data-toggle="dropdown" role="combobox" aria-owns="bs-select-1" aria-haspopup="listbox" aria-expanded="false" title="Nothing selected"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">Nothing selected</div></div> </div></button><div class="dropdown-menu "><div class="bs-searchbox"><input type="search" class="form-control" autocomplete="off" role="combobox" aria-label="Search" aria-controls="bs-select-1" aria-autocomplete="list"></div><div class="inner show" role="listbox" id="bs-select-1" tabindex="-1" aria-multiselectable="true"><ul class="dropdown-menu inner show" role="presentation"></ul></div></div></div>
					</div>
				</div>
			</div>
			<div class="dropdown-divider"></div>
			<div class="dropdown-item">
				<div class="row">
					<div class="col-md-6">
						<label class="form-control-label">Created On</label>
						<input class="form-control" type="date" name="created_on[0]" value="" placeholder="DD-MM-YYYY">
					</div>
					<div class="col-md-6">
						<label class="form-control-label">&nbsp;</label>
						<input class="form-control" type="date" name="created_on[1]" value="" placeholder="DD-MM-YYYY">
					</div>
				</div>
			</div>
			<div class="dropdown-divider"></div>
			<a href="/admin/gallery" class="btn btn-sm py-2 px-3 float-left">
				Reset All
			</a>
			<button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
				Submit
			</button>
		</form>
	</div>
</div>					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Page content -->
	<div class="container-fluid mt--6">
		<div class="row">
			<div class="col">
<!--!!!!! DO NOT REMOVE listing-block CLASS. INCLUDE THIS IN PARENT DIV OF TABLE ON LISTING PAGES !!!!!-->
				<div class="card listing-block">
					<!--!! FLAST MESSAGES !!-->
					<div class="flash-message">
        </div>					<!-- Card header -->
					<div class="card-header border-0">
						<div class="heading">
							<h3 class="mb-0">Here Is Your Gallery!</h3>
						</div>
						<div class="actions">
							<div class="input-group input-group-alternative input-group-merge">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-search"></i></span>
								</div>
								<input class="form-control listing-search" placeholder="Search" type="text" value="">
							</div>
														<div class="dropdown" data-toggle="tooltip" data-title="Bulk Actions" data-original-title="" title="">
								<a class="btn btn-sm btn-icon-only text-warning" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fas fa-ellipsis-v"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
		                            <a href="javascript:void(0);" class="waves-effect waves-block dropdown-item text-danger" onclick="bulk_actions('/admin/gallery/bulkActions/delete', 'delete');">
											<i class="fas fa-times text-danger"></i>
											<span class="status text-danger">Delete</span>
		                            </a>
								</div>
							</div>
													</div>
					</div>
					<div class="table-responsive">
<!--!!!!! DO NOT REMOVE listing-table, mark_all  CLASSES. INCLUDE THIS IN ALL TABLES LISTING PAGES !!!!!-->
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
																				<i class="fas fa-sort" data-field="gallery.id" data-sort="asc"></i>
																			</th>
									<th class="sort">
										Title
																				<i class="fas fa-sort" data-field="gallery.title"></i>
																			</th>
									<th class="sort">
										Status
																				<i class="fas fa-sort" data-field="gallery.status"></i>
																			</th>
									<th class="sort">
										Created By
																				<i class="fas fa-sort" data-field="owner.first_name"></i>
																			</th>
									<th class="sort">
										Created ON
																				<i class="fas fa-sort" data-field="gallery.created"></i>
																			</th>
									<th>
										Actions
									</th>
								</tr>
							</thead>
							<tbody class="list">
																	<tr>
	<td>
		<!-- MAKE SURE THIS HAS ID CORRECT AND VALUES CORRENCT. THIS WILL EFFECT ON BULK CRUTIAL ACTIONS -->
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input listing_check" id="listing_check0" value="34">
			<label class="custom-control-label" for="listing_check0"></label>
		</div>
	</td>
	<td>
		<span class="badge badge-dot mr-4">
			<i class="bg-warning"></i>
			<span class="status">34</span>
		</span>
	</td>
	<td>
		Reunion mobilisation dan Circonscription Num 6	</td>
	
	<td>
		Super Admin	</td>
	<td>
		<div class="custom-control">
			<label class="custom-toggle">
								<input type="checkbox" name="status" onchange="switch_action('/admin/actions/gallery/switchUpdate/status/34', this)" value="1" checked="">
				<span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON"></span>
			</label>
		</div>
	</td>
	<td>
		09-10-2024 02:50AM	</td>
	<td class="text-right">
					<div class="dropdown">
				<a class="btn btn-sm btn-icon-only text-warning" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-ellipsis-v"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
										<a class="dropdown-item" href="add-gallery.php">
						<i class="fas fa-pencil-alt text-info"></i>
						<span class="status">Edit</span>
					</a>
										
										<div class="dropdown-divider"></div>
					<a class="dropdown-item _delete" href="javascript:;" data-link="/admin/gallery/34/delete">
						<i class="fas fa-times text-danger"></i>
						<span class="status text-danger">Delete</span>
					</a>
									</div>
			</div>
			</td>
</tr>
<tr>
	<td>
		<!-- MAKE SURE THIS HAS ID CORRECT AND VALUES CORRENCT. THIS WILL EFFECT ON BULK CRUTIAL ACTIONS -->
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input listing_check" id="listing_check1" value="33">
			<label class="custom-control-label" for="listing_check1"></label>
		</div>
	</td>
	<td>
		<span class="badge badge-dot mr-4">
			<i class="bg-warning"></i>
			<span class="status">33</span>
		</span>
	</td>
	<td>
		Élections législatives 2024	</td>
	
	<td>
		Super Admin	</td>
	<td>
		<div class="custom-control">
			<label class="custom-toggle">
								<input type="checkbox" name="status" onchange="switch_action('/admin/actions/gallery/switchUpdate/status/33', this)" value="1" checked="">
				<span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON"></span>
			</label>
		</div>
	</td>
	<td>
		09-10-2024 02:48AM	</td>
	<td class="text-right">
					<div class="dropdown">
				<a class="btn btn-sm btn-icon-only text-warning" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-ellipsis-v"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
										<a class="dropdown-item" href="add-gallery.php">
						<i class="fas fa-pencil-alt text-info"></i>
						<span class="status">Edit</span>
					</a>
										
										<div class="dropdown-divider"></div>
					<a class="dropdown-item _delete" href="javascript:;" data-link="/admin/gallery/33/delete">
						<i class="fas fa-times text-danger"></i>
						<span class="status text-danger">Delete</span>
					</a>
									</div>
			</div>
			</td>
</tr>
<tr>
	<td>
		<!-- MAKE SURE THIS HAS ID CORRECT AND VALUES CORRENCT. THIS WILL EFFECT ON BULK CRUTIAL ACTIONS -->
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input listing_check" id="listing_check2" value="32">
			<label class="custom-control-label" for="listing_check2"></label>
		</div>
	</td>
	<td>
		<span class="badge badge-dot mr-4">
			<i class="bg-warning"></i>
			<span class="status">32</span>
		</span>
	</td>
	<td>
		Reunion mobilisation dans la Circonscription numero 3 (08/10/24)	</td>
	
	<td>
		Super Admin	</td>
	<td>
		<div class="custom-control">
			<label class="custom-toggle">
								<input type="checkbox" name="status" onchange="switch_action('/admin/actions/gallery/switchUpdate/status/32', this)" value="1" checked="">
				<span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON"></span>
			</label>
		</div>
	</td>
	<td>
		09-10-2024 02:45AM	</td>
	<td class="text-right">
					<div class="dropdown">
				<a class="btn btn-sm btn-icon-only text-warning" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-ellipsis-v"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
										<a class="dropdown-item" href="add-gallery.php">
						<i class="fas fa-pencil-alt text-info"></i>
						<span class="status">Edit</span>
					</a>
										
										<div class="dropdown-divider"></div>
					<a class="dropdown-item _delete" href="javascript:;" data-link="/admin/gallery/32/delete">
						<i class="fas fa-times text-danger"></i>
						<span class="status text-danger">Delete</span>
					</a>
									</div>
			</div>
			</td>
</tr>
<tr>
	<td>
		<!-- MAKE SURE THIS HAS ID CORRECT AND VALUES CORRENCT. THIS WILL EFFECT ON BULK CRUTIAL ACTIONS -->
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input listing_check" id="listing_check3" value="31">
			<label class="custom-control-label" for="listing_check3"></label>
		</div>
	</td>
	<td>
		<span class="badge badge-dot mr-4">
			<i class="bg-warning"></i>
			<span class="status">31</span>
		</span>
	</td>
	<td>
		Réunion de mobilisation de l’Alliance du Changement	</td>
	
	<td>
		Super Admin	</td>
	<td>
		<div class="custom-control">
			<label class="custom-toggle">
								<input type="checkbox" name="status" onchange="switch_action('/admin/actions/gallery/switchUpdate/status/31', this)" value="1" checked="">
				<span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON"></span>
			</label>
		</div>
	</td>
	<td>
		08-10-2024 02:57PM	</td>
	<td class="text-right">
					<div class="dropdown">
				<a class="btn btn-sm btn-icon-only text-warning" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-ellipsis-v"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
										<a class="dropdown-item" href="add-gallery.php">
						<i class="fas fa-pencil-alt text-info"></i>
						<span class="status">Edit</span>
					</a>
										
										<div class="dropdown-divider"></div>
					<a class="dropdown-item _delete" href="javascript:;" data-link="/admin/gallery/31/delete">
						<i class="fas fa-times text-danger"></i>
						<span class="status text-danger">Delete</span>
					</a>
									</div>
			</div>
			</td>
</tr>
															</tbody>
							<tfoot>
		                        <tr>
		                            <th align="left" colspan="20">
		                            	<div class="ajaxPaginationEnabled loader text-center hidden" data-url="/admin/gallery" data-page="1" data-counter="10" data-total="4">
    <div class="preloader pl-size-xs">
        <div class="spinner-layer pl-indigo">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>
    </div>
</div>
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
			</section>
            <?php require_once 'footer.php'; ?>