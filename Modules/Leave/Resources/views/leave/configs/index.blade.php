@extends('backend.master')
@section('page-title')
Leave Config
@endsection
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Leave Configurations
        </h3>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-4">
                <h3>Holidays</h3>
                <p class="help-text">
                    Holidays (non-working days) for each cost center.
                </p>
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add-center-modal">
                    Add Center
                </button>
            </div>
            <div class="col-8">
                <div class="form-group">
                    <label for="">Please mark the holidays for each working center</label>
                    <br>
                    @if($centers->count())
                    @foreach($centers as $center)
                    <form action="{{route('leave.config.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" value="{{$center->id}}" name="center_id">
                            <h5>{{$center->name ?? 'N/A'}}</h5>
                            @foreach($days as $day)

                            {{ Form::checkbox(
                            'days[]',
                            $day->id,
                            (in_array($day->id, $center->holidays->pluck('id')->toArray())),
                            ['class' => 'checkbox checkbox-inline']
                            )
                            }}
                            <label for="">{{$day->name ?? 'N/A'}}</label>
                            @endforeach

                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        
                    </form>
                    <form action="{{route('leave.config.destroy',['id'=>$center->id])}}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </div>
                    </form>  
                    @endforeach
                    @endif
                </div>


            </div>
        </div>

    </div>
</div>
<!-- add center -->
<div class="modal fade" id="add-center-modal" tabindex="-1" role="dialog" aria-labelledby="add-center-modal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Cost Center</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('leave.config.add')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Address Line 1</label>
                                <input type="text" name="address_one" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Address Line 2</label>
                                <input type="text" name="address_two" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Postcode</label>
                                <input type="text" name="postcode" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">City</label>
                                <input type="text" name="city" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">State</label>
                                <input type="text" name="state" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Country</label>
                                <input type="text" name="country" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Mobile Number</label>
                                <input type="text" name="mobile_number" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone_number" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Fax Number</label>
                                <input type="text" name="fax_number" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end add center -->

@endsection
