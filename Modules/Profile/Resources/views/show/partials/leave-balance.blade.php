<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Leave Type</th>
            <th>Balance</th>
        </tr>
    </thead>
    <tbody>
        @foreach($types as $key=>$type)
        <tr>
            <td>{{++$key}}</td>
            <td>{{$type->name ?? 'N/A'}}</td>
            <td>@if(DB::table('leavebalances')->where('user_id',request()->id)->where('leavetype_id',$type->id)->exists())
                {{DB::table('leavebalances')->where('user_id',request()->id)->where('leavetype_id',$type->id)->first()->balance}}/@endif{{$type->days}}
                {{str_plural('day',$type->days)}}</td>
        </tr>
        @endforeach
    </tbody>
</table>