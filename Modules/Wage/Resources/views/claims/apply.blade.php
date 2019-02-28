@extends('backend.master')
@section('page-title')
Claim Form
@endsection
@section('page-css')
<style>
    .preloader{
        display: none !important;
    }
</style>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Claim Submission Form</h3>
    </div>
    <div class="card-body">
        <form action="{{route('claim.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- identity -->
            <div class="row">
                <div class="col-4">
                    <h4>Claim Information</h4>
                </div>
                <div class="col-8">
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" name="send" id="defaultCheck1">
                                <label class="form-check-label" for="">
                                    Tick this box to submit this claim to Admin upon creation.
                                </label>
                            </div>
                        </div>                       
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="user_id" value="{{Auth::id()}}">
                            <div class="form-group">
                                <label for="" class="require">Claim Type</label>
                                <select name="claimtype_id" id="" class="form-control">
                                    @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                                @include('backend.shared._errors',['entity'=>'claimtype_id'])
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="require">Date</label>
                                <input type="text" name="date" id="" class="form-control date" data-provide="datepicker">
                                @include('backend.shared._errors',['entity'=>'date'])
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="require">Amount (MYR)</label>
                                <input type="text" name="amount" id="" class="form-control">
                                @include('backend.shared._errors',['entity'=>'amount'])
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Remarks</label>
                                <textarea name="remarks" id="" cols="30" rows="6" class="form-control"></textarea>
                                @include('backend.shared._errors',['entity'=>'remarks'])
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Attachments</label>
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
                    Create
                </button>
            </div>
        </form>

    </div>
</div>

<!-- public holiday modal -->
@endsection
@section('page-js')
@include('asset-partials.datatable')
@include('asset-partials.datepicker')
<script type="text/javascript">
    $('.date').datepicker({
        format: "{{config('app.date_format_js')}}",
    });

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.datatable').DataTable();
    });

</script>
@endsection
