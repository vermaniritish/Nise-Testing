@extends('layouts.adminlayout')
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Manage Test Managements</h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        @include('admin.testManagements.filters')
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
                            <h3 class="mb-0">Here Is Your Test Management!</h3>
                        </div>
                        <div class="actions">
                            <div class="input-group input-group-alternative input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input class="form-control listing-search" placeholder="Search" type="text" value="<?php echo (isset($_GET['search']) && $_GET['search'] ? $_GET['search'] : '') ?>">
                            </div>
                            <?php if(Permissions::hasPermission('test_managements', 'delete')): ?>
                            <div class="dropdown" data-toggle="tooltip" data-designation="Bulk Actions" >
                                <a class="btn btn-sm btn-icon-only text-warning" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a
                                        href="javascript:void(0);"
                                        class="waves-effect waves-block dropdown-item text-danger"
                                        onclick="bulk_actions('<?php echo route('admin.testManagements.bulkActions', ['action' => 'delete']) ?>', 'delete');">
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
                                    <th class="checkbox-th text-center">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input mark_all" id="mark_all">
											<label class="custom-control-label" for="mark_all"></label>
										</div>
									</th>
                                    <th style="vertical-align:top;" class="sort">
                                        Test job id
                                        <?php if(isset($_GET['sort']) && $_GET['sort'] == 'order_number' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
                                        <i class="fas fa-sort-down active" data-field="order_number" data-sort="asc"></i>
                                        <?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'order_number' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
                                        <i class="fas fa-sort-up active" data-field="order_number" data-sort="desc"></i>
                                        <?php else: ?>
                                        <i class="fas fa-sort" data-field="order_number"></i>
                                        <?php endif; ?>
                                    </th>
                                    <th style="vertical-align:top;" class="sort">
                                        Test Service
                                        <?php if(isset($_GET['sort']) && $_GET['sort'] == 'service_title' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
                                        <i class="fas fa-sort-down active" data-field="service_title" data-sort="asc"></i>
                                        <?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'service_title' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
                                        <i class="fas fa-sort-up active" data-field="service_title" data-sort="desc"></i>
                                        <?php else: ?>
                                        <i class="fas fa-sort" data-field="service_title"></i>
                                        <?php endif; ?>
                                    </th>
                                    <th style="vertical-align:top;" class="sort">
                                        Test Type
                                        <?php if(isset($_GET['sort']) && $_GET['sort'] == 'category_title' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
                                        <i class="fas fa-sort-down active" data-field="category_title" data-sort="asc"></i>
                                        <?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'category_title' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
                                        <i class="fas fa-sort-up active" data-field="category_title" data-sort="desc"></i>
                                        <?php else: ?>
                                        <i class="fas fa-sort" data-field="category_title"></i>
                                        <?php endif; ?>
                                    </th>
                                    <th style="vertical-align:top;" class="sort">
                                        Order Date
                                        <?php if(isset($_GET['sort']) && $_GET['sort'] == 'orders.created' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
                                        <i class="fas fa-sort-down active" data-field="orders.created" data-sort="asc"></i>
                                        <?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'orders.created' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
                                        <i class="fas fa-sort-up active" data-field="orders.created" data-sort="desc"></i>
                                        <?php else: ?>
                                        <i class="fas fa-sort" data-field="orders.created"></i>
                                        <?php endif; ?>
                                    </th>
                                    <!-- <th style="vertical-align:top;" class="sort">
                                        Assign Job
                                        <?php if(isset($_GET['sort']) && $_GET['sort'] == 'test_managements.assign_job' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
                                        <i class="fas fa-sort-down active" data-field="test_managements.assign_job" data-sort="asc"></i>
                                        <?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'test_managements.assign_job' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
                                        <i class="fas fa-sort-up active" data-field="test_managements.assign_job" data-sort="desc"></i>
                                        <?php else: ?>
                                        <i class="fas fa-sort" data-field="test_managements.assign_job"></i>
                                        <?php endif; ?>
                                    </th>
                                    <th style="vertical-align:top;" class="sort">
                                        Assigned Date
                                        <?php if(isset($_GET['sort']) && $_GET['sort'] == 'test_managements.assigned_date' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
                                        <i class="fas fa-sort-down active" data-field="test_managements.assigned_date" data-sort="asc"></i>
                                        <?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'test_managements.assigned_date' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
                                        <i class="fas fa-sort-up active" data-field="test_managements.assigned_date" data-sort="desc"></i>
                                        <?php else: ?>
                                        <i class="fas fa-sort" data-field="test_managements.assigned_date"></i>
                                        <?php endif; ?>
                                    </th>
                                    <th style="vertical-align:top;" class="sort">
                                        Test Status
                                        <?php if(isset($_GET['sort']) && $_GET['sort'] == 'test_managements.test_status' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
                                        <i class="fas fa-sort-down active" data-field="test_managements.test_status" data-sort="asc"></i>
                                        <?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'test_managements.test_status' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
                                        <i class="fas fa-sort-up active" data-field="test_managements.test_status" data-sort="desc"></i>
                                        <?php else: ?>
                                        <i class="fas fa-sort" data-field="test_managements.test_status"></i>
                                        <?php endif; ?>
                                    </th>
                                    <th style="vertical-align:top;" class="sort">
                                        Test Start Date
                                        <?php if(isset($_GET['sort']) && $_GET['sort'] == 'test_managements.test_start_date' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
                                        <i class="fas fa-sort-down active" data-field="test_managements.test_start_date" data-sort="asc"></i>
                                        <?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'test_managements.test_start_date' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
                                        <i class="fas fa-sort-up active" data-field="test_managements.test_start_date" data-sort="desc"></i>
                                        <?php else: ?>
                                        <i class="fas fa-sort" data-field="test_managements.test_start_date"></i>
                                        <?php endif; ?>
                                    </th>
                                    <th style="vertical-align:top;" class="sort">
                                        Test Job Completion Date
                                        <?php if(isset($_GET['sort']) && $_GET['sort'] == 'test_managements.test_job_completion_date' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
                                        <i class="fas fa-sort-down active" data-field="test_managements.test_job_completion_date" data-sort="asc"></i>
                                        <?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'test_managements.test_job_completion_date' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
                                        <i class="fas fa-sort-up active" data-field="test_managements.test_job_completion_date" data-sort="desc"></i>
                                        <?php else: ?>
                                        <i class="fas fa-sort" data-field="test_managements.test_job_completion_date"></i>
                                        <?php endif; ?>
                                    </th>
                                    <th style="vertical-align:top;" class="sort">
                                        Actual Completion Date
                                        <?php if(isset($_GET['sort']) && $_GET['sort'] == 'test_managements.actual_completion_date' && isset($_GET['direction']) && $_GET['direction'] == 'asc'): ?>
                                        <i class="fas fa-sort-down active" data-field="test_managements.actual_completion_date" data-sort="asc"></i>
                                        <?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'test_managements.actual_completion_date' && isset($_GET['direction']) && $_GET['direction'] == 'desc'): ?>
                                        <i class="fas fa-sort-up active" data-field="test_managements.actual_completion_date" data-sort="desc"></i>
                                        <?php else: ?>
                                        <i class="fas fa-sort" data-field="test_managements.actual_completion_date"></i>
                                        <?php endif; ?>
                                    </th> -->
                                    <th class="text-center" width="55%">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php if(!empty($listing->items())): ?>
                                    @include('admin.testManagements.listingLoop')
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
