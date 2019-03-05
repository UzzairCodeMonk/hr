@extends('backend.master')
@section('page-title')
Leave Calendar View
@endsection
@section('page-css')
<style>
    .preloader {
        display: none !important;
    }

</style>
<link rel="stylesheet" href="{{asset('css/fullcalendar.min.css')}}">
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Calendar
        </h3>
    </div>
    <div class="card-body">
        <div id="calendar"></div>
    </div>
</div>
<!--/.main-content -->
@section('page-js')
<script src="{{asset('js/fullcalendar.min.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script>
    $(document).ready(function () {
        $('#calendar').fullCalendar();
    });
</script>

@endsection

@endsection
