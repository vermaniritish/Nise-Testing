@extends('layouts.adminlayout')
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Manage Testing Service Categories</h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="<?php echo route('admin.testServiceCategories'); ?>" class="btn btn-neutral"><i class="ni ni-bold-left"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <form method="post" action="<?php echo route('admin.testServiceCategories.add'); ?>" class="form-validation">
            <!--!! CSRF FIELD !!-->
            {{ @csrf_field() }}
            <div class="row">
                <div class="col-xl-12 order-xl-1">
                    <div class="card">
                        <!--!! FLAST MESSAGES !!-->
                        @include('admin.partials.flash_messages')
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Create New Testing Service Category Here.</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-4">Testing Service Category information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-type">Testing Service</label>
                                            <select name="test_service_id" class="form-control" required>
                                                <option value="" selected disabled>Select Testing Service</option>
                                                @foreach($testingServices as $testingServices)
                                                    <option value="{{ $testingServices['id'] }}">{{ $testingServices->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('test_service_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Title</label>
                                            <input type="text" maxlength="150" value="{{ old('test_category_title') }}" required class="form-control"
                                                name="test_category_title" placeholder="Text">
                                            <small>You can enter up to 150 characters only.</small>
                                            @error('test_category_title')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-7 pl-lg-4">
                                        <label class="form-control-label" for="input-first-name">Sample File</label>
                                        <div class="upload-image-section" 
                                            data-type="file" 
                                            data-multiple="false" 
                                            data-path="testServiceCategory" 
                                            data-resize-large="551*356"
                                        >
                                            <div class="upload-section">
                                                <div class="button-ref mt-4">
                                                    <button class="btn btn-icon btn-primary btn-lg" type="button">
                                                        <span class="btn-inner--icon"><i class="fas fa-upload"></i></span>
                                                        <span class="btn-inner--text">Upload File</span>
                                                    </button>
                                                </div>
                                                <div class="progress d-none">
                                                  <div class="progress-bar bg-default" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                                </div>
                                            </div>
                                            <!-- INPUT WITH FILE URL -->
                                            <textarea class="d-none" required name="sample_file"><?php echo old('sample_file') ?></textarea>
                                            <div class="show-section <?php echo !old('sample_file') ? 'd-none' : "" ?>">
                                                @include('admin.partials.previewFileRender', ['file' => old('sample_file') ])
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12 pl-lg-4">
                                        <hr style="border: 1px solid #dee2e6; margin-bottom: 20px;">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">
                                                <span style="color:#f5365c !important;">Details of Document</span>
                                            </label>

                                            <div id="document-wrapper">
                                                <div class="row document-item mb-3">
                                                    <div class="col-lg-6 col-7 pl-lg-4">
                                                        <label class="form-control-label">Name of Document Title</label>
                                                        <input type="text" maxlength="150" required class="form-control" name="detail_of_document[title][]" placeholder="Name of Document Title">
                                                        <small>You can enter up to 150 characters only.</small>
                                                    </div>

                                                    <div class="col-lg-6 col-7 pl-lg-4">
                                                        <label class="form-control-label">Name of Document Sub Title</label>
                                                        <input type="text" maxlength="200" required class="form-control" name="detail_of_document[sub_title][]" placeholder="Name of Document Sub Title">
                                                        <small>You can enter up to 200 characters only.</small>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="button" id="addMore" class="btn btn-sm btn-success mt-2">
                                                + Add More
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-12 pl-lg-4">
                                        <hr style="border: 1px solid #dee2e6; margin-bottom: 20px;">
                                        <div class="form-group">

                                            <label class="form-control-label" for="input-first-name"><span style="color:#f5365c !important;">Internal Test Report (optional)</span></label>

                                            <div class="row">
                                                <div class="col-lg-6 col-7 pl-lg-4">
                                                    <label class="form-control-label" for="input-first-name">Name of Document</label>
                                                    <input type="text" required="" class="form-control" maxlength="150" name="name_of_document_4" value="" placeholder="Internal Test Report (optional)">
                                                    <small>You can enter up to 150 characters only.</small>
                                                </div>
                                                <div class="col-lg-6 col-7 pl-lg-4">
                                                    <div class="upload-image-section" 
                                                        data-type="file" 
                                                        data-multiple="false" 
                                                        data-path="testServiceCategory" 
                                                        data-resize-large="551*356"
                                                    >
                                                        <div class="upload-section">
                                                            <div class="button-ref mt-4">
                                                                <button class="btn btn-icon btn-primary btn-lg" type="button">
                                                                    <span class="btn-inner--icon"><i class="fas fa-upload"></i></span>
                                                                    <span class="btn-inner--text">Upload File</span>
                                                                </button>
                                                            </div>
                                                            <div class="progress d-none">
                                                              <div class="progress-bar bg-default" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                                            </div>
                                                        </div>
                                                        <!-- INPUT WITH FILE URL -->
                                                        <textarea class="d-none" required name="name_of_document_file_4"><?php echo old('name_of_document_file_4') ?></textarea>
                                                        <div class="show-section <?php echo !old('name_of_document_file_4') ? 'd-none' : "" ?>">
                                                            @include('admin.partials.previewFileRender', ['file' => old('name_of_document_file_4') ])
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-12 pl-lg-4">
                                        <hr style="border: 1px solid #dee2e6; margin-bottom: 20px;">
                                        <div class="form-group">
                                            <label class="form-control-label">
                                                <span style="color:#f5365c !important;">Other Required Forms</span>
                                            </label>

                                            <div id="other-required-wrapper">
                                                <div class="row other-required-item mb-3">
                                                    <div class="col-lg-6 col-7 pl-lg-4">
                                                        <label class="form-control-label">Name of Document</label>
                                                        <input type="text" maxlength="150" required class="form-control" name="other_required_form[name][]" placeholder="Name Of Document">
                                                        <small>You can enter up to 150 characters only.</small>
                                                    </div>

                                                    <div class="col-lg-6 col-7 pl-lg-4">
                                                        <div class="upload-image-section"
                                                            data-type="file"
                                                            data-multiple="false"
                                                            data-path="testServiceCategory"
                                                            data-resize-large="551*356"
                                                        >
                                                            <div class="upload-section">
                                                                <div class="button-ref mt-4">
                                                                    <button class="btn btn-icon btn-primary btn-lg" type="button">
                                                                        <span class="btn-inner--icon"><i class="fas fa-upload"></i></span>
                                                                        <span class="btn-inner--text">Upload File</span>
                                                                    </button>
                                                                </div>
                                                                <div class="progress d-none">
                                                                    <div class="progress-bar bg-default" role="progressbar" style="width: 0%;"></div>
                                                                </div>
                                                            </div>

                                                            <!-- INPUT WITH FILE URL -->
                                                            <textarea class="d-none" required name="other_required_form[file][]">{{ old('other_required_form.file.0') }}</textarea>

                                                            <div class="show-section {{ !old('other_required_form.file.0') ? 'd-none' : '' }}">
                                                                @include('admin.partials.previewFileRender', ['file' => old('other_required_form.file.0')])
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="button" id="addOtherForm" class="btn btn-sm btn-success mt-2">
                                                + Add More
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4" />
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="custom-control">
                                                <label class="custom-toggle">
                                                    <input type="hidden" name="status" value="0">
                                                    <input type="checkbox" name="status" value="1"
                                                        <?php echo old('status') != '0' ? 'checked' : ''; ?>>
                                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                        data-label-on="Yes"></span>
                                                </label>
                                                <label class="custom-control-label">Do you want to publish this page
                                                    ?</label>
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
                </div>
        </form>
    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#addMore').click(function() {
            let newItem = `
                <div class="row document-item mb-3">
                    <div class="col-lg-6 col-7 pl-lg-4">
                        <label class="form-control-label">Name of Document Title</label>
                        <input type="text" required maxlength="150" class="form-control" name="detail_of_document[title][]" placeholder="Name of Document Title">
                        <small>You can enter up to 150 characters only.</small>
                    </div>

                    <div class="col-lg-6 col-7 pl-lg-4">
                        <label class="form-control-label">Name of Document Sub Title</label>
                        <input type="text" maxlength="200" required class="form-control" name="detail_of_document[sub_title][]" placeholder="Name of Document Sub Title">
                        <small>You can enter up to 200 characters only.</small>
                    </div>

                    <div class="col-lg-12 text-right mt-2">
                        <button type="button" class="btn btn-sm btn-danger removeItem">Remove</button>
                    </div>
                </div>
            `;
            $('#document-wrapper').append(newItem);
        });

        // Remove item
        $(document).on('click', '.removeItem', function() {
            $(this).closest('.document-item').remove();
        });
    });

    $(document).ready(function() {
        $('#addOtherForm').click(function() {
            let newItem = `
                <div class="row other-required-item mb-3">
                    <div class="col-lg-6 col-7 pl-lg-4">
                        <label class="form-control-label">Name of Document</label>
                        <input type="text" maxlength="150" required class="form-control" name="other_required_form[name][]" placeholder="Name Of Document">
                        <small>You can enter up to 150 characters only.</small>
                    </div>

                    <div class="col-lg-6 col-7 pl-lg-4">
                        <div class="upload-image-section" data-type="file" data-multiple="false" data-path="testServiceCategory" data-resize-large="551*356">
                            <div class="upload-section">
                                <div class="button-ref mt-4">
                                    <button class="btn btn-icon btn-primary btn-lg" type="button">
                                        <span class="btn-inner--icon"><i class="fas fa-upload"></i></span>
                                        <span class="btn-inner--text">Upload File</span>
                                    </button>
                                </div>
                                <div class="progress d-none">
                                    <div class="progress-bar bg-default" role="progressbar" style="width: 0%;"></div>
                                </div>
                            </div>
                            <textarea class="d-none" required name="other_required_form[file][]"></textarea>
                            <div class="show-section d-none"></div>
                        </div>
                    </div>

                    <div class="col-lg-12 text-right mt-2">
                        <button type="button" class="btn btn-sm btn-danger removeOtherItem">Remove</button>
                    </div>
                </div>
            `;
            $('#other-required-wrapper').append(newItem);
        });

        // Remove dynamic item
        $(document).on('click', '.removeOtherItem', function() {
            $(this).closest('.other-required-item').remove();
        });
    });
</script>
@endsection
