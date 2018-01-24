@extends('layouts.main')

@section('title', 'Pms Leave Settings')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Create Pms Leave Settings</span></h2>
                            </div>
                        </div>
                        <div class="md-card">
                            {!! Form::open(['url' => route('pms_leave_settings_store'), 'method' => 'POST','files' => true]) !!}
                            <div class="user_content">
                                <div class="uk-margin-top">

                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="type">Highest Allowed Leave</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="nationality">days/year</label>
                                            <input class="md-input" type="number" id="highest_allowed_leave" name="highest_allowed_leave" value="{{ isset($settings->highest_allowed_leave)?$settings->highest_allowed_leave:'' }}" />
                                        </div>
                                        
                                        <span style="color:red; position: relative;">
                                        {{ $errors->has('highest_allowed_leave')?$errors->first('highest_allowed_leave'):'' }}
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
        $('#pms_leave_setting').addClass('act_item');
        $(window).load(function(){
            $("#pms_tiktok").trigger('click');
            $("#pms_payroll_leave_tiktok").trigger('click');
        })
        
    </script>

@endsection