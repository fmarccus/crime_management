<nav class="navbar navbar-expand navbar-light navbar-bg">
    @auth
    @if(auth()->user()->email_verified_at!=null)
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>
    @endif
    @endauth
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            @guest
            @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @endif

            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                    @if(Auth::user()->photo)
                    <img src="{{asset('images/'.Auth::user()->photo)}}" class="img-fluid rounded me-2" alt="Profile Photo" width="30" height="30"> {{ Auth::user()->name }}
                    @if(Auth::user()->user_type=='0')
                    <span class="badge rounded-pill text-bg-primary">
                        Master
                    </span>
                    @elseif(Auth::user()->user_type=='1')
                    <span class="badge rounded-pill text-bg-info">
                        Police Officer
                    </span>
                    @elseif(Auth::user()->user_type=='2')
                    <span class="badge rounded-pill text-bg-warning">
                        Investigator
                    </span>
                    @else
                    <span class="badge rounded-pill text-bg-danger">
                        Complainant
                    </span>
                    @endif
                    @else
                    <img src="{{asset('images/user.png')}}" class="img-fluid rounded me-2" alt="Profile Photo" width="30" height="30"> {{ Auth::user()->name }}
                    @if(Auth::user()->user_type=='0')
                    <span class="badge rounded-pill text-bg-primary">
                        Master
                    </span>
                    @elseif(Auth::user()->user_type=='1')
                    <span class="badge rounded-pill text-bg-info">
                        Police Officer
                    </span>
                    @elseif(Auth::user()->user_type=='2')
                    <span class="badge rounded-pill text-bg-warning">
                        Investigator
                    </span>
                    @else
                    <span class="badge rounded-pill text-bg-danger">
                        Complainant
                    </span>
                    @endif

                    @endif
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('profile.edit')}}"><i class="align-middle me-1" data-feather="user"></i>Edit Profile</a>
                    <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
                    <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
        </ul>
    </div>
</nav>