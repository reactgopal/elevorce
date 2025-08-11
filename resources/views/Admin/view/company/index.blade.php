@extends('Admin.layouts.app')

@section('title', 'Company List')

@section('content')
    <div class="container">
        <!-- Data Table Card -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <!-- Card Header -->
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h2 class="card-title text-dark">Company List</h2>
                        <a href="{{ route('company.create') }}"
                            class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center"
                            style="width:35px; height:35px;">
                            <i class="fas fa-plus"></i>
                        </a>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped align-middle" style="min-width: 1000px;">
                                <thead class="table-light ">
                                    <tr>
                                        <th class="text-dark">#</th>
                                        <th class="text-dark">Name</th>
                                        <th class="text-dark">Email</th>
                                        <th class="text-dark">Number</th>
                                        <th class="text-dark">Company Name</th>
                                        <th class="text-dark">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($data as $key => $i)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $i->name }}</td>
                                            <td>{{ $i->email }}</td>
                                            <td>{{ $i->number }}</td>
                                            <td>{{ $i->company_name }}</td>

                                            <td>
                                                <a href="{{ url('admin/site/' . $i->id) }}" class="text-secondary me-2"
                                                    title="View Site">
                                                    <i class="fas fa-map-marker-alt text-secondary"></i>
                                                </a>
                                                <a href="{{ route('company.show', $i->id) }}" class="text-info me-2"
                                                    title="View">

                                                    <i class="fa-solid fa-circle-arrow-right text-secondary"></i>
                                                </a>
                                                <a href="{{ route('company.edit', $i->id) }}" class="text-primary me-2"
                                                    title="Edit">
                                                    <i class="fas fa-pencil text-secondary"></i>
                                                </a>
                                                <form action="{{ route('company.destroy', $i->id) }}" method="POST"
                                                    style="display:inline-block;"
                                                    onsubmit="return confirm('Are you sure you want to delete this?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger  p-0 m-0"
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
