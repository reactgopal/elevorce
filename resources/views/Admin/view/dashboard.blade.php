@extends('Admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
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
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Total Sites</div>
                            <div class="stat-digit">{{ $data['sites'] }}</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-primary w-75" role="progressbar"
                            aria-valuenow="78"
                            aria-valuemin="0"
                             aria-valuemax="100"
                             ></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /# card -->
        </div>
        <!-- /# column -->
    </div>

    </div>
@endsection
