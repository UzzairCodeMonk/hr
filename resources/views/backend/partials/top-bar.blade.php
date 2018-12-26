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
                <span class="topbar-btn" data-toggle="dropdown"><img class="avatar" src="https://api.adorable.io/avatars/285/abott@adorable.png"
                        alt="..."></span>
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
                <span class="topbar-btn has-new" data-toggle="dropdown"><i class="ti-bell"></i></span>
                <div class="dropdown-menu dropdown-menu-right">
                    @if(Auth::user()->unreadNotifications->count() > 0)
                    @foreach(Auth::user()->unreadNotifications as $n)
                    <div class="media-list media-list-hover media-list-divided media-list-xs">
                        @if(isset($n->data['type']) && $n->data['type'] == 'leave')
                        <?php $leave_id = $n->data['leave_id']; ?>
                        <a class="media" href="{{URL::signedRoute('leave.employee.show',['id'=>$leave_id])}}">
                            @else
                            <a class="media" href="#">
                                @endif
                                <span class="avatar"><i class="ti-user"></i></span>
                                <div class="media-body">
                                    <p>{{$n->data['message']}}</p>
                                    <time datetime="{{$n->created_at}}">{{Carbon\Carbon::parse($n->created_at)->toDayDateTimeString()}}</time>
                                </div>
                            </a>
                    </div>
                    @endforeach
                    @endif
            </li>
            <!-- END Notifications -->
        </ul>

    </div>
</header>
<!-- END Topbar -->
