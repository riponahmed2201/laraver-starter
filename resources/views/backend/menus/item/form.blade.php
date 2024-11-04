@extends('layouts.backend.app')

@isset($menuItem)
    @section('title', 'Menu Edit')
@else
@section('title', 'Menu Create')
@endisset

@isset($menuItem)
@section('title', 'Edit Menu Item')
@else
@section('title', 'Add New Menu Item')
@endisset

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="fas fa-bars icon-gradient bg-mean-fruit"></i>
            </div>

            <div>
                @isset($menuItem)
                    Edit Menu Item
                @else
                    Add New Menu Item to (<code>{{ $menu->name }}</code>)
                @endisset
            </div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.menus.index') }}" data-toggle="tooltip" title="Menu List"
                class="btn-shadow mr-3 btn btn-danger">
                <i class="fas fa-arrow-circle-left"></i>
                Back to list
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <form method="POST"
            action="{{ isset($menuItem) ? route('app.menus.update', $menuItem->id) : route('app.menus.store') }}">

            @csrf

            @isset($menuItem)
                @method('PUT')
            @endisset

            <div class="row">
                <div class="col-md-8">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div class="card-title">Basic Info</div>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" required
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ $menuItem->name ?? old('name') }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ $menuItem->description ?? old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                @isset($menuItem)
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
