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
<link rel="stylesheet" href="{{asset('css/select2-bootstrap.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
@endsection
@section('content')
<a href="{{URL::previous()}}" class="btn btn-primary btn-md">Back</a>
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
                            <div class="form-group">
                                <label for="">Approver</label>
                                <select id="users" multiple class="form-control" name="users[]"></select>
                                <p class="font-weight-bold">Existing Approvers: {{$leave->approvers->pluck('name')}}</p>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="user_id" value="{{Auth::id()}}">
                            <div class="form-group">
                                <label for="" class="require">{{ucwords(__('leave::leave.leave-type'))}}</label>
                                <select name="leavetype_id" id="" class="form-control">
                                    @foreach($types as $type)
                                    <option value="{{$type->id}}"
                                        {{isset($type) && $type->id == $leave->type->id ? 'selected':''}}>{{$type->name}}</option>
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
                        <div class="col fullDaySelector">
                            <div class="form-group">
                                <label for="" class="require">Half day or Full day?</label>
                                <select name="full_half" id="daySelector" class="form-control">
                                    <option value="">Please choose</option>
                                    <option value="1">Half Day</option>
                                    <option value="2">Full Day</option>
                                </select>
                            </div>
                        </div>
                        <div class="col periodBoxSelector">
                            <div class="form-group">
                                <label for="" class="require">Which Period?</label>
                                <select name="period" id="periodSelector" class="form-control periodSelector">
                                    <option value="">Please choose</option>
                                    <option value="morning">Morning</option>
                                    <option value="afternoon">Afternoon</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <span class="summary font-weight-bold"></span> <span id="num_nights" class="font-weight-bold"></span>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
@include('asset-partials.datepicker')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pluralize/7.0.0/pluralize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript" src="{{asset('js/leave.js')}}"></script>
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
<script>
    $('#users').select2({
        placeholder: 'Please type the approver\'s name. You may tag multiple approvers',
        ajax: {
            url: "{{route('api.users.index')}}",
            dataType: 'json',
            data: function (params) {
                return {
                    q: $.trim(params.term)
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

</script>
@endsection
