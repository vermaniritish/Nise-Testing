<?php require_once 'header.php'; ?>
<?php require_once 'left.php'; ?>
<?php require_once 'header-bottom.php'; ?>

<section>
				<div class="header bg-primary pb-6">
	<div class="container-fluid">
		<div class="header-body">
			<div class="row align-items-center py-4">
				<div class="col-lg-6 col-7">
					<h6 class="h2 text-white d-inline-block mb-0">Batch Management</h6>
				</div>
				<div class="col-lg-6 col-5 text-right">
					<a href="participants.php" class="btn btn-neutral"><i class="ni ni-bold-left"></i> Back</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
	<div class="row">
		<div class="col-xl-12 order-xl-1">
        <div class="card">
				<!--!! FLAST MESSAGES !!-->
				<div class="flash-message">
        </div>				<div class="card-header">
					<div class="row align-items-center">
						<div class="col-8">
							<h3 class="mb-0">Edit/Update Batch Here.</h3>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form action="" method="post" onsubmit="return validBatchAddForm()" enctype="multipart/form-data">						  <div class="row">							<div class="form-group col-md-6">							  <label>Center<span class="text-danger">*</span></label>							  <select name="center" id="center" class="form-control" disabled>								<option value="">Select Center</option>								<option value="46414">anish malan(DELHI-New Delhi)</option>								<option value="49266">NISE Document(HARYANA-Gurugram)</option>								<option value="51934">Test center name(UTTAR PRADESH-Amroha)</option>								<option value="52640" selected>Center My Test(DELHI-New Delhi)</option>							  </select>							</div>							<div class="form-group col-md-6">							  <label>Academic Session<span class="text-danger">*</span></label>							  <select name="academicSession" id="academicSession" class="form-control" onchange="checkAllowBatch(this.value)" disabled>								<option value="">~~~~~~~Select Session ~~~~~~~</option><option value="2017-2018">2017-2018</option><option value="2018-2019">2018-2019</option><option value="2019-2020">2019-2020</option><option value="2020-2021">2020-2021</option><option value="2021-2022">2021-2022</option><option value="2022-2023">2022-2023</option><option value="2023-2024">2023-2024</option><option selected value="2024-2025">2024-2025</option>                                      </select>							</div>							<div class="form-group col-md-6">							  <label>Sanction Year<span class="text-danger">*</span></label>							  <select name="academicSession" id="academicSession" class="form-control" disabled onchange="checkAllowBatch(this.value)">								<option value="">~~~~~~~Select Session ~~~~~~~</option><option value="2017-2018">2017-2018</option><option value="2018-2019">2018-2019</option><option value="2019-2020">2019-2020</option><option value="2020-2021">2020-2021</option><option value="2021-2022">2021-2022</option><option value="2022-2023">2022-2023</option><option value="2023-2024">2023-2024</option><option value="2024-2025" selected>2024-2025</option>                                      </select>							</div>							<div class="form-group col-md-6">							  <label>Batch Strength<span class="text-danger">*</span></label>							  <input type="text" disabled name="batchName" id="batchName" value="15" size="60" class="form-control " placeholder="Enter Batch Name">							</div>							<div class="form-group col-md-6">							  <label>Batch Title ex.[Centre_FY_Location]<span class="text-danger">*</span></label>							  <input type="text" name="batchName" disabled id="batchName" value="BATCH-123" size="60" class="form-control " placeholder="Enter Batch Name">							</div>							<div class="form-group col-md-6">							  <label>Tentative Batch Start Date<span class="text-danger">*</span></label>							  <input type="text" name="batchStart" id="batchStart" disabled class="form-control datepicker" value="01/09/24" >							</div>							<div class="form-group col-md-6">							  <label>End To<span class="text-danger">*</span></label>							  <input type="text" name="batchEnd" id="batchEnd" disabled class="form-control datepicker" value="31/03/25">							</div>							<div class="form-group col-md-6">							  <label>Status<span class="text-danger">*</span></label>							  <select name="status" id="status" class="form-control" onchange="showDiv(this.value)" disabled>								<option value="">~~~~~~~Select status~~~~~~~</option>								<option value="Completed">Completed</option>								<option value="OnGoing">OnGoing</option>								<option value="New" selected>Yet to Start/New</option>								<!--<option value="Inactive" >Inactive</option>-->							  </select>							</div>							<div class="form-group col-md-12" id="photoDiv" style="display:none">							  <table class="table table-bordered">								<tbody><tr>								  <td colspan="3"><span class="text-danger"><em>TP may upload 5 to 10 pictures (per batch) of participants in classroom, lab, industry visit, hands on experience etc. </em></span></td>								</tr>								<tr>								  <th>Gallery/Image Title</th>								  <th width="25%">Upload Image</th>								  <th width="5%"></th>								</tr>								</tbody><tbody id="tbody">													  </tbody>								<tbody><tr>								  <td colspan="9"><input type="button" class="btn btn-warning input-sm1" id="add" name="addMore" value="Add More"></td>								</tr>							  </tbody></table>							</div>							<div class="form-group col-md-12">							  <input type="submit" value="Submit" class="btn btn-primary">							  <button type="button" onclick="window.location='https://suryamitra.nise.res.in/Partner/Batch'" class="btn btn-danger">Cancel</button>							  <input type="hidden" name="csrf" value="BPRP92r3O7o2T4z7OHpWk5CUd3S85K969a9">							  <input type="hidden" name="action" value="edit">							  <input type="hidden" name="id" value="ZDRlYWMwZGI2MDQwYmYyNjgyNTc4NWQ3OGY0NmFkZTd8ODEzNjQ4MA==">							  <input type="hidden" name="statecd" value="23">							</div>						  </div>					</form>					</div>
				</div>
		</div>
	</div>
</div>
			</section>
			
<?php require_once 'footer.php'; ?>