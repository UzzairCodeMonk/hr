<table class="table table-bordered datatable table-condensed">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Leave Type</th>
        </tr>
    </thead>
    <tbody>
        @foreach($absentees as $key => $a)
        <tr>
            <td>{{++$key}}</td>
            <td>
                <div class="media">
                    <img class="avatar" src="{{asset($a->user->personalDetail->avatar) ?? '' }}" alt="">
                    <div class="media-body">
                        <p class="lh-1">{{$a->user->personalDetail->name ?? 'N/A'}}</p>
                        <small>
                            {!! $a->user->personalDetail->position->name ?? 'N/A' !!}
                            {{$a->user->personalDetail->staff_number ?? 'N/A'}}
                        </small>
                    </div>
                </div>                
            </td>
            <td>{{$a->start_date ?? 'N/A'}}</td>
            <td>{{$a->end_date ?? 'N/A'}}</td>
            <td>{{$a->type->name ?? 'N/A'}}</td>
        </tr>
        @endforeach
        <tr>

        </tr>
    </tbody>

</table>
