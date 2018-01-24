@extends('layouts.admin')

@section('title', 'Report Agent commission '.date("Y-m-d h-i-sa") )

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
                padding: 1px 2px;
                border: none !important;
                width:1%;
                font-size: 11px !important;
            }
            .uk-table tr th:last-child, .uk-table tr td:last-child{

            }
            .uk-table tr th:first-child, .uk-table tr td:first-child{
                white-space: nowrap;
                text-align: left !important;


            }
            .uk-table tr th{
                white-space: nowrap;
                padding: 1px 2px;
                border-top: 1px solid black;
                border-bottom: 1px solid black;

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
                            <div class="md-card-toolbar-actions ">
                                <i class="md-icon material-icons" id="invoice_print"></i>



                                <!--end  -->
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="true"> <a href="#" data-uk-modal="{target:'#coustom_setting_modal'}"><i class="material-icons">query_builder</i><span>Custom Setting</span></a>

                                </div>
                                <!--coustorm setting modal start -->
                                <div class="uk-modal" id="coustom_setting_modal">
                                    <div class="uk-modal-dialog">
                                        {!! Form::open(['route' => 'reportSalesdateby_agent', 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}
                                        <div class="uk-modal-header">
                                            <h3 class="uk-modal-title">Select Date Range  <i class="material-icons" data-uk-tooltip="{pos:'top'}" title="headline tooltip">&#xE8FD;</i></h3>
                                        </div>

                                        <div class="uk-width-large-2-2 uk-width-2-2">
                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                    <label for="uk_dp_1">Form</label>
                                                    <input class="md-input" type="text" id="uk_dp_1" name="from_date" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                                </div>
                                            </div>
                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                    <label for="uk_dp_1">To</label>
                                                    <input class="md-input" type="text" id="uk_dp_1" name="to_date" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="uk-modal-footer uk-text-right">
                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                            <button type="submit" class="md-btn md-btn-flat md-btn-flat-primary">Search</button>
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
                                    <p style="line-height: 5px;" class="heading_b">Sales Commission</p>
                                    <p style="line-height: 5px;" class="uk-text-small">From {{$start}}  To {{$end}}</p>
                                </div>
                            </div>
                            @inject('Invoice', 'App\Lib\Report')
                            <div class="uk-grid">
                                <div class="uk-width-1-1">
                                    <table class="uk-table">
                                        <thead>
                                        <tr class="uk-text-upper">
                                            <th class="uk-text-center">Serial </th>
                                            <th class="uk-text-center">Agent Name </th>
                                            <th class="uk-text-center">Total Invoices </th>
                                            <th class="uk-text-center">Total Sales </th>
                                            <th class="uk-text-center">Total Received </th>
                                            <th class="uk-text-center">Total Payable</th>
                                            <th class="uk-text-center">Total Paid</th>
                                            <th class="uk-text-center">Due</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                        $i=1;
                                        @endphp
                                         @foreach($journal as $item)

                                             <tr>
                                                 <td class="uk-text-center">{{ $i++ }}</td>
                                                 <td class="uk-text-center"><a href="{{ route('report_Sales_by_agent_details',array('id'=>$item->agents_id,'start'=>$start,'end'=>$end)) }}" >{{ isset($item->Agent->display_name)?$item->Agent->display_name:'' }}</a> </td>
                                                 <td class="uk-text-center">{{$item->totalinvoice }}</td>
                                                 <td class="uk-text-center">{{ $item->sum }}</td>
                                                 <td class="uk-text-center">{{ $item->receivable }}</td>
                                                 <td class="uk-text-center">{{ $item->payable }}</td>
                                                 <td class="uk-text-center">{{ $Invoice->Paid($item->agents_id,$start,$end) }}</td>
                                                 <td class="uk-text-center">{{ $item->payable - $Invoice->Paid($item->agents_id,$start,$end)  }}</td>
                                             </tr>
                                         @endforeach
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
