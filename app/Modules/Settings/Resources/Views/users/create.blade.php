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
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New User</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                {!! Form::open(['url' => route('user_store'), 'method' => 'POST', 'files' => true]) !!}
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="name" class="uk-vertical-align-middle">Name</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="name">Name</label>
                                        <input class="md-input" type="text" id="name" name="name"/>
                                        @if($errors->first('name'))
                                            <div class="uk-text-danger">Name is required.</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="image" class="uk-vertical-align-middle">Profile Picture</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <input type="file" id="image" name="image"/>
                                        @if($errors->first('file'))
                                            <div class="uk-text-danger">Image is required.</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="contact" class="uk-vertical-align-middle">Contact</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="contact">Contact</label>
                                        <input class="md-input" type="text" id="contact" name="contact"/>
                                        @if($errors->first('contact'))
                                            <div class="uk-text-danger">Contact is required.</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="note" class="uk-vertical-align-middle">Note</label>
                                    </div>
                                    <div class="uk-width-medium-4-5">
                                        <label for="note">Note</label>
                                        <textarea class="md-input" name="note" id="note" cols="30" rows="4"></textarea>
                                        @if($errors->first('note'))
                                            <div class="uk-text-danger">Note is required.</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="email" class="uk-vertical-align-middle">Email</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="email">Email</label>
                                        <input class="md-input" type="text" id="email" name="email"/>
                                        @if($errors->first('email'))
                                            <div class="uk-text-danger">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="password" class="uk-vertical-align-middle">Password</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="password">Password</label>
                                        <input class="md-input" type="password" id="password" name="password"/>
                                        @if($errors->first('password'))
                                            <div class="uk-text-danger">{{ $errors->first('password') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="confirm_password" class="uk-vertical-align-middle">Re-Type Password</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="confirm_password">Re-Type Password</label>
                                        <input class="md-input" type="password" id="confirm_password" name="confirm_password"/>
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="branch_id" class="uk-vertical-align-middle">Role</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <select id="role_id" name="role_id" data-md-selectize>
                                            <option value="">Select Role</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->first('role_id'))
                                            <div class="uk-text-danger uk-margin-top">Role is required.</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="branch_id" class="uk-vertical-align-middle">Associated Contact</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <select id="contact_id" name="contact_id" data-md-selectize>
                                            <option>Select Contact</option>
                                            @foreach($contact as $role)
                                                <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="branch_id" class="uk-vertical-align-middle">Branch</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <select id="branch_id" name="branch_id" data-md-selectize>
                                            <option>Select Branch</option>
                                            @foreach($branches as $value)
                                                <option value="{{ $value->id }}">{{ $value->branch_name }}</option>
                                            @endforeach
                                        </select>

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