@extends('layouts.main')

@section('title', 'Iqama Recipient ')

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

                <div class="uk-width-xLarge-10-10  uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Add Recipient</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                {!! Form::open(['url' => route('iqama_Delivery_receipient_update'), 'method' => 'POST', 'files' => false]) !!}
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="name" class="uk-vertical-align-middle">Pax Id</label>
                                    </div>
                                    <div class="uk-width-medium-2-3">

                                    <h2>{{ $recruit["paxid"] }}</h2>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="contact" class="uk-vertical-align-middle">Recipient Name<i style="color: red">*</i></label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="date_of_payment">Recipient Name</label>
                                        <input value="{{ $recruit["id"] }}" class="md-input" type="hidden" id="paxid" name="paxid"/>
                                        <input value="{{ $recruit["recipient_name"] }}" required class="md-input" type="text" id="recipient_name" name="recipient_name"/>
                                        @if($errors->first('recipient_name'))
                                            <div class="uk-text-danger">name is required.</div>
                                        @endif
                                        
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="contact" class="uk-vertical-align-middle">Relation With Passenger<i style="color: red">*</i></label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="date_of_payment">Relation With Passenger</label>
                                        <input class="md-input" type="text" id="relational_passenger" name="relational_passenger" value="{{ $recruit["relational_passenger"] }}" required/>
                                        @if($errors->first('relational_passenger'))
                                            <div class="uk-text-danger">Relation With Passenger is required.</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-5 uk-vertical-align">

                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <div class="uk-width-1-1 uk-float-right">
                                            <button type="submit" class="md-btn md-btn-primary">Save</button>
                                            <a href="{{ URL::previous() }}" >  <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button></a>
                                        </div>
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
    <script>
        $('#sidebar_recruit').addClass('current_section');
        $('#iqama_Delivery_receipient_index').addClass('act_item');
        $(window).load(function(){
            $("#tiktok2").trigger('click');
            $("#iqama_tiktok").trigger('click');
            $("#iqama_tiktok_delivery").trigger('click')
        })

    </script>
@endsection