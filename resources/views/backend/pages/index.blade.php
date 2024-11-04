@extends('layouts.backend.app')

@section('title', 'Pages List')

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
                <div>Pages</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.pages.create') }}" data-toggle="tooltip" title="Create page" data-placement="bottom"
                    class="btn-shadow mr-3 btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Create Page
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
                                    <th>Title</th>
                                    <th class="text-center">URL</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Last Modified</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pages as $page)
                                    <tr>
                                        <td class="text-center text-muted">#{{ $loop->iteration }}</td>
                                        <td>{{ $page->title }}</td>
                                        <td class="text-center">
                                            <a href="">{{ $page->slug }}</a>
                                        </td>
                                        <td class="text-center">
                                            @if ($page->status)
                                                <span class="badge badge-info">Active</span>
                                            @else
                                                <span class="badge badge-danger">Deactive</span>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $page->updated_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('app.pages.edit', $page->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-edit"></i> <span>Edit</span> </a>

                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="deleteData({{ $page->id }})">
                                                <i class="fas fa-trash"></i> <span>Delete</span> </button>

                                            <form id="delete-form-{{ $page->id }}" method="POST"
                                                action="{{ route('app.pages.destroy', $page->id) }}" style="display: none">
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
