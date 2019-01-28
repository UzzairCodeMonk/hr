<div class="card bg-lighter">
    <div class="card-header">
        <h4 class="card-title text-dark">{{isset($expPersonal) ? 'Update':'Create'}} Employment History Record</h4>
        <div class="card-options">
            @isset($expPersonal)
            <a href="{{URL::previous()}}" class="btn btn-secondary btn-sm">Cancel</a>
            @endisset
            <button type="submit" class="btn btn-primary btn-sm">{{isset($expPersonal) ? 'Update':'Create'}}</button>
            <!-- <a class="btn btn-sm btn-secondary text-dark" id="addrow"> Add Row </a> -->
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <input type="hidden" name="user_id" value="{{Auth::id()}}">
                    <label for="" class="require">Company Name</label>
                    <input type="text" name="company" class="form-control" value="{{old('company',$expPersonal->company ?? null)}}" />
                    @include('backend.shared._errors',['entity'=>'company'])
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="" class="require">Position</label>
                    <input type="text" name="position" class="form-control" value="{{old('position',$expPersonal->position ?? null)}}" />
                    @include('backend.shared._errors',['entity'=>'position'])
                </div>
            </div>            
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for=""  class="require">Start Date</label>
                    <input type="text" name="start_date" class="form-control start-date" value="{{old('start_date',$expPersonal->start_date ?? null)}}" />
                    @include('backend.shared._errors',['entity'=>'start_date'])
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="" class="require">End Date</label>
                    <input type="text" name="end_date" class="form-control end-date" value="{{old('end_date',$expPersonal->start_date ?? null)}}" />
                    @include('backend.shared._errors',['entity'=>'end_date'])
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="" class="require">Description</label>
                    <textarea name="description" id="" cols="30" rows="5" class="form-control">{!! old('description',$expPersonal->description ?? null)!!}</textarea>
                    @include('backend.shared._errors',['entity'=>'description'])
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <tr>
    <td>
        1
    </td>
    <td>
        <input type="text" name="company[]" class="form-control" />
    </td>
    <td>
        <input type="text" name="position[]" class="form-control" />
    </td>
    <td>
        <input type="text" name="start_date[]" class="form-control start-date" />
    </td>
    <td>
        <input type="text" name="end_date[]" class="form-control end-date" />
    </td>
    <td>
        <textarea name="description[]" class="form-control summernote" id="" cols="30" rows="10"></textarea>
    </td>
    <td>
        <a class="deleteRow">
            <input type="button" class="btn btn-block" id="addrow" value="Add Row" />
        </a>
    </td>
</tr> -->
