@php
$all = App\Models\User::count();
$officers = App\Models\User::where('user_type', 1)->count();
$investigators = App\Models\User::where('user_type', 2)->count();
$complainants = App\Models\User::where('user_type', 3)->count();
$issues = App\Models\Issue::count();

$user_type = auth()->user()->user_type;

$issuesAssignedOfficer = App\Models\Issue::where('user_id', auth()->user()->id)->count();
$issuesAssignedInvestigator = App\Models\Issue::where('investigator_id', auth()->user()->id)->count();
$issuesAssignedComplainant = App\Models\Issue::where('complainant_id', auth()->user()->id)->count();



$suspects = App\Models\Issue::with(['persons' => function ($query) {
$query->where('person_type', 'suspect');
}])
->where(getUserType(), getUserId())
->get()
->pluck('persons')
->flatten()->count();

$witnesses = App\Models\Issue::with(['persons' => function ($query) {
$query->where('person_type', 'witness');
}])
->where(getUserType(), getUserId())
->get()
->pluck('persons')
->flatten()->count();



function getUserId()
{
$id = auth()->user()->id;
return $id;
}

function getUserType()
{
$type = auth()->user()->user_type;
if ($type == 1) {
$var = 'user_id';
} elseif ($type == 2) {
$var = 'investigator_id';
} elseif($type == 0) {
$var = '';
}
return $var;
}

@endphp
<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="/home">
            <span class="align-middle">Crime Reporting</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Control Panel
            </li>

            <li class="sidebar-item {{ (request()->is('home')) ? 'active':'' }}">
                <a class="sidebar-link" href="/home">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item {{ Route::currentRouteName() == 'profile.edit' ? 'active':'' }}">
                <a class="sidebar-link" href="{{route('profile.edit')}}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="/logs">
                    <i class="align-middle" data-feather="clock"></i> <span class="align-middle">Activity Logs</span>
                </a>
            </li>
            @if(Auth::user()->user_type == 0)
            <li class="sidebar-header">
                User Management
            </li>
            <li class="sidebar-item {{ (request()->is('users/index')) || (request()->is('users/edit/*')) ? 'active':'' }}">
                <a class="sidebar-link" href="{{route('users.index')}}">
                    <i class="align-middle" data-feather="user-check"></i> <span class="align-middle">System Users <span class="badge rounded-pill text-bg-primary">{{$all}}</span>
                </a>
            </li>
            <li class="sidebar-item {{ (request()->is('users/police')) ? 'active':'' }}">
                <a class="sidebar-link" href="{{route('police.index')}}">
                    <i class="align-middle" data-feather="user-check"></i> <span class="align-middle">Police Officers <span class="badge rounded-pill text-bg-info">{{$officers}}</span> </span>
                </a>
            </li>
            <li class="sidebar-item {{ (request()->is('users/investigators')) ? 'active':'' }}">
                <a class="sidebar-link" href="{{route('investigators.index')}}">
                    <i class="align-middle" data-feather="user-check"></i> <span class="align-middle">Investigators <span class="badge rounded-pill text-bg-warning">{{$investigators}}</span></span>
                </a>
            </li>
            <li class="sidebar-item {{ (request()->is('users/complainants')) ? 'active':'' }}">
                <a class="sidebar-link" href="{{route('complainants.index')}}">
                    <i class="align-middle" data-feather="user-check"></i> <span class="align-middle">Complainants <span class="badge rounded-pill text-bg-danger">{{$complainants}}</span></span>
                </a>
            </li>
            @endif
            <li class="sidebar-header">
                Incident Reporting
            </li>

            <li class="sidebar-item {{ (request()->is('issues/*')) ? 'active':'' }}">
                <a class="sidebar-link" href="{{route('issues.index')}}">
                    <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Incidents
                        @if(Auth::user()->user_type == 0)
                        <span class="badge rounded-pill text-bg-light">{{$issues}}</span>
                        @elseif(Auth::user()->user_type == 1)
                        <span class="badge rounded-pill text-bg-light">{{$issuesAssignedOfficer}}</span>
                        @elseif(Auth::user()->user_type == 2)
                        <span class="badge rounded-pill text-bg-light">{{$issuesAssignedInvestigator}}</span>
                        @else
                        <span class="badge rounded-pill text-bg-light">{{$issuesAssignedComplainant}}</span>
                        @endif
                    </span>
                </a>

            </li>
            @if(Auth::user()->user_type !=3)
            <li class="sidebar-item {{ (request()->is('witnesses/*')) ? 'active':'' }}">
                <a class="sidebar-link" href="{{route('witnesses.index')}}"><i class="align-middle" data-feather="user-check"></i>Witnesses <span class="badge rounded-pill text-bg-primary">{{$witnesses}}</span></a>
            </li>
            <li class="sidebar-item {{ (request()->is('suspects/*')) ? 'active':'' }}">
                <a class="sidebar-link" href="{{route('suspects.index')}}"><i class="align-middle" data-feather="user-x"></i>Suspects <span class="badge rounded-pill text-bg-danger">{{$suspects}}</span></a>
            </li>
            @endif
        </ul>
    </div>
</nav>