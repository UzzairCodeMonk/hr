@if(Request::is('/profile*'))
@include('profile::admin.sidebar.menu')
@endif

@if(Request::is(config('app.administration_prefix')."/employees*"))
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
@endif

@if(Request::is(config('app.administration_prefix')."/leaves*"))
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
    <li class="nav-item {{Route::currentRouteName() == 'holiday.index'  ? 'active':''}}">
        <i class="ti ti-calendar"></i>
        <a class="nav-link" href="{{route('holiday.index')}} ">Holidays</a>
    </li>
</ul>
<hr>
@endif
@if(Request::is(config('app.administration_prefix')."/wages*"))
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
    <li class="nav-item {{Route::currentRouteName() == 'payslip.summary'  ? 'active':''}}">
        <i class="ti ti-bar-chart-alt"></i>
        <a class="nav-link" href="{{route('payslip.summary')}}">Payslip Summary</a>
    </li>
</ul>

<ul class="nav nav-pills flex-column">
        <li class="nav-item {{Route::currentRouteName() == 'claim.records'  ? 'active':''}}">
            <i class="ti ti-agenda"></i>
            <a class="nav-link" href="{{route('claim.records')}}">Claim Submission Records</a>
        </li>
    </ul>
<hr>
@endif
<!-- <div class="aside-block">
    <div class="flexbox mb-1">
        <h6 class="aside-title">Broadcast</h6>
    </div>
</div> -->
<!-- <ul class="nav nav-pills flex-column">
    <li class="nav-item {{Route::currentRouteName() == 'leave.index'  ? 'active':''}}">
        <i class="ti ti-agenda"></i>
        <a class="nav-link" href="{{route('leave.index')}}">Memorandums</a>
    </li>
</ul>
<hr> -->
@if(Request::is(config('app.administration_prefix')."/roles*") ||
Request::is(config('app.administration_prefix')."/site*"))
<div class="aside-block">
    <div class="flexbox mb-1">
        <h6 class="aside-title">Configurations</h6>
    </div>
</div>
<ul class="nav nav-pills flex-column">
    <li class="nav-item {{Route::currentRouteName() == 'siteconfig.index'  ? 'active':''}}">
        <i class="ti ti-settings"></i>
        <a class="nav-link" href="{{route('siteconfig.index')}} ">Site Configurations</a>
    </li>
    <li class="nav-item {{Route::currentRouteName() == 'roles.index'  ? 'active':''}}">
        <i class="ti ti-id-badge"></i>
        <a class="nav-link" href="{{route('roles.index')}} ">Roles & Permissions</a>
    </li>

</ul>
@endif
