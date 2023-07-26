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
            @if(Auth::user()->user_type == 0)
            <li class="sidebar-item {{ (request()->is('users/*')) ? 'active':'' }}">
                <a class="sidebar-link" href="{{route('users.index')}}">
                    <i class="align-middle" data-feather="user-check"></i> <span class="align-middle">User Management</span>
                </a>
            </li>
            @endif
            <li class="sidebar-item">
                <a class="sidebar-link" href="/logs">
                    <i class="align-middle" data-feather="clock"></i> <span class="align-middle">Activity Logs</span>
                </a>
            </li>
            <li class="sidebar-header">
                Incident Reporting
            </li>
            @if(Auth::user()->user_type == 0)
            <li class="sidebar-item {{ (request()->is('complainants/*')) ? 'active':'' }}">
                <a class="sidebar-link" href="{{route('complainants.index')}}">
                    <i class="align-middle" data-feather="user-minus"></i> <span class="align-middle">Complainants</span>
                </a>
            </li>
            @endif
            <li class="sidebar-item {{ (request()->is('issues/*')) ? 'active':'' }}">
                <a class="sidebar-link" href="{{route('issues.index')}}">
                    <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Issues/Complaints</span>
                </a>
            </li>
        </ul>
    </div>
</nav>