@extends('backend.master')
@section('page-title')
Family Relationship Type
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3>@yield('page-title')</h3>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col">
                <h4>Family Relationship Types</h4>
                @isset($results)
                @include('components.table.table',['entity'=>'familytype','deleteAction'=>$deleteAction])
                @endisset
            </div>
            <div class="col">
                <h4>{{isset($entity)?'Update':'Create'}} Family Type{{isset($entity)?': '.$entity->name:''}}</h4>
                @include('profile::partials.family-types.create-update')
            </div>
        </div>

    </div>
</div>
@endsection
@section('page-js')
@include('components.form.confirmSubmission',['entity'=>'familytype','action'=>'delete'])
@endsection
