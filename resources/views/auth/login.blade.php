@extends('auth.master')
@section('page-title')
Login
@endsection
@section('content')
<div class="card card-round card-shadowed px-50 py-30 w-400px mb-0" style="max-width: 100%">
    <img src="{{asset('images/login-logo.svg')}}" alt="" class="text-center" height="200">
    <br>
    <h5 class="text-uppercase">Login</h5>
    <form class="form-type-material" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email">{{ __('E-Mail Address') }}</label>
            <input type="text" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required autofocus>
            @if ($errors->has('email'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password">
            <label for="email">{{ __('Password') }}</label>
        </div>
        <!-- <div class="form-group flexbox">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="remember"
                    {{ old('remember') ? 'checked' : '' }}>
                <label class="custom-control-label">{{ __('Remember Me') }}</label>
            </div>
            <a class="text-muted hover-primary fs-13" href="{{ route('password.request') }}">{{ __('Forgot Your
                Password?') }}</a>
        </div> -->
        <div class="form-group">
            <button class="btn btn-bold btn-block btn-primary" type="submit">Login</button>
        </div>
    </form>
</div>
</div>



@endsection
