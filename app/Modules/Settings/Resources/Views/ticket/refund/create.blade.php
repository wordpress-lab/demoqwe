@extends('layouts.main')

@section('title', 'Ticket Refund Create')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New Ticket Refund</span></h2>
                                
                            </div>
                        </div>
                        <div class="md-card">
                            {!! Form::open(['url' => route('ticket_refund_store'), 'method' => 'POST']) !!}
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="contact_id">Contact Name <span style="color: red">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Customer" id="vendor_id" name="vendor_id">
                                                <option value="">Select Customer</option>
                                                @foreach($contact as $value)
                                                    <option value=" {{ $value->id }} " > {{ $value->display_name }} </option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('vendor_id'))
                                                <div class="uk-text-danger">{{ $errors->first('vendor_id') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="contact_id">Vendor Name <span style="color: red">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Customer Category" id="contact_id" name="contact_id" required>
                                                <option value="">Select Vendor</option>
                                                @foreach($contact as $value)
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
                                            <label class="uk-vertical-align-middle" for="returnflightarrivalDate">Submit Date <span style="color: red">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="returnflightarrivalDate">Submit Date</label>
                                            <input class="md-input" type="text" id="issuDate" name="issuDate" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{ $date }}" required/>
                                            @if($errors->has('issuDate'))
                                                <div class="uk-text-danger">{{ $errors->first('issuDate') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="uk-grid">
                                        <div class="uk-width-medium-1-1 ">

                                            <div id="passangerdetailsaccord" class="uk-accordion" data-uk-accordion>
                                                <h3 class="uk-accordion-title uk-accordion-title-success">Details</h3>
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

                                                        <div class="uk-width-medium-1-2">
                                                            <label for="ticket_number">Ticket Number</label>
                                                            <input class="md-input" type="text" id="ticket_number"  name="ticket_number" value="{{ old('ticket_number')}}" />

                                                        </div>

                                                    </div>

                                                    <div class="uk-grid" data-uk-grid-margin>

                                                        <div class="uk-width-medium-1-2">

                                                            <label for="departureSector">Refund Sector</label>

                                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" name="refund_sector" id="refund_sector" onchange="itemchange(this)" class="md-input" data-uk-tooltip="{pos:'top'}" title="Select with Sector Item">
                                                                <option value="" selected>Select...</option>
                                                                 @foreach($item as $value)
                                                                    <option value="{{$value->id}}">{{ $value['item_name'] }}</option>
                                                                 @endforeach
                                                            </select>
                                                        </div>
                                                        
                                                    </div>

                                                    <div class="uk-grid" data-uk-grid-margin>

                                                        <div class="uk-width-medium-1-2">
                                                            <label for="receive_date">Receive Date</label>
                                                            <input class="md-input" type="text" id="receive_date" name="receive_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{old('receive_date')}}" />
                                                        </div>
                                                        
                                                        <div class="uk-width-medium-1-2">
                                                            <label for="issue_date">Issue Date</label>
                                                            <input class="md-input" type="text" id="issue_date" name="issue_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{old('issue_date')}}" />
                                                        </div>

                                                    </div>

                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-2">
                                                            <label for="receive_date">Statement Date</label>
                                                            <input class="md-input" type="text" id="statement_date" name="statement_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{old('statement_date')}}" />
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                    @if($errors->has('invoice_rate') ||$errors->has('invoice_qty'))

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
                                                        <option value="" selected>Select...</option>
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
                                                    @if($errors->has('invoice_qty'))
                                                        <div class="uk-text-danger">{{ $errors->first('invoice_qty') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="Rate">Rate</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">

                                                    <label for="Rate">Rate</label>
                                                    <input class="md-input" type="number" id="Rate" name="invoice_rate" value="{{ old("invoice_rate") }}"/>
                                                    @if($errors->has('invoice_rate'))
                                                        <div class="uk-text-danger">{{ $errors->first('invoice_rate') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if($errors->has('bill_rate') ||$errors->has('bill_qty'))

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
                                                        <option value="" selected>Select...</option>
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
                                                    @if($errors->has('bill_qty'))
                                                        <div class="uk-text-danger">{{ $errors->first('bill_qty') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="bill_Rate">Rate</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">

                                                    <label id="lavel_rate" for="bill_Rate">Rate</label>
                                                    <input  class="md-input" step="any" type="number" id="bill_Rate" name="bill_rate" value="{{ old("bill_rate") }}"/>
                                                    @if($errors->has('bill_rate'))
                                                        <div class="uk-text-danger">{{ $errors->first('bill_rate') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid uk-ma" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-left">
                                            <input type="submit" class="md-btn md-btn-primary" value="confirm" name="confirm" />
                                            
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

    var accordion = UIkit.accordion(document.getElementById('passangerdetailsaccord'), {
        showfirst:false

    });

    $("#checkbox_invoice").on("click",function () {
        $("#invoice_details").toggle(800);
    });

    $("#checkbox_bill").on("click",function () {
        $("#bill_details").toggle(800);

    });

    $('#sidebar_ticket_all_refund').addClass('act_item');
    $('#sidebar_ticketing').addClass('current_section');
    $(window).load(function(){
        $("#tiktok").trigger('click');
    })

    function itemchange(product)
    {
        var item = $(product).find(':selected').val();
        
        $("#invoice_item option[value=" + item + "]").attr('selected','selected');
        $("#bill_item option[value=" + item + "]").attr('selected','selected');
    }

</script>


@endsection