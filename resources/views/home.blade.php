@extends('layouts.app')

@section('content')

<div class="row">

    <h3 class="mb-3">Dashboard</h3>
    <div class="@if(auth()->user()->user_type ==3) col-sm-9 @else col-sm-9  @endif mb-3">
        <div class="row">
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
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Investigators</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="users"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">{{\App\Models\User::where('user_type', 2)->count()}}</h1>
                        <div class="mb-0">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Complainants</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="users"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">{{\App\Models\User::where('user_type',3)->count()}}</h1>
                        <div class="mb-0">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div id="issueStatusPie">

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div id="issueSeverity">

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
            <div class="col-sm-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div id="crime_per_month">

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div id="barangayFrequency">

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div id="crime_frequency">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(auth()->user()->user_type != 3)
    <div class="col-sm-3 mb-3">

        <div class="card mb-3">
            @php
            $incidents = \App\Models\Issue::limit('5')->where('severity', 'Critical')->orderByDesc('created_at')->get();
            @endphp
            <div class="card-body">
                <h4 class="card-title">Recent Incident Reports (<span class="badge rounded-pill text-bg-danger">Critical</span>)</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Action</th>
                                <th scope="col">Crime</th>

                                <th scope="col">Complainant</th>
                                <th scope="col">Date Created</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($incidents as $incident)
                            <tr>
                                <td>
                                    <a class="btn btn-link me-3" href="{{route('issues.edit', $incident->id)}}">View</a>

                                </td>
                                <td>{{$incident->type}}</td>

                                <td>{{$incident->getFullNameComplainant()}}</td>
                                <td>{{$incident->created_at->format('M d, Y h:i A')}}</td>



                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="card mb-3">
            @php
            $incidents = \App\Models\Issue::limit('5')->where('severity', 'Severe')->orderByDesc('created_at')->get();
            @endphp
            <div class="card-body">
                <h4 class="card-title">Recent Incident Reports (<span class="badge rounded-pill text-bg-warning">Severe</span>)</h4>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Action</th>
                                <th scope="col">Crime</th>
                                <th scope="col">Complainant</th>
                                <th scope="col">Date Created</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($incidents as $incident)
                            <tr>
                                <td>
                                    <a class="btn btn-link me-3" href="{{route('issues.edit', $incident->id)}}">View</a>

                                </td>
                                <td>{{$incident->type}}</td>

                                <td>{{$incident->getFullNameComplainant()}}</td>
                                <td>{{$incident->created_at->format('M d, Y h:i A')}}</td>



                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    @endif



</div>
@endsection

@php
$recordCountsPerMonth = DB::table('issues')->selectRaw('COUNT(*) as count')->groupBy(DB::raw('DATE_FORMAT(date, "%Y-%m")'))->pluck('count')->toArray();
$crimeNames = DB::table('issues')->distinct()->pluck('type')->toArray();
$crimeFrequency = DB::table('issues')->selectRaw('type, COUNT(*) as count')->groupBy('type')->get()->pluck('count')->toArray();
$count = DB::table('issues')->selectRaw('status, COUNT(*) as count')->groupBy('status')->get()->pluck('count')->toArray();
$barangayFrequency = DB::table('issues')->selectRaw('area, COUNT(*) as count')->groupBy('area')->get()->pluck('count')->toArray();
$barangayNames = DB::table('issues')->selectRaw('area, COUNT(*) as count')->groupBy('area')->get()->pluck('area')->toArray();
$issueSeverity = DB::table('issues')->selectRaw('severity, COUNT(*) as count')->groupBy('severity')->get()->pluck('count')->toArray();


@endphp
@section('scripts')
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
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
            "#3d85c6",
            "#3677b2",
            "#306a9e",
            "#2a5d8a",
            "#244f76",
            "#1e4263",
            "#18354f",
            "#12273b",
            "#0c1a27",
            "#060d13",
            "#000000",
        ],
        credits: {
            enabled: false,
        },
    });
</script>
<script>
    Highcharts.chart("crime_frequency", {
        chart: {
            type: "bar",
        },
        title: {
            text: "Number of Recorded Crimes",
        },
        subtitle: {},
        xAxis: {
            categories: <?php echo json_encode($crimeNames); ?>,
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
            name: "Crimes",
            data: <?php echo json_encode($crimeFrequency); ?>,
        }],
        colors: [
            "#3d85c6",
            "#3677b2",
            "#306a9e",
            "#2a5d8a",
            "#244f76",
            "#1e4263",
            "#18354f",
            "#12273b",
            "#0c1a27",
            "#060d13",
            "#000000",
        ],
        credits: {
            enabled: false,
        },
        legend: {
            enabled: true, // Show the legend
        },
    });
</script>
<script>
    const colors = Highcharts.getOptions().colors.map((c, i) =>
        // Start out with a darkened base color (negative brighten), and end
        // up with a much brighter color
        Highcharts.color(Highcharts.getOptions().colors[0])
        .brighten((i - 3) / 7)
        .get()
    );
    Highcharts.chart('issueStatusPie', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Incident Reports Completion Status',
            align: 'center'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                colors,
                borderRadius: 5,
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                    distance: -50,
                    filter: {
                        property: 'percentage',
                        operator: '>',
                        value: 4
                    }
                }
            }
        },
        series: [{
            name: 'Share',
            data: [{
                    name: 'Open',
                    y: <?php echo json_encode($count[1]); ?>
                },
                {
                    name: 'Processing',
                    y: <?php echo json_encode($count[2]); ?>
                },
                {
                    name: 'Completed',
                    y: <?php echo json_encode($count[0]); ?>
                }
            ]
        }],
        credits: {
            enabled: false,
        },
    });
</script>
<script>
    Highcharts.chart('issueSeverity', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Crime Severity',
            align: 'center'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                borderRadius: 5,
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                    distance: -50,
                    filter: {
                        property: 'percentage',
                        operator: '>',
                        value: 4
                    }
                }
            }
        },
        series: [{
            name: 'Share',
            data: [{
                    name: 'Normal',
                    y: <?php echo json_encode($issueSeverity[1]); ?>
                },
                {
                    name: 'Severe',
                    y: <?php echo json_encode($issueSeverity[2]); ?>
                },
                {
                    name: 'Critical',
                    y: <?php echo json_encode($issueSeverity[0]); ?>
                }
            ]
        }],
        colors: [
            "#3b7ddd",
            "#fcb92c",
            "#dc3545",
        ],
        credits: {
            enabled: false,
        },
    });
</script>
<script>
    Highcharts.chart("barangayFrequency", {
        chart: {
            type: "bar",
        },
        title: {
            text: "Incident Reports in Different Barangays",
        },
        subtitle: {},
        xAxis: {
            categories: <?php echo json_encode($barangayNames); ?>,
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
            name: "Crimes",
            data: <?php echo json_encode($barangayFrequency); ?>,
        }],
        colors: [
            "#3d85c6",
            "#3677b2",
            "#306a9e",
            "#2a5d8a",
            "#244f76",
            "#1e4263",
            "#18354f",
            "#12273b",
            "#0c1a27",
            "#060d13",
            "#000000",
        ],
        credits: {
            enabled: false,
        },
        legend: {
            enabled: true, // Show the legend
        },
    });
</script>
@endsection