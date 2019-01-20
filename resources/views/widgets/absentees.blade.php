<div class="col">
    <div class="card">
        <div class="card-header">
            <div class="card-options">
                <h4 class="card-title">Absentees For Today</h4>
            </div>
        </div>
        <div class="card-body">
            @if($absentees->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Employee</th>
                        <th>Leave Type</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($absentees as $key => $a)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$a->user->personalDetail->name}}</td>
                        <td>{{$a->type->name}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <img src="{{asset('images/dashboard/requests.svg')}}" alt="" style="height:100px;width:auto">
            @endif
        </div>
    </div>
</div>
