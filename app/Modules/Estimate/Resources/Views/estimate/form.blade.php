@extends('layouts.main')

@section('title', 'Estimate')

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
            {!! Form::open(['url' => route('estimate_store'), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New Estimate</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Customer Name</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Customer" id="customer_id" name="customer_id" required>
                                            <option value="">Select Customer</option>
                                            @foreach($customer as $value)
                                                <option value="{{ $value->id }}">{{ $value->display_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="estimate_number">Estimate Number</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="estimate_number">Estimate Number</label>
                                        <input class="md-input" type="text" id="estimate_number"  name="estimate_number" readonly  value="EST-{{ str_pad($estimate_number->id+2,6,"0",STR_PAD_LEFT) }}" />
                                        @if($errors->first('estimate_number'))
                                            <div class="uk-text-danger">Estimate number is required.</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="date">Date</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="date">Select date</label>
                                        <input class="md-input" id="date" type="text"  name="date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" data-uk-datepicker="{format:'YYYY-MM-DD'}" required>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="reference">Reference#</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="reference">Enter Reference Number</label>
                                        <input class="md-input" type="text" id="reference" name="ref" />
                                    </div>
                                </div>


                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-2">
                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-2-5 uk-vertical-align">
                                                <label class="uk-vertical-align-middle" for="attn">Attn</label>
                                            </div>
                                            <div class="uk-width-medium-1-2">
                                                <label for="ref">Enter attn</label>
                                                <input class="md-input" type="text" id="attn"  name="attn"  />
                                                @if($errors->first('attn'))
                                                    <div class="uk-text-danger">Ref is required.</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-2">

                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-3 uk-vertical-align">
                                                <label class="uk-vertical-align-middle" for="attn_designation">	 Designation</label>
                                            </div>
                                            <div class="uk-width-medium-1-2">
                                                <label for="ref">Enter Designation</label>
                                                <input class="md-input" type="text" id="attn_designation"  name="attn_designation"  />
                                                @if($errors->first('attn_designation'))
                                                    <div class="uk-text-danger">Attn Designation is required.</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>



                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="subject">Subject</label>
                                    </div>
                                    <div class="uk-width-medium-2-3">
                                        <label for="subject">Enter Subject</label>
                                        <input class="md-input" type="text" id="subject" name="subject" />
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="heading">Heading</label>
                                    </div>
                                    <div class="uk-width-medium-2-3">
                                        <label for="heading">Enter Heading</label>
                                        <textarea  id="editor1" name="heading" rows="12" cols="100"></textarea>

                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="table_head">Table Head</label>
                                    </div>
                                    <div class="uk-width-medium-2-3">
                                        <label for="table_head">Enter Table Head</label>
                                        <input class="md-input" type="text" id="table_head" name="table_head" />
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="terms_conditions">Terms & Conditions</label>
                                    </div>
                                    <div class="uk-width-medium-2-3">
                                        <label for="terms_conditions">Enter Heading</label>
                                        <textarea  id="editor2" name="terms_conditions" rows="12" cols="100"></textarea>

                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="left_notation">Left Notation</label>
                                    </div>
                                    <div class="uk-width-medium-2-3">
                                        <label for="left_notation">Left Notation</label>
                                        <textarea  id="editor3" name="left_notation" rows="12" cols="100"></textarea>

                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="right_notation">Right Notation</label>
                                    </div>
                                    <div class="uk-width-medium-2-3">
                                        <label for="right_notation">Right Notation</label>
                                        <textarea  id="editor4" name="right_notation" rows="12" cols="100"></textarea>

                                    </div>
                                </div>





                                <div class="uk-grid uk-margin-large-top uk-margin-large-bottom" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1">
                                        <table class="uk-table">
                                            <thead>
                                            <tr>
                                                <th class="uk-text-nowrap">Item Details</th>
                                                <th class="uk-text-nowrap">Quantity</th>
                                                <th class="uk-text-nowrap">Rate</th>
                                                <th class="uk-text-nowrap">Discount(%)</th>
                                                <th class="uk-text-nowrap uk-width-medium-1-6">Tax</th>
                                                <th class="uk-text-nowrap">Amount</th>
                                                <th class="uk-text-nowrap">Account</th>
                                                <th class="uk-text-nowrap">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="form_section" id="data_clone">
                                                <td>
                                                    <select id="item_id_0" class="account" name="item_id[0]" ng-model="item_id" ng-change="getItemRate(0)" required>

                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" id="quantity_0" name="quantity[0]" ng-init="quantity[0]='1'" ng-model="quantity[0]" ng-keyup="calculateInvoice()" class="md-input" required/>
                                                </td>
                                                <td>
                                                    <input type="text" id="rate_0" name="rate[0]" class="md-input" ng-init="rate[0]='0.00'" ng-model="rate[0]" ng-keyup="calculateInvoice()" required/>
                                                </td>
                                                <td>
                                                    <input type="text" id="discount_0" name="discount[0]" ng-init="discount[0]='0'" ng-model="discount[0]" ng-keyup="calculateInvoice()" class="md-input"/>
                                                </td>
                                                <td>
                                                    <select id="tax_id_0" class="tax_id" name="tax_id[0]" ng-model="tax_id" ng-change="calculateInvoice()" required>


                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" id="amount_0" name="amount[0]" ng-init="amount[0]='0.00'" ng-model="amount[0]" class="md-input" readonly="readonly" />
                                                </td>
                                                <td>
                                                    <select id="account_id_0" class="account_id" name="account_id[0]" ng-model="account_id" required>

                                                    </select>
                                                </td>
                                                <td class="uk-text-right uk-text-middle">
                                                    <a href="#" class="btnSectionClone"><i class="material-icons md-36" ng-click="Append()">&#xE146;</i></a>
                                                </td>
                                            </tr>


                                            <tr ng-repeat="invoice in invoices track by $index" class="form_section" id="data_clone">
                                                <td>
                                                    <select id="item_id_@{{ $index + 1 }}" class="item_id" name="item_id[]" ng-model="item_id" ng-change="getItemRate($index+1)" required>


                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" id="quantity_@{{ $index + 1 }}" name="quantity[]" ng-init="quantity[$index+1]='1'" ng-model="quantity[$index+1]" ng-keyup="calculateInvoice()" class="md-input" required/>
                                                </td>
                                                <td>
                                                    <input type="text" id="rate_@{{ $index + 1 }}" name="rate[]" ng-init="rate[$index+1]='0.00'" ng-model="rate[$index+1]" ng-keyup="calculateInvoice()" class="md-input" required/>
                                                </td>
                                                <td>
                                                    <input type="text" id="discount_@{{ $index + 1 }}" name="discount[]" ng-init="discount[$index+1]='0'" ng-model="discount[$index+1]" ng-keyup="calculateInvoice()" class="md-input" required/>
                                                </td>
                                                <td>
                                                    <select id="tax_id_@{{ $index + 1 }}" class="tax_id" name="tax_id[]" ng-model="tax_id" ng-change="calculateInvoice()" required>


                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" id="amount_@{{ $index + 1 }}" name="amount[]" ng-init="amount[$index+1]='0.00'" ng-model="amount[$index+1]" class="md-input" readonly="readonly" required/>
                                                </td>
                                                <td>
                                                    <select id="account_id_@{{ $index + 1 }}" class="account_id" name="account_id[]" ng-model="account_id" required>


                                                    </select>
                                                </td>
                                                <td class="uk-text-right uk-text-middle">
                                                    <a href="#" class="btnSectionClone"><i class="material-icons md-36" ng-click="Remove($index)">delete</i></a>
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

            <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
            <script>
                CKEDITOR.editorConfig = function (config) {
                    config.language = 'es';
                    config.uiColor = '#F7B42C';
                    config.height = 300;
                    config.toolbarCanCollapse = true;

                };
                CKEDITOR.replace('editor1');
                CKEDITOR.replace('editor2');
                CKEDITOR.replace('editor3');
                CKEDITOR.replace('editor4');

            </script>
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
