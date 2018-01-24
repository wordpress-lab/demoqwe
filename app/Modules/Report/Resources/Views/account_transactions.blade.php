@extends('layouts.admin')

@section('title', 'Account Transaction '.date("Y-m-d h-i-sa"))

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('styles')
    <style>

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

                            <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="true"> <a href="#"><i class="material-icons">&#xE916;</i><span>Accountant</span></a>
                                <div class="uk-dropdown" aria-hidden="true">
                                    <li>
                                        <a href="{{route('report_account_transactions')}}">All Account</a>
                                    </li>
                                    <ul class="uk-nav">
                                    @foreach($accounts as $accountsData)
                                        <li>
                                            <a href="{{route('report_account_transactions_account_search',[$accountsData->id])}}">{{$accountsData->account_name}}</a>
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
                                            <div style="margin: 8px 55px;" class="uk-input-group">

                                            <select style="padding: 5px; border-top:none; border-left:none; border-right:none; border-bottom:1px solid lightgray"  id="report_account_id" name="report_account_id">
                                                <option value="">Account</option>
                                                @foreach($accounts as $accountsData)
                                                    <option style="z-index: 10002" value="{{$accountsData->id}}">{{$accountsData->account_name}}</option>
                                                @endforeach
                                            </select>
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
                                <p style="line-height: 5px;" class="heading_b">Account Transactions</p>
                                @if(isset($branch_id))<p>@foreach($branch as $branchs) @if($branchs->id==$branch_id) {{$branchs->branch_name}} @endif @endforeach</p>@endif
                                <p style="line-height: 5px;" class="uk-text-small">From {{ date('d-m-Y',strtotime($start)) }}  To {{ date("d-m-Y",strtotime($end."-1 days"))}}</p>
                            </div>
                        </div>
                        <div class="uk-grid uk-margin-large-bottom">
                            <div class="uk-width-1-1">
                                <table class="uk-table">
                                    <thead>
                                    <tr class="uk-text-upper">
                                        <th class="uk-text-left">DATE</th>
                                        <th class="uk-text-left">ACCOUNT</th>
                                        <th class="uk-text-center">TRANSACTION</th>
                                        <th class="uk-text-center">Type</th>
                                        <th class="uk-text-center">REFERENCE</th>
                                        <th class="uk-text-center">TRANSACTION</th>
                                        <th class="uk-text-center">DEBIT</th>
                                        <th class="uk-text-center">CREDIT</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="uk-text-left">{{ date("d-m-Y", strtotime($start)) }}</td>
                                        <td class="uk-text-left">Opening Balance</td>
                                        <td class="uk-text-center"></td>
                                        <td class="uk-text-center"></td>
                                        <td class="uk-text-center"></td>
                                        <td class="uk-text-center"></td>
                                        <td class="uk-text-right">
                                        @if($opening_balance < 0)
                                        {{ $opening_balance }}
                                        @endif
                                        </td>
                                        <td class="uk-text-right">
                                           
                                            @if($opening_balance < 0)
                                            
                                            @elseif($opening_balance >= 0)
                                            {{ $opening_balance }}
                                            @endif
                                        </td>
                                    </tr>
                                    <?php 
                                    $debit = 0;
                                    $credit = 0;
                                    ?>
                                    @foreach($JournalEntry as $JournalEntryData)
                                    <tr class="uk-table-middle">
                                        <td>{{ date("d-m-Y",strtotime($JournalEntryData->assign_date)) }}</td>
                                        <td>{{$JournalEntryData->account->account_name}}</td>
                                        <td>
                                        @if($JournalEntryData->agent_id)
                                                {{ $JournalEntryData->Agent->display_name }}
                                        @elseif($JournalEntryData->contact_id)

                                         {{ $JournalEntryData->contact->display_name }}
                                        @else

                                        @endif

                                        </td>
                                        <td>
                                        @if($JournalEntryData->jurnal_type == 'payment_receive1')
                                        Invoice Payment
                                        @elseif($JournalEntryData->jurnal_type == 'payment_receive2')
                                        Customer Payment
                                        @elseif($JournalEntryData->jurnal_type == 11)
                                            Credit Note
                                        @elseif($JournalEntryData->jurnal_type == 12)
                                            Credit Note Payment
                                        @elseif($JournalEntryData->jurnal_type == 'invoice')
                                        Invoice
                                        @elseif($JournalEntryData->jurnal_type == 'bill')
                                            Bill
                                        @elseif($JournalEntryData->jurnal_type == 'payment_made1')
                                          Bill Payment
                                        @elseif($JournalEntryData->jurnal_type == 'payment_made2')
                                        Vendor Payment
                                        @elseif($JournalEntryData->jurnal_type == 'sales_commission')
                                        Sales Commission
                                        @elseif($JournalEntryData->jurnal_type == 'journal')
                                            Manual Journal
                                        @elseif($JournalEntryData->jurnal_type == 'bank')
                                           Bank
                                        @elseif($JournalEntryData->jurnal_type =="expense")
                                                Expense
                                        @elseif($JournalEntryData->jurnal_type=="income")
                                                Income
                                        @endif

                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                        @if($JournalEntryData->jurnal_type == 'payment_receive1')
                                        INV-{{ str_pad($JournalEntryData->invoice->invoice_number, 6, '0', STR_PAD_LEFT) }}
                                        @elseif($JournalEntryData->jurnal_type == 'payment_receive2')
                                        PR-{{str_pad($JournalEntryData->paymentReceive->pr_number, 6, '0', STR_PAD_LEFT)}}
                                        @elseif($JournalEntryData->jurnal_type == 'payment_made2')
                                        PM-{{str_pad($JournalEntryData->paymentMade->pm_number, 6, '0', STR_PAD_LEFT)}}
                                        @elseif($JournalEntryData->jurnal_type == 'payment_made1')
                                        BILL-{{str_pad($JournalEntryData->bill->bill_number, 6, '0', STR_PAD_LEFT)}}
                                        @elseif($JournalEntryData->jurnal_type == 'sales_commission')
                                            @if(isset($JournalEntryData->SalesCommission->scNumber))
                                        SC-{{str_pad($JournalEntryData->SalesCommission->scNumber, 6, '0', STR_PAD_LEFT)}}
                                            @elseif(is_null($JournalEntryData->salesComission_id))
                                            INV-{{ str_pad($JournalEntryData->invoice->invoice_number, 6, '0', STR_PAD_LEFT) }}
                                            @endif
                                        @elseif($JournalEntryData->jurnal_type == 11)
                                            CN-{{str_pad($JournalEntryData->creditNote->credit_note_number, 6, '0', STR_PAD_LEFT)}}
                                        @elseif($JournalEntryData->jurnal_type == 12)
                                            CN-{{str_pad($JournalEntryData->creditNote->credit_note_number, 6, '0', STR_PAD_LEFT)}}
                                        @elseif($JournalEntryData->jurnal_type == 'invoice')
                                           @if(isset($JournalEntryData->invoice->invoice_number))
                                           INV-{{ str_pad($JournalEntryData->invoice->invoice_number, 6, '0', STR_PAD_LEFT) }}
                                           @endif
                                         @elseif($JournalEntryData->jurnal_type == 'journal')
                                            MJ - {{str_pad($JournalEntryData->journal->id, 6, '0', STR_PAD_LEFT)}}
                                        @elseif($JournalEntryData->jurnal_type == 'bill')
                                            BILL - {{str_pad($JournalEntryData->bill->bill_number, 6, '0', STR_PAD_LEFT)}}
                                        @elseif($JournalEntryData->jurnal_type == 'bank')
                                            BANK - {{str_pad($JournalEntryData->bank->id, 6, '0', STR_PAD_LEFT)}}
                                        @elseif($JournalEntryData->jurnal_type =="expense")
                                          EXP - {{ str_pad($JournalEntryData->expense->expense_number, 6, '0', STR_PAD_LEFT)}}
                                        @elseif($JournalEntryData->jurnal_type=="income")
                                                INC- {{ str_pad($JournalEntryData->income->income_number, 6, '0', STR_PAD_LEFT)}}


                                        @endif
                                        </td>
                                        <td class="uk-text-right">
                                        @if($JournalEntryData->debit_credit == 1)
                                        	{{$JournalEntryData->amount}}
                                            <?php 
                                                $debit = $debit+$JournalEntryData->amount;;
                                            ?>
                                        @else
                                        
                                        @endif
                                        </td>   
                                        <td class="uk-text-right">
                                        	@if($JournalEntryData->debit_credit == 0)
                                        	{{$JournalEntryData->amount}}
                                            <?php  
                                                $credit = $credit+$JournalEntryData->amount;
                                            ?>
                                        	@else
                                        	
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @if($opening_balance < 0)
                                    <?php $cd_debit = $debit+$opening_balance;?>
                                    <?php $cd_credit = $credit;?>
                                    @elseif($opening_balance >= 0)
                                    <?php $cd_credit = $credit+$opening_balance;?>
                                    <?php $cd_debit = $debit;?>
                                    @endif
                                    <?php $cd_balance = $cd_debit-$cd_credit;?>
                                    
                                    <tr>
                                        <td class="uk-text-center"></td>
                                        <td class="uk-text-center"></td>
                                        <td class="uk-text-center"></td>
                                        <td class="uk-text-center"></td>
                                        <td class="uk-text-center"></td>
                                        <td class="uk-text-center"></td>
                                        <td class="uk-text-right">

                                        @if($cd_balance < 0)
                                        <?php $debit = $debit+$cd_balance; ?>
                                        @endif


                                        @if($opening_balance < 0)
                                        <?php $debit = $debit+$opening_balance; ?>
                                        @endif

                                        {{$debit}}

                                        </td>
                                        <td class="uk-text-right">

                                        @if($cd_balance >= 0)
                                        <?php $credit = $credit+$cd_balance; ?>
                                        @endif


                                        @if($opening_balance >= 0)
                                        <?php $credit = $credit+$opening_balance; ?>
                                        @endif

                                        {{$credit}}

                                        </td>
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
