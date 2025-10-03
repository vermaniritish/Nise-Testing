@extends('layouts.adminlayout')
@section('content')
<div class="header bg-primary pb-6">
	<div class="container-fluid">
		<div class="header-body">
			<div class="row align-items-center py-4">
				<div class="col-lg-6 col-7">
					<h6 class="h2 text-white d-inline-block mb-0">Manage Contact Us</h6>
				</div>
				<div class="col-lg-6 col-5 text-right">
					<a href="<?php echo route('admin.contactUs') ?>" class="btn btn-neutral"><i class="ni ni-bold-left"></i> Back</a>
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
				@include('admin.partials.flash_messages')
				<div class="card-header">
					<div class="row align-items-center">
						<div class="col-8">
							<h3 class="mb-0">Update Contact Us Here.</h3>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form method="post" action="<?php echo route('admin.contactUs.edit', ['id' => $page->id]) ?>" class="form-validation">
						<!--!! CSRF FIELD !!-->
						{{ @csrf_field() }}
						<h6 class="heading-small text-muted mb-4">General information</h6>
						<div class="pl-lg-4">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Name</label>
										<input type="text" class="form-control" required name="name" placeholder="Name" value="{{ $page->name }}">
										@error('name')
											<small class="text-danger">{{ $message }}</small>
										@enderror
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Designation</label>
										<input type="text" class="form-control" name="designation" required placeholder="Designation" value="{{ $page->designation }}">
										@error('designation')
											<small class="text-danger">{{ $message }}</small>
										@enderror
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Rating</label>
										<input type="number" class="form-control" name="rating" required placeholder="Rating" value="{{ $page->rating }}">
										@error('rating')
											<small class="text-danger">{{ $message }}</small>
										@enderror
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Description</label>
										<textarea rows="2" id="editor1" class="form-control" placeholder="Description" required name="description"><?php echo $page->description ?></textarea>
										@error('description')
										    <small class="text-danger">{{ $message }}</small>
										@enderror
									</div>
								</div>
							</div>
						</div>
						<hr class="my-4" />
						<div class="pl-lg-4">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<!-- FILE OR IMAGE UPLOAD. FOLDER PATH SET HERE in data-path AND CHANGE THE data-multiple TO TRUE SEE MAGIC. DO NOT REMOVE THE NESTED CALSSES -->
										<div 
											class="upload-image-section"
											data-type="file"
											data-multiple="false"
											data-path="blogs"
											data-resize-large="920*640"
										>
											<div class="upload-section">
												<div class="button-ref mb-3">
													<button class="btn btn-icon btn-primary btn-lg" type="button">
										                <span class="btn-inner--icon"><i class="fas fa-upload"></i></span>
										                <span class="btn-inner--text">Upload Image or Video</span>
									              	</button>
									            </div>
									            <!-- PROGRESS BAR -->
												<div class="progress d-none">
								                  <div class="progress-bar bg-default" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
								                </div>
								            </div>
							                <!-- INPUT WITH FILE URL -->
							                <textarea class="d-none" name="image"></textarea>
							                <div class="show-section <?php echo !old('image') ? 'd-none' : "" ?>">
							                	@include('admin.partials.previewFileRender', ['file' => old('image') ])
							                </div>
							                <div class="fixed-edit-section">
							                	@include('admin.partials.previewFileRender', ['file' => $page->image, 'relationType' => 'testimonial.image', 'relationId' => $page->id ])
							                </div>
										</div>
									</div>
								</div>
							</div>
						</div>
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