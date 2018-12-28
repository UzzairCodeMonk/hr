<form action="{{route('family.update',['id'=>$family->id])}}" method="POST" enctype="multipart/form-data">
    @csrf    
<div class="row">
    <div class="col">
        <table class="table table-bordered mt-3">
            <thead class="thead-light">
                @include('profile::partials.family.table-header')
            </thead>
            <tbody>
                <tr>
                    <td>
                        1
                    </td>
                    <td>
                        <input type="hidden" name="user_id" value="{{$family->user_id ?? ''}}">
                        <input type="text" name="name" class="form-control" value="{{$family->name ?? ''}}" />
                    </td>
                    <td>
                        <select name="relationship_id" id="" class="form-control">
                            @foreach($types as $type)
                            <option value="{{$type->id}}" {{$family->relationship_id == $type->id ? 'selected':''}}>{{$type->name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" name="ic_number" class="form-control" value="{{$family->ic_number ?? ''}}" />
                    </td>
                    <td>
                        <input type="text" name="mobile_number" class="form-control" value="{{$family->mobile_number ?? ''}}" />
                    </td>
                    <td>
                        <input type="text" name="occupation" class="form-control" value="{{$family->occupation ?? ''}}" />
                    </td>
                    <td>
                        <input type="text" name="income_tax_number" class="form-control" value="{{$family->income_tax_number ?? ''}}" />
                    </td>
                    <td class="text-center">                        
                           <button type="submit" class="btn btn-primary btn-sm">Update</button>
                           <a href="{{URL::previous()}}" class="btn btn-secondary btn-sm">Cancel</a>       
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</form>