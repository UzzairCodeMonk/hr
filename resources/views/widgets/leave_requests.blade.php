<div class="col">
    <div class="card card-body">
        <div class="flexbox">
            <img src="{{asset('images/dashboard/requests.svg')}}" alt="" style="height:100px;width:auto">
            </i>
            <div class="text-right">
                <span class="fw-400">Total Open Leave Requests</span><br>
                <span>
                    <span class="fs-18 ml-1">{{$count}}</span>
                </span>
                <div class="mt-4"></div>
                <a href="{{$link}}" class="btn btn-xs {{$class}} pull-right">{{$text}}</a>
            </div>
        </div>
    </div>

</div>
