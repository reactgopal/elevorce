@extends('Admin.layouts.app')

@section('title', 'Company Details')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Company Details</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 text-right">
            <a href="{{ route('company.index') }}" class="btn btn-light">Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-dark ">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $company->name}}</td>
                                </tr>
                                <tr>
                                    <th  style="width: 200px;">Profile Image</th>
                                    <td>
                                        <img src="{{ $company->image }}" alt="Image"
                                            style="width: 80px; height: 80px; object-fit: cover; background: #f5f5f5;"
                                                        class="rounded-circle border shadow">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Company Name</th>
                                    <td>{{ $company->company_name }}</td>
                                </tr>
                                <tr>
                                    <th>Company Logo</th>
                                    <td>
                                        <img src="{{ $company->company_logo }}" alt="Logo"
                                           style="width: 80px; height: 80px; object-fit: cover; background: #f5f5f5;"
                                                        class="rounded-circle border shadow">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Cover Image</th>
                                    <td>
                                        <img src="{{ $company->company_cover_image }}" alt="Cover"
                                            style="width: 80px; height: 80px; object-fit: cover; background: #f5f5f5;"
                                                        class="rounded-circle border shadow">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $company->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone Number</th>
                                    <td>{{ $company->number }}</td>
                                </tr>
                                <tr>
                                    <th>Company Address</th>
                                    <td>{{ $company->company_address }}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $company->created_at->format('d M, Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-right">
                            <a href="{{ route('company.edit', $company->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                            <form action="{{ route('company.destroy', $company->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                 <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
