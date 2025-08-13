@extends('Admin.layouts.sub_app')

@section('title', 'Add Site')

@section('content')
    <div class="container-fluid">



        <!-- Main Form Content -->
        <div class="container form-container col-lg-4 col-md-6 col-sm-10 mx-auto">
            <div class="breadcrumb-bar mb-3">
                <a href="{{ route('company.index') }}"
                    class="d-inline-flex align-items-center text-decoration-none text-dark">
                    <span class="breadcrumb-icon me-2">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    Site List
                </a>
            </div>
            <h2 class="company_title">Add Site</h2>


            <div class="form-section mt-2">
                <div class="form-section-title">User & Site Details</div>
                <div class="row">
                    <form action="{{ route('site.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="company_id" class="form-control" value="{{ $employer_id }}">

                            <div class="col-12 mb-3">
                                <label class="text-dark form-lable required">Site Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                    required>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="text-dark form-lable">Site Address</label>
                                <input type="text" name="address" class="form-control"
                                    value="{{ old('address') }}" required>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="text-dark form-lable required">Phone</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone') }}" required>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="text-dark form-lable required">Email</label>
                                <input type="text" name="email" class="form-control"
                                    value="{{ old('email') }}" required>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="text-dark form-lable required">Company Cover Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>

                        <div class="d-flex gap-2 justify-content-center mb-5">
                            <a href="{{url('admin/site/'.$employer_id)}}" class="btn btn-cancel">cancel</a>
                            <button type="submit" class="btn btn-submit">Add site</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>

    </div>
@endsection

@push('script')

@endpush
