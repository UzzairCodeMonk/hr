@extends('backend.master')
@section('page-title')
Leave Application Form
@endsection
@section('page-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css">
<style>
    .fc-time {
        display: none;
    }
</style>
@endsection
@section('content')
<a href="{{URL::previous()}}" class="btn btn-primary btn-md">Back</a>
<div class="mb-3"></div>
<div class="card">
    <div class="card-header">
        <h3>Leave Application Form</h3>
        <div class="card-options">
            <label>{!! $leave->type->name ?? 'N/A' !!}</label>
            <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#leave-balance">View
                leave balance</button>
        </div>
    </div>
    <div class="card-body">
        @if(Auth::user()->hasRole('Admin'))
        <form action="{{route('leave.approve.reject',['id'=>$leave->id])}}" method="POST" class="approve-reject">
            @csrf
            @else
            <form>
                @endif
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
                                                <span class="badge badge-dot badge-lg {{statusColor($status['name']) ?? ''}}"></span>
                                            </div>
                                            <div class="timeline-content">
                                                <time datetime="">{{Carbon\Carbon::parse($status['created_at'])->toDayDateTimeString()}}</time>
                                                <p>{!!$status->reason!!}</p>
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
                                    <p>{!! $leave->user->personalDetail->name ?? 'N/A' !!}</p>
                                </div>
                            </div>
                            <div class="col">
                                <label for="">Application Date</label>
                                <p>{{Carbon\Carbon::parse($leave->created_at)->toDayDateTimeString() ?? 'N/A'}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="input-normal">{{ucwords(__('leave::leave.start-date'))}}</label>
                                    <p>{{$leave->start_date ?? 'N/A'}}</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="input-normal">{{ucwords(__('leave::leave.end-date'))}}</label>
                                    <p>{{$leave->end_date ?? 'N/A'}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="input-normal">{{ucwords(__('leave::leave.days-taken'))}}</label>
                                    <p>{{$leave->days_taken ?? 'N/A'}} {{$leave->period ? '('.$leave->period.')': ''}}</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="input-normal">{{ucwords(__('leave::leave.notes'))}}</label>
                                    <p>{!! $leave->notes ?? 'N/A'!!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">List Of Approvers</label>
                                    <ol>
                                        @foreach($leave->approvers as $approver)
                                        <li>
                                            {!! $approver->personalDetail->name ?? 'N/A' !!}
                                        </li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Absent Dates</label>
                                    @php $s = explode(',', $leave->date_series) @endphp
                                    <!-- <ol>
                                        @foreach($s as $a)
                                        <li>{{$a}}</li>
                                        @endforeach
                                    </ol> -->

                                    {!! $calendar->calendar() !!}
                                </div>
                            </div>
                        </div>
                        @if($leave->attachments->count() > 0)
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">{{ucwords(__('leave::leave.attachment'))}}</label>
                                    <ul>
                                        @foreach($leave->attachments as $attachment)
                                        <li>
                                            <a href="{{asset($attachment->filepath)}}" target="_blank" download="{{$attachment->filename}}">
                                                {{$attachment->filename}}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- @role('Admin') -->
                        @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Approver'))
                        @if($actionVisibility)
                        <div class="row">
                            <div class="col">
                                <div class="form-group">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Admin Remarks</label>
                                    <textarea name="admin_remarks" id="" cols="30" rows="6" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group pull-right">
                                    <button type="submit" name="remarks" class="btn btn-md btn-primary remarks-btn">
                                        Submit Remarks Only</button>
                                    @can('approve_leave')
                                    <button type="submit" name="approve" class="btn btn-md btn-success approve-btn"><i class="ti ti-check"></i> Approve</button>
                                    @endcan
                                    @can('reject_leave')
                                    <button type="submit" name="reject" class="btn btn-md btn-danger reject-btn"><i class="ti ti-close"></i> Reject</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        @endif
                        @endif
                        <!-- @endrole -->
                    </div>
                </div>
            </form>

    </div>
</div>
<div class="modal fade" id="leave-balance" tabindex="-1" role="dialog" aria-labelledby="leave-balance" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$leave->user->personalDetail->name}}'s Leave Balance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if($leave->user->personalDetail->status!="probation")
                <table class="table table-bordered" style="width:50%">
                    <thead>
                        <tr>
                            <th>Leave Entitlement</th>
                            <th>{{DB::table('leave_entitlements')->where('user_id',$leave->user_id)->first()->days}} days</th>
                        </tr>
                        <tr>
                            <th>Available Annual Leave</th>
                            <th>{{DB::table('leave_entitlements')->where('user_id',$leave->user_id)->first()->available_annualleave}} days</th>
                        </tr>
                        <tr>
                            <th>Available Balance Annual Leave for this month</th>
                            <th>{{$thismonth}} days</th>
                        </tr>
                    </thead>
                </table>
                @endif
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($leave->user->personalDetail->status=="probation")
                        <tr>
                            <td>1</td>
                            <td>Unpaid Leave</td>
                            <td>
                                @if(DB::table('leavebalances')->where('user_id',$leave->user_id)->where('leavetype_id',6)->exists())
                                {{DB::table('leavebalances')->where('user_id',$leave->user_id)->where('leavetype_id',6)->first()->balance}}/@endif{{30}}
                                {{str_plural('day',30)}}</td>
                        </tr>
                        @else
                        @foreach($types as $key => $type)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$type->name}}</td>
                            <td>@if(DB::table('leavebalances')->where('user_id',$leave->user_id)->where('leavetype_id',$type->id)->exists())
                                {{DB::table('leavebalances')->where('user_id',$leave->user_id)->where('leavetype_id',$type->id)->first()->balance}}/@endif{{$type->days}}
                                {{str_plural('day',$type->days)}}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js"></script>

{!! $calendar->script() !!}
@endsection