@if(count($skills))
<form action="{{route('family.bulkdelete')}}" method="POST" class="skill-bulk-delete">
    <button type="submit" class="btn btn-sm btn-danger pull-right">Delete Selected</button>
    <div class="mt-4"></div>
    @csrf
    @method('DELETE')
    @foreach($skills as $key=> $record)
    <tr>
        <td>
            <input type="checkbox" name="ids[]" class="record-checkbox" value="{{$record->id}}">
        </td>
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
            <a href="{{route('skill.edit',['id'=>$record->id])}}" class="btn btn-link btn-sm text-dark">Edit</a>
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
