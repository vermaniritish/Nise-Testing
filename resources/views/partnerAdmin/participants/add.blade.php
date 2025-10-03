@extends('layouts.partneradminlayout')
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

				<div class="flash-message"></div>				
					<div class="card-header">

					<div class="row align-items-center">

						<div class="col-8">

							<h3 class="mb-0">Create New Participant Here.</h3>

						</div>

					</div>

				</div>
				@if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->getMessages() as $field => $messages)
                                @foreach ($messages as $message)
                                    <li><strong>{{ ucfirst(str_replace('_', ' ', $field)) }}:</strong> {{ $message }}</li>
                                @endforeach
                            @endforeach
                        </ul>
                    </div>
                @endif
				<div class="card-body">

			<form action="{{ route('partnerAdmin.participant.add') }}" method="post" onsubmit="return validSryamitraAddForm()" enctype="multipart/form-data">
				@csrf
                <div class="row">
                  <div class="col-md-6">
                    <label>Full Name<span class="text-danger" style="font-size:11.5px">*</span></label>
                    <input type="text" name="full_name" id="full_name" value="" size="40" class="form-control" placeholder="* Candidate Name">
                    @error('full_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label>User Name</label>
                    <input type="text" name="user_name" id="user_name" value="" class="form-control" aria-invalid="false" placeholder="" readonly="">
                    @error('user_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label>Address<span class="text-danger" style="font-size:11.5px">*</span></label>
                    <textarea name="address" id="address" placeholder="* Enter address here..." cols="20" rows="5" class="form-control"></textarea>
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label>Corresponding Address<span class="text-danger" style="font-size:11.5px">*</span></label>
                    <textarea name="corresponding_address" id="corresponding_address" placeholder="* Enter correspondance address here..." cols="20" rows="5" class="form-control"></textarea>
                    @error('corresponding_address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label>State<span class="text-danger" style="font-size:11.5px">*</span></label>
                    <select class="form-control" name="state_id" id="state_id" required onchange="getDistrictList(this.value)">
                        <option value="">---Select State---</option>
                        @foreach($states as $state)
                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                        @endforeach
                    </select>
                    @error('state_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label>District<span class="text-danger" style="font-size:11.5px">*</span></label>
                    <select class="form-control" name="district_id" id="district_id">
                        <option value="">---Select District---</option>
                    </select>
                    @error('district_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label>City<span class="text-danger" style="font-size:11.5px">*</span></label>
                    <input type="text" name="city" id="city" value="" class="form-control" placeholder="City Name">
                    @error('city')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label>Mobile No.<span class="text-danger" style="font-size:11.5px">*</span></label>
                    <input name="mobile" class="form-control" value="{{ old('mobile') }}" id="mobile" placeholder="Mobile Number *" required type="text" minlength="10" maxlength="10" pattern="[0-9]{10}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                    @error('mobile')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label>Email Id<span class="text-danger" style="font-size:11.5px">*</span></label>
                    <input type="email" name="email" id="email" class="form-control" value="" placeholder="* Email Address">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label>Birth Date<span class="text-danger" style="font-size:11.5px">*</span></label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control datepicker" value="" placeholder="Date of Birth[mm/dd/yyyy]">
                    @error('date_of_birth')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
				   <div class="col-md-6">
                    <label>Father Name<span class="text-danger" style="font-size:11.5px">*</span></label>
                    <input type="text" name="father_name" id="father_name" class="form-control" value="" placeholder="Enter father Name">
                    @error('father_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label>Mother Name<span class="text-danger" style="font-size:11.5px">*</span></label>
                    <input type="text" name="mother_name" id="mother_name" class="form-control" value="" placeholder="Enter Mother Name">
                    @error('mother_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label>Gender<span class="text-danger" style="font-size:11.5px">*</span></label>
                    <select name="gender" id="gender" class="form-control">
                      <option value="">~~Select Gender~~</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                    @error('gender')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label>Physical Handicap<span class="text-danger" style="font-size:11.5px">*</span></label>
                    <select name="is_physical_handicap" id="is_physical_handicap" class="form-control">
                      <option value="">~~Select Phycial Handicap~~</option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                    @error('is_physical_handicap')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label>Category<span class="text-danger" style="font-size:11.5px">*</span></label>
                    <select name="caste_category" id="caste_category" class="form-control">
                      <option value="">~~Select Category ~~</option>
                      <option value="Gen">Gen</option>
                      <option value="SC">SC</option>
                      <option value="ST">ST</option>
                      <option value="OBC">OBC</option>
                      <option value="Others">Others</option>
                    </select>
                    @error('caste_category')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label>Aadhar Number<span id="adr" class="text-danger" style="font-size:11.5px">*</span></label>
                    <input name="aadhar_number" class="form-control" value="{{ old('aadhar_number') }}" id="phone" placeholder="Enter Aadhar Number" required type="text" minlength="12" maxlength="12" pattern="[0-9]{12}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                    <!-- <input type="text" name="aadhar_number" id="aadhar_number" class="form-control" value="" placeholder="Enter Aadhar Number"> -->
                    @error('aadhar_number')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label>Emergency Contact No<span class="text-danger" style="font-size:11.5px">*</span></label>
                    <input name="emergency_contact" class="form-control" value="{{ old('emergency_contact') }}" id="phone" placeholder="Emergency Contact Number" required type="text" minlength="10" maxlength="10" pattern="[0-9]{10}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                    <!-- <input type="text" name="emergency_contact" id="emergency_contact" class="form-control " value="" placeholder="Emergency Contact Number"> -->
                    @error('emergency_contact')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-lg-6 col-md-6 col-xs-6">
                    <label class="control-label" for="linkname">Identity Proof <span class="text-danger">*</span></label>
                    <input type="file" name="identity_proof" id="identity_proof" accept=".pdf, .jpg, .jpeg, .png" class="form-control checkFile">
                    <small><span id="identity_proof" class="text-danger"></span></small>
                    <span class="text-danger err-msg" id="err-identity_proof"></span>
                  </div>
                    <div class="col-lg-6 col-md-6 col-xs-6">
                        <label class="control-label" for="linkname">Candidate Image<span class="text-danger">*</span></label>
                        <input type="file" name="candidate_image" id="candidate_image" accept=".jpg, .jpeg, .png" class="form-control checkFile">
                        <small><span id="candidate_image" class="text-danger"></span></small>
                        <span class="text-danger err-msg" id="err-candidate_image"></span>
                    </div>
                      <div class="col-lg-6 col-md-6 col-xs-6">
                        <label class="control-label" for="linkname">Category Proof <span class="text-danger">*</span></label>
                        <input type="file" name="category_proof" id="category_proof" accept=".pdf, .jpg, .jpeg, .png" class="form-control checkFile">
                        <small><span id="category_proof" class="text-danger"></span></small>
                        <span class="text-danger err-msg" id="err-category_proof"></span>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-6">
                        <label class="control-label" for="linkname">Physical Handicap Proof <span class="text-danger">*</span></label>
                        <input type="file" name="handicap_proof" id="handicap_proof" accept=".pdf, .jpg, .jpeg, .png" class="form-control checkFile">
                        <small><span id="handicap_proof" class="text-danger"></span></small>
                        <span class="text-danger err-msg" id="err-handicap_proof"></span>
                    </div>
				</div>
				<div class="row">
                   <div class="form-group col-md-12" style="padding:10px 0px 0px 0px;">
                    <h3 style="color:#2B75F7;">Qualification & Employment Details</h3>
                   </div>  
					<div class="form-group col-md-6">
						<label>Education Qualification<span class="text-danger" style="font-size:11.5px">*</span></label>
						<select name="qualification" id="qualification" class="form-control" onchange="showEmplySpan(this)">
						  <option value="">~~Qualification~~</option>
						  <option value="ITA">ITA</option>
						  <option value="12TH">12TH</option>
						  <option value="Diploma">Diploma</option>
						  <option value="Graduation">Graduation</option>
						  <option value="Post Graduation">Post Graduation</option>
						</select>
                        @error('qualification')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <label class="control-label" for="linkname">Proof of Hightest Educational Qualification <span class="text-danger">*</span></label>
                        <input type="file" name="highe_education" id="highe_education" accept=".pdf, .jpg, .jpeg, .png" class="form-control checkFile">
                        <small><span id="highe_education" class="text-danger"></span></small>
                        <span class="text-danger err-msg" id="err-highe_education"></span> 
					</div>
					
                  
					<div class="form-group col-md-6">
						<label>Employment Status<span class="text-danger" style="font-size:11.5px">*</span></label>
						<select name="employment_status" id="employment_status" class="form-control" onchange="showEmplySpan(this)">
						  <option value="">~~Employment Status ~~</option>
						  <option value="Yes">Yes</option>
						  <option value="No">No</option>
						  <option value="Self-Entrepreneur ">Self Entrepreneur</option>
						</select>
                        @error('employment_status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
						<div class="row">
							<div class="col-md-6">
								<label>Organisation Name</label>
								<input id="organisation_name" name="organisation_name" type="text" value="" class="form-control" aria-invalid="false" placeholder="" >
                                @error('organisation_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
							</div>
							<div class="col-md-6">
								<label>Organisation Email</label>
								<input id="organisation_email" name="organisation_email" type="email" value="" class="form-control" aria-invalid="false" placeholder="" >
                                @error('organisation_email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
							</div>
							<div class="col-md-6">
								<label>Organisation Phone</label>
                                <input name="organisation_phone" class="form-control" value="{{ old('organisation_phone') }}" id="organisation_phone" placeholder="" type="text" minlength="10" maxlength="10" pattern="[0-9]{10}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                @error('organisation_phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
							</div>
                            <div class="col-lg-6 col-md-6 col-xs-6">
                                <label class="control-label" for="linkname">3 months salary slip <span class="text-danger">*</span></label>
                                <input type="file" name="salary_slip" id="salary_slip" accept=".pdf, .jpg, .jpeg, .png" class="form-control checkFile" style="width:80%">
                                <small><span id="salary_slip" class="text-danger"></span></small>
                                <span class="text-danger err-msg" id="err-salary_slip"></span>
                            </div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label>Company Name</label>
								<input id="company_name" name="company_name" type="text" value="" class="form-control" aria-invalid="false" placeholder="" >
                                @error('company_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
							</div>
							<div class="col-md-6">
								<label>Company Email</label>
								<input id="company_email" name="company_email" type="email" value="" class="form-control" aria-invalid="false" placeholder="" >
                                @error('company_email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
							</div>
							<div class="col-md-6">
								<label>Company Phone</label>
                                <input name="company_phone" class="form-control" value="{{ old('company_phone') }}" id="company_phone" placeholder="" type="text" minlength="10" maxlength="10" pattern="[0-9]{10}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                @error('company_phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
							</div>
                            <div class="col-lg-6 col-md-6 col-xs-6">
                                <label class="control-label" for="linkname">Company Registration Certificate <span class="text-danger">*</span></label>
                                <input type="file" name="id_proof" id="id_proof" accept=".pdf, .jpg, .jpeg, .png" class="form-control checkFile" style="width:80%">
                                <small><span id="id_proof" class="text-danger"></span></small>
                                <span class="text-danger err-msg" id="err-id_proof"></span>
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
                    <select name="academic_session" class="form-control" required>
                        @foreach($sessions as $session)
                            <option value="{{ $session }}">{{ $session }}</option>
                        @endforeach
                    </select>
                    @error('academic_session')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  
                  <div class="col-md-6 hide">
                    <label>Center<span class="text-danger" style="font-size:11.5px">*</span></label>
                    <select name="center_id" id="center_id" class="form-control" required>
                        <option value="">Select Center</option>
                        @foreach($centers as $center)
                            <option value="{{ $center->id }}">{{ $center->title }}</option>
                        @endforeach
                    </select>
                    @error('center_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
				  <div class="col-md-6" id="getBatch">
                    <label>Batch<span class="text-danger" style="font-size:11.5px">*</span></label>
                    <select name="batch_id" id="batch_id" class="form-control" required>
                        <option value="">Select Batch</option>
                    </select>
                    @error('batch_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label>Course Duration (Months) <span class="text-danger">*</span></label>
                    <input type="number" name="course_duration" class="form-control" value="{{ old('course_duration') }}">
                    @error('course_duration')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                  <div class="col-md-6">
                    <label>Status<span class="text-danger" style="font-size:11.5px">*</span></label>
                    <select name="status" class="form-control">
                        <option value="New">New</option>
                        <option value="Under-Training">Under-Training</option>
                        <option value="Trained">Trained</option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  
                <div class="col-md-12 mt-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('partnerAdmin.participant') }}" class="btn btn-danger">Cancel</a>
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
