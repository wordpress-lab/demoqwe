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
            @if(app('request')->input('amount'))
            <h3>Last Invoice Amount: {{app('request')->input('amount')}} BDT</h3>
            @endif
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
                                                <option value="{{ $customer->id }}" {{ $customer->id == $invoice->customer_id ? 'selected' : '' }}>{{ $customer->display_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_number">Invoice Number</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_number">INV-{{ $invoice->invoice_number }}</label>
                                        <input type="hidden" id="invoice_number" name="invoice_number" value="{{ str_pad($invoice->invoice_number, 6, '0', STR_PAD_LEFT) }}" >
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Invoice Date</label>
                                    </div>
                                    <div clpass="uk-width-medium-2-5">
                                        <label for="invoice_date">Select date</label>
                                        <input class="md-input" type="text" id="invoice_date" name="invoice_date" value="{{ date("d-m-Y",strtotime($invoice->invoice_date)) }}" data-uk-datepicker="{format:'DD-MM-YYYY'}">
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="due_date">Due Date</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="due_date">Select date</label>
                                        <input class="md-input" type="text" id="due_date" name="due_date" value="{{ date("d-m-Y",strtotime($invoice->payment_date)) }}" data-uk-datepicker="{format:'DD-MM-YYYY'}">
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="reference">Reference</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Reference</label>
                                        <input class="md-input" type="text" id="reference" name="reference" value="{{ $invoice->reference }}">
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Select Agent</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Agent" id="agent_id" name="agent_id">
                                            <option value="">Select Agent</option>
                                            @foreach($agents as $agent)
                                                <option value="{{ $agent->id }}" {{ $agent->id == $invoice->agents_id ? 'selected="selected"' : '' }}>{{ $agent->display_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Commission Type</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Customer" id="commission_type" name="commission_type">
                                            <option value="">Select Commission Type</option>
                                            <option value="1" {{ $invoice->commission_type == 1 ? 'selected="selected"' : '' }}>%</option>
                                            <option value="2" {{ $invoice->commission_type == 2 ? 'selected="selected"' : '' }}>BDT</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="agentcommissionAmount">Commission Amount</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Agent Commission</label>
                                        <input class="md-input" type="text" id="agentcommissionAmount" name="agentcommissionAmount" value="{{ $invoice->agentcommissionAmount }}">
                                    </div>
                                </div>

                                <div class="uk-grid uk-margin-large-top uk-margin-large-bottom" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1">
                                        <table class="uk-table">
                                            <thead>
                                            <tr>
                                                <th class="uk-text-nowrap">#</th>
                                                <th class="uk-text-nowrap">Item Details</th>
                                                <th class="uk-text-nowrap">Description</th>
                                                <th class="uk-text-nowrap">Quantity</th>
                                                <th class="uk-text-nowrap">Rate</th>
                                                <th class="uk-text-nowrap">Discount</th>
                                                <th class="uk-text-nowrap uk-width-medium-1-6 hidden">Tax</th>
                                                <th class="uk-text-nowrap">Amount</th>
                                                <th class="uk-text-nowrap">Account</th>
                                                <th class="uk-text-nowrap">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr ng-repeat="invoice_entry in invoice_entries track by $index" class="form_section" id="data_clone">
                                                <td>
                                                    @{{$index+1}}
                                                </td>
                                                <td>
                                                    <select id="item_id_@{{ $index }}" class="item_id" name="item_id[]" ng-model="item_id" ng-change="getItemRate($index)" required>


                                                    </select>
                                                </td>
                                                <td>
                                                    <textarea type="text" id="description_@{{ $index }}" class="md-input" name="description[]" ng-model="description[$index]"></textarea>
                                                    
                                                </td>
                                                <td onkeyup="stockCheck(this)">
                                                    <input type="text" id="quantity_@{{ $index }}" ng-init="quantity[$index]='1'" name="quantity[]" ng-model="quantity[$index]" ng-keyup="calculateInvoice()" class="md-input" required/>
                                                    <span id="stockmessage" style="color: red;display: block"></span>
                                                </td>
                                                <td>
                                                    <input type="text" id="rate_@{{ $index }}" name="rate[]" ng-init="rate[$index]='0.00'" ng-model="rate[$index]" ng-keyup="calculateInvoice()" class="md-input" required/>
                                                </td>
                                                <td>
                                                    <div class="input-group uk-form-stacked">
                                                        <input type="text" id="discount_@{{ $index }}" name="discount[]" ng-init="discount[$index]='0'" ng-model="discount[$index]" ng-keyup="calculateInvoice()" class="md-input" required/>
                                                        <span class="input-group-btn" style="font-size: 15px;">
                                                            <select class="input-group" id="discount_type_@{{ $index }}" name="discount_type[]" ng-model="discount_type" ng-change="calculateInvoice()" style="margin-top: 23px;border-bottom: none;border-left: none;border-top: none;margin-top: 3px;" required>
                                                                <option value="0" selected>%</option>
                                                                <option value="1">BDT</option>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="hidden">
                                                    <select id="tax_id_@{{ $index }}" class="tax_id" name="tax_id[]" ng-model="tax_id" ng-change="calculateInvoice()" required>


                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text"
                                                           id="amount_@{{ $index }}"
                                                           name="amount[]"
                                                           ng-init="amount[$index]='0.00'"
                                                           ng-model="amount[$index]"
                                                           class="md-input"
                                                           readonly="readonly" required/>
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
                                                <td class="hidden">

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
                                    <div class="uk-width-medium-1-3 uk-margin-medium-top">
                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-1">
                                                @if($invoice->file_name)
                                                    <a href="{{ url('invoice/invoice-download'.'/'.$invoice->file_name) }}"><p class="uk-text-medium uk-margin-bottom">Download Attachment</p></a>
                                                @endif
                                                <label for="user_edit_uname_control">Attach Files: </label>
                                            </div>
                                            <div class="uk-width-medium-1-1">

                                                <div class="uk-form-file uk-text-primary"
                                                     style="width: 200px; height: 30px; border-color: #ececec; border-style: dotted; text-align: center; ">


                                                    <p style="margin: 4px;">Uplaod File  </p>


                                                    <input onchange="uploadLavel()" id="form-file" type="file" name="file">


                                                </div>
                                                <p id="upload_name"></p>
                                            </div>
                                        </div>
                                    </div>
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

                                            <tr ng-if="tax_total>0" class="form_section hidden">
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
                                                    Vat(%)
                                                </td>
                                                <td>
                                                    <input type="text" name="shipping_charge" ng-init="vat='0.00'" ng-model="vat" ng-change="calculateInvoice()" class="md-input md-input-width-medium"  />
                                                </td>
                                                <td>
                                                    @{{ vat_show }} 
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
                                    <div class="uk-width-medium-2-4">
                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-1">
                                                <label for="customer_note">Personal note</label>
                                                <textarea class="md-input" id="customer_note" name="personal_note">{{ $invoice->personal_note}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-2-4">
                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-1">
                                                <label for="customer_note">Customer note</label>
                                                <textarea class="md-input" id="customer_note" name="customer_note"> {{ $invoice->customer_note }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="uk-grid uk-ma" data-uk-grid-margin>
                                    <div class="uk-width-1-1 uk-float-left">
                                        @if($invoice->save==1)
                                        <input type="submit" class="md-btn md-btn-success" value="save" name="submit" />
                                        @else
                                            <input type="submit" id="submitStock" class="md-btn md-btn-primary" value="submit" name="submit" />
                                        @endif
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

    <!-- Create Item Modal -->
    <div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top: 50px">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Stock Unavailable</h4>
                </div>
                {!! csrf_field() !!}
                <div class="modal-body">
                    <h3 id=""> <span style="list-style: none;color: green;margin-top: 10px;text-decoration: underline"> Stock Avaiable : </span> <span id="StockShow">  </span></h3>

                    <input id="stockId" type="hidden" name="Stockid">
                    <input id="quantity" type="hidden" name="quantity">
                    <div class="modal-footer">
                        <button type="submit" id="addStock" onclick="addStock()" data-dismiss="modal" class="btn btn-primary">Add Stock & Create</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- show Item Modal -->
    <div class="modal fade" id="message-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top: 50px">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Stock available</h4>
                </div>
                <form action="" method="post">
                    {!! csrf_field() !!}
                    <div class="modal-body">
                        <h3 style="list-style: none;color: green;margin-top: 10px;">Stock Added Succesfully</h3>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>

    <script>
        altair_forms.parsley_validation_config();
    </script>
    <script>

        function stockCheck(tr){
            var child=tr.children[0];
            var message=tr.children[1];
            var quantity=child.children[0].value;

            var sib=tr.previousElementSibling;
            var itemId=sib.getElementsByTagName("select")[0].value;
            var arr=[];
            var arr1=[];
            arr[0]=itemId;
            arr1[0]=quantity;
            if(itemId>0){
                $.ajax({
                    url:"/invoice/check/edit",
                    method:"POST",
                    data:{quantity:arr1,item_id:arr},
                    success:function(response){
                        if(response==1){

                        }else{

                            getStock(itemId,quantity);
                            $("#stockId").val(itemId);
                            $("#quantity").val(quantity);
                            $("#create-item").modal("show");
                        }
                    }
                });
            }else{
                message.innerText="Please Select Item";
            }
        }

        function getStock(id,quant){

            axios.post('{!! route('ajax_show_item') !!}', {
                id: id,
                quantity:quant
            })
                .then(function (response) {
                    $("#StockShow").text(response.data) ;

                })
                .catch(function (error) {
                    console.log(error);
                });

        }

        function addStock(){

            var id=$("#stockId").val();
            var quantity=$("#quantity").val();

            axios.post('{!! route('ajax_create_stock') !!}',{
                id: id,
                quantity:quantity
            })
                .then(function (response) {

                    $("#message-item").modal("show");

                })
                .catch(function (error) {
                    console.log(error);
                });

        }
       function uploadLavel(){
           var fullPath = document.getElementById('form-file').value;
           var upload_file_name_ = document.getElementById('upload_name');
           if (fullPath) {
               var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
               var filename = fullPath.substring(startIndex);
               if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                   filename = filename.substring(1);
               }

               upload_file_name_.innerHTML  = filename;

           }
       }
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_invoice').addClass('act_item');

        $(window).load(function(){
            $("#tiktok_account").trigger('click');

        })

    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection
