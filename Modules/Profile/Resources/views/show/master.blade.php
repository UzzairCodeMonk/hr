@extends('backend.master')
@section('page-title')
{{$personalDetail->name.'\'s Profile'}}
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            {{$personalDetail->name.'\'s Profile'}}
        </h3>
        <div class="card-options">
            <a href="{{route('employee.resume',['id'=>$personalDetail->user_id])}}" target="_blank" class="btn btn-link btn-sm btn-primary pull-right text-white">View as resume</a>
        </div>
    </div>
    <div class="card-body">
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#personal-detail">Personal Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#family-records">Family Records</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#academic-records">Academic Records</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#employment-records">Employment History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#skill-records">Skill Records</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#award-records">Award Records</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade active show" id="personal-detail">
                    @include('profile::show.partials.personal-detail')
                </div>
                <div class="tab-pane fade" id="family-records">
                    @include('profile::show.partials.family')
                </div>
                <div class="tab-pane fade" id="academic-records">
                    @include('profile::show.partials.academic')
                </div>
                <div class="tab-pane fade" id="employment-records">
                    @include('profile::show.partials.experience')
                </div>
                <div class="tab-pane fade" id="skill-records">
                    @include('profile::show.partials.skill')
                </div>
                <div class="tab-pane fade" id="award-records">
                    @include('profile::show.partials.award')
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
