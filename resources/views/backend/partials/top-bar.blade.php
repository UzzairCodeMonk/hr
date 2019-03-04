<!-- Topbar -->
<header class="topbar">
    <div class="topbar-left">
        <span class="topbar-btn sidebar-toggler"><i>&#9776;</i></span>
        <ul class="topbar-btns d-none d-lg-block">
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
            <li class="dropdown d-none d-md-block" id="vue-notifications">
                <span class="topbar-btn" data-toggle="dropdown"><i class="ti-bell"></i> 
                <div class="badge badge-danger" style="border-radius: 50%;
                    font-weight: 400;
                    line-height: normal;
                    font-size: 9px;
                    width: 16px;
                    height: 16px;
                    padding: 4px;">@{{arraysize}}</div></span>
                @if(userHasNotification())
                <div class="dropdown-menu dropdown-menu-right">
                    @include('components.notification.notification-item')
                </div>
                @endif

            </li>
        </ul>
        @role('Admin')
        <div class="topbar-divider"></div>
        <a href="{{ is_active(config('app.administration_prefix').'/*') ? route('personal.index'):route('backend.admin.index')}}"
            class="btn btn-xs btn-primary" style="margin-top:6px;"> {{
            is_active(config('app.administration_prefix').'/*') ? 'Access My Profile':'Access Admin Panel' }}</a>

        <div class="fab fab-dir-bottom">
            <a class="btn btn-xs btn-primary mr-2 text-white" data-toggle="button" style="margin-top:6px;">
                Admin Quicklinks
            </a>

            <ul class="fab-buttons" style="top:50px">
                <li><a class="btn  btn-block btn-sm btn-primary" href="{{route('backend.admin.index')}}">Dashboard</a></li>
                <li><a class="btn  btn-block btn-sm btn-primary" href="{{route('user.index')}}">Employees Module</a></li>
                <li><a class="btn  btn-block btn-sm btn-primary" href="{{route('leave.admin.index',['status'=>'submitted'])}}">Leaves Module</a></li>
                <li><a class="btn  btn-block btn-sm btn-primary" href="{{route('payslip.index')}}">Wages Module</a></li>
                <li><a class="btn  btn-block btn-sm btn-primary" href="{{route('roles.index')}}">Roles &amp; Permission</a></li>
                <li><a class="btn  btn-block btn-sm btn-primary" href="{{route('siteconfig.index')}}">Site Configurations</a></li>               
            </ul>

        </div>
        @endrole
    </div>
</header>
<!-- END Topbar -->
