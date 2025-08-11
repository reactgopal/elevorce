@extends('Admin.layouts.app')

@section('title', 'Site Manager List')

@section('content')
    <div class="container-fluid">
        <!-- Page Title & Breadcrumb -->
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4 class="text-dark">Site Manager List</h4>
                    <span class="ml-1 text-muted">Datatable</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Table</a></li>
                    <li class="breadcrumb-item active"><a href="#">Datatable</a></li>
                </ol>
            </div>
        </div>

        <!-- Data Table Card -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <!-- Card Header -->
                    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                        <h4 class="card-title text-dark">Site Manager List</h4>
                        {{-- <a href="{{ route('site.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle"></i> Add Employee
                        </a> --}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped text-center text-dark"
                                style="min-width: 1000px;">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Site</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Image</th>
                                        <th>Number</th>
                                        <th>Status</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($siteManagers as $key => $emp)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $emp->site->name ?? 'N/A' }}</td>
                                            <td>{{ $emp->name }}</td>
                                            <td>{{ $emp->email }}</td>
                                            <td>
                                            <img src="{{ asset($emp->image) }}" alt="Logo"
                                                 style="width: 80px; height: 80px; object-fit: cover; background: #f5f5f5;"
                                                        class="rounded-circle border shadow">
                                           </td>
                                            <td>{{ $emp->number }}</td>
                                            <td>
                                                @if ($emp->status == 1)
                                                    <span class="badge badge-success text-light">Active</span>
                                                @else
                                                    <span class="badge badge-danger text-light ">Inactive</span>
                                                @endif
                                            </td>
                                            {{-- <td>
                                                <a href="" class="btn btn-sm btn-warning" title="View"><i
                                                        class="fas fa-eye"></i></a>
                                                <a href="" class="btn btn-sm btn-primary" title="Edit"><i
                                                        class="fas fa-edit"></i></a>
                                                <form action="" method="POST" style="display:inline-block;"
                                                    onsubmit="return confirm('Delete this employee?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i
                                                            class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td> --}}
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-muted text-center">No Site Manager found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
