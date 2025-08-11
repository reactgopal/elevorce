@extends('Admin.layouts.app')

@section('title', 'Add Site')

@section('content')
    <div class="container-fluid">

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Add Site</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('site.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="company_id" class="form-control"
                                                value="{{ $employer_id }}">

                                            <div class="form-group col-md-6">
                                                <label class="text-dark">Site Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ old('name') }}" required>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="text-dark">Site Address</label>
                                                <textarea name="address" class="form-control" required>{{ old('address') }}</textarea>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="text-dark">Phone</label>
                                                <input type="text" name="phone" class="form-control"
                                                    value="{{ old('phone') }}">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="text-dark">Email</label>
                                                <input type="email" name="email" class="form-control"
                                                    value="{{ old('email') }}">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="text-dark">Image</label>
                                                <input type="file" name="image" class="form-control-file">
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <a href="{{ url('admin/site/' . $employer_id) }}" class="btn btn-light">Back</a>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection


@push('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select Company",
                allowClear: true,
            });
        });
    </script>
@endpush
