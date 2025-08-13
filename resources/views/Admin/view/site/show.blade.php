@extends('Admin.layouts.app')

@section('title', 'Site Details')

@section('content')
    <div class="container-fluid">
        {{-- <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Site Details</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 text-right">
                <a href="{{ url('admin/site/', $employer_id) }}" class="btn btn-light">Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-dark">
                                <tbody>
                                    <tr>
                                        <th style="width: 200px;">Site Name</th>
                                        <td>{{ $site->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td>{{ $site->address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Company</th>
                                        <td>{{ $site->employer->company_name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created At</th>
                                        <td>{{ $site->created_at->format('d M, Y') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-right">
                                <a href="{{ url('admin/edit/' . $site->id . '/' . $employer_id) }}" class="btn btn-sm btn-primary"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('site.destroy', $site->id) }}" method="POST" class="d-inline-block"
                                    onsubmit="return confirm('Are you sure to delete this site?')">
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
                        <a href="{{ url('admin/site', $employer_id) }}"
                            class="d-inline-flex align-items-center text-decoration-none text-dark">
                            <span class="breadcrumb-icon me-2">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                            Site Details
                        </a>
                    </div>
                </div>
                <div class="employee-section-header d-flex align-items-center justify-content-between"
                    style="border-bottom:1px solid #e0e2e6;">
                    <div>
                        <h3>{{ $site->name }}</h3>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="{{ url('admin/site/edit/' . $site->id . '/' . $employer_id) }}"
                            class="icon-btn icon-btn-edit me-2" title="Edit">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{ route('site.destroy', $site->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Are you sure to delete this site?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="icon-btn icon-btn-delete" title="Delete">
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
                            style="background:#868e96; color:#fff; padding:2px 18px; border-radius:2px; font-size:1rem; font-weight:500;">SITE DETAILS</span>
                    </div>
                    <div class="card-body pt-4">
                        <table class="table mb-0" style="border: none;">
                            <tbody>
                                <tr class="border-bottom">
                                    <td class="fw-bold" style="width:180px; border:none;">Site Name</td>
                                    <td style="border:none;">{{ $site->name }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="fw-bold" style="border:none;">Address</td>
                                    <td style="border:none;">{{ $site->address }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="fw-bold" style="border:none;">Company</td>
                                    <td style="border:none;">{{ $site->employer->company_name ?? 'N/A' }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="fw-bold" style="border:none;">Site Cover Image</td>
                                    <td style="border:none;"><img src="{{ $site->image }}" width="100" class="mb-2"></td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="fw-bold" style="border:none;">Created At</td>
                                    <td style="border:none;">{{ $site->created_at->format('d M, Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
