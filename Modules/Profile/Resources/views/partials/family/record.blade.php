@if(count($familyRecord))
@foreach($familyRecord as $key=> $record)
<tr>
    <td>
        {{++$key}}
    </td>
    <td>
        <p>{{$record->name}}</p>
    </td>
    <td>
        <p>{{$record->type->name}}</p>
    </td>
    <td>
        <p>{{$record->ic_number}}</p>
    </td>
    <td>
        <p>{{$record->mobile_number}}</p>
    </td>
    <td>
        <p>{{$record->occupation}}</p>
    </td>
    <td>
        <p>{{$record->income_tax_number}} </p>
    </td>
    <td>
    </td>
</tr>
@endforeach
@else
<tr>
    <td colspan="7">
        <p class="text-center">No family records can be found.</p> 
    </td>
</tr>
@endif
