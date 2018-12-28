@if(count($skills))
@foreach($skills as $key=> $record)
<tr>
    <td>
        {{++$key}}
    </td>
    <td>
        <p>{{$record->skill ?? 'N/A'}}</p>
    </td>
    <td>
        <p>{{$record->period ?? 'N/A'}}</p>
    </td>
    <td class="text-center">
        <a href="{{route('skill.edit',['id'=>$record->id])}}" class="btn btn-primary btn-sm">Edit</a>
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
