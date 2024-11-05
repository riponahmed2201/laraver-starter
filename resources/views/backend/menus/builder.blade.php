@extends('layouts.backend.app')

@section('title', 'Menu Builder')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css"
        integrity="sha512-yOW3WV01iPnrQrlHYlpnfVooIAQl/hujmnCmiM3+u8F/6cCgA3BdFjqQfu8XaOtPilD/yYBJR3Io4PO8QUQKWA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .menu-builder .dd {
            position: relative;
            display: block;
            margin: 0;
            padding: 0;
            max-width: inherit;
            list-style: none;
            font-size: 13px;
            line-height: 20px;
        }

        .menu-builder .dd .item_actions {
            z-index: 9;
            position: relative;
            top: 10px;
            right: 10px;
        }

        .menu-builder .dd .item_actions .edit {
            margin-right: 5px;
        }

        .menu-builder .dd-handle {
            display: block;
            height: 50px;
            margin: 5px 0;
            padding: 14px 25px;
            color: #333;
            text-decoration: none;
            font-weight: 700;
            border: 1px solid #ccc;
            background: #fafafa;
            border-radius: 3px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }
    </style>
@endpush

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
                        <ol class="dd-list">
                            @forelse ($menu->menuItems as $item)
                                <li class="dd-item" data-id="{{ $item->id }}">
                                    <div class="pull-right item_actions">
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
                                    </div>
                                    
                                    <div class="dd-handle">
                                        @if ($item->type == 'divider')
                                            <strong>Divider: {{ $item->divider_title }}</strong>
                                        @else
                                            <span>{{ $item->title }}</span>
                                            <small class="url">{{ $item->url }}</small>
                                        @endif
                                    </div>

                                    @if (!$item->childs->isEmpty())
                                        <ol class="dd-list">
                                            @foreach ($item->childs as $childItem)
                                                <li class="dd-item" data-id="{{ $childItem->id }}">
                                                    <div class="pull-right item_actions">
                                                        <a href="{{ route('app.menus.item.edit', ['id' => $menu->id, 'itemId' => $childItem->id]) }}"
                                                            class="btn btn-info btn-sm">
                                                            <i class="fas fa-edit"></i> <span>Edit</span> </a>

                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="deleteData({{ $item->id }})">
                                                            <i class="fas fa-trash"></i> <span>Delete</span> </button>

                                                        <form id="delete-form-{{ $menu->id }}" method="POST"
                                                            action="{{ route('app.menus.item.destroy', ['id' => $menu->id, 'itemId' => $childItem->id]) }}"
                                                            style="display: none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                    <div class="dd-handle">
                                                        @if ($childItem->type == 'divider')
                                                            <strong>Divider: {{ $childItem->divider_title }}</strong>
                                                        @else
                                                            <span>{{ $childItem->title }}</span>
                                                            <small class="url">{{ $childItem->url }}</small>
                                                        @endif
                                                    </div>
                                                </li>
                                            @endforeach

                                        </ol>
                                    @endif
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

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js"
        integrity="sha512-7bS2beHr26eBtIOb/82sgllyFc1qMsDcOOkGK3NLrZ34yTbZX8uJi5sE0NNDYFNflwx1TtnDKkEq+k2DCGfb5w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('.dd').nestable({
            maxDepth: 2
        });

        $('.dd').on('change', function(e) {
            $.post('{{ route('app.menus.order', $menu->id) }}', {
                order: JSON.stringify($('.dd').nestable('serialize')),
                _token: '{{ csrf_token() }}'
            }, function(data) {
                iziToast.success({
                    title: 'Success',
                    message: 'Successfully updated menu order.',
                });
            })

        });
    </script>
@endpush
