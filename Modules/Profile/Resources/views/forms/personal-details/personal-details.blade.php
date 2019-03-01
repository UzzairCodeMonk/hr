@extends('profile::master')
@section('page-title')
Personal Details
@endsection
@section('page-css')
<!-- Croppie css -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
<style type="text/css">
    .profile-img img {
        width: 200px;
        height: 200px;
        border-radius: 50%;
    }

</style>
@endsection
@section('form-content')
<form action="{{route('personal.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-body">           
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <h3>{{ucwords(__('profile::personal-detail.identity'))}}</h3>
                    <p class="help-text">
                        Your identity
                    </p>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <input type="hidden" name="user_id" value="{{Auth::id()}}">
                    <div class="form-group editable">
                        <label for="">{{ucwords(__('profile::personal-detail.name'))}}</label>
                        <input type="text" name="name" id="" class="" value="{!! old('name',  isset($personalDetail->name) ? $personalDetail->name : null) !!}">
                        <p class="form-text">Enter your name as in IC/Birth Certificate</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="">{{ucwords(__('profile::personal-detail.position'))}}</label>
                                <p>{!! $personalDetail->position->name ?? 'N/A' !!}</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="">{{ucwords(__('profile::personal-detail.status'))}}</label>
                                <p>{{ucwords($personalDetail->status) ?? 'N/A'}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group editable">
                                <label for="">{{ucwords(__('profile::personal-detail.ic-number'))}}</label>
                                <input type="text" name="ic_number" id="" class="" value="{{old('ic_number',isset($personalDetail->ic_number) ? $personalDetail->ic_number:null)}}">
                                <p class="form-text">Numeric, without hyphen '-'. e.g: 940214075976</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="">{{ucwords(__('profile::personal-detail.staff-no'))}}</label>
                                <p>{{old('staff_number',isset($personalDetail->staff_number)?
                                    $personalDetail->staff_number:null)}}</p>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group editable">
                                <label for="">{{ucwords(__('profile::personal-detail.gender'))}}</label>
                                <select name="gender" id="gender" class="form-control selectEditable">
                                    <option value="">Please choose</option>
                                    <option value="male"
                                        {{isset($personalDetail->gender) && $personalDetail->gender == 'male'? 'selected':''}}>Male</option>
                                    <option value="female"
                                        {{isset($personalDetail->gender) && $personalDetail->gender == 'female'? 'selected':''}}>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group editable">
                                <label for="">{{ucwords(__('profile::personal-detail.date-of-birth'))}}</label>
                                <input type="text" name="date_of_birth" id="" class="date-of-birth" value="{{old('date_of_birth',isset($personalDetail->date_of_birth)? $personalDetail->date_of_birth:null)}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group editable">
                                <label for="">{{ucwords(__('profile::personal-detail.marital-status'))}}</label>
                                <select name="marital_status" id="marital_status" class="form-control selectEditable">
                                    <option value="">Please choose</option>
                                    <option value="Single"
                                        {{isset($personalDetail->marital_status) && $personalDetail->marital_status == 'Single'? 'selected':''}}>Single</option>
                                    <option value="Married"
                                        {{isset($personalDetail->marital_status) && $personalDetail->marital_status == 'Married'? 'selected':''}}>Married</option>
                                    <option value="Widowed"
                                        {{isset($personalDetail->marital_status) && $personalDetail->marital_status == 'Widowed'? 'selected':''}}>Widowed</option>
                                    <option value="Divorced"
                                        {{isset($personalDetail->marital_status) && $personalDetail->marital_status == 'Divorced'? 'selected':''}}>Divorced</option>
                                    <option value="Seperated"
                                        {{isset($personalDetail->marital_status) && $personalDetail->marital_status == 'Seperated'? 'selected':''}}>Seperated</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="">{{ucwords(__('profile::personal-detail.marriage-date'))}}</label>
                                <input type="text" name="date_of_marriage" id="date_of_marriage" class="form-control marriage-date"
                                    value="{{old('date_of_marriage',isset($personalDetail->date_of_marriage)?$personalDetail->date_of_marriage:null)}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group editable">
                                <label for="">{{ucwords(__('profile::personal-detail.phone-number'))}}</label>
                                <input type="text" name="phone_number" id="" class="" value="{{old('phone_number',isset($personalDetail->phone_number)?$personalDetail->phone_number:null)}}">
                                <p class="form-text">Numeric, without hyphen '-'. e.g: 0312345678</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group editable">
                                <label for="">{{ucwords(__('profile::personal-detail.mobile-number'))}}</label>
                                <input type="text" name="mobile_number" id="" class="" value="{{old('mobile_number',isset($personalDetail->mobile_number)?$personalDetail->mobile_number:null)}}">
                                <p class="form-text">Numeric, without hyphen '-'. e.g: 0135637817</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group editable">
                                <label for="">{{ucwords(__('profile::personal-detail.alternative-email'))}}</label>
                                <input type="text" name="alternative_email" id="" class="" value="{{old('alternative_email',isset($personalDetail->alternative_email)?$personalDetail->alternative_email:null)}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <h3>{{ucwords(__('profile::personal-detail.living-place'))}}</h3>
                    <p class="help-text">
                        Fill in your current active address
                    </p>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="form-group editable">
                        <label for="">{{ucwords(__('profile::personal-detail.address-one'))}}</label>
                        <input type="text" name="address_one" id="" class="" value="{{old('address_one',isset($personalDetail->address_one)? $personalDetail->address_one:null)}}">
                    </div>
                    <div class="form-group editable">
                        <label for="">{{ucwords(__('profile::personal-detail.address-two'))}}</label>
                        <input type="text" name="address_two" id="" class="" value="{{old('address_two',isset($personalDetail->address_two)? $personalDetail->address_two:null)}}">
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group editable">
                                <label for="">{{ucwords(__('profile::personal-detail.city'))}}</label>
                                <input type="text" name="city" id="city" value="{{old('city',isset($personalDetail->city)? $personalDetail->city:null)}}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group editable">
                                <label for="">{{ucwords(__('profile::personal-detail.postcode'))}}</label>
                                <input type="text" name="postcode" id="" class="" value="{{old('postcode',isset($personalDetail->postcode)? $personalDetail->postcode:null)}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group editable">
                                <label for="">{{ucwords(__('profile::personal-detail.state'))}}</label>
                                <input type="text" name="state" id="" class="" value="{{old('state',isset($personalDetail->state)? $personalDetail->state:null)}}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group editable">
                                <label for="">{{ucwords(__('profile::personal-detail.country'))}}</label>
                                <input type="text" name="country" id="" class="" value="{{old('country',isset($personalDetail->country)? $personalDetail->country:null)}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <h3>Wage & Banking Information</h3>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="">{{ucwords(__('profile::personal-detail.basic-salary'))}}</label>
                                <p>{{$personalDetail->user->wages->first()->wage ?? 0.00}}</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="">Bank Name</label>
                                <p>
                                    {{$personalDetail->bank->name ?? 'N/A'}}
                                </p>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group">
                                <label for="">Bank Account Number</label>
                                <p>
                                    {{$personalDetail->bank_account_number ?? 'N/A'}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <h3>{{ucwords(__('profile::personal-detail.vehicle-information'))}}</h3>
                    <p class="help-text">
                        Vehicle information (leave it blank if it is not available)
                    </p>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group editable">
                                <label for="">{{ucwords(__('profile::personal-detail.motorcycle-reg-number'))}}</label>
                                <input type="text" name="motorcycle_reg_number" id="" class="" value="{{old('motorcycle_reg_number',isset($personalDetail->motorcycle_reg_number)? $personalDetail->motorcycle_reg_number:null)}}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group editable">
                                <label for="">{{ucwords(__('profile::personal-detail.car-reg-number'))}}</label>
                                <input type="text" name="car_reg_number" id="" class="" value="{{old('car_reg_number',isset($personalDetail->car_reg_number)? $personalDetail->car_reg_number:null)}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-md pull-right">{{isset($personalDetail) ?
                            ucwords('update'):ucwords('save')}}</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>
@include('components.form.avatar-modal')
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
<script type="text/javascript">
    $(document).ready(function () {

        let editable = $('.editable').find('input');
        let selectEditable = $('.selectEditable');
        let toggleButton = $('.editableToggle');
        let formHelp = $('.editable').find('p.form-text');
        editable.addClass('form-control-plaintext').attr('readonly', true);
        selectEditable.attr('disabled','true');
        formHelp.hide();

        toggleButton.on('click', function () {
            editable.toggleClass('form-control');
            var attrState = editable.prop('readonly');
            editable.prop('readonly', !attrState);
            var selectAttrState = selectEditable.prop('disabled');
            selectEditable.prop('disabled', !selectAttrState);
            formHelp.toggle();
            const Toast = swal.mixin({
                toast: true,
                position: 'top-right',
                showConfirmButton: false,
                timer: 3000
            });
            if (attrState) {
                Toast.fire({
                    type:'info',
                    title:'You\'ve just turn on the Edit Mode'
                });
            }else{
                Toast.fire({
                    type:'info',
                    title:'Remember to hit the Update button at the bottom to save the changes'
                }); 
            }

        });

    });

</script>
@include('components.form.upload-avatar')
@endsection
