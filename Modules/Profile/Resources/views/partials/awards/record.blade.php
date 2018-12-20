@if(count($awards))
@foreach($awards as $key=> $record)
<tr>
    <td>
        {{++$key}}
    </td>
    <td>
        <p>{{$record->name}}</p>
    </td>
    <td>
        <p>{{$record->received_date}}</p>
    </td>
    <td>
        <p>{{$record->notes}}</p>
    </td>
    <td>
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
