@extends('layouts.main')

@section('title', 'Edit Ticket Hotel')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection


@section('content')
    <div class="uk-grid" ng-controller="InvoiceController">
        <div class="uk-width-large-10-10">
            @if(Session::has('msg'))
                <div class="uk-alert uk-alert-success" data-uk-alert>
                    <a href="#" class="uk-alert-close uk-close"></a>
                    {!! Session::get('msg') !!}
                </div>
            @endif
            {!! Form::open(['url' => route('ticket_hotel_update',$hotel->id), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit Ticket Hotel</span></h2>
                                <div class="uk-width-medium-1-3">
                                    <div class="md-btn-group">
                                        <a href="{{ route('ticket_hotel_index') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">All</a>
                                        <a href="{{ route('ticket_hotel_create') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Add</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Hotel Title <span style="color: red">*</span></label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="name">Title</label>
                                        <input class="md-input" value="{!! $hotel->title !!}" type="text" id="name" name="title">
                                        @if($errors->has('title'))
                                            <br/>
                                            <span style="color:orangered;">{!!$errors->first('title')!!}</span>

                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Country <span style="color: red">*</span></label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="name">Country</label>
                                        <input class="md-input" value="{!! $hotel->country !!}" type="text" id="name" name="country">
                                        @if($errors->has('country'))
                                            <br/>
                                            <span style="color:orangered;">{!!$errors->first('country')!!}</span>

                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="comment">Address </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="note">Address here (optional)</label>
                                        <textarea type="text" name="address" id="note" class="md-input" cols="4" rows="4">{!! $hotel->address !!}</textarea>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="comment">Note </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="note">Note here (optional)</label>
                                        <textarea type="text" name="note" id="note" class="md-input" cols="4" rows="4">{!! $hotel->note !!}</textarea>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <br>

                                <div class="uk-grid uk-ma" data-uk-grid-margin>
                                    <div class="uk-width-1-1 uk-float-left">
                                        <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                        <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        $('#sidebar_ticketing').addClass('current_section');

        $('#sidebar_ticket_hotel').addClass('act_item');

        $(window).load(function(){
            $("#tiktok").trigger('click');
        })
        altair_forms.parsley_validation_config();
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection
