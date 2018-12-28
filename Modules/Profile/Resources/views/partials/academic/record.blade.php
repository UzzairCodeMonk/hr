@if(count($academics))
@foreach($academics as $key=> $record)
<tr>
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
        <a href="{{route('academic.edit',['id'=>$record->id])}}" class="btn btn-primary btn-sm">Edit</a>
    </td>
</tr>
@endforeach
@else
<tr>
    <td colspan="8">
        <p class="text-center">No academic records can be found.</p>
    </td>
</tr>
@endif
