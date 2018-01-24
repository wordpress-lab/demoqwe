@extends('layouts.main')

@section('title', 'Income ')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('angular')
    <script src="{{url('app/moneyin/invoice/incomeEdit.controller.js')}}"></script>
@endsection

@section('content')
    <div class="uk-grid" ng-controller="IncomeEditController">
        <div class="uk-width-large-10-10">
            {!! Form::open(['url' => route('income_update', ['id' => $income->id]), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">

                        <input type="hidden" ng-init="income_id='asdfg'" value="{{$income->id}}" name="income_id" ng-model="income_id">

                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit Income</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="Number"> Inc Number </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="Number"> {{ str_pad($income->income_number,6,'0',STR_PAD_RIGHT) }} </label>

                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="income_date">Income Date<sup><i style="color:red; font: 14px; " class="material-icons">stars</i></sup></label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="income_date">Select date</label>
                                        <input class="md-input" type="text" id="income_date" name="income_date" value="{{ date('d-m-Y',strtotime($income->date)) }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Income Account<sup><i style="color:red; font: 14px; " class="material-icons">stars</i></sup></label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Customer" id="account_id" name="account_id" required>
                                            <option value="">Select Account</option>
                                            @foreach($accounts as $account)
                                                <option value="{{ $account->id }}" {{ $account->id == $income->account_id ? "selected='selected'" : '' }}>{{ $account->account_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="amount">Amount<sup><i style="color:red; font: 14px; " class="material-icons">stars</i></sup></label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="amount">Enter Amount</label>
                                        <input class="md-input" type="text" id="amount" ng-model="amount" name="amount" value="{{ $income->amount }}" ng-keyup="calculateTax()" />
                                        @if($errors->first('amount'))
                                            <div class="uk-text-danger">Amount is required.</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Select Tax</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <select id="tax_id"
                                                class="tax_id"
                                                name="tax_id"
                                                ng-model="tax_id"
                                                ng-change="calculateTax()" required>

                                        </select>
                                        Tax Amount = @{{ total_tax | number : 2}} BDT
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Amount Is</label>
                                    </div>
                                    <div class="uk-width-medium-1-5">
                                        <select
                                                id="amount_is"
                                                class="amount_is"
                                                name="amount_is"
                                                ng-model="amount_is"
                                                ng-change="calculateTax()"
                                                required>

                                        </select>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="deposite_to">Receive Through</label>
                                    </div>
                                    <div class="uk-width-medium-1-5">
                                        <select
                                                id="receive_through_id"
                                                class="receive_through_id"
                                                name="receive_through_id"
                                                ng-model="receive_through_id"
                                                ng-change="getAccountType()"
                                                required>
                                        </select>
                                    </div>
                                    @if($errors->first('payment_mode_id'))
                                        <div class="uk-text-danger">Deposite is required.</div>
                                    @endif
                                    <div ng-if="account_type!=3" class="uk-width-medium-2-5" id="show">
                                        <label for="reference">Optional(Cash) Requeired(Undeposited Fund)</label>
                                        <input class="md-input" type="text" id="reference" name="bank_info" value="{{$income->bank_info}}" />
                                        @if($errors->first('bank_info'))
                                            <div class="uk-text-danger">Field is required.</div>
                                        @endif
                                    </div>
                                    <div ng-if="account_type!=3" class="uk-width-medium-1-5" id="show">
                                        <input type="checkbox"
                                               @if($income->invoice_show == "on")
                                               checked="checked"
                                               @endif
                                               id="invoice_show" name="invoice_show" />
                                        <label for="switch_demo_1" class="inline-label" id="show_invoice">Show In Invoice</label>
                                        @if($errors->first('invoice_show'))
                                            <div class="uk-text-danger">Field is required.</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Customer Name<sup><i style="color:red; font: 14px; " class="material-icons">stars</i></sup> </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Customer" id="customer_id" name="customer_id" required>
                                            <option value="">Select Customer</option>
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}" {{ $customer->id == $income->customer_id ? "selected='selected'" : '' }} >{{ $customer->display_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="reference">Reference#</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="reference">Enter Reference Number</label>
                                        <input class="md-input" type="text" id="reference" name="reference" value="{{ $income->reference }}" />
                                    </div>
                                </div>


                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="reference">File </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <input type="file" name="file1">

                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">

                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        @if($income->file_url)
                                            <a download href="{{ url($income->file_url) }}"><p class="uk-text-medium uk-margin-bottom">Download Attachment</p></a>
                                        @endif

                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="reference">Customer Note</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-1">
                                                <label for="customer_note">Customer note</label>
                                                <textarea class="md-input" id="customer_note" name="customer_note"> {{ $income->note }}</textarea>
                                            </div>
                                        </div>
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
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_income').addClass('act_item');

        $(window).load(function(){
            $("#tiktok_account").trigger('click');

        })
        altair_forms.parsley_validation_config();
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection
