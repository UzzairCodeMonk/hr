@if(count($awards))
<form action="{{route('award.bulkdelete')}}" method="POST" class="award-bulk-delete">
    <button type="submit" class="btn btn-sm btn-danger pull-right">Delete Selected</button>
    <div class="mt-4"></div>
    @csrf
    @method('DELETE')
    @foreach($awards as $key=> $record)
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
            <p>{{$record->received_date ?? 'N/A'}}</p>
        </td>
        <td>
            <p>{{$record->notes ?? 'N/A'}}</p>
        </td>
        <td>
            <a href="{{route('award.edit',['id'=>$record->id])}}" class="btn btn-link btn-sm text-dark">Edit</a>
        </td>
    </tr>
    @endforeach
</form>
@else
<tr>
    <td colspan="7">
        <p class="text-center">No award records can be found.</p>
    </td>
</tr>
@endif
