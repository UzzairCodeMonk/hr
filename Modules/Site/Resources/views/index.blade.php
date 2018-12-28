@extends('backend.master')
@section('page-title')
Site Configurations
@endsection
@section('content')
<form action="{{route('siteconfig.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Site Configurations</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <h3>Corporate Identity</h3>                    
                </div>
                <div class="col-8">                    
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <img src="{{asset($site->logo ?? '')}}" alt="" width="300px" class="img-thumbnail">
                                <br><br>
                                <label for="">Site Logo</label>
                                <input type="file" name="logo" id="" class="form-control">
                                <div class="badge badge-md badge-info">Existing file: {!!asset($site->logo ?? '')!!}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Company Name</label>
                                <input type="text" name="company_name" id="" class="form-control" value="{{ old('company_name',  isset($site->company_name) ? $site->company_name : null) }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Company Registration No.</label>
                                <input type="text" name="company_reg_no" id="" class="form-control" value="{{ old('company_reg_no',  isset($site->company_reg_no) ? $site->company_reg_no : null) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Phone No.</label>
                                <input type="text" name="phone_number" id="" class="form-control" value="{{old('phone_number',isset($site->phone_number)? $site->phone_number:null)}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Mobile No.</label>
                                <input type="text" name="mobile_number" id="" class="form-control" value="{{old('mobile_number',isset($site->mobile_number) ? $site->mobile_number:null)}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Fax No.</label>
                                <input type="text" name="fax_number" id="" class="form-control" value="{{old('fax_number',isset($site->fax_number)?$site->fax_number:null)}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" name="email" id="" class="form-control" value="{{old('email',isset($site->email)? $site->email:null)}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Facebook</label>
                                <input type="text" name="facebook" id="" class="form-control" value="{{old('facebook',isset($site->facebook)?$site->facebook:null)}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Gmail</label>
                                <input type="text" name="gmail" id="" class="form-control" value="{{old('gmail',isset($site->gmail)? $site->gmail:null)}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Twitter</label>
                                <input type="text" name="twitter" id="" class="form-control" value="{{old('twitter',isset($site->twitter)?$site->twitter:null)}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Linkedin</label>
                                <input type="text" name="linkedin" id="" class="form-control" value="{{old('linkedin',isset($site->linkedin)? $site->linkedin:null)}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-4">
                    <h3>Company Address</h3>
                    <p class="help-text">
                        Fill in your current active address
                    </p>
                </div>
                <div class="col-8">
                    <div class="form-group">
                        <label for="">Company address 1</label>
                        <input type="text" name="address_one" id="" class="form-control" value="{{old('address_one',isset($site->address_one)? $site->address_one:null)}}">
                    </div>
                    <div class="form-group">
                        <label for="">Company address 2</label>
                        <input type="text" name="address_two" id="" class="form-control" value="{{old('address_two',isset($site->address_two)? $site->address_two:null)}}">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">{{ucwords(__('profile::personal-detail.city'))}}</label>
                                <input type="text" name="city" id="" class="form-control" value="{{old('city',isset($site->city)? $site->city:null)}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">{{ucwords(__('profile::personal-detail.postcode'))}}</label>
                                <input type="text" name="postcode" id="" class="form-control" value="{{old('postcode',isset($site->postcode)? $site->postcode:null)}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">{{ucwords(__('profile::personal-detail.state'))}}</label>
                                <input type="text" name="state" id="" class="form-control" value="{{old('state',isset($site->state)? $site->state:null)}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">{{ucwords(__('profile::personal-detail.country'))}}</label>
                                <input type="text" name="country" id="" class="form-control" value="{{old('country',isset($site->country)? $site->country:null)}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg pull-right">{{isset($site) ?
                            ucwords('update'):ucwords('save')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('page-js')
@include('asset-partials.datepicker')
<script type="text/javascript">
    $(document).ready(function () {
        $("#date_of_marriage").prop("disabled", true);
        $("#marital_status").change(function () {
            if ($(this).val() === "Married") {
                $("#date_of_marriage").prop("disabled", false);
            } else {
                $("#date_of_marriage").prop("disabled", true);
            }
        });

    });

</script>
<script type="text/javascript">
    $('.marriage-date').datepicker({
        format: "{{config('app.date_format_js')}}",
    });
    $('.date-of-birth').datepicker({
        format: "{{config('app.date_format_js')}}",
    });

</script>
@endsection
