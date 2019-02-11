@extends('backend.master')
@section('page-title')
Leave Config
@endsection
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Leave Configurations
        </h3>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-4">
                <h3>Holidays</h3>
                <p class="help-text">
                    Holidays for each cost center.
                </p>
            </div>
            <div class="col-8">

                <div class="form-group">
                    <label for="">Please mark the holidays for each working center</label>
                    <br>
                    @if($centers->count())
                    @foreach($centers as $center)
                    <form action="{{route('leave.config.store')}}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$center->id}}" name="center_id" >
                        <ul style="float:left">
                            <li style="list-style:none">
                                <h5>{{$center->name ?? 'N/A'}}</h5>
                            </li>
                            <ul style="list-style:none">
                                @foreach($days as $day)
                                <li><input type="checkbox" value="{{$day->id}}" name="days[]"> {{$day->name ?? 'N/A'}}</li>
                                @endforeach
                            </ul>
                        </ul>
                        <button type="submit">Submit</button>
                    </form>
                    @endforeach
                    @endif
                </div>


            </div>
        </div>

    </div>
</div>


@endsection
