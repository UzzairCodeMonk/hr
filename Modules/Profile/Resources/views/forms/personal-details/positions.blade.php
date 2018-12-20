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
            <div class="col">
                <h4>Position Categories</h4>
                @isset($results)
                @include('components.table.table',['entity'=>'position','deleteAction'=>$deleteAction])
                @endisset
            </div>
            <div class="col">
                <h4>{{isset($entity)?'Update':'Create'}} Position{{isset($entity)?': '.$entity->name:''}}</h4>
                @include('profile::partials.positions.create-update')
            </div>
        </div>

    </div>
</div>
@endsection
@section('page-js')
@include('components.form.confirmSubmission',['entity'=>'position','action'=>'delete'])
@endsection
