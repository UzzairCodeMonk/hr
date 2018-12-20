@extends('backend.master')
@section('content')
@include('profile::partials.profile.header')
<div class="card">
    <div class="card-header">
        <h3>@yield('page-title')</h3>
    </div>
    <div class="card-body">
        @if(Request::is('profile/security*'))
        @include('profile::partials.security.menu')
        @endif        
        @if(Request::is('profile/personal-details*'))
        @include('profile::partials.profile.menu')
        @endif
        @include('profile::partials.profile.personal-details-content')
    </div>
</div>
@endsection
