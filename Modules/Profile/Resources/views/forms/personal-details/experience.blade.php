@extends('profile::master')
@section('page-title')
Employment History
@endsection
@section('form-content')
<div class="container">
    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-primary btn-md pull-right" data-toggle="modal" data-target="#add-experience-records">
                <i class="ti ti-plus"></i> Add Employment History Record
            </button>
        </div>
    </div>
    @isset($expPersonal)
    @include('profile::partials.experience.edit')
    @endisset
    <div class="row">
        <div class="col">
            <table class="table table-bordered mt-3">
                <thead class="thead-light">
                    @include('profile::partials.experience.table-header')
                </thead>
                <tbody>
                    @include('profile::partials.experience.record')
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('profile::partials.experience.modal-form')
@endsection
@section('page-js')
@include('profile::partials.experience.script')
@include('asset-partials.datepicker')
<script type="text/javascript">
    var date = new Date();
    date.setDate(date.getDate());

    $('.start-date').datepicker({
        format: "dd/mm/yyyy",
    });
    $('.end-date').datepicker({
        format: "dd/mm/yyyy",
    });

</script>
@include('asset-partials.summernote')
<script type="text/javascript">
    $(document).ready(function () {
        $('.summernote').summernote({
            toolbar: [
                // [groupName, [list of button]]                    
                ['para', ['ul', 'ol']]
            ],
            width:300
        });
    });

</script>
@endsection
