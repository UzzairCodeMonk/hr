<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Relationship</th>
            <th>IC No.</th>
            <th>Mobile No.</th>            
            <th>Occupation</th>
            <th>Income Tax No.</th>
        </tr>
    </thead>
    <tbody>
        @if(count($familyRecord))
        @foreach($familyRecord as $key=> $record)
        <tr>
            <td>
                {{++$key}}
            </td>
            <td>
                <p>{{$record->name ?? 'N/A'}}</p>
            </td>
            <td>
                <p>{{$record->type->name ?? 'N/A'}}</p>
            </td>
            <td>
                <p>{{$record->ic_number ?? 'N/A'}}</p>
            </td>
            <td>
                <p>{{$record->mobile_number ?? 'N/A'}}</p>
            </td>
            <td>
                <p>{{$record->occupation ?? 'N/A'}}</p>
            </td>
            <td>
                <p>{{$record->income_tax_number ?? 'N/A'}} </p>
            </td>            
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="8">
                <p class="text-center">No family records can be found.</p>
            </td>
        </tr>
        @endif
    </tbody>
</table>
