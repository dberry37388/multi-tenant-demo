@extends('layouts.auth')

@section('content')
    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}" class="login-form">
        @csrf

        @component('components.card')
            @slot('title')
                <div class="text-center">
                    <img src="{{ asset('images/ccgoplogo.jpeg') }}" alt="" width="200px">
                </div>

                <div class="text-center mt-2">
                    <h1 class="card-title">Sign In</h1>
                    <h6 class="text-muted">with your {{ config('app.name') }} account.</h6>
                </div>
            @endslot

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input id="email" name="email" placeholder="{{ _('Email Address') }}" type="email"
                           class="form-control form-control-lg{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           required autofocus>
                    <div class="form-control-feedback form-control-feedback-lg">
                        <i class="icon-user"></i>
                    </div>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input id="password" name="password" placeholder="{{ _('Password') }}" type="password"
                           class="form-control form-control-lg{{ $errors->has('password') ? ' is-invalid' : '' }}"
                           required autofocus>
                    <div class="form-control-feedback form-control-feedback-lg">
                        <i class="icon-lock2"></i>
                    </div>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            {{ __('Login') }}
                        </button>
                    </div>
                </div>

                <div class="text-center">
                    <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                    <span class="ml-1 mr-1">|</span>
                    <a href="{{ route('register') }}">{{ __('Create Account') }}</a>
                </div>
        @endcomponent
    </form>
@endsection
