@extends('profile::master')
@section('page-title')
    Skills 
@endsection
@section('form-content')
<div class="container">
    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-primary btn-md pull-right" data-toggle="modal" data-target="#add-skill-records">
                <i class="ti ti-plus"></i> Add Skills
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-bordered mt-3">
                <thead class="thead-light">
                    @include('profile::partials.skills.table-header')
                </thead>
                <tbody>
                    @include('profile::partials.skills.record')
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('profile::partials.skills.modal-form')
@endsection
@section('page-js')
@include('profile::partials.skills.script')
@endsection
