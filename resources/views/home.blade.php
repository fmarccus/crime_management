@extends('layouts.app')

@section('content')

<div class="row">

    <h3 class="mb-3">Dashboard</h3>

    <div class="col-sm-6 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">System Users/Administrators</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle" data-feather="user-check"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">{{\App\Models\User::where('user_type',0)->count()}}</h1>
                <div class="mb-0">
                    <!-- <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                    <span class="text-muted">Since last week</span> -->
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-sm-6 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Police Officers</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle" data-feather="users"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">{{\App\Models\User::where('user_type',1)->count()}}</h1>
                <div class="mb-0">
                    <!-- <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                    <span class="text-muted">Since last week</span> -->
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-3 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Total Cases</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle" data-feather="briefcase"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">{{\App\Models\Issue::count()}}</h1>
                <div class="mb-0">
                    <!-- <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                    <span class="text-muted">Since last week</span> -->
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-3 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Open Cases</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle" data-feather="briefcase"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">{{\App\Models\Issue::where('status','Open')->count()}}</h1>
                <div class="mb-0">
                    <!-- <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                    <span class="text-muted">Since last week</span> -->
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-3 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Processing</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle" data-feather="briefcase"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">{{\App\Models\Issue::where('status','Processing')->count()}}</h1>
                <div class="mb-0">
                    <!-- <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                    <span class="text-muted">Since last week</span> -->
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-3 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Completed Cases</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle" data-feather="briefcase"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">{{\App\Models\Issue::where('status','Completed')->count()}}</h1>
                <div class="mb-0">
                    <!-- <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                    <span class="text-muted">Since last week</span> -->
                </div>
            </div>
        </div>
    </div>



</div>
@endsection