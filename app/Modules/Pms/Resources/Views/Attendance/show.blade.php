@extends('layouts.main')

@section('title', 'Pms Attendance Show')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New Pms Attendance</span></h2>
                                <div class="uk-width-medium-1-3">
                                    <div class="md-btn-group">
                                        <a href="{{ route('pms_attendance_index') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">All</a>
                                        <a href="{{ route('pms_attendance_create') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Add</a>
                                        <a href="{{ URL::previous() }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md-card">
                            
                            <div class="user_content">
                                <div class="uk-margin-top">


                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="company_name">Site Name </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label class="uk-vertical-align-middle" for="company_name">{{ $attendance->siteId['company_name'] }} </label>
                                        </div>
                                        
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="company_name">Employee Name </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label class="uk-vertical-align-middle" for="company_name">{{ $attendance->employeeId['code_name'] }} </label>
                                        </div>
                                    </div>
                                    
                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="Local">Date </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label class="uk-vertical-align-middle" for="company_name">{{ date('d-m-Y', strtotime($attendance->date)) }} </label>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="billing_period_to">Entrance Time</label>
                                        </div>
                                        <div class="uk-width-medium-2-6">
                                            <label class="uk-vertical-align-middle" for="company_name">{{ $attendance->entrance_time }} </label>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="billing_period_to">Leave Time</label>
                                        </div>
                                        <div class="uk-width-medium-2-6">
                                            <label class="uk-vertical-align-middle" for="company_name">{{ $attendance->leave_time }} </label>
                                        </div>
                                    </div>

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
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script>
        $('#sidebar_pms').addClass('current_section');
        $('#sidebar_pms_attendance_view').addClass('act_item');

    </script>
    
@endsection