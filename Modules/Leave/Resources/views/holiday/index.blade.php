@extends('backend.master')
@section('page-title')
Public Holidays
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3>@yield('page-title')</h3>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col">
                <h4>Public Holidays</h4>
                @isset($results)
                @include('components.table.table',['entity'=>'holiday','deleteAction'=>$deleteAction,'datatable'=>true])
                @endisset
            </div>
            <div class="col">
                <h4>{{isset($entity)?'Update':'Create'}} Public Holiday {{isset($entity)?': '.$entity->name:''}}</h4>
                @include('leave::holiday.partials.create-update')
            </div>
        </div>

    </div>
</div>
@endsection
@section('page-js')
@include('asset-partials.datatable')
@include('components.form.confirmDeleteOnSubmission',['entity'=>'holiday','action'=>'delete'])
@include('asset-partials.datepicker')
<script type="text/javascript">
    $('.date').datepicker({
        format: "{{config('app.date_format_js')}}",
    });
    $('.datatable').DataTable();
</script>
@endsection
