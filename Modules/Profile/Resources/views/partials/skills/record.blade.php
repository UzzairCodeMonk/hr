@if(count($skills))
@foreach($skills as $key=> $record)
<tr>
    <td>
        {{++$key}}
    </td>
    <td>
        <p>{{$record->skill}}</p>
    </td>
    <td>
        <p>{{$record->period}}</p>
    </td>    
    <td>
    </td>
</tr>
@endforeach
@else
<tr>
    <td colspan="7">
        <p class="text-center">No skill records can be found.</p>
    </td>
</tr>
@endif
