@extends('layouts.main')

@section('title', 'Challan Create')

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
            @if(Session::has('message'))
                <div class="uk-alert uk-alert-danger" data-uk-alert>
                    <a href="#" class="uk-alert-close uk-close"></a>
                    {!! Session::get('message') !!}
                </div>
            @endif
            {!! Form::open(['url' => route('challan_store'),'method' => 'POST','files' => true]) !!}
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Challan Create</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Challan No</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Challan No</label>
                                        <input class="md-input" type="text" name="challanNo">
                                        @if($errors->has('challanNo'))
                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('challanNo')!!}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Challan Date</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Challan Date</label>
                                        <input class="md-input" type="text" id="invoice_date" name="challanDate" data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                                        @if($errors->has('challanDate'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('challanDate')!!}</span>

                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">District</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select District Name</label>
                                        <input class="md-input" type="text" name="district">
                                        @if($errors->has('district'))
                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('district')!!}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Branch</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Branch Name</label>
                                        <input class="md-input" type="text" name="branch">
                                        @if($errors->has('branch'))
                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('branch')!!}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">From Address</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select From Address</label>
                                        <input class="md-input" type="text" name="fromAddress">
                                        @if($errors->has('fromAddress'))
                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('fromAddress')!!}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Organization Address</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Organization Address</label>
                                        <input class="md-input" type="text" name="organizationAddress">
                                        @if($errors->has('organizationAddress'))
                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('organizationAddress')!!}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Note 1</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Note 1</label>
                                        <input class="md-input" type="text" name="rate_1">
                                        @if($errors->has('rate_1'))
                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('rate_1')!!}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Note 2</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Note 2</label>
                                        <input class="md-input" type="text" name="rate_2">
                                        @if($errors->has('rate_2'))
                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('rate_2')!!}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Note 3</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Note 3</label>
                                        <input class="md-input" type="text" name="rate_3">
                                        @if($errors->has('rate_3'))
                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('rate_3')!!}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Quantity 1</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Quantity 1</label>
                                        <input class="md-input" type="text" name="quantity_1">
                                        @if($errors->has('quantity_1'))
                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('quantity_1')!!}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Quantity 2</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Quantity 2</label>
                                        <input class="md-input" type="text" name="quantity_2">
                                        @if($errors->has('quantity_2'))
                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('quantity_2')!!}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Quantity 3</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Quantity 2</label>
                                        <input class="md-input" type="text" name="quantity_3">
                                        @if($errors->has('quantity_3'))
                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('quantity_3')!!}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Amount In Words (Bangla)</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Amount In Words (Bangla)</label>
                                        <input class="md-input" type="text" name="amount_bangla">
                                    </div>
                                </div>

                                {{--<div class="uk-grid" data-uk-grid-margin>--}}
                                    {{--<div class="uk-width-medium-1-5  uk-vertical-align">--}}
                                        {{--<label class="uk-vertical-align-middle" for="invoice_date">Comment</label>--}}
                                    {{--</div>--}}
                                    {{--<div class="uk-width-medium-2-5">--}}
                                        {{--<label for="invoice_date">Select Comment</label>--}}
                                        {{--<input class="md-input" type="text" name="comment">--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                <br>
                                <br>
                                <hr>
                                <div class="uk-grid uk-ma" data-uk-grid-margin>
                                    <div class="uk-width-1-1 uk-float-left">
                                        <input type="hidden" name="id" value="{!! $id !!}">
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


    {{--<script>--}}
        {{--$(document).ready(function () {--}}
            {{--$('.pax_id').change(function () {--}}
              {{--var pax_id=$(this).val();--}}

            {{--if (pax_id==null){--}}

            {{--}--}}

            {{--$.each(pax_id, function( index, value ) {--}}

                {{--$('.pax_id_2 option[value=value]').prop('selected',true).trigger('change');--}}

            {{--});--}}

        {{--});--}}
        {{--});--}}
    {{--</script>--}}

    <script type="text/javascript">
        $(window).load(function(){
            $("#tiktok2").trigger('click');
        })
        $('#sidebar_recruit').addClass('current_section');
        $('#medical_slip_form_index').addClass('act_item');
    </script>

    <script>
        altair_forms.parsley_validation_config();
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection
