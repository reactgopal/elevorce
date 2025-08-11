@extends('Admin.layouts.app')

@section('title', 'Edit Site')

@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Edit Site</h4>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('site.update', $site->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="row">
                                            <input type="hidden" name="company_id" class="form-control"
                                                value="{{ $employer_id }}">

                                            <div class="form-group col-md-6">
                                                <label>Site Name</label>
                                                <input type="text" name="name" required class="form-control"
                                                    value="{{ old('name', $site->name) }}">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Site Address</label>
                                                <textarea name="address" required class="form-control">{{ old('address', $site->address) }}</textarea>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Phone</label>
                                                <input type="text" name="phone" class="form-control"
                                                    value="{{ old('phone', $site->phone) }}">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Email</label>
                                                <input type="email" name="email" class="form-control"
                                                    value="{{ old('email', $site->email) }}">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Site Image</label><br>
                                                @if ($site->image)
                                                    <img src="{{ asset('images/sites/' . $site->image) }}" width="100"
                                                        class="mb-2">
                                                @endif
                                                <input type="file" name="image" class="form-control-file">
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <button type="submit" class="btn btn-primary">Update</button>
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
                placeholder: "Select Employer",
                allowClear: true
            });
        });
    </script>
@endpush
