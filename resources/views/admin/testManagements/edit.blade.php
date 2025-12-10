@extends('layouts.adminlayout')
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Manage Notices</h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="<?php echo route('admin.notices'); ?>" class="btn btn-neutral"><i class="ni ni-bold-left"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <form method="post" action="<?php echo route('admin.notices.edit', $page->id); ?>" class="form-validation">
            <!--!! CSRF FIELD !!-->
            {{ @csrf_field() }}
            <div class="row">
                <div class="col-xl-6 order-xl-1">
                    <div class="card">
                        <!--!! FLAST MESSAGES !!-->
                        @include('admin.partials.flash_messages')
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Create New Notices Here.</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-4">Notices information</h6>
                            {{-- <div class="card-body">
                            <h6 class="heading-small text-muted mb-4">Banner</h6> --}}
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label">Date</label>
                                            <input class="form-control" type="date" name="date"
                                                value="{{ old('date', isset($page->date) ? date('Y-m-d', strtotime($page->date)) : '') }}"
                                                max="{{ date('Y-m-d') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Title</label>
                                            <input type="text" value="<?php echo $page->title ?? ''; ?>" required class="form-control"
                                                name="title" placeholder="Text">
                                            @error('title')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label">Type</label><br>

                                            @php
                                                $selectedType = old('file_type', $page->file_type ?? 'content');
                                            @endphp

                                            <label>
                                                <input type="radio" name="file_type" value="content" {{ $selectedType == 'content' ? 'checked' : '' }}> Content
                                            </label>
                                            <label class="ml-3">
                                                <input type="radio" name="file_type" value="url" {{ $selectedType == 'url' ? 'checked' : '' }}> URL
                                            </label>
                                            <label class="ml-3">
                                                <input type="radio" name="file_type" value="pdf" {{ $selectedType == 'pdf' ? 'checked' : '' }}> PDF
                                            </label>
                                        </div>
                                    </div> -->

                                    {{-- Content Editor --}}
                                    <div class="col-lg-12 type-section type-content {{ $selectedType == 'content' ? '' : 'd-none' }}">
                                        <div class="form-group">
                                            <label class="form-control-label">Description</label>
                                            <textarea rows="2" class="form-control" placeholder="Description" name="description">{{ old('description', $page->description ?? '') }}</textarea>
                                            @error('description')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- URL Input --}}
                                    <div class="col-lg-12 type-section type-url {{ $selectedType == 'url' ? '' : 'd-none' }}">
                                        <div class="form-group">
                                            <label class="form-control-label">Enter URL</label>
                                            <input type="text" class="form-control" name="url" placeholder="https://example.com" value="{{ old('url', $page->url ?? '') }}">
                                            @error('url')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- PDF Upload --}}
                                    <div class="col-lg-6 type-section type-pdf {{ $selectedType == 'pdf' ? '' : 'd-none' }}">
                                        <div class="form-group">
                                            <div class="upload-image-section"
                                                data-type="pdf"
                                                data-multiple="false"
                                                data-path="news_events"
                                                data-resize-large="551*356">
                                                <div class="upload-section">
                                                    <div class="button-ref mb-3">
                                                        <button class="btn btn-icon btn-primary btn-lg" type="button">
                                                            <span class="btn-inner--icon"><i class="fas fa-upload"></i></span>
                                                            <span class="btn-inner--text">Upload PDF</span>
                                                        </button>
                                                    </div>
                                                    <div class="progress d-none">
                                                        <div class="progress-bar bg-default" role="progressbar"></div>
                                                    </div>
                                                </div>

                                                <textarea class="d-none" name="pdf_file">{{ old('pdf_file', $page->pdf_file ?? '') }}</textarea>
                                                <div class="show-section {{ !(old('pdf_file', $page->pdf_file ?? '')) ? 'd-none' : '' }}">
                                                    @if(old('pdf_file', $page->pdf_file ?? ''))
                                                        @include('admin.partials.previewFileRender', ['file' => old('pdf_file', $page->pdf_file) ])
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label">Description</label>
                                            <textarea rows="2" id="editor1"  required class="form-control"
                                                placeholder="Banner Description" name="description"><?php echo $page->description ?? ''; ?></textarea>
                                            @error('description')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div> -->

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
                                                        <?php echo isset($page->status) && $page->status != '0' ? 'checked' : ''; ?>>
                                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                        data-label-on="Yes"></span>
                                                </label>
                                                <label class="custom-control-label">Do you want to publish this page
                                                    ?</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="custom-control">
                                                <label class="custom-toggle">
                                                    <input type="hidden" name="is_new" value="0">
                                                    <input type="checkbox" name="is_new" value="1" 
                                                        {{ isset($page->is_new) && $page->is_new == 1 ? 'checked' : '' }}>
                                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                        data-label-on="Yes"></span>
                                                </label>
                                                <label class="custom-control-label">Is New ?</label>
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
                </div>

                <div class="col-xl-6 order-xl-1">
                    <div class="card">
                        <!--!! FLAST MESSAGES !!-->
                        @include('admin.partials.flash_messages')
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Hindi</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-4">Notices information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Title</label>
                                            <input type="text" value="<?php echo $page->title_hi ?? ''; ?>" required
                                                class="form-control" name="title_hi" placeholder="Text">
                                            @error('title_hi')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label">Description</label>
                                            <textarea rows="2" id="editor2"  required class="form-control"
                                                placeholder="Banner Description" name="description_hi"><?php echo $page->description_hi ?? ''; ?></textarea>
                                            @error('description_hi')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
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
                </div>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('input[name="file_type"]').forEach(function(radio) {
                radio.addEventListener('change', function() {
                    document.querySelectorAll('.type-section').forEach(function(section) {
                        section.classList.add('d-none');
                    });
                    document.querySelector('.type-' + this.value).classList.remove('d-none');
                });
            });
        });
    </script>
@endsection
