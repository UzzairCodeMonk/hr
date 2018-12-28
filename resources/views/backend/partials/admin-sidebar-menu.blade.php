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
    <li class="nav-item {{Route::currentRouteName() == 'user.index'  ? 'active':''}}"">
        <i class=" ti
        ti-agenda"></i>
        <a class="nav-link" href="{{route('user.index')}}">View Employees</a>
    </li>
    <li class="nav-item {{Route::currentRouteName() == 'user.create'  ? 'active':''}}"">
        <i class=" ti ti-user"></i>
        <a class="nav-link" href="{{route('user.create')}}">Add Employee</a>
    </li>
    <li class="nav-item {{Route::currentRouteName() == 'position.index'  ? 'active':''}}">
        <i class="ti ti-layers-alt"></i>
        <a class="nav-link" href="{{route('position.index')}}">Position
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
    <li class="nav-item {{Route::currentRouteName() == 'leave.index'  ? 'active':''}}">
        <i class="ti ti-agenda"></i>
        <a class="nav-link" href="{{route('leave.index')}}">Leave Records</a>
    </li>
    <li class="nav-item {{Route::currentRouteName() == 'leave-type.index'  ? 'active':''}}">
        <i class="ti ti-layers-alt"></i>
        <a class="nav-link" href="{{route('leave-type.index')}} ">Leave Categories</a>
    </li>
</ul>
<hr>
<div class="aside-block">
    <div class="flexbox mb-1">
        <h6 class="aside-title">Wage Management</h6>
    </div>
</div>
<ul class="nav nav-pills flex-column">
    <li class="nav-item {{Route::currentRouteName() == 'payslip.index'  ? 'active':''}}">
        <i class="ti ti-agenda"></i>
        <a class="nav-link" href="{{route('payslip.index')}}">Payslip Records</a>
    </li>
</ul>
<hr>
<div class="aside-block">
    <div class="flexbox mb-1">
        <h6 class="aside-title">Configurations</h6>
    </div>
</div>
<ul class="nav nav-pills flex-column">
    <li class="nav-item {{Route::currentRouteName() == 'siteconfig.index'  ? 'active':''}}">
        <i class="ti ti-id-badge"></i>
        <a class="nav-link" href="{{route('siteconfig.index')}} ">Site Configurations</a>
    </li>
    <li class="nav-item {{Route::currentRouteName() == 'roles.index'  ? 'active':''}}">
        <i class="ti ti-id-badge"></i>
        <a class="nav-link" href="{{route('roles.index')}} ">Roles & Permissions</a>
    </li>
</ul>
