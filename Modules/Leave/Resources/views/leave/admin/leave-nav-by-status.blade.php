@php
    $admin_link = config('app.administration_prefix');
@endphp
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link {{active($admin_link .'/leaves/status/submitted')}}" href="{{route('leave.admin.index',['status'=>'submitted'])}}" role="tab" aria-controls="submitted"
            aria-selected="true">Active Applications</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{active($admin_link .'/leaves/withdrawn')}}"  href="{{route('leave.admin.withdrawn')}}" role="tab" aria-controls="withdrawn"
            aria-selected="false">Withdrawn Applications</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{active($admin_link .'/leaves/status/approved')}}"  href="{{route('leave.admin.index',['status'=>'approved'])}}" role="tab" aria-controls="approved"
            aria-selected="false">Approved Applications</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{active($admin_link .'/leaves/status/rejected')}}"  href="{{route('leave.admin.index',['status'=>'rejected'])}}" role="tab" aria-controls="rejected"
            aria-selected="false">Rejected Applications</a>
    </li>
</ul>