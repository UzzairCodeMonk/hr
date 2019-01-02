@foreach(Auth::user()->unreadNotifications as $n)
<div class="media-list media-list-hover media-list-divided media-list-xs">
     <!-- leave -->
    @if(isset($n->data['type']) && $n->data['type'] == 'leave')   
    <?php $leave_id = $n->data['leave_id']; ?>
    <a class="media" href="{{URL::signedRoute('leave.employee.show',['id'=>$leave_id])}}">
        <span class="avatar"><i class="ti-files"></i></span>
        <!-- payslip -->
        @elseif(isset($n->data['type']) && $n->data['type'] == 'payslip')
            <?php $user_id = $n->data['user_id'];$month= $n->data['month'];$year= $n->data['year']; ?>
        <a class="media" href="{{URL::signedRoute('payslip.my.record',['id'=>$user_id,'month'=>$month,'year'=>$year])}}">
            <span class="avatar"><i class="ti-money"></i></span>
            @else
            <a class="media" href="#">
                <span class="avatar"><i class="ti-user"></i></span>
                @endif
                <div class="media-body">
                    <p>{{$n->data['message']}}</p>
                    <time datetime="{{$n->created_at}}">{{Carbon\Carbon::parse($n->created_at)->toDayDateTimeString()}}</time>
                </div>
            </a>
</div>
@endforeach
