@extends('Admin.layouts.app')

@section('title', 'Edit Company')

@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Edit Company</h4>
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
                                    <form action="{{ route('company.update', $employer->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="text-dark" >Name</label>
                                                    <input type="text" class="form-control input-default" name="name"
                                                        value="{{ old('name', $employer->name) }}" required>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="text-dark" >Email</label>
                                                    <input type="text" class="form-control input-default" name="email"
                                                        value="{{ old('email', $employer->email) }}" required>
                                                </div>
                                            </div>
                                        </div>
      
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="text-dark" >Password</label>
                                                    <input type="password" class="form-control input-default" name="password">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="text-dark" >Number</label>
                                                    <input type="tel" class="form-control input-default" name="number"
                                                        value="{{ old('number', $employer->number) }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="text-dark" >Company Name</label>
                                                    <input type="text" class="form-control input-default" name="company_name"
                                                        value="{{ old('company_name', $employer->company_name) }}" required>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="text-dark" >Company Address</label>
                                                    <input type="text" class="form-control input-default" name="company_address"
                                                        value="{{ old('company_address', $employer->company_address) }}" required >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="text-dark" >Image</label>
                                                    <input type="file" class="form-control input-default" name="image" accept="image/png, image/jpeg, image/jpg, image/gif">
                                                    @if($employer->image)
                                                        <img src="{{ $employer->image }}" alt="image" width="100" class="mt-2" >
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="text-dark">Company Logo</label>
                                                    <input type="file" class="form-control input-default" name="company_logo" accept="image/png, image/jpeg, image/jpg, image/gif">
                                                    @if($employer->company_logo)
                                                        <img src="{{ $employer->company_logo }}" alt="logo" width="100" class="mt-2">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="text-dark" >Company Cover Image</label>
                                                    <input type="file" class="form-control input-default" name="company_cover_image" accept="image/png, image/jpeg, image/jpg, image/gif"0>
                                                    @if($employer->company_cover_image)
                                                        <img src="{{ $employer->company_cover_image }}" alt="cover image" width="150" class="mt-2">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <button type="submit" class="btn btn-primary">Update</button>
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
