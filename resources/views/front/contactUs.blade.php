<?php use App\Models\Admin\Settings;?>
@extends('layouts.frontendlayout')
@section('content')
<style>
    .section-title-2 {
        text-align: center;
    }
</style>
<!-- START PAGE BANNER AND BREADCRUMBS -->
    <section id="page-banner">
		
		<div class="single-page-title-area-bottom">
			<div class="auto-container">
				<div class="row">
					<div class="col-12 text-center">
						<div id="ost-container">
							<div class="ost-multi-header">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{route('home.index')}}">Home</a></li>
									<li class="breadcrumb-item active">Contact Us</li>
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

    <!-- START CONTACT SECTION -->
    <section id="contactpage" class="section-padding">
        <div class="container">

            <div class="row text-center">
                <div class="col-lg-4 col-md-4 col-12 mb-lg-0 mb-md-0 mb-5">
                    <div class="single-address">
                        <div class="single-address-icon">
                            <i class="far fa-envelope-open"></i>
                        </div>
                        <div class="single-address-dec">
                            <h4 class="lang-en" style="margin-left: 80px;">Write a mail</h4>
                            <h4 class="lang-hi" style="display:none; margin-left: 80px;">हमें संदेश भेजें</h4>
                            <p>{{Settings::get('company_email')}}</p>
                            <br />
                        </div>

                    </div>
                </div>
                <!-- end col -->
                <div class="col-lg-4 col-md-4 col-12 mb-lg-0 mb-md-0 mb-5">
                    <div class="single-address">
                        <div class="single-address-icon">
                            <i class="icofont icofont-phone-circle"></i>
                        </div>
                        <div class="single-address-dec">
                            <h4 class="lang-en" style="margin-left: 80px;">Give a call</h4>
                            <h4 class="lang-hi" style="display:none; margin-left: 80px;">हमें कॉल करें</h4>
                            <p>{!! str_replace(' ', '<br>', Settings::get('company_phonenumber')) !!}</p>
                            <br />
                        </div>

                    </div>
                </div>
                <!-- end col -->
                <div class="col-lg-4 col-md-4 col-12 mb-lg-0 mb-md-0 mb-5">
                    <div class="single-address">
                        <div class="single-address-icon">
                            <i class="far fa-address-card"></i>
                        </div>
                        <div class="single-address-dec">
                            <!-- <h4>{{Settings::get('company_name')}}</h4> -->
                            <h4 class="lang-en" style="margin-left: 125px;">Location</h4>
                            <h4 class="lang-hi" style="display:none; margin-left: 125px;">जगह</h4>
                            <p>Address: {{Settings::get('company_address')}} </p>
                        </div>

                    </div>
                </div>
                <!-- end col -->

            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12 text-center">
                    <div class="section-title-2">
                        @include('admin.partials.flash_messages')
                        <!-- <h3>Send Us Message</h3> -->
                        <h3 class="lang-en" style="margin-left: 450px;">Send Us Message</h3>
                        <h3 class="lang-hi" style="display:none; margin-left: 500px;">हमें संदेश भेजें</h3>
                    </div>
                </div>
                <div class="col-lg-7 mx-auto">
                    <div class="contact-form-wrapper">
                        <div class="contact-form">
                            <form method="post" action="<?php echo route('contactUs.add'); ?>" class="form-validation">
                                <!--!! CSRF FIELD !!-->
                                {{ @csrf_field() }}
                                <div class="row">
                                    <div class="form-group col-12 mb-3">
                                        <span class="lang-en">First Name:</span>
                                        <span class="lang-hi" style="display:none;">पहला नाम:</span>
                                        <input name="name" value="{{old('name')}}" class="form-control" id="cname" required="required"
                                            type="text">
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12 mb-3">
                                        <span class="lang-en">Your Email:</span>
                                        <span class="lang-hi" style="display:none;">आपका ईमेल:</span>
                                        <input name="email" value="{{old('email')}}" class="form-control" id="cemail" required="required"
                                            type="email">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12 mb-3">
                                        <span class="lang-en">Phone Number:</span>
                                        <span class="lang-hi" style="display:none;">फोन नंबर:</span>
                                        <input name="phone_number" value="{{old('phone_number')}}" class="form-control" id="cnumber" required="required"
                                            type="text">
                                        @error('phone_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12 mb-3">
                                        <span class="lang-en">Subject:</span>
                                        <span class="lang-hi" style="display:none;">विषय:</span>
                                        <input name="subject" value="{{old('subject')}}" class="form-control" id="csubject" required="required"
                                            type="text">
                                        @error('subject')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12 mb-3">
                                        <span class="lang-en">Message:</span>
                                        <span class="lang-hi" style="display:none;">संदेश:</span>
                                        <textarea rows="6" name="message" class="form-control" id="cmessage" placeholder="Your Message Here..."
                                            required="required">{{ old('message') }}</textarea>
                                        @error('message')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-12 mb-0 text-center">
                                        <div class="actions">
                                            <input value="Submit Message" name="submit" id="submitButton"
                                                class="btn btn-contact-bg" title="Click here to submit your message!"
                                                type="submit">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!--- END CONTAINER -->
    </section>
    <!-- END CONTACT SECTION -->

    <!-- GOOGLE MAP -->
    <div class="gmap_canvas">
        <iframe id="gmap_canvas" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3508.8068361970263!2d77.14829687549323!3d28.425084875778673!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d202d36b3644b%3A0x589a71388d1d82db!2sNational%20Institute%20of%20Solar%20Energy!5e0!3m2!1sen!2sin!4v1731058722676!5m2!1sen!2sin"></iframe>
    </div>
    <!-- END GOOGLE MAP -->
@endsection
