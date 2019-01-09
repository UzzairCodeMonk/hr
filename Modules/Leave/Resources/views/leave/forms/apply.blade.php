@extends('backend.master')
@section('page-title')
Leave Application Form
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Leave Application Form</h3>
    </div>
    <div class="card-body">
        <form action="{{route('leave.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- identity -->
            <div class="row">
                <div class="col-4">
                    <h4>Leave Information</h4>
                </div>
                <div class="col-8">
                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="user_id" value="{{Auth::id()}}">
                            <div class="form-group">
                                <label for="">{{ucwords(__('leave::leave.leave-type'))}}</label>
                                <select name="leavetype_id" id="" class="form-control">
                                    @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}} || Balance:
                                        {{getUserLeaveBalance($type)}}{{$type->days}} {{str_plural('day',$type->days)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">{{ucwords(__('leave::leave.start-date'))}}</label>
                                <input type="text" name="start_date" id="" class="form-control start-date" data-provide="datepicker">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">{{ucwords(__('leave::leave.end-date'))}}</label>
                                <input type="text" name="end_date" id="" class="form-control end-date" data-provide="datepicker">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">{{ucwords(__('leave::leave.notes'))}}</label>
                                <textarea name="notes" id="" cols="30" rows="6" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">{{ucwords(__('leave::leave.attachment'))}}</label>
                                <button type="button" class="btn btn-block btn-md btn-primary" onclick="document.getElementById('fileInput').click();"><i
                                        class="ti ti-files"></i> Attach your file(s) here</button>
                                <input id="fileInput" type="file" style="display:none;" name="attachments[]" multiple />
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
@endsection
@section('page-js')
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
@endsection
