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
            <div class="col">
                <h4>Leave Categories</h4>
                @isset($results)
                @include('components.table.table',['entity'=>'leaveType','deleteAction'=>$deleteAction])
                @endisset
            </div>
            <div class="col">
                <h4>{{isset($entity)?'Update':'Create'}} Leave Category{{isset($entity)?': '.$entity->name:''}}</h4>
                @include('leave::type.partials.create-update')
            </div>
        </div>

    </div>
</div>
@endsection
@section('page-js')
@include('components.form.confirmDeleteOnSubmission',['entity'=>'leaveType','action'=>'delete'])
@endsection
