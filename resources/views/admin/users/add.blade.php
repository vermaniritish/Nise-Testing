@extends('layouts.adminlayout')
@section('content')

<section>

	<div class="header bg-primary pb-6">

	<div class="container-fluid">

		<div class="header-body">

			<div class="row align-items-center py-4">

				<div class="col-lg-6 col-7">

					<h6 class="h2 text-white d-inline-block mb-0">Manage Institutes</h6>

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

							<h3 class="mb-0">Create New Institutes Here.</h3>

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

        			<form action="{{ route('admin.users.add') }}" method="post" onsubmit="return validSryamitraAddForm()" enctype="multipart/form-data">
        				@csrf
                            <div class="row">
                              <div class="col-md-6">
                                <label>Organisation Name<span class="text-danger" style="font-size:11.5px">*</span></label>
                                <input type="text" name="organisation_name" id="organisation_name" value="{{old('organisation_name')}}" class="form-control" placeholder="Organisation Name">
                                @error('organisation_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Gender</label>
                                    <select class="form-control" name="gender">
                                        <option value="male" <?php echo old('gender') == 'male' ? 'selected' : '' ?>>Male</option>
                                        <option value="female" <?php echo old('gender') == 'female' ? 'selected' : '' ?>>Female</option>
                                    </select>
                                    @error('gender')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                              </div>
                              <div class="col-md-6">
                                <label>Email<span class="text-danger" style="font-size:11.5px">*</span></label>
                                <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control" placeholder="Email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                    <label>State<span class="text-danger">*</span></label>
                                    <select class="form-control" name="state_id" id="state_id">
                                        <option value="">Select State</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('state_id') 
                                        <span class="text-danger">{{ $message }}</span> 
                                    @enderror
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                    <label>District<span class="text-danger">*</span></label>
                                    <select class="form-control" name="district_id" id="district_id">
                                        <option value="">Select District</option>
                                    </select>
                                    @error('district_id') 
                                        <span class="text-danger">{{ $message }}</span> 
                                    @enderror
                                </div>
                              </div>
                              <div class="col-md-6">
                                <label>Mobile Number<span class="text-danger" style="font-size:11.5px">*</span></label>
                                <input name="mobile" class="form-control" value="{{ old('mobile') }}" id="phone" placeholder="Mobile Number" type="text" minlength="10" maxlength="10" pattern="[0-9]{10}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                @error('mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>

                              <div class="col-md-6">
                                <label class="control-label" for="linkname">Certificate of Establishment <span class="text-danger">*</span></label>
                                <input type="file" name="organisation_file" id="organisation_file" accept=".pdf, .jpg, .jpeg, .png" class="form-control checkFile">
                                <small><span id="organisation_file" class="text-danger"></span></small>
                                <span class="text-danger err-msg" id="err-organisation_file"></span>
                              </div>
                              <div class="col-md-6">
                                <label>Pan Number<span class="text-danger" style="font-size:11.5px">*</span></label>
                                <input name="pan" class="form-control" id="pan" placeholder="PAN No.*" required value="{{ old('pan') }}" type="text" minlength="10" maxlength="10" pattern="[A-Za-z0-9]{1,10}" oninput="this.value=this.value.replace(/[^A-Za-z0-9]/g,'');">
                                @error('pan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                              <div class="col-md-6">
                                <label class="control-label" for="linkname">Upload PAN Scan Copy <span class="text-danger">*</span></label>
                                <input type="file" name="pan_file" id="pan_file" accept=".pdf, .jpg, .jpeg, .png" class="form-control checkFile">
                                <small><span id="pan_file" class="text-danger"></span></small>
                                <span class="text-danger err-msg" id="err-pan_file"></span>
                              </div>
                              <div class="col-md-6">
                                <label>GST Number<span class="text-danger" style="font-size:11.5px">*</span></label>
                                <input name="gst" class="form-control" id="gst" placeholder="GST Number" required value="{{ old('gst') }}" type="text" minlength="15" maxlength="15" pattern="[A-Za-z0-9]{1,15}" oninput="this.value=this.value.replace(/[^A-Za-z0-9]/g,'');">
                                @error('gst')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                              <div class="col-md-6">
                                <label class="control-label" for="linkname">Upload GST Certificate <span class="text-danger">*</span></label>
                                <input type="file" name="gst_file" id="gst_file" accept=".pdf, .jpg, .jpeg, .png" class="form-control checkFile">
                                <small><span id="gst_file" class="text-danger"></span></small>
                                <span class="text-danger err-msg" id="err-gst_file"></span>
                              </div>
                              <div class="col-md-6">
                                <label>Pin Code<span class="text-danger" style="font-size:11.5px">*</span></label>
                                <input name="pin" class="form-control" id="pin" placeholder="Pin Code" required value="{{ old('pin') }}" type="text" minlength="6" maxlength="6" pattern="[A-Za-z0-9]{1,6}" oninput="this.value=this.value.replace(/[^A-Za-z0-9]/g,'');">
                                @error('pin')
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
        						</div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="custom-control">
                                            <label class="custom-toggle">
                                                <input type="hidden" name="status" value="0">
                                                <input type="checkbox" name="status" value="1" <?php echo (old('status') != '0' ? 'checked' : '') ?>>
                                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                            </label>
                                            <label class="custom-control-label">Do you want to publish this page ?</label>
                                        </div>
                                    </div>
                                </div>
        					</div>
                        </div>
        				<div class="row">	                  
                        <div class="col-md-12 mt-3">
                            <button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
                                <i class="fa fa-save"></i> Submit
                            </button>
                            <!-- <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('admin.participant') }}" class="btn btn-danger">Cancel</a> -->
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
