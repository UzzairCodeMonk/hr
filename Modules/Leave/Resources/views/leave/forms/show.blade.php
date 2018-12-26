@extends('backend.master')
@section('page-title')
Leave Application Form
@endsection
@section('content')
<a href="{{URL::previous()}}" class="btn btn-primary"><i class="ti ti-back-left"></i> Back</a>
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
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Leave Status</label>
                                <ol class="timeline timeline-activity timeline-point-sm timeline-content-right w-100 py-20 pr-20">
                                    @foreach($statuses as $status)
                                    <li class="timeline-block">
                                        <div class="timeline-point">
                                            <span class="badge badge-dot badge-lg badge-success"></span>
                                        </div>
                                        <div class="timeline-content">
                                            <time datetime="">{{Carbon\Carbon::createFromFormat('Y-m-d H:m:s',$status['created_at'])->toDayDateTimeString()}}</time>
                                            <p>{{$status->reason}}</p>
                                        </div>
                                    </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>

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
                                <label for="input-normal">{{ucwords(__('leave::leave.days-taken'))}}</label>
                                <p>{{$leave->days_taken}}</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="input-normal">{{ucwords(__('leave::leave.notes'))}}</label>
                                <p>{!! $leave->notes !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
