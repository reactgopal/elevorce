@extends('Admin.layouts.app')

@section('title', 'Employee List')

@section('content')
    <div class="container">
        <!-- Page Title & Breadcrumb -->
        <div class="row">
            <div class="col-12">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h2 class="card-title text-dark">Employee List</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped align-middle" style="min-width: 1000px;">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-dark">#</th>
                                    <th class="text-dark">Site</th>
                                    <th class="text-dark">Name</th>
                                    <th class="text-dark">Email</th>
                                    <th class="text-dark">Image</th>
                                    <th class="text-dark">Number</th>
                                    <th class="text-dark">Status</th>
                                    <th class="text-dark">Visa</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($employees as $key => $emp)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $emp->site->name ?? 'N/A' }}</td>
                                        <td>{{ $emp->name }}</td>
                                        <td>{{ $emp->email }}</td>
                                        <td>
                                            <img src="{{ $emp->image }}" alt="Employee Image"
                                                style="width:80px; height:80px; object-fit:cover; background:#f5f5f5; border:1px solid #ddd;">
                                        </td>
                                        <td>{{ $emp->number }}</td>
                                        <td>
                                            @if ($emp->status == 1)
                                                <span
                                                    style="background:#28a745; color:#fff; padding:4px 10px; border-radius:4px; font-size:0.85rem;">Active</span>
                                            @else
                                                <span
                                                    style="background:#28a745; color:#fff; padding:4px 10px; border-radius:4px; font-size:0.85rem;">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            {{-- <button class="btn btn-sm btn-primary"  data-toggle="modal"
                                                data-target="#visaModal{{ $emp->id }}">
                                                <i class="fas fa-eye"></i> View
                                            </button> --}}
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#visaModal{{ $emp->id }}">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                            <div class="modal fade" id="visaModal{{ $emp->id }}" tabindex="-1"
                                                aria-labelledby="visaModalLabel{{ $emp->id }}" aria-hidden="true">

                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content shadow-lg border-0 rounded">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title" id="visaModalLabel{{ $emp->id }}">
                                                                <i class="fas fa-passport me-2"></i> Visa Details -
                                                                {{ $emp->name }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>

                                                        <!-- Modal Body -->
                                                        <div class="modal-body bg-light text-dark">
                                                            @if ($emp->visa_details)
                                                                @php
                                                                    $visa = $emp->visa_details;
                                                                    $status = strtolower($visa->visa_status);
                                                                    $badgeClass = match ($status) {
                                                                        'active' => 'badge-success',
                                                                        'pending' => 'badge-warning',
                                                                        'expired' => 'badge-danger',
                                                                        'rejected' => 'badge-secondary',
                                                                        default => 'badge-info',
                                                                    };
                                                                @endphp

                                                                <div class="table-responsive">
                                                                    <table
                                                                        class="table table-bordered table-sm bg-white text-dark align-left">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th class="w-25">Visa Status</th>
                                                                                <td>
                                                                                    <span
                                                                                        style=" color:#262c34 !importnant; padding:4px 10px; border-radius:4px; font-size:0.85rem;"
                                                                                        class="{{ $badgeClass }} p-2">
                                                                                        {{ ucfirst($visa->visa_status) }}
                                                                                    </span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Visa Number</th>
                                                                                <td class="text-truncate"
                                                                                    title="{{ $visa->visa_number ?? 'N/A' }}">
                                                                                    {{ $visa->visa_number ?? 'N/A' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Issue Date</th>
                                                                                <td>{{ $visa->visa_issue_date ?? 'N/A' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Expiry Date</th>
                                                                                <td>{{ $visa->visa_expiry_date ?? 'N/A' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Share Code</th>
                                                                                <td class="text-truncate"
                                                                                    title="{{ $visa->share_code ?? 'N/A' }}">
                                                                                    {{ $visa->share_code ?? 'N/A' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Country</th>
                                                                                <td>{{ $visa->country ?? 'N/A' }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Document</th>
                                                                                <td>
                                                                                    @if ($visa->visa_document)
                                                                                        <a href="{{ $visa->visa_document }}"
                                                                                            target="_blank"
                                                                                            class="btn btn-sm btn-outline-primary">
                                                                                            <i class="fas fa-file-pdf"></i>
                                                                                            View Document
                                                                                        </a>
                                                                                    @else
                                                                                        <span class="text-muted">No document
                                                                                            uploaded</span>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            @else
                                                                <div class="alert alert-info mb-0">
                                                                    <i class="fas fa-info-circle"></i> No visa details
                                                                    available.
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <!-- Modal Footer -->
                                                        {{-- <div class="modal-footer bg-white">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="fas fa-times-circle me-1"></i> Close
                                                            </button>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Visa Modal -->
                                            {{-- <div class="modal fade" id="visaModal{{ $emp->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="visaModalLabel{{ $emp->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                    <div class="modal-content shadow-lg border-0 rounded">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title text-light"
                                                                id="visaModalLabel{{ $emp->id }}">
                                                                <i class="fas fa-passport mr-2"></i> Visa
                                                                Details -
                                                                {{ $emp->name }}
                                                            </h5>
                                                            <button type="button" class="close text-white"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <!-- Modal Body -->
                                                        <div class="modal-body bg-light text-dark">
                                                            @if ($emp->visa_details)
                                                                @php
                                                                    $visa = $emp->visa_details;
                                                                    $status = strtolower($visa->visa_status);
                                                                    $badgeClass = match ($status) {
                                                                        'active' => 'badge-success',
                                                                        'pending' => 'badge-warning',
                                                                        'expired' => 'badge-danger',
                                                                        'rejected' => 'badge-secondary',
                                                                        default => 'badge-info',
                                                                    };
                                                                @endphp
                                                                <div class="table-responsive">
                                                                    <table
                                                                        class="table table-bordered table-sm bg-white text-dark align-left">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th class="w-25">Visa Status
                                                                                </th>
                                                                                <td><span
                                                                                        class="badge {{ $badgeClass }} text-light p-2">{{ ucfirst($visa->visa_status) }}</span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Visa Number</th>
                                                                                <td class="text-truncate"
                                                                                    title="{{ $visa->visa_number ?? 'N/A' }}">
                                                                                    {{ $visa->visa_number ?? 'N/A' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Issue Date</th>
                                                                                <td>{{ $visa->visa_issue_date ?? 'N/A' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Expiry Date</th>
                                                                                <td>{{ $visa->visa_expiry_date ?? 'N/A' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Share Code</th>
                                                                                <td class="text-truncate"
                                                                                    title="{{ $visa->share_code ?? 'N/A' }}">
                                                                                    {{ $visa->share_code ?? 'N/A' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Country</th>
                                                                                <td>{{ $visa->country ?? 'N/A' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Document</th>
                                                                                <td>
                                                                                    @if ($visa->visa_document)
                                                                                        <a href="{{ $visa->visa_document }}"
                                                                                            target="_blank"
                                                                                            class="btn btn-sm btn-outline-primary">
                                                                                            <i class="fas fa-file-pdf"></i>
                                                                                            View Document
                                                                                        </a>
                                                                                    @else
                                                                                        <span class="text-muted">No
                                                                                            document
                                                                                            uploaded</span>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            @else
                                                                <div class="alert alert-info mb-0">
                                                                    <i class="fas fa-info-circle"></i> No visa
                                                                    details
                                                                    available.
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <!-- Modal Footer -->
                                                        <div class="modal-footer bg-white">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">
                                                                <i class="fas fa-times-circle mr-1"></i> Close
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
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
                                        <td colspan="10" class="text-muted text-center">No employees found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
                {{-- <div class="welcome-text">
                    <h4 class="text-dark">Employee List</h4>
                    <span class="ml-1 text-muted">Datatable</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Table</a></li>
                    <li class="breadcrumb-item active"><a href="#">Datatable</a></li>
                </ol>
            </div> --}}
            </div>
        </div>

        <!-- Data Table Card -->
        {{-- <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <!-- Card Header -->
                    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                        <h4 class="card-title text-dark">Employee List</h4>

                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped  text-center text-dark"
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
                                        <th>Visa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($employees as $key => $emp)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $emp->site->name ?? 'N/A' }}</td>
                                            <td>{{ $emp->name }}</td>
                                            <td>{{ $emp->email }}</td>
                                            <td>
                                                <img src="{{ $emp->image }}" alt="Employee Image"
                                                    style="width: 80px; height: 80px; object-fit: cover; background: #f5f5f5;"
                                                    class="rounded-circle border shadow">
                                            </td>
                                            <td>{{ $emp->number }}</td>
                                            <td>
                                                @if ($emp->status == 1)
                                                    <span class="badge badge-success text-light">Active</span>
                                                @else
                                                    <span class="badge badge-danger text-light">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" data-toggle="modal"
                                                    data-target="#visaModal{{ $emp->id }}">
                                                    <i class="fas fa-eye"></i> View
                                                </button>

                                                <div class="modal fade" id="visaModal{{ $emp->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="visaModalLabel{{ $emp->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered"
                                                        role="document">
                                                        <div class="modal-content shadow-lg border-0 rounded">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header bg-primary text-white">
                                                                <h5 class="modal-title text-light"
                                                                    id="visaModalLabel{{ $emp->id }}">
                                                                    <i class="fas fa-passport mr-2"></i> Visa
                                                                    Details -
                                                                    {{ $emp->name }}
                                                                </h5>
                                                                <button type="button" class="close text-white"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <!-- Modal Body -->
                                                            <div class="modal-body bg-light text-dark">
                                                                @if ($emp->visa_details)
                                                                    @php
                                                                        $visa = $emp->visa_details;
                                                                        $status = strtolower($visa->visa_status);
                                                                        $badgeClass = match ($status) {
                                                                            'active' => 'badge-success',
                                                                            'pending' => 'badge-warning',
                                                                            'expired' => 'badge-danger',
                                                                            'rejected' => 'badge-secondary',
                                                                            default => 'badge-info',
                                                                        };
                                                                    @endphp
                                                                    <div class="table-responsive">
                                                                        <table
                                                                            class="table table-bordered table-sm bg-white text-dark align-left">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <th class="w-25">Visa Status
                                                                                    </th>
                                                                                    <td><span
                                                                                            class="badge {{ $badgeClass }} text-light p-2">{{ ucfirst($visa->visa_status) }}</span>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Visa Number</th>
                                                                                    <td class="text-truncate"
                                                                                        title="{{ $visa->visa_number ?? 'N/A' }}">
                                                                                        {{ $visa->visa_number ?? 'N/A' }}
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Issue Date</th>
                                                                                    <td>{{ $visa->visa_issue_date ?? 'N/A' }}
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Expiry Date</th>
                                                                                    <td>{{ $visa->visa_expiry_date ?? 'N/A' }}
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Share Code</th>
                                                                                    <td class="text-truncate"
                                                                                        title="{{ $visa->share_code ?? 'N/A' }}">
                                                                                        {{ $visa->share_code ?? 'N/A' }}
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Country</th>
                                                                                    <td>{{ $visa->country ?? 'N/A' }}
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Document</th>
                                                                                    <td>
                                                                                        @if ($visa->visa_document)
                                                                                            <a href="{{ $visa->visa_document }}"
                                                                                                target="_blank"
                                                                                                class="btn btn-sm btn-outline-primary">
                                                                                                <i
                                                                                                    class="fas fa-file-pdf"></i>
                                                                                                View Document
                                                                                            </a>
                                                                                        @else
                                                                                            <span class="text-muted">No
                                                                                                document
                                                                                                uploaded</span>
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                @else
                                                                    <div class="alert alert-info mb-0">
                                                                        <i class="fas fa-info-circle"></i> No visa
                                                                        details
                                                                        available.
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <!-- Modal Footer -->
                                                            <div class="modal-footer bg-white">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">
                                                                    <i class="fas fa-times-circle mr-1"></i> Close
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>


                                            <td>
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
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-muted text-center">No employees found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
