@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <div class="login_page_wrapper">
        <div class="md-card" id="login_card">
            <div class="md-card-content large-padding" id="login_form">
                <div class="login_heading">
                    <div class="user_avatar"></div>
                </div>

                <h2 class="heading_a uk-margin-medium-bottom uk-text-center">Create a new account</h2>

                @include('inc.alert')

                {!! Form::open(['url' => 'register', 'method' => 'post']) !!}
                    <div class="uk-form-row">
                        <label for="name">Name</label>
                        <input class="md-input" id="name" name="name" value="{{ old('name') }}" type="text">
                        @if ($errors->has('name'))
                            <span class="uk-text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="uk-form-row">
                        <label for="email">Email</label>
                        <input class="md-input" id="email" name="email" value="{{ old('email') }}" type="text">
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

                    <div class="uk-form-row">
                        <label for="password_confirmation">Confirm Password</label>
                        <input class="md-input" id="password_confirmation" name="password_confirmation" type="password">
                        @if ($errors->has('password_confirmation'))
                            <span class="uk-text-danger">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>

                    <div class="uk-form-row">
                        <h5 class="uk-text-center">By registering, you agree to the privacy policy and terms of service.</h5>
                    </div>

                    <div class="uk-form-row">
                        <button type="submit" class="md-btn md-btn-primary md-btn-block md-btn-large">Accept & Continue</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="uk-margin-top uk-text-center">
            <a href="{{ url('/login') }}">Login here</a>
        </div>
    </div>
@endsection
