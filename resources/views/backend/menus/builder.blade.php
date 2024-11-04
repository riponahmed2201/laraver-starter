@extends('layouts.backend.app')

@section('title', 'Menu Builder')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-bars icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Menu Builder ({{ $menu->name }})</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.menus.index') }}" data-toggle="tooltip" title="Menu List"
                    class="btn-shadow mr-3 btn btn-danger">
                    <i class="fas fa-arrow-circle-left"></i>
                    Back to list
                </a>

                <a href="{{ route('app.menus.item.create', $menu->id) }}" data-toggle="tooltip" title="Create Menu Item"
                    class="btn-shadow mr-3 btn btn-primary">
                    <i class="fas fa-plus-circle"></i>
                    Create Menu Item
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">How To Use:</h5>
                    <p>You can output a menu anywhere on your site by calling <code>menu('name')</code></p>
                </div>
            </div>

            <div class="main-card mb-3 card">
                <div class="card-body menu-builder">
                    <h5 class="card-title">Drag and drop the Items below to re-arrange them.</h5>
                    <div class="dd">
                        <ol>
                            @forelse ($menu->menuItems as $item)
                                <li>
                                    @if ($item->type == 'divider')
                                        <strong>{{ $item->divider_title }}</strong>
                                    @else
                                        <span>{{ $item->title }}</span>
                                    @endif

                                    <a href="{{ route('app.menus.item.edit', ['id' => $menu->id, 'itemId' => $item->id]) }}"
                                        class="btn btn-info btn-sm">
                                        <i class="fas fa-edit"></i> <span>Edit</span> </a>

                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="deleteData({{ $item->id }})">
                                        <i class="fas fa-trash"></i> <span>Delete</span> </button>

                                    <form id="delete-form-{{ $menu->id }}" method="POST"
                                        action="{{ route('app.menus.item.destroy', ['id' => $menu->id, 'itemId' => $item->id]) }}"
                                        style="display: none">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                </li>
                            @empty
                                <div class="text-center">
                                    <strong>No menu item found.</strong>
                                </div>
                            @endforelse

                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
