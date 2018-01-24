@extends('layouts.admin')

@section('title', 'Item Details Report '.date("Y-m-d h-i-sa"))

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('styles')
    <style>
        @media print {
            a[href]:after {
                content:"" !important;

            }
            a{
                text-decoration: none;
            }


            .uk-table tr td{

                padding: 1px 2px;
                border: none !important;
                width: 100%;
                font-size: 11px !important;
            }
            .uk-table tr th:last-child, .uk-table tr td:last-child{

            }
            .uk-table tr th:first-child, .uk-table tr td:first-child{
                 white-space: nowrap;
             }
            .uk-table tr th{

                padding: 1px 2px;
                border-top: 1px solid black;
                border-bottom: 1px solid black;
                width: 100%;
                font-size: 11px !important;
            }

            body{
                margin-top: -40px;
            }
        }
    </style>
@endsection
@section('content_header')
    <div id="top_bar">
        <div class="md-top-bar">
            <ul id="menu_top" class="uk-clearfix">
                <li data-uk-dropdown class="uk-hidden-small">
                    <a href="#"><i class="material-icons">&#xE02E;</i><span>Reports</span></a>
                    <div class="uk-dropdown">
                        <ul class="uk-nav uk-nav-dropdown">
                            <li>Business Overview</li>
                            <li><a href="{{route('report_account_profit_loss')}}">Profit and Loss</a></li>
                            <li><a href="{{route('report_account_cash_flow_statement')}}">Cash Flow Statement</a></li>
                            <li><a href="{{route('report_account_balance_sheet')}}">Balance Sheet</a></li>
                            <li>Accountant</li>
                            <li><a href="{{route('report_account_transactions')}}">Account Transactions</a></li>
                            <li><a href="{{route('report_account_general_ledger_search')}}">General Ledger</a></li>
                            <li><a href="{{route('report_account_journal_search')}}">Journal Report</a></li>
                            <li><a href="{{route('report_account_trial_balance_search')}}">Trial Balance</a></li>
                            <li>Sales</li>
                            <li><a href="{{route('report_account_customer')}}">Sales by Customer</a></li>
                            <li><a href="">Sales by Item</a></li>
                            <li><a href="{{route('report_account_item')}}">Product Report</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
@endsection
@section('content')
<div class="uk-width-medium-10-10 uk-container-center reset-print">
    <div class="uk-grid uk-grid-collapse" data-uk-grid-margin>
        <div class="uk-width-large-10-10">
            <div class="md-card md-card-single main-print ">
                <div id="invoice_preview ">
                    <div class="md-card-toolbar hidden-print">
                        <div class="md-card-toolbar-actions ">
                            <i class="md-icon material-icons" id="invoice_print"></i>

                            <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="true"> <a href="#"><i class="material-icons">&#xE916;</i><span>All Products</span></a>
                                <div class="uk-dropdown" aria-hidden="true">


                                    <ul class="uk-nav">
                                    @foreach($item as $itemData)
                                        <li>
                                            <a href="{{route('report_account_item_details',[$itemData->id,$start,$end])}}">{{$itemData->item_name}}</a>
                                        </li>
                                    @endforeach
                                    </ul>
                                </div>
                            </div>
                           
                            <!--end  -->
                            <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="true"> <a href="#" data-uk-modal="{target:'#coustom_setting_modal'}"><i class="material-icons">&#xE8B8;</i><span>Custom Setting</span></a>
                                
                            </div>
                            <!--coustorm setting modal start -->
                            <div class="uk-modal" id="coustom_setting_modal">
                                <div class="uk-modal-dialog">
                                {!! Form::open(['url' => 'report/account/transactions', 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}
                                    <div class="uk-modal-header">
                                        <h3 class="uk-modal-title">Select Date Range and Transaction Type <i class="material-icons" data-uk-tooltip="{pos:'top'}" title="headline tooltip">&#xE8FD;</i></h3>
                                    </div>

                                    <div class="uk-width-large-2-2 uk-width-2-2">
                                        <div class="uk-width-large-2-2 uk-width-2-2">
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                <label for="uk_dp_1">Form</label>
                                                <input class="md-input" type="text" id="uk_dp_1" name="from_date" data-uk-datepicker="{format:'DD.MM.YYYY'}">
                                            </div>
                                        </div>
                                        <div class="uk-width-large-2-2 uk-width-2-2">
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                <label for="uk_dp_1">To</label>
                                                <input class="md-input" type="text" id="uk_dp_1" name="to_date" data-uk-datepicker="{format:'DD.MM.YYYY'}">
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-2-2">
                                            <select id="report_account_id" name="report_account_id" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}">
                                                <option style="z-index: 10002px;" value="">Account</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="uk-modal-footer uk-text-right">
                                        <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                        <button type="submit" name="submit" class="md-btn md-btn-flat md-btn-flat-primary">Search</button>
                                    </div>
                                {!! Form::close() !!}
                                </div>
                            </div>
                            <!--end  -->
                        </div>

                        <h3 class="md-card-toolbar-heading-text large" id="invoice_name"></h3>
                    </div>
                    <div class="md-card-content invoice_content print_bg" style="height: 100%;">
                        
                        <div class="uk-grid">
                            
                            <div class="uk-width-small-5-5 uk-text-center">
                                <img style="margin-bottom: -20px;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/>
                                <p style="line-height: 5px; margin-top: 35px;" class="uk-text-large">{{ $OrganizationProfile->company_name }}</p>
                                <p style="line-height: 5px;" class="heading_b">{{$item_report->item_name}} Report</p>
                                <p style="line-height: 5px;" class="uk-text-small">From {{$start}}  To {{$end}}</p>
                            </div>
                        </div>
                        <div class="uk-grid ">
                            <div class="uk-width-1-2">
                                <table class="uk-table">
                                    <thead>
                                    <tr class="uk-text-upper">
                                        <th>Date</th>
                                        <th>Transaction</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Total Purchase</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $amount=0; $transaction = 'Manual Entry'; $customer = '';$bill_purchase=0;

                                     $total_pur_quantity = 0; $total_purchase=0;
                                    ?>
                                    @foreach($stock as $stockData)

                                    @php

                                        if($stockData->bill_id){
                                         $transaction = "BILL-".$stockData->bill->bill_number;
                                         $customer = $stockData->bill->customer->display_name;

                                          $bill_entry = \App\Models\MoneyOut\BillEntry::where('bill_id',$stockData->bill_id)->where('item_id',$stockData->item_id)->sum('bill_entry.amount');
                                          if($bill_entry){
                                          $bill_purchase = $bill_entry;
                                            }

                                        }

                                        if($stockData->credit_note_id){
                                          $transaction = "CN-".$stockData->creditNote->credit_note_number;

                                          $customer = $stockData->creditNote->customer->display_name;
                                        }






                                    @endphp
                                    <tr class="uk-table-middle">
                                        <td>{{$stockData->date}}</td>
                                        <td>{{$transaction}}</td>
                                        <td>{{ $customer }}</td>
                                        <td>{{ $stockData->mtotal }}</td>
                                        <td>{{ $bill_purchase }}</td>

                                    </tr>

                                    @php
                                        $total_pur_quantity = $total_pur_quantity+$stockData->mtotal;
                                        $total_purchase = $total_purchase+$bill_purchase;
                                        $bill_purchase=0;
                                    @endphp
                                    @endforeach
                                     <tr class="uk-table-middle">
                                        <td></td>
                                        <td></td>
                                        <td class="uk-text-center">Total Sold</td>
                                        <td> {{ $total_pur_quantity }}</td>
                                        <td> {{ $total_purchase }}</td>
                                    </tr>

                                    @php


                                         $transaction ='';
                                         $customer ='';




                                    @endphp
                                    </tbody>
                                </table>
                            </div>
                            <div class="uk-width-1-2">
                                <table class="uk-table" style="margin-left: 5px;">
                                    <thead>
                                    <tr class="uk-text-upper">
                                        <th>Date</th>
                                        <th>Transaction </th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Total Sales</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $amount=0; $total_sale_quantity=0;?>
                                    @foreach($InvoiceEntry as $InvoiceEntryData)
                                    <tr class="uk-table-middle">
                                        <td>{{$InvoiceEntryData->updated_at->format('d-m-Y')}}</td>
                                        <td>INV-{{$InvoiceEntryData->invoice->invoice_number}}</td>
                                        <td>{{$InvoiceEntryData->invoice->customer->display_name}}</td>
                                        <td>{{ $InvoiceEntryData->quantity}}</td>
                                        <td>{{ $InvoiceEntryData->amount * $InvoiceEntryData->quantity }}</td>
                                        <?php
                                        $amount = $amount+($InvoiceEntryData->amount * $InvoiceEntryData->quantity);
                                        $total_sale_quantity=$total_sale_quantity+$InvoiceEntryData->quantity
                                        ?>
                                    </tr>
                                    @endforeach
                                     <tr class="uk-table-middle">
                                        <td></td>
                                        <td></td>
                                        <td>Total</td>
                                        <td class="uk-text-center">{{ $total_sale_quantity }}</td>
                                        <td>{{ $amount }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="uk-grid">
                            <div class="uk-width-1-1">
                                <span class="uk-text-muted uk-text-small uk-text-italic">Notes:</span>
                                <p class="uk-text-small">Looking forward for your business.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <!-- handlebars.js -->
<script src="{{ url('admin/bower_components/handlebars/handlebars.min.js')}}"></script>
<script src="{{ url('admin/assets/js/custom/handlebars_helpers.min.js')}}"></script>

<!--  invoices functions -->
<script src="{{ url('admin/assets/js/pages/page_invoices.min.js')}}"></script>
<script type="text/javascript">
    $('#sidebar_main_account').addClass('current_section');
    $('#sidebar_reports').addClass('act_item');
</script>
@endsection
