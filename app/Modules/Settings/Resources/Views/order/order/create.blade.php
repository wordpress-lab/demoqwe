@extends('layouts.main')

@section('title', 'Ticket Order create')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New Ticket Order</span></h2>
                                <div class="uk-width-medium-1-3">
                                    <div class="md-btn-group">
                                        <a href="{{ route('ticket_Order_confirmed') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Confirmed</a>
                                        <a href="{{ route('ticket_Order_pending') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Pending</a>
                                        <a href="{{ route('ticket_Order_create') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Add</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md-card">
                            {!! Form::open(['url' => route('ticket_Order_store'), 'method' => 'POST']) !!}
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="contact_id">Contact Name <span style="color: red">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="contact_id">Customer name</label>
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
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="contact_id">Vendor Name <span style="color: red">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="contact_id">Vendor name</label>
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Customer Category" id="vendor_id" name="vendor_id" required>
                                                <option>Select Vendor</option>
                                                @foreach($test as $value)
                                                    <option  value=" {{ $value->id }} " > {{ $value->display_name }} </option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('contact_id'))
                                                <div class="uk-text-danger">{{ $errors->first('contact_id') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="returnflightarrivalDate">Issue Date <span style="color: red">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="returnflightarrivalDate">Issue Date</label>
                                            <input class="md-input" type="text" id="issuDate" name="issuDate" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{old('issuDate')}}" required/>
                                            @if($errors->has('issuDate'))
                                                <div class="uk-text-danger">{{ $errors->first('issuDate') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="uk-grid">
                                        <div class="uk-width-medium-1-1 ">

                                            <div id="accor" class="uk-accordion" data-uk-accordion>
                                                <h3 class="uk-accordion-title uk-accordion-title-success">PNR</h3>
                                                <div class="uk-accordion-content">
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                                            <label class="uk-vertical-align-middle" for="pnr">PNR</label>
                                                        </div>
                                                        <div class="uk-width-medium-1-2">
                                                            <label for="pnr">PNR here</label>
                                                            <textarea type="text" name="pnr" id="pnr" class="md-input" cols="4" rows="4"></textarea>
                                                            @if($errors->has('pnr'))

                                                                <span style="color:red; position: relative; right:-500px">{!!$errors->first('pnr')!!}</span>

                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                      </div>

                                    </div>
                                    <div class="uk-grid">
                                        <div class="uk-width-medium-1-1 ">

                                            <div id="passangerdetailsaccord" class="uk-accordion" data-uk-accordion>
                                                <h3 class="uk-accordion-title uk-accordion-title-success">Passenger Details</h3>
                                                <div class="uk-accordion-content">

                                                     <br/>
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

                                                        <div class="uk-width-medium-1-4">
                                                            <label for="contact_number">Contact Number</label>
                                                            <input class="md-input" type="text" id="contact_number"  name="contact_number" value="{{ old('contact_number')}} " />

                                                        </div>
                                                        <div class="uk-width-medium-1-4">
                                                            <label for="passport_number">Passport Number</label>
                                                            <input class="md-input" type="text" id="passport_number"  name="passport_number" value="{{ old('passport_number')}} " />

                                                        </div>
                                                        <div class="uk-width-medium-1-4">
                                                            <label for="ticket_number">Ticket Number</label>
                                                            <input class="md-input" type="text" id="ticket_number"  name="ticket_number" value="{{ old('ticket_number')}} " />

                                                        </div>
                                                        <div class="uk-width-medium-1-4">

                                                            <label for="documentNumber">Document Number</label>
                                                            <input class="md-input" type="text" id="documentNumber"   name="documentNumber" value="{{ old('documentNumber')}} " />

                                                        </div>
                                                    </div>




                                                    <div class="uk-grid" data-uk-grid-margin>

                                                        <div class="uk-width-medium-1-4">
                                                            <label for="pnrcreationDate">PNR Creation Date</label>
                                                            <input class="md-input" type="text" id="pnrcreationDate" name="pnrcreationDate" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{old('pnrcreationDate')}}" />
                                                        </div>
                                                        @if($errors->has('pnrcreationDate'))
                                                            <div class="uk-text-danger">{{ $errors->first('pnrcreationDate') }}</div>
                                                        @endif
                                                        <div class="uk-width-medium-1-4">
                                                            <label for="departureDate">Departure Date</label>
                                                            <input class="md-input" type="text" id="departureDate" name="departureDate" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{old('departureDate')}}" />
                                                        </div>
                                                        @if($errors->has('departureDate'))
                                                            <div class="uk-text-danger">{{ $errors->first('departureDate') }}</div>
                                                        @endif
                                                        <div class="uk-width-medium-1-4">

                                                            <label for="returnflightDate">Return Flight Date</label>
                                                            <input class="md-input" type="text" id="returnflightDate" name="returnflightDate" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{old('returnflightDate')}}" />
                                                        </div>
                                                        <div class="uk-width-medium-1-4">

                                                            <label for="returnflightarrivalDate">Return Flight Arrival Date</label>
                                                            <input class="md-input" type="text" id="returnflightarrivalDate" name="returnflightarrivalDate" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{old('returnflightarrivalDate')}}" />
                                                        </div>
                                                    </div>

                                                     <br/>
                                                     <br/>
                                                    <div class="uk-grid" data-uk-grid-margin>

                                                        <div class="uk-width-medium-1-4">
                                                            <label for="departureflightCode">Departure Flight Code</label>
                                                            <input class="md-input" type="text" id="departureflightCode"  name="departureflightCode" value="{{ old('departureflightCode')}} " />

                                                        </div>
                                                        <div class="uk-width-medium-1-4">
                                                            <label for="departureflightClass">Departure Flight Class</label>
                                                            <input class="md-input" type="text" id="departureflightClass"  name="departureflightClass" value="{{ old('departureflightClass')}} " />

                                                        </div>
                                                        <div class="uk-width-medium-1-4">
                                                            <label for="departureFrom">Departure From</label>
                                                            <input class="md-input" type="text" id="departureFrom"  name="departureFrom" value="{{ old('departureFrom')}} " />

                                                        </div>
                                                        <div class="uk-width-medium-1-4">
                                                            <label for="departureTime">Departure Time</label>
                                                            <input class="md-input" type="text" id="departureTime" id="uk_tp_1" data-uk-timepicker name="departureTime" />

                                                        </div>
                                                    </div>
                                                    <div class="uk-grid" data-uk-grid-margin>

                                                        <div class="uk-width-medium-1-2">
                                                            <label for="recordLocator">Record Locator</label>
                                                            <input class="md-input" type="text" id="recordLocator"  name="recordLocator" value="{{ old('recordLocator')}} " />

                                                        </div>
                                                        <div class="uk-width-medium-1-2">

                                                            <label for="issuetimeLimit">Issue Time Limit</label>
                                                            <input class="md-input" type="text" id="issuetimeLimit"   name="issuetimeLimit" value="{{ old('issuetimeLimit')}} " />

                                                        </div>
                                                    </div>




                                                    <div class="uk-grid" data-uk-grid-margin>

                                                        <div class="uk-width-medium-1-2">
                                                            <label for="arriveTo">Arrive To</label>
                                                            <input class="md-input" type="text" id="arriveTo"  name="arriveTo" value="{{ old('arriveTo')}} " />

                                                        </div>
                                                        <div class="uk-width-medium-1-2">
                                                            <label for="arrivalTime">Arrival Time</label>
                                                            <input class="md-input" type="text" id="arrivalTime" data-uk-timepicker  name="arrivalTime" value="{{ old('arrivalTime')}} " />

                                                        </div>
                                                    </div>
                                                    <div class="uk-grid" data-uk-grid-margin>

                                                        <div class="uk-width-medium-1-2">

                                                            <label for="departureSector">Departure Sector</label>

                                                            <select data-md-selectize data-md-selectize-bottom  onchange="itemchange(this)"  data-uk-tooltip="{pos:'top'}" name="departureSector" id="departureSector"  class="md-input" data-uk-tooltip="{pos:'top'}" title="Select with Sector Item">
                                                                <option value="" disabled selected hidden>Select...</option>
                                                                 @foreach($item as $value)
                                                                    <option value="{{ $value['item_name']."_".$value['id'] }}">{{ $value['item_name'] }}</option>
                                                                 @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="uk-width-medium-1-2">

                                                            {{--<label for="documentNumber">Return Sector</label>--}}
                                                            {{--<input class="md-input" type="text" id="returnSector"   name="returnSector" value="{{ old('returnSector')}} " />--}}
                                                     {{----}}
                                                        </div>
                                                    </div>



                                                  <br/>
                                                  <br/>
                                                    <div class="uk-grid" data-uk-grid-margin>

                                                        <div class="uk-width-medium-1-5">

                                                            <label for="registerSerial">Return Flight Code</label>
                                                            <input class="md-input" type="text" id="returnflightCode"  name="returnflightCode" value="{{ old('returnflightCode')}} " />
                                                            @if($errors->has('returnflightCode'))
                                                                <div class="uk-text-danger">{{ $errors->first('returnflightCode') }}</div>
                                                            @endif
                                                        </div>
                                                        <div class="uk-width-medium-1-5">

                                                            <label for="returnflightbookingClass">Return Flight Booking Class</label>
                                                            <input class="md-input" type="text" id="returnflightbookingClass"  name="returnflightbookingClass" value="{{ old('returnflightbookingClass')}} " />

                                                        </div>
                                                        <div class="uk-width-medium-1-5">

                                                            <label for="returnflightFrom">Return Flight From</label>
                                                            <input class="md-input" type="text" id="returnflightFrom"   name="returnflightFrom" value="{{ old('returnflightFrom')}} " />

                                                        </div>
                                                        <div class="uk-width-medium-1-5">

                                                            <label for="returnflightTo">Return Flight To</label>
                                                            <input class="md-input" type="text" id="returnflightTo"   name="returnflightTo" value="{{ old('returnflightTo')}} " />

                                                        </div>
                                                        <div class="uk-width-medium-1-5">

                                                            <label style="margin-top: -20px" for="returnflightdepartureTime">Return Flight Departure Time</label>
                                                            <input class="md-input" type="text" id="returnflightdepartureTime" id="uk_tp_1" data-uk-timepicker   name="returnflightdepartureTime"  />

                                                        </div>

                                                    </div>

                                                    <div class="uk-grid" data-uk-grid-margin>

                                                        <div class="uk-width-medium-1-3">

                                                            <label for="adultPassenger">Adult Pasenger</label>
                                                            <input class="md-input" type="number" id="adultPassenger"   name="adultPassenger" value="{{ old('adultPassenger')}} " />
                                                        </div>
                                                        <div class="uk-width-medium-1-3">

                                                            <label for="adultPassenger">Child Pasenger</label>
                                                            <input class="md-input" type="number" id="adultPassenger"   name="childPassenger" value="{{ old('childPassenger')}} " />
                                                        </div>
                                                        <div class="uk-width-medium-1-3">

                                                            <label for="infantPassenger">Infant Pasenger</label>
                                                            <input class="md-input" type="number" id="infantPassenger"   name="infantPassenger" value="{{ old('infantPassenger')}} " />
                                                        </div>
                                                    </div>




                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="uk-grid">
                                        <div class="uk-width-medium-1-1 ">

                                            <div id="hotel_accord" class="uk-accordion" data-uk-accordion>
                                                <h3 class="uk-accordion-title uk-accordion-title-success">Hotel</h3>
                                                <div class="uk-accordion-content">
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                                            <label class="uk-vertical-align-middle" for="hotel_note">Hotel Note</label>
                                                        </div>
                                                        <div class="uk-width-medium-1-2">

                                                            <label for="hotel_note">Hotel Note</label>
                                                            <input class="md-input" type="text" id="hotel_note"   name="hotel_note" value="{{ old('hotel_note')}} " />
                                                        </div>
                                                    </div>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                                            <label class="uk-vertical-align-middle" for="customer_name">Hotel Title</label>
                                                        </div>
                                                        <div class="uk-width-medium-1-2">
                                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Hotel id" id="order_id" name="ticket_hotel_id">
                                                                <option value="">Select Hotel Title</option>
                                                                @foreach($ticket_hotel as $value)
                                                                    <option value="{!! $value->id !!}">{!! $value->title !!}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>


                                    <div class="uk-grid">
                                        <div class="uk-width-medium-1-1 ">

                                            <div id="IATA_accor" class="uk-accordion" data-uk-accordion>
                                                <h3 class="uk-accordion-title uk-accordion-title-success">IATA Information</h3>
                                                <div class="uk-accordion-content">
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                                            <label class="uk-vertical-align-middle" for="fareAmount">Fare Amount</label>
                                                        </div>
                                                        <div class="uk-width-medium-2-5">

                                                            <label for="documentNumber">Fare Amount</label>
                                                            <input class="md-input" type="number" id="fareAmount" name="fareAmount" />
                                                        </div>
                                                    </div>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                                            <label class="uk-vertical-align-middle" for="iata_commissionRate">Commission Rate</label>
                                                        </div>
                                                        <div class="uk-width-medium-2-5">

                                                            <label for="iata_commissionRate">Commission Rate</label>
                                                            <input class="md-input" type="number" id="iata_commissionRate" required value="{!! isset($commition->commissionRate)?$commition->commissionRate:'' !!}" name="commissionRate"/>
                                                        </div>
                                                    </div>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                                            <label class="uk-vertical-align-middle" for="documentNumber">Tax On Commission</label>
                                                        </div>
                                                        <div class="uk-width-medium-2-5">

                                                            <label for="documentNumber">Tax On Commission</label>
                                                            <input class="md-input" type="number" id="adultPassenger" name="taxOnCommission" value="{{ old("taxOnCommission") }}"/>
                                                        </div>
                                                    </div>




                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-5">
                                                            <h4>Ticket Tax:</h4>
                                                       </div>
                                                       <div class="uk-width-medium-1-2">
                                                            <div class="md-card">
                                                                <div class="md-card-content">
                                                                    <form action="" data-parsley-validate>
                                                                        <div class="uk-grid uk-grid-medium form_section" id="d_form_section" data-uk-grid-match>

                                                                            <div class="uk-width-9-10">
                                                                                <div class="uk-grid">
                                                                                    <div class="uk-width-1-1">
                                                                                        <div class="parsley-row">
                                                                                            <label>Title</label>
                                                                                            <input id="iata_info_title" type="text" class="md-input" name="title[]" >
                                                                                            @if($errors->has('title'))
                                                                                                <div class="uk-text-danger">{{ $errors->first('title') }}</div>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="uk-grid">
                                                                                    <div class="uk-width-1-1">
                                                                                        <div class="parsley-row">
                                                                                            <label>Amount</label>
                                                                                            <input  id="iata_info_amount" type="text" class="md-input" name="amount[]" >
                                                                                            @if($errors->has('amount'))
                                                                                                <div class="uk-text-danger">{{ $errors->first('amount') }}</div>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="uk-width-1-10 uk-text-center">
                                                                                <div class="uk-vertical-align uk-height-1-1">
                                                                                    <div class="uk-vertical-align-middle">
                                                                                        <a href="#" class="btnSectionClone" data-section-clone="#d_form_section"><i class="material-icons md-36">&#xE146;</i></a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>

                                            </div>
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

                                                    <select name="bill_particular" id="bill_item" class="md-input" data-uk-tooltip="{pos:'top'}" title="Select Item">
                                                        <option value="" disabled selected hidden>Select...</option>
                                                        @foreach($item as $value)
                                                            <option value="{{ $value->id }}">{{ $value->item_name }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>

                                            </div>

                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="bill_Quantity">Quantity</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">

                                                    <label id="lavel_quantity" for="bill_Quantity">Quantity</label>
                                                    <input class="md-input" type="number" id="bill_quantity" name="bill_qty" value="{{ old("bill_qty") }}"/>
                                                </div>
                                            </div>
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="bill_Rate">Rate</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">

                                                    <label id="lavel_rate" for="bill_Rate">Rate</label>
                                                    <input  class="md-input" step="any" type="number" id="bill_Rate" name="bill_rate" value="{{ old("bill_rate") }}"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-grid uk-ma" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-left">
                                            <input type="submit" class="md-btn md-btn-primary" value="confirm" name="confirm" />
                                            <input type="submit" class="md-btn md-btn-warning" value="Save" name="save" />

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
    //var invoice_item
    // var bill_item


    $("input,.btnSectionRemove").on("input click",function () {

        var commissionTax = null, alltax_amount=0, iata_commissionRate = null,total=0;
        var tax= "{{ $commition->commissionTax }}";
        commissionTax = parseFloat(tax);
        var vendor = null;
        vendor= $("#vendor_id option:selected").text().toLowerCase()||'';

        var total = null, fareAmount=null, transaction_amount = null, amt_rate= null, tax_on_commission = null,new_tax_amount=0;
        $("[id=iata_info_amount]").each(function(index, val){
            alltax_amount =alltax_amount+parseFloat($(val).val())||0;
        });
        var amt = [];
        var title = [];
        $("[id=iata_info_amount]").each(function(index, val){
            amt.push($(val).val()||0);
        });
        $("[id=iata_info_title]").each(function(index, val){
            title.push($(val).val());
        });
        title.forEach(function(newtitle,i) {
            if(newtitle.toString().toLowerCase()!="bd" && newtitle.toString().toLowerCase()!="ut"){
                new_tax_amount = new_tax_amount + parseFloat(amt[i]);
            }
        });

        fareAmount = parseFloat($("#fareAmount").val())||0;
        iata_commissionRate = parseFloat($("#iata_commissionRate").val())||0;
        transaction_amount = fareAmount + alltax_amount;
        amt_rate = (fareAmount * iata_commissionRate)/100;
        tax_on_commission= ((fareAmount + new_tax_amount)*commissionTax)/100;
        total =  transaction_amount-amt_rate+tax_on_commission;


        if(vendor.match("iata"))
        {

            var check =$("#bill_quantity").val();
            if(check>1){

            }else{

                $("#bill_quantity").val(1);

            }



            if($(this).attr("id").match("bill_Rate")){
            }else{
                $("#bill_Rate").val(total.toFixed(2));
            }




            $("#lavel_rate").hide();
            $("#lavel_quantity").hide();





            return true;
        }
      //  $("#bill_Rate").val(0);

    });

    $("#vendor_id").on("change",function () {

       var commissionTax = null, alltax_amount=0, iata_commissionRate = null,total=0;
       var tax= "{{ $commition->commissionTax }}";
        commissionTax = parseFloat(tax);
        var vendor = null;
        vendor= $(this).text().toLowerCase().trim();
        var total = null, fareAmount=null, transaction_amount = null, amt_rate= null, tax_on_commission = null,new_tax_amount=0;

        $("[id=iata_info_amount]").each(function(index, val){
            alltax_amount =alltax_amount+parseFloat($(val).val())||0;
        });
        var amt = [];
        var title = [];
        $("[id=iata_info_amount]").each(function(index, val){
           amt.push($(val).val());
        });
        $("[id=iata_info_title]").each(function(index, val){
            title.push($(val).val());
        });
        title.forEach(function(newtitle,i) {
            if(newtitle.toString().toLowerCase()!="bd" && newtitle.toString().toLowerCase()!="ut"){
                new_tax_amount = new_tax_amount + parseFloat(amt[i]);
            }

        });

        fareAmount = parseFloat($("#fareAmount").val())||0;
        iata_commissionRate = parseFloat($("#iata_commissionRate").val())||0;
        transaction_amount = fareAmount + alltax_amount;
        amt_rate = (fareAmount * iata_commissionRate)/100;
        tax_on_commission= ((fareAmount + new_tax_amount)*commissionTax)/100;
        total =  transaction_amount-amt_rate+tax_on_commission;


        if(vendor.match("iata"))
        {

            var check =$("#bill_quantity").val();
            if(check>1){

            }else{
                $("#bill_quantity").val(1);
                $("#bill_Rate").val(total.toFixed(2));
                $("#lavel_rate").hide();
                $("#lavel_quantity").hide();
            }


            return true;
        }

        $("#bill_Rate").val(0);
    });
    function itemchange(product)
    {
        var item = $(product).find(':selected').val();
        item = item.split("_");
        $("#invoice_item option[value=" + item[1] + "]").attr('selected','selected');
        $("#bill_item option[value=" + item[1] + "]").attr('selected','selected');
    }

    var accordion = UIkit.accordion(document.getElementById('accor'), {
        showfirst:false

    });
    var accordion = UIkit.accordion(document.getElementById('passangerdetailsaccord'), {
        showfirst:false

    });
    var accordion = UIkit.accordion(document.getElementById('hotel_accord'), {
        showfirst:false

    });
    var accordion = UIkit.accordion(document.getElementById('IATA_accor'), {
        showfirst:false

    });

    $("#checkbox_invoice").on("click",function () {
        $("#invoice_details").toggle(800);
    });
    $("#checkbox_bill").on("click",function () {
        $("#bill_details").toggle(800);

        $("#bill_quantity").trigger("select");
        $("#bill_Rate").trigger("select");


    });
    $('#sidebar_ticket_order_new').addClass('act_item');
    $('#sidebar_ticketing').addClass('current_section');
    $(window).load(function(){
        $("#tiktok").trigger('click');
    })
</script>


@endsection