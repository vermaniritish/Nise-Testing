<?php use App\Models\Admin\CustomPageData; ?>
@extends('layouts.frontendlayout')
@section('content')
<section id="promondex2" class="section-padding" style="padding-top:50px;">
        <div class="container">	 
			<div class="row mb-5">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12 pr-lg-5 pr-md-5 pr-sm-0 pr-0 mb-lg-0 mb-md-0 mb-sm-5 mb-5 faq-page-into">
					<h6>User Dashboard</h6>
					<h4>Welcome Username!</h4><span style="display:inline-block;"><a href="index.php">Logout</a></span>
					<div class="steam-details-tab">
						<div class="row">
							<div class="col-12">
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item"><a class="nav-link active" href="#" data-target="#srone" data-toggle="tab">My Details</a></li>
									<li class="nav-item"><a class="nav-link" href="#" data-target="#srtwo" data-toggle="tab">My Orders</a></li>
									
								</ul>
								<!-- Tab panes -->
								<div class="tab-content">
									<div class="tab-pane animated fadeInRight active show" id="srone">
										<div class="row" style="margin:0;">
											<form method="post" id="myprofile-form" class="register_form account-form">
											<div class="row">
												<div class="form-group col-md-12 col-sm-12">
													<label>Download this FeedBack Form from here <a href="https://nise.res.in/wp-content/uploads/2023/10/FEEDBACK-FORM.pdf" target="_blank">Click Here</a></label>
													<br/><br/>
												</div>
												
											</div>

											<div class="row">
												<div class="form-group col-md-6 col-sm-6">
													<label>Registration Type:</label>
													<input class="form-control" type="text" name="reg_type" value="Company" disabled required >
												</div>
												<div class="form-group col-md-6 col-sm-6">
													<label>Name of Company:</label><br/>
													<input class="form-control" value="NISE" type="text" disabled required name="company_name">
												</div>
												
											</div>

											<br/>
											<div class="row">
												<div class="form-group col-md-4 col-sm-4">
													<label>Name of Contact Person:</label>
													<input class="form-control" value="UMAKANTA SAHOO" type="text" required name="your_name" >
												</div>
												<div class="form-group col-md-4 col-sm-4">
													<label>Contact No. of Person:</label>
													<input class="form-control" value="8802760453" required name="your_contact_number" type="text" >
												</div>
												<div class="form-group col-md-4 col-sm-4">
													<label>Authorized Email id:</label><br/>
													<input class="form-control" type="email" name="email_id" value="uksahoo@nise.res.in" required >
												</div>
												
											</div>

											<br/>
											<div class="row">
												<div class="form-group col-md-12 col-sm-12">
													<label>Address:</label>
													<input class="form-control" value="GWAL PAHARI" type="text"  required name="address1">
													<input class="form-control" value="GWAL PAHARI" type="text"  required name="address2"> 
												</div>
											</div>
											<br/>
											<div class="row">
													<div class="form-group col-md-4 col-sm-4">
														<label>State:</label>
														<select class="selectpicker show-tick form-control" required name="state" data-live-search="false" style="height: 36px;">
															<option value="">Select</option>
															<option  value="1" >ANDAMAN AND NICOBAR ISLANDS</option>
															<option  value="2" >ANDHRA PRADESH</option>
															<option  value="3" >ARUNACHAL PRADESH</option>
															<option  value="4" >ASSAM</option>
															<option  value="5" >BIHAR</option>
															<option  value="6" >CHATTISGARH</option>
															<option  value="7" >CHANDIGARH</option>
															<option  value="8" >DAMAN AND DIU</option>
															<option  value="9" >DELHI</option>
															<option  value="10" >DADRA AND NAGAR HAVELI</option>
															<option  value="11" >GOA</option>
															<option  value="12" >GUJARAT</option>
															<option  value="13" >HIMACHAL PRADESH</option>
															<option  value="14" selected>HARYANA</option>
															<option  value="15" >JAMMU AND KASHMIR</option>
															<option  value="16" >JHARKHAND</option>
															<option  value="17" >KERALA</option>
															<option  value="18" >KARNATAKA</option>
															<option  value="19" >LAKSHADWEEP</option>
															<option  value="20" >MEGHALAYA</option>
															<option  value="21" >MAHARASHTRA</option>
															<option  value="22" >MANIPUR</option>
															<option  value="23" >MADHYA PRADESH</option>
															<option  value="24" >MIZORAM</option>
															<option  value="25" >NAGALAND</option>
															<option  value="26" >ORISSA</option>
															<option  value="27" >PUNJAB</option>
															<option  value="28" >PONDICHERRY</option>
															<option  value="29" >RAJASTHAN</option>
															<option  value="30" >SIKKIM</option>
															<option  value="31" >TAMIL NADU</option>
															<option  value="32" >TRIPURA</option>
															<option  value="33" >UTTARAKHAND</option>
															<option  value="34" >UTTAR PRADESH</option>
															<option  value="35" >WEST BENGAL</option>
																	
														  
														</select> 
													</div>
													<div class="form-group col-md-4 col-sm-4">
														<label>City / District:</label>
														<input class="form-control" value="GURGAON" type="text" required name="city_or_district" >
													</div>
													<div class="form-group col-md-4 col-sm-4">
														<label>Pin Code</label>
														<input class="form-control" value="122003" required name="pin_code" type="text" >
													</div>
													
												</div>
												<br/>
												<div class="row">
													<div class="form-group col-md-4 col-sm-4">
														<label>Company PAN Number</label>
														<input class="form-control" value="AAAJN0939P" required name="pan_number" type="text" >
													</div>
													<div class="form-group col-md-4 col-sm-4">
														<label>Company TIN Number</label>
														<input class="form-control" value="06AAAJN0939P1ZR" required name="tin_number" type="text">
													</div>
													<div class="form-group col-md-4 col-sm-4">
														<label>Company GST Number</label>
														<input class="form-control" value="" required name="gst_number" type="text" >
													</div>
												</div>
												<br>
												 <input value="Save" name="update_profile" class="btn btn-warning btn-save pull-right" type="submit">
												 
												
											</form>
										</div>
									</div>
									<div class="tab-pane animated fadeInRight" id="srtwo">
										<div class="row">
											<div class="table-responsive"> 
												<table id="example" class="table table-bordered order-table theme-table table-striped" cellspacing="0" width="100%"> 
													<thead> 
														<tr> 
															<th>Order No</th> 
															<th>Order Date</th> 
															<th>Test Description</th> 
															<th>Price</th> 
															<th>Payment Details</th> 
															<th>Status</th> 
															<th>Reason for Cancellation/Rejection</th> 
															<th>Order Completion Date</th> 
															<th>Download Report</th> 
															<th>Print</th> 
														</tr> 
													</thead> 
													<tbody>
													
													</tbody> 
												</table> 
											</div>
										</div>
										
									</div>
									
								</div>
							</div>
						</div>
					</div>
					
				</div>
								
			</div>
	</div>
    </section>
@endsection