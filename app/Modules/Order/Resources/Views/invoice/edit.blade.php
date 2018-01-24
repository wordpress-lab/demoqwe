@extends('layouts.main')

@section('title', 'Invoice')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('angular')
    <script src="{{url('app/moneyin/invoice/invoice.module.js')}}"></script>
    <script src="{{url('app/moneyin/invoice/invoiceEdit.controller.js')}}"></script>
@endsection

@section('content')
    <div class="uk-grid" ng-controller="InvoiceEditController">
        <div class="uk-width-large-10-10">
            {!! Form::open(['url' => route('invoice_update',['id' => $invoice->id]), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">

                        <input type="hidden" ng-init="invoice_id='asdfg'" value="{{$invoice->id}}" name="invoice_id" ng-model="invoice_id">

                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit Invoice</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Customer Name</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Customer" id="customer_id" name="customer_id">
                                            <option value="">Select Customer</option>
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}" {{ $customer->id == $invoice->customer_id ? 'selected="selected"' : '' }}>{{ $customer->first_name }} {{ $customer->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_number">Invoice Number</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_number">Enter Invoice Number</label>
                                        <input class="md-input" type="text" id="invoice_number" name="invoice_number" value="{{ str_pad($invoice->invoice_number, 6, '0', STR_PAD_LEFT) }}" />
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="order_number">Order Number</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="order_number">Enter Order Number</label>
                                        <input class="md-input" type="text" id="order_number" name="order_number" value="{{ $invoice->order_number }}"/>
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Invoice Date</label>
                                    </div>
                                    <div clpass="uk-width-medium-2-5">
                                        <label for="invoice_date">Select date</label>
                                        <input class="md-input" type="text" id="invoice_date" name="invoice_date" value="{{ $invoice->invoice_date }}" data-uk-datepicker="{format:'DD.MM.YYYY'}">
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="due_date">Due Date</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="due_date">Select date</label>
                                        <input class="md-input" type="text" id="due_date" name="due_date" value="{{ $invoice->payment_date }}" data-uk-datepicker="{format:'DD.MM.YYYY'}">
                                    </div>
                                </div>

                                <div class="uk-grid uk-margin-large-top uk-margin-large-bottom" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1">
                                        <table class="uk-table">
                                            <thead>
                                            <tr>
                                                <th class="uk-text-nowrap">Item Details</th>
                                                <th class="uk-text-nowrap">Description</th>
                                                <th class="uk-text-nowrap">Quantity</th>
                                                <th class="uk-text-nowrap">Rate</th>
                                                <th class="uk-text-nowrap">Discount</th>
                                                <th class="uk-text-nowrap uk-width-medium-1-6">Tax</th>
                                                <th class="uk-text-nowrap">Amount</th>
                                                <th class="uk-text-nowrap">Account</th>
                                                <th class="uk-text-nowrap">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr ng-repeat="invoice_entry in invoice_entries track by $index" class="form_section" id="data_clone">
                                                <td>
                                                    <select id="item_id_@{{ $index }}" class="item_id" name="item_id[]" ng-model="item_id" ng-change="getItemRate($index)" required>


                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" id="description_@{{ $index + 1 }}" class="md-input" name="description[]" ng-model="description[$index+1]">
                                                </td>
                                                <td>
                                                    <input type="text" id="quantity_@{{ $index }}" ng-init="quantity[$index]='1.00'" name="quantity[]" ng-model="quantity[$index]" ng-keyup="calculateInvoice()" class="md-input" required/>
                                                </td>
                                                <td>
                                                    <input type="text" id="rate_@{{ $index }}" name="rate[]" ng-init="rate[$index]='0.00'" ng-model="rate[$index]" ng-keyup="calculateInvoice()" class="md-input" required/>
                                                </td>
                                                <td>
                                                    <input type="text" id="discount_@{{ $index }}" name="discount[]" ng-init="discount[$index]='0'" ng-model="discount[$index]" ng-keyup="calculateInvoice()" class="md-input" required/>
                                                </td>
                                                <td>
                                                    <select id="tax_id_@{{ $index }}" class="tax_id" name="tax_id[]" ng-model="tax_id" ng-change="calculateInvoice()" required>


                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" id="amount_@{{ $index }}" name="amount[]" ng-init="amount[$index]='0.00'" ng-model="amount[$index]" class="md-input" readonly="readonly" required/>
                                                </td>
                                                <td>
                                                    <select id="account_id_@{{ $index }}" class="account_id" name="account_id[]" ng-model="account_id" required>

                                                    </select>
                                                </td>
                                                <td class="uk-text-right uk-text-middle">
                                                    <a href="#" class="btnSectionClone"><i class="material-icons md-36" ng-click="Remove($index)">delete</i></a>
                                                </td>
                                            </tr>
                                            <tr style="border-bottom: 0px;" class="form_section" id="data_clone">
                                                <td>

                                                </td>
                                                <td>

                                                </td>
                                                <td>

                                                </td>
                                                <td>

                                                </td>
                                                <td>

                                                </td>
                                                <td>

                                                </td>
                                                <td>

                                                </td>
                                                <td class="uk-text-right uk-text-middle">
                                                            <span class="uk-input-group-addon">
                                                            <a ng-click="Append()"><i class="material-icons">&#xE147;</i></a></span>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-3 uk-margin-medium-top"></div>
                                    <div class="uk-width-medium-2-3">
                                        <table class="uk-table">
                                            <tbody>
                                            <tr class="form_section">
                                                <td>
                                                    Sub Total
                                                </td>
                                                <td>

                                                </td>
                                                <td>
                                                    @{{ sub_total }}
                                                </td>
                                            </tr>

                                            <tr ng-if="tax_total>0" class="form_section">
                                                <td>
                                                    Tax Total
                                                </td>
                                                <td>

                                                </td>
                                                <td>
                                                    @{{ tax_total }}
                                                </td>
                                            </tr>

                                            <tr class="form_section">
                                                <td>
                                                    Shipping Charges
                                                </td>
                                                <td>
                                                    <input type="text" name="shipping_charge" ng-init="shipping_charge='0.00'" ng-model="shipping_charge" ng-change="calculateInvoice()" class="md-input md-input-width-medium"  />
                                                </td>
                                                <td>
                                                    @{{ shipping_charge }}
                                                </td>
                                            </tr>
                                            <tr class="form_section">
                                                <td>
                                                    Adjustment
                                                </td>
                                                <td>
                                                    <input type="text" name="adjustment" ng-init="adjustment='0.00'" ng-model="adjustment" ng-change="calculateInvoice()" class="md-input md-input-width-medium" />
                                                </td>
                                                <td>
                                                    @{{ adjustment }}
                                                </td>
                                            </tr>
                                            <tr class="form_section">
                                                <th>Total(BDT)</th>
                                                <th></th>
                                                <th>@{{ total_amount }}</th>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <input type="hidden" ng-model="tax_total" name="tax_total" value="@{{ tax_total }}">
                                        <input type="hidden" ng-model="total_amount" name="total_amount" value="@{{ total_amount }}">
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
