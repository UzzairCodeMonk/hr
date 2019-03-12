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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap-editable/css/bootstrap-editable.css" />
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Claim Subject: {!! $claim->subject ?? 'N/A' !!}</h3>
        <div class="card-options">
            <form action="{{route('claim.submit')}}" method="POST">
                @csrf
                <input type="hidden" name="claim_id" value="{{$claim->id}}">
                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form action="{{route('claimdetail.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- identity -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-options">
                                <h3 class="card-title">
                                    Claim Form
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <input type="hidden" name="user_id" value="{{Auth::id()}}">
                                    <input type="hidden" name="claim_id" value="{{$claim->id ?? 0}}">
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
                                        <input id="fileInput" type="file" style="display:none;" name="attachments[]"
                                            multiple />
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
            </div>
            <div class="col">
                <div class="card">
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
                                    <td>Date</td>
                                    <td>Remarks</td>
                                    <td>Attachments</td>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($claim->details as $key => $detail)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>
                                        <a href="#" id="amount" data-type="text" data-pk="{{$detail->id}}" data-url=""
                                            data-title="Enter amount" data-url="{{route('claimdetail.update', ['id'=>$detail->id])}}"
                                            data-name="amount" class="editable">
                                            {{$detail->amount}}
                                        </a></td>
                                    <td>{{$detail->date}}</td>
                                    <td>{{$detail->remarks}}</td>
                                    <td>
                                        <ul>
                                            @if($detail->attachments->count() > 0)
                                            @foreach($detail->attachments as $attachment)
                                            <li>
                                                <a href="{{url($attachment->filepath) ?? ''}}" target="_blank">
                                                    {{ $attachment->filename ?? 'No attachments available.' }}
                                                </a>
                                            </li>
                                            @endforeach
                                            @else
                                            <li>
                                                No attachments available.
                                            </li>
                                            @endif
                                        </ul>

                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" class="text-right">Total</td>
                                    <td>MYR {{$claim->amount ?? 0.00}}</td>
                                </tr>
                            </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- public holiday modal -->
@endsection
@section('page-js')
@include('asset-partials.datatable')
@include('asset-partials.datepicker')
<script src="{{asset('js/bootstrap-editable.min.js')}}"></script>
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
<script>
    $.fn.editable.defaults.mode = 'inline';
    $(document).ready(function () {
        $('.editable').editable({
            params: function (params) {
                // add additional params from data-attributes of trigger element
                params._token = '{{csrf_token()}}';
                params.name = $(this).editable().data('name');
                return params;
            },
            error: function (response, newValue) {
                if (response.status === 500) {
                    return 'Server error. Check entered data.';
                } else {
                    return response.responseText;
                    // return "Error.";
                }
            }
        });
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
