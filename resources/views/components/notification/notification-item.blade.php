@foreach(Auth::user()->unreadNotifications as $n)
<form action="#" method="POST" class="mark-read">
    @csrf
    <div class="media-list media-list-hover media-list-divided media-list-xs">
        <!-- leave -->
        @if(isset($n->data['type']) && $n->data['type'] == 'leave')
        <?php $leave_id = $n->data['leave_id']; ?>
        <a class="media mark-read" href="{{URL::signedRoute('leave.show',['id'=>$leave_id])}}" data-id="{{ $n->id }}">
            <span class="avatar"><i class="ti-files"></i></span>
            <!-- payslip -->
            @elseif(isset($n->data['type']) && $n->data['type'] == 'payslip')
            <?php $user_id = $n->data['user_id'];$month= $n->data['month'];$year= $n->data['year']; ?>
            <a class="media mark-read" href="{{URL::signedRoute('payslip.my.record',['id'=>$user_id,'month'=>$month,'year'=>$year])}}"
                data-id="{{ $n->id }}">
                <span class="avatar"><i class="ti-money"></i></span>
                @elseif(isset($n->data['type']) && $n->data['type'] == 'claim')                
                <a class="media mark-read" href="{{$n->data['url']}}">
                    <span class="avatar"><i class="{{$n->data['icon']}}"></i></span>
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
</form>
@endforeach
<div class="dropdown-footer">
    <a href="{{route('personal.notifications')}}" class="text-center">View all notifications</a>
</div>
