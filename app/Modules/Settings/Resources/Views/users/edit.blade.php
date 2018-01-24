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
                                <h2 class="heading_b"><span class="uk-text-truncate">Update User</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                {!! Form::open(['url' => route('user_update', ['id' => $user->id]), 'method' => 'POST', 'files' => true]) !!}
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="name" class="uk-vertical-align-middle">Name</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="name">Name</label>
                                        <input class="md-input" type="text" id="name" name="name" value="{{ $user->name }}"/>
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
                                        <div class="uk-width-1-1 uk-margin-bottom">
                                            <div class="uk-thumbnail-mini">
                                                <img src="{{ url('uploads/users/'.$user->image) }}" alt="">
                                            </div>
                                        </div>
                                        <input type="file" id="image" name="image"/>
                                        @if($errors->first('image'))
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
                                        <input class="md-input" type="text" id="contact" name="contact" value="{{ $user->contact }}"/>
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
                                        <textarea class="md-input" name="note" id="note" cols="30" rows="4">{{ $user->note }}</textarea>
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
                                        <input class="md-input" type="text" id="email" name="email" value="{{ $user->email }}"/>

                                        @if($errors->first('email'))
                                            <div class="uk-text-danger">{{ $errors->first('email') }}</div>
                                        @endif

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
                                                @if($role->id == $user->role_id)
                                                    <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                                @else
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endif
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
                                            <option value="">Select Contact</option>
                                            @foreach($contact as $role)
                                                @if($role->id == $user->contact_id)
                                                    <option value="{{ $role->id }}" selected>{{ $role->display_name }}</option>
                                                @else
                                                    <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                                @endif
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