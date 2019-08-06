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
            <div class="col-lg-7 col-md-12 col-sm-12 order-lg-0 order-sm-1 order-md-1 order-xl-0 order-xs-1">                
                @isset($results)
                <!-- @include('components.table.table',['entity'=>'position','deleteAction'=>$deleteAction,'datatable'=>true]) -->
                @include('components.table.table',['deleteAction'=>$deleteAction,'datatable'=>true])
                @endisset
            </div>
            <hr class="d-lg-none d-xl-none d-md-block d-sm-block d-xs-block">
            <div class="col-lg-5 col-md-12 col-sm-12 order-lg-1 order-sm-0 order-md-0 order-xl-1 order-xs-0">
                <h4>{{isset($entity)?'Update':'Create'}} Position{{isset($entity)?': '.$entity->name:''}}</h4>
                @include('profile::partials.positions.create-update')
            </div>
        </div>

    </div>
</div>
@endsection
@section('page-js')
@include('asset-partials.datatable')
<!-- @include('components.form.confirmDeleteOnSubmission',['entity'=>'position','action'=>'delete']) -->
<script type="text/javascript">
$(document).ready(function(){
    $('.datatable').DataTable({
        pageLength:7
    });
});

function deletetype(id){
    event.preventDefault();
    return swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonClass: 'btn btn-primary',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
        confirmButtonText: '<i class="ti ti-check"></i> Yes, I\'m sure',
        confirmButtonAriaLabel: 'Thumbs up, great!',
        cancelButtonText: '<i class="ti ti-close"></i> Nope, abort mission',
        cancelButtonAriaLabel: 'Thumbs down',
        reverseButtons:true
    }).then((result) => {
        if (result.value) {
            $(".deleteconfirm"+id).trigger('submit');
        }
    });
    }
</script>
@endsection
