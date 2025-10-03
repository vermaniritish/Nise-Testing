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
						<?php if(Permissions::hasPermission('news_events', 'create')): ?>
						<a href="<?php echo route('admin.newsEvents.add') ?>" class="btn btn-neutral"><i class="fas fa-plus"></i>New</a>
						<?php endif;?>
						@include('admin.newsEvents.filters')
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
					@include('admin.partials.flash_messages')
					<div class="card-header border-0">
						<div class="heading">
							<h3 class="mb-0">Here Is Your News Events!</h3>
						</div>
						<div class="actions">
							<div class="input-group input-group-alternative input-group-merge">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-search"></i></span>
								</div>
								<input class="form-control listing-search" placeholder="Search" type="text" value="<?php echo (isset($_GET['search']) && $_GET['search'] ? $_GET['search'] : '') ?>">
							</div>
							<?php if(Permissions::hasPermission('news_events', 'delete')): ?>
							<div class="dropdown" data-toggle="tooltip" data-designation="Bulk Actions" >
								<a class="btn btn-sm btn-icon-only text-warning" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fas fa-ellipsis-v"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
		                            <a
		                            	href="javascript:void(0);"
		                            	class="waves-effect waves-block dropdown-item text-danger"
		                            	onclick="bulk_actions('<?php echo route('admin.newsEvents.bulkActions', ['action' => 'delete']) ?>', 'delete');">
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
										Id
										<?php if(isset($_GET['sort']) && $_GET['sort'] == 'nnews_events.id' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
										<i class="fas fa-sort-down active" data-field="news_events.id" data-sort="asc"></i>
										<?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'news_events.id' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
										<i class="fas fa-sort-up active" data-field="news_events.id" data-sort="desc"></i>
										<?php else: ?>
										<i class="fas fa-sort" data-field="news_events.id" data-sort="asc"></i>
										<?php endif; ?>
									</th>
									<th class="sort" width="35%">
										Type
										<?php if(isset($_GET['sort']) && $_GET['sort'] == 'news_events.type' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
										<i class="fas fa-sort-down active" data-field="news_events.type" data-sort="asc"></i>
										<?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'news_events.type' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
										<i class="fas fa-sort-up active" data-field="news_events.type" data-sort="desc"></i>
										<?php else: ?>
										<i class="fas fa-sort" data-field="news_events.type"></i>
										<?php endif; ?>
									</th>
									<th class="sort" width="35%">
										Title
										<?php if(isset($_GET['sort']) && $_GET['sort'] == 'news_events.title' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
										<i class="fas fa-sort-down active" data-field="news_events.title" data-sort="asc"></i>
										<?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'news_events.title' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
										<i class="fas fa-sort-up active" data-field="news_events.title" data-sort="desc"></i>
										<?php else: ?>
										<i class="fas fa-sort" data-field="news_events.title"></i>
										<?php endif; ?>
									</th>
                                    {{-- <th class="sort" width="35%">
										Created By
										<?php if(isset($_GET['sort']) && $_GET['sort'] == 'news_events.title' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
										<i class="fas fa-sort-down active" data-field="news_events.heading" data-sort="asc"></i>
										<?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'news_events.title' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
										<i class="fas fa-sort-up active" data-field="news_events.heading" data-sort="desc"></i>
										<?php else: ?>
										<i class="fas fa-sort" data-field="news_events.heading"></i>
										<?php endif; ?>
									</th> --}}
                                    <th class="sort" width="15%">
										Status
										<?php if(isset($_GET['sort']) && $_GET['sort'] == 'news_events.status' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
										<i class="fas fa-sort-down active" data-field="news_events.status" data-sort="asc"></i>
										<?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'news_events.status' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
										<i class="fas fa-sort-up active" data-field="news_events.status" data-sort="desc"></i>
										<?php else: ?>
										<i class="fas fa-sort" data-field="news_events.status"></i>
										<?php endif; ?>
									</th>
									<th class="sort" width="15%">
										Is New
										<?php if(isset($_GET['sort']) && $_GET['sort'] == 'news_events.is_new' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
										<i class="fas fa-sort-down active" data-field="news_events.is_new" data-sort="asc"></i>
										<?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'news_events.is_new' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
										<i class="fas fa-sort-up active" data-field="news_events.is_new" data-sort="desc"></i>
										<?php else: ?>
										<i class="fas fa-sort" data-field="news_events.is_new"></i>
										<?php endif; ?>
									</th>
									<th class="sort" width="15%">
										Created On
										<?php if(isset($_GET['sort']) && $_GET['sort'] == 'news_events.date' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
										<i class="fas fa-sort-down active" data-field="news_events.date" data-sort="asc"></i>
										<?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'news_events.date' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
										<i class="fas fa-sort-up active" data-field="news_events.date" data-sort="desc"></i>
										<?php else: ?>
										<i class="fas fa-sort" data-field="news_events.date"></i>
										<?php endif; ?>
									</th>
									<th class="text-center" width="10%">
										Actions
									</th>
								</tr>
							</thead>
							<tbody class="list">
								<?php if(!empty($listing->items())): ?>
									@include('admin.newsEvents.listingLoop')
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
				</div>
			</div>
		</div>
	</div>
@endsection
