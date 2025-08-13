@extends('Admin.layouts.app')

@section('title', 'Company Details')

@section('content')
    <div class="container-fluid">
        {{-- <div class="row page-titles mx-0">
            <div class="p-md-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h2 class="card-title text-dark">Company Details</h2>
                    <a href="{{ route('company.index') }}" class="btn btn-light">Back</a>
                </div>
            </div>
        </div> --}}

        {{-- <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-dark ">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $company->name }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 200px;">Profile Image</th>
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
                                <a href="{{ route('company.edit', $company->id) }}" class="btn btn-sm btn-primary"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('company.destroy', $company->id) }}" method="POST"
                                    class="d-inline-block" onsubmit="return confirm('Are you sure?')">
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
        </div> --}}

        <div class="row">
            <div class="col-8 m-auto">
                <div style="border-bottom:1px solid #e0e2e6;">
                    <div class="breadcrumb-bar">
                        <a href="{{ route('company.index') }}"
                            class="d-inline-flex align-items-center text-decoration-none text-dark">
                            <span class="breadcrumb-icon me-2">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                            Company Details
                        </a>
                    </div>
                </div>
                <div class="employee-section-header d-flex align-items-center justify-content-between"
                    style="border-bottom:1px solid #e0e2e6;">
                    <div>
                        <h3>{{ $company->name }}</h3>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('company.edit', $company->id) }}" class="icon-btn icon-btn-edit me-2"
                            title="Edit">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{ route('company.destroy', $company->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="icon-btn icon-btn-delete" title="Delete">
                                {{-- <i class="fas fa-trash"></i> --}}
                                <i class="fa fa-trash-alt" aria-hidden="true"></i>

                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Details Card -->
        <div class="row justify-content-center mt-4">
            <div class="col-lg-7 col-md-9">
                <div class="card border-1 position-relative" style="border-color:#d3d6db;">
                    <div class="card-header position-absolute" style="border-bottom:none; top:-20px;">
                        <span
                            style="background:#868e96; color:#fff; padding:2px 18px; border-radius:2px; font-size:1rem; font-weight:500; top:18px; left:20px;">COMPANY DETAILS</span>
                    </div>
                    <div class="card-body pt-4">
                        <table class="table mb-0" style="border: none;">
                            <tbody>
                                <tr class="border-bottom">
                                    <td class="fw-bold" style="width:180px; border:none;">Title</td>
                                    <td style="border:none;">{{ $company->company_name }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="fw-bold" style="border:none;">Company Address</td>
                                    <td style="border:none;">{{ $company->company_address }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="fw-bold" style="border:none;">Email</td>
                                    <td style="border:none;">
                                        <a href="{{ $company->email }}" target="_blank">{{ $company->email }}</a>
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="fw-bold" style="border:none;">Published on</td>
                                    <td style="border:none;">
                                        {{ \Carbon\Carbon::parse($company->created_at)->format('d/m/Y') }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="fw-bold" style="border:none;">Cover Image</td>
                                    <td style="border:none;">
                                        <img src="{{ $company->image }}" alt="Cover"
                                            style="width: 80px; height: 80px; object-fit: cover; background: #f5f5f5;">
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="fw-bold" style="border:none;">Cover logo</td>
                                    <td style="border:none;">
                                        <img src="{{ $company->company_logo }}" alt="Cover"
                                            style="width: 80px; height: 80px; object-fit: cover; background: #f5f5f5;" >
                                    </td>
                                </tr>

                                <tr class="border-bottom">
                                    <td class="fw-bold" style="border:none;">Cover Image</td>
                                    <td style="border:none;">
                                        <img src="{{ $company->company_cover_image }}" alt="Cover"
                                            style="width: 80px; height: 80px; object-fit: cover; background: #f5f5f5;">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
