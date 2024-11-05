@extends('layouts.backend.app')

@section('title', 'User Show')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>User Show</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.users.edit', $user->id) }}" data-toggle="tooltip" title="User Edit"
                    data-placement="bottom" class="btn-shadow mr-3 btn btn-primary">
                    <i class="fas fa-edit"></i> User Edit
                </a>
                <a href="{{ route('app.users.index') }}" data-toggle="tooltip" title="User List" data-placement="bottom"
                    class="btn-shadow mr-3 btn btn-danger">
                    <i class="fas fa-arrow-circle-left fa-w-20"></i>
                    Back to list
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="main-card card mb-3">
                <img src="{{ $user->getFirstMediaUrl('avatar') }}" class="img-fluid img-thumbnail" alt="avatar">
            </div>
        </div>
        <div class="col-md-10">
            <div class="main-card mb-3 card">
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <tbody>
                            <tr>
                                <th scope="row">Name:</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Email:</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Role:</th>
                                <td>
                                    @if ($user->role)
                                        <span class="badge badge-info">{{ $user->role->name }}</span>
                                    @else
                                        <span class="badge badge-info">No user found:(</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Status:</th>
                                <td>
                                    @if ($user->status)
                                        <span class="badge badge-info">Active</span>
                                    @else
                                        <span class="badge badge-danger">Deactive</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Last Modified At:</th>
                                <td>{{ $user->updated_at->diffForHumans() }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Joined At:</th>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $("#data-table").DataTable();
        });
    </script>
@endpush
