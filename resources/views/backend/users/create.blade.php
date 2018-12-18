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
        <form action="{{route('leave.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- identity -->
            <div class="row">
                <div class="col-4">
                    <h4>Employee Information</h4>
                </div>
                <div class="col-8">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Staff No.</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Position</label>
                        <select name="" id="" class="form-control">
                            @foreach($positions as $position)
                            <option value="{{$position->id}}">{{$position->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Password Confirmation</label>
                        <input type="password" name="" id="" class="form-control">
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
