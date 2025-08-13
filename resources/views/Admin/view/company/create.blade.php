@extends('Admin.layouts.sub_app')

@section('title', 'Add Company')

@section('content')

    <div class="container-fluid">
        <!-- Main Form Content -->
        <div class="container form-container col-lg-4 col-md-6 col-sm-10 mx-auto">
            <!-- Breadcrumb -->
            <div class="breadcrumb-bar mb-3">
                <a href="{{ route('company.index') }}"
                    class="d-inline-flex align-items-center text-decoration-none text-dark">
                    <span class="breadcrumb-icon me-2">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    Company List
                </a>
            </div>

            {{-- <h2 class="mb-4">Add company</h2> --}}

            {{-- <div class="company_title"> --}}
            <h2 class="company_title">Add Company</h2>
            {{-- </div> --}}

            <!-- Company Announcement Details -->

            <div class="form-section mt-2">
                <div class="form-section-title">User & Company Details</div>
                <form action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="name" class="text-dark form-label required">Name</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="email" class="form-label required">Email</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="password" class="form-label required">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="number" class="form-label required">Number</label>
                            <input type="text" class="form-control" name="number" id="number" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="companyName" class="form-label required">Company Name</label>
                            <input type="text" class="form-control" name="company_name" id="companyName" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="companyAddress" class="form-label required">Company Address</label>
                            <input type="text" class="form-control" name="company_address" id="companyAddress" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="imageUpload" class="form-label required">Image</label>
                            <input type="file" class="form-control" name="image" id="imageUpload">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="companyLogo" class="form-label required">Company Logo</label>
                            <input type="file" class="form-control" name="company_logo" id="companyLogo">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="companyCoverImage" class="form-label required">Company Cover Image</label>
                            <input type="file" class="form-control" name="company_cover_image" id="companyCoverImage">
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mb-5">
                        <button type="button" class="btn btn-cancel">cancel</button>
                        <button type="submit" class="btn btn-submit">Add company</button>
                    </div>
                </form>
            </div>
            <!-- Action Buttons -->

        </div>

        <!-- Footer -->
        {{-- <div class="container footer-bar col-6">
            <div class="row align-items-center">

                <!-- Social Icons Left -->
                <div class="col-lg-6 col-md-6 col-sm-12 d-flex footer-social gap-3">
                    <a href="https://www.linkedin.com" target="_blank" class="text-dark fs-5">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="https://www.facebook.com" target="_blank" class="text-dark fs-5">
                        <i class="fab fa-facebook"></i>
                    </a>
                </div>

                <!-- Logo Right -->
                <div class="footer-logo col-lg-6 col-md-6 col-sm-12 text-end">
                    <img src="{{ asset('assets/images/blue_bg_logo.svg') }}" alt="Footer Logo">
                </div>

            </div>

        </div> --}}

    </div>

@endsection
