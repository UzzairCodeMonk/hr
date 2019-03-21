@extends('backend.master')
@section('content')
@include('profile::partials.profile.header')
<div class="card">
    <div class="card-header">
        <h3>@yield('page-title')</h3>
        @if(is_active('personal.index'))
        <div class="card-options">
            <label class="switch switch-xl">
                <input type="checkbox" class="editableToggle">
                <span class="switch-indicator"></span>
                <span class="switch-description">Click to switch on Edit Mode</span>
            </label>
        </div>
        @endif
    </div>
    <div class="card-body">
        @if(Request::is('profile/security*'))
        @include('profile::partials.security.menu')
        @endif
        @if(Request::is('profiles/personal-details*'))
        @include('profile::partials.profile.menu')
        @endif
        @include('profile::partials.profile.personal-details-content')
    </div>
</div>
@endsection
