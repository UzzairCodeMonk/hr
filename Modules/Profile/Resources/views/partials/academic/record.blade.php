@if(count($academics))
@foreach($academics as $key=> $record)
<tr>
    <td>
        {{++$key}}
    </td>
    <td>
        <p>{{$record->institution}}</p>
    </td>
    <td>
        <p>{{$record->study_level}}</p>
    </td>
    <td>
        <p>{{$record->start_date}}</p>
    </td>
    <td>
        <p>{{$record->end_date}}</p>
    </td>
    <td>
        <p>{{$record->course}}</p>
    </td>
    <td>
        <p>{{$record->result}}</p>
    </td>
    <td>
    </td>
</tr>
@endforeach
@else
<tr>
    <td colspan="7">
        <p class="text-center">No academic records can be found.</p>
    </td>
</tr>
@endif
