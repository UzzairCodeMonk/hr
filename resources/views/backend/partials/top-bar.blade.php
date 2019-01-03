<!-- Topbar -->
<header class="topbar">
    <div class="topbar-left">
        <span class="topbar-btn sidebar-toggler"><i>&#9776;</i></span>
        <ul class="topbar-btns">
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
                        <img class="" src="{{asset(auth()->user()->personalDetail->avatar)}}" style=" vertical-align: middle;
                        width: 40px;
                        height: 40px;
                        border-radius: 50%;">
                        @else
                        <img style=" vertical-align: middle;
                        width: 40px;
                        height: 40px;
                        border-radius: 50%;" src="https://api.adorable.io/avatars/285/abott@adorable.png">
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
                <span class="topbar-btn {{ Auth::user()->unreadNotifications->count() > 0 ? 'has-new':'' }}" data-toggle="dropdown"><i class="ti-bell"></i></span>
                @if(userHasNotification())
                <div class="dropdown-menu dropdown-menu-right">
                    @include('components.notification.notification-item')
                </div>
                @endif

            </li>
            <!-- END Notifications -->
            @role('Admin')
            <!-- <li>
                <span class="topbar-btn"><i  data-provide="tooltip" data-original-title="Publish new memo" class="ti ti-announcement"></i></span>
            </li> -->
            @endrole
        </ul>

    </div>
</header>
<!-- END Topbar -->
