@extends('layouts.main')

@section('title', 'Create Recruit Order ')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
    <body onload="load()">


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
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New order</span></h2>
                                <div class="uk-width-medium-1-3">
                                    <div class="md-btn-group">
                                        <a href="{{ route('order') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">All</a>
                                        <a href="{{ route('order_create') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Add</a>
                                        <a href="{{ URL::previous() }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md-card">
                            {!! Form::open(['url' => route('order_store'), 'method' => 'POST','files' => true]) !!}
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <!-- <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="payment_date">PassPort Date<span style="color: red">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="payment_date">Select date</label>
                                            <input class="md-input" type="text" id="order_date" name="order_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{old('order_date')}}" />
                                        </div>
                                        @if($errors->first('order_date'))
                                            <div class="uk-text-danger">Date is required.</div>
                                        @endif
                                    </div> -->
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="payment_date">PassPort Issue  Date<span style="color: red">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="payment_date">Select date</label>
                                            <input class="md-input" type="text" id="order_date" name="issue_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{old('issue_date')}}" />
                                        </div>
                                        @if($errors->first('issue_date'))
                                            <div class="uk-text-danger">Date is required.</div>
                                        @endif
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="Local">Local Reference<span style="color: red">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="Local">Local Reference </label>
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Customer" id="local_ref" name="customer_id">
                                                <option>Select Local Reference</option>
                                                @foreach($customer as $value)
                                                    <option value=" {{ $value->id }}" > {{ $value->display_name }} </option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('customer_id'))
                                                <div class="uk-text-danger">{{ $errors->first('customer_id') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="iqamaNumber">Passenger Name<span style="color: red">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="passportNumber">Passenger Name</label>
                                            <input class="md-input" type="text" id="passenger_name"  name="passenger_name" value="{{ old('passenger_name')}}" />
                                            @if($errors->has('passenger_name'))
                                                <div class="uk-text-danger">{{ $errors->first('passenger_name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                     <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-5 uk-vertical-align">
                                                <label class="uk-vertical-align-middle" for="gender">Gander <span style="color: red">*</span></label>
                                            </div>
                                            <div class="uk-width-medium-2-5">

                                                <span class="icheck-inline">
                                        <input checked type="radio" name="gender" value="male" id="gender" data-md-icheck />
                                        <label for="gender" class="inline-label">Male</label>
                                    </span>
                                                <span class="icheck-inline">
                                        <input type="radio" name="gender" id="gender" value="female" data-md-icheck />
                                        <label for="gender" class="inline-label">Female</label>
                                    </span>
                                                @if($errors->has('gender'))
                                                    <div class="uk-text-danger">{{ $errors->first('gender') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    <div class="uk-grid hidden" data-uk-grid-margin style="visibility: hidden">
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="Local">Order Status<span style="color: red">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="Local">Order Status</label>
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Customer" class="order_image" id="local_ref" onchange="orderimage()" name="order_status">
                                                    <option>Select Order Status</option>
                                                    <option value="1" >Completed</option>
                                                    <option value="2" >Cancelled</option>
                                            </select>
                                            @if($errors->has('customer_id'))
                                                <div class="uk-text-danger">{{ $errors->first('customer_id') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin id="substitued_order">
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="passportNumber">Substitued Order</label>
                                            <input class="md-input" type="text" id="substitued_order"  name="substitued_order" value="{{ old('passenger_name')}}" />
                                            @if($errors->has('substitued_order'))
                                                <div class="uk-text-danger">{{ $errors->first('substitued_order') }}</div>
                                            @endif
                                        </div>
                                    </div>


                                    {{--<div class="uk-grid" data-uk-grid-margin>--}}

                                        {{--<div class="uk-width-medium-1-5 uk-vertical-align">--}}
                                            {{--<label class="uk-vertical-align-middle" for="Local">Package<span style="color: red">*</span></label>--}}
                                        {{--</div>--}}
                                        {{--<div class="uk-width-medium-2-5">--}}
                                            {{--<label for="Local">Package </label>--}}
                                            {{--<select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select package" id="local_ref" name="package_id">--}}
                                                {{--<option>Select Package</option>--}}
                                                {{--@foreach($package as $value)--}}
                                                    {{--<option value=" {{ $value->id }} " > {{ $value->item_name }} </option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                            {{--@if($errors->has('package_id'))--}}
                                                {{--<div class="uk-text-danger">{{ $errors->first('package_id') }}</div>--}}
                                            {{--@endif--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                 {{--<div class="uk-grid" data-uk-grid-margin>--}}

                                        {{--<div class="uk-width-medium-1-5 uk-vertical-align">--}}
                                            {{--<label class="uk-vertical-align-middle" for="Local">Register Serial<span style="color: red">*</span></label>--}}
                                        {{--</div>--}}
                                        {{--<div class="uk-width-medium-2-5">--}}
                                            {{--<label for="Local">RegisterSerial </label>--}}
                                            {{--<select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Serail" id="local_ref" name="registerSerial_id">--}}
                                                {{--<option>Select RegisterSerial</option>--}}
                                                {{--@foreach($registerserial as $value)--}}
                                                    {{--<option value=" {{ $value->id }} " > {{ $value->registerSerial }} </option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="order_pax">Pax <span style="color: red">*</span> </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <input class="md-input" type="text" id="order_pax" onkeyup="checkchar(this)" name="paxid" readonly/>
                                            <span id="order_pax_msg"></span>
                                            @if($errors->has('paxid'))
                                                <div class="uk-text-danger">{{ $errors->first('paxid') }}</div>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="iqamaNumber">Passport Number<span style="color: red">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="passportNumber">Passport Number</label>
                                            <input class="md-input" type="text" id="passportNumber" oninput="input()" name="passportNumber" value="{{ old('passportNumber')}}" />
                                            @if($errors->has('passportNumber'))
                                                <div class="uk-text-danger">{{ $errors->first('passportNumber') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="iqamaNumber">Sales Rate</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="passportNumber">Sales Rate</label>
                                            <input class="md-input" type="text" id="salesRate" name="salesRate" />
                                        </div>
                                    </div>
                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-5 uk-vertical-align">
                                                <label class="uk-vertical-align-middle" for="commission_type">Commission Type</label>
                                            </div>
                                            <div class="uk-width-medium-2-5">
                                                <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Type" id="commission_type" name="commission_type">
                                                    <option value="">Select Commission Type</option>
                                                    <option value="1">%</option>
                                                    <option value="2">BDT</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-5  uk-vertical-align">
                                                <label class="uk-vertical-align-middle" for="agent_commission_amount">Commission Amount</label>
                                            </div>
                                            <div class="uk-width-medium-2-5">
                                                <label for="agent_commission_amount">Agent Commission</label>
                                                <input class="md-input" type="text" id="agent_commission_amount" name="agent_commission_amount">
                                            </div>
                                        </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="placeofissue">Place Of Issue</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="placeofissue">Place Of Issue</label>
                                            <input class="md-input" type="text" id="placeofissue"  name="placeofissue" value="{{ old('placeofissue')}}" />
                                            @if($errors->has('placeofissue'))
                                                <div class="uk-text-danger">{{ $errors->first('placeofissue') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="remarks">Remarks</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="remarks">Remarks</label>
                                            <input class="md-input" type="text" id="remarks"  name="remarks" value="{{ old('remarks')}}" />
                                            @if($errors->has('remarks'))
                                                <div class="uk-text-danger">{{ $errors->first('remarks') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                        <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="company_name">Visa Category<i style="color: red">*</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                        <label for="company_name">Visa Category </label>
                                        <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Visa type" id="company_name" name="visa_type" >
                                        <option value="1">Processing Visa</option>
                                        <option value="0">Company Visa</option>
                                        </select>
                                        @if($errors->has('visa_type'))
                                        <div class="uk-text-danger">{{ $errors->first('visa_type') }}</div>
                                        @endif
                                        </div>
                                        </div>

                                    <hr>

                                    <br>
                                    <br>
                                    <br>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="visaType">Upload File<i style="color: red">*</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <div class="md-card">
                                                <div class="md-card-content">
                                                    <div class="uk-grid form_section" id="d_form_row">
                                                        <div class="uk-width-1-1">
                                                            <div class="uk-input-group">
                                                                <label for="visaType">Title</label>
                                                                <input type="text" id="visaType" class="md-input"  name="title[]" required="1" />
                                                                <br>
                                                                <br>
                                                                <input id="img_url" type="file" class="md-input" name="img_url[]" required="1">
                                                                @if($errors->has('img_url'))
                                                                    <div class="uk-text-danger">{{ $errors->first('img_url') }}</div>
                                                                @endif
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="uk-grid uk-ma" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-left">
                                            <input type="submit" class="md-btn md-btn-primary" name="submit" value="Submit">
                                            <input type="submit" class="md-btn md-btn-primary" name="save" value="Add More Details">
                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
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

            function load() {
                $('#substitued_order').hide();
            }
            function orderimage() {

                var selectOption = $('.order_image').val();

                if (selectOption == 1) {

                    $('#substitued_order').hide();
                }

                if (selectOption == 2) {

                    $('#substitued_order').show();
                }

            }

            function input() {
                var value= $('#passportNumber').val();
                $('#order_pax').val(value);

            }

            setInterval(function () {
              var uploadedfile = document.querySelectorAll('#img_url').length;
              var old = document.querySelectorAll('.old').length;

              if(uploadedfile>=3){

                  $('.main_upload_sec').hide();

              }else{
                  $('.main_upload_sec').show();
              }


              if(uploadedfile==3){
                  $('.btnSectionRemove').hide();

              }else{
                  $('.btnSectionRemove').show();

              }

          },1000);
          $('.btnSectionClone').on('click',function(e){
              var uploadedfile = document.querySelectorAll('#img_url').length;
                 if(uploadedfile>=2){
                     e.stop();


                 }
          });



    $('#sidebar_recruit').addClass('current_section');
    $('#sidebar_recruit_order').addClass('act_item');

    $('#order_pax').on('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Z0-9-]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        // if (!regex.test(key)) {
        //     event.preventDefault();
        //     $('#order_pax_msg').text("Not Allowed, only '-' is allowed").css("color", "red");
        //     return false;
        // }else{
        //     $('#order_pax_msg').text('');
        // }
        if (!regex.test(key) && !/[\b]/.test(key)) {
            event.preventDefault();
            $('#order_pax_msg').text("Not Allowed, only '-' is allowed").css("color", "red");
            return false;
        }else{
            $('#order_pax_msg').text('');
        }
    });


</script>
    </body>

@endsection