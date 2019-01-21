@extends('profile::master')
@section('page-title')
Family Records
@endsection
@section('form-content')
<div class="container">
    <!-- @isset($family)
    @include('profile::partials.family.edit')
    @endisset -->
    <div class="row">
        <div class="col">
            @include('profile::partials.family.dynamic-form')
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
</div>
@endsection
@section('page-js')
@include('components.form.confirmDeleteOnSubmission',['entity'=>'family-bulk-delete'])
@include('profile::partials.family.script')
@endsection
