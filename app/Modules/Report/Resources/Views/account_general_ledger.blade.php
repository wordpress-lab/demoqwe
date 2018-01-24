@extends('layouts.admin')

@section('title', 'Account General Ledger '.date("Y-m-d h-i-sa"))

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
            .md-card-toolbar{
                display: none;
            }

            .uk-table{

            }
            .uk-table tr td{
                padding: 1px 2px;
                border: none !important;
                font-size: 11px !important;
                width: 20%;
            }
            .uk-table tr th{
                padding: 1px 2px;
                border-top: 1px solid black;
                border-bottom: 1px solid black;
                width: 20%;
                font-size: 11px !important;
            }
            .uk-table tr th:last-child, .uk-table tr td:last-child{
                text-align: right !important;
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

                            <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="true"> <a href="#"><i class="material-icons">&#xE916;</i><span>Accountant</span></a>
                                <div class="uk-dropdown" aria-hidden="true">
                                    <ul class="uk-nav">
                                        <li>
                                            <a href="#">Today</a>
                                        </li>
                                        <li>
                                            <a href="#">This Week</a>
                                        </li>
                                        <li>
                                            <a href="#">This Month</a>
                                        </li>
                                        <li>
                                            <a href="">This Quarter</a>
                                        </li>
                                        <li>
                                            <a href="#">This Year</a>
                                        </li>
                                        <li>
                                            <a href="#">Yesterday</a>
                                        </li>
                                        <li>
                                            <a href="#">Previous Week</a>
                                        </li>
                                        <li>
                                            <a href="#">Previous Month</a>
                                        </li>
                                        <li>
                                            <a class="uk-text-danger" href="#">Previous Week</a>
                                        </li>
                                        <li>
                                            <a class="uk-text-danger" href="#">Previous Month</a>
                                        </li>
                                        <li>
                                            <a class="uk-text-danger" href="#">Previous Quarter</a>
                                        </li>
                                        <li>
                                            <a class="uk-text-danger" href="#">Previous Year</a>
                                        </li>
                                        <li>
                                            <a class="uk-text-danger" href="#" data-uk-modal="{target:'#coustom_modal'}">Custom</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--coustorm modal start -->
                            <div class="uk-modal" id="coustom_modal">
                                <div class="uk-modal-dialog">
                                    <div class="uk-modal-header">
                                        <h3 class="uk-modal-title">Select Date Range <i class="material-icons" data-uk-tooltip="{pos:'top'}" title="headline tooltip">&#xE8FD;</i></h3>
                                    </div>
                                    <div class="uk-width-large-10-10 uk-width-10-10">
                                        <div class="uk-width-large-1-2 uk-width-1-2">
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                <label for="uk_dp_1">Select date</label>
                                                <input class="md-input" type="text" id="uk_dp_1" data-uk-datepicker="{format:'DD.MM.YYYY'}">
                                            </div>
                                        </div>
                                        <div class="uk-width-large-1-2 uk-width-1-2">
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                <label for="uk_dp_1">Select date</label>
                                                <input class="md-input" type="text" id="uk_dp_1" data-uk-datepicker="{format:'DD.MM.YYYY'}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-modal-footer uk-text-right">
                                        <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button><button data-uk-modal="{target:'#modal_new'}" type="button" class="md-btn md-btn-flat md-btn-flat-primary">Open New Modal</button>
                                    </div>
                                </div>
                            </div>
                            <!--end  -->
                            <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="true"> <a href="#" data-uk-modal="{target:'#coustom_setting_modal'}"><i class="material-icons">&#xE8B8;</i><span>Custom Setting</span></a>
                                
                            </div>
                            <!--coustorm setting modal start -->
                            <div class="uk-modal" id="coustom_setting_modal">
                                <div class="uk-modal-dialog">
                                {!! Form::open(['url' => 'report/account/general/ledger', 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}
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
                                <p style="line-height: 5px;" class="heading_b">Account General Ledger</p>
                                @if(isset($branch_id))<p>@foreach($branch as $branchs) @if($branchs->id==$branch_id) {{$branchs->branch_name}} @endif @endforeach</p>@endif
                                <p style="line-height: 5px;" class="uk-text-small">From {{$start}}  To {{$end}}</p>
                            </div>
                        </div>
                        <div class="uk-grid uk-margin-large-bottom">
                            <div class="uk-width-1-1">
                                <table class="uk-table">
                                    <thead>
                                    <tr class="uk-text-upper">
                                        <th>ACCOUNT</th>
                                        <th class="uk-text-center">BALANCE B/D</th>
                                        <th class="uk-text-center">DEBIT</th>
                                        <th class="uk-text-center">CREDIT</th>
                                        <th class="uk-text-center">BALANCE</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $debit = 0;
                                    $credit = 0;
                                    $total_balance = 0;
                                    ?>
                                    @foreach($accounts as $accountsData)
                                    <tr class="uk-table-middle">
                                        <td><a href="{{ route('report_account_transactions_account_search', ['id' => $accountsData->id]) }}">{{$accountsData->account_name}}</a></td>
                                        <td class="uk-text-center">
                                        <?php $openingDebitAmount = 00;?>
                                        <?php $OpeningCreditAmount = 00;?>
                                       
                                        @foreach($OpeningJournalEntry as $OpeningJournalEntryData)
                                                @if($OpeningJournalEntryData->account_name_id == $accountsData->id)
                                                    @if($OpeningJournalEntryData->debit_credit == 0)
                                                        <?php $OpeningCreditAmount = $OpeningCreditAmount+$OpeningJournalEntryData->amount; ?>
                                                    @elseif($OpeningJournalEntryData->debit_credit == 1)
                                                        <?php $openingDebitAmount = $openingDebitAmount+$OpeningJournalEntryData->amount; ?>
                                                    @endif
                                                @endif
                                        @endforeach
                                       
                                        <?php $balancebd = $openingDebitAmount - $OpeningCreditAmount;?>
                                        @if($balancebd == 0)
                                        00
                                        @elseif($balancebd > 0)
                                        <?php echo $balancebd;?>
                                        @elseif($balancebd < 0)
                                        <?php $balancePbd = abs($balancebd);?>
                                        (<?php echo $balancePbd;?>)
                                        @endif

                                        </td>
                                        <td class="uk-text-center">
                                        <?php $debitAmount = 00;?>
                                        @foreach($JournalEntry as $JournalEntryData)
                                            @if($JournalEntryData->account_name_id == $accountsData->id)
                                                @if($JournalEntryData->debit_credit == 1)
                                                	<?php $debitAmount = $debitAmount+$JournalEntryData->amount; ?>
                                                @endif
                                            @endif
                                        @endforeach
                                        @if($debitAmount == 0)
                                        00
                                        @else
                                        <?php echo $debitAmount;?>
                                        <?php $debit = $debit+$debitAmount;?>
                                        @endif
                                        </td>
                                        <td class="uk-text-center">
                                            <?php $creditAmount = 00;?>
                                            @foreach($JournalEntry as $JournalEntryData)
                                                @if($JournalEntryData->account_name_id == $accountsData->id)
                                                    @if($JournalEntryData->debit_credit == 0)
                                                        <?php $creditAmount = $creditAmount+$JournalEntryData->amount; ?>
                                                    @endif
                                                @endif
                                            @endforeach
                                            @if($creditAmount == 0)
                                            00
                                            @else
                                            <?php echo $creditAmount;?>
                                            <?php $credit = $credit+$creditAmount;?>
                                            @endif
                                        </td>

                                        <td class="uk-text-center">
                                            <?php $balance = $debitAmount-$creditAmount+$balancebd; ?>
                                            @if($balance == 0)
                                            00
                                            @elseif($balance > 0)
                                            <?php echo $balance;?>
                                            <?php $total_balance = $total_balance+$balance; ?>
                                            @elseif($balance < 0)
                                            <?php $balanceP = abs($balance);?>
                                            (<?php echo $balanceP;?>)
                                            <?php $total_balance = $total_balance+$balance; ?>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr class="uk-text-upper">
                                        <th></th>
                                        <th></th>
                                        <th class="uk-text-center">{{$debit}}</th>
                                        <th class="uk-text-center">{{$credit}}</th>
                                        <th class="uk-text-center">
                                        @if($total_balance == 0)
                                        00
                                        @elseif($total_balance > 0)
                                        {{$total_balance}}
                                        @elseif($total_balance < 0)
                                        ({{$total_balance}})
                                        @endif
                                        </th>
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
