@extends('layouts.admin')

@section('title', 'Item Report '.date("Y-m-d h-i-sa"))

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
                white-space: nowrap;
                padding: 1px 0px;
                border: none !important;
                width: 100%;
                font-size: 11px !important;
            }
            .uk-table tr td:first-child,.uk-table tr th:first-child{
             text-align: left !important;
            }
            .uk-table tr th ,.uk-table:last-child tr td{

                white-space: nowrap;
                padding: 1px 5px;
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
            <div class="md-card md-card-single main-print">
                <div id="invoice_preview">
                    <div class="md-card-toolbar hidden-print">
                        <div class="md-card-toolbar-actions hidden-print">
                            <i class="md-icon material-icons" id="invoice_print"></i>


                           
                            <!--end  -->
                            <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="true"> <a href="#" data-uk-modal="{target:'#coustom_setting_modal'}"><i class="material-icons">&#xE8B8;</i><span>Custom Setting</span></a>
                                
                            </div>
                            <!--coustorm setting modal start -->
                            <div class="uk-modal" id="coustom_setting_modal">
                                <div class="uk-modal-dialog">
                                {!! Form::open(['url' => 'report/account/item', 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}
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
                        
                        <div class="uk-grid" >
                            
                            <div class="uk-width-small-5-5 uk-text-center">
                                <img style="margin-bottom: -20px;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/>
                                <p style="line-height: 5px; margin-top: 35px;" class="uk-text-large">{{ $OrganizationProfile->company_name }}</p>
                                <p style="line-height: 5px;" class="heading_b">Item Report</p>
                                <p style="line-height: 5px;" class="uk-text-small">From {{$start}}  To {{$end}}</p>
                            </div>
                        </div>
                        <div class="uk-grid">
                            <div class="uk-width-1-1">
                                <table class="uk-table">
                                    <thead>
                                    <tr class="uk-text-upper">
                                        <th class="uk-text-center">Item Name</th>
                                        <th class="uk-text-center">Total Purchases </th>
                                        <th class="uk-text-center"> Total Sales </th>
                                        <th class="uk-text-center">Stock In Hand </th>
                                        <th class="uk-text-center">Purchase Amount</th>
                                        <th class="uk-text-center">Sales Amount</th>
                                        <th class="uk-text-center">Profit</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $total_purchase = 0;
                                         $total_sales=0;
                                         $total_stock_in=0;
                                         $total_purchase_amount=0;
                                         $total_sales_amount=0;
                                         $total_profit_amount=0;
                                    @endphp
                                    @foreach($item as $itemData)

                                    @php
                                      $sales=$itemData->invoiceEntries()->join('invoices','invoices.id','=','invoice_entries.invoice_id')->whereBetween('invoice_date',[$start,$end])->sum('quantity');
                                      $purchase = $itemData->billEntries()->join('bill','bill.id','=','bill_entry.bill_id')->join('stock as s','s.item_id','=','s.id')->where('s.item_id','=',$itemData->id)->whereBetween('bill_date',[$start,$end])->sum('bill_entry.amount');
                                      $_purchase = $itemData->stocks()->whereBetween('date',[$start,$end])->sum('total');
                                      $_sales= $itemData->total_sales;

                                      $profit = $sales-$purchase;
                                    @endphp
                                    <tr class="uk-table-middle">
                                        <td class="uk-text-center"><a href="{{ route('report_account_item_details',[$itemData->id,$start,$end])}} "> {{ $itemData->item_name }} </a></td>
                                        <td class="uk-text-center">{{ $_purchase  }}</td>
                                        <td class="uk-text-center">{{ $_sales }}</td>
                                        <td class="uk-text-center">{{ $_stock=$itemData->total_purchases - $itemData->total_sales }}</td>
                                        <td class="uk-text-center">{{ $purchase }}</td>
                                        <td class="uk-text-center">{{ $sales }}</td>
                                        <td class="uk-text-center">{{ $profit  }}</td>
                                    </tr>

                                    @php

                                         $total_purchase +=$_purchase;
                                         $total_sales +=$_sales;
                                         $total_stock_in +=$_stock;
                                        $total_purchase_amount+=$purchase;
                                         $total_sales_amount += $sales;
                                         $total_profit_amount+=$profit;
                                         $purchase = 0;
                                         $sales=0;
                                          $profit=0;
                                    @endphp
                                    @endforeach

                                    <tr class="uk-table-middle">
                                        <td class="uk-text-center">Total</td>
                                        <td class="uk-text-center"> {{ $total_purchase }} </td>
                                        <td class="uk-text-center"> {{ $total_sales }} </td>
                                        <td class="uk-text-center">{{ $total_stock_in }}</td>
                                        <td class="uk-text-center">{{ $total_purchase_amount }}</td>
                                        <td class="uk-text-center"> {{ $total_sales_amount }}</td>
                                        <td class="uk-text-center"> {{ $total_profit_amount }}</td>
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
