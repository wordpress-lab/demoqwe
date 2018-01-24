@extends('layouts.invoice')

@section('title', 'Employee Wise Report details '.date("Y-m-d h-i-sa"))

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
            .uk-table{
                border: 1px solid black;
            }
            .uk-table tr td{
                white-space: nowrap;
                padding: 5px 5px;
                border: 1px solid black;
                width: 100%;
                font-size: 11px !important;
            }
            .uk-table tr td:first-child,.uk-table tr th:first-child{
                text-align: left !important;
                width: 10% !important;
            }
            .uk-table tr th ,.uk-table:last-child tr td{

                white-space: nowrap;
                padding: 3px 5px;
                border: 1px solid black;

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
                        {{--<ul class="uk-nav uk-nav-dropdown">--}}
                        {{--<li>Business Overview</li>--}}
                        {{--<li><a href="{{route('report_account_profit_loss')}}">Profit and Loss</a></li>--}}
                        {{--<li><a href="{{route('report_account_cash_flow_statement')}}">Cash Flow Statement</a></li>--}}
                        {{--<li><a href="{{route('report_account_balance_sheet')}}">Balance Sheet</a></li>--}}
                        {{--<li>Accountant</li>--}}
                        {{--<li><a href="{{route('report_account_transactions')}}">Account Transactions</a></li>--}}
                        {{--<li><a href="{{route('report_account_general_ledger_search')}}">General Ledger</a></li>--}}
                        {{--<li><a href="{{route('report_account_journal_search')}}">Journal Report</a></li>--}}
                        {{--<li><a href="{{route('report_account_trial_balance_search')}}">Trial Balance</a></li>--}}
                        {{--<li>Sales</li>--}}
                        {{--<li><a href="{{route('report_account_customer')}}">Sales by Customer</a></li>--}}
                        {{--<li><a href="">Sales by Item</a></li>--}}
                        {{--<li><a href="{{route('report_account_item')}}">Product Report</a></li>--}}
                        {{--</ul>--}}
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

                        <div  class="md-card-toolbar hidden-print">


                            <div style="width: 100%" class="md-card-toolbar-actions hidden-print">



                                <i class="md-icon material-icons" id="invoice_print"></i>




                                <!--end  -->
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="true"> <a href="#" data-uk-modal="{target:'#coustom_setting_modal'}"><i class="material-icons">&#xE8B8;</i><span>Custom Setting</span></a>

                                </div>
                                <!--coustorm setting modal start -->
                                <div class="uk-modal" id="coustom_setting_modal">
                                    <div class="uk-modal-dialog">
                                        {!! Form::open(['url' => route('pms_report_employee_wise_details_filter',['id'=>$id]), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}


                                        <div class="uk-modal-header">
                                            <h3 class="uk-modal-title">Select Date Range and Transaction Type <i class="material-icons" data-uk-tooltip="{pos:'top'}" title="headline tooltip">&#xE8FD;</i></h3>
                                        </div>

                                        <div class="uk-width-large-2-2 uk-width-2-2">
                                            {{--@if(Auth::user()->branch_id==1)--}}
                                            {{--<div class="uk-width-large-2-2 uk-width-2-2">--}}
                                            {{--<div class="uk-input-group">--}}
                                            {{--<label for="branch_id" style="margin-left: 10px;">Branch </label>--}}
                                            {{--<select data-uk-tooltip="{pos:'top'}" style="width:400px;padding: 5px; border-top:none; border-left:none; border-right:none; border-bottom:1px solid lightgray"  id="branch_id" name="branch_id">--}}
                                            {{--<!-- <option value="">Account</option> -->--}}
                                            {{--@foreach($branch as $branch_data)--}}
                                            {{--<option style="z-index: 10002" value="{{$branch_data->id}}">{{$branch_data->branch_name}}</option>--}}
                                            {{--@endforeach--}}
                                            {{--</select>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            {{--@endif--}}
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
                                    {{--<img style="margin-bottom: -20px;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/>--}}
                                    {{--<p style="line-height: 6px; margin-top: 35px;" class="uk-text-large">{{ $OrganizationProfile->company_name }}</p>--}}
                                    <p style="line-height: 20px;" class="heading_b">Employeewise Report</p>
                                    <p style="line-height: 20px; margin-top: 10px;" class="heading_b">{{ $emp['name'] }}</p>
                                    {{--<p style=" line-height: 6px;" class="">{{ $current_branch['branch_name'] }}</p>--}}
                                    @if(isset($start) && isset($end))
                                        <p style="line-height: 6px;" > {{ $start. " to ". $end }} </p>
                                    @endif

                                </div>
                            </div>
                            <div class="uk-grid">
                                <div class="uk-width-1-1">
                                    <table id="contact_filter_table" class="uk-table">
                                        <thead>
                                        <tr class="uk-text-upper">
                                            <th class="uk-text-center">Date</th>
                                            <th class="uk-text-center">Particulars</th>
                                            <th class="uk-text-center">Payable</th>
                                            <th class="uk-text-center">Paid</th>
                                            <th class="uk-text-center">Due</th>
                                        </tr>
                                        </thead>
                                        <tbody id="sortbyalpa">
                                        <tr>
                                            <td width="10%"></td>
                                            <td class="uk-text-center">Opening Balance</td>
                                            <td class="uk-text-center">{{ $openning_balance->total_payable }}</td>
                                            <td class="uk-text-center">{{ $openning_balance->total_paid }}</td>
                                            <td class="uk-text-center">{{ $openning_balance->total_due }}</td>
                                        </tr>

                                        @foreach($data as $value)

                                            <tr style="background: ghostwhite">
                                                <td class="uk-text-left">{{ date("Y-m-d",strtotime($value["created_at"])) }} </td>
                                                <td class="uk-text-center">
                                                    {{ $value->sheetId["period_from"] }} to {{ $value->sheetId["period_to"] }}
                                                    {{--<br/>--}}

                                                </td>
                                                <td class="uk-text-center"> {{ number_format($value["total_payable"],2,'.','') }} </td>
                                                <td class="uk-text-center"> </td>
                                                <td class="uk-text-center"> {{ number_format($openning_balance->total_due+$value["total_payable"],2,'.','') }}</td>
                                            </tr>
                                            @php
                                                $openning_balance->total_due+=$value["total_payable"];
                                            @endphp
                                             @foreach($value->payment as $item)
                                                 <tr>
                                                     <td class="uk-text-right"><span style="float: right"> {{ $item["date"] }}  </span> </td>
                                                     <td class="uk-text-center">
                                                        PV-{{ $item["number"] }}
                                                         <br/>
                                                           ({{ $item["note"] }})
                                                      </td>
                                                     <td class="uk-text-center"> </td>
                                                     <td class="uk-text-center"> {{ number_format($item["amount"],2,'.','') }}</td>
                                                     <td class="uk-text-center"> {{ number_format($openning_balance->total_due-=$item["amount"],2,'.','') }}</td>
                                                 </tr>
                                             @endforeach
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

    <script type="text/javascript">
        $('#sidebar_pms').addClass('current_section');
        $('#sidebar_pms_report').addClass('act_item');
    </script>
@endsection
