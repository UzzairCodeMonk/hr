<div class="card bg-lighter">
    <div class="card-header">
        <h4 class="card-title text-dark">Add Family Record</h4>
        <div class="card-options">
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
            <!-- <a class="btn btn-sm btn-secondary text-dark" id="addrow"> Add Row </a> -->
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <input type="hidden" name="user_id" value="{{Auth::id()}}">
                    <label for="" class="require">Name</label>
                    <input type="text" name="name" class="form-control" value="{{old('name')}}" />
                    @include('backend.shared._errors',['entity'=>'name'])
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="" class="require">Relationship</label>
                    <select name="relationship_id" id="" class="form-control">
                        <option value="">Please choose</option>
                        @foreach($types as $type)
                        <option value="{{$type->id}}" {{old('type_id') == $type->id ? 'selected':''}}>{{$type->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="" class="require">IC No.</label>
                    <input type="text" name="ic_number" class="form-control" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">Mobile No.</label>
                    <input type="text" name="mobile_number" class="form-control" />
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Occupation</label>
                    <input type="text" name="occupation" class="form-control" />
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Income Tax No.</label>
                    <input type="text" name="income_tax_number" class="form-control" />
                </div>
            </div>
        </div>
    </div>
</div>
