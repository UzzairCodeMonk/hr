@extends('backend.master')
@section('page-title')
{{isset($center) ? 'Update':'Create'}} Cost Center
@endsection
@section('page-css')
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
