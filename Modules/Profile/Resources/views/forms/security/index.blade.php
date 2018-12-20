@extends('profile::master')
@section('page-title')
Security
@endsection
@section('form-content')
<div class="card">
    <div class="card-body">
        <form action="{{route('reset.password')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-4">
                    <h3>{{ucwords(__('profile::security.reset-password'))}}</h3>
                    <p class="help-text">
                        Leave this blank if you don't want to change your pasword
                    </p>
                </div>
                <div class="col-8">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">{{ucwords(__('profile::security.new-password'))}}</label>
                                <input type="password" name="password" id="" class="form-control" value="">
                            </div>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">{{ucwords(__('profile::security.new-password-confirmation'))}}</label>
                                <input type="password" name="password_confirmation" id="" class="form-control" value="">
                            </div>
                            @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg pull-right">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>

@endsection
@section('page-js')
<script type="text/javascript">
    $(document).ready(function () {
        $("#date_of_marriage").prop("disabled", true);
        $("#marital_status").change(function () {
            if ($(this).val() === "Married") {
                $("#date_of_marriage").prop("disabled", false);
            } else {
                $("#date_of_marriage").prop("disabled", true);
            }
        });

    });

</script>
@endsection
