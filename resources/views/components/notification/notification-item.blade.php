@foreach(Auth::user()->unreadNotifications->take(3) as $key=>$n)
<div class="media-list media-list-hover media-list-divided media-list-xs">
    <!-- leave -->
    @if(isset($n->data['type']) && $n->data['type'] == 'leave')
    <?php $leave_id = $n->data['leave_id']; ?>
    <form action="{{route('notification.read',
            [
            'id' => $n->id,
            'url'=>URL::signedRoute('leave.employee.show',['id'=>$leave_id])
            ])}}"
        method="POST" id="key-{{$key}}">
        @csrf
        <a class="media" href="" onclick="document.getElementById('key-{{$key}}').submit();">
            <span class="avatar"><i class="ti-files"></i></span>
            <!-- payslip -->
            @elseif(isset($n->data['type']) && $n->data['type'] == 'payslip')
            <?php $user_id = $n->data['user_id'];$month= $n->data['month'];$year= $n->data['year']; ?>
            <form action="{{route('notification.read',[
                'id' => $n->id,
                'url' => URL::signedRoute('payslip.my.record',['id'=>$user_id,'month'=>$month,'year'=>$year])
                ])}}"
                method="POST" id="key-{{$key}}">
                <a class="media" onclick="document.getElementById('key-{{$key}}').submit();">
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
            </form>
</div>
</form>
@endforeach
<div class="dropdown-footer">
    <a href="{{route('personal.notifications')}}" class="text-center">View all notifications</a>
</div>
