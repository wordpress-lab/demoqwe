@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')
    <div class="login_page_wrapper">
        <div class="md-card" id="login_card">
            <div class="md-card-content large-padding" id="login_form">
                <div class="login_heading">
                    <div class="user_avatar"></div>
                </div>

                <h2 class="heading_a uk-margin-medium-bottom uk-text-center">Reset your account password</h2>

                @if(session()->has('status'))
                    <div class="uk-alert" data-uk-alert>
                        <a href="" class="uk-alert-close uk-close"></a>
                        <p>{{ session('status') }}</p>
                    </div>
                @endif

                {!! Form::open(['url' => '/password/reset', 'method' => 'post']) !!}
                    <div class="uk-form-row">
                        <label for="email">Email</label>
                        <input class="md-input" id="email" name="email" value="{{ old('email') }}" type="text">
                        @if ($errors->has('email'))
                            <span class="uk-text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <input class="md-input" id="token" name="token" value="{{ $token }}" type="hidden">

                    <div class="uk-form-row">
                        <label for="password">Password</label>
                        <input class="md-input" id="password" name="password" type="password">
                        @if ($errors->has('password'))
                            <span class="uk-text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <div class="uk-form-row">
                        <label for="password_confirmation">Confirm Password</label>
                        <input class="md-input" id="password_confirmation" name="password_confirmation" type="password">
                        @if ($errors->has('password_confirmation'))
                            <span class="uk-text-danger">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>

                    <div class="uk-form-row">
                        <button type="submit" class="md-btn md-btn-primary md-btn-block md-btn-large">Reset password</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="uk-margin-top uk-text-center">
            <a href="{{ url('/login') }}">Login here</a>
        </div>
    </div>
@endsection