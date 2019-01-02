<table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Received Date</th>
                <th>Remarks</th>                            
            </tr>
        </thead>
        <tbody>
                @if(count($awards))
                @foreach($awards as $key=> $record)
                <tr>
                    <td>
                        {{++$key}}
                    </td>
                    <td>
                        <p>{{$record->name ?? 'N/A'}}</p>
                    </td>
                    <td>
                        <p>{{Carbon\Carbon::parse($record->received_date)->format('d/m/Y') ?? 'N/A'}}</p>
                    </td>
                    <td>
                        <p>{{$record->notes ?? 'N/A'}}</p>
                    </td>                
                </tr>       
                @endforeach
                @else
                <tr>
                    <td colspan="7">
                        <p class="text-center">No award records can be found.</p>
                    </td>
                </tr>
                @endif
                
        </tbody>
    </table>
    