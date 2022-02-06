@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Report for</div>

                <div class="panel-body">
                    <p> <strong>Package Name :</strong> {{ isset($package_name) ? $package_name : '' }}</p>
                    <p> <strong>Version Code :</strong> {{ isset($app_version_code) ? $app_version_code : '' }}</p>
                    <p> <strong>Brand : </strong> {{ isset($brand) ? $brand : '' }}</p>
                    <p> <strong>Model : </strong> {{ isset($phone_model) ? $phone_model : '' }}</p>
                    <p> <strong>Android : </strong> {{ isset($android_version) ? $android_version : '' }}</p>
                    
                    <div style="margin-top: 3rem"></div>
                    <p> <strong>Android : </strong> {{ isset($android_version) ? $android_version : '' }}</p>
                </div>

            </div>
        </div> --}}
        <div class="row">

            <div class="col-md-3">

                <h2 class="mt-0 font-weight-bold" style="margin-top: 0px">Report #{{ $id }}</h2>
                <p>Application name</p>
                <p> {{ isset($package_name) ? $package_name : '' }}</p>

                <h3 style="margin-top: 3rem; margin-bottom:3rem">Application Information</h3>

                <p> <strong>Version Code :</strong> {{ isset($app_version_code) ? $app_version_code : '' }}</p>
                <p> <strong>Version Name :</strong> {{ isset($app_version_name) ? $app_version_name : '' }}</p>
                <p> <strong>Debug :</strong> {{ isset($build_config) ? $build_config['debug'] : '' }}</p>
                <p> <strong>Build Type :</strong> {{ isset($build_config) ? $build_config['build_type'] : '' }}</p>

                <h3 style="margin-top: 3rem; margin-bottom:3rem">Device Information</h3>

                <p> <strong>Brand : </strong> {{ isset($brand) ? $brand : '' }}</p>
                <p> <strong>Model : </strong> {{ isset($phone_model) ? $phone_model : '' }}</p>
                <p> <strong>Android : </strong> {{ isset($android_version) ? $android_version : '' }}</p>

                <h3 style="margin-top: 3rem; margin-bottom:3rem">Miscellaneous Information</h3>

                <p> <strong>File Path : </strong> {{ isset($brand) ? $brand : '' }}</p>
                <p> <strong>App Start Date : </strong> {{ isset($user_app_start_date) ? $user_app_start_date : '' }}</p>
                <p> <strong>App Crash Date : </strong> {{ isset($user_crash_date) ? $user_crash_date : '' }}</p>

                <h3 style="margin-top: 3rem; margin-bottom:3rem">Full Report</h3>

                <a href="{{ url('/report/' . $report_id) }}" target="__blank">See full report</a>

                <div style="height: 3rem"></div>

            </div>

            <div class="col-md-9">
                <div class="table-responsive">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab1">Stack Trace</a></li>
                        <li><a data-toggle="tab" href="#tab2">Log Cat</a></li>
                        <li><a data-toggle="tab" href="#tab3">Tab 3</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="tab1" class="tab-pane fade in active">
                            <pre style="margin-top: 1.5rem">{{ $stack_trace }}</pre>
                        </div>
                        <div id="tab2" class="tab-pane fade">
                            <pre class="text-sm" style="margin-top: 1.5rem">{{ $logcat }}</pre>
                        </div>
                        <div id="tab3" class="tab-pane fade">
                            <h3>Tab 3</h3>
                            <p>Content for tab 3.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
