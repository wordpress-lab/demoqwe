@extends('layouts.main')

@section('title', 'Access Level')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')

    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-2-10 uk-width-large-2-10">
                    <div class="md-list-outside-wrapper">
                        @include('inc.settings_menu')
                    </div>
                </div>
                <div class="uk-width-xLarge-8-10  uk-width-large-8-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Change User Role</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                {!! Form::open(['url' => route('update_user_role', ['id' => $id]), 'method' => 'POST', 'files' => true]) !!}
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="password" class="uk-vertical-align-middle">Select Role</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <select id="role_id" name="role_id" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select with tooltip">
                                            <option value="">Select role</option>
                                            @foreach($roles as $role)
                                                @if($role->id == $user->role_id)
                                                    <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                                @else
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <div class="uk-width-1-1 uk-margin-bottom"></div>
                                        @if($errors->first('role_id'))
                                            <div class="uk-text-danger">Role is required!</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid">
                                    <div class="uk-width-1-1 uk-float-right">
                                        <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                        <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $('#settings_menu_users').addClass('md-list-item-active');
    </script>
@endsection