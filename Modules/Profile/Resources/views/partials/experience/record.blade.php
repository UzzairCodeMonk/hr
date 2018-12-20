@if(count($experience))
@foreach($experience as $key=> $record)
<tr>
    <td>
       {{++$key}}
    </td>
    <td>
        <p>{{$record->company}}</p>
    </td>
    <td>
        <p>{{$record->position}}</p>
    </td>
    <td>
        <p>{{$record->start_date}}</p>
    </td>
    <td>
        <p>{{$record->end_date}}</p>
    </td>
    <td>
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
