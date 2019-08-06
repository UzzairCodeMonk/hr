@php
$admin_link = config('app.administration_prefix');
@endphp
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link {{active($admin_link .'/wages/claim/status/submitted')}}" href="{{route('claim.statusrecord',['status'=>'submitted'])}}" role="tab" aria-controls="submitted" aria-selected="true">Active Applications</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{active($admin_link .'/wages/claim/status/remarks')}}" href="{{route('claim.statusrecord',['status'=>'remarks'])}}" role="tab" aria-controls="remarks" aria-selected="true">Remarked Applications</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{active($admin_link .'/wages/claim/status/approved')}}" href="{{route('claim.statusrecord',['status'=>'approved'])}}" role="tab" aria-controls="approved" aria-selected="false">Approved Applications</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{active($admin_link .'/wages/claim/status/rejected')}}" href="{{route('claim.statusrecord',['status'=>'rejected'])}}" role="tab" aria-controls="rejected" aria-selected="false">Rejected Applications</a>
    </li>
</ul>