<?php use App\Models\Admin\Settings; ?>
@extends('layouts.adminlayout')
@section('content')
<div class="header bg-primary pb-6">
	<div class="container-fluid">
		<div class="header-body">
			<div class="row align-items-center py-4">
				<div class="col-lg-6 col-7">
					<h6 class="h2 text-white d-inline-block mb-0">Manage Settings</h6>

				</div>
			</div>
			@include('admin.partials.flash_messages')
		</div>
	</div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
	<div class="row">
		<div class="col-xl-6 order-xl-1">
			<div class="card">
				<!--!! FLAST MESSAGES !!-->
				
				<div class="card-header">
					<div class="row align-items-center">
						<div class="col-8">
							<h3 class="mb-0">General Settings</h3>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form method="post" action="<?php echo route('admin.settings') ?>" class="form-validation">
						<!--!! CSRF FIELD !!-->
						{{ @csrf_field() }}
						<h6 class="heading-small text-muted mb-4">Company information</h6>
						<div class="pl-lg-4">
							<div class="form-group">
								<label class="form-control-label" for="input-first-name">Company Name</label>
								<input type="text" class="form-control" name="company_name" required placeholder="Company Name" value="{{ Settings::get('company_name') }}">
								@error('company_name')
								    <small class="text-danger">{{ $message }}</small>
								@enderror
							</div>
							<div class="form-group">
								<label class="form-control-label" for="input-first-name">Company Address</label>
								<input type="text" class="form-control" name="company_address" required placeholder="Company Address" value="{{ Settings::get('company_address') }}">
								@error('company_address')
								    <small class="text-danger">{{ $message }}</small>
								@enderror
							</div>
							<div class="row">
								<div class="col-md-6">
									<label class="form-control-label" for="input-first-name">Logo</label>
									<div 
										class="upload-image-section"
										data-type="image"
										data-multiple="false"
										data-path="logos"
									>
										<div class="upload-section">
											<div class="button-ref mb-3">
												<button class="btn btn-icon btn-primary btn-lg" type="button">
									                <span class="btn-inner--icon"><i class="fas fa-upload"></i></span>
									                <span class="btn-inner--text">Upload Image</span>
								              	</button>
								            </div>
								            <!-- PROGRESS BAR -->
											<div class="progress d-none">
							                  <div class="progress-bar bg-default" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
							                </div>
							            </div>
						                <!-- INPUT WITH FILE URL -->
						                <textarea class="d-none" name="logo"></textarea>
						                <div class="show-section <?php echo !old('logo') ? 'd-none' : "" ?>">
						                	@include('admin.partials.previewFileRender', ['file' => old('logo') ])
						                </div>
						                <div class="fixed-edit-section">
						                	@include('admin.partials.previewFileRender', ['file' => Settings::get('logo'), 'relationType' => 'settings.logo', 'relationId' => "" ])
						                </div>
									</div>
								</div>
								<div class="col-md-6">
									<label class="form-control-label" for="input-first-name">Favicon</label>
									<div 
										class="upload-image-section"
										data-type="image"
										data-multiple="false"
										data-path="logos"
									>
										<div class="upload-section">
											<div class="button-ref mb-3">
												<button class="btn btn-icon btn-primary btn-lg" type="button">
									                <span class="btn-inner--icon"><i class="fas fa-upload"></i></span>
									                <span class="btn-inner--text">Upload Image</span>
								              	</button>
								            </div>
								            <!-- PROGRESS BAR -->
											<div class="progress d-none">
							                  <div class="progress-bar bg-default" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
							                </div>
							            </div>
						                <!-- INPUT WITH FILE URL -->
						                <textarea class="d-none" name="favicon"></textarea>
						                <div class="show-section <?php echo !old('favicon') ? 'd-none' : "" ?>">
						                	@include('admin.partials.previewFileRender', ['file' => old('favicon') ])
						                </div>
						                 <div class="fixed-edit-section">
						                	@include('admin.partials.previewFileRender', ['file' => Settings::get('favicon'), 'relationType' => 'settings.favicon', 'relationId' => "" ])
						                </div>
									</div>
								</div>
							</div>
						</div>
						<hr class="my-4" />
						<!-- Address -->
						<h6 class="heading-small text-muted mb-4">System Settings</h6>
						<div class="pl-lg-4">
							<div class="row">
								
								<div class="col-md-6">
									<div class="form-group">
										<?php $secondAuth = Settings::get('admin_second_auth_factor') ?>
										<label class="form-control-label" for="input-first-name">2nd Factor Authentication</label>
										<div class="custom-control">
											<label class="custom-toggle">
												<input type="hidden" name="admin_second_auth_factor" value="0">
												<input type="checkbox" name="admin_second_auth_factor" value="1" <?php echo ( $secondAuth ? 'checked' : '') ?>>
												<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
											</label>
											<label class="custom-control-label"></label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<hr class="my-4" />
						<button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
							<i class="fa fa-save"></i> Submit
						</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-xl-6 order-xl-1">
			<div class="card">
				<!--!! FLAST MESSAGES !!-->
				<div class="card-header">
					<div class="row align-items-center">
						<div class="col-8">
							<h3 class="mb-0">Contact Details</h3>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form method="post" action="<?php echo route('admin.settings.footerLinks') ?>" class="form-validation">
						<!--!! CSRF FIELD !!-->
						{{ @csrf_field() }}
                        <h6 class="heading-small text-muted mb-4">Contact Information</h6>
						<div class="pl-lg-4">
							<div class="form-group">
								<label class="form-control-label" for="input-first-name">Company Name</label>
								<input type="text" class="form-control" name="company_name" required placeholder="" value="{{ Settings::get('company_name') }}">
							</div>
							<div class="form-group">
								<label class="form-control-label" for="input-first-name">Address</label>
								<input type="text" class="form-control" name="company_address" required placeholder="" value="{{ Settings::get('company_address') }}">
							</div>
							<div class="form-group">
								<label class="form-control-label" for="input-first-name">Email</label>
								<input type="text" class="form-control" name="company_email" required placeholder="" value="{{ Settings::get('company_email') }}">
							</div>
							<div class="form-group">
								<label class="form-control-label" for="input-first-name">Phone Number</label>
								<input type="text" class="form-control" name="company_phonenumber" required placeholder="" value="{{ Settings::get('company_phonenumber') }}">
							</div>
						</div>
						<hr class="my-4" />
						<h6 class="heading-small text-muted mb-4">Social Links</h6>
						<div class="pl-lg-4">
							<div class="form-group">
								<label class="form-control-label" for="input-first-name">Facebook</label>
								<input type="text" class="form-control" name="facebook" required placeholder="" value="{{ Settings::get('facebook') }}">
							</div>
							<div class="form-group">
								<label class="form-control-label" for="input-first-name">Twitter</label>
								<input type="text" class="form-control" name="twitter" required placeholder="" value="{{ Settings::get('twitter') }}">
							</div>
							<div class="form-group">
								<label class="form-control-label" for="input-first-name">Youtube</label>
								<input type="text" class="form-control" name="youtube" required placeholder="" value="{{ Settings::get('youtube') }}">
							</div>
							<div class="form-group">
								<label class="form-control-label" for="input-first-name">Instagram</label>
								<input type="text" class="form-control" name="instagram" required placeholder="" value="{{ Settings::get('instagram') }}">
							</div>
						</div>
						<hr class="my-4" />
						<button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
							<i class="fa fa-save"></i> Submit
						</button>
					</form>
				</div>
			</div>
			<div class="card">
				<!--!! FLAST MESSAGES !!-->
				<div class="card-header">
					<div class="row align-items-center">
						<div class="col-8">
							<h3 class="mb-0">Email Settings</h3>
						</div>
					</div>
				</div>
				<div class="card-body">

					<form method="post" action="<?php echo route('admin.settings.email') ?>" class="form-validation">
						<!--!! CSRF FIELD !!-->
						{{ @csrf_field() }}
						<h6 class="heading-small text-muted mb-4">Method Information</h6>
						<div class="pl-lg-4">
							<?php $method = Settings::get('email_method') ?>
							<div class="form-group">
								<div class="radio-section">
									<div class="custom-control custom-radio custom-control-inline">
										<input type="radio" id="smtp" name="email_method" value="smtp" class="custom-control-input" <?php echo ( $method && $method == 'smtp' ? 'checked' : '' ) ?> onclick="$('.smtp-section').removeClass('d-none');$('.sendgrid-section').addClass('d-none')">
										<label class="custom-control-label" for="smtp">SMTP</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline">
										<input type="radio" id="sendgrid" name="email_method" value="sendgrid" class="custom-control-input" <?php echo ( $method && $method == 'sendgrid' ? 'checked' : '' ) ?> onclick="$('.smtp-section').addClass('d-none');$('.sendgrid-section').removeClass('d-none')">
										<label class="custom-control-label" for="sendgrid">Send Grid</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="form-control-label" for="input-first-name">From Email Address</label>
								<input type="email" class="form-control" name="from_email" required placeholder="info@example.com" value="{{ Settings::get('from_email') }}">
							</div>
							<!-- SMTP Fields -->
							<div class="smtp-section <?php echo ($method != 'smtp' ? 'd-none' : '') ?>">
								<div class="form-group">
									<label class="form-control-label" for="input-first-name">SMTP Host</label>
									<input type="text" class="form-control" name="smtp_host" required placeholder="smtp.google.com" value="{{ Settings::get('smtp_host') }}">
								</div>
								<div class="form-group">
									<?php $enc =  Settings::get('from_email') ?>
									<label class="form-control-label" for="input-first-name">SMTP Encryption</label>
									<select class="form-control" name="smtp_encryption" required placeholder="smtp.google.com" value="">
										<option value="ssl" <?php echo ($enc == 'ssl' ? 'selected' : '') ?> >SSL (Secure Socket Layer)</option>
										<option value="tls" <?php echo ($enc == 'tls' ? 'selected' : '') ?> >TLS (Transport Layer Security)</option>
									</select>
								</div>
								<div class="form-group">
									<label class="form-control-label" for="input-first-name">SMTP Port</label>
									<input type="text" class="form-control" name="smtp_port" required placeholder="465 or 587" value="{{ Settings::get('smtp_port') }}">
								</div>
								<div class="form-group">
									<label class="form-control-label" for="input-first-name">SMTP Username</label>
									<input type="text" class="form-control" name="smtp_username" required placeholder="" value="{{ Settings::get('smtp_username') }}">
								</div>
								<div class="form-group">
									<label class="form-control-label" for="input-first-name">SMTP Email</label>
									<input type="email" class="form-control" name="smtp_email" required placeholder="" value="{{ Settings::get('smtp_email') }}">
								</div>
								<div class="form-group">
									<label class="form-control-label" for="input-first-name">SMTP Password</label>
									<div class="input-group passwordGroup">
										<input type="search"  autocomplete="off" class="form-control" placeholder="******" aria-label="Recipient's username with two button addons" aria-describedby="button-addon4" name="smtp_password" value="{{ old('smtp_password') }}">
									</div>
								</div>
								<p>
									<small>
										<b>Google SMTP Reference</b><br>
										Go to your gmail settings. Follow below link.<br>
										SMTP Details: <a href="https://www.digitalocean.com/community/tutorials/how-to-use-google-s-smtp-server" target="_blank">https://www.digitalocean.com/community/tutorials/how-to-use-google-s-smtp-server</a>
										<br>
										Allow less secure apps in your google account. Follow below link.<br>
										<a href="https://support.google.com/accounts/answer/6010255?hl=en" target="_blank">https://support.google.com/accounts/answer/6010255?hl=en</a>
									</small>
								</p>
							</div>
							<!-- SMTP Fields -->
							<!-- SendGrid Fields -->
							<div class="sendgrid-section <?php echo ($method != 'sendgrid' ? 'd-none' : '') ?>">
								<div class="form-group">
									<label class="form-control-label" for="input-first-name">Send Grid Email</label>
									<input type="email" class="form-control" name="sendgrid_email" required placeholder="info@example.com" value="{{ Settings::get('sendgrid_email') }}">
								</div>
								<div class="form-group">
									<label class="form-control-label" for="input-first-name">Send Grid Key</label>
									<input type="email" class="form-control" name="sendgrid_api_key" required placeholder="SG...." value="{{ Settings::get('sendgrid_api_key') }}">
								</div>
								<p>
									<small>
										<b>Send Grid Reference</b><br>
										<a href="https://sendgrid.com/docs/ui/account-and-settings/api-keys/" target="_blank">https://sendgrid.com/docs/ui/account-and-settings/api-keys/</a>
									</small>
								</p>
							</div>
							<!-- SendGrid Fields -->
						</div>
						<hr class="my-4" />
						<button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
							<i class="fa fa-save"></i> Submit
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection