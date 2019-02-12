@extends('backend.master')
@section('page-title')
Leave Application Form
@endsection
@section('content')
<a href="{{URL::previous()}}" class="btn btn-primary btn-md">Back</a>
<div class="mb-3"></div>
<div class="card">
    <div class="card-header">
        <h3>Leave Application Form</h3>
        <div class="card-options">
            <button type="button" class="btn btn-sm btn-info">{!! $leave->type->name ?? 'N/A' !!}</button>
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
                                    <p>{{$leave->days_taken ?? 'N/A'}}</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="input-normal">{{ucwords(__('leave::leave.notes'))}}</label>
                                    <p>{!! $leave->notes ?? 'N/A'!!}</p>
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
                        @role('Admin')
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
                                    <button type="submit" name="remarks" class="btn btn-md btn-primary remarks-btn"> Submit Remarks Only</button>
                                    <button type="submit" name="approve" class="btn btn-md btn-success approve-btn"><i
                                            class="ti ti-check"></i> Approve</button>
                                    <button type="submit" name="reject" class="btn btn-md btn-danger reject-btn"><i
                                            class="ti ti-close"></i> Reject</button>
                                    <a href="{{URL::previous()}}" class="btn btn-md btn-primary"><i class="ti ti-back-left"></i>
                                        Back</a>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endrole
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
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($types as $key => $type)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$type->name}}</td>
                            <td>@if(DB::table('leavebalances')->where('user_id',$leave->user_id)->where('leavetype_id',$type->id)->exists())
                                {{DB::table('leavebalances')->where('user_id',$leave->user_id)->where('leavetype_id',$type->id)->first()->balance}}/@endif{{$type->days}}
                                {{str_plural('day',$type->days)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
