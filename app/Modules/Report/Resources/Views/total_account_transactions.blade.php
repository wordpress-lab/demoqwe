@extends('layouts.admin')

@section('title', 'Total Account Transaction '.date("Y-m-d h-i-sa"))

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('styles')
    <style>
        table.due {
            border: .5px solid black !important;
            width: 100%;

        }
        .due tr td{
            vertical-align:middle;
            border: .2px solid gainsboro;

        }
        @media print
        {
            .md-card-toolbar{
                display: none;
            }

            table#profit tr td,table#profit tr th{
                font-size: 11px !important;
            }
            .uk-table tr td{
                padding: 5px 5px;
                border: 1px solid black !important;
                width: 100%;
                font-size: 11px !important;
            }
            .uk-table tr th{
                padding: 5px 5px;
                border: 1px solid black;
                /*border-bottom: 1px solid black;*/
                width: 100%;
                font-size: 11px !important;
            }

            .uk-table>tbody>tr:last-child td{
                border: none !important;
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
                    <div class="md-card-toolbar">
                        <div class="md-card-toolbar-actions hidden-print">
                            <i class="md-icon material-icons" id="invoice_print"></i>


                           
                            <!--end  -->
                            <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="true"> <a href="#" data-uk-modal="{target:'#coustom_setting_modal'}"><i class="material-icons">&#xE8B8;</i><span>Custom Setting</span></a>
                                
                            </div>
                            <!--coustorm setting modal start -->
                            <div class="uk-modal" id="coustom_setting_modal">
                                <div class="uk-modal-dialog">
                                {!! Form::open(['url' => route("account_report_total_transaction_index_data_filter"), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}
                                    <div class="uk-modal-header">
                                        <h3 class="uk-modal-title">Select Date Range and Transaction Type <i class="material-icons" data-uk-tooltip="{pos:'top'}" title="headline tooltip">&#xE8FD;</i></h3>
                                    </div>

                                    <div class="uk-width-large-2-2 uk-width-2-2">
                                        @if(Auth::user()->branch_id==1)
                                        <div class="uk-width-large-2-2 uk-width-2-2">
                                            <div class="uk-input-group">
                                                <label for="branch_id" style="margin-left: 10px;">Branch</label>
                                                <select style="padding: 5px; border-top:none; border-left:none; border-right:none; border-bottom:1px solid lightgray"  id="branch_id" name="branch_id">
                                                <!-- <option value="">Account</option> -->
                                                @foreach($branch as $branch_data)
                                                    <option style="z-index: 10002" value="{{$branch_data->id}}">{{$branch_data->branch_name}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                        @endif
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
                        
                        <div class="uk-grid" data-uk-grid-margin="">
                            
                            <div class="uk-width-small-5-5 uk-text-center">
                                <img style="margin-bottom: -20px;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/>
                                <p style="line-height: 5px; margin-top: 35px;" class="uk-text-large">{{ $OrganizationProfile->company_name }}</p>
                                <p style="line-height: 5px;" class="heading_b">Total Transactions</p>
                                @if(isset($branch_id))<p>@foreach($branch as $branchs) @if($branchs->id==$branch_id) {{$branchs->branch_name}} @endif @endforeach</p>@endif
                                <p style="line-height: 5px;" class="uk-text-small">From {{ date('d-m-Y',strtotime($start)) }}  To {{ date("d-m-Y",strtotime($end."-0 days"))}}</p>
                            </div>
                        </div>
                        <div class="uk-grid uk-margin-large-bottom">
                            <div class="uk-width-1-1">
                                <table class="uk-table">
                                    <thead>
                                    <tr class="uk-text-upper">
                                        <th class="uk-text-left">Transaction</th>
                                        <th class="uk-text-left">Particulars</th>
                                        <th class="uk-text-center">Purchase</th>
                                        <th class="uk-text-center">Sales</th>
                                        <th class="uk-text-center">General Expense</th>
                                        <th class="uk-text-center">Receipt</th>
                                        <th class="uk-text-center">Payment</th>

                                    </tr>
                                    </thead>
                                    @php
                                    $k=0;
                                    $m=0;
                                    $n=0;
                                    $total_purchase = 0;
                                    $total_sales = 0;
                                    $total_generalExpense = 0;
                                    $total_sales_commission = 0;
                                    $total_receipt = 0;
                                    $total_income = 0;
                                    $total_payments = 0;
                                    $total_payments_12 = 0;
                                    @endphp
                                    <tbody>
                                    @foreach($journal as $type=>$item)
                                        @if(is_array($item))
                                           @foreach($item as $value)
                                                <tr>

                                                    <td class="uk-text-left">{{ $value["transaction"] }}</td>
                                                    <td class="uk-text-left">
                                                        {{ $value["display_name"] }} <br/>
                                                        @if(!empty($value["items"]))
                                                        ({{ $value["items"] }})
                                                        @endif
                                                    </td>
                                                    <td class="uk-text-center">
                                                     @if($type=="purchase")
                                                      @php
                                                          $total_purchase+=$value["amount"];
                                                      @endphp
                                                     {{ $value["amount"] }}
                                                     @endif
                                                    </td>
                                                    <td class="uk-text-center">
                                                        @if($type=="sales")
                                                            @php
                                                                $total_sales+=$value["amount"];
                                                            @endphp
                                                            {{ $value["amount"] }}
                                                        @endif
                                                    </td>
                                                    <td class="uk-text-center">
                                                        @if($type=="expenseAndCommission")
                                                            @php
                                                                $total_generalExpense+=$value["amount"];
                                                            @endphp
                                                            {{ $value["amount"] }}
                                                        @endif
                                                    </td>
                                                    <td class="uk-text-center">
                                                        @if($type=="receiptAndIncome")
                                                            @php
                                                                $total_receipt+=$value["amount"];
                                                            @endphp
                                                            {{ $value["amount"] }}
                                                        @endif
                                                    </td>
                                                    <td class="uk-text-center">
                                                        @if($type=="payment")
                                                            @php
                                                                $total_payments+=$value["amount"];
                                                            @endphp
                                                            {{ $value["amount"] }}
                                                        @endif
                                                    </td>
                                                 </tr>
                                           @endforeach
                                       @endif
                                    @endforeach
                                    {{--total--}}
                                    <tr>
                                        <td class="uk-text-left"></td>
                                        <td class="uk-text-left">Total</td>
                                        <td class="uk-text-center">{{ $total_purchase }}</td>
                                        <td class="uk-text-center">{{ $total_sales }} </td>
                                        <td class="uk-text-center">{{ number_format(($total_generalExpense),2,'.','') }}</td>
                                        <td class="uk-text-center"> {{ number_format(($total_receipt),2,'.','') }}</td>
                                        <td class="uk-text-center">
                                            {{ number_format(($total_payments),2,'.','') }}
                                        </td>

                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <hr/>
                        <div class="uk-grid uk-margin-large-bottom">
                            <div class="uk-width-1-1">
                                <table class="due" cellspacing="0" cellpadding="8">

                                    <tbody>
                                    <tr>
                                        <td  rowspan="2"> due amount</td>
                                        <td>purchase</td>
                                        <td>{{ $journal["invoiceDue"] }}</td>
                                        <td  rowspan="2">balance</td>
                                        <td rowspan="2">{{ ($total_receipt)-($total_generalExpense)-($total_payments) }}</td>
                                    </tr>
                                    <tr>
                                        <td>sales</td>
                                        <td> {{ $journal["billDue"] }} </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="uk-grid">
                            <div class="uk-width-1-1">
                                <span class="uk-text-muted uk-text-small uk-text-italic">Notes:</span>
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
