<?php require_once 'header.php'; ?>
<?php require_once 'left.php'; ?>
<?php require_once 'header-bottom.php'; ?>

<!-- Content render here -->
<section>
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Center Management</h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <!--<a href="addcenter.php" class="btn btn-neutral"><i class="fas fa-plus"></i>New</a>-->
                    </div>
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
                    </div> <!-- Card header -->
                    <div class="card-header border-0">
                        <div class="heading">
                            <h3 class="mb-0">Here Is Your Centers!</h3>
                        </div>
                        <div class="actions">
                            <div class="input-group input-group-alternative input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input class="form-control listing-search" placeholder="Search" type="text" value="">
                            </div>
                            <!--<div class="dropdown" data-toggle="tooltip" data-designation="Bulk Actions" data-original-title="" title="">
                                <a class="btn btn-sm btn-icon-only text-warning" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a href="javascript:void(0);" class="waves-effect waves-block dropdown-item text-danger" onclick="bulk_actions('https://pldcomp.ae/admin/slider-menu/bulkActions/delete', 'delete');">
                                        <i class="fas fa-times text-danger"></i>
                                        <span class="status text-danger">Delete</span>
                                    </a>
                                </div>
                            </div>-->
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!--!!!!! DO NOT REMOVE listing-table, mark_all  CLASSES. INCLUDE THIS IN ALL TABLES LISTING PAGES !!!!!-->
                        <table class="table align-items-center table-flush listing-table">
                            <thead class="thead-light">
                                <tr>
                                    <!--<th class="checkbox-th" width="5%">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input mark_all" id="mark_all">
                                            <label class="custom-control-label" for="mark_all"></label>
                                        </div>
                                    </th>-->
                                    <th class="sort" width="5%">
                                        <!--- MAKE SURE TO USE PROPOER FIELD IN data-field AND PROPOER DIRECTION IN data-sort -->
                                        S.no
                                        <i class="fas fa-sort" data-field="slider_menu.id" data-sort="asc"></i>
                                    </th>
                                    <th class="sort" width="">
                                        Center Name/e-Mail
                                        <i class="fas fa-sort" data-field="slider_menu.name"></i>
                                    </th>
                                    <th class="sort" width="">
                                        Center ID
                                        <i class="fas fa-sort" data-field="slider_menu.name"></i>
                                    </th>
                                    <th class="sort" width="">
                                        Contact No.
                                        <i class="fas fa-sort" data-field="slider_menu.name"></i>
                                    </th>									<th class="sort" width="15%">                                        State                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>                                    </th>									<th class="sort" width="15%">                                        City                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>                                    </th>
                                    <th class="sort" width="15%">
                                        Status
                                        <i class="fas fa-sort" data-field="slider_menu.status"></i>
                                    </th>
                                    
                                    <th class="text-center" width="10%">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php for($i = 0; $i < 10; $i++): ?>
                                <tr>																	<!-- MAKE SURE THIS HAS ID CORRECT AND VALUES CORRENCT. THIS WILL EFFECT ON BULK CRUTIAL ACTIONS -->
                                    <!--<td>
                                        
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input listing_check" id="listing_check0" value="4">
                                            <label class="custom-control-label" for="listing_check0"></label>
                                        </div>
                                    </td>-->
                                    <td>
                                        <span class="badge badge-dot mr-4">
                                            <i class="bg-warning"></i>
                                            <span class="status"><?php echo $i+1 ?></span>
                                        </span>
                                    </td>
                                    <td>test<br/>Email: karanshail001@gmail.com</td>
                                    <td>INST-CEN-1111106/CEN/CH/680</td>
                                    <td>8700373306</td>
                                    
                                    <td>
                                        Chandigarh </td>									<td>									                                        Chandigarh </td>									<td>                                        <div class="custom-control">                                            <label class="custom-toggle">                                                <input type="checkbox" name="status" onchange="switch_action('https://pldcomp.ae/admin/actions/slider_menu/switchUpdate/status/4', this)" value="1" checked="">                                                <span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON"></span>                                            </label>                                        </div>                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-warning" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="editcenter.php">
                                                    <i class="fas fa-pencil-alt text-info"></i>
                                                    <span class="status">Edit</span>
                                                </a>

                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item _delete" href="javascript:;" data-link="https://pldcomp.ae/admin/slider-menu/4/delete">
                                                    <i class="fas fa-times text-danger"></i>
                                                    <span class="status text-danger">Delete</span>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th align="left" colspan="20">
                                        <div class="ajaxPaginationEnabled loader text-center hidden" data-url="https://pldcomp.ae/admin/slider-menu" data-page="1" data-counter="10" data-total="2">
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
    <!-- Modal -->
</section>
<!-- Content -->
<?php require_once 'footer.php'; ?>