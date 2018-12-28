@if(count($familyRecord))
@foreach($familyRecord as $key=> $record)
<tr>
    <td>
        {{++$key}}
    </td>
    <td>
        <p>{{$record->name ?? 'N/A'}}</p>
    </td>
    <td>
        <p>{{$record->type->name ?? 'N/A'}}</p>
    </td>
    <td>
        <p>{{$record->ic_number ?? 'N/A'}}</p>
    </td>
    <td>
        <p>{{$record->mobile_number ?? 'N/A'}}</p>
    </td>
    <td>
        <p>{{$record->occupation ?? 'N/A'}}</p>
    </td>
    <td>
        <p>{{$record->income_tax_number ?? 'N/A'}} </p>
    </td>
    <td class="text-center">
        <a href="{{route('family.edit',['id'=>$record->id])}}" class="btn btn-primary btn-sm">Edit</a>
    </td>
</tr>
@endforeach
@else
<tr>
    <td colspan="9">
        <p class="text-center">No family records can be found.</p> 
    </td>
</tr>
@endif
