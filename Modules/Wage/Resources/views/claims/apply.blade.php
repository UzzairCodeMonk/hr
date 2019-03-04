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
            <div class="card card-secondary">
                <div class="card-body">
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
                    <div class="form-group">
                        <button class="btn btn-primary pull-right submit-btn" type="submit">
                            Create
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <hr>
        <div class="card bg-lightest">
            <div class="card-header">
                <h3 class="card-title">
                    Claim Records
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Claim</td>
                            <td>Status</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Claim</td>
                            <td>Status</td>
                            <td>Claim</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
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

<!-- <script type="text/javascript">
    $(document).ready(function () {
        let inputs = $('.send-check');
        $('.submit-btn').append('Create');
        inputs.attr('checked', false);
        inputs.on('click', function () {
    
            if (checked != elm.checked) {
                inputs.;
            }
        });

    });

</script> -->
@endsection
