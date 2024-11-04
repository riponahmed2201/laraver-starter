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
            action="{{ isset($menuItem) ? route('app.menus.item.update', ['id' => $menu->id, 'itemId' => $menuItem->id]) : route('app.menus.item.store', $menu->id) }}">

            @csrf

            @isset($menuItem)
                @method('PUT')
            @endisset

            <div class="row">
                <div class="col-md-8">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div class="card-title">Manage Menu Item</div>

                            <div class="from-group mb-3">
                                <label for="type">Type</label>
                                <select name="type" id="type" onchange="setItemType()"
                                    class="custom-select @error('type') is-invalid @enderror">
                                    <option value="item"
                                        @isset($menuItem) {{ $menuItem->type == 'item' ? 'selected' : '' }} @endisset>
                                        Menu Item</option>
                                    <option value="divider"
                                        @isset($menuItem) {{ $menuItem->type == 'divider' ? 'selected' : '' }} @endisset>
                                        Divider</option>
                                </select>
                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div id="divider_fields">
                                <div class="form-group">
                                    <label for="divider_title">Title of the Divider</label>
                                    <input type="text" id="divider_title" name="divider_title"
                                        class="form-control @error('divider_title') is-invalid @enderror"
                                        value="{{ $menuItem->divider_title ?? old('divider_title') }}">
                                    @error('divider_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div id="item_fields">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" id="title" name="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ $menuItem->title ?? old('title') }}">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="url">URL for the menu item</label>
                                    <input type="text" id="url" name="url"
                                        class="form-control @error('url') is-invalid @enderror"
                                        value="{{ $menuItem->url ?? old('url') }}">
                                    @error('url')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="from-group mb-3">
                                    <label for="target">Open In</label>
                                    <select name="target" id="target"
                                        class="custom-select @error('target') is-invalid @enderror">
                                        <option value="_self"
                                            @isset($menuItem) {{ $menuItem->target == '_self' ? 'selected' : '' }} @endisset>
                                            Same Tab/Window</option>
                                        <option value="_blank"
                                            @isset($menuItem) {{ $menuItem->target == '_blank' ? 'selected' : '' }} @endisset>
                                            New Tab/Window</option>
                                    </select>
                                    @error('target')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="icon_class">Font Icon class for menu item <a target="_blank"
                                            href="https://fontawesome">(Use a Fontawesome Font Class) </a> </label>
                                    <input type="text" id="icon_class" name="icon_class"
                                        class="form-control @error('icon_class') is-invalid @enderror"
                                        value="{{ $menuItem->icon_class ?? old('icon_class') }}">
                                    @error('icon_class')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
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

@push('js')
<script>
    function setItemType() {
        if ($('select[name="type"]').val() == 'divider') {
            $('#divider_fields').removeClass('d-none');
            $('#item_fields').addClass('d-none');
        } else {
            $('#divider_fields').addClass('d-none');
            $('#item_fields').removeClass('d-none');
        }
    }

    setItemType();
</script>
@endpush
