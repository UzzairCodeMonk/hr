@extends('backend.master')
@section('page-title')
My Leave Applications
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3>My Leave Applications</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($results) && $results->count() > 0)
                @foreach($results as $key=>$result)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$result->type->name}}</td>
                    <td>{{$result->start_date}}</td>
                    <td>{{$result->end_date}}</td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="4" class="text-center">No records found</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
