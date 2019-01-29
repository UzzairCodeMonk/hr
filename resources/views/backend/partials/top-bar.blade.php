<!-- Topbar -->
<header class="topbar">
    <div class="topbar-left">
        <span class="topbar-btn sidebar-toggler"><i>&#9776;</i></span>
        <ul class="topbar-btns d-sm-none d-md-none d-xl-block d-xs-none">
            <li class="dropdown">
                <span id="icon"></span>
                <span id="greeting" class="topbar-btn"></span>
            </li>
        </ul>

    </div>
    <div class="topbar-right">
        <ul class="topbar-btns">
            <li class="dropdown">
                <span class="topbar-btn" data-toggle="dropdown">
                    @if(!empty(auth()->user()->personalDetail->avatar))
                    <img class="avatar avatar-bordered" src="{{asset(auth()->user()->personalDetail->avatar)}}">
                    @else
                    <img class="avatar" src="https://api.adorable.io/avatars/285/abott@adorable.png">
                    @endif</span>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{route('personal.index')}}"><i class="ti-user"></i> My Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();"><i
                            class="ti-power-off"></i> Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            <!-- Notifications -->
            <li class="dropdown d-none d-md-block">
                <span class="topbar-btn {{ Auth::user()->unreadNotifications->count() > 0 ? 'has-new':'' }}"
                    data-toggle="dropdown"><i class="ti-bell"></i></span>
                @if(userHasNotification())
                <div class="dropdown-menu dropdown-menu-right">
                    @include('components.notification.notification-item')
                </div>
                @endif

            </li>          
        </ul>
        <!-- @role('Admin')
        <div class="topbar-divider"></div>
        <a href="" class="btn btn-xs btn-primary" style="margin-top:6px;"> Access Admin Panel</a>
        @endrole -->
    </div>
</header>
<!-- END Topbar -->
