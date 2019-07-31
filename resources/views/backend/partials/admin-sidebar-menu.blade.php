@if(
is_active(config('app.administration_prefix')."/employees*")
||is_active(config('app.administration_prefix')."/employee-detail*"))
<div class="aside-block">
    <div class="flexbox mb-1">
        <h6 class="aside-title">Employees Management</h6>
    </div>
</div>
<ul class="nav nav-pills flex-column">
    <li class="nav-item {{active('user.dashboard.index')}}">
        <i class="ti ti-agenda"></i>
        <a class="nav-link" href="{{route('user.dashboard.index')}}">Dashboard</a>
    </li>
    <li class="nav-item {{active('user.index')}}">
        <i class=" ti
        ti-agenda"></i>
        <a class="nav-link" href="{{route('user.index')}}">View Employees</a>
    </li>
    <li class="nav-item {{active('user.create')}}">
        <i class=" ti ti-user"></i>
        <a class="nav-link" href="{{route('user.create')}}">Add Employee</a>
    </li>
    <li class="nav-item {{active('position.index')}}">
        <i class="ti ti-layers-alt"></i>
        <a class="nav-link" href="{{route('position.index')}}">Position Categories</a>
    </li>
    <li class="nav-item {{active('user.resined')}}">
        <i class=" ti
        ti-agenda"></i>
        <a class="nav-link" href="{{route('user.resigned')}}">View Employees Resigned</a>
    </li>
</ul>
<hr>
@endif

@if(is_active(config('app.administration_prefix')."/leaves*"))
<div class="aside-block">
    <div class="flexbox mb-1">
        <h6 class="aside-title">Leave Management</h6>
    </div>
</div>
<ul class="nav nav-pills flex-column">
    <li class="nav-item {{active('leave.dashboard.index')}}">
        <i class="ti ti-agenda"></i>
        <a class="nav-link" href="{{route('leave.dashboard.index')}}">Dashboard</a>
    </li>
    <li class="nav-item {{active('leave.admin.index')}}">
        <i class="ti ti-agenda"></i>
        <a class="nav-link" href="{{route('leave.admin.index',['status'=>'submitted'])}}">Leave Records</a>
    </li>
    <li class="nav-item {{active('leave-type.index')}}">
        <i class="ti ti-layers-alt"></i>
        <a class="nav-link" href="{{route('leave-type.index')}} ">Leave Categories</a>
    </li>
    <li class="nav-item {{active('holiday.index')}}">
        <i class="ti ti-calendar"></i>
        <a class="nav-link" href="{{route('holiday.index')}} ">Holidays</a>
    </li>
    <li class="nav-item {{active('leave-approvers.index')}}">
        <i class="ti ti-layers-alt"></i>
        <a class="nav-link" href="{{route('leave-approvers.index')}} ">Leave Approvers</a>
    </li>
    <li class="nav-item {{active('leave.config.index')}}">
        <i class="ti ti-agenda"></i>
        <a class="nav-link" href="{{route('leave.config.index')}}">Leave Configurations</a>
    </li>
    <li class="nav-item">        
        <a class="btn btn-sm btn-danger reset-leave-balance" href="{{route('leave.user.balance-reset')}}"><i class="ti ti-reload"></i> Reset Users Leave Balance</a>
    </li>
</ul>
<hr>
@endif
@if(is_active(config('app.administration_prefix')."/wages*"))
<div class="aside-block">
    <div class="flexbox mb-1">
        <h6 class="aside-title">Wage Management</h6>
    </div>
</div>
<ul class="nav nav-pills flex-column">
    <li class="nav-item {{active('payslip.index')}}">
        <i class="ti ti-agenda"></i>
        <a class="nav-link" href="{{route('payslip.index')}}">Payslip Records</a>
    </li>
    <li class="nav-item {{active('payslip.summary')}}">
        <i class="ti ti-bar-chart-alt"></i>
        <a class="nav-link" href="{{route('payslip.summary')}}">Payslip Summary</a>
    </li>
</ul>

<ul class="nav nav-pills flex-column">
    <li class="nav-item {{active('claim.statusrecord')}}">
        <i class="ti ti-agenda"></i>
        <a class="nav-link" href="{{route('claim.statusrecord',['status'=>'submitted'])}}">Claim Categories</a>
    </li>
    <li class="nav-item {{active('claim.statusrecord')}}">
        <i class="ti ti-agenda"></i>
        <a class="nav-link" href="{{route('claim.statusrecord',['status'=>'submitted'])}}">Claim Submission Records</a>
    </li>
</ul>
<hr>
@endif

@if(is_active(config('app.administration_prefix')."/roles*") ||
is_active(config('app.administration_prefix')."/site*") ||
is_active(config('app.administration_prefix')."/company*"))
<div class="aside-block">
    <div class="flexbox mb-1">
        <h6 class="aside-title">Configurations</h6>
    </div>
</div>
<ul class="nav nav-pills flex-column">
    <li class="nav-item {{active('siteconfig.index')}}">
        <i class="ti ti-settings"></i>
        <a class="nav-link" href="{{route('siteconfig.index')}} ">Site Configurations</a>
    </li>
    <li class="nav-item {{active('company.index')}}">
        <i class="ti ti-location-pin"></i>
        <a class="nav-link" href="{{route('company.index')}} ">Cost Centers</a>
    </li>
    <li class="nav-item {{active('roles.index')}}">
        <i class="ti ti-id-badge"></i>
        <a class="nav-link" href="{{route('roles.index')}} ">Roles & Permissions</a>
    </li>

</ul>
@endif
