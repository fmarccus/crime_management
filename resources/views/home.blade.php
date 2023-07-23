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

    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div id="crime_per_month">

                </div>
            </div>
        </div>

    </div>



</div>
@endsection

@php
$recordCountsPerMonth = DB::table('issues')->selectRaw('COUNT(*) as count')->groupBy(DB::raw('DATE_FORMAT(date, "%Y-%m")'))->pluck('count')->toArray();
@endphp
@section('scripts')
<script>
    Highcharts.chart("crime_per_month", {
        chart: {
            type: "column",
        },
        title: {
            text: "Number of Crimes Recorded Per Month",
        },
        subtitle: {},
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            crosshair: true,
        },
        yAxis: {
            title: {
                text: 'Number of Crimes', // Rename the y-axis label here
            },
        },
        tooltip: {
            formatter: function() {
                return (
                    this.point.category +
                    "</b><br/>" +
                    "Total number of crimes recorded: " +
                    this.point.y
                );
            },

        },
        plotOptions: {
            column: {
                pointWidth: 100,
                borderRadius: 1,
                borderWidth: 3,
                borderColor: "#deebf7",
                colorByPoint: true,
            },
        },
        series: [{
            name: "Months",
            data: <?php echo json_encode($recordCountsPerMonth); ?>
        }, ],
        colors: [
            "#0F172A",
            "#1E293B",
            "#334155",
            "#475569",
            "#64748B",
            "#94A3B8",
            "#CBD5E1",
            "#E2E8F0",
        ],
        credits: {
            enabled: false,
        },
    });
</script>
@endsection