@extends('backend.master')
@section('page-title')
{!!isset($user->personalDetail->name) ? 'Update Employee':'Add Employee'!!}
@endsection
@section('page-css')
<style>
    .preloader {
        display: none !important;
    }

</style>
<link rel="stylesheet" href="{{asset('css/select2-bootstrap.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
@endsection
@section('content')
<a href="{{URL::previous()}}" class="btn btn-primary mb-2">Back</a>
<div class="card">
    <div class="card-header">
        <h3>{!!isset($user->personalDetail->name) ? 'Update Employee: '.$user->personalDetail->name:'Add Employee'!!}
        </h3>
    </div>
    <div class="card-body">
        @if(isset($user))
        <form action="{{route('user.update',['id'=>$user->id])}}" method="POST" enctype="multipart/form-data">
            @else
            <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
                @endif
                @csrf
                <!-- identity -->
                <div class="row">
                    <div class="col-4">
                        <h4>Employee Information</h4>
                    </div>
                    <div class="col-8">
                        @include('backend.users._identity')
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <h4>Wage & Banking Information</h4>
                    </div>
                    <div class="col-8">
                        @include('backend.users._wage-banking')
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h4>Approvers</h4>
                    </div>
                    <div class="col-8">
                        @include('backend.users._approvers')
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary pull-right" type="submit">
                        {{isset($user)? 'Update':'Add'}}
                    </button>
                </div>
            </form>
    </div>
</div>
@endsection
@section('page-js')
@include('asset-partials.datepicker')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pluralize/7.0.0/pluralize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.join-date, .datepicker').datepicker({
            format: "{{config('app.date_format_js')}}",
        });
    });

</script>
<script>

</script>
<script>
    $(document).ready(function () {
        var counter = 2;

        $("#addrow").on("click", function () {
            var newRow = $("<tr>");
            var cols = "";
            cols += '<td>' + counter + '</td>';
            cols += '<td><input type="text" class="form-control" name="skill[]" /></td>';
            cols += '<td><input type="text" class="form-control" name="period[]" /></td>';
            cols +=
                '<td><input type="button" class="ibtnDel btn btn-block btn-danger " value="Remove"></td>';
            newRow.append(cols);
            $("table.dynamic-list").append(newRow);
            counter++;
        });

        $("table.dynamic-list").on("click", ".ibtnDel", function (event) {
            $(this).closest("tr").remove();
            counter -= 1
        });
    });

</script>
<script type="text/javascript">
    $('.select').select2();
</script>
<script type="text/javascript">
    $(document).ready(function () {

        $('#employee_status').ready(function () {
            if ($('#employee_status :selected').val() == 'resigned') {
                $('.resignation_date').show();
            } else {
                $('.resignation_date').hide();
            }
        })
        $('#employee_status').on('change', function () {
            if ($('#employee_status :selected').val() == 'resigned') {
                $('.resignation_date').show();
            } else {
                $('.resignation_date').hide();
            }
        });
    });

</script>
<script>
    $('#leaves, #claims').select2({
        placeholder: 'Please type the approver\'s name. You may tag multiple approvers',
        multiple: true,
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

    var leaveApproversSelect = $('#leaves');
    var claimApproversSelect = $('#claims');
    @isset($user)
    $.ajax({
        type: 'GET',
        url: "{{route('user.leave-approvers',['id'=>$user->id])}}",
    }).then(function (data) {
        console.log(data);
        // create the option and append to Select2
        data.map(function (approver) {
            var option = new Option(approver.name, approver.id, true, true);

            leaveApproversSelect.append(option).trigger('change');

            leaveApproversSelect.trigger({
                type: 'select2:select',
                params: {
                    data: approver
                }
            });
        });
    });

    $.ajax({
        type: 'GET',
        url: "{{route('user.claim-approvers',['id'=>$user->id])}}",
    }).then(function (data) {
        console.log(data);
        // create the option and append to Select2
        data.map(function (approver) {
            var option = new Option(approver.name, approver.id, true, true);

            claimApproversSelect.append(option).trigger('change');

            claimApproversSelect.trigger({
                type: 'select2:select',
                params: {
                    data: approver
                }
            });
        });
    });
    @endisset

</script>
@endsection
