<div class="card bg-lighter">
    <div class="card-header">
        <h4 class="card-title text-dark">{{isset($family) ? 'Update':'Create'}} Family Record</h4>
        <div class="card-options">
            @isset($family)
            <a href="{{URL::previous()}}" class="btn btn-secondary btn-sm">Cancel</a>
            @endisset
            <button type="submit" class="btn btn-primary btn-sm">{{isset($family) ? 'Update':'Create'}}</button>
            <!-- <a class="btn btn-sm btn-secondary text-dark" id="addrow"> Add Row </a> -->
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <input type="hidden" name="user_id" value="{{Auth::id()}}">
                    <label for="" class="require">Name</label>
                    <input type="text" name="name" class="form-control" value="{{old('name',$family->name ?? null)}}" />
                    @include('backend.shared._errors',['entity'=>'name'])
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="" class="require">Relationship</label>
                    <select name="relationship_id" id="" class="form-control">
                        <option value="">Please choose</option>
                        @foreach($types as $type)
                        <option value="{{$type->id}}" {{ isset($family) && $family->relationship_id == $type->id ? 'selected':'' }} {{ old("relationship_id") == $type->id ? "selected":"" }}>
                            {{$type->name}}</option>
                        @endforeach
                    </select>
                    @include('backend.shared._errors',['entity'=>'relationship_id'])
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="" class="require">IC No.</label>
                    <input type="text" name="ic_number" class="form-control" value="{{old('ic_number',$family->ic_number ?? null)}}" />
                    @include('backend.shared._errors',['entity'=>'ic_number'])
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">Mobile No.</label>
                    <input type="text" name="mobile_number" class="form-control" value="{{old('mobile_number',$family->mobile_number ?? null)}}" />
                    @include('backend.shared._errors',['entity'=>'mobile_number'])
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Occupation</label>
                    <input type="text" name="occupation" class="form-control" value="{{old('occupation',$family->occupation ?? null)}}" />
                    @include('backend.shared._errors',['entity'=>'occupation'])
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Income Tax No.</label>
                    <input type="text" name="income_tax_number" class="form-control" value="{{old('income_tax_number',$family->income_tax_number ?? null)}}" />
                    @include('backend.shared._errors',['entity'=>'income_tax_number'])
                </div>
            </div>
        </div>
    </div>
</div>
