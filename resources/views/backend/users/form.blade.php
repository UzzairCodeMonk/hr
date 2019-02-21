@extends('backend.master')
@section('page-title')
{!!isset($user->personalDetail->name) ? 'Update Employee':'Add Employee'!!}
@endsection
@section('content')
<a href="{{URL::previous()}}" class="btn btn-primary mb-2">Back</a>
<div class="card">
    <div class="card-header">
        <h3>{!!isset($user->personalDetail->name) ? 'Update Employee: '.$user->personalDetail->name:'Add Employee'!!}</h3>    
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
<script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/4.15.0/lodash.min.js"></script>
@include('asset-partials.select2')
@include('asset-partials.datepicker')
<script type="text/javascript">
    $(document).ready(function () {
        $('.join-date').datepicker({
            format: "{{config('app.date_format_js')}}",
        });
    });

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.select').select2({
            theme: 'bootstrap',
            placeholder: 'Please choose'
        });
    });

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
@endsection
