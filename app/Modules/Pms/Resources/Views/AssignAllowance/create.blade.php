@extends('layouts.main')

@section('title', 'Pms Assign Allowance Create')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New Pms Assign Allowance</span></h2>
                                <div class="uk-width-medium-1-3">
                                    <div class="md-btn-group">
                                        <a href="{{ route('pms_assign_allowance_index') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">All</a>
                                        <a href="{{ route('pms_assign_allowance_create') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Add</a>
                                        <a href="{{ URL::previous() }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md-card">
                            {!! Form::open(['url' => route('pms_assign_allowance_store'), 'method' => 'POST','files' => true]) !!}
                            <div class="user_content">
                                <div class="uk-margin-top">

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="nationality">Date <span style="color: red;">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="nationality">Select Date</label>
                                            <input class="md-input" type="text" id="date" name="date" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{old('date')}}"/>
                                            @if($errors->first('date'))
                                                <div class="uk-text-danger">Date is required.</div>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="type">Select Employee <span style="color: red;">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <select data-md-selectize name="pms_employees_id" id="pms_employees_id" class="md-input" data-uk-tooltip="{pos:'top'}" title="Select Employee">
                                                <option value="">Select Employee</option>
                                                @foreach($employee as $all)
                                                    <option value="{{ $all->id }}">EMP-{{ $all->code_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if($errors->first('pms_employees_id'))
                                            <div class="uk-text-danger">Employee is required.</div>
                                        @endif
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="type">Select Allowance Sector <span style="color: red;">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <select data-md-selectize name="pms_sectors_id" id="pms_sectors_id" class="md-input" data-uk-tooltip="{pos:'top'}" title="Select Employee">
                                                <option value="">Select Sector</option>
                                                @foreach($sector as $all)
                                                    <option value="{{ $all->id }}">{{ $all->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if($errors->first('pms_sectors_id'))
                                            <div class="uk-text-danger">Sector is required.</div>
                                        @endif
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="nationality">Amount <span style="color: red;">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="nationality">Amount</label>
                                            <input class="md-input" type="number" id="amount" name="amount" value="{{old('amount')}}" step="0.01"/>
                                        </div>
                                        @if($errors->first('amount'))
                                            <div class="uk-text-danger">Amount is required.</div>
                                        @endif

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
        $('#pms_assign_allowance').addClass('act_item');
        $(window).load(function(){
            $("#pms_tiktok").trigger('click');
            $("#pms_payroll_tiktok").trigger('click');
            $("#pms_assign_tiktok").trigger('click');
        })
        
    </script>

@endsection