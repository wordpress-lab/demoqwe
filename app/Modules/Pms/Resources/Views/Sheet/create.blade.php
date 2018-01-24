@extends('layouts.main')

@section('title', 'Pms Payroll Sheet Create')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New Pms Payroll Sheet Edit</span></h2>
                                <div class="uk-width-medium-1-3">
                                    <div class="md-btn-group">
                                        <a href="{{ route('pms_payroll_sheet_index') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">All</a>
                                        <a href="{{ route('pms_payroll_sheet_create') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Add</a>
                                        <a href="{{ URL::previous() }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md-card">
                            {!! Form::open(['url' => route('pms_payroll_sheet_store'), 'method' => 'POST','files' => true]) !!}
                            <div class="user_content">
                                <div class="uk-margin-top">

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="nationality">Period Date <span style="color: red;">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="nationality">Select Date</label>
                                            <input class="md-input" type="text" id="period_from" name="period_from" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{old('period_from')}}"/>
                                            @if($errors->first('period_from'))
                                                <div class="uk-text-danger">Period From is required.</div>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="nationality">Period To <span style="color: red;">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="nationality">Select Date</label>
                                            <input class="md-input" type="text" id="period_to" name="period_to" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{old('period_to')}}"/>
                                            @if($errors->first('period_to'))
                                                <div class="uk-text-danger">Period To is required.</div>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="type">Select Site</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <select data-md-selectize name="pms_sites_id" id="pms_sites_id" class="md-input" data-uk-tooltip="{pos:'top'}" title="Select Site">
                                                <option value="">Select Site</option>
                                                @foreach($site as $all)
                                                    <option value="{{ $all->id }}">{{ $all->company_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="type">Select Company <span style="color: red;">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <select data-md-selectize name="pms_company_id" id="pms_company_id" class="md-input" data-uk-tooltip="{pos:'top'}" title="Select Company">
                                                <option value="">Select Company</option>
                                                @foreach($company as $all)
                                                    <option value="{{ $all->id }}">{{ $all->name_en }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('pms_company_id'))
                                                <div class="uk-text-danger">{{ $errors->first('pms_company_id') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="uk-grid uk-ma" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-left">
                                            <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                            <a href="{{ URL::previous() }}" class="md-btn md-btn-flat uk-modal-close">Close</a>
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
        $('#pms_payroll_sheet').addClass('act_item');
        $(window).load(function(){
            $("#pms_tiktok").trigger('click');
            $("#pms_payroll_tiktok").trigger('click');
        })
        
    </script>

@endsection