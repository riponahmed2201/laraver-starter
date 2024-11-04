@extends('layouts.backend.app')

@section('title', 'Roles List')

@push('css')
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap4.css">
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-cloud icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Backups</div>
            </div>
            <div class="page-title-actions">

                <button type="button"
                    onclick="event.preventDefault();
                    document.getElementById('clean-old-backup-form').submit();"
                    class="btn-shadow mr-3 btn btn-danger">
                    <i class="fas fa-trash-alt"></i> Clean Old Backup
                </button>

                <form id="clean-old-backup-form" action="{{ route('app.backups.clean') }}" method="POST" style="display: none">
                    @csrf
                    @method('DELETE')
                </form>

                <button type="button"
                    onclick="event.preventDefault();
                document.getElementById('new-backup-form').submit();"
                    class="btn-shadow mr-3 btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Create New Backup
                </button>

                <form id="new-backup-form" action="{{ route('app.backups.store') }}" method="POST" style="display: none">
                    @csrf
                </form>
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
                                    <th>File Name</th>
                                    <th class="text-center">Size</th>
                                    <th class="text-center">Created At</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($backups as $key => $backup)
                                    <tr>
                                        <td class="text-center text-muted">#{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            <code> {{ $backup['file_name'] }}</code>
                                        </td>
                                        <td class="text-center">{{ $backup['file_size'] }}</td>
                                        <td class="text-center">{{ $backup['created_at'] }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('app.backups.download', $backup['file_name']) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="fas fa-download"></i> <span>Download</span> </a>

                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="deleteData({{ $key }})">
                                                <i class="fas fa-trash"></i> <span>Delete</span> </button>

                                            <form id="delete-form-{{ $key }}" method="POST"
                                                action="{{ route('app.backups.destroy', $backup['file_name']) }}"
                                                style="display: none">
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
