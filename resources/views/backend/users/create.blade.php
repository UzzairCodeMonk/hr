@extends('backend.master')
@section('page-title')
Add Employees
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Add Employee</h3>
    </div>
    <div class="card-body">
        <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- identity -->
            <div class="row">
                <div class="col-4">
                    <h4>Employee Information</h4>
                </div>
                <div class="col-8">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" id="" class="form-control">
                        @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" id="" class="form-control">
                        @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Staff No.</label>
                        <input type="text" name="staff_number" id="" class="form-control">
                        @if ($errors->has('staff_number'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('staff_number') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Position</label>
                        <select name="position_id" id="" class="form-control">
                            @foreach($positions as $position)
                            <option value="{{$position->id}}">{{$position->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('position_id'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('position_id') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" id="" class="form-control">
                        @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Password Confirmation</label>
                        <input type="password" name="password_confirmation" id="" class="form-control">
                        @if ($errors->has('password_confirmation'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

            </div>
            <div class="form-group">
                <button class="btn btn-primary pull-right" type="submit">
                    Add
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
