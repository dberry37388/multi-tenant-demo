@extends('layouts.auth')

@section('content')
    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Reset Password') }}" class="login-form">
        @csrf

        @component('components.card')
            @slot('title')
                <div class="text-center">
                    <img src="{{ asset('images/goplogo.jpg') }}" alt="" width="200px">
                </div>

                <div class="text-center mt-2">
                    <h1 class="card-title">Create your {{ config('app.name') }}.</h1>
                </div>
            @endslot

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input id="name" name="name" placeholder="{{ _('Name') }}" type="text"
                           class="form-control form-control-lg{{ $errors->has('name') ? ' is-invalid' : '' }}"
                           required autofocus>
                    <div class="form-control-feedback form-control-feedback-lg">
                        <i class="icon-user"></i>
                    </div>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input id="email" name="email" placeholder="{{ _('Email Address') }}" type="email"
                           class="form-control form-control-lg{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           required autofocus>
                    <div class="form-control-feedback form-control-feedback-lg">
                        <i class="icon-mail5"></i>
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

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input id="password_confirmation" name="password_confirmation" placeholder="{{ _('Confirm Password') }}" type="password"
                           class="form-control form-control-lg{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                           required autofocus>
                    <div class="form-control-feedback form-control-feedback-lg">
                        <i class="icon-lock2"></i>
                    </div>

                    @if ($errors->has('password_confirmation'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            {{ __('Create Account') }}
                        </button>
                    </div>
                </div>

                <div class="text-center">
                    <a href="{{ route('password.request') }}">{{ __('Forgot Password') }}</a>
                    <span class="ml-1 mr-1">|</span>
                    <a href="{{ route('login') }}">{{ __('Sign in instead') }}</a>
                </div>
        @endcomponent
    </form>
@endsection
