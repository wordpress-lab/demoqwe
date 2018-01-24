@extends('layouts.main')

@section('title', 'Pms Monthly Working Hour Settings')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
    <div class="uk-grid">
        <div class="uk-width-large-10-10">
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Uodate Pms monthly working hour Settings</span></h2>
                            </div>
                        </div>
                        <div class="md-card">
                            @php
                                $rate = null;
                                if(isset($settings))
                                {
                                 $data = unserialize($settings->setting_data);
                                 $rate = isset($data->rate)?$data->rate:'';
                                }
                            @endphp
                            {!! Form::open(['url' => route('pms_settings_store'), 'method' => 'POST','files' => false]) !!}
                            <div class="user_content">
                                <div class="uk-margin-top">

                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="type">Monthly Working Dats</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="monthly_working_days">days</label>
                                            <input class="md-input" type="number" id="monthly_working_days" name="monthly_working_days" value="{{ $rate }}" />
                                        </div>
                                        
                                        <span style="color:red; position: relative;">
                                        {{ $errors->has('monthly_working_days')?$errors->first('monthly_working_days'):'' }}
                                        </span>
                                        
                                    </div>

                                    <div class="uk-grid uk-ma" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-left">
                                            <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                        </div>
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
@endsection
@section('scripts')

    <script>

        $('#sidebar_pms').addClass('current_section');
        $('#pms_settings').addClass('act_item');
        $(window).load(function(){
            $("#pms_tiktok").trigger('click');
            $("#sidebar_pms_payroll").trigger('click');
        })
        
    </script>

@endsection