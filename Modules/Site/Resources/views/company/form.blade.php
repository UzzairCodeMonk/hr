@extends('backend.master')
@section('page-title')
{{isset($center) ? 'Update':'Create'}} Cost Center
@endsection
@section('page-css')
<style>
    .switch {
  font-size: 1rem;
  position: relative;
}
.switch input {
  position: absolute;
  height: 1px;
  width: 1px;
  background: none;
  border: 0;
  clip: rect(0 0 0 0);
  clip-path: inset(50%);
  overflow: hidden;
  padding: 0;
}
.switch input + label {
  position: relative;
  min-width: calc(calc(2.375rem * .8) * 2);
  border-radius: calc(2.375rem * .8);
  height: calc(2.375rem * .8);
  line-height: calc(2.375rem * .8);
  display: inline-block;
  cursor: pointer;
  outline: none;
  user-select: none;
  vertical-align: middle;
  text-indent: calc(calc(calc(2.375rem * .8) * 2) + .5rem);
}
.switch input + label::before,
.switch input + label::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: calc(calc(2.375rem * .8) * 2);
  bottom: 0;
  display: block;
}
.switch input + label::before {
  right: 0;
  background-color: #dee2e6;
  border-radius: calc(2.375rem * .8);
  transition: 0.2s all;
}
.switch input + label::after {
  top: 2px;
  left: 2px;
  width: calc(calc(2.375rem * .8) - calc(2px * 2));
  height: calc(calc(2.375rem * .8) - calc(2px * 2));
  border-radius: 50%;
  background-color: white;
  transition: 0.2s all;
}
.switch input:checked + label::before {
  background-color: #08d;
}
.switch input:checked + label::after {
  margin-left: calc(2.375rem * .8);
}
.switch input:focus + label::before {
  outline: none;
  box-shadow: 0 0 0 0.2rem rgba(0, 136, 221, 0.25);
}
.switch input:disabled + label {
  color: #868e96;
  cursor: not-allowed;
}
.switch input:disabled + label::before {
  background-color: #e9ecef;
}
.switch.switch-sm {
  font-size: 0.875rem;
}
.switch.switch-sm input + label {
  min-width: calc(calc(1.9375rem * .8) * 2);
  height: calc(1.9375rem * .8);
  line-height: calc(1.9375rem * .8);
  text-indent: calc(calc(calc(1.9375rem * .8) * 2) + .5rem);
}
.switch.switch-sm input + label::before {
  width: calc(calc(1.9375rem * .8) * 2);
}
.switch.switch-sm input + label::after {
  width: calc(calc(1.9375rem * .8) - calc(2px * 2));
  height: calc(calc(1.9375rem * .8) - calc(2px * 2));
}
.switch.switch-sm input:checked + label::after {
  margin-left: calc(1.9375rem * .8);
}
.switch.switch-lg {
  font-size: 1.25rem;
}
.switch.switch-lg input + label {
  min-width: calc(calc(3rem * .8) * 2);
  height: calc(3rem * .8);
  line-height: calc(3rem * .8);
  text-indent: calc(calc(calc(3rem * .8) * 2) + .5rem);
}
.switch.switch-lg input + label::before {
  width: calc(calc(3rem * .8) * 2);
}
.switch.switch-lg input + label::after {
  width: calc(calc(3rem * .8) - calc(2px * 2));
  height: calc(calc(3rem * .8) - calc(2px * 2));
}
.switch.switch-lg input:checked + label::after {
  margin-left: calc(3rem * .8);
}
.switch + .switch {
  margin-left: 1rem;
}

body {
  padding: 1rem;
}

.dropdown-menu {
  margin-top: .75rem;
}

</style>
@endsection
@section('content')

<form action="{{isset($center) ? route('company.update',['id'=>$center->id]):route('company.store') }}" method="POST"
    enctype="multipart/form-data">
    {{isset($center) ? method_field('PUT'):null}}
    @csrf
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{isset($center) ? 'Update':'Create'}} Cost Center</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <h3>Company Address</h3>
                    <p class="help-text">
                        Fill in the current active address
                    </p>
                </div>
                <div class="col-8">
                    <div class="form-group">
                        <span class="switch">
                            <label for="">Set this cost center as 'active'?</label>
                            <select name="status" id="" class="form-control">
                                <option value="">Please choose</option>
                                <option value="1" {{isset($center) && $center->status == 1 ? 'selected':null}}>Yes</option>
                                <option value="0" {{isset($center) && $center->status == 0 ? 'selected':null}}>No</option>
                            </select>
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" id="" class="form-control" value="{{old('name',isset($center->name)? $center->name:null)}}">
                    </div>
                    <div class="form-group">
                        <label for="">Address 1</label>
                        <input type="text" name="address_one" id="" class="form-control" value="{{old('address_one',isset($center->address_one)? $center->address_one:null)}}">
                    </div>
                    <div class="form-group">
                        <label for="">Company address 2</label>
                        <input type="text" name="address_two" id="" class="form-control" value="{{old('address_two',isset($center->address_two)? $center->address_two:null)}}">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">{{ucwords(__('profile::personal-detail.city'))}}</label>
                                <input type="text" name="city" id="" class="form-control" value="{{old('city',isset($center->city)? $center->city:null)}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">{{ucwords(__('profile::personal-detail.postcode'))}}</label>
                                <input type="text" name="postcode" id="" class="form-control" value="{{old('postcode',isset($center->postcode)? $center->postcode:null)}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">{{ucwords(__('profile::personal-detail.state'))}}</label>
                                <input type="text" name="state" id="" class="form-control" value="{{old('state',isset($center->state)? $center->state:null)}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">{{ucwords(__('profile::personal-detail.country'))}}</label>
                                <input type="text" name="country" id="" class="form-control" value="{{old('country',isset($center->country)? $center->country:null)}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Phone No.</label>
                                <input type="text" name="phone_number" id="" class="form-control" value="{{old('phone_number',isset($center->phone_number)? $center->phone_number:null)}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Mobile No.</label>
                                <input type="text" name="mobile_number" id="" class="form-control" value="{{old('mobile_number',isset($center->mobile_number) ? $center->mobile_number:null)}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Fax No.</label>
                                <input type="text" name="fax_number" id="" class="form-control" value="{{old('fax_number',isset($center->fax_number)?$center->fax_number:null)}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" name="email" id="" class="form-control" value="{{old('email',isset($center->email)? $center->email:null)}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <div class="form-group pull-right">
                        <button type="submit" class="btn btn-primary btn-md">{{isset($center) ?
                            ucwords('update'):ucwords('save')}}</button>
                        <a href="{{route('company.index')}}" class="btn btn-secondary btn-md">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('page-js')

@endsection
