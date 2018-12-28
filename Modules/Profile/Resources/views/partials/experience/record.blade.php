@if(count($experience))
@foreach($experience as $key=> $record)
<tr>
    <td>
       {{++$key}}
    </td>
    <td>
        <p>{{$record->company ?? 'N/A'}}</p>
    </td>
    <td>
        <p>{{$record->position ?? 'N/A'}}</p>
    </td>
    <td>
        <p>{{$record->start_date ?? 'N/A'}}</p>
    </td>
    <td>
        <p>{{$record->end_date ?? 'N/A'}}</p>
    </td>
    <td>
        <p>{!! $record->description ?? 'N/A'!!}</p>
    </td>
    <td>
        <a href="{{route('experience.edit',['id'=>$record->id])}}" class="btn btn-primary btn-sm">Edit</a>
    </td>
</tr>
@endforeach
@else
<tr>
    <td colspan="7">
        <p class="text-center">No employment history can be found.</p>
    </td>
</tr>
@endif
