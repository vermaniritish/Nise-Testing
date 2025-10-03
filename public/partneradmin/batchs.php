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
                        <h6 class="h2 text-white d-inline-block mb-0">Batch Management</h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="addbatch.php" class="btn btn-neutral"><i class="fas fa-plus"></i>New</a>
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
                    </div> <!-- Card header -->					<div class="card-header border-0">                        <form action="" method="post">							<div class="box box-solid">							<!-- /.box-header -->							<div class="box-body">								<div class="box-group" id="accordion">								<div class="row">									<div class="col-lg-3 col-md-3 col-xs-12">									  <label for="icon">Financial Year <span class="text-danger">*</span></label>									   <select name="tranSession" id="tranSession" class="form-control">										   <option value="">~~Select FY~~</option><option value="2017-2018">2017-2018</option><option value="2018-2019">2018-2019</option><option value="2019-2020">2019-2020</option><option value="2020-2021">2020-2021</option><option value="2021-2022">2021-2022</option><option value="2022-2023">2022-2023</option><option value="2023-2024">2023-2024</option><option value="2024-2025">2024-2025</option>                            </select>										<i id="loader"></i>									</div>									<div class="col-lg-3 col-md-3 col-xs-12">									  <label for="icon">State <span class="text-danger">*</span></label>									   <select name="tranSession" id="tranSession" class="form-control">										   <option value="">~~Select State~~</option><option value="all">ALL</option><option value="DELHI">DELHI</option><option value="PUNJAB">PUNJAB</option><option value="UTTARAKHAND">UTTARAKHAND</option><option value="HARYANA">HARYANA</option><option value="RAJASTHAN">RAJASTHAN</option><option value="UTTAR PRADESH">UTTAR PRADESH</option><option value="MADHYA PRADESH">MADHYA PRADESH</option>                            </select>										<i id="loader"></i>									</div>									<div class="col-lg-3 col-md-3 col-xs-12">									  <label for="icon">Select Institutes <span class="text-danger">*</span></label>									   <select name="institute" id="institute" class="form-control" onchange="getCenterList(this.value)">											<option value="">~~Select Institute~~</option>											<option value="52706"> NICT	ATKOT</option>											<option value="11313">Aadit Systems</option>											<option value="53447">Aarav Educational &amp; Employment Research Organization</option>											<option value="52734">AARAV EDUCATIONAL &amp; EMPLOYMENT RESEARCH ORG.</option>											<option value="11314">Aaruthal Foundation</option>											<option value="41643">Academy for Computer Trainig (Guj.) Pvt. Ltd.</option>											<option value="53398">Access Edutech Private Limited</option>											<option value="53453">Adhishree Skills Private Limited</option>											<option value="5362">ADS Foundation</option>											<option value="41644">Afadul Hasan Welfare Society</option>											<option value="5364">Agrasen Polytechnic College</option>											<option value="11315">AISECT</option>											<option value="52841">Rawat Bal Vidha Niketan Samittee</option>											<option value="5356">Salt lake Institute Of Engineering &amp; Management</option>											<option value="46435">Yadupati Singhania Centre for Vocational Skill Development</option>											<option value="5391">YouthNet</option>											<option value="52945">ZRIMA EDUTECH PRIVATE LIMITED</option>                                       </select>									</div>									<div class="col-lg-3 col-md-3 col-xs-12"><br>									<div class="col-lg-3 col-md-3 col-xs-12"><br>										<input class="submit btn btn-success " style="margin-right:5px" name="submit" type="button" onclick="getDataReport()" value="Search">										<span id="loader"></span>									</div>								</div>								</div>							</div><!-- /.box-body -->							</div><!-- /.box -->						<input type="hidden" name="csrf" value="F0fEIT3S9PF50i9DV2srMb5dBo50I3rRlAi">						</form>					</div>  
                    <div class="card-header border-0">
                        <div class="heading">
                            <h3 class="mb-0">Here Is Your Batchs!</h3>
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
                                        Batch ID
                                        <i class="fas fa-sort" data-field="slider_menu.name"></i>
                                    </th>
                                    <th class="sort" width="">
                                        Batch Name
                                        <i class="fas fa-sort" data-field="slider_menu.name"></i>
                                    </th>									<th class="sort" width="">                                        Batch Strength                                        <i class="fas fa-sort" data-field="slider_menu.name"></i>                                    </th>
                                    <th class="sort" width="">
                                        Center.
                                        <i class="fas fa-sort" data-field="slider_menu.name"></i>
                                    </th>									<th class="sort" width="15%">                                        Start From                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>                                    </th>									<th class="sort" width="15%">                                        End To                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>                                    </th>
                                    <th class="sort" width="15%">
                                        Acedemic Session
                                        <i class="fas fa-sort" data-field="slider_menu.status"></i>
                                    </th>									<th class="sort" width="15%">                                        Sanction Year                                        <i class="fas fa-sort" data-field="slider_menu.status"></i>                                    </th>									<th class="sort" width="15%">                                        Status                                        <i class="fas fa-sort" data-field="slider_menu.status"></i>                                    </th>									<th class="sort" width="15%">                                        Sanctioned Letter                                        <i class="fas fa-sort" data-field="slider_menu.status"></i>                                    </th>
                                    
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
                                    <td>BCH/2018-2019/35880</td>
                                    <td>NISE TEST</td>									<td>30</td>
                                    <td>anish malan<br>(<strong>INST-CEN-1111106/CEN/DL/114</strong>)</td>
                                    <td>08, Nov 2022</td>									<td>23, Mar 2023</td>									<td>2018-2019</td>									<td>2019-2020</td>									<td>OnGoing</td>									<td><a href="#">PDF File</a></td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-warning" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="editbatch.php">
                                                    <i class="fas fa-pencil-alt text-info"></i>
                                                    <span class="status">Edit</span>
                                                </a>

                                                <!--<div class="dropdown-divider"></div>												<a class="dropdown-item" href="addparticipant.php">                                                    <i class="fas fa-plus text-info"></i>                                                    <span class="status">Add Participant</span>                                                </a>-->                                                
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