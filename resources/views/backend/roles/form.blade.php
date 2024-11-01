@extends('layouts.backend.app')

@isset($role)
    @section('title', 'Roles Edit')
@else
@section('title', 'Roles Create')
@endisset

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-check icon-gradient bg-mean-fruit"></i>
            </div>
            <div>Role {{ isset($role) ? 'Edit' : 'Create' }} Role</div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.roles.index') }}" data-toggle="tooltip" title="Role List" data-placement="bottom"
                class="btn-shadow mr-3 btn btn-primary">
                <i class="fas fa-arrow-circle-left"></i>
                Role List
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <form method="POST"
                action="{{ isset($role) ? route('app.roles.update', $role->id) : route('app.roles.store') }}">

                @csrf

                @isset($role)
                    @method('PUT')
                @endisset

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Role Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ $role->name ?? old('name') }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <h4><strong>Manage permissions for role</strong></h4>
                        @error('permissions')
                            <span class="text-danger" role="alert"> <strong>{{ $message }}</strong> </span>
                        @enderror
                    </div>
                    <br>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="select-all" class="custom-control-input">
                            <label for="select-all" class="custom-control-label">Select All</label>
                        </div>
                    </div>

                    @forelse ($modules->chunk(2) as $key => $chunks)
                        <div class="form-row">
                            @foreach ($chunks as $key => $module)
                                <div class="col">
                                    <h5>Module: {{ $module->name }}</h5>
                                    @foreach ($module->permissions as $key => $permission)
                                        <div class="mb-3 ml-4">
                                            <div class="custom-control custom-checkbox mb-2">
                                                <input type="checkbox" name="permissions[]"
                                                    id="permission-{{ $permission->id }}" class="custom-control-input"
                                                    value="{{ $permission->id }}"
                                                    @isset($role)
                                                            @foreach ($role->permissions as $role_permission)
                                                                {{ $permission->id == $role_permission->id ? 'checked' : '' }}
                                                            @endforeach
                                                        @endisset>
                                                <label for="permission-{{ $permission->id }}"
                                                    class="custom-control-label">{{ $permission->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    @empty
                        <div class="row">
                            <div class="col text-center">
                                <strong>No module found.</strong>
                            </div>
                        </div>
                    @endforelse
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        @isset($role)
                            <i class="fas fa-arrow-circle-up"></i>
                            Update
                        @else
                            <i class="fas fa-plus-circle"></i>
                            Create
                        @endisset

                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    //Listen for click on toggle checkbox
    $('#select-all').click(function(event) {
        if (this.checked) {
            //Iterate each checkbox
            $(':checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $(':checkbox').each(function() {
                this.checked = false;
            });
        }
    });
</script>
@endpush
