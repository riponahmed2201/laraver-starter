@extends('layouts.backend.app')

@section('title', 'General Settings')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-settings icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>General Settings</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.dashboard') }}" class="btn-shadow mr-3 btn btn-danger">
                    <i class="fas fa-arrow-circle-left fa-w-20"></i>
                    Back
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('app.settings.general') }}" class="list-group-item list-group-item-action">General</a>
                <a href="{{ route('app.settings.general') }}" class="list-group-item list-group-item-action">Appearance</a>
            </div>
        </div>
        <div class="col-md-9">

            <!-- How to use callout -->
            <div class="main-card card mb-3">
                <div class="card-body">
                    <h5 class="card-title">How to use:</h5>
                    <p>You can get the value of each setting anywhere on your site by calling <code>setting('key')</code>
                    </p>
                </div>
            </div>

            <form method="POST" action="{{ route('app.settings.general.update') }}">

                @csrf
                @method('PUT')

                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="site_title">Site Title</label>
                            <input type="text" id="site_title" name="site_title" required
                                class="form-control @error('site_title') is-invalid @enderror"
                                value="{{ setting('site_title') ?? old('site_title') }}">
                            @error('site_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="site_description">Site Description</label>
                            <textarea name="site_description" id="site_description"
                                class="form-control @error('site_description') is-invalid @enderror">{{ setting('site_description') ?? old('site_description') }}</textarea>
                            @error('site_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="site_address">Site Address</label>
                            <textarea name="site_address" id="site_address"
                                class="form-control @error('site_address') is-invalid @enderror">{{ setting('site_address') ?? old('site_address') }}</textarea>
                            @error('site_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
