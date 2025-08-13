@extends('Admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="welcome-section">
                    <h1 class="fw-bold">Good morning, gopal</h1>
                    <p>Tuesday, 12 August 2025</p>
                </div>
                {{-- <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Total Company</div>
                            <div class="stat-digit">{{ $data['company'] }}</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success w-85" role="progressbar" aria-valuenow="85"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div> --}}
            </div>
            {{-- <div class="col">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Total Sites</div>
                            <div class="stat-digit">{{ $data['sites'] }}</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-primary w-75" role="progressbar" aria-valuenow="78"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="row">
            <div class="col">
                <div class="dashboard-section">
                    <div class="dashboard-container">
                        <div>
                            <h3 class="dashboard-heading">Company highlights</h3>
                            <p class="dashboard-subtitle">Here are some highlights of the companies you manage:</p>
                        </div>
                        <div class="company-highlights-buttons">
                            <a href="" class="company-box-padding company-box">
                                <i class="fa fa-building"></i>
                                <div>
                                    <span class="">{{ $data['user'] }}</span>
                                    <span>Total Companies</span>
                                </div>
                            </a>
                            <a href="" class="company-box-padding company-box ">
                                <i class="fa fa-building"></i>
                                <div>
                                    <span class="">{{ $data['user'] }}</span>
                                    <span>Total Companies</span>
                                </div>
                            </a>
                            <a href="" class="company-box-padding company-box ">
                                <i class="fa fa-building"></i>
                                <div>
                                    <span class="">{{ $data['user'] }}</span>
                                    <span>Total Companies</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
