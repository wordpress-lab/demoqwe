@extends('layouts.main')

@section('title', 'BackUp Schedule')

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
                    @if(session()->has('msg'))

                        <div class="uk-alert uk-alert-{{ session('status') }}" data-uk-alert>
                            <a href="" class="uk-alert-close uk-close"></a>
                            <p>{{ session('msg') }}</p>
                        </div>
                    @endif
                    <div class="md-card">


                        <div class="user_heading">



                                <h2 style="color: white" class="heading_b"><span class="uk-text-truncate">Backup Schedule</span></h2>

                        </div>

                        <div class="user_content">

                            <div class="uk-margin-top">
                                {!! Form::open(['url' => route('backup_schedule_update',$schedule->id), 'method' => 'POST']) !!}
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="tax_name" class="uk-vertical-align-middle">Mail Address</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="to_mail">Email</label>
                                        <input class="md-input" type="email" id="tax_name" name="to_mail" value="{{ $schedule->mail }}" required/>
                                        @if($errors->first('to_mail'))
                                            <div class="uk-text-danger">{{ $errors->first('to_mail') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="tax_description" class="uk-vertical-align-middle">Send BackUp Every</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="days">days</label>
                                        <input readonly class="md-input" type="number" id="days" name="days" value="{{ $schedule->intervaldays }}" required/>
                                        @if($errors->first('days'))
                                            <div class="uk-text-danger">{{ $errors->first('days') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-5 uk-vertical-align"></div>

                                    <div class="uk-width-4-5 uk-float-right">
                                        <button type="submit" class="md-btn md-btn-primary" >Update</button>

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
        $('#settings_menu_backup_schedule').addClass('md-list-item-active');
    </script>
@endsection


