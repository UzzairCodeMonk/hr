@extends('backend::master')
@section('page-title')
Site Configurations
@endsection
@section('form-content')
<form action="{{route('personal.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <h3>Company Logo</h3>                   
                </div>
                <div class="col-8">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Site Logo</label>
                                <input type="file" name="avatar" id="" class="form-control">
                                <div class="badge badge-md badge-info">Existing file: {!!asset($site->logo ?? '')!!}</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-4">
                    <h3></h3>
                    <p class="help-text">
                        Company identity
                    </p>
                </div>
                <div class="col-8">
                    <input type="hidden" name="user_id" value="{{Auth::id()}}">
                    <div class="form-group">
                        <label for="">Company Name</label>
                        <input type="text" name="company_name" id="" class="form-control" value="{{ old('company_name',  isset($site->company_name) ? $site->company_name : null) }}">
                    </div>
                    <div class="form-group">
                        <label for="">Company Registration No.</label>
                        <input type="text" name="company_reg_no" id="" class="form-control" value="{{ old('company_reg_no',  isset($site->company_reg_no) ? $site->company_reg_no : null) }}">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Phone No.</label>
                                <input type="text" name="mobile_number" id="" class="form-control" value="{{old('mobile_number',isset($site->mobile_number) ? $site->mobile_number:null)}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Mobile No.</label>
                                <input type="text" name="phone_number" id="" class="form-control" value="{{old('phone_number',isset($site->phone_number)? $site->phone_number:null)}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">{{ucwords(__('profile::personal-detail.gender'))}}</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="">Please choose</option>
                                    <option value="Male"
                                        {{isset($site->gender) && $site->gender == 'Male'? 'selected':''}}>Male</option>
                                    <option value="Female"
                                        {{isset($site->gender) && $site->gender == 'Female'? 'selected':''}}>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">{{ucwords(__('profile::personal-detail.date-of-birth'))}}</label>
                                <input type="text" name="date_of_birth" id="" class="form-control date-of-birth" value="{{old('date_of_birth',isset($site->date_of_birth)? $site->date_of_birth:null)}}">
                            </div>
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">{{ucwords(__('profile::personal-detail.marital-status'))}}</label>
                                <select name="marital_status" id="marital_status" class="form-control">
                                    <option value="">Please choose</option>
                                    <option value="Single"
                                        {{isset($site->marital_status) && $site->marital_status == 'Single'? 'selected':''}}>Single</option>
                                    <option value="Married"
                                        {{isset($site->marital_status) && $site->marital_status == 'Married'? 'selected':''}}>Married</option>
                                    <option value="Widowed"
                                        {{isset($site->marital_status) && $site->marital_status == 'Widowed'? 'selected':''}}>Widowed</option>
                                    <option value="Divorced"
                                        {{isset($site->marital_status) && $site->marital_status == 'Divorced'? 'selected':''}}>Divorced</option>
                                    <option value="Seperated"
                                        {{isset($site->marital_status) && $site->marital_status == 'Seperated'? 'selected':''}}>Seperated</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">{{ucwords(__('profile::personal-detail.marriage-date'))}}</label>
                                <input type="text" name="date_of_marriage" id="date_of_marriage" class="form-control marriage-date"
                                    value="{{old('date_of_marriage',isset($site->date_of_marriage)?$site->date_of_marriage:null)}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">{{ucwords(__('profile::personal-detail.phone-number'))}}</label>
                                <input type="text" name="phone_number" id="" class="form-control" value="{{old('phone_number',isset($site->phone_number)?$site->phone_number:null)}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">{{ucwords(__('profile::personal-detail.mobile-number'))}}</label>
                                <input type="text" name="mobile_number" id="" class="form-control" value="{{old('mobile_number',isset($site->mobile_number)?$site->mobile_number:null)}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">{{ucwords(__('profile::personal-detail.alternative-email'))}}</label>
                                <input type="text" name="alternative_email" id="" class="form-control" value="{{old('alternative_email',isset($site->alternative_email)?$site->alternative_email:null)}}">
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-4">
                    <h3>{{ucwords(__('profile::personal-detail.living-place'))}}</h3>
                    <p class="help-text">
                        Fill in your current active address
                    </p>
                </div>
                <div class="col-8">
                    <div class="form-group">
                        <label for="">{{ucwords(__('profile::personal-detail.address-one'))}}</label>
                        <input type="text" name="address_one" id="" class="form-control" value="{{old('address_one',isset($site->address_one)? $site->address_one:null)}}">
                    </div>
                    <div class="form-group">
                        <label for="">{{ucwords(__('profile::personal-detail.address-two'))}}</label>
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
                <div class="col-4">
                    <h3>{{ucwords(__('profile::personal-detail.vehicle-information'))}}</h3>
                    <p class="help-text">
                        Vehicle information (leave it blank if it is not available)
                    </p>
                </div>
                <div class="col-8">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">{{ucwords(__('profile::personal-detail.motorcycle-reg-number'))}}</label>
                                <input type="text" name="motorcycle_reg_number" id="" class="form-control" value="{{old('motorcycle_reg_number',isset($site->motorcycle_reg_number)? $site->motorcycle_reg_number:null)}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">{{ucwords(__('profile::personal-detail.car-reg-number'))}}</label>
                                <input type="text" name="car_reg_number" id="" class="form-control" value="{{old('car_reg_number',isset($site->car_reg_number)? $site->car_reg_number:null)}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
