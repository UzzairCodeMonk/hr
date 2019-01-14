@extends('backend.master')
@section('page-title')
{!!isset($user->personalDetail->name) ? 'Update Employee':'Add Employee'!!}
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3>{!!isset($user->personalDetail->name) ? 'Update Employee: '.$user->personalDetail->name:'Add Employee'!!}</h3>
    </div>
    <div class="card-body">
        @if(isset($user))
        <form action="{{route('user.update',['id'=>$user->id])}}" method="POST" enctype="multipart/form-data">
            @else
            <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
                @endif
                @csrf
                <!-- identity -->
                <div class="row">
                    <div class="col-4">
                        <h4>Employee Information</h4>
                    </div>
                    <div class="col-8">
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
                                    <option value="male" {{old('gender',isset($user->personalDetail->gender) && $user->personalDetail->gender == 'male' ? 'selected':'')}}>Male</option>
                                    <option value="female" {{old('gender',isset($user->personalDetail->gender) && $user->personalDetail->gender == 'female' ? 'selected':'')}}>Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">IC No.</label>
                                    <input type="text" name="ic_number" id="" class="form-control" value="{{old('ic_number',isset($user->personalDetail->ic_number) ? $user->personalDetail->ic_number:'')}}">
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
                                    <input type="password" name="password" id="" class="form-control">
                                    <p class="form-text">{{isset($user) ? 'Leave the password field blank if you don\'t
                                        want to
                                        change':'' }}</p>
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
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <h4>Wage & Banking Information</h4>
                    </div>
                    <div class="col-8">
                        <div class="form-group">
                            <label for="">Basic Salary (MYR)</label>
                            <input type="text" class="form-control" name="basic_salary" value="{{$user->wages->first()->wage ?? 0.00}}">
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Bank Name</label>
                                    <select name="bank_id" id="" class="form-control select">
                                        <option></option>
                                        @foreach($banks as $b)
                                        <option value="{{$b->id}}" {{old('bank_id',isset($user->personalDetail->bank_id) && $user->personalDetail->bank_id == $b->id ? 'selected':'')}}>{{$b->name}}</option>
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

                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary pull-right" type="submit">
                        {{isset($user)? 'Update':'Add'}}
                    </button>
                </div>
            </form>
    </div>
</div>
@endsection
@section('page-js')
<script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/4.15.0/lodash.min.js"></script>
@include('asset-partials.select2')
@include('asset-partials.datepicker')
<script type="text/javascript">
    $(document).ready(function () {
        $('.join-date').datepicker({
            format: "{{config('app.date_format_js')}}",
        });
    });

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.select').select2({
            theme: 'bootstrap',
            placeholder: 'Please choose'
        });
    });

</script>
@endsection
