@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="login_page_wrapper">
        <div class="md-card" id="login_card">
            <div class="md-card-content large-padding" id="login_form">
                <div class="login_heading">
                    <div class="user_avatar"></div>
                </div>

                <h2 class="heading_a uk-margin-medium-bottom uk-text-center">Login to your account</h2>

                @include('inc.alert')

                {!! Form::open(['url' => 'login', 'method' => 'post']) !!}
                    <div class="uk-form-row">
                        <label for="email">Email</label>
                        <input class="md-input" id="email" name="email" value="{{ old('email') }}" type="text" selected>
                        @if ($errors->has('email'))
                            <span class="uk-text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div class="uk-form-row">
                        <label for="password">Password</label>
                        <input class="md-input" id="password" name="password" type="password">
                        @if ($errors->has('password'))
                            <span class="uk-text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <div class="uk-margin-top">
                        <a class="uk-float-right" href="{{ url('/password/reset') }}">Forgot password?</a>
                        <span class="icheck-inline">
                            <input data-md-icheck id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : ''}}>
                            <label class="inline-label" for="remember">Stay signed in</label>
                        </span>
                    </div>

                    <div class="uk-margin-medium-top">
                        <button type="submit" class="md-btn md-btn-primary md-btn-block md-btn-large">Sign In</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="uk-margin-top uk-text-center">
            <a href="{{ url('/register') }}">Create an account</a>
        </div>
    </div>
@endsection
