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
        <p>{{$record->received_date ?? 'N/A'}}</p>
    </td>
    <td>
        <p>{{$record->notes ?? 'N/A'}}</p>
    </td>
    <td>
        <a href="{{route('award.edit',['id'=>$record->id])}}" class="btn btn-primary btn-sm">Edit</a>
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
