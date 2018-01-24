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
                        @include('inc.my_profile_menu')
                    </div>
                </div>
                <div class="uk-width-xLarge-8-10  uk-width-large-8-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Update General Information</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                {!! Form::open(['url' => route('my_profile_update'), 'method' => 'POST', 'files' => true]) !!}
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
                                                @if($user->image == 'user.jpg')
                                                <img src="{{ url('admin/assets/img/avatars/user-2.png') }}">
                                                @else
                                                <img src="{{ url('uploads/users/'.$user->image) }}" alt="">
                                                @endif
                                            </div>
                                        </div>
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
                                            <div class="uk-text-danger">Email is required.</div>
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
        $('#my_profile_general_info').addClass('md-list-item-active');
    </script>
@endsection