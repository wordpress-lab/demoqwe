@extends('layouts.main')

@section('title', 'Ticket Refund Edit')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit Ticket Refund</span></h2>
                                
                            </div>
                        </div>
                        <div class="md-card">
                            {!! Form::open(['url' => route('ticket_refund_update',$refund->id), 'method' => 'POST']) !!}
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
                                                    <option value=" {{ $value->id }}" {{ ($refund->customer_id == $value->id )?'selected':'' }}> {{ $value->display_name }} </option>
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
                                                    <option  value=" {{ $value->id }} " {{ ($refund->vendor_id == $value->id )?'selected':'' }}> {{ $value->display_name }} </option>
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
                                            <input class="md-input" type="text" id="issuDate" name="issuDate" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{ $refund->submit_date }}" required/>
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
                                                            <input class="md-input" type="text" id="first_name"  name="first_name" value="{{ $refund->first_name }} " />

                                                        </div>
                                                        <div class="uk-width-medium-1-2">
                                                            <label for="last_name">Last Name</label>
                                                            <input class="md-input" type="text" id="last_name"  name="last_name" value="{{ $refund->last_name }} " />

                                                        </div>
                                                    </div>

                                                    <div class="uk-grid" data-uk-grid-margin>

                                                        <div class="uk-width-medium-1-2">
                                                            <label for="ticket_number">Ticket Number</label>
                                                            <input class="md-input" type="text" id="ticket_number"  name="ticket_number" value="{{ $refund->ticket_number }}" />

                                                        </div>

                                                    </div>

                                                    <div class="uk-grid" data-uk-grid-margin>

                                                        <div class="uk-width-medium-1-2">

                                                            <label for="departureSector">Refund Sector</label>

                                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" name="refund_sector" id="refund_sector" onchange="itemchange(this)" class="md-input" data-uk-tooltip="{pos:'top'}" title="Select with Sector Item">
                                                                <option value="" selected>Select...</option>
                                                                 @foreach($item as $value)
                                                                    <option value="{{$value->id}}" {{ ($refund->refund_sector == $value->id )?'selected':'' }} >{{ $value['item_name'] }}</option>
                                                                 @endforeach
                                                            </select>
                                                        </div>
                                                        
                                                    </div>

                                                    <div class="uk-grid" data-uk-grid-margin>

                                                        <div class="uk-width-medium-1-2">
                                                            <label for="receive_date">Receive Date</label>
                                                            <input class="md-input" type="text" id="receive_date" name="receive_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{$refund->receive_date}}" />
                                                        </div>
                                                        
                                                        <div class="uk-width-medium-1-2">
                                                            <label for="issue_date">Issue Date</label>
                                                            <input class="md-input" type="text" id="issue_date" name="issue_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{$refund->issue_date}}" />
                                                        </div>

                                                    </div>

                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-2">
                                                            <label for="receive_date">Statement Date</label>
                                                            <input class="md-input" type="text" id="statement_date" name="statement_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{$refund->statement_date}}" />
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
                                             Invoice <span style="color:gold"> {{ $refund->invoice?'#'.$refund->invoice['invoice_number']:'' }} </span>
                                         </div>

                                       </div>
                                        <div class="uk-width-1-2" style="padding: 10px; height: 40px; position:relative;background: maroon ">
                                           <div id="inv" style="position: absolute; right: 10px; height: 40px; ">
                                               <input type="checkbox"  id="checkbox_invoice" {{ $refund->invoice?'':"name=check_invoice" }}   style=" margin-top: -1px; height: 25px; width: 20px;" />
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

                                                    <select {{ $refund->invoice?"disabled":null }}  name="invoice_particular" id="invoice_item" class="md-input" data-uk-tooltip="{pos:'top'}" title="Select Item">
                                                        <option value="" disabled selected hidden>Select...</option>
                                                        @foreach($item as $value)
                                                          @if($refund->invoice)
                                                              @if($refund->invoice['OrderInvoiceEntries']['item_id']==$value['id'])
                                                                <option {{ "selected" }} value="{{ $value->id }}">{{ $value->item_name }}</option>

                                                              @endif

                                                          @endif
                                                          @if(!$refund->invoice &&  $refund->departureSector)
                                                                  <option {{ $refund->departureSector==$value->item_name?"selected":null }} value="{{ $value->id }}">{{ $value->item_name }}</option>
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
                                                    <input {{ $refund->invoice?'readonly':"" }} class="md-input" type="number" id="Quantity" name="invoice_qty" value="{{ $refund->invoice?$refund->invoice['OrderInvoiceEntries']['quantity']:'' }}"/>
                                                </div>
                                            </div>
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="Rate">Rate</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">

                                                    <label for="Rate">Rate</label>
                                                    <input {{ $refund->invoice?'readonly':"" }}  class="md-input" type="number" id="Rate" name="invoice_rate" value="{{ $refund->invoice?$refund->invoice['OrderInvoiceEntries']['rate']:'' }}"/>
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
                                                Bill <span style="color:gold"> {{ $refund->bill?'#'.$refund->bill['bill_number']:'' }} </span>
                                            </div>

                                        </div>
                                        <div class="uk-width-1-2" style="padding: 10px; height: 40px; position:relative;background: #2D2D2D ">
                                            <div id="inv" style="position: absolute; right: 10px; height: 40px; ">
                                                <input type="checkbox"  id="checkbox_bill" {{ $refund->bill?'':"name=check_bill" }}   style=" margin-top: -1px; height: 25px; width: 20px;" />
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

                                                    <select {{ $refund->bill?'disable':"" }}  name="bill_particular" id="bill_item" class="md-input" data-uk-tooltip="{pos:'top'}" title="Select Item">
                                                        <option value="" disabled selected hidden>Select...</option>
                                                        @foreach($item as $value)
                                                            @if($refund->bill)
                                                                @if($refund->bill['OrderbillEntries']['item_id']==$value['id'])
                                                                    <option {{ "selected" }} value="{{ $value->id }}">{{ $value->item_name }}</option>
                                                                @endif
                                                            @endif
                                                                @if(!$refund->bill &&  $refund->departureSector)
                                                                    <option {{ $refund->departureSector==$value->item_name?"selected":null }} value="{{ $value->id }}">{{ $value->item_name }}</option>
                                                                @endif
                                                            <option value="{{ $value->id }}">{{ $value->item_name }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>

                                            </div>

                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">

                                                    <label class="uk-vertical-align-middle" for="bill_quantity">Quantity </label>
                                                </div>
                                                <div class="uk-width-medium-2-5">

                                                    <label id="lavel_quantity" for="bill_quantity">Quantity</label>
                                                    <input {{ $refund->bill?'readonly':"" }} class="md-input" type="number" id="bill_quantity" name="bill_qty" value="{{ $refund->bill?$refund->bill['OrderbillEntries']['quantity']:'' }}"/>
                                                </div>
                                            </div>
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="Rate">Rate</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">

                                                    <label id="lavel_rate" for="Rate">Rate</label>
                                                    <input step="any" {{ $refund->bill?'readonly':"" }} class="md-input" type="number" id="bill_Rate" name="bill_rate" value="{{ $refund->bill?$refund->bill['OrderbillEntries']['rate']:'' }}"/>
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

    function itemchange(product)
    {
        var item = $(product).find(':selected').val();
        
        $("#invoice_item option[value=" + item + "]").attr('selected','selected');
        $("#bill_item option[value=" + item + "]").attr('selected','selected');
    }

    $('#sidebar_ticket_all_refund').addClass('act_item');
    $('#sidebar_ticketing').addClass('current_section');
    $(window).load(function(){
        $("#tiktok").trigger('click');

        var item = $("#refund_sector").find(':selected').val();

        $("#invoice_item option[value=" + item + "]").attr('selected','selected');
        $("#bill_item option[value=" + item + "]").attr('selected','selected');
        
    })
</script>


@endsection