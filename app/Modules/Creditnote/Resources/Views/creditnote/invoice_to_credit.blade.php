@extends('layouts.main')

@section('title', 'Credit Notes')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
    <div class="uk-grid" ng-controller="InvoiceToCreditNoteController">
        <div class="uk-width-large-10-10">
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit Credit Note </span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            {!! Form::open(['url' => route('store_invoice_to_credit_note', ['id' => $invoice_id]), 'method' => 'POST', 'id' => 'my_profile']) !!}
                            <input type="hidden" id="credit_note_id" name="credit_note_id" value="{{ $credit_note->id }}">
                            <div class="uk-margin-top">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Customer Name</label>
                                    </div>
                                    <div class="uk-width-medium-2-5 parsley-row">
                                        <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Customer" id="customer_id" name="customer_id" required>
                                            <option value="">Select Customer</option>
                                            @foreach($customers as $customer)
                                                @if($customer->id == $credit_note->customer_id)
                                                    <option value="{{ $customer->id }}" selected>{{ $customer->display_name }}</option>
                                                @else
                                                    <option value="{{ $customer->id }}">{{ $customer->display_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="credit_note_number">Credit Note#</label>
                                    </div>
                                    <div class="uk-width-medium-2-5 parsley-row">
                                        <label for="credit_note_number">CN-{{ $credit_note_number }}</label>
                                        <input type="hidden" id="credit_note_number" name="credit_note_number" value="{{ $credit_note_number }}">
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="reference">Reference#</label>
                                    </div>
                                    <div class="uk-width-medium-2-5 parsley-row">
                                        <label for="reference">Enter Reference Number</label>
                                        <input class="md-input" type="text" id="reference" name="reference" value="{{ $credit_note->reference }}" required/>
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="credit_note_date">Credit Note Date</label>
                                    </div>
                                    <div class="uk-width-medium-2-5 parsley-row">
                                        <label for="credit_note_date">Select date</label>
                                        <input class="md-input" type="text" id="credit_note_date" name="credit_note_date" value="{{ $credit_note->credit_note_date }}" data-uk-datepicker="{format:'DD.MM.YYYY'}" required>
                                    </div>
                                </div>

                                <div class="uk-grid uk-margin-large-top uk-margin-large-bottom" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1">
                                        <table class="uk-table">
                                            <thead>
                                            <tr>
                                                <th class="uk-text-nowrap">Item</th>
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
                                            <tr ng-repeat="credit_notes in credit_notes track by $index" class="form_section">
                                                <td>
                                                    <select id="item_id_@{{ $index }}"
                                                            class="account" name="item_id[]"
                                                            ng-model="item_id[$index]"
                                                            ng-change="getItemRate($index)"
                                                            required>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text"
                                                           id="quantity_@{{ $index }}"
                                                           name="quantity[]"
                                                           ng-init="quantity[$index]='0.00'"
                                                           ng-model="quantity[$index]"
                                                           ng-keyup="calculateCreditNote()"
                                                           class="md-input"
                                                           required/>
                                                </td>
                                                <td>
                                                    <input type="text"
                                                           id="rate_@{{ $index }}"
                                                           name="rate[]"
                                                           class="md-input"
                                                           ng-init="rate[$index]='0.00'"
                                                           ng-model="rate[$index]"
                                                           ng-keyup="calculateCreditNote()"
                                                           required/>
                                                </td>
                                                <td>
                                                    <input type="text"
                                                           id="discount_@{{ $index }}"
                                                           name="discount[]"
                                                           ng-init="discount[$index]='0'"
                                                           ng-model="discount[$index]"
                                                           ng-keyup="calculateCreditNote()"
                                                           class="md-input"
                                                           required/>
                                                </td>
                                                <td>
                                                    <select id="tax_id_@{{ $index }}"
                                                            class="account"
                                                            name="tax_id[]"
                                                            ng-model="tax_id"
                                                            ng-change="calculateCreditNote()"
                                                            required>
                                                    </select>
                                                </td>
                                                <td class="uk-text-right">
                                                    <input type="text"
                                                           id="amount_@{{ $index }}"
                                                           name="amount[@{{ $index }}]"
                                                           ng-init="amount[$index]='0.00'"
                                                           ng-model="amount[$index]"
                                                           class="md-input"
                                                           readonly="readonly"/>
                                                </td>
                                                <td>
                                                    <select id="account_id_@{{ $index }}"
                                                            class="account"
                                                            name="account_id[]"
                                                            ng-model="account_id[$index]"
                                                            ng-change="calculateCreditNote()"
                                                            required>
                                                    </select>
                                                </td>
                                                <td class="uk-text-right uk-text-middle">
                                                    <a href="" class="btnSectionClone uk-width-medium-1-2" ng-click="Remove($index)">
                                                        <i class="material-icons md-24">delete</i>
                                                    </a>
                                                </td>
                                            </tr>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <td colspan="7"></td>
                                                <td class="uk-text-right uk-text-middle">
                                                    <a href="#" class="btnSectionClone uk-width-medium-1-2" ng-click="Append()">
                                                        <i class="material-icons md-24">&#xE145;</i>
                                                    </a>
                                                </td>
                                            </tr>
                                            </tfoot>
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
                                                <td class="uk-text-right">
                                                    @{{ sub_total.toFixed(2) }}
                                                    <input type="hidden" name="sub_total" id="sub_total" value="@{{ sub_total }}">
                                                </td>
                                            </tr>
                                            <tr class="form_section">
                                                <td>
                                                    Total Tax
                                                </td>
                                                <td>

                                                </td>
                                                <td class="uk-text-right">
                                                    @{{ tax_total.toFixed(2) }}
                                                    <input type="hidden" name="tax_total" id="tax_total" value="@{{ tax_total }}">
                                                </td>
                                            </tr>
                                            <tr class="form_section">
                                                <td>
                                                    Shipping Charges
                                                </td>
                                                <td>
                                                    <input type="text"
                                                           class="md-input md-input-width-medium"
                                                           placeholder="Enter shipping charge"
                                                           id="shipping_charge"
                                                           name="shipping_charge"
                                                           ng-model="shipping_charge"
                                                           ng-keyup="calculateCreditNote()"/>
                                                </td>
                                                <td class="uk-text-right">
                                                    @{{ shipping_charge.toFixed(2) }}
                                                </td>
                                            </tr>
                                            <tr class="form_section">
                                                <td>
                                                    Adjustment
                                                </td>
                                                <td>
                                                    <input type="text"
                                                           class="md-input md-input-width-medium"
                                                           placeholder="Enter adjustment"
                                                           id="adjustment"
                                                           name="adjustment"
                                                           ng-model="adjustment"
                                                           ng-keyup="calculateCreditNote()"/>
                                                </td>
                                                <td class="uk-text-right">
                                                    @{{ adjustment.toFixed(2) }}
                                                </td>
                                            </tr>
                                            <tr class="form_section">
                                                <th>Total(BDT)</th>
                                                <th></th>
                                                <th class="uk-text-right">@{{ total.toFixed(2) }}</th>
                                                <input type="hidden" name="total" id="total" value="@{{ total }}">
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <hr>

                                <div class="uk-grid uk-block" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1">
                                        <div class="uk-width-medium-1-1 uk-margin-bottom">
                                            <label for="customer_note">Customer Notes</label>
                                            <textarea class="md-input selecize_init" rows="3" name="customer_note" id="customer_note">{{ $credit_note->customer_note }}</textarea>
                                            <span class="md-input-bar "></span>
                                        </div>
                                        <div class="uk-width-medium-1-1 uk-margin-bottom">
                                            <label for="terms_and_condition">Terms &amp; Conditions</label>
                                            <textarea class="md-input selecize_init" rows="3" name="terms_and_condition" id="terms_and_condition">{{ $credit_note->terms_and_condition }}</textarea>
                                            <span class="md-input-bar "></span>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="uk-grid uk-ma" data-uk-grid-margin>
                                    <div class="uk-width-1-1 uk-float-left">
                                        <button id="submit_button" type="submit" class="md-btn md-btn-primary" >Submit</button>
                                        <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
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

@section('angular')
    <script src="{{ url('app/creditnote/invoice_to_credit.controller.js') }}" type="text/javascript"></script>
@endsection

@section('scripts')

    <script>
        $('#sidebar_credit_note').addClass('act_item');
        $('#sidebar_main_account').addClass('current_section');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        })
        altair_forms.parsley_validation_config();
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection