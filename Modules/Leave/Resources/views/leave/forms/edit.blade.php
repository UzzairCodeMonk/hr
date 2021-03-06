@extends('backend.master')
@section('page-title')
Leave Application Form
@endsection
@section('page-css')
<style>
    .preloader{
        display:none !important
    }
</style>
@endsection
@section('content')
<div class="mb-3"></div>
<div class="card">
    <div class="card-header">
        <h3>Leave Application Update Form</h3>
        <div class="card-options">
            <button type="button" class="btn btn-sm btn-info">{!! $leave->type->name ?? 'N/A' !!}</button>
            <button type="button" class="btn btn-sm btn-secondary" data-toggle="quickview" data-target="#leave-balance">View
                leave balance</button>
        </div>
    </div>
    <div class="card-body">
        <form action="{{route('my-leave.update',['id' => $leave->id])}}" method="POST">
            @csrf
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
                            <input type="hidden" name="user_id" value="{{Auth::id()}}">
                            <div class="form-group">
                                <label for="" class="require">{{ucwords(__('leave::leave.leave-type'))}}</label>
                                <select name="leavetype_id" id="" class="form-control">
                                    @foreach($types as $type)
                                    <option value="{{$type->id}}" {{isset($type) && $type->id == $leave->type->id ? 'selected':''}}>{{$type->name}}</option>
                                    @endforeach
                                </select>
                                @include('backend.shared._errors',['entity'=>'leavetype_id'])
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">                                
                                <label for="input-normal">{{ucwords(__('leave::leave.start-date'))}}</label>
                                <input type="text" class="form-control start-date" name="start_date" id="" value="{{$leave->start_date ?? ''}}"
                                    data-provide="datepicker">
                                @include('backend.shared._errors',['entity'=>'start_date'])
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="input-normal">{{ucwords(__('leave::leave.end-date'))}}</label>
                                <input type="text" name="end_date" class="form-control end-date" id="" data-provide="datepicker"
                                    value="{{$leave->end_date ?? ''}}">
                                @include('backend.shared._errors',['entity'=>'end_date'])
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
                                <label for="">{{ucwords(__('leave::leave.attachment'))}}</label>
                                @if($leave->attachments->count() > 0)
                                <ul>
                                    @foreach($leave->attachments as $attachment)
                                    <li>
                                        <a href="{{asset($attachment->filepath)}}" target="_blank" download="{{$attachment->filename}}">
                                            {{$attachment->filename}}
                                        </a>
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>
                                <button type="button" class="btn btn-md btn-primary" onclick="document.getElementById('fileInput').click();"><i
                                        class="ti ti-files"></i> Attach your file(s) here</button>
                                <input id="fileInput" type="file" style="display:none;" name="attachments[]" multiple />
                                @include('backend.shared._errors',['entity'=>'attachments'])
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="input-normal">{{ucwords(__('leave::leave.notes'))}}</label>
                                <textarea name="notes" id="" cols="30" rows="6" class="form-control">
{!!$leave->notes??'N/A'!!}</textarea>
                                @include('backend.shared._errors',['entity'=>'notes'])
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-md pull-right">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
<div id="leave-balance" class="quickview quickview-xl">
    <header class="quickview-header">
        <p class="quickview-title">{{$leave->user->personalDetail->name ?? 'N/A'}}'s Leave Balance</p>
        <span class="close"><i class="ti-close"></i></span>
    </header>

    <div class="quickview-body">
        <div class="quickview-block">
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
@endsection
@section('page-js')
@include('asset-partials.datatable')
@include('asset-partials.datepicker')
<script type="text/javascript">
    var date = new Date();
    date.setDate(date.getDate());
    $('.start-date').datepicker({
        format: "{{config('app.date_format_js')}}",
        startDate: date
    });
    $('.end-date').datepicker({
        format: "{{config('app.date_format_js')}}",
        startDate: date
    });

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.datatable').DataTable();
    });

</script>
@endsection
