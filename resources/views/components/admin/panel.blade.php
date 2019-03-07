<div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
    <div class="card p-30 pt-50 text-center">
        <div>
            <img src="{{$img ?? ''}}" alt="{{$link ?? ''}}" class="mb-5" height="150px">
        </div>
        <h5>{{$title ?? ''}}</h5>        
        <p class="text-light fs-12 mb-30">{{$description ?? ''}}</p>
        @if($link != '' || $link != null) 
        <a href="{{$link ?? ''}}" class="btn btn-round btn-xs {{$linkClass ?? ''}}">{{$linkText ?? ''}}</a>
        @endif
    </div>
</div>
