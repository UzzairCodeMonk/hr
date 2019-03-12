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
            <td>{!! $a->user->personalDetail->name ?? 'N/A' !!}</td>
            <td>{{$a->start_date ?? 'N/A'}}</td>
            <td>{{$a->end_date ?? 'N/A'}}</td>
            <td>{{$a->type->name ?? 'N/A'}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@push('widget-js')
    <script type="text/javascript">
        $('#daysSelector').on('change',function(){
            let value = $('#DaysSelector').val();

            
        });
    </script>
@endpush
