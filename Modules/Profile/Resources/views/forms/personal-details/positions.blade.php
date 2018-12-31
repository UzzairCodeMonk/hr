@extends('backend.master')
@section('page-title')
Position Categories
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3>@yield('page-title')</h3>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-7">                
                @isset($results)
                @include('components.table.table',['entity'=>'position','deleteAction'=>$deleteAction,'datatable'=>true])
                @endisset
            </div>
            <div class="col-5">
                <h4>{{isset($entity)?'Update':'Create'}} Position{{isset($entity)?': '.$entity->name:''}}</h4>
                @include('profile::partials.positions.create-update')
            </div>
        </div>

    </div>
</div>
@endsection
@section('page-js')
@include('asset-partials.datatable')
@include('components.form.confirmDeleteOnSubmission',['entity'=>'position','action'=>'delete'])
<script type="text/javascript">
$(document).ready(function(){
    $('.datatable').DataTable({
        pageLength:7
    });
});
</script>
@endsection
