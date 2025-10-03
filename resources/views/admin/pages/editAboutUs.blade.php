<?php
use Illuminate\Support\Arr;
?>
@extends('layouts.adminlayout')
@section('content')
<div class="header bg-primary pb-6">
	<div class="container-fluid">
		<div class="header-body">
			<div class="row align-items-center py-4">
				<div class="col-lg-6 col-7">
					<h6 class="h2 text-white d-inline-block mb-0">Manage About Us</h6>
				</div>
				<div class="col-lg-6 col-5 text-right">
					<a href="<?php echo route('admin.pages') ?>" class="btn btn-neutral"><i class="ni ni-bold-left"></i> Back</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
	<div class="row">
		<div class="col-xl-12 order-xl-1">
            <form method="post" action="<?php echo route('admin.pages.edit', ['id' => $page->id]) ?>" class="form-validation">
                {{ @csrf_field() }}
			<div class="card">
				<!--!! FLAST MESSAGES !!-->
				@include('admin.partials.flash_messages')
				<div class="card-header">
					<div class="row align-items-center">
						<div class="col-8">
							<h3 class="mb-0">Update Page Details Here.</h3>
						</div>
					</div>
				</div>
				<div class="card-body">
					{{-- <form method="post" action="<?php echo route('admin.pages.edit', ['id' => $page->id]) ?>" class="form-validation">
						{{ @csrf_field() }} --}}
						<h6 class="heading-small text-muted mb-4">Page information</h6>
						<div class="pl-lg-4">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Title</label>
										<input type="text" class="form-control" name="title" required placeholder="Title" value="<?php echo $page->title ?>">
										@error('title')
										    <small class="text-danger">{{ $message }}</small>
										@enderror
									</div>

								</div>

							</div>
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label class="form-control-label">Description</label>
										<textarea rows="2" id="editor1" class="form-control" required placeholder="Description" name="description"><?php echo $page->description ?></textarea>
										@error('description')
										    <small class="text-danger">{{ $message }}</small>
										@enderror
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<!-- FILE OR IMAGE UPLOAD. FOLDER PATH SET HERE in data-path AND CHANGE THE data-multiple TO TRUE SEE MAGIC. DO NOT REMOVE THE NESTED CALSSES -->
										<div
											class="upload-image-section"
											data-type="image"
											data-multiple="false"
											data-path="pages"
											data-resize-large="1626*864"
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
							                <textarea class="d-none" name="image"></textarea>
							                <div class="show-section <?php echo !old('image') ? 'd-none' : "" ?>">
							                	@include('admin.partials.previewFileRender', ['file' => old('image') ])
							                </div>
							                <div class="fixed-edit-section">
							                	@include('admin.partials.previewFileRender', ['file' => $page->image, 'relationType' => 'pages.image', 'relationId' => $page->id ])
							                </div>
						                    <h6 class="heading-small text-muted mb-4">Upload Image Size Of 1626px * 864px</h6>
										</div>
									</div>
								</div>
								<div class="col-lg-6">

								</div>
							</div>
						</div>
						<hr class="my-4" />
						<button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
							<i class="fa fa-save"></i> Submit
						</button>
					{{-- </form> --}}
				</div>
			</div>


			<div class="card">
				<div class="card-body">
						<h6 class="heading-small text-muted mb-4">Yellow section</h6>
						<div class="pl-lg-4">
							<div class="row">
								<div class="col-lg-3">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Number</label>
										<input type="number" class="form-control" name="about_us_number1" required placeholder="Number" value="<?php echo $customPageData['about_us_number1']['value']??"" ?>">
										@error('about_us_number1')
										    <small class="text-danger">{{ $message }}</small>
										@enderror
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Number</label>
										<input type="number" class="form-control" name="about_us_number2" required placeholder="Number" value="<?php echo $customPageData['about_us_number2']['value']??""  ?>">
										@error('about_us_number2')
										    <small class="text-danger">{{ $message }}</small>
										@enderror
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Number</label>
										<input type="number" class="form-control" name="about_us_number3" required placeholder="Number" value="<?php echo $customPageData['about_us_number3']['value']??""  ?>">
										@error('about_us_number3')
										    <small class="text-danger">{{ $message }}</small>
										@enderror
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Number</label>
										<input type="number" class="form-control" name="about_us_number4" required placeholder="Number" value="<?php echo $customPageData['about_us_number4']['value']??""  ?>">
										@error('about_us_number4')
										    <small class="text-danger">{{ $message }}</small>
										@enderror
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-3">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Label</label>
										<input type="text" class="form-control" name="about_us_label1" required placeholder="Label" value="<?php echo $customPageData['about_us_label1']['value']??""  ?>">
										@error('about_us_label1')
										    <small class="text-danger">{{ $message }}</small>
										@enderror
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Label</label>
										<input type="text" class="form-control" name="about_us_label2" required placeholder="Label" value="<?php echo $customPageData['about_us_label2']['value']??""  ?>">
										@error('about_us_label2')
										    <small class="text-danger">{{ $message }}</small>
										@enderror
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Label</label>
										<input type="text" class="form-control" name="about_us_label3" required placeholder="Label" value="<?php echo $customPageData['about_us_label3']['value']??""  ?>">
										@error('about_us_label3')
										    <small class="text-danger">{{ $message }}</small>
										@enderror
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Label</label>
										<input type="text" class="form-control" name="about_us_label4" required placeholder="Label" value="<?php echo $customPageData['about_us_label4']['value']??""  ?>">
										@error('about_us_label4')
										    <small class="text-danger">{{ $message }}</small>
										@enderror
									</div>
								</div>
							</div>
						</div>

						<hr class="my-4" />
						<button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
							<i class="fa fa-save"></i> Submit
						</button>
				</div>
			</div>

			<div class="card">
				<div class="card-body">
						<h6 class="heading-small text-muted mb-4">Slider Image</h6>
						<div class="pl-lg-4">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<!-- FILE OR IMAGE UPLOAD. FOLDER PATH SET HERE in data-path AND CHANGE THE data-multiple TO TRUE SEE MAGIC. DO NOT REMOVE THE NESTED CALSSES -->
										<div
											class="upload-image-section"
											data-type="image"
											data-multiple="true"
											data-path="pages"
											data-resize-large="200*200"
										>
											<div class="upload-section">
												<div class="button-ref mb-3">
													<button class="btn btn-icon btn-primary btn-lg" type="button">
										                <span class="btn-inner--icon"><i class="fas fa-upload"></i></span>
										                <span class="btn-inner--text">Upload Logos</span>
									              	</button>
									            </div>
									            <!-- PROGRESS BAR -->
												<div class="progress d-none">
								                  <div class="progress-bar bg-default" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
								                </div>
								            </div>
                                            <h6 class="heading-small text-muted mb-4">Upload Image Size Of 200px * 200px</h6>
							                <!-- INPUT WITH FILE URL -->
							                <textarea class="d-none" name="about_us_slider_images"></textarea>
							                <div class="show-section <?php echo !old('about_us_slider_images') ? 'd-none' : "" ?>">
							                	@include('admin.partials.previewFileRender', ['file' => old('about_us_slider_images') ])
							                </div>
							                <div class="fixed-edit-section">
							                	@include('admin.partials.previewFileRender', ['file' => $customPageData['about_us_slider_images']['value']??"" , 'relationType' => 'custom_page_data.value', 'relationId' => $customPageData['about_us_slider_images']['id']??"" ])
							                </div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<hr class="my-4" />
						<button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
							<i class="fa fa-save"></i> Submit
						</button>
				</div>
			</div>

			<div class="card">
				<div class="card-body">
						<h6 class="heading-small text-muted mb-4">Our Mission</h6>
						<div class="pl-lg-4">

							<div class="form-group">
								<label class="form-control-label" for="input-first-name">Mission Title</label>
								<input type="text" required class="form-control" name="about_us_mision_title" placeholder="Mission Title" value="<?php echo $customPageData['about_us_mision_title']['value']??""  ?>">
								@error('about_us_mision_title')
								    <small class="text-danger">{{ $message }}</small>
								@enderror
							</div>
							<div class="form-group">
								<label class="form-control-label">Mission Description</label>
								<textarea rows="2" required class="form-control" id="editor1" placeholder="Mission Description" name="about_us_mision_description"><?php echo $customPageData['about_us_mision_description']['value']??""  ?></textarea>
								@error('about_us_mision_description')
								    <small class="text-danger">{{ $message }}</small>
								@enderror
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
											data-type="image"
											data-multiple="false"
											data-path="pages"
											data-resize-large="1280*768"
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
                                            <h6 class="heading-small text-muted mb-4">Upload Image Size Of 1280px * 768px</h6>
							                <!-- INPUT WITH FILE URL -->
							                <textarea class="d-none" name="about_us_mision_image">{{$customPageData['about_us_mision_image']['value']??""}}</textarea>
							                <div class="show-section <?php echo !old('about_us_mision_image') ? 'd-none' : "" ?>">
							                	@include('admin.partials.previewFileRender', ['file' => old('about_us_mision_image') ])
							                </div>
							                <div class="fixed-edit-section">
							                	@include('admin.partials.previewFileRender', ['file' => $customPageData['about_us_mision_image']['value']??"" , 'relationType' => 'custom_page_data.about_us_mision_image', 'relationId' => $customPageData['about_us_mision_image']['id']??""  ])
							                </div>
										</div>
									</div>
								</div>
								<!-- <div class="col-lg-6">
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
								</div> -->
							</div>
						</div>
						<hr class="my-4" />
						<button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
							<i class="fa fa-save"></i> Submit
						</button>
				</div>
			</div>

			<div class="card">
				<div class="card-body">
						<h6 class="heading-small text-muted mb-4">Our Vision</h6>
						<div class="pl-lg-4">

							<div class="form-group">
								<label class="form-control-label" for="input-first-name">Vision Title</label>
								<input type="text" required class="form-control" name="about_us_vision_title" placeholder="Vision Title" value="<?php echo $customPageData['about_us_vision_title']['value']??""  ?>">
								@error('about_us_vision_title')
								    <small class="text-danger">{{ $message }}</small>
								@enderror
							</div>
							<div class="form-group">
								<label class="form-control-label">Vision Description</label>
								<textarea rows="2" required class="form-control" id="editor1" placeholder="Vision Description" name="about_us_vision_description"><?php echo $customPageData['about_us_vision_description']['value']??""  ?></textarea>
								@error('about_us_vision_description')
								    <small class="text-danger">{{ $message }}</small>
								@enderror
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
											data-type="image"
											data-multiple="false"
											data-path="pages"
											data-resize-large="1280*768"
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
                                            <h6 class="heading-small text-muted mb-4">Upload Image Size Of 1280px * 768px</h6>
							                <!-- INPUT WITH FILE URL -->
							                <textarea class="d-none" name="about_us_vision_image">{{$customPageData['about_us_vision_image']['value']??""}}</textarea>
							                <div class="show-section <?php echo !old('about_us_vision_image') ? 'd-none' : "" ?>">
							                	@include('admin.partials.previewFileRender', ['file' => old('about_us_vision_image') ])
							                </div>
							                <div class="fixed-edit-section">
							                	@include('admin.partials.previewFileRender', ['file' => $customPageData['about_us_vision_image']['value']??""  , 'relationType' => 'custom_page_data.about_us_vision_image', 'relationId' => $customPageData['about_us_vision_image']['id']??""  ])
							                </div>
										</div>
									</div>
								</div>
							</div>
							<hr class="my-4" />
							{{-- <p><a href="{{ route('admin.teams')}}" target="_blank">Click here to manage Teams section.</a></p> --}}

						</div>
						<hr class="my-4" />
						<button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
							<i class="fa fa-save"></i> Submit
						</button>
				</div>
			</div>
        </form>
		</div>
	</div>
</div>
@endsection
