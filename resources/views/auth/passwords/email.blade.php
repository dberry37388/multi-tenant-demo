@extends('layouts.auth')

@section('content')
    <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}" class="login-form">
        @csrf

        @component('components.card')
            @slot('title')
                <div class="text-center">
                    <img src="{{ asset('images/goplogo.jpg') }}" alt="" width="200px">
                </div>

                <div class="text-center mt-2">
                    <h1 class="card-title">Forgot Your Password?</h1>
                    <h6 class="text-muted">we can help with that.</h6>
                </div>
            @endslot

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

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

                <div class="form-group row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </div>

                <div class="text-center">
                    <a href="{{ route('login') }}">{{ __('Sign In') }}</a>
                    <span class="ml-1 mr-1">|</span>
                    <a href="{{ route('register') }}">{{ __('Create Account') }}</a>
                </div>
        @endcomponent
    </form>
@endsection
