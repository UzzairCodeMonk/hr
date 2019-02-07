<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="input-required" class="require">Name</label>
            <input type="text" name="name" id="" class="form-control" value="{!! old('name',isset($user->name)?$user->name:null) !!}">
            @include('backend.shared._errors',['entity'=>'name'])
        </div>
    </div>
    <div class="col">
        <label for="">Gender</label>
        <select name="gender" id="" class="form-control select">
            <option></option>
            <option value="male"
                {{old('gender',isset($user->personalDetail->gender) && $user->personalDetail->gender == 'male' ? 'selected':'')}}>Male</option>
            <option value="female"
                {{old('gender',isset($user->personalDetail->gender) && $user->personalDetail->gender == 'female' ? 'selected':'')}}>Female</option>
        </select>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="">IC No.</label>
            <input type="text" name="ic_number" id="" class="form-control" value="{{old('ic_number',isset($user->personalDetail->ic_number) ? $user->personalDetail->ic_number:'')}}">
            <p class="form-text">Without hypen '-', e.g: 910213050987</p>
            @include('backend.shared._errors',['entity'=>'ic_number'])
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="input-required" class="require">Email</label>
            <input type="text" name="email" id="" class="form-control" value="{{old('email',isset($user->email)?$user->email:'')}}">
            @include('backend.shared._errors',['entity'=>'email'])
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="">Staff No.</label>
            <input type="text" name="staff_number" id="" class="form-control" value="{{old('staff_number',isset($user->personalDetail->staff_number)?$user->personalDetail->staff_number:'')}}">
            @include('backend.shared._errors',['entity'=>'staff_number'])
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="">Join Date</label>
            <input type="text" name="join_date" id="" class="form-control join-date" value="{{old('join_date',isset($user->personalDetail->join_date)?$user->personalDetail->join_date:'')}}">
            @include('backend.shared._errors',['entity'=>'join_date'])
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="input-required" class="require">Password</label>
            <input type="password" name="password" id="password" class="form-control">
            <!-- @include('password-strength::password-meter') -->
            <p class="form-text">{{isset($user) ? 'Leave the password field blank if you don\'t
                want to change':'' }}</p>

            @include('backend.shared._errors',['entity'=>'password'])

        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="input-required" class="require">Password Confirmation</label>
            <input type="password" name="password_confirmation" id="" class="form-control">
            @include('backend.shared._errors',['entity'=>'password_confirmation'])
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="input-required" class="require">Position</label>
            <select name="position_id" id="" class="form-control select">
                <option></option>
                @foreach($positions as $position)
                <option value="{{$position->id}}"
                    {{old('status',isset($user->personalDetail->position_id) && $user->personalDetail->position_id == $position->id ? 'selected':'')}}>{{$position->name}}</option>
                @endforeach
            </select>
            @include('backend.shared._errors',['entity'=>'position_id'])
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="">Employee Status</label>
            <select name="status" id="" class="form-control select">
                <option></option>
                <option value="contract"
                    {{old('status',isset($user->personalDetail->status) && $user->personalDetail->status == 'contract' ? 'selected':'')}}>Contract</option>
                <option value="internship"
                    {{old('status',isset($user->personalDetail->status) && $user->personalDetail->status == 'internship' ? 'selected':'')}}>Internship</option>
                <option value="permanent"
                    {{old('status',isset($user->personalDetail->status) && $user->personalDetail->status == 'permanent' ? 'selected':'')}}>Permanent</option>
                <option value="probation"
                    {{old('status',isset($user->personalDetail->status) && $user->personalDetail->status == 'probation' ? 'selected':'')}}>Probation</option>
                <option value="resigned"
                    {{old('status',isset($user->personalDetail->status) && $user->personalDetail->status == 'resigned' ? 'selected':'')}}>Resigned</option>
            </select>
            @include('backend.shared._errors',['entity'=>'status'])
        </div>
    </div>
</div>
<div class="form-group">
    <label for="">Role</label>
    {!! Form::select('roles[]', $roles, isset($user) ? $user->roles->pluck('id')->toArray()
    : null, ['class' => 'form-control select', 'multiple']) !!}
    @include('backend.shared._errors',['entity'=>'role'])
</div>
