@extends('layouts.admin')

@section('title', 'Edit Confirmation')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
<body onsubmit="return myFunc();">
    <div class="uk-grid" ng-controller="InvoiceController">
        <div class="uk-width-large-10-10">
            @if(Session::has('msg'))
                <div class="uk-alert uk-alert-success" data-uk-alert>
                    <a href="#" class="uk-alert-close uk-close"></a>
                    {!! Session::get('msg') !!}
                </div>
            @endif
            {!! Form::open(['url' => route('confirmation_update',$recruit->confirmation->id), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit Confirmation</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Pax Id <i style="color:red" class="material-icons">stars</i></label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Customer" id="customer_id" name="paxid" readonly>
                                            <option value="">Select Pax Id</option>
                                            @foreach($order as $value)
                                                @if($value->id == $recruit->confirmation->pax_id)
                                                    <option value="{!! $value->id !!}" selected>{!! $value->paxid !!}</option>
                                                
                                                @endif
                                            @endforeach
                                        </select>
                                        @if($errors->has('paxid'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('paxid')!!}</span>

                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Flight Number</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Flight Number</label>
                                        <input class="md-input" type="text" name="flight_number" value="{!! $recruit->confirmation->flight_number !!}">
                                        
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Date of Flight</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select date</label>
                                        <input class="md-input" type="text" id="uk_dp_1" name="date_of_flight" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{!! $recruit->confirmation->date_of_flight !!}">
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Departure Time</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Departure Time</label>
                                        <input class="md-input" type="text" name="departure_time" data-uk-timepicker value="{!! $recruit->confirmation->departure_time !!}">
                                        
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Arrival Time</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Arrival Time</label>
                                        <input class="md-input" type="text" name="arrival_time" data-uk-timepicker value="{!! $recruit->confirmation->arrival_time !!}">
                                        
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">E-ticket Number</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select E-ticket Number</label>
                                        <input class="md-input" type="text" name="e_ticket_number" value="{!! $recruit->confirmation->e_ticket_number !!}">
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="invoice_date">Vendor Name</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <select id="select_demo_5" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select with tooltip" name="vendor_name">
                                                <option value="">Select Contact</option>
                                                @foreach($contact as $all)
                                                @if($all->id == $recruit->confirmation->vendor_name)
                                                <option value="{{ $all->id }}" selected>{{ $all->display_name }}</option>
                                                @else
                                                <option value="{{ $all->id }}">{{ $all->display_name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @if($errors->has('vendor_name'))

                                                <span style="color:red; position: relative; right:-500px">{!!$errors->first('vendor_name')!!}</span>

                                            @endif
                                        </div>
                                    </div>
  
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_number">Comments </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_number"></label>
                                        <textarea type="text" name="comment" class="md-input" cols="4" rows="4" id="comment">{!! $recruit->confirmation->comment !!}</textarea>
                                       
                                    </div>
                                </div>

                                {{--<div class="uk-grid" data-uk-grid-margin>--}}
                                        {{--<div class="uk-width-medium-1-5 uk-vertical-align">--}}
                                            {{--<label class="uk-vertical-align-middle" for="visaType">Upload File</label>--}}
                                        {{--</div>--}}
                                        {{--<div class="uk-width-medium-2-5">--}}
                                            {{--<div class="md-card">--}}
                                                {{--<div class="md-card-content">--}}
                                                    {{--<div class="uk-grid form_section" id="d_form_row">--}}
                                                        {{--<div class="uk-width-1-1">--}}
                                                            {{--<div class="uk-input-group">--}}
                                                                {{--<label for="visaType">Title</label>--}}
                                                                {{--<input type="text" id="visaType" class="md-input" name="title[]" />--}}
                                                                {{--<br>--}}
                                                                {{--<br>--}}
                                                                {{--<input type="file" class="md-input" name="img_url[]">--}}
                                                                {{--<span class="uk-input-group-addon">--}}
                                                                     {{--<a href="#" class="btnSectionClone" data-section-clone="#d_form_row"><i class="material-icons md-24">&#xE146;</i></a>--}}
                                                                 {{--</span>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                @foreach($recruit->confirmation->confirmationFile as $file)
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="visaType">Upload File</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <div class="md-card">
                                                <div class="md-card-content">
                                                    <div class="uk-grid form_section" id="d_form_row">
                                                        <div class="uk-width-1-1">
                                                            <a href="{!! asset('all_image/') !!}/{!! $file->img_url !!}" style="float:right;" class="md-btn md-btn-primary md-btn-mini md-btn-wave-light" download>Download</a>

                                                            <div class="uk-input-group">
                                                               <label for="visaType">Title</label>
                                                                <input type="text" id="visaType" class="md-input" value="{!! $file['title'] !!}"  name="title[{!! 'old_'.$file['id'] !!}]" />
                                                                <br>
                                                                <br>
                                                                <input type="file" class="md-input" name="img_url[{!! 'old_'.$file['id'] !!}]">
                                                                <input type="hidden" value="{!! $file['id'] !!}" name="img_id[]" >
                                                                <br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <img src="{!! asset('all_image/') !!}/{!! $file->img_url !!}" alt="...." height="60" width="150"/>
                                        </div>
                                    </div>
                                    @endforeach
                                @if($errors->has('bill_particular')|| $errors->has('bill_rate') ||$errors->has('bill_qty'))

                                    <span style="color:red; position: relative; right:0px">{!! "Bill field required" !!}</span>

                                @endif

                                @if($recruit->confirmation['bill_id']==null)
                                <div class="uk-grid" >
                                    <div class="uk-width-1-2" >
                                        <div style=" padding:10px;color: white; background-color: #2D2D2D ">
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
                                                    @foreach($item2 as $value)
                                                        <option value="{{ $value->id }}">{{ $value->item_name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <label class="uk-vertical-align-middle" for="visaType">
                                                <a href="{{ route('inventory_create') }}?confirmation={{$recruit->confirmation->pax_id}}" type="submit" class="sm-btn sm-btn-primary">+ Create Sector</a>
                                            </label>
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

                                @else

                                    <div class="uk-grid" >
                                        <div class="uk-width-1-2" >
                                            <div style=" padding:10px;color: white; background-color: #2D2D2D ">
                                                Bill - {!! $bill_rate->bill['bill_number'] !!}
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
                                                        <option value="{{ $item->id }}" selected>{{ $item->item_name }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="Quantity">Quantity</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <label for="Quantity">Quantity</label>
                                                    <input class="md-input" type="number" id="Quantity" name="bill_qty" disabled value="{{ $bill_rate->quantity }}"/>
                                                </div>
                                            </div>

                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="Rate">Rate</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <label for="Rate">Rate</label>
                                                    <input class="md-input" type="number" id="Rate" disabled name="bill_rate" value="{{ $bill_rate->rate }}"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                <hr class="uk-grid-divider">
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-large-1-3">
                                        <span class="uk-text-muted uk-text-small">Created By</span>
                                    </div>
                                    <div class="uk-width-large-2-3">
                                        <span class="uk-text-large uk-text-middle">{!! isset($recruit->createdBy['name']) ? $recruit->createdBy['name']:''  !!}</span>
                                    </div>
                                </div>
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-large-1-3">
                                        <span class="uk-text-muted uk-text-small">Updated By</span>
                                    </div>
                                    <div class="uk-width-large-2-3">
                                        <span class="uk-text-large uk-text-middle">{!! isset($recruit->updatedBy['name']) ? $recruit->updatedBy['name']:''  !!}</span>
                                    </div>
                                </div>

                                <hr class="uk-grid-divider">
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-large-1-3">
                                        <span class="uk-text-muted uk-text-small">Created At</span>
                                    </div>
                                    <div class="uk-width-large-2-3">
                                        <span class="uk-text-large uk-text-middle">{!! isset($recruit->created_at) ? $recruit->created_at:''  !!}</span>
                                    </div>
                                </div>
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-large-1-3">
                                        <span class="uk-text-muted uk-text-small">Updated At</span>
                                    </div>
                                    <div class="uk-width-large-2-3">
                                        <span class="uk-text-large uk-text-middle">{!! isset($recruit->updated_at) ? $recruit->updated_at:''  !!}</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="uk-grid uk-ma" data-uk-grid-margin>
                                    <div class="uk-width-2-5 uk-float-left">
                                        <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                        <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('scripts')

    <script>

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
        });

        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_confirmation').addClass('act_item');
        $(window).load(function(){
            $("#tiktok2").trigger('click');
        });
        altair_forms.parsley_validation_config();
    </script>

    <script>
        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_confirmation').addClass('act_item');
        $(window).load(function(){
            $("#tiktok2").trigger('click');
        });
        altair_forms.parsley_validation_config();
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection
