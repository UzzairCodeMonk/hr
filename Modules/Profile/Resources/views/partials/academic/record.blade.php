@if(count($academics))

<form action="{{route('academic.bulkdelete')}}" method="POST" class="academic-bulk-delete">
    <button type="submit" class="btn btn-sm btn-danger pull-right">Delete Selected</button>
    <div class="mt-4"></div>
    @csrf
    @method('DELETE')
    @foreach($academics as $key=> $record)
    <tr>
        <td>
            <input type="checkbox" name="ids[]" class="record-checkbox" value="{{$record->id}}">
        </td>
        <td>
            {{++$key}}
        </td>
        <td>
            <p>{{$record->institution ?? 'N/A'}}</p>
        </td>
        <td>
            <p>{{$record->study_level ?? 'N/A'}}</p>
        </td>
        <td>
            <p>{{$record->start_date ?? 'N/A'}}</p>
        </td>
        <td>
            <p>{{$record->end_date ?? 'N/A'}}</p>
        </td>
        <td>
            <p>{{$record->course ?? 'N/A'}}</p>
        </td>
        <td>
            <p>{{$record->result ?? 'N/A'}}</p>
        </td>
        <td>
            <a href="{{route('academic.edit',['id'=>$record->id])}}" class="btn btn-link btn-sm text-dark">Edit</a>
        </td>
    </tr>

    @endforeach
</form>
@else
<tr>
    <td colspan="9">
        <p class="text-center">No academic records can be found.</p>
    </td>
</tr>
@endif
