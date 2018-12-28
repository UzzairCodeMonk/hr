@extends('profile::master')
@section('page-title')
Academic Records
@endsection
@section('form-content')
<div class="container">
    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-primary btn-md pull-right" data-toggle="modal" data-target="#add-academic-records">
                <i class="ti ti-plus"></i> Add Academic Record
            </button>
        </div>
    </div>
    @isset($academy)
    @include('profile::partials.academic.edit')
    @endisset
    <div class="row">
        <div class="col">
            <table class="table table-bordered mt-3">
                <thead class="thead-light">
                    @include('profile::partials.academic.table-header')
                </thead>
                <tbody>
                    @include('profile::partials.academic.record')
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('profile::partials.academic.modal-form')

@endsection
@section('page-js')
@include('profile::partials.academic.script')
@include('asset-partials.datepicker')
<script type="text/javascript">
    var date = new Date();
    date.setDate(date.getDate());

    $('.start-date').datepicker({
        format: "{{config('app.date_format_js')}}",
    });
    $('.end-date').datepicker({
        format: "{{config('app.date_format_js')}}",
    });

</script>

@endsection
