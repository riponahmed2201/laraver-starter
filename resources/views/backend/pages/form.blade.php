@extends('layouts.backend.app')

@isset($page)
    @section('title', 'Page Edit')
@else
@section('title', 'Page Create')
@endisset

@push('css')
<style>
    .dropify-wrapper .dropify-message p {
        font-size: initial;
    }
</style>
@endpush

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-news-paper icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Page {{ isset($page) ? 'Edit' : 'Create' }}</div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.pages.index') }}" data-toggle="tooltip" title="Page List"
                class="btn-shadow mr-3 btn btn-danger">
                <i class="fas fa-arrow-circle-left fa-w-20"></i>
                Back to list
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <form method="POST" enctype="multipart/form-data"
            action="{{ isset($page) ? route('app.pages.update', $page->id) : route('app.pages.store') }}">

            @csrf

            @isset($page)
                @method('PUT')
            @endisset

            <div class="row">
                <div class="col-md-8">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div class="card-title">Basic Info</div>

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" name="title" required
                                    class="form-control @error('title') is-invalid @enderror"
                                    value="{{ $page->title ?? old('title') }}">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="excerpt">Excerpt</label>
                                <textarea name="excerpt" id="excerpt" class="form-control @error('excerpt') is-invalid @enderror">{{ $page->excerpt ?? old('excerpt') }}</textarea>
                                @error('excerpt')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea name="body" id="body" class="form-control @error('body') is-invalid @enderror">{{ $page->body ?? old('body') }}</textarea>
                                @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div class="card-title">Select Image and Status Info</div>

                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" id="image" name="image"
                                    data-default-file="{{ isset($page) ? $page->getFirstMediaUrl('image') : '' }}"
                                    {{ !isset($page) ? 'required' : '' }}
                                    class="form-control dropify @error('image') is-invalid @enderror">
                                @error('image')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div class="card-title">Meta Info</div>

                            <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                <textarea name="meta_description" id="meta_description"
                                    class="form-control @error('meta_description') is-invalid @enderror">{{ $page->meta_description ?? old('meta_description') }}</textarea>
                                @error('meta_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="meta_keywords">Meta Keywords</label>
                                <textarea name="meta_keywords" id="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror">{{ $page->meta_keywords ?? old('meta_keywords') }}</textarea>
                                @error('meta_keywords')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="status" name="status"
                                        @isset($page) {{ $page->status == true ? 'checked' : '' }} @endisset>
                                    <label for="status" class="custom-control-label">Status</label>
                                </div>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                @isset($page)
                                    <i class="fas fa-arrow-circle-up"></i>
                                    Update
                                @else
                                    <i class="fas fa-plus-circle"></i>
                                    Create
                                @endisset

                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.tiny.cloud/1/ryx7z4wqek89qgb9git4gs913gk67gep8aumlytp6skj8h6n/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: '#body',
        plugins: [
            // Core editing features
            'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media',
            'searchreplace', 'table', 'visualblocks', 'wordcount',
            // Your account includes a free trial of TinyMCE premium features
            // Try the most popular premium features until Nov 18, 2024:
            'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker',
            'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage',
            'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags',
            'autocorrect', 'typography', 'inlinecss', 'markdown',
            // Early access to document converters
            'importword', 'exportword', 'exportpdf'
        ],
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [{
                value: 'First.Name',
                title: 'First Name'
            },
            {
                value: 'Email',
                title: 'Email'
            },
        ],
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
            'See docs to implement AI Assistant')),
        exportpdf_converter_options: {
            'format': 'Letter',
            'margin_top': '1in',
            'margin_right': '1in',
            'margin_bottom': '1in',
            'margin_left': '1in'
        },
        exportword_converter_options: {
            'document': {
                'size': 'Letter'
            }
        },
        importword_converter_options: {
            'formatting': {
                'styles': 'inline',
                'resets': 'inline',
                'defaults': 'inline',
            }
        },
    });

    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.dropify').dropify();
    });
</script>
@endpush
