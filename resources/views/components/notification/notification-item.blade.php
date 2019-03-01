@foreach(Auth::user()->unreadNotifications as $n)
<form action="#" method="POST" class="mark-read">
    @csrf
    <div class="media-list media-list-hover media-list-divided media-list-xs">
        <a class="media mark-read" href="{{$n->data['url'] ?? ''}}" data-id="{{ $n->id ?? ''}}">
            <span class="avatar"><i class="{{$n->data['icon'] ?? ''}}"></i></span>            
            <div class="media-body">
                <p>{!! $n->data['message'] ?? '' !!}</p>
                <time datetime="{{$n->created_at ?? ''}}">{{Carbon\Carbon::parse($n->created_at)->toDayDateTimeString()}}</time>
            </div>
        </a>
    </div>
</form>
@endforeach
<div class="dropdown-footer">
    <a href="{{route('personal.notifications')}}" class="text-center">View all notifications</a>
</div>
