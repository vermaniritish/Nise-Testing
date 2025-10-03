<?php use App\Models\Admin\CustomPageData; ?>
@extends('layouts.frontendlayout')
@section('content')

<!-- START PAGE BANNER AND BREADCRUMBS -->
	<section id="page-banner">
		
		<div class="single-page-title-area-bottom">
			<div class="auto-container">
				<div class="row">
					<div class="col-12 text-center">
						<div id="ost-container">
							<div class="ost-multi-header">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item active">Partner Login</li>
								</ol>
							</div>
						</div>
					</div>
				</div>
				<!-- end row-->
			</div>
		</div>
	</section>
	<!-- END PAGE BANNER AND BREADCRUMBS -->
	
		
	<!-- START NOTICE-LOGIN SECTION -->
    <section id="promot" class="section-padding">
        <div class="container  d-flex justify-content-center align-items-center">
            <div class="row w-100 justify-content-center">
                <!-- Login Form with OTP -->
                <div class="col-lg-5 col-md-5 col-12 pr-lg-5 pr-md-5 pr-0 mb-4">
                    <div class="section-title-2">
                        <h3><span>Login</span> for EOI</h3>
                    </div>

                    <div class="home-p-form-wrapper">
                        <div class="home-p-form">
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
                            <!-- Step 1: Enter Mobile/Email -->
                            <form method="POST" action="{{ route('login.sendOtp') }}">
                                @csrf
                                <div class="form-group col-lg-12 mb-3">
                                    <label for="userphone">Registered Email/Mobile</label>
                                    <input name="userphone" value="{{ old('mobile', session('mobile')) }}" class="form-control" placeholder="Registered Email/Mobile" required type="text">
                                </div>
                                <div class="form-group col-lg-12 mb-3">
                                    <button type="submit" class="btn-style btn-filled btn-filled-2">Send OTP</button>
                                </div>
                            </form>

                            <!-- Step 2: Verify OTP -->
                            @if(session('login_id'))
                            <form method="POST" action="{{ route('login.verifyOtp') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ session('login_id') }}">
                                <div class="form-group col-lg-12 mb-3">
                                    <label for="otp">Enter OTP</label>
                                    <input name="otp" class="form-control" placeholder="Enter OTP" required type="text">
                                </div>
                                <div class="form-group col-lg-12 mb-3">
                                    <button type="submit" class="btn-style btn-filled btn-filled-2">Verify & Login</button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<script>
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

    // function showFileName(input) {
    //     if (input.files && input.files[0]) {
    //         document.getElementById('organisation_file').innerText = "Selected File: " + input.files[0].name;
    //     }
    // }

    function previewFile(input) {
        let previewDiv = document.getElementById('file_preview');
        previewDiv.innerHTML = ""; // reset preview

        if (input.files && input.files[0]) {
            let file = input.files[0];
            let fileType = file.type;

            // Agar Image hai to preview image dikhao
            if (fileType.startsWith('image/')) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add("img-thumbnail");
                    img.style.maxWidth = "200px";
                    img.style.marginTop = "10px";
                    previewDiv.appendChild(img);
                }
                reader.readAsDataURL(file);
            } 
            // Agar image nahi hai to sirf file name show kare
            else {
                previewDiv.innerHTML = `<p class="text-info mt-2">Selected File: ${file.name}</p>`;
            }
        }
    }
    function panPreviewFile(input) {
        let previewDiv = document.getElementById('pan_file_preview');
        previewDiv.innerHTML = "";
        if (input.files && input.files[0]) {
            let file = input.files[0];
            let fileType = file.type;
            if (fileType.startsWith('image/')) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add("img-thumbnail");
                    img.style.maxWidth = "200px";
                    img.style.marginTop = "10px";
                    previewDiv.appendChild(img);
                }
                reader.readAsDataURL(file);
            } else {
                previewDiv.innerHTML = `<p class="text-info mt-2">Selected File: ${file.name}</p>`;
            }
        }
    }

    function gstPreviewFile(input) {
        let previewDiv = document.getElementById('gst_file_preview');
        previewDiv.innerHTML = "";
        if (input.files && input.files[0]) {
            let file = input.files[0];
            let fileType = file.type;
            if (fileType.startsWith('image/')) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add("img-thumbnail");
                    img.style.maxWidth = "200px";
                    img.style.marginTop = "10px";
                    previewDiv.appendChild(img);
                }
                reader.readAsDataURL(file);
            } else {
                previewDiv.innerHTML = `<p class="text-info mt-2">Selected File: ${file.name}</p>`;
            }
        }
    }

    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(el => {
            el.style.transition = "opacity 0.5s ease";
            el.style.opacity = "0";
            setTimeout(() => el.remove(), 500); // fade-out ke baad remove
        });
    }, 2000);
</script>

    <!-- END NOTICE-LOGIN SECTION -->
@endsection