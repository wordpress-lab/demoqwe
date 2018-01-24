@extends('layouts.auth')

@section('title', 'Reset password')

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

                {!! Form::open(['url' => '/password/email', 'method' => 'post']) !!}
                    <div class="uk-form-row">
                        <label for="email">Email</label>
                        <input class="md-input" id="email" name="email" value="{{ old('email') }}" type="text">
                        @if ($errors->has('email'))
                            <span class="uk-text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div class="uk-margin-medium-top">
                        <button type="submit" class="md-btn md-btn-primary md-btn-block md-btn-large">Send Password Reset Link</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="uk-margin-top uk-text-center">
            <a href="{{ url('/login') }}">Back to login page</a>
        </div>
    </div>
@endsection

