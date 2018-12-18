@if(Request::is('/profile*'))
@include('profile::admin.sidebar.menu')
@endif
<hr>
<div class="aside-block">
    <div class="flexbox mb-1">
        <h6 class="aside-title">Employees Management</h6>
    </div>
</div>
<ul class="nav nav-pills flex-column">
    <li class="nav-item">
        <i class="ti ti-agenda"></i>
        <a class="nav-link" href="#">View Employees</a>
    </li>
    <li class="nav-item">
        <i class="ti ti-user"></i>
        <a class="nav-link" href="#">Add Employee</a>
    </li>
    <li class="nav-item {{Route::currentRouteName() == 'position.index'  ? 'active':''}}">
        <i class="ti ti-layers"></i>
        <a class="nav-link  href="{{route('position.index')}}">Position
            Categories</a>
    </li>
</ul>
<hr>
<div class="aside-block">
    <div class="flexbox mb-1">
        <h6 class="aside-title">Leave Management</h6>
    </div>
</div>
<ul class="nav nav-pills flex-column">
    <li class="nav-item">
        <i class="ti ti-agenda"></i>
        <a class="nav-link {{Route::currentRouteName() == 'leave.index'  ? 'active':''}}" href="">Leave Records</a>
    </li>
    <li class="nav-item {{Route::currentRouteName() == 'leave-type.index'  ? 'active':''}}">
        <i class="ti ti-layers-alt"></i>
        <a class="nav-link" href="{{route('leave-type.index')}} ">Leave Categories</a>
    </li>
</ul>
