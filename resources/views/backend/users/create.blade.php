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
            @method('PUT')
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
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" id="" class="form-control" value="{!! old('name',isset($user->name)?$user->name:null) !!}">
                            @include('backend.shared._errors',['entity'=>'name'])
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" id="" class="form-control" value="{{old('email',isset($user->email)?$user->email:'')}}">
                            @include('backend.shared._errors',['entity'=>'email'])
                        </div>
                        <div class="form-group">
                            <label for="">IC No.</label>
                            <input type="text" name="ic_number" id="" class="form-control" value="{{old('ic_number',isset($user->personalDetail->ic_number) ? $user->personalDetail->ic_number:'')}}">
                            @include('backend.shared._errors',['entity'=>'ic_number'])
                        </div>
                        <div class="form-group">
                            <label for="">Employee Status</label>
                            <select name="status" id="" class="form-control">
                                <option value="">Please choose</option>
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
                        <div class="form-group">
                            <label for="">Staff No.</label>
                            <input type="text" name="staff_number" id="" class="form-control" value="{{old('staff_number',isset($user->personalDetail->staff_number)?$user->personalDetail->staff_number:'')}}">
                            @include('backend.shared._errors',['entity'=>'staff_number'])
                        </div>
                        <div class="form-group">
                            <label for="">EPF No.</label>
                            <input type="text" name="epf_id" id="" class="form-control" value="{{old('epf_id',isset($user->personalDetail->epf_id)?$user->personalDetail->epf_id:'')}}">
                            @include('backend.shared._errors',['entity'=>'epf_id'])
                        </div>
                        <div class="form-group">
                            <label for="">SOCSO No.</label>
                            <input type="text" name="socso_id" id="" class="form-control" value="{{old('socso_id',isset($user->personalDetail->socso_id)?$user->personalDetail->socso_id:'')}}">
                            @include('backend.shared._errors',['entity'=>'socso_id'])
                        </div>
                        <div class="form-group">
                            <label for="">Position</label>
                            <select name="position_id" id="" class="form-control">
                                <option value="">Please choose</option>
                                @foreach($positions as $position)
                                <option value="{{$position->id}}"
                                    {{old('status',isset($user->personalDetail->position_id) && $user->personalDetail->position_id == $position->id ? 'selected':'')}}>{{$position->name}}</option>
                                @endforeach
                            </select>
                            @include('backend.shared._errors',['entity'=>'position_id'])
                        </div>
                        <div class="form-group">
                            <label for="">Role</label>
                            <select name="role" id="" class="form-control">
                                <option value="">Please choose</option>
                                @foreach($roles as $role)
                                <option value="{{$role->name}}"
                                    {{old('role',isset($user->roles) && $user->roles->pluck('name')->first() == $role->name ? 'selected':'')}}>{{$role->name}}</option>
                                @endforeach
                            </select>
                            @include('backend.shared._errors',['entity'=>'role'])
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" id="" class="form-control">
                            <p class="form-text">{{isset($user) ? 'Leave the password field blank if you don\'t want to
                                change':'' }}</p>
                            @include('backend.shared._errors',['entity'=>'password'])
                        </div>
                        <div class="form-group">
                            <label for="">Password Confirmation</label>
                            <input type="password" name="password_confirmation" id="" class="form-control">
                            @include('backend.shared._errors',['entity'=>'password_confirmation'])
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
