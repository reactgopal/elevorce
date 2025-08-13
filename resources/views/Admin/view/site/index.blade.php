@extends('Admin.layouts.app')

@section('title', 'Site List')

@section('content')
    {{-- <div class="container-fluid">
        <!-- Page Title & Breadcrumb -->
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4 class="text-dark">Site List</h4>
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
                        <h4 class="card-title text-dark">Site List</h4>
                        <a href="{{ url('admin/create/' . $employer_id) }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle"></i> Add Site
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped text-center text-dark"
                                style="min-width: 1000px;">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Site Name</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Image</th>
                                        <th>Company Owner</th>
                                        <th>Company Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($sites as $key => $site)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $site->name }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($site->address, 50, '...') }}</td>
                                            <td>{{ $site->email }}</td>
                                            <td>{{ $site->phone }}</td>
                                            <td> <img src="{{ $site->image }}" alt="Employee Image"
                                                    style="width: 80px; height: 80px; object-fit: cover; background: #f5f5f5;"
                                                    class="rounded-circle border shadow"></td>
                                            <td>{{ $site->employer->name ?? 'N/A' }}</td>
                                            <td>{{ $site->employer->company_name ?? 'N/A' }}</td>
                                            <td>
                                                <a href="{{ url('admin/site-manager-list/' . $site->id) }}"
                                                    class="btn btn-sm btn-warning" title="View Site Manager">
                                                    <i class="fas fa-user-tie"></i>
                                                </a>
                                                <a href="{{ url('admin/employee-list/' . $site->id) }}"
                                                    class="btn btn-sm btn-info" title="View Employees">
                                                    <i class="fas fa-users"></i>
                                                </a>
                                                <a href="{{ route('site.show', $site->id) }}"
                                                    class="btn btn-sm btn-warning" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ url('admin/edit/' . $site->id . '/' . $employer_id) }}"
                                                    class="btn btn-sm btn-primary" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('site.destroy', $site->id) }}" method="POST"
                                                    style="display:inline-block;"
                                                    onsubmit="return confirm('Are you sure you want to delete this?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="company_id" value="{{ $employer_id }}">
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center text-muted">No data found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="container">
        <!-- Data Table Card -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <!-- Card Header -->
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h2 class="card-title text-dark">Site List</h2>
                        <a href="{{ url('admin/site/create/' . $employer_id) }}"
                            class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center"
                            style="width:35px; height:35px;">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped align-middle" style="min-width: 1000px;">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-dark">#</th>
                                        <th class="text-dark">Site Name</th>
                                        <th class="text-dark">Address</th>
                                        <th class="text-dark">Email</th>
                                        <th class="text-dark">Phone</th>
                                        {{-- <th class="text-dark">Image</th> --}}
                                        <th class="text-dark">Company Owner</th>
                                        <th class="text-dark">Company Name</th>
                                        <th class="text-dark">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($sites as $key => $site)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $site->name }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($site->address, 50, '...') }}</td>
                                            <td>{{ $site->email }}</td>
                                            <td>{{ $site->phone }}</td>
                                            {{-- <td>
                                                <img src="{{ $site->image }}" alt="Site Image"
                                                    style="width: 40px; height: 40px; object-fit: cover; background: #f5f5f5;"
                                                    class="rounded-circle border">
                                            </td> --}}
                                            <td>{{ $site->employer->name ?? 'N/A' }}</td>
                                            <td>{{ $site->employer->company_name ?? 'N/A' }}</td>
                                            <td>
                                                <a href="{{ url('admin/site-manager-list/' . $site->id) }}"
                                                    class="text-secondary me-2" title="View Site Manager">
                                                    <i class="fas fa-user-tie"></i>
                                                </a>
                                                <a href="{{ url('admin/employee-list/' . $site->id) }}"
                                                    class="text-secondary me-2" title="View Employees">
                                                    <i class="fas fa-users"></i>
                                                </a>
                                                <a href="{{ url('admin/site/show', $site->id.'/'.$employer_id) }}" class="text-secondary me-2"
                                                    title="View">
                                                    <i class="fa-solid fa-circle-arrow-right text-secondary"></i>
                                                </a>
                                                <a href="{{ url('admin/site/edit/' . $site->id . '/' . $employer_id) }}"
                                                    class="text-secondary me-2" title="Edit">
                                                    <i class="fas fa-pencil text-secondary"></i>
                                                </a>
                                                <form action="{{ route('site.destroy', $site->id) }}" method="POST"
                                                    style="display:inline-block;"
                                                    onsubmit="return confirm('Are you sure you want to delete this?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="company_id" value="{{ $employer_id }}">
                                                    <button type="submit" class="btn btn-link text-danger p-0 m-0"
                                                        title="Delete" style="vertical-align: middle;">
                                                        <i class="fas fa-trash-alt text-secondary"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center text-muted">No data found.</td>
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
