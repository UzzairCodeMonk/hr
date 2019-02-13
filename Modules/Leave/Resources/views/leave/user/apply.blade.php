@extends('backend.master')
@section('page-title')
Leave Application Form
@endsection
@section('page-css')
<style>
    .preloader{
        display: none !important;
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
            <button type="button" class="btn btn-sm btn-secondary" data-toggle="quickview" data-target="#public-holidays">View
                Public
                Holidays</button>
            <button type="button" class="btn btn-sm btn-secondary" data-toggle="quickview" data-target="#leave-balance">Your
                Leave Balance</button>
        </div>
    </div>
    <div class="card-body">
        <form action="{{route('leave.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- identity -->
            <div class="row">
                <div class="col-4">
                    <h4>Leave Information</h4>
                    <p class="text-danger">Important Notes! <br>
                        Please apply leave only by its respective dates only.Please exclude weekends and public holidays.</p>
                </div>
                <div class="col-8">
                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="user_id" value="{{Auth::id()}}">
                            <div class="form-group">
                                <label for="" class="require">{{ucwords(__('leave::leave.leave-type'))}}</label>
                                <select name="leavetype_id" id="" class="form-control">
                                    @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                                @include('backend.shared._errors',['entity'=>'leavetype_id'])
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="require">{{ucwords(__('leave::leave.start-date'))}}</label>
                                <input type="text" name="start_date" id="" class="form-control start-date" data-provide="datepicker">
                                @include('backend.shared._errors',['entity'=>'start_date'])
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="require">{{ucwords(__('leave::leave.end-date'))}}</label>
                                <input type="text" name="end_date" id="" class="form-control end-date" data-provide="datepicker">
                                @include('backend.shared._errors',['entity'=>'end_date'])
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">{{ucwords(__('leave::leave.notes'))}}</label>
                                <textarea name="notes" id="" cols="30" rows="6" class="form-control"></textarea>
                                @include('backend.shared._errors',['entity'=>'notes'])
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">{{ucwords(__('leave::leave.attachment'))}}</label>
                                <button type="button" class="btn btn-block btn-md btn-primary" onclick="document.getElementById('fileInput').click();"><i
                                        class="ti ti-files"></i> Attach your file(s) here</button>
                                <input id="fileInput" type="file" style="display:none;" name="attachments[]" multiple />
                                @include('backend.shared._errors',['entity'=>'attachments'])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary pull-right" type="submit">
                    Apply
                </button>
            </div>
        </form>

    </div>
</div>

<!-- public holiday modal -->
<div id="public-holidays" class="quickview quickview-xl">
    <header class="quickview-header">
        <p class="quickview-title">Available public holidays. Plan your leave wisely 😁</p>
        <span class="close"><i class="ti-close"></i></span>
    </header>

    <div class="quickview-body">
        <div class="quickview-block">
            <table class="table table-bordered datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Public Holiday</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($holidays as $key=>$h)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$h->name ?? 'N/Application'}}</td>
                        <td>{{Carbon\Carbon::createFromFormat('d/m/Y',$h->date)->format('d M Y') ?? 'N/A'}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="leave-balance" class="quickview quickview-xl">
    <header class="quickview-header">
        <p class="quickview-title">Your leave balance. Plan your leave wisely 😁</p>
        <span class="close"><i class="ti-close"></i></span>
    </header>

    <div class="quickview-body">
        <div class="quickview-block">
            <table class="table table-bordered datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Leave Type</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($types as $key=>$type)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$type->name ?? 'N/A'}}</td>
                        <td>@if(DB::table('leavebalances')->where('user_id',auth()->id())->where('leavetype_id',$type->id)->exists())
                                {{DB::table('leavebalances')->where('user_id',auth()->id())->where('leavetype_id',$type->id)->first()->balance}}/@endif{{$type->days}}
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
