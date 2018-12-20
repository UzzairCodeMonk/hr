@extends('profile::master')
@section('page-title')
    Family Records
@endsection
@section('form-content')
<div class="container">
    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-primary btn-md pull-right" data-toggle="modal" data-target="#add-family-records">
                    <i class="ti ti-plus"></i> Add Family Record
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-bordered mt-3">
                <thead class="thead-light">
                    @include('profile::partials.family.table-header')
                </thead>
                <tbody>
                    @include('profile::partials.family.record')
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('profile::partials.family.modal-form')
@endsection
@section('page-js')
@include('profile::partials.family.script')
@endsection
