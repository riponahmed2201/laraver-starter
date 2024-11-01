@extends('layouts.backend.app')

@section('title', 'Users List')

@push('css')
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap4.css">
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-users icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Users List</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.users.create') }}" data-toggle="tooltip" title="Create user" data-placement="bottom"
                    class="btn-shadow mr-3 btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Create User
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
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Joined At</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-center text-muted">#{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <div class="widget-content-left">
                                                            <img width="40" class="rounded-circle"
                                                                src="{{ $user->getFirstMediaUrl('avatar') != null ? $user->getFirstMediaUrl('avatar')  : config('app.placeholder') . '160.png' }}"
                                                                alt="User Avatar">
                                                        </div>
                                                    </div>
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading">{{ $user->name }}</div>
                                                        <div class="widget-subheading opacity-7">
                                                            @if ($user->role)
                                                                <span
                                                                    class="badge badge-info">{{ $user->role->name }}</span>
                                                            @else
                                                                <span class="badge badge-info">No user found:(</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">{{ $user->name }}</td>
                                        <td class="text-center">
                                            @if ($user->status)
                                                <span class="badge badge-info">Active</span>
                                            @else
                                                <span class="badge badge-danger">Deactive</span>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $user->created_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('app.users.show', $user->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> <span>Show</span> </a>

                                            <a href="{{ route('app.users.edit', $user->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-edit"></i> <span>Edit</span> </a>

                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="deleteData({{ $user->id }})">
                                                <i class="fas fa-trash"></i> <span>Delete</span> </button>

                                            <form id="delete-form-{{ $user->id }}" method="POST"
                                                action="{{ route('app.users.destroy', $user->id) }}" style="display: none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
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
