@extends('layouts.adminlayout')
@section('content')

<section>

				<div class="header bg-primary pb-6">

	<div class="container-fluid">

		<div class="header-body">

			<div class="row align-items-center py-4">

				<div class="col-lg-6 col-7">

					<h6 class="h2 text-white d-inline-block mb-0">Participant Management</h6>

				</div>

				<div class="col-lg-6 col-5 text-right">

					<a href="{{route('admin.participant')}}" class="btn btn-neutral"><i class="ni ni-bold-left"></i> Back</a>

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

				<div class="flash-message"></div>				
					<div class="card-header">

					<div class="row align-items-center">

						<div class="col-8">

							<h3 class="mb-0">Create New Participant Here.</h3>

						</div>

					</div>

				</div>
				@if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
				<div class="card-body">

			<form action="{{ route('admin.participant.edit', $participant->id)}}" method="post" enctype="multipart/form-data">
				@csrf
                <div class="row">
                  <div class="col-md-6">
				      <label>Full Name</label>
				      <input type="text" name="full_name" id="full_name" value="{{ old('full_name', $participant->full_name) }}" class="form-control">
				    </div>
				    <div class="col-md-6">
				      <label>User Name</label>
				      <input type="text" name="user_name" id="user_name" value="{{ old('user_name', $participant->user_name) }}" class="form-control" readonly>
				    </div>
				    <div class="col-md-6">
				      <label>Address</label>
				      <textarea name="address" id="address" class="form-control">{{ old('address', $participant->address) }}</textarea>
				    </div>
				    <div class="col-md-6">
				      <label>Corresponding Address</label>
				      <textarea name="corresponding_address" id="corresponding_address" class="form-control">{{ old('corresponding_address', $participant->corresponding_address) }}</textarea>
				    </div>
				    <div class="col-md-6">
				      <label>State</label>
				      <select class="form-control" name="state_id" id="state_id">
				        <option value="">---Select State---</option>
				        @foreach($states as $state)
				          <option value="{{ $state->id }}" {{ old('state_id', $participant->state_id) == $state->id ? 'selected' : '' }}>
				            {{ $state->name }}
				          </option>
				        @endforeach
				      </select>
				    </div>
				    <div class="col-md-6">
				      <label>District</label>
				      <select class="form-control" name="district_id" id="district_id">
				        <option value="">---Select District---</option>
				        @foreach($districts ?? [] as $district)
				          <option value="{{ $district->id }}" {{ old('district_id', $participant->district_id) == $district->id ? 'selected' : '' }}>
				            {{ $district->name }}
				          </option>
				        @endforeach
				      </select>
				    </div>
				    <div class="col-md-6">
				      <label>City</label>
				      <input type="text" name="city" id="city" value="{{ old('city', $participant->city) }}" class="form-control">
				    </div>
				    <div class="col-md-6">
				      <label>Mobile No.</label>
				      <input name="mobile" class="form-control" value="{{ old('mobile', $participant->mobile) }}" id="mobile" placeholder="Mobile Number *" required type="text" minlength="10" maxlength="10" pattern="[0-9]{10}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
				    </div>
				    <div class="col-md-6">
				      <label>Email Id</label>
				      <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $participant->email) }}">
				    </div>
				    <div class="col-md-6">
				      <label>Birth Date</label>
				      <input type="text" name="date_of_birth" id="date_of_birth" class="form-control datepicker" value="{{ old('date_of_birth', $participant->date_of_birth) }}">
				    </div>
				    <div class="col-md-6">
				      <label>Father Name</label>
				      <input type="text" name="father_name" id="father_name" class="form-control" value="{{ old('father_name', $participant->father_name) }}">
				    </div>
				    <div class="col-md-6">
				      <label>Mother Name</label>
				      <input type="text" name="mother_name" id="mother_name" class="form-control" value="{{ old('mother_name', $participant->mother_name) }}">
				    </div>
				    <div class="col-md-6">
				      <label>Gender</label>
				      <select name="gender" id="gender" class="form-control">
				        <option value="">~~Select Gender~~</option>
				        <option value="Male" {{ old('gender', $participant->gender) == 'Male' ? 'selected' : '' }}>Male</option>
				        <option value="Female" {{ old('gender', $participant->gender) == 'Female' ? 'selected' : '' }}>Female</option>
				      </select>
				    </div>
				    <div class="col-md-6">
				      <label>Physical Handicap</label>
				      <select name="is_physical_handicap" id="is_physical_handicap" class="form-control">
				        <option value="">~~Select~~</option>
				        <option value="Yes" {{ old('is_physical_handicap', $participant->is_physical_handicap) == 'Yes' ? 'selected' : '' }}>Yes</option>
				        <option value="No" {{ old('is_physical_handicap', $participant->is_physical_handicap) == 'No' ? 'selected' : '' }}>No</option>
				      </select>
				    </div>
				    <div class="col-md-6">
				      <label>Category</label>
				      <select name="caste_category" id="caste_category" class="form-control">
				        <option value="">~~Select Category~~</option>
				        <option value="Gen" {{ old('caste_category', $participant->caste_category) == 'Gen' ? 'selected' : '' }}>Gen</option>
				        <option value="SC" {{ old('caste_category', $participant->caste_category) == 'SC' ? 'selected' : '' }}>SC</option>
				        <option value="ST" {{ old('caste_category', $participant->caste_category) == 'ST' ? 'selected' : '' }}>ST</option>
				        <option value="OBC" {{ old('caste_category', $participant->caste_category) == 'OBC' ? 'selected' : '' }}>OBC</option>
				        <option value="Others" {{ old('caste_category', $participant->caste_category) == 'Others' ? 'selected' : '' }}>Others</option>
				      </select>
				    </div>
				    <div class="col-md-6">
				      <label>Aadhar Number</label>
				      <!-- <input type="text" name="aadhar_number" id="aadhar_number" class="form-control" value="{{ old('aadhar_number', $participant->aadhar_number) }}"> -->
				      <input name="aadhar_number" class="form-control" value="{{ old('aadhar_number', $participant->aadhar_number) }}" id="phone" placeholder="Enter Aadhar Number" required type="text" minlength="12" maxlength="12" pattern="[0-9]{12}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
				    </div>
				    <div class="col-md-6">
				      <label>Emergency Contact No</label>
				      <!-- <input type="text" name="emergency_contact" id="emergency_contact" class="form-control" value="{{ old('emergency_contact', $participant->emergency_contact) }}"> -->
				      <input name="emergency_contact" class="form-control" value="{{ old('emergency_contact', $participant->emergency_contact) }}" id="phone" placeholder="Emergency Contact Number" required type="text" minlength="10" maxlength="10" pattern="[0-9]{10}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
				    </div>
                  	<div class="col-md-6">
	                    <label class="control-label" for="linkname">Identity Proof <span class="text-danger">*</span></label>
	                    <input type="file" name="identity_proof" value="{{$participant->identity_proof}}" id="identity_proof" accept=".pdf, .jpg, .jpeg, .png" class="form-control checkFile">
	                    <small><span id="identity_proof" class="text-danger"></span></small>
	                    <span class="text-danger err-msg" id="err-identity_proof"></span>
	                    @if($participant->identity_proof)
						  <a href="{{ asset('uploads/participants/'.$participant->identity_proof) }}" target="_blank">View</a>
						@endif
					</div>
                  	<div class="col-md-6">
	                    <label class="control-label" for="linkname">Candidate Image<span class="text-danger">*</span></label>
	                    <input type="file" name="candidate_image" value="{{$participant->candidate_image}}" id="candidate_image" accept=".jpg, .jpeg, .png" class="form-control checkFile">
	                    <small><span id="candidate_image" class="text-danger"></span></small>
	                    <span class="text-danger err-msg" id="err-candidate_image"></span>
	                    @if($participant->candidate_image)
						  <a href="{{ asset('uploads/participants/'.$participant->candidate_image) }}" target="_blank">View</a>
						@endif
					</div>
                  <div class="col-md-6">
                    <label class="control-label" for="linkname">Category Proof <span class="text-danger">*</span></label>
                    <input type="file" name="category_proof" value="{{$participant->category_proof}}" id="category_proof" accept=".pdf, .jpg, .jpeg, .png" class="form-control checkFile">
                    <small><span id="category_proof" class="text-danger"></span></small>
                    <span class="text-danger err-msg" id="err-category_proof"></span>
                    @if($participant->category_proof)
					  <a href="{{ asset('uploads/participants/'.$participant->category_proof) }}" target="_blank">View</a>
					@endif 
				  </div>
                    
                  <div class="col-md-6">
                    <label class="control-label" for="linkname">Physical Handicap Proof <span class="text-danger">*</span></label>
                    <input type="file" name="handicap_proof" value="{{$participant->handicap_proof}}" id="handicap_proof" accept=".pdf, .jpg, .jpeg, .png" class="form-control checkFile">
                    <small><span id="handicap_proof" class="text-danger"></span></small>
                    <span class="text-danger err-msg" id="err-handicap_proof"></span>
                    @if($participant->handicap_proof)
					  <a href="{{ asset('uploads/participants/'.$participant->handicap_proof) }}" target="_blank">View</a>
					@endif
					</div>
				</div>
				<div class="row">
                   <div class="form-group col-md-12" style="padding:10px 0px 0px 0px;">
                    <h3 style="color:#2B75F7;">Qualification & Employment Details</h3>
                   </div>  
					<div class="form-group col-md-6">
						<label>Education Qualification<span class="text-danger" style="font-size:11.5px">*</span></label>
						<select name="qualification" class="form-control">
						    <option value="">~~Qualification~~</option>
						    @foreach(['10th','12th','Diploma','Graduation','Post Graduation','ITA'] as $qual)
						        <option value="{{ $qual }}"
						            {{ old('qualification', isset($participant) ? $participant->qualification : '') == $qual ? 'selected' : '' }}>
						            {{ $qual }}
						        </option>
						    @endforeach
						</select>
						<label class="control-label" for="linkname">Proof of Hightest Educational Qualification <span class="text-danger">*</span></label>
                        <input type="file" name="highe_education" value="{{$participant->highe_education}}" id="highe_education" accept=".pdf, .jpg, .jpeg, .png" class="form-control checkFile">
                        <small><span id="highe_education" class="text-danger"></span></small>
                        <span class="text-danger err-msg" id="err-highe_education"></span> 
						@if($participant->highe_education)
						  <a href="{{ asset('uploads/participants/'.$participant->highe_education) }}" target="_blank">View</a>
						@endif 
					</div>
                  
					<div class="form-group col-md-6">
						<label>Employment Status<span class="text-danger" style="font-size:11.5px">*</span></label>
						<select name="employment_status" class="form-control">
						  <option value="">~~Employment Status~~</option>
						  <option value="Yes" {{ old('employment_status', $participant->employment_status) == 'Yes' ? 'selected' : '' }}>Yes</option>
						  <option value="No" {{ old('employment_status', $participant->employment_status) == 'No' ? 'selected' : '' }}>No</option>
						  <option value="Self-Entrepreneur" {{ old('employment_status', $participant->employment_status) == 'Self-Entrepreneur' ? 'selected' : '' }}>Self-Entrepreneur</option>
						</select>
						<div class="row">
							<div class="col-md-6">
								<label>Organisation Name</label>
								<input id="organisation_name" name="organisation_name" type="text" value="{{ old('organisation_name', $participant->organisation_name) }}" class="form-control" aria-invalid="false" placeholder="" >
							</div>
							<div class="col-md-6">
								<label>Organisation Email</label>
								<input id="organisation_email" name="organisation_email" type="email" value="{{ old('organisation_email', $participant->organisation_email) }}" class="form-control" aria-invalid="false" placeholder="" >
							</div>
							<div class="col-md-6">
								<label>Organisation Phone</label>
								<!-- <input id="organisation_phone" name="organisation_phone" type="text" value="{{ old('organisation_phone', $participant->organisation_phone) }}" class="form-control" aria-invalid="false" placeholder="" > -->
								<input name="organisation_phone" class="form-control" value="{{ old('organisation_phone', $participant->organisation_phone) }}" id="organisation_phone" placeholder="" type="text" minlength="10" maxlength="10" pattern="[0-9]{10}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
							</div>
							<div class="col-md-6">
								<label class="control-label" for="linkname">3 months salary slip <span class="text-danger">*</span></label>
                                <input type="file" name="salary_slip" value="{{$participant->salary_slip}}" id="salary_slip" accept=".pdf, .jpg, .jpeg, .png" class="form-control checkFile" style="width:80%">
                                <small><span id="salary_slip" class="text-danger"></span></small>
                                <span class="text-danger err-msg" id="err-salary_slip"></span>
								@if($participant->salary_slip)
								  <a href="{{ asset('uploads/participants/'.$participant->salary_slip) }}" target="_blank">View</a>
								@endif 
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label>Company Name</label>
								<input id="company_name" name="company_name" type="text" value="{{ old('company_name', $participant->company_name) }}" class="form-control" aria-invalid="false" placeholder="" >
							</div>
							<div class="col-md-6">
								<label>Company Email</label>
								<input id="company_email" name="company_email" type="email" value="{{ old('company_email', $participant->company_email) }}" class="form-control" aria-invalid="false" placeholder="" >
							</div>
							<div class="col-md-6">
								<label>Company Phone</label>
								<!-- <input id="company_phone" name="company_phone" type="text" value="{{ old('company_phone', $participant->company_phone) }}" class="form-control" aria-invalid="false" placeholder="" > -->
								<input name="company_phone" class="form-control" value="{{ old('company_phone', $participant->company_phone) }}" id="company_phone" placeholder="" type="text" minlength="10" maxlength="10" pattern="[0-9]{10}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
							</div>
							<div class="col-md-6">
								<label class="control-label" for="linkname">Company Registration Certificate <span class="text-danger">*</span></label>
                                <input type="file" name="id_proof" value="{{$participant->id_proof}}" id="id_proof" accept=".pdf, .jpg, .jpeg, .png" class="form-control checkFile" style="width:80%">
                                <small><span id="id_proof" class="text-danger"></span></small>
                                <span class="text-danger err-msg" id="err-id_proof"></span>
								@if($participant->id_proof)
								  <a href="{{ asset('uploads/participants/'.$participant->id_proof) }}" target="_blank">View</a>
								@endif
							</div>
						</div>
					</div>
                </div>
				<div class="row">	
                
					
                  <div class="form-group col-md-12" style="padding:10px 0px 0px 0px;">
                    <h3 style="color:#2B75F7;">Course Details</h3>
                   </div> 
                 
                  <div class="col-md-6">
                    <label>Academic Session<span class="text-danger" style="font-size:11.5px">*</span></label>
                    <select name="academic_session" class="form-control">
					  @foreach($sessions as $session)
					    <option value="{{ $session }}" {{ old('academic_session', $participant->academic_session) == $session ? 'selected' : '' }}>{{ $session }}</option>
					  @endforeach
					</select>
                  </div>
                  
                  <div class="col-md-6 hide">
                    <label>Center<span class="text-danger" style="font-size:11.5px">*</span></label>
                    <select name="center_id" id="center_id" class="form-control">
					  <option value="">--Select Center--</option>
					  @foreach($centers as $center)
					    <option value="{{ $center->id }}" {{ old('center_id', $participant->center_id) == $center->id ? 'selected' : '' }}>{{ $center->title }}</option>
					  @endforeach
					</select>
                  </div>
				  <div class="col-md-6" id="getBatch">
                    <label>Batch<span class="text-danger" style="font-size:11.5px">*</span></label>
                    <select name="batch_id" id="batch_id" class="form-control">
					  <option value="">--Select Batch--</option>
					  @foreach($batches as $batch)
					    <option value="{{ $batch->id }}" {{ old('batch_id', $participant->batch_id) == $batch->id ? 'selected' : '' }}>{{ $batch->batch_title }}</option>
					  @endforeach
					</select>
                  </div>
                  <div class="col-md-6">
                    <label>Course Duration (Months) <span class="text-danger">*</span></label>
                    <input type="number" name="course_duration" class="form-control" value="{{ old('course_duration', $participant->course_duration) }}">
                </div>
                  <div class="col-md-6">
                    <label>Status<span class="text-danger" style="font-size:11.5px">*</span></label>
                    <select name="status" class="form-control">
					  <option value="New" {{ old('status', $participant->status) == 'New' ? 'selected' : '' }}>New</option>
					  <option value="Under-Training" {{ old('status', $participant->status) == 'Under-Training' ? 'selected' : '' }}>Under-Training</option>
					  <option value="Trained" {{ old('status', $participant->status) == 'Trained' ? 'selected' : '' }}>Trained</option>
					</select>
                  </div>
                  <hr class="my-4" />
                <div class="col-md-12 mt-3">
                    <!-- <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('admin.participant') }}" class="btn btn-danger">Cancel</a> -->
                    
					<button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
						<i class="fa fa-save"></i> Submit
					</button>
                </div>
                </form>
			</div>
					</div>

			</div>

		</div>

	</div>

</div>
</section>


<script>
	document.addEventListener("DOMContentLoaded", function () {

        function validateFileGeneric(inputId, errorId, allowedExtensions, maxSizeMB = 5) {
            const input = document.getElementById(inputId);
            if (!input) return; // skip if field doesn't exist
            const errorElement = document.getElementById(errorId);
            input.addEventListener('change', function () {
                errorElement.textContent = "";
                const file = this.files[0];
                if (file) {
                    // check extension
                    const extRegex = new RegExp(`(${allowedExtensions.join('|')})$`, 'i');
                    if (!extRegex.test(file.name)) {
                        errorElement.textContent = `Please select only ${allowedExtensions.join(', ')} formats`;
                        this.value = "";
                        return;
                    }
                    // check file size
                    const fileSizeMB = file.size / 1024 / 1024;
                    if (fileSizeMB > maxSizeMB) {
                        errorElement.textContent = `File size must not exceed ${maxSizeMB} MB`;
                        this.value = "";
                        return;
                    }
                }
            });
        }

        // ✅ Example usage
        validateFileGeneric('candidate_image', 'err-candidate_image', ['.jpg', '.jpeg', '.png']);
        validateFileGeneric('identity_proof', 'err-identity_proof', ['.pdf', '.jpg', '.jpeg', '.png']);
        validateFileGeneric('category_proof', 'err-category_proof', ['.pdf', '.jpg', '.jpeg', '.png']);
        validateFileGeneric('handicap_proof', 'err-handicap_proof', ['.pdf', '.jpg', '.jpeg', '.png']);
        validateFileGeneric('salary_slip', 'err-salary_slip', ['.pdf', '.jpg', '.jpeg', '.png']);
        validateFileGeneric('company_registration', 'err-company_registration', ['.pdf', '.jpg', '.jpeg', '.png']);
        validateFileGeneric('highe_education', 'err-highe_education', ['.pdf', '.jpg', '.jpeg', '.png']);
        validateFileGeneric('id_proof', 'err-id_proof', ['.pdf', '.jpg', '.jpeg', '.png']);

    });

	function getDistrictList(state_id) {
        if(state_id) {
            $.ajax({
                url: "{{ url('get-districts') }}/" + state_id,   // Route URL
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#district_id').empty(); // clear old options
                    $('#district_id').append('<option value="">---Select District---</option>');
                    $.each(data, function(key, district){
                        $('#district_id').append('<option value="'+ district.id +'">'+ district.name +'</option>');
                    });
                },
                error: function() {
                    alert("Something went wrong while fetching districts!");
                }
            });
        } else {
            $('#district_id').empty();
            $('#district_id').append('<option value="">---Select District---</option>');
        }
    }
</script>
@endsection
