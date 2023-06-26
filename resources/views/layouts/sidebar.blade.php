<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="/home">
            <span class="align-middle">Home</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
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

            <li class="sidebar-item {{ (request()->is('police/*')) ? 'active':'' }}">
                <a class="sidebar-link" href="{{route('police.index')}}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Police Officers</span>
                </a>
            </li>

            <li class="sidebar-item {{ (request()->is('users/*')) ? 'active':'' }}">
                <a class="sidebar-link" href="{{route('users.index')}}">
                    <i class="align-middle" data-feather="user-check"></i> <span class="align-middle">User Management</span>
                </a>
            </li>

            <li class="sidebar-item {{ (request()->is('issues/*')) ? 'active':'' }}">
                <a class="sidebar-link" href="{{route('issues.index')}}">
                    <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Issues/Complaints</span>
                </a>
            </li>
        </ul>
    </div>
</nav>