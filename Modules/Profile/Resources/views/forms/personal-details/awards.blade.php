@extends('profile::master')
@section('page-title')
Award Records
@endsection
@section('form-content')
<div class="container">
    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-primary btn-md pull-right" data-toggle="modal" data-target="#add-award-records">
                <i class="ti ti-plus"></i> Add Award Record(s)
            </button>
        </div>
    </div>
    @isset($award)
    @include('profile::partials.awards.edit')
    @endisset
    <div class="row">
        <div class="col">
            <table class="table table-bordered mt-3">
                <thead class="thead-light">
                    @include('profile::partials.awards.table-header')
                </thead>
                <tbody>
                    @include('profile::partials.awards.record')
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('profile::partials.awards.modal-form')
@endsection
@section('page-js')
@include('profile::partials.awards.script')
@include('asset-partials.datepicker')
<script type="text/javascript">
    $('.received-date').datepicker({
        format: "dd/mm/yyyy",
    });
</script>
@endsection
