@extends('layouts.main')

@section('title', 'Currency rate create')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-xLarge-2-10 uk-width-large-2-10">
                    <div class="md-list-outside-wrapper">
                        @include('inc.settings_menu')
                    </div>
                </div>
                <div class="uk-width-large-8-10">
                    <div class="md-card">
                        <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Create Currency rate</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                {!! Form::open(['url' => route('settings_Currency_rate_store',$curr->id), 'method' => 'POST']) !!}
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="tax_name" class="uk-vertical-align-middle">Name</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">

                                        <input disabled="" class="md-input" type="text" id="name" value="{{ $curr["name"] }}" required/>
                                        @if($errors->first('name'))
                                            <div class="uk-text-danger">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="tax_name" class="uk-vertical-align-middle">Conversion Rate</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="tax_name">Conversion Rate</label>
                                        <input class="md-input" type="text" oninput="numbervalidate(this)" id="rate" name="rate" value="{{ old('rate') }}" required/>
                                        @if($errors->first('rate'))
                                            <div class="uk-text-danger">{{ $errors->first('rate') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="note">Note</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="note">Note</label>
                                        <textarea class="md-input" name="note" id="note" cols="30" rows="4">{{old('note')}}</textarea>
                                        @if($errors->first('note'))
                                            <div class="uk-text-danger uk-margin-top">Note is required.</div>
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
        $('#settings_menu_currency').addClass('md-list-item-active');
    </script>
@endsection