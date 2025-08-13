@extends('Admin.layouts.sub_app')

@section('title', 'Edit Site')

@section('content')
    <div class="container-fluid">



        {{-- Breadcrumb --}}
        <div class="container form-container col-lg-4 col-md-6 col-sm-10 mx-auto">
            <div class="breadcrumb-bar mb-3">
                <a href="{{ url('admin/site/' . $employer_id) }}"
                    class="d-inline-flex align-items-center text-decoration-none text-dark">
                    <span class="breadcrumb-icon me-2">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    Site List
                </a>
            </div>

            <h2 class="company_title">Edit Site</h2>

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form --}}
            <div class="form-section mt-2">
                <div class="form-section-title">User & Site Details</div>
                <div class="row">
                    <form action="{{ route('site.update', $site->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <input type="hidden" name="company_id" class="form-control" value="{{ $employer_id }}">

                            <div class="col-12 mb-3">
                                <label class="text-dark form-label required">Site Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $site->name) }}" required>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="text-dark form-label">Site Address</label>
                                <input type="text" name="address" class="form-control"
                                    value="{{ old('address', $site->address) }}">
                            </div>

                            <div class="col-12 mb-3">
                                <label class="text-dark form-label required">Phone</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', $site->phone) }}" required>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="text-dark form-label required">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $site->email) }}" required>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="text-dark form-label">Site Image</label><br>
                                @if ($site->image)
                                    <img src="{{ $site->image }}" width="100" class="mb-2">
                                @endif
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>

                        <div class="d-flex gap-2 justify-content-center mb-5">
                               <a href="{{url('admin/site/'.$employer_id)}}" class="btn btn-cancel">cancel</a>
                            <button type="submit" class="btn btn-submit">Update site</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Footer --}}

    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select Employer",
                allowClear: true
            });
        });
    </script>
@endpush
