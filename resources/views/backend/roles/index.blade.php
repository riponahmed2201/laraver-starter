@extends('layouts.backend.app')

@push('css')
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap4.css">
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-check icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Roles</div>
            </div>
            <div class="page-title-actions">
                <button type="button" data-toggle="tooltip" title="Example Tooltip" data-placement="bottom"
                    class="btn-shadow mr-3 btn btn-dark">
                    <i class="fa fa-star"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Roles List</div>
                <div class="table-responsive">
                    <table id="data-table" class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Name</th>
                                <th class="text-center">Permissions</th>
                                <th class="text-center">Updated At</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td class="text-center text-muted">#{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $role->name }}</td>
                                    <td class="text-center">
                                        @if ($role->permissions->count() > 0)
                                            <span class="badge badge-info">{{ $role->permissions->count() }}</span>
                                        @else
                                            <span class="badge badge-danger">No permission found :( </span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $role->updated_at->diffForHumans() }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('app.roles.edit', $role->id) }}" class="btn btn-info btn-sm"> <i
                                                class="fas fa-edit"></i> <span>Edit</span> </a>
                                        <a href="{{ route('app.roles.destroy', $role->id) }}" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> <span>Delete</span> </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap4.js"></script>

    <script>
        $(document).ready(function() {
            $("#data-table").DataTable();
            // new DataTable('#data-table');
        });
    </script>
@endpush
