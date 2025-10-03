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
                        <h6 class="h2 text-white d-inline-block mb-0">Manage Home Page</h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="<?php echo route('admin.pages'); ?>" class="btn btn-neutral"><i class="ni ni-bold-left"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <form method="post" action="<?php echo route('admin.pages.edit', ['id' => $page->id]); ?>" class="form-validation">
            {{ @csrf_field() }}
            <input type="hidden" name="title" value="Home" />

            <div class="card">
                @include('admin.partials.flash_messages')

                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">Section 2</h6>
                    <div class="pl-lg-4">
                        <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Heading</label>
                            <input type="text" class="form-control" name="second_section_heading"
                                value="<?php echo $customPageData['second_section_heading']['value'] ?? ''; ?>">

                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">01 Card Text</label>
                                    <input type="text" required class="form-control" name="01_Card_Text"
                                        placeholder="Banner Heading" value="<?php echo $customPageData['01_Card_Text']['value'] ?? ''; ?>">
                                    @error('01_Card_Text')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">02 Card Text</label>
                                    <input type="text" required class="form-control" name="02_Card_Text"
                                        placeholder="Text" value="<?php echo $customPageData['01_Card_Text']['value'] ?? ''; ?>">
                                    @error('02_Card_Text')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">03 Card Text</label>
                                    <input type="text" required class="form-control" name="03_Card_Text"
                                        placeholder="Text" value="<?php echo $customPageData['03_Card_Text']['value'] ?? ''; ?>">
                                    @error('03_Card_Text')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4" />
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <!-- FILE OR IMAGE UPLOAD. FOLDER PATH SET HERE in data-path AND CHANGE THE data-multiple TO TRUE SEE MAGIC. DO NOT REMOVE THE NESTED CALSSES -->
                                    <div class="upload-image-section" data-type="image" data-multiple="false"
                                        data-path="pages" data-resize-large="85px * 107px">
                                        <div class="upload-section">
                                            <div class="button-ref mb-3">
                                                <button class="btn btn-icon btn-primary btn-lg" type="button">
                                                    <span class="btn-inner--icon"><i class="fas fa-upload"></i></span>
                                                    <span class="btn-inner--text">Upload Image</span>
                                                </button>
                                            </div>
                                            <!-- PROGRESS BAR -->
                                            <div class="progress d-none">
                                                <div class="progress-bar bg-default" role="progressbar" aria-valuenow="0"
                                                    aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                            </div>
                                        </div>
                                        <h6 class="heading-small text-muted mb-4">Upload Image Size Of 85px * 107px</h6>
                                        <!-- INPUT WITH FILE URL -->
                                        <textarea class="d-none" name="01_Card_image">{{ $customPageData['01_Card_image']['value'] ?? '' }}</textarea>
                                        <div class="show-section <?php echo !old('01_Card_image') ? 'd-none' : ''; ?>">
                                            @include('admin.partials.previewFileRender', [
                                                'file' => old('01_Card_image'),
                                            ])
                                        </div>
                                        <div class="fixed-edit-section">
                                            @include('admin.partials.previewFileRender', [
                                                'file' => $customPageData['01_Card_image']['value'] ?? '',
                                                'relationType' => 'custom_page_data.01_Card_image',
                                                'relationId' => $customPageData['01_Card_image']['id'] ?? '',
                                            ])
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <!-- FILE OR IMAGE UPLOAD. FOLDER PATH SET HERE in data-path AND CHANGE THE data-multiple TO TRUE SEE MAGIC. DO NOT REMOVE THE NESTED CALSSES -->
                                    <div class="upload-image-section" data-type="image" data-multiple="false"
                                        data-path="pages" data-resize-large="85px * 107px">
                                        <div class="upload-section">
                                            <div class="button-ref mb-3">
                                                <button class="btn btn-icon btn-primary btn-lg" type="button">
                                                    <span class="btn-inner--icon"><i class="fas fa-upload"></i></span>
                                                    <span class="btn-inner--text">Upload Image</span>
                                                </button>
                                            </div>
                                            <!-- PROGRESS BAR -->
                                            <div class="progress d-none">
                                                <div class="progress-bar bg-default" role="progressbar" aria-valuenow="0"
                                                    aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                            </div>
                                        </div>
                                        <h6 class="heading-small text-muted mb-4">Upload Image Size Of 85px * 107px</h6>
                                        <!-- INPUT WITH FILE URL -->
                                        <textarea class="d-none" name="02_Card_image">{{ $customPageData['02_Card_image']['value'] ?? '' }}</textarea>
                                        <div class="show-section <?php echo !old('02_Card_image') ? 'd-none' : ''; ?>">
                                            @include('admin.partials.previewFileRender', [
                                                'file' => old('02_Card_image'),
                                            ])
                                        </div>
                                        <div class="fixed-edit-section">
                                            @include('admin.partials.previewFileRender', [
                                                'file' => $customPageData['02_Card_image']['value'] ?? '',
                                                'relationType' => 'custom_page_data.02_Card_image',
                                                'relationId' => $customPageData['02_Card_image']['id'] ?? '',
                                            ])
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <!-- FILE OR IMAGE UPLOAD. FOLDER PATH SET HERE in data-path AND CHANGE THE data-multiple TO TRUE SEE MAGIC. DO NOT REMOVE THE NESTED CALSSES -->
                                    <div class="upload-image-section" data-type="image" data-multiple="false"
                                        data-path="pages" data-resize-large="85px * 107px">
                                        <div class="upload-section">
                                            <div class="button-ref mb-3">
                                                <button class="btn btn-icon btn-primary btn-lg" type="button">
                                                    <span class="btn-inner--icon"><i class="fas fa-upload"></i></span>
                                                    <span class="btn-inner--text">Upload Image</span>
                                                </button>
                                            </div>
                                            <!-- PROGRESS BAR -->
                                            <div class="progress d-none">
                                                <div class="progress-bar bg-default" role="progressbar" aria-valuenow="0"
                                                    aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                            </div>
                                        </div>
                                        <h6 class="heading-small text-muted mb-4">Upload Image Size Of 85px * 107px</h6>
                                        <!-- INPUT WITH FILE URL -->
                                        <textarea class="d-none" name="03_Card_image">{{ $customPageData['03_Card_image']['value'] ?? '' }}</textarea>
                                        <div class="show-section <?php echo !old('03_Card_image') ? 'd-none' : ''; ?>">
                                            @include('admin.partials.previewFileRender', [
                                                'file' => old('03_Card_image'),
                                            ])
                                        </div>
                                        <div class="fixed-edit-section">
                                            @include('admin.partials.previewFileRender', [
                                                'file' => $customPageData['03_Card_image']['value'] ?? '',
                                                'relationType' => 'custom_page_data.03_Card_image',
                                                'relationId' => $customPageData['03_Card_image']['id'] ?? '',
                                            ])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4" />
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-first-name">Button Status</label>
                                <div class="custom-control">
                                    <label class="custom-toggle">
                                        <input type="hidden" name="second_banner_status" value="0">
                                        <input type="checkbox" name="second_banner_status" value="1"
                                            <?php echo isset($customPageData['second_banner_status']['value']) && $customPageData['second_banner_status']['value'] != '0' ? 'checked' : ''; ?>>
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                            data-label-on="Yes"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-first-name">Button Text</label>
                                <input type="text" required class="form-control" name="second_banner_text"
                                    placeholder="Text" value="<?php echo $customPageData['second_banner_text']['value'] ?? ''; ?>">
                                @error('second_banner_link')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-first-name">Button Link</label>
                                <input type="text" required class="form-control" name="second_banner_link"
                                    placeholder="Text" value="<?php echo $customPageData['second_banner_link']['value'] ?? ''; ?>">
                                @error('second_banner_link')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
                        <i class="fa fa-save"></i> Submit
                    </button>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">Business Listing Section</h6>

                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-12 form-group">
                                <label class="form-control-label" for="input-first-name">Heading</label>
                                <input type="text" required class="form-control" name="home_category_text"
                                    placeholder="" value="<?php echo $customPageData['home_category_text']['value'] ?? ''; ?>">
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <!-- FILE OR IMAGE UPLOAD. FOLDER PATH SET HERE in data-path AND CHANGE THE data-multiple TO TRUE SEE MAGIC. DO NOT REMOVE THE NESTED CALSSES -->
                                    <div class="upload-image-section" data-type="image" data-multiple="false"
                                        data-path="pages" data-resize-large="1300*819">
                                        <div class="upload-section">
                                            <div class="button-ref mb-3">
                                                <button class="btn btn-icon btn-primary btn-lg" type="button">
                                                    <span class="btn-inner--icon"><i class="fas fa-upload"></i></span>
                                                    <span class="btn-inner--text">Upload Image</span>
                                                </button>
                                            </div>
                                            <!-- PROGRESS BAR -->
                                            <div class="progress d-none">
                                                <div class="progress-bar bg-default" role="progressbar" aria-valuenow="0"
                                                    aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                            </div>
                                        </div>
                                        <h6 class="heading-small text-muted mb-4">Upload Image Size Of 1300px * 820px</h6>

                                        <!-- INPUT WITH FILE URL -->
                                        <textarea class="d-none" name="home_category_image">{{ $customPageData['home_category_image']['value'] ?? '' }}</textarea>
                                        <div class="show-section <?php echo !old('home_category_image') ? 'd-none' : ''; ?>">
                                            @include('admin.partials.previewFileRender', [
                                                'file' => old('home_category_image'),
                                            ])
                                        </div>
                                        <div class="fixed-edit-section">
                                            @include('admin.partials.previewFileRender', [
                                                'file' => $customPageData['home_category_image']['value'] ?? '',
                                                'relationType' => 'custom_page_data.value',
                                                'relationId' => $customPageData['home_category_image']['id'] ?? '',
                                            ])
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
                    <h6 class="heading-small text-muted mb-4">Featured Block Section</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Heading</label>
                                    <input type="text" required class="form-control" name="license_heading"
                                        placeholder="Banner Heading" value="<?php echo $customPageData['license_heading']['value'] ?? ''; ?>">
                                    @error('license_heading')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- <p><a href="{{ route('admin.license') }}" target="_blank">Click here to manage featured blocks.</a></p> --}}
                    </div>
                    <hr class="my-4" />
                    <button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
                        <i class="fa fa-save"></i> Submit
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">Testimonial Secton</h6>
                    <div class="pl-lg-4">

                        <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Heading</label>
                            <input type="text" required class="form-control" name="yellow_card_headng"
                                placeholder="Banner Heading" value="<?php echo $customPageData['yellow_card_headng']['value'] ?? ''; ?>">
                            @error('yellow_card_headng')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Description</label>
                            <textarea rows="2" required class="form-control" placeholder="Banner Description"
                                name="yellow_card_description"><?php echo $customPageData['yellow_card_description']['value'] ?? ''; ?></textarea>
                            @error('yellow_card_description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <p><a href="{{ route('admin.testimonial') }}" target="_blank">Click here to manage
                                testimonials.</a></p>
                    </div>
                    <hr class="my-4" />
                    <button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
                        <i class="fa fa-save"></i> Submit
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">Logos and Brand Section</h6>
                    <div class="pl-lg-4">
                        <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Title</label>
                            <input type="text" class="form-control" name="govt_dept_title" placeholder="Title"
                                value="<?php echo $customPageData['govt_dept_title']['value'] ?? ''; ?>">
                            @error('govt_dept_title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Description</label>
                            <textarea rows="2" class="form-control" placeholder="Description" name="govt_dept_description"><?php echo $customPageData['govt_dept_description']['value'] ?? ''; ?></textarea>
                            @error('govt_dept_description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4" />
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <!-- FILE OR IMAGE UPLOAD. FOLDER PATH SET HERE in data-path AND CHANGE THE data-multiple TO TRUE SEE MAGIC. DO NOT REMOVE THE NESTED CALSSES -->
                                    <div class="upload-image-section" data-type="image" data-multiple="true"
                                        data-path="pages" data-resize-large="200*200" data-max="20">
                                        <div class="upload-section">
                                            <div class="button-ref mb-3">
                                                <button class="btn btn-icon btn-primary btn-lg" type="button">
                                                    <span class="btn-inner--icon"><i class="fas fa-upload"></i></span>
                                                    <span class="btn-inner--text">Upload Image</span>
                                                </button>
                                            </div>
                                            <!-- PROGRESS BAR -->
                                            <div class="progress d-none">
                                                <div class="progress-bar bg-default" role="progressbar" aria-valuenow="0"
                                                    aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                            </div>
                                        </div>
                                        <h6 class="heading-small text-muted mb-4">Upload Image Size Of 200px * 200px</h6>
                                        <!-- INPUT WITH FILE URL -->
                                        <textarea class="d-none" name="govt_dept_img1">{{ $customPageData['govt_dept_img1']['value'] ?? '' }}</textarea>
                                        <div class="show-section <?php echo !old('govt_dept_img1') ? 'd-none' : ''; ?>">
                                            @include('admin.partials.previewFileRender', [
                                                'file' => old('govt_dept_img1'),
                                            ])
                                        </div>
                                        <div class="fixed-edit-section">
                                            @include('admin.partials.previewFileRender', [
                                                'file' => $customPageData['govt_dept_img1']['value'] ?? '',
                                                'relationType' => 'custom_page_data.value',
                                                'relationId' => $customPageData['govt_dept_img1']['id'] ?? '',
                                            ])
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
        </form>
    </div>
    </div>
    </div>
@endsection
