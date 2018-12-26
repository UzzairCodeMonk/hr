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
        @if(Auth::user()->hasRole('Admin'))
        <form action="{{route('leave.approve.reject',['id'=>$leave->id])}}" method="POST" class="approve reject">
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
                                    <p>{{$leave->user->name}} (Leave Balance:
                                        {{$leave->user->leaveEntitlement->days?:'' }}
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
                        
                        <div class="row">
                            <div class="col">
                                <div class="form-group pull-right">
                                    <button type="submit" name="approve" class="btn btn-primary" value="1">Approve</button>
                                    <button type="submit" name="reject" class="btn btn-danger" value="1">Reject</button>
                                </div>
                            </div>
                        </div>
                        
                        @endrole
                    </div>
                </div>
            </form>

    </div>
</div>
@endsection
@section('page-js')
@include('asset-partials.sweetalert')
<!-- <script type="text/javascript">
    $(".approve").on("submit", function () {
        event.preventDefault();
        return swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
        }).then((result) => {
            if (result.value) {
                $(".approve").submit();
            }
        });
    });
    $(".reject").on("submit", function () {
        event.preventDefault();
        return swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
        }).then((result) => {
            if (result.value) {
                $(".reject").submit();
            }
        });
    });

</script> -->
@endsection
