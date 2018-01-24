@extends('layouts.main')

@section('title', 'Visa Creation')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Update Visa</span></h2>
                                <div class="uk-width-medium-1-3">
                                    <div class="md-btn-group">
                                        <a href="{{ route('visa') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">All</a>
                                        <a href="{{ route('visa_create') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Add</a>
                                        <a href="{{ URL::previous() }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md-card">
                            {!! Form::open(['url' => route('visa_update',$visa->id), 'method' => 'POST','files' => true]) !!}
                            <div class="user_content">
                                <div class="uk-margin-top">

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="company_name">Company Name</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="company_name">Company Name</label>
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Company Name" id="company_name" name="company_name" >
                                                <option>Select Company Name</option>
                                                @foreach($company as $value)
                                                    @if($value->id == $visa->company_id)
                                                        <option selected value=" {{ $value->id }} " > {{ $value->name }} </option>
                                                    @else
                                                        <option value=" {{ $value->id }} " > {{ $value->name }} </option>
                                                    @endif
                                                @endforeach
                                            </select>

                                            @if($errors->has('company_name'))
                                                <div class="uk-text-danger">{{ $errors->first('company_name') }}</div>
                                            @endif
                                        </div>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="visaType">
                                                <a href="{!! route('company_create') !!}" type="submit" class="sm-btn sm-btn-primary" target="_blank" >+ Create Company</a>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="payment_date">Visa Date <i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="payment_date">Select date</label>
                                            <input class="md-input" type="text" id="visa_date" name="visa_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{ $visa->date  }}" />
                                        </div>
                                        @if($errors->first('visa_date'))
                                            <div class="uk-text-danger">Date is required.</div>
                                        @endif
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="Local">Local Reference <i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="Local">Local Reference</label>
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Local Refrence" id="local_ref" name="local_ref">
                                                <option>Select Local Reference</option>
                                                @foreach($contact as $value)
                                                    @if($value->id==$visa->local_Reference)
                                                    <option selected value="{{ $value->id }}"> {{ $value->display_name }} </option>
                                                    @else
                                                        <option value="{{ $value->id }}"> {{ $value->display_name }} </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @if($errors->has('local_ref'))
                                                <div class="uk-text-danger">{{ $errors->first('local_ref') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="payment_date">Visa Issue Date <i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="visa_issue_date">Select date</label>
                                            <input class="md-input" type="text" id="visa_issue_date" name="issue_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{ $visa->visaIssuedate }}" />
                                        </div>
                                        @if($errors->has('visa_date'))
                                            <div class="uk-text-danger">{{ $errors->first('visa_date') }}</div>
                                        @endif
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="visa_number">Visa Number <i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="visa_number">Visa Number</label>
                                            <input class="md-input" type="text" id="visa_number" oninput="visaSerial()" name="visa_number" value="{{ $visa->visaNumber }}" />
                                            @if($errors->has('visa_number'))
                                                <div class="uk-text-danger">{{ $errors->first('visa_number') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="Flag_Number">Group Number <i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="Flag_Number">Group Number</label>
                                            <input class="md-input" type="text" id="Flag_Number" name="flag_num" value="{{$visa->idNum}}" oninput="visaSerial()"/>
                                            @if($errors->has('flag_num'))
                                                <div class="uk-text-danger">The group num field is required</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="numberofvisa">Number Of Visa <i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="numberofvisa">Number of Visa</label>
                                            <input class="md-input" type="text" id="numberofvisa" name="numberofvisa" value="{{ $visa->numberofVisa }}" required/>
                                            @if($errors->has('numberofvisa'))
                                                <div class="uk-text-danger">{{ $errors->first('numberofvisa') }}</div>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="numberofvisa">Left Visa</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="left_visa" style="font-size: 25px; ">{{ $visa->left_visa }}</label>

                                        </div>

                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="okala_cancellation">Cancelled for Okala </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="okala_cancellation">Cancel visa</label>
                                            <input onkeypress="numbervalidate(event)" class="md-input" type="text" id="okala_cancellation"  name="okala_cancellation" value=""/>
                                            @if($errors->has('okala_cancellation'))
                                                <div class="uk-text-danger">{{ $errors->first('okala_cancellation') }}</div>
                                            @endif
                                        </div>
                                        <div class="uk-width-medium-1-3">
                                            <h4>Cancelled Okala :  {{ $visa->okala_cancellation }}</h4>
                                            <input readonly class="md-input" type="hidden" id="old_cancel_okala" name="old_cancel_okala" value="{{$visa->okala_cancellation }}" />


                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="Destination">Destination</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="Destination">Destination</label>
                                            <input class="md-input" type="text" id="Destination" name="destination" value="{{ $visa->destination }} " />

                                        </div>
                                    </div>


                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="Destination">Register Serial<i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="registerSerial">Register Serial</label>
                                            <input class="md-input" type="text" id="registerSerialvisa" name="registerSerial" value="{{ $visa->registerSerial }}" readonly/>
                                            @if($errors->has('registerSerial'))
                                                <div class="uk-text-danger">{{ $errors->first('registerSerial') }}</div>
                                            @endif
                                        </div>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="Destination">Register Serial : {{ $visa->registerSerial }}</label>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="Flag_Number">Purchase Rate</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="Flag_Number">Purchase Rate</label>
                                            <input class="md-input" type="text" id="purchaseRate"  name="purchaseRate" value="{{ $visa->purchaseRate}} " />

                                        </div>
                                    </div>

                                    <!-- <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="iqamaNumber">Iqama Number</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="iqamaNumber">Iqama Number</label>
                                            <input class="md-input" type="text" id="iqamaNumber" name="iqamaNumber" value="{{ $visa->iqamaNumber }} " />

                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="iqamaNumber">Iqama Sector</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="iqamaNumber">Iqama Sector</label>
                                            <input class="md-input" type="text" id="iqamaSector" name="iqamaSector" value="{{ $visa->iqamaNumber  }} " />

                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="visaType">Visa Type</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="visaType">Visa Type</label>
                                            <input class="md-input" type="text" id="visaType" name="visaType" value="{{ $visa->visaType }} " />

                                        </div>
                                    </div> -->
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="visaType">Visa Expired Date</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="visaType">Visa Expired Date</label>
                                            <input class="md-input" type="text" id="visaType" value="{{ $visa->expire_date }}" data-uk-datepicker="{format:'YYYY-MM-DD'}" name="expire_date"/>

                                        </div>
                                    </div>

                                    {{--<div class="uk-grid" data-uk-grid-margin>--}}
                                        {{--<div class="uk-width-medium-1-5 uk-vertical-align">--}}
                                            {{--<label class="uk-vertical-align-middle" for="company_name">Visa Category</label>--}}
                                        {{--</div>--}}
                                        {{--<div class="uk-width-medium-2-5">--}}
                                            {{--<label for="company_name">Visa Category</label>--}}
                                            {{--<select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Company Name" id="company_name" name="visa_category_id" >--}}
                                                {{--<option>Select Visa Category</option>--}}
                                                {{--@if($visa->visa_category_id==1)--}}
                                                {{--<option value="1" selected>Company Visa (Free)</option>--}}
                                                    {{--@elseif($visa->visa_category_id==2)--}}
                                                        {{--<option value="2" selected >Company Visa (Contact)</option>--}}
                                                    {{--@elseif($visa->visa_category_id==3)--}}
                                                         {{--<option value="3" selected>Processing Visa</option>--}}
                                                {{--@endif--}}
                                                {{--<option value="1">Company Visa (Free)</option>--}}
                                                {{--<option value="2">Company Visa (Contact)</option>--}}
                                                {{--<option value="3">Processing Visa</option>--}}
                                            {{--</select>--}}
                                            {{--@if($errors->has('visa_category_id'))--}}
                                                {{--<div class="uk-text-danger">{{ $errors->first('visa_category_id') }}</div>--}}
                                            {{--@endif--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<br>--}}
                                    {{--<br>--}}
                                    <br>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="visaType">Upload File</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <div class="md-card">
                                                <div class="md-card-content">
                                                    <div class="uk-grid form_section" id="d_form_row">
                                                        <div class="uk-width-1-1">
                                                            <div class="uk-input-group">
                                                                <label for="visaType">Title</label>
                                                                <input type="text" id="visaType" class="md-input" name="title[]" />
                                                                <br>
                                                                <br>
                                                                <input type="file" class="md-input" name="img_url[]">
                                                                <span class="uk-input-group-addon">
                                                                     <a href="#" class="btnSectionClone" data-section-clone="#d_form_row"><i class="material-icons md-24">&#xE146;</i></a>
                                                                 </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach($visa->visaentryfile as $file)
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
                                                                <input type="text" id="visaType" class="md-input" value="{!! $file['title'] !!}"  name="title[{!! 'old_'.$file['id'] !!}]" required="1" />
                                                                <br>
                                                                <br>
                                                                <input type="file" class="md-input" name="img_url[{!! 'old_'.$file['id'] !!}]">
                                                                <input type="hidden" value="{!! $file['id'] !!}" name="img_id[]" >
                                                                <br>
                                                                @if($errors->has('img_url'))
                                                                    <div class="uk-text-danger">{{ $errors->first('img_url') }}</div>
                                                                @endif
                                                                <span class="uk-input-group-addon">
                                                                    <a href="#" class="btnSectionRemove"><i class="material-icons md-24"></i></a>
                                                                 </span>
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

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="bill_id">Created by</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="bill_id">{{ $visa->createdBy->name }}</label>
                                        </div>

                                     </div>


                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="bill_id">Updated by</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="bill_id">{{ $visa->updatedBy->name }}</label>
                                        </div>

                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="bill_id">Created At</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="bill_id">{{ $visa->created_at }}</label>
                                        </div>

                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="bill_id">Updated At</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="bill_id">{{ $visa->updated_at }}</label>
                                        </div>

                                    </div>

                                    <hr>

                                    <div class="uk-grid uk-ma" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-left">
                                            <button type="submit" class="md-btn md-btn-primary" >Submit</button>
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

    $("#okala_cancellation").on("keyup",function (e) {

            var cancalnum = Math.abs(parseInt($(this).val()));
            var visanum = $("#numberofvisa").val();
            var left_visa = parseInt("{{ $visa->left_visa }}");
            if (cancalnum >= left_visa) {
                $(this).val(left_visa);
            }

    });
    
    function visaSerial() {
            var visa_number = $('#visa_number').val();
            var group_number = $('#Flag_Number').val();
            var value = visa_number+'-'+group_number;

            $('#registerSerialvisa').val(value);

        }


    $('#sidebar_recruit').addClass('current_section');
    $('#sidebar_recrut_visa').addClass('act_item');
</script>

@endsection