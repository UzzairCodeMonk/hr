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
                    Holidays (non-working days) for each cost center.
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
                        <div class="form-group">
                            <input type="hidden" value="{{$center->id}}" name="center_id">
                            <h5>{{$center->name ?? 'N/A'}}</h5>
                            @foreach($days as $day)

                            {{ Form::checkbox(
                            'days[]',
                            $day->id,
                            (in_array($day->id, $center->holidays->pluck('id')->toArray())),
                            ['class' => 'checkbox checkbox-inline']
                            )
                            }}
                            <label for="">{{$day->name ?? 'N/A'}}</label>
                            @endforeach

                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </div>
                    </form>
                    @endforeach
                    @endif
                </div>


            </div>
        </div>

    </div>
</div>


@endsection
