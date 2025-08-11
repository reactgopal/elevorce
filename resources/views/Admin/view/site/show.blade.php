@extends('Admin.layouts.app')

@section('title', 'Site Details')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Site Details</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 text-right">
            <a href="{{ route('site.index') }}" class="btn btn-light">Back</a>
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
                            <a href="{{ route('site.edit', $site->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('site.destroy', $site->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure to delete this site?')">
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
