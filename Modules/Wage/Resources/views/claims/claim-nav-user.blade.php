<ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{Request::is('claim/my-claims/status/submitted*')  ? 'active':''}}" href="{{route('claim.myclaims',['status'=>'submitted'])}}" role="tab" aria-controls="active" aria-selected="true">Active Applications</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{Request::is('claim/my-claims/status/remarks*')  ? 'active':''}}" href="{{route('claim.myclaims',['status'=>'remarks'])}}" role="tab" aria-controls="remarks" aria-selected="false">Remarked Applications</a>
        </li>
    
        <li class="nav-item">
            <a class="nav-link {{Request::is('claim/my-claims/status/approved*')  ? 'active':''}}" href="{{route('claim.myclaims',['status'=>'approved'])}}" role="tab" aria-controls="approved" aria-selected="false">Approved Applications</a>
        </li>
    
        <li class="nav-item">
            <a class="nav-link {{Request::is('claim/my-claims/status/rejected*')  ? 'active':''}}" href="{{route('claim.myclaims',['status'=>'rejected'])}}" role="tab" aria-controls="rejected" aria-selected="false">Rejected Applications</a>
        </li>
    </ul>