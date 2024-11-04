@extends('layouts.backend.app')

@section('title', 'Menus')

@push('css')
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap4.css">
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-bars icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Menus</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.menus.create') }}" data-toggle="tooltip" title="Create menu" data-placement="bottom"
                    class="btn-shadow mr-3 btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Create Menu
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-table" class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Name</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menus as $menu)
                                    <tr>
                                        <td class="text-center text-muted">#{{ $loop->iteration }}</td>
                                        <td> <code>{{ $menu->name }}</code> </td>
                                        <td class="text-center">{{ $menu->description }}</td>
                                        <td class="text-center">

                                            <a href="{{ route('app.menus.builder', $menu->id) }}"
                                                class="btn btn-success btn-sm">
                                                <i class="fas fa-list-ul"></i> <span>Builder</span> </a>

                                            <a href="{{ route('app.menus.edit', $menu->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-edit"></i> <span>Edit</span> </a>

                                            @if ($menu->deletable)
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="deleteData({{ $menu->id }})">
                                                    <i class="fas fa-trash"></i> <span>Delete</span> </button>

                                                <form id="delete-form-{{ $menu->id }}" method="POST"
                                                    action="{{ route('app.menus.destroy', $menu->id) }}"
                                                    style="display: none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap4.js"></script>

    <script>
        $(document).ready(function() {
            $("#data-table").DataTable();
        });
    </script>
@endpush
