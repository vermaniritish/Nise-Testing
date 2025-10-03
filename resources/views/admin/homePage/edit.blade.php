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
                        <h6 class="h2 text-white d-inline-block mb-0">Home Page</h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="<?php echo route('admin.dashboard'); ?>" class="btn btn-neutral"><i class="ni ni-bold-left"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <form method="post" action="<?php echo route('admin.editHomePage'); ?>" class="form-validation">
            {{ @csrf_field() }}
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-2">Home page about us</h6>
                            <hr class="my-4" />
                            <h6 class="heading-small text-muted mb-2">English</h6>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Title</label>
                                        <input type="text"  class="form-control" name="home_about_us_title"
                                            placeholder="About us title" value="<?php echo $customPageData['home_about_us_title']['value'] ?? ''; ?>">
                                        @error('home_about_us_title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Heading</label>
                                        <input type="text"  class="form-control" name="home_about_us_heading"
                                            placeholder="About us heading" value="<?php echo $customPageData['home_about_us_heading']['value'] ?? ''; ?>">
                                        @error('home_about_us_heading')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Short Description</label>
                                        <input type="text"  class="form-control" name="home_about_us_short_desc"
                                            placeholder="About us short description" value="<?php echo $customPageData['home_about_us_short_desc']['value'] ?? ''; ?>">
                                        @error('home_about_us_short_desc')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Description</label>
                                        <textarea rows="2" id="editor1"  class="form-control" placeholder="About us Description"
                                            name="home_about_us_desc"><?php echo $customPageData['home_about_us_desc']['value'] ?? ''; ?></textarea>
                                        @error('banner_description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Button Text</label>
                                        <input type="text"  class="form-control"
                                            name="home_about_us_button_text" placeholder="Text"
                                            value="<?php echo $customPageData['home_about_us_button_text']['value'] ?? ''; ?>">
                                        @error('home_about_us_button_text')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Button Link</label>
                                        <input type="text"  class="form-control"
                                            name="home_about_us_button_link" placeholder="Text"
                                            value="<?php echo $customPageData['home_about_us_button_link']['value'] ?? ''; ?>">
                                        @error('home_about_us_button_link')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Button Status</label>
                                        <div class="custom-control">
                                            <label class="custom-toggle">
                                                <input type="hidden" name="home_about_us_button" value="0">
                                                <input type="checkbox" name="home_about_us_button" value="1"
                                                    <?php echo isset($customPageData['home_about_us_button']['value']) && $customPageData['home_about_us_button']['value'] != '0' ? 'checked' : ''; ?>>
                                                <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                    data-label-on="Yes"></span>
                                            </label>
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
                </div>

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-2">Home page about us</h6>
                            <hr class="my-4" />
                            <h6 class="heading-small text-muted mb-2">Hindi</h6>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Title</label>
                                        <input type="text"  class="form-control" name="home_about_us_title_hi"
                                            placeholder="About us title" value="<?php echo $customPageData['home_about_us_title_hi']['value'] ?? ''; ?>">
                                        @error('home_about_us_title_hi')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Heading</label>
                                        <input type="text"  class="form-control"
                                            name="home_about_us_heading_hi" placeholder="About us heading"
                                            value="<?php echo $customPageData['home_about_us_heading_hi']['value'] ?? ''; ?>">
                                        @error('home_about_us_heading_hi')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Short Description</label>
                                        <input type="text"  class="form-control" name="home_about_us_short_desc_hi"
                                            placeholder="About us short description" value="<?php echo $customPageData['home_about_us_short_desc_hi']['value'] ?? ''; ?>">
                                        @error('home_about_us_short_desc_hi')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Description</label>
                                        <textarea rows="2" id="editor2"  class="form-control" placeholder="About us Description"
                                            name="home_about_us_desc_hi"><?php echo $customPageData['home_about_us_desc_hi']['value'] ?? ''; ?></textarea>
                                        @error('home_about_us_desc_hi')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Button Text</label>
                                        <input type="text" class="form-control" name="home_about_us_button_text_hi"
                                            placeholder="Text" value="<?php echo $customPageData['home_about_us_button_text_hi']['value'] ?? ''; ?>">
                                        @error('home_about_us_button_text_hi')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Button Link</label>
                                        <input type="text" class="form-control" name="home_about_us_button_link_hi"
                                            placeholder="Text" value="<?php echo $customPageData['home_about_us_button_link_hi']['value'] ?? ''; ?>">
                                        @error('home_about_us_button_link_hi')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Button Status</label>
                                        <div class="custom-control">
                                            <label class="custom-toggle">
                                                <input type="hidden" name="home_about_us_button_hi" value="0">
                                                <input type="checkbox" name="home_about_us_button_hi" value="1"
                                                    <?php echo isset($customPageData['home_about_us_button_hi']['value']) && $customPageData['home_about_us_button_hi']['value'] != '0' ? 'checked' : ''; ?>>
                                                <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                    data-label-on="Yes"></span>
                                            </label>
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
                </div>
            </div>

            <!-- //Rakesh -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Service Title</label>
                                        <input type="text" class="form-control" name="service_title"
                                            placeholder="Service Title" value="<?php echo $customPageData['service_title']['value'] ?? ''; ?>">
                                        @error('service_title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Service Short Title</label>
                                        <input type="text" class="form-control" name="service_short_title"
                                            placeholder="Service Short Title" value="<?php echo $customPageData['service_short_title']['value'] ?? ''; ?>">
                                        @error('service_short_title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
                                <i class="fa fa-save"></i> Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Rakesh  -->
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-2">Home page Feedback</h6>
                            <hr class="my-4" />
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Feedback Title</label>
                                        <input type="text"  class="form-control" name="feedback_title"
                                            placeholder="Feedback Title" value="<?php echo $customPageData['feedback_title']['value'] ?? ''; ?>">
                                        @error('feedback_title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Feedback Description</label>
                                        <textarea rows="2" class="form-control editor5" placeholder=""
                                            name="feedback_description"><?php echo $customPageData['feedback_description']['value'] ?? ''; ?></textarea>
                                        @error('feedback_description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Feedback Button Title</label>
                                        <input type="text"  class="form-control" name="feedback_button_title"
                                            placeholder="Feedback Button Title" value="<?php echo $customPageData['feedback_button_title']['value'] ?? ''; ?>">
                                        @error('feedback_button_title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Feedback Button Link</label>
                                        <input type="text"  class="form-control" name="feedback_button_link"
                                            placeholder="Feedback Button Link" value="<?php echo $customPageData['feedback_button_link']['value'] ?? ''; ?>">
                                        @error('feedback_button_link')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
                                <i class="fa fa-save"></i> Submit
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-2">Home page Feedback</h6>
                            <hr class="my-4" />
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Feedback Title</label>
                                        <input type="text"  class="form-control" name="feedback_title_hi"
                                            placeholder="Feedback Title" value="<?php echo $customPageData['feedback_title_hi']['value'] ?? ''; ?>">
                                        @error('feedback_title_hi')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Feedback Description</label>
                                        <textarea rows="2" class="form-control editor6" placeholder=""
                                            name="feedback_description_hi"><?php echo $customPageData['feedback_description_hi']['value'] ?? ''; ?></textarea>
                                        @error('feedback_description_hi')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
                                <i class="fa fa-save"></i> Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-2">Logos</h6>
                            <div class="upload-image-section" data-type="image" data-multiple="true"
                                data-path="pages" data-resize-large="200*50">
                                <div class="upload-section">
                                    <div class="button-ref mb-3">
                                        <button class="btn btn-icon btn-primary btn-lg" type="button">
                                            <span class="btn-inner--icon"><i class="fas fa-upload"></i></span>
                                            <span class="btn-inner--text">Upload Image</span>
                                        </button>
                                    </div>
                                    <!-- PROGRESS BAR -->
                                    <div class="progress d-none">
                                        <div class="progress-bar bg-default" role="progressbar"
                                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                            style="width: 0%;"></div>
                                    </div>
                                </div>
                                <h6 class="heading-small text-muted mb-2">Upload Logos, Size
                                    Of 200px
                                    * 50px
                                </h6>
                                <!-- INPUT WITH FILE URL -->
                                <textarea class="d-none" name="logos">{{ $customPageData['logos']['value'] ?? '' }}</textarea>
                                <div class="show-section <?php echo !old('logos') ? 'd-none' : ''; ?>">
                                    @include('admin.partials.previewFileRender', [
                                        'file' => old('logos'),
                                    ])
                                </div>
                                <div class="fixed-edit-section">
                                    @include('admin.partials.previewFileRender', [
                                        'file' =>
                                            $customPageData['logos']['value'] ?? '',
                                        'relationType' => null,
                                        'relationId' => null,
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-2">Bottom Yellow Banner</h6>
                            <hr class="my-4" />
                            <h6 class="heading-small text-muted mb-2">English</h6>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Title</label>
                                        <input type="text"  class="form-control" name="yellow_title"
                                            placeholder="About us title" value="<?php echo $customPageData['yellow_title']['value'] ?? ''; ?>">
                                        @error('yellow_title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Sub Heading</label>
                                        <input type="text"  class="form-control" name="yellow_heading"
                                            placeholder="About us heading" value="<?php echo $customPageData['yellow_heading']['value'] ?? ''; ?>">
                                        @error('yellow_heading')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Button Text</label>
                                        <input type="text"  class="form-control"
                                            name="yellow_button_text" placeholder="Text"
                                            value="<?php echo $customPageData['yellow_button_text']['value'] ?? ''; ?>">
                                        @error('yellow_button_text')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Button Link</label>
                                        <input type="text"  class="form-control"
                                            name="yellow_button_link" placeholder="Text"
                                            value="<?php echo $customPageData['yellow_button_link']['value'] ?? ''; ?>">
                                        @error('yellow_button_link')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Button Status</label>
                                        <div class="custom-control">
                                            <label class="custom-toggle">
                                                <input type="hidden" name="yellow_button" value="0">
                                                <input type="checkbox" name="yellow_button" value="1"
                                                    <?php echo isset($customPageData['yellow_button']['value']) && $customPageData['yellow_button']['value'] != '0' ? 'checked' : ''; ?>>
                                                <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                    data-label-on="Yes"></span>
                                            </label>
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
                </div>

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-2">Bottom Yellow Banner</h6>
                            <hr class="my-4" />
                            <h6 class="heading-small text-muted mb-2">Hindi</h6>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Title</label>
                                        <input type="text"  class="form-control" name="yellow_title_hi"
                                            placeholder="About us title" value="<?php echo $customPageData['yellow_title_hi']['value'] ?? ''; ?>">
                                        @error('yellow_title_hi')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Sub Heading</label>
                                        <input type="text"  class="form-control"
                                            name="yellow_heading_hi" placeholder="About us heading"
                                            value="<?php echo $customPageData['yellow_heading_hi']['value'] ?? ''; ?>">
                                        @error('yellow_heading_hi')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Button Text</label>
                                        <input type="text" class="form-control" name="yellow_button_text_hi"
                                            placeholder="Text" value="<?php echo $customPageData['yellow_button_text_hi']['value'] ?? ''; ?>">
                                        @error('yellow_button_text_hi')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Button Link</label>
                                        <input type="text" class="form-control" name="yellow_button_link_hi"
                                            placeholder="Text" value="<?php echo $customPageData['yellow_button_link_hi']['value'] ?? ''; ?>">
                                        @error('yellow_button_link_hi')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Button Status</label>
                                        <div class="custom-control">
                                            <label class="custom-toggle">
                                                <input type="hidden" name="yellow_button_hi" value="0">
                                                <input type="checkbox" name="yellow_button_hi" value="1"
                                                    <?php echo isset($customPageData['yellow_button_hi']['value']) && $customPageData['yellow_button_hi']['value'] != '0' ? 'checked' : ''; ?>>
                                                <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                    data-label-on="Yes"></span>
                                            </label>
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
                </div>
            </div>
        </form>
    </div>
@endsection
