@if(count($familyRecord))

<form action="{{route('family.bulkdelete')}}" method="POST" class="family-bulk-delete">
    <button type="submit" class="btn btn-sm btn-danger pull-right">Delete Selected</button>    
    <div class="mt-4"></div>
    @csrf
    @method('DELETE')
    @foreach($familyRecord as $key=> $record)
    <tr>
        <td>
            <input type="checkbox" name="ids[]" class="record-checkbox" value="{{$record->id}}">
        </td>
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
        <td class="text-center">
            <a href="{{route('family.edit',['id'=>$record->id])}}" class="btn btn-link btn-sm text-dark">Edit</a>
        </td>
    </tr>
    @endforeach
    @else
    <tr>
        <td colspan="9">
            <p class="text-center">No family records can be found.</p>
        </td>
    </tr>
</form>
@endif
