@extends('Admin.layouts.app')

@section('title', 'Add Company')

@section('content')

<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4> Add Company</h4>
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
                                <form action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="text-dark" for="name">Name</label>
                                                <input type="text" class="form-control input-default" name="name"
                                                    value="{{ old('name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label  class="text-dark" for="email">Email</label>
                                                <input type="email" class="form-control input-default" name="email"
                                                    value="{{ old('email') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="text-dark" for="password">Password</label>
                                                <input type="password" class="form-control input-default"
                                                    name="password" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="text-dark" for="number">Number</label>
                                                <input type="tel" class="form-control input-default" name="number"
                                                    value="{{ old('number') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label  class="text-dark" for="company_name">Company Name</label>
                                                <input type="text" class="form-control input-default"
                                                    name="company_name" value="{{ old('company_name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="text-dark"  for="company_address">Company Address</label>
                                                <input type="text" class="form-control input-default"
                                                    name="company_address" value="{{ old('company_address') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="text-dark" for="image">Image</label>
                                                <input type="file" class="form-control input-default" name="image" accept="image/png, image/jpeg, image/jpg, image/gif" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="text-dark" for="company_logo">Company Logo</label>
                                                <input type="file" class="form-control input-default"
                                                    name="company_logo" accept="image/png, image/jpeg, image/jpg, image/gif" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="text-dark" for="company_cover_image">Company Cover Image</label>
                                                <input type="file" class="form-control input-default"
                                                    name="company_cover_image" accept="image/png, image/jpeg, image/jpg, image/gif"  required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="{{ route('company.index') }}" class="btn btn-light">Back</a>
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
