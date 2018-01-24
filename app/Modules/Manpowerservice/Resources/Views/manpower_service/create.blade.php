@extends('layouts.main')

@section('title', 'Manpower Service create')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New Manpower Service</span></h2>
                                <div class="uk-width-medium-1-3">
                                    <div class="md-btn-group">
                                        <a href="{{ route('manpower_service_confirmed') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Confirmed</a>
                                        <a href="{{ route('manpower_service_pending') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Pending</a>
                                        <a href="{{ route('manpower_service_create') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Add</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md-card">
                            {!! Form::open(['url' => route('manpower_service_store'), 'method' => 'POST']) !!}
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <div class="uk-grid" data-uk-grid-margin>


                                        <div class="uk-width-medium-1-2">
                                            <label for="contact_id">Customer name <span style="color: red">*</span></label>
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Customer" id="contact_id" name="contact_id">
                                                <option>Select Customer</option>
                                                @foreach($contact as $value)
                                                    <option value=" {{ $value->id }} " > {{ $value->display_name }} </option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('contact_id'))
                                                <div class="uk-text-danger">{{ $errors->first('contact_id') }}</div>
                                            @endif
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <label for="contact_id">Vendor name <span style="color: red">*</span></label>
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Customer Category" id="vendor_id" name="vendor_id" required>
                                                <option>Select Vendor</option>
                                                @foreach($test as $value)
                                                    <option value=" {{ $value->id }} " > {{ $value->display_name }} </option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('contact_id'))
                                                <div class="uk-text-danger">{{ $errors->first('contact_id') }}</div>
                                            @endif
                                        </div>
                                    </div>



                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-2">
                                            <label for="first_name">First Name</label>
                                            <input class="md-input" type="text" id="first_name"  name="first_name" value="{{ old('first_name')}} " />

                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <label for="last_name">Last Name</label>
                                            <input class="md-input" type="text" id="last_name"  name="last_name" value="{{ old('last_name')}} " />

                                        </div>
                                    </div>


                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-3">
                                            <label for="passport_number">Passport Number</label>
                                            <input class="md-input" type="text" id="passport_number"  name="passport_number" value="{{ old('passport_number')}} " />

                                        </div>
                                        <div class="uk-width-medium-1-3">
                                            <label for="contact_number">Sector</label>
                                            <input class="md-input" type="text" id="sector"  name="sector" value="{{ old('sector')}} " />

                                        </div>
                                        <div class="uk-width-medium-1-3">
                                            <label for="contact_number">Phone Number</label>
                                            <input class="md-input" type="text" id="contact_number"  name="phone" value="{{ old('contact_number')}} " />

                                        </div>
                                    </div>



                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-2">

                                            <label for="returnflightarrivalDate">Issuing Date <span style="color:red">*</span></label>
                                            <input required class="md-input" type="text" id="returnflightarrivalDate" name="issue_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{old('delivery_date')}}" />
                                        </div>
                                        <div class="uk-width-medium-1-2">

                                            <label for="returnflightarrivalDate">Delivery Date</label>
                                            <input class="md-input" type="text" id="returnflightarrivalDate" name="delivery_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{old('delivery_date')}}" />
                                        </div>
                                    </div>


                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-6 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="customer_name">Progress Status <span style="color:red">*</span> </label>
                                        </div>
                                        <div class="uk-width-medium-1-3">
                                            <select required data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Order id" id="order_id" name="progress_status_id">
                                                <option value="">Progress Status Title</option>
                                                @foreach($progress as $value)
                                                    <option value="{!! $value->id !!}">{!! $value->title !!}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="uk-width-medium-1-6">
                                        @if(!count($progress))
                                                <a target="_blank" href="{{ route('manpower_service_hotel_create') }} " >
                                                   <div class="md-fab md-fab-accent">
                                                       <i class="material-icons"></i>
                                                   </div>
                                                </a>
                                        @endif
                                        </div>
                                    </div>
                                    @if($errors->has('invoice_particular')|| $errors->has('invoice_rate') ||$errors->has('invoice_qty'))

                                        <span style="font-weight: 400; color:red; position: relative; right:0px">{!! "Invoice field required" !!}</span>

                                    @endif
                                    <div class="uk-grid" >
                                        <div class="uk-width-1-2" >
                                            <div style=" padding:10px;height: 40px; color: white; background-color: maroon">
                                                Invoice
                                            </div>

                                        </div>
                                        <div class="uk-width-1-2" style="padding: 10px; height: 40px; position:relative;background: maroon ">
                                            <div id="inv" style="position: absolute; right: 10px; height: 40px; ">
                                                <input type="checkbox" {{ old('check_invoice')?"checked":'' }} name="check_invoice" id="checkbox_invoice" style=" margin-top: -1px; height: 25px; width: 20px;" />
                                            </div>

                                        </div>
                                    </div>
                                    <div class="uk-grid" style="display: none;" id="invoice_details">
                                        <div class="uk-width-1-1" >
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="documentNumber">Select particular</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">

                                                    <select name="invoice_particular" id="invoice_item" class="md-input" data-uk-tooltip="{pos:'top'}" title="Select Item">
                                                        <option value="" disabled selected hidden>Select...</option>
                                                        @foreach($item as $value)
                                                            <option value="{{ $value->id }}">{{ $value->item_name }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>

                                            </div>

                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="Quantity">Quantity</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">

                                                    <label for="Quantity">Quantity</label>
                                                    <input class="md-input" type="number" id="Quantity" name="invoice_qty" value="{{ old("invoice_qty") }}"/>
                                                </div>
                                            </div>
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="Rate">Rate</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">

                                                    <label for="Rate">Rate</label>
                                                    <input class="md-input" type="number" id="Rate" name="invoice_rate" value="{{ old("invoice_rate") }}"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($errors->has('bill_particular')|| $errors->has('bill_rate') ||$errors->has('bill_qty'))

                                        <span style="color:red; position: relative; right:0px">{!! "Bill field required" !!}</span>

                                    @endif
                                    <div class="uk-grid" >
                                        <div class="uk-width-1-2" >
                                            <div style=" padding:10px;height: 40px; color: white; background-color: #2D2D2D ">
                                                Bill
                                            </div>

                                        </div>
                                        <div class="uk-width-1-2" style="padding: 10px; height: 40px; position:relative;background: #2D2D2D ">
                                            <div id="inv" style="position: absolute; right: 10px; height: 40px; ">
                                                <input {{ old('check_bill')?"checked":'' }} type="checkbox" name="check_bill" id="checkbox_bill" style=" margin-top: -1px; height: 25px; width: 20px;" />
                                            </div>

                                        </div>
                                    </div>
                                    <div class="uk-grid" style="display: none;" id="bill_details">
                                        <div class="uk-width-1-1" >
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="documentNumber">Select particular</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">

                                                    <select name="bill_particular" id="invoice_item" class="md-input" data-uk-tooltip="{pos:'top'}" title="Select Item">
                                                        <option value="" disabled selected hidden>Select...</option>
                                                        @foreach($item as $value)
                                                            <option value="{{ $value->id }}">{{ $value->item_name }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>

                                            </div>

                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="Quantity">Quantity</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">

                                                    <label for="Quantity">Quantity</label>
                                                    <input class="md-input" type="number" id="Quantity" name="bill_qty" value="{{ old("bill_qty") }}"/>
                                                </div>
                                            </div>
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="Rate">Rate</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">

                                                    <label for="Rate">Rate</label>
                                                    <input class="md-input" type="number" id="Rate" name="bill_rate" value="{{ old("bill_rate") }}"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="uk-grid uk-ma" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-left">
                                            <input type="submit" class="md-btn md-btn-primary" value="confirm" name="confirm" />
                                            <input type="submit" class="md-btn md-btn-warning" value="save" name="save" />

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
    $("#checkbox_invoice").on("click",function () {

        $("#invoice_details").toggle(800);

    });
    $("#checkbox_bill").on("click",function () {

        $("#bill_details").toggle(800);

    });
    $('#manpower_ticket_order_new').addClass('act_item');
    $('#manpower_ticketing').addClass('current_section');
    $(window).load(function(){
        $("#manpower_service_tok").trigger('click');
    })
</script>


@endsection