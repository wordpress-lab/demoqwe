@extends('layouts.main')

@section('title', 'Pms Invoice Create')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New Pms Invoice</span></h2>
                                <div class="uk-width-medium-1-3">
                                    <div class="md-btn-group">
                                        <a href="{{ route('pms_invoice_index') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">All</a>
                                        <a href="{{ route('pms_invoice_create') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Add</a>
                                        <a href="{{ URL::previous() }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md-card">
                            {!! Form::open(['url' => route('pms_invoice_store'), 'method' => 'POST','files' => true]) !!}
                            <div class="user_content">
                                <div class="uk-margin-top">

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="nationality">Invoice Date <span style="color: red;">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="nationality">Select Date</label>
                                            <input class="md-input" type="text" id="invoice_date" name="invoice_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{old('invoice_date')}}"/>
                                            @if($errors->has('invoice_date'))
                                                <div class="uk-text-danger">{{ $errors->first('invoice_date') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="type">Select Site <span style="color: red;">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <select data-md-selectize name="pms_sites_id" id="pms_sites_id" class="md-input" data-uk-tooltip="{pos:'top'}" title="Select Site">
                                                <option value="">Select Site</option>
                                                @foreach($site as $all)
                                                    <option value="{{ $all->id }}">{{ $all->company_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if($errors->has('pms_sites_id'))
                                            <div class="uk-text-danger">{{ $errors->first('pms_sites_id') }}</div>
                                        @endif
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="type">Select Company <span style="color: red;">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <select data-md-selectize name="pms_company_id" id="pms_company_id" class="md-input" data-uk-tooltip="{pos:'top'}" title="Select Employee">
                                                <option value="">Select Company</option>
                                                @foreach($company as $all)
                                                    <option value="{{ $all->id }}">{{ $all->name_en }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if($errors->has('pms_company_id'))
                                            <div class="uk-text-danger">{{ $errors->first('pms_company_id') }}</div>
                                        @endif
                                    </div>


                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="type">Invoice <span style="color: red;">*</span></label>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-large-1-3 uk-width-medium-1-1">
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                <label for="uk_dp_start">From</label>
                                                <input class="md-input invoice_from_date" type="text" id="uk_dp_start" name="invoice_from_date" onchange="fromDate();">
                                                @if($errors->has('invoice_from_date'))
                                                    <div class="uk-text-danger">{{ $errors->first('invoice_from_date') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="uk-width-large-1-3 uk-width-medium-1-1">
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                <label for="uk_dp_end">To</label>
                                                <input class="md-input invoice_to_date" type="text" id="uk_dp_end" name="invoice_to_date" onchange="toDate();">
                                                @if($errors->has('invoice_to_date'))
                                                    <div class="uk-text-danger">{{ $errors->first('invoice_to_date') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-4  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="nationality">Total Hour <span style="color: red;">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-1-4">
                                            <label for="nationality">Total Hour</label>
                                            <input class="md-input" type="text" id="total_hours" name="total_hours" value="{{old('total_hours')}}"/>
                                            @if($errors->has('total_hours'))
                                                <div class="uk-text-danger">{{ $errors->first('total_hours') }}</div>
                                            @endif
                                        </div>
                                        <div class="uk-width-medium-1-4  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="nationality">Rate/Hour <span style="color: red;">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-1-4">
                                            <label for="nationality">Rate/Hour</label>
                                            <input class="md-input" type="text" id="per_hour_rate" name="per_hour_rate" value="{{old('per_hour_rate')}}"/>
                                            @if($errors->has('per_hour_rate'))
                                                <div class="uk-text-danger">{{ $errors->first('per_hour_rate') }}</div>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="nationality">Total Amount <span style="color: red;">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="nationality">Amount</label>
                                            <input class="md-input" type="number" id="total_amount" name="total_amount" value="{{old('total_amount')}}" step="0.01"/>
                                        </div>
                                        @if($errors->has('total_amount'))
                                            <div class="uk-text-danger">{{ $errors->first('total_amount') }}</div>
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
        $('#sidebar_pms_invoice').addClass('act_item');
        
    </script>

    <script type="text/javascript">
        function fromDate(){
            var pms_sites_id = $('#pms_sites_id').val();
            var invoice_from_date = $('.invoice_from_date').val();
            var invoice_to_date = $('.invoice_to_date').val();

            //ajax
            $.get("{{ route('total_hour',['id'=>'','from'=>'','to'=>'']) }}/" + pms_sites_id +'/' +invoice_from_date + '/' + invoice_to_date, function(data){
                    $('#total_hours').val(data['total_hour']);
                    $('#per_hour_rate').val(data['site']);
                    $('#total_amount').val(data['total_amount']);
                    $("#total_hours").blur();
                    $("#per_hour_rate").blur();
                    $("#total_amount").blur();
            });

        }

        function toDate(){
            var pms_sites_id = $('#pms_sites_id').val();
            var invoice_from_date = $('.invoice_from_date').val();
            var invoice_to_date = $('.invoice_to_date').val();

            //ajax
            $.get("{{ route('total_hour',['id'=>'','from'=>'','to'=>'']) }}/" + pms_sites_id +'/' +invoice_from_date + '/' + invoice_to_date, function(data){
                    $('#total_hours').val(data['total_hour']);
                    $('#per_hour_rate').val(data['site']);
                    $('#total_amount').val(data['total_amount']);
                    $("#total_hours").blur();
                    $("#per_hour_rate").blur();
                    $("#total_amount").blur();
            });
        }

        $('#pms_sites_id').on('change',function(){
            var pms_sites_id = $(this).val();
            var invoice_from_date = $('.invoice_from_date').val();
            var invoice_to_date = $('.invoice_to_date').val();

            //ajax
            $.get("{{ route('total_hour',['id'=>'','from'=>'','to'=>'']) }}/" + pms_sites_id +'/' +invoice_from_date + '/' + invoice_to_date, function(data){
                    $('#total_hours').val(data['total_hour']);
                    $('#per_hour_rate').val(data['site']);
                    $('#total_amount').val(data['total_amount']);
                    $("#total_hours").blur();
                    $("#per_hour_rate").blur();
                    $("#total_amount").blur();
            });
        });

    </script>

@endsection