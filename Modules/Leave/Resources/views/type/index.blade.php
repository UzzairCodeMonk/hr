@extends('backend.master')
@section('page-title')
Leave Categories
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3>@yield('page-title')</h3>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-lg-7 col-md-12 col-sm-12 order-lg-0 order-sm-1 order-md-1 order-xl-0 order-xs-1">
                @isset($results)
                @include('components.table.table',['entity'=>'leaveType','deleteAction'=>$deleteAction,'datatable'=>true])
                @endisset
            </div>
            <hr class="d-lg-none d-xl-none d-md-block d-sm-block d-xs-block">
            <div class="col-lg-5 col-md-12 col-sm-12 order-lg-1 order-sm-0 order-md-0 order-xl-1 order-xs-0">
                <h4>{{isset($entity)?'Update':'Create'}} Leave Category{{isset($entity) ? ': '.$entity->name:''}}</h4>
                @include('leave::type.partials.create-update')
            </div>
        </div>

    </div>
</div>
@endsection
@section('page-js')
@include('asset-partials.datatable')
@include('components.form.confirmDeleteOnSubmission',['entity'=>'leaveType','action'=>'delete'])
<script>
    $(document).ready(function () {
        $('.datatable').DataTable({
            pageLength: 7,
            
        });
    });

</script>
@endsection
