@extends('layouts.main')

@section('title', 'Add ManPower')

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
            {!! Form::open(['url' => route('manpower_store'), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
                <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                    <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Create Manpower</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">

                                    {{--<div class="uk-width-medium-3-5">--}}
                                        {{--<div class="md-card">--}}
                                            {{--<div class="md-card-content">--}}
                                                {{--<h3 class="heading_a">Select Pax ID <span style="color: red">*</span></h3>--}}
                                                {{--<div class="uk-grid">--}}
                                                    {{--<div class="uk-width-medium-2-2">--}}
                                                        {{--<select id="selec_adv_1" name="paxid[]" multiple>--}}
                                                            {{--@foreach($order as $value)--}}

                                                               {{--<option value="{!! $value->id !!}">{!! $value->paxid !!}</option>--}}

                                                            {{--@endforeach--}}
                                                        {{--</select>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    <div class="uk-grid">
                                        <div class="uk-width-1-1">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5  uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="invoice_date">Pax Id<i style="color:red" class="material-icons">stars</i></label>
                                                </div>
                                                <div class="uk-width-medium-1-3">
                                                    <select required id="select_demo_1" class="md-input" name="paxid">
                                                        <option value="" disabled selected hidden>Select Pax ...</option>
                                                        @foreach($order as $value)
                                                            <option value="{!! $value->id !!}">{!! $value->paxid !!}</option>
                                                        @endforeach
                                                    </select>
                                                        @if($errors->has('paxid'))
                                                            <div class="uk-text-danger">{{ $errors->first('paxid') }}</div>
                                                        @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="invoice_date">Issuing Date <i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="invoice_date">Select date</label>
                                            <input class="md-input" type="text" id="uk_dp_start" name="issuingDate" data-uk-datepicker="{format:'YYYY-MM-DD'}" required>
                                            @if($errors->has('issuingDate'))

                                                <span style="color:red; position: relative; right:-500px">{!!$errors->first('issuingDate')!!}</span>

                                            @endif
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="invoice_number">Comments </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="invoice_number"></label>
                                            <textarea type="text" name="comment" class="md-input" cols="4" rows="4"></textarea>
                                        </div>
                                    </div>

                                    <div class="uk-grid uk-ma" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">

                                        </div>
                                        <div class="uk-width-2-5 uk-float-left">
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
        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_manpower_index').addClass('act_item');
        $(window).load(function(){
            $("#tiktok2").trigger('click');
        })
        altair_forms.parsley_validation_config();
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection
