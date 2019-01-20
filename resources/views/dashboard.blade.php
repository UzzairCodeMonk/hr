@extends('backend.master')
@section('page-title')
Dashboard
@endsection
@section('page-css')
<style>
    .preloader {
        display: none !important
    }

</style>
@endsection
@section('content')
<div class="row">
    {{ AsyncWidget::run('totalEmployees') }}
    {{ AsyncWidget::run('leaveRequests') }}
    {{ AsyncWidget::run('absentees') }}
</div>
@endsection
