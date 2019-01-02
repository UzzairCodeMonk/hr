<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Company</th>
            <th>Position</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Description</th>            
        </tr>
    </thead>
    <tbody>
        @if(count($experience))
        @foreach($experience as $key=> $record)
        <tr>
            <td>
                {{++$key}}
            </td>
            <td>
                <p>{{$record->company ?? 'N/A'}}</p>
            </td>
            <td>
                <p>{{$record->position ?? 'N/A'}}</p>
            </td>
            <td>
                <p>{{$record->start_date ?? 'N/A'}}</p>
            </td>
            <td>
                <p>{{$record->end_date ?? 'N/A'}}</p>
            </td> 
            <td>
                <p>{!! $record->description ?? 'N/A' !!}</p>
            </td>           
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="6">
                <p class="text-center">No employment history can be found.</p>
            </td>
        </tr>
        @endif
    </tbody>
</table>
