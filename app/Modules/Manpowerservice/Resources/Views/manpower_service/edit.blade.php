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
                            {!! Form::open(['url' => route('manpower_service_update',$manpower->id), 'method' => 'POST']) !!}
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <div class="uk-grid" data-uk-grid-margin>


                                        <div class="uk-width-medium-1-2">
                                            <label for="contact_id">Customer name</label>
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Customer" id="contact_id" name="contact_id">
                                                <option>Select Customer</option>
                                                @foreach($contact as $value)
                                                    @if($value->id==$manpower->	contact_id)
                                                    <option value=" {{ $value->id }}" selected> {{ $value->display_name }} </option>
                                                    @else
                                                        <option value=" {{ $value->id }} " > {{ $value->display_name }} </option>
                                                        @endif
                                                @endforeach
                                            </select>
                                            @if($errors->has('contact_id'))
                                                <div class="uk-text-danger">{{ $errors->first('contact_id') }}</div>
                                            @endif
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <label for="contact_id">Vendor name</label>
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Customer Category" id="vendor_id" name="vendor_id" required>
                                                <option>Select Vendor</option>
                                                @foreach($test as $value)
                                                    @if($value->id==$manpower->	contact_id)
                                                        <option value=" {{ $value->id }}" selected> {{ $value->display_name }} </option>
                                                    @else
                                                        <option value=" {{ $value->id }} " > {{ $value->display_name }} </option>
                                                    @endif
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
                                            <input class="md-input" type="text" id="first_name"  name="first_name" value="{!! $manpower->first_name !!}" />

                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <label for="last_name">Last Name</label>
                                            <input class="md-input" type="text" id="last_name"  name="last_name" value="{!! $manpower->last_name !!} " />

                                        </div>
                                    </div>


                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-3">
                                            <label for="passport_number">Passport Number</label>
                                            <input class="md-input" type="text" id="passport_number"  name="passport_number" value="{!! $manpower->passport_number !!}" />

                                        </div>
                                        <div class="uk-width-medium-1-3">
                                            <label for="contact_number">Phone Number</label>
                                            <input class="md-input" type="text" id="contact_number"  name="phone" value="{!! $manpower->phone !!} " />

                                        </div>
                                        <div class="uk-width-medium-1-3">
                                            <label for="contact_number">Sector</label>
                                            <input class="md-input" type="text" id="sector"  name="sector" value="{!! $manpower->sector !!}" />

                                        </div>
                                    </div>


                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-2">

                                            <label for="returnflightarrivalDate">Issuing Date <span style="color:red">*</span></label>
                                            <input required class="md-input" type="text" id="returnflightarrivalDate" name="issue_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{!! $manpower->issue_date !!}" />
                                        </div>
                                        <div class="uk-width-medium-1-2">

                                            <label for="returnflightarrivalDate">Delivery Date</label>
                                            <input class="md-input" type="text" id="returnflightarrivalDate" name="delivery_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{!! $manpower->delivery_date !!}" />
                                        </div>
                                    </div>



                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-6 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="customer_name">Progress Status <span style="color: red">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Order id" id="order_id" name="progress_status_id">
                                                <option value="">Progress Status Title</option>
                                                @foreach($progress as $value)
                                                    @if($value->id==$manpower->progress_status_id)
                                                    <option value="{!! $value->id !!}" selected>{!! $value->title !!}</option>
                                                    @else
                                                        <option value="{!! $value->id !!}">{!! $value->title !!}</option>
                                                        @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <br>
                                    @if($errors->has('invoice_particular')|| $errors->has('invoice_rate') ||$errors->has('invoice_qty'))

                                        <span style="font-weight: 400; color:red; position: relative; right:0px">{!! "Invoice field required" !!}</span>

                                    @endif
                                    <div class="uk-grid" >
                                        <div class="uk-width-1-2" >
                                            <div style=" padding:10px;height: 40px; color: white; background-color: maroon">
                                                Invoice <span style="color:gold"> {{ $manpower->invoice?'#'.$manpower->invoice['invoice_number']:'' }} </span>
                                            </div>

                                        </div>
                                        <div class="uk-width-1-2" style="padding: 10px; height: 40px; position:relative;background: maroon ">
                                            <div id="inv" style="position: absolute; right: 10px; height: 40px; ">
                                                <input type="checkbox"  id="checkbox_invoice" {{ $manpower->invoice?'':"name=check_invoice" }}   style=" margin-top: -1px; height: 25px; width: 20px;" />
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

                                                    <select  name="invoice_particular" id="invoice_item" class="md-input" data-uk-tooltip="{pos:'top'}" title="Select Item">
                                                        <option value="" disabled selected hidden>Select...</option>
                                                        @foreach($item as $value)
                                                            @if($manpower->invoice)
                                                                @if($manpower->invoice['OrderInvoiceEntries']['item_id']==$value['id'])
                                                                    <option {{ "selected" }} value="{{ $value->id }}">{{ $value->item_name }}</option>
                                                                @endif
                                                            @endif
                                                            <option  value="{{ $value->id }}">{{ $value->item_name }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>

                                            </div>

                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="Quantity">Quantity</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">

                                                    <label for="Quantity">Quantity </label>
                                                    <input {{ $manpower->invoice?'readonly':"" }} class="md-input" type="number" id="Quantity" name="invoice_qty" value="{{ $manpower->invoice?$manpower->invoice['OrderInvoiceEntries']['quantity']:'' }}"/>
                                                </div>
                                            </div>
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="Rate">Rate</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">

                                                    <label for="Rate">Rate</label>
                                                    <input {{ $manpower->invoice?'readonly':"" }} class="md-input" type="number" id="Rate" name="invoice_rate" value="{{ $manpower->invoice?$manpower->invoice['OrderInvoiceEntries']['rate']:'' }}"/>
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
                                                Bill <span style="color:gold"> {{ $manpower->bill?'#'.$manpower->bill['bill_number']:'' }} </span>
                                            </div>

                                        </div>
                                        <div class="uk-width-1-2" style="padding: 10px; height: 40px; position:relative;background: #2D2D2D ">
                                            <div id="inv" style="position: absolute; right: 10px; height: 40px; ">
                                                <input type="checkbox"  id="checkbox_bill" {{ $manpower->bill?'':"name=check_bill" }}   style=" margin-top: -1px; height: 25px; width: 20px;" />
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

                                                    <select {{ $manpower->bill?'disable':"" }}  name="bill_particular" id="invoice_item" class="md-input" data-uk-tooltip="{pos:'top'}" title="Select Item">
                                                        <option value="" disabled selected hidden>Select...</option>
                                                        @foreach($item as $value)
                                                            @if($manpower->bill)
                                                                @if($manpower->bill['OrderbillEntries']['item_id']==$value['id'])
                                                                    <option {{ "selected" }} value="{{ $value->id }}">{{ $value->item_name }}</option>
                                                                @endif
                                                            @endif
                                                            <option value="{{ $value->id }}">{{ $value->item_name }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>

                                            </div>

                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">

                                                    <label class="uk-vertical-align-middle" for="bill_Quantity">Quantity </label>
                                                </div>
                                                <div class="uk-width-medium-2-5">

                                                    <label for="bill_Quantity">Quantity</label>
                                                    <input {{ $manpower->bill?'readonly':"" }} class="md-input" type="number" id="bill_Quantity" name="bill_qty" value="{{ $manpower->bill?$manpower->bill['OrderbillEntries']['quantity']:'' }}"/>
                                                </div>
                                            </div>
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="Rate">Rate</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">

                                                    <label for="Rate">Rate</label>
                                                    <input {{ $manpower->bill?'readonly':"" }} class="md-input" type="number" id="Rate" name="bill_rate" value="{{ $manpower->bill?$manpower->bill['OrderbillEntries']['rate']:'' }}"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid uk-ma" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-left">
                                            @if($manpower->status==1)
                                            <input type="submit" class="md-btn md-btn-primary" value="confirm" name="confirm" />
                                            @else
                                            <input type="submit" class="md-btn md-btn-primary" value="save" name="save" />
                                                @endif

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
        @if($manpower->status==0)
               $('#manpower_ticket_order_pending').addClass('act_item');
        @endif
        @if($manpower->status==1)
               $('#manpower_ticket_order_confirm').addClass('act_item');
        @endif
         $(window).load(function(){
            $("#manpower_service_tok").trigger('click');
        })
    </script>


@endsection