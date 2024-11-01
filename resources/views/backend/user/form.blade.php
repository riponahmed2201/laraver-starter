@extends('layouts.backend.app')

@isset($user)
    @section('title', 'User Edit')
@else
@section('title', 'User Create')
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
                <i class="fas fa-user icon-gradient bg-mean-fruit"></i>
            </div>
            <div>User {{ isset($user) ? 'Edit' : 'Create' }}</div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.users.index') }}" data-toggle="tooltip" title="User List"
                class="btn-shadow mr-3 btn btn-danger">
                <i class="fas fa-arrow-circle-left"></i>
                User List
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <form method="POST" enctype="multipart/form-data"
            action="{{ isset($user) ? route('app.users.update', $user->id) : route('app.users.store') }}">

            @csrf

            @isset($user)
                @method('PUT')
            @endisset

            <div class="row">
                <div class="col-md 8">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div class="card-title">User Info</div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" required
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ $user->name ?? old('name') }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" required
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ $user->email ?? old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password"
                                    {{ !isset($user) ? 'required' : '' }}
                                    class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" id="confirm_password" name="password_confirmation"
                                    {{ !isset($user) ? 'required' : '' }}
                                    class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md 4">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div class="card-title">Select Role and Status Info</div>
                            <div class="form-group">
                                <label for="role">Select Role</label>
                                <select name="role" id="role" class="form-control select2">
                                    <option value="">----Select Role Name----</option>
                                    @foreach ($roles as $role)
                                        <option
                                            @isset($user)
                                            {{ $user->role_id == $role->id ? 'selected' : '' }}
                                            @endisset
                                            value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="avatar">Avatar</label>
                                <input type="file" id="avatar" name="avatar"
                                    data-default-file="{{ isset($user) ? $user->getFirstMediaUrl('avatar') : '' }}"
                                    {{ !isset($user) ? 'required' : '' }}
                                    class="form-control dropify @error('avatar') is-invalid @enderror">
                                @error('avatar')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="status" name="status"
                                        @isset($user) {{ $user->status == true ? 'checked' : '' }} @endisset>
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
                                @isset($user)
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
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.select2').select2();

        $('.dropify').dropify();
    });
</script>
@endpush
