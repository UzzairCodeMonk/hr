<div class="form-group">
    <label for="">Basic Salary</label>
    <!-- <div class='card card-light' style="border:1px solid block !important;">
        <div class='card-header'>
            <h6 class="card-title" style="font-weight:bold">Basic Salary (MYR)</h6>
            <div class="card-options">
                <button type="button" class="btn btn-primary btn-sm">Add basic salary</button>
            </div>
        </div>
        <div class='card-body'>
            <div class="table-responsive">
                <table class="table table-bordered dynamic-list">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Entitlement Date</th>
                            <th>Salary</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><input type="text" name="date" class="form-control datepicker"></td>
                            <td><input type="text" name="salary" class="form-control"></td>
                            <td><textarea name="" id="" cols="30" rows="3" class="form-control"></textarea></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> -->
    <input type="text" class="form-control" name="basic_salary" value="{{old('basic_salary',isset($user)?$user->wages->first()->wage:'')}}">
</div>
<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="">Bank Name</label>
            <select name="bank_id" id="" class="form-control select">
                <option></option>
                @foreach($banks as $b)
                <option value="{{$b->id}}"
                    {{old('bank_id',isset($user->personalDetail->bank_id) && $user->personalDetail->bank_id == $b->id ? 'selected':'')}}>{{$b->name}}</option>
                @endforeach
            </select>
            @include('backend.shared._errors',['entity'=>'bank_id'])
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="">Bank Account No.</label>
            <input type="text" name="bank_account_number" id="" class="form-control" value="{{old('bank_account_number',isset($user->personalDetail->bank_account_number)?$user->personalDetail->bank_account_number:'')}}">            
            @include('backend.shared._errors',['entity'=>'bank_account_number'])
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="">EPF No.</label>
            <input type="text" name="epf_id" id="" class="form-control" value="{{old('epf_id',isset($user->personalDetail->epf_id)?$user->personalDetail->epf_id:'')}}">
            @include('backend.shared._errors',['entity'=>'epf_id'])
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="">SOCSO No.</label>
            <input type="text" name="socso_id" id="" class="form-control" value="{{old('socso_id',isset($user->personalDetail->socso_id)?$user->personalDetail->socso_id:'')}}">
            @include('backend.shared._errors',['entity'=>'socso_id'])
        </div>
    </div>
</div>
