<div class="row">
    <div class="col-4">        
        <img src="{{!empty($personalDetail->avatar) ? asset($personalDetail->avatar):''}}" alt="" width="200px" class="img-thumbnail">
    </div>
    <div class="col-8">
        <div class="form-group">
            <label for="">{{ucwords(__('profile::personal-detail.name'))}}</label>
            <p>{{ old('name', isset($personalDetail->name) ? $personalDetail->name : 'N/A') }}</p>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">{{ucwords(__('profile::personal-detail.ic-number'))}}</label>
                    <p>{{old('ic_number',isset($personalDetail->ic_number) ?
                        $personalDetail->ic_number:'N/A')}}</p>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">{{ucwords(__('profile::personal-detail.staff-no'))}}</label>
                    <p>{{old('staff_number',isset($personalDetail->staff_number)?
                        $personalDetail->staff_number:'N/A')}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">{{ucwords(__('profile::personal-detail.gender'))}}</label>
                    <p>{{old('gender',isset($personalDetail->gender)?$personalDetail->gender:'N/A')}}</p>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">{{ucwords(__('profile::personal-detail.date-of-birth'))}}</label>
                    <p>{{old('date_of_birth',isset($personalDetail->date_of_birth)?
                        Carbon\Carbon::parse($personalDetail->date_of_birth)->format('d/m/Y'):'N/A')}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">{{ucwords(__('profile::personal-detail.ic-number'))}}</label>
                    <p>{{old('ic_number',isset($personalDetail->ic_number) ?
                        $personalDetail->ic_number:'N/A')}}</p>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">{{ucwords(__('profile::personal-detail.staff-no'))}}</label>
                    <p>{{old('staff_number',isset($personalDetail->staff_number)?
                        $personalDetail->staff_number:'N/A')}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">{{ucwords(__('profile::personal-detail.marital-status'))}}</label>
                    <p>{{old('marital_status',isset($personalDetail->marital_status)?
                        $personalDetail->marital_status:'N/A')}}</p>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">{{ucwords(__('profile::personal-detail.marriage-date'))}}</label>
                    <p>{{old('date_of_marriage',isset($personalDetail->date_of_marriage)?
                            Carbon\Carbon::parse($personalDetail->date_of_marriage)->format('d/m/Y'):'N/A')}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">{{ucwords(__('profile::personal-detail.alternative-email'))}}</label>
                    <p>{{old('email',isset($personalDetail->alternative_email)?$personalDetail->alternative_email:'N/A')}}</p>
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
            
        </p>
    </div>
    <div class="col-8">
        <div class="form-group">
            <label for="">{{ucwords(__('profile::personal-detail.address-one'))}}</label>
            <p> {!! old('address_one',isset($personalDetail->address_one)?
                $personalDetail->address_one:'N/A')!!}</p>
        </div>
        <div class="form-group">
            <label for="">{{ucwords(__('profile::personal-detail.address-two'))}}</label>
            <p>{!! old('address_two',isset($personalDetail->address_two)?
                $personalDetail->address_two:'N/A')!!}</p>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">{{ucwords(__('profile::personal-detail.city'))}}</label>
                    <p>{{old('city',isset($personalDetail->city)? $personalDetail->city:'N/A')}}</p>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">{{ucwords(__('profile::personal-detail.postcode'))}}</label>
                    <p>{{old('postcode',isset($personalDetail->postcode)?
                        $personalDetail->postcode:'N/A')}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">{{ucwords(__('profile::personal-detail.state'))}}</label>
                    <p>{{old('state',isset($personalDetail->state)? $personalDetail->state:'N/A')}}</p>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">{{ucwords(__('profile::personal-detail.country'))}}</label>
                    <p>{{old('country',isset($personalDetail->country)? $personalDetail->country:'N/A')}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-4">
        <h3>{{ucwords(__('profile::personal-detail.vehicle-information'))}}</h3>
    </div>
    <div class="col-8">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">{{ucwords(__('profile::personal-detail.motorcycle-reg-number'))}}</label>
                    <p>{{old('motorcycle_reg_number',isset($personalDetail->motorcycle_reg_number)?
                        $personalDetail->motorcycle_reg_number:'N/A')}}</p>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">{{ucwords(__('profile::personal-detail.car-reg-number'))}}</label>
                    <p>{{old('car_reg_number',isset($personalDetail->car_reg_number)?
                        $personalDetail->car_reg_number:'N/A')}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
