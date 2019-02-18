<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link {{Request::is('leaves/status/submitted*')  ? 'active':''}}" href="{{route('leave.index',['status'=>'submitted'])}}" role="tab" aria-controls="active"
            aria-selected="true">Active Applications</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{Request::is('leaves/withdrawn*')  ? 'active':''}}"  href="{{route('leave.withdrawn')}}" role="tab" aria-controls="withdrawn"
            aria-selected="false">Withdrawn Applications</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{Request::is('leaves/status/approved*')  ? 'active':''}}"  href="{{route('leave.index',['status'=>'approved'])}}" role="tab" aria-controls="withdrawn"
            aria-selected="false">Approved Applications</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{Request::is('leaves/status/rejected*')  ? 'active':''}}"  href="{{route('leave.index',['status'=>'rejected'])}}" role="tab" aria-controls="withdrawn"
            aria-selected="false">Rejected Applications</a>
    </li>
</ul>