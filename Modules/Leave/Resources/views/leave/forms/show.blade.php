@extends('backend.master')
@section('page-title')
Leave Application Form
@endsection
@section('content')
<a href="{{route('leave.index')}}" class="btn btn-primary"><i class="ti ti-back-left"></i> Back</a>
<div class="mb-3"></div>
<div class="card">
    <div class="card-header">
        <h3>Leave Application Form</h3>
    </div>
    <div class="card-body">
        <form>
            
            <!-- identity -->
            <div class="row">
                <div class="col-4">
                    <h4>Leave Information</h4>
                </div>
                <div class="col-8">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Applicant</label>
                                <p>{{$leave->user->name}} (Leave Balance: {{$leave->user->leaveEntitlement->days?:'' }}
                                    {{str_plural('day',$leave->user->leaveEntitlement->days)}})</p>
                            </div>
                        </div>
                        <div class="col">
                            <label for="">Application Date</label>
                            <p>{{Carbon\Carbon::parse($leave->created_at)->toDayDateTimeString()}}</p>
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="input-normal">{{ucwords(__('leave::leave.start-date'))}}</label>
                                <p>{{$leave->start_date}}</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="input-normal">{{ucwords(__('leave::leave.end-date'))}}</label>
                                <p>{{$leave->end_date}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="input-normal">{{ucwords(__('leave::leave.notes'))}}</label>
                                <p>{!! $leave->notes !!}</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">{{ucwords(__('leave::leave.attachment'))}}</label>
                                <ul>
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection
@section('page-js')

@endsection
