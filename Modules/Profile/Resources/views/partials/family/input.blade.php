<tr>
    <td>
        1
    </td>
    <td>
        <input type="hidden" name="user_id[]" value="{{Auth::id()}}">
        <input type="text" name="name[]" class="form-control" />
    </td>
    <td>
        <select name="relationship_id[]" id="" class="form-control">
            @foreach($types as $type)
                <option value="{{$type->id}}" >{{$type->name}}</option>
            @endforeach
        </select>    
    </td>
    <td>
        <input type="text" name="ic_number[]" class="form-control" />
    </td>
    <td>
        <input type="text" name="mobile_number[]" class="form-control" />
    </td>
    <td>
        <input type="text" name="occupation[]" class="form-control" />
    </td>
    <td>
        <input type="text" name="income_tax_number[]" class="form-control" />
    </td>
    <td>
        <a class="deleteRow">
            <input type="button" class="btn btn-block" id="addrow" value="Add Row" />
        </a>
    </td>
</tr>
