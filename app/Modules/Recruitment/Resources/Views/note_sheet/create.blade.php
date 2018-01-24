@extends('layouts.main')

@section('title', 'Create NoteSheet Form')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('angular')
    <script src="{{url('app/moneyin/invoice/invoice.module.js')}}"></script>
    <script src="{{url('app/moneyin/invoice/invoice.controller.js')}}"></script>
@endsection

@section('content')
    <div class="uk-grid" ng-controller="InvoiceController">
        <div class="uk-width-large-10-10">
            @if(Session::has('msg'))
                <div class="uk-alert uk-alert-success" data-uk-alert>
                    <a href="#" class="uk-alert-close uk-close"></a>
                    {!! Session::get('msg') !!}
                </div>
            @endif
            {!! Form::open(['url' => route('note_sheet_store'), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Create NoteSheet Form</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Date Of Application</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select date</label>
                                        <input class="md-input" type="text" id="uk_dp_start" name="applicationDate" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                        @if($errors->has('applicationDate'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('applicationDate')!!}</span>

                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Country Name And Gender</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Country Name</label>
                                        <input class="md-input" type="text" id="uk_dp_start" value="সৌদি আরবগামী ০১(এক) জন পুরুষ" name="countryGender">
                                        @if($errors->has('countryGender'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('countryGender')!!}</span>

                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Source Income Tax</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Income Tax</label>
                                        <input class="md-input" type="text" id="uk_dp_start" name="sourceIncomeTax">

                                    </div>
                                </div>


                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Welfare Fee</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Welfare Fee/Person</label>
                                        <input class="md-input" type="text" id="uk_dp_start" name="welfareFee">
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Pay Order Number</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select PAy Order Number</label>
                                        <input class="md-input" type="text" id="uk_dp_start" name="payOrderNumber">
                                    </div>
                                </div>



                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Chalan Number</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Income Tax NA Fee</label>
                                        <input class="md-input" type="text" id="uk_dp_start" name="chalanNumber">
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Info Attestation</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Info Attestation</label>
                                        <input class="md-input" type="text" id="uk_dp_start" name="infoAttestation">
                                    </div>
                                </div>


                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Pay Order Date</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Pay Order Date</label>
                                        <input class="md-input" type="text" id="uk_dp_start" data-uk-datepicker="{format:'YYYY-MM-DD'}" name="payOrderDate">
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Chalan Date</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Chalan Date</label>
                                        <input class="md-input" type="text" id="uk_dp_start" data-uk-datepicker="{format:'YYYY-MM-DD'}" name="chalanDate">
                                    </div>
                                </div>


                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Certificate Attestation </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Certificate Attestation</label>
                                        <input class="md-input" type="text" id="uk_dp_start" name="certificateAttestation">
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date"> Pay Order Amount</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Pay Order Amount</label>
                                        <input class="md-input" type="text" id="uk_dp_start" name="payOrderAmount">
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Chalan Amount</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Chalan Amount</label>
                                        <input class="md-input" type="text" id="uk_dp_start" name="chalanAmount">
                                    </div>
                                </div>


                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-3-5">
                                        <div class="md-card">
                                            <div class="md-card-content">
                                                <form action="" data-parsley-validate>

                                                    <div class="uk-grid uk-grid-medium form_section form_section_separator" id="d_form_section" data-uk-grid-match>
                                                        <div class="uk-width-9-10">
                                                            <div class="uk-grid">
                                                                <div class="uk-width-1-1">
                                                                    <div class="parsley-row">
                                                                        <label>Brifing</label>
                                                                        <input type="text" class="md-input" name="brifing[]">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="uk-grid">
                                                                <div class="uk-width-1-1">
                                                                    <div class="parsley-row">
                                                                        <label>Comment</label>
                                                                        <input type="text" class="md-input" name="comment[]">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="uk-grid">
                                                                <div class="uk-width-1-1">
                                                                    <div class="parsley-row">
                                                                        <select id="d_form_select_country" name="recruit_id[]" data-md-selectize required>
                                                                            @foreach($order as $value)
                                                                                <option value="{!! $value->id !!}">{!! $value->paxid !!}</option>

                                                                            @endforeach
                                                                        </select>
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
                                <br>
                                <hr>
                                <br>
                                <br>

                                <div class="uk-grid uk-ma" data-uk-grid-margin>
                                    <div class="uk-width-1-1 uk-float-left">
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
        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_note_sheet_index').addClass('act_item');
    </script>

    <script>

        altair_forms.parsley_validation_config();
        $(window).load(function(){
            $("#tiktok2").trigger('click');
            $("#ticktok3").trigger('click');
        })
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection
