@extends('layouts.main')

@section('title', 'Expense')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('angular')
    <script src="{{url('app/moneyout/bill/bill.module.js')}}"></script>
    <script src="{{url('app/moneyout/bill/expense.controller.js')}}"></script>
@endsection

@section('content')
    <div class="uk-grid" ng-controller="ExpenseController">
        <div class="uk-width-large-10-10">
            {!! Form::open(['url' => route('order_expense_accounts_storeExpense',['id'=>$id]), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
                <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                    <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Create New Expense</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="expense_date">Expense Date</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="expense_date">Select date</label>
                                            <input class="md-input" type="text" id="expense_date" name="expense_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" required>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="customer_name">Expense Account</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Customer" id="account_id" name="account_id" required>
                                                <option value="">Select Account</option>
                                                @foreach($accounts as $accounts)
                                                    <option value="{{ $accounts->id }}">{{ $accounts->account_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="amount">Amount</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="amount">Enter Amount</label>
                                            <input class="md-input" type="text" id="amount" ng-model="amount" name="amount" ng-keyup="calculateTax()" />
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
                                        <div class="uk-width-medium-2-5">
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
                                            <label class="uk-vertical-align-middle" for="deposite_to">Paid Through</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <select
                                                    id="paid_through_id"
                                                    class="paid_through_id"
                                                    name="paid_through_id"
                                                    ng-model="paid_through_id"
                                                    ng-change="getAccountType()"
                                                    required>
                                            </select>
                                        </div>
                                        @if($errors->first('payment_mode_id'))
                                            <div class="uk-text-danger">Deposite is required.</div>
                                        @endif
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="customer_name">Vendor Name</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Customer" id="customer_id" name="customer_id" required>
                                                <option value="">Select Customer</option>
                                                @foreach($customers as $customer)
                                                    <option value="{{ $customer->id }}">{{ $customer->display_name }}</option>
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
                                            <input class="md-input" type="text" id="reference" name="reference" />
                                        </div>
                                    </div>
                                    

                                    <hr>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-3">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <p>Payment Options: Paypal-Payza-Skrill </p>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-1">
                                                    <label for="user_edit_uname_control">Attach Files: </label>
                                                </div>
                                                <div class="uk-width-medium-1-1">
                                                    <div class="uk-form-file uk-text-primary"
                                                         style="width: 200px; height: 30px; border-color: #ececec; border-style: dotted; text-align: center; ">
                                                        <p style="margin: 4px;">Uplaod File</p>
                                                        <input id="form-file" type="file" name="file">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <p>Template: 'Standered Template' </p>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-2-3">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-1">
                                                    <label for="customer_note">Customer note</label>
                                                    <textarea class="md-input" id="customer_note" name="customer_note"></textarea>
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
        altair_forms.parsley_validation_config();
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection
