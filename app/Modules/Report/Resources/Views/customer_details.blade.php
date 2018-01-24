@extends('layouts.admin')

@section('title', 'Customer Details '.date("Y-m-d h-i-sa"))

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('styles')
    <style>
        @media print {
            body{
                margin-top: -40px;
            }
            a[href]:after {
                content:"" !important;

            }
            a{
                text-decoration: none;
            }

            table#customer_details {
                table-layout: auto;
                border-collapse: collapse;
                width: 100%;
                font-size: 11px !important;

            }
           table#customer_details tr td:first-child{
               font-size: 9px;

               white-space: nowrap;  /** column break remove **/
           }

            table#customer_details tr th:first-child{
                font-size: 9px;

            }
            table#customer_details tr td,table#customer_details tr th{
                font-size: 9px;

            }

            #customer_details tr th{
                border-top:1px solid black;
                border-bottom:1px solid black;
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
                                {!! Form::open(['url' => route('report_account_customer_id_search',[$contact->id]), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}
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
                        
                        <div class="uk-grid" data-uk-grid-margin="">
                            
                            <div class="uk-width-small-5-5 uk-text-center">
                                <img style="margin-bottom: -20px;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/>
                                <p style="line-height: 5px; margin-top: 35px;" class="uk-text-large">{{ $OrganizationProfile->company_name }}</p>
                                <p style="line-height: 5px;" class="heading_b">{{$contact->display_name}} Sales Report</p>
                                <p style="line-height: 5px;" class="uk-text-small">From {{$start}}  To {{$end}}</p>
                            </div>
                        </div>
                        <div class="uk-grid uk-margin-large-bottom">
                            <div class="uk-width-1-1">
                                <table style="width: 100%;padding: 7px;"  id="customer_details" >
                                    <thead>
                                    <tr class="uk-text-upper">
                                        <th class="uk-text-center">DATE</th>
                                        <th class="uk-text-center">Transaction No</th>
                                        <th class="uk-text-center">Particulars</th>
                                        <th class="uk-text-center">Total Credit Amount</th>
                                        <th class="uk-text-center">Total Refund</th>
                                        <th class="uk-text-center">Total Receivable</th>
                                        {{--<th class="uk-text-center">Due</th>--}}
                                        <th class="uk-text-center">Total Received</th>
                                        {{--<th class="uk-text-center">Received Through </th>--}}
                                        <th class="uk-text-center">Balance</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $balance = 0; $total_receivable = 0; 
                                    $total_due = 0; $total_receives = 0;?>
                                    <tr class="uk-table-middle">
                                        <td class="uk-text-left">
                                            {{ date('d-m-Y',strtotime($customer_report['final']['date'])) }}
                                        </td>
                                        <td class="uk-text-center"></td>
                                        <td class="uk-text-center">Openning Balance</td>
                                        <td></td>
                                        <td></td>
                                        <td class="uk-text-center">


                                        </td>

                                        {{--<td class="uk-text-center">{{$customer_report_data['total_amount']}}</td>--}}
                                        <td class="uk-text-center"></td>

                                        {{--<td></td>--}}
                                        <td class="uk-text-center">

                                                {!! $customer_report['final']['final_amount'] !!}


                                        </td>
                                    </tr>
                                    @foreach($customer_report as $customer_report_data)
                                    @if($customer_report_data['type'] == 'invoice')
                                        <tr class="uk-table-middle">
                                            <td class="uk-text-left">{{ date('d-m-Y',strtotime($customer_report_data['invoice_date'])) }}</td>
                                            <td class="uk-text-center">INV-{{ str_pad($customer_report_data['invoice_number'], 6, '0', STR_PAD_LEFT) }}</td>
                                            <td class="uk-text-center">{!! isset($customer_report_data['item_name'])?$customer_report_data['item_name']:'' !!}  </td>
                                            <td></td>
                                            <td></td>
                                            <td class="uk-text-center">
                                               {{$customer_report_data['total_amount']}}
                                               
                                            </td>

                                            {{--<td class="uk-text-center">{{$customer_report_data['total_amount']}}</td>--}}
                                            <td class="uk-text-center"></td>
                                            <?php 
                                            $balance = $balance+$customer_report_data['total_amount']; 
                                            $total_receivable = $total_receivable+$customer_report_data['total_amount']; 
                                            $total_due = $total_due+$customer_report_data['total_amount']; 
                                            ?>
                                            {{--<td></td>--}}
                                            <td class="uk-text-center">
                                            @if($balance == 0)
                                            00
                                            @elseif($balance > 0)
                                            {{$balance}}
                                            @elseif($balance < 0)
                                            ({{abs($balance)}})
                                            @endif
                                            </td>
                                        </tr>
                                    @elseif($customer_report_data['type'] == 'paymentreceiveinvoice')
                                        <?php
                                        $balance = $balance-$customer_report_data['amount'];

                                        $total_receives = $total_receives+$customer_report_data['amount'];
                                       $item='' //isset(array_unique(explode(',',$customer_report_data['item_name']))[0])?array_unique(explode(',',$customer_report_data['item_name']))[0]:'' ;
                                        ?>
                                    <tr class="uk-table-middle">
                                        <td class="uk-text-left">{{ date('d-m-Y',strtotime($customer_report_data['payment_date'])) }} </td>
                                        <td class="uk-text-center">PR-{{ str_pad($customer_report_data['pr_number'], 6, '0', STR_PAD_LEFT) }}</td>
                                        <td class="uk-text-center">{!! $customer_report_data['item_name'] !!}</td>
                                        <td class="uk-text-center"></td>
                                        <td class="uk-text-center"></td>
                                        <td class="uk-text-center">

                                        </td>
                                        {{--<td class="uk-text-center">--}}
                                          {{--{{ isset($customer_report_data['due'])?$customer_report_data['due']:'' }}--}}
                                        {{--</td>--}}

                                        <td class="uk-text-center">{{$customer_report_data['amount']}}</td>
                                        {{--<td>{{ isset($customer_report_data['receive_through'])?$customer_report_data['receive_through']:'' }}</td>--}}

                                        <td class="uk-text-center">
                                            @if($balance == 0)
                                            00
                                            @elseif($balance > 0)
                                            {{$balance}}
                                            @elseif($balance < 0)
                                            ({{abs($balance)}})
                                            @endif
                                        </td>
                                    </tr>
                                    @elseif($customer_report_data['type'] == 'paymentreceive')
                                          <tr class="uk-table-middle">
                                            <td class="uk-text-left">{{ date('d-m-Y',strtotime($customer_report_data['payment_date'])) }}</td>
                                            <td class="uk-text-center">PR-{!! isset($customer_report_data['pr_number'])?$customer_report_data['pr_number']:'' !!}  </td>
                                            <td class="uk-text-center">Excess Payment</td>
                                            <td class="uk-text-center">
                                            </td>
                                            <td class="uk-text-center"></td>
                                            <td class="uk-text-center"></td>
                                            {{--<td class="uk-text-center"></td>--}}

                                            <td class="uk-text-center">{{$customer_report_data['amount']}}</td>
                                            {{--<td>{{ isset($customer_report_data['receive_through'])?$customer_report_data['receive_through']:'' }}</td>--}}
                                            <?php 
                                            $balance = $balance-$customer_report_data['amount'];
                                            
                                            $total_receives = $total_receives+$customer_report_data['amount'];
                                            ?>
                                            <td class="uk-text-center">
                                            @if($balance == 0)
                                            00
                                            @elseif($balance > 0)
                                            {{$balance}}
                                            @elseif($balance < 0)
                                            ({{abs($balance)}})
                                            @endif
                                            </td>
                                        </tr>

                                    @elseif($customer_report_data['type'] == 'creditnote')
                                        <tr class="uk-table-middle">
                                            <td class="uk-text-left">{{ date('d-m-Y',strtotime($customer_report_data['credit_note_date'])) }}</td>
                                            <td class="uk-text-center">CN-{{ isset($customer_report_data['cr_number'])? str_pad($customer_report_data['cr_number'], 6, '0', STR_PAD_LEFT):'' }}</td>
                                            <td class="uk-text-center">   {{ $customer_report_data['item_name'] }}</td>

                                            <td class="uk-text-center">
                                                {{$customer_report_data['total_credit_amount']}}
                                            </td>
                                            <td class="uk-text-center"></td>
                                            <td class="uk-text-center"></td>
                                            @php
                                                $total_due += $customer_report_data['due'];
                                            @endphp
                                            {{--<td class="uk-text-center">{{$customer_report_data['due']}}</td>--}}

                                            <td class="uk-text-center"></td>
                                            {{--<td></td>--}}

                                            <td class="uk-text-center">

                                            </td>
                                        </tr>
                                    @elseif($customer_report_data['type'] == 'creditnote_payaments')
                                        <tr class="uk-table-middle">

                                            <td class="uk-text-left">{{ date('d-m-Y',strtotime($customer_report_data['payment_date'])) }}</td>
                                            <td class="uk-text-center">CN-{{ isset($customer_report_data['cn_number'])? str_pad($customer_report_data['cn_number'], 6, '0', STR_PAD_LEFT):'' }}</td>
                                            <td class="uk-text-center">   {!! isset($customer_report_data['item_name'])?$customer_report_data['item_name']:'' !!}  </td>
                                            <td class="uk-text-center">

                                            </td>
                                            <td class="uk-text-center">  </td>
                                            <td class="uk-text-center">  </td>
                                            <?php
                                            $balance = $balance-$customer_report_data['total_recieve_amount'];

                                           // $total_receives = $total_receives+$customer_report_data['amount'];
                                            ?>
                                            {{--<td class="uk-text-center">{{ $customer_report_data['due'] }}</td>--}}

                                            <td class="uk-text-center">  {{ $customer_report_data['total_recieve_amount'] }} </td>
                                            {{--<td></td>--}}

                                            <td class="uk-text-center">
                                                ({{ abs($balance) }})

                                            </td>
                                        </tr>

                                    @elseif($customer_report_data['type'] == 'creditnote_refund')
                                        <tr class="uk-table-middle">
                                            <td class="uk-text-left">{{ date('d-m-Y',strtotime($customer_report_data['date'])) }}</td>
                                            <td class="uk-text-center">CN-{{ isset($customer_report_data['cr_number'])? str_pad($customer_report_data['cr_number'], 6, '0', STR_PAD_LEFT):'' }}</td>
                                            <td class="uk-text-center">   {!! $customer_report_data['item_name'] !!}</td>
                                            <td class="uk-text-center">

                                            </td>
                                            <td class="uk-text-center"> {{ $customer_report_data['total_refund'] }} </td>
                                            <td class="uk-text-center">  </td>
                                            @php
                                                // $total_due += $customer_report_data['due'];
                                            @endphp
                                            {{--<td class="uk-text-center">{{ $customer_report_data['due'] }}</td>--}}

                                            <td class="uk-text-center">   </td>
                                            {{--<td></td>--}}

                                            <td class="uk-text-center">

                                            </td>
                                        </tr>
                                    @endif
                                    @endforeach



                                    <tr class="uk-table-middle">
                                            <td class="uk-text-left"></td>
                                            <td class="uk-text-left"></td>
                                            <td class="uk-text-center"></td>
                                            <td class="uk-text-center"></td>
                                            <td class="uk-text-center"></td>
                                            <td class="uk-text-center">{{$total_receivable}}</td>
                                            {{--<td class="uk-text-center">{{$total_due}}</td>--}}
                                            <td class="uk-text-center">{{$total_receives}}</td>
                                             {{--<td></td>--}}
                                            <td class="uk-text-center">
                                                @if($balance == 0)
                                                00
                                                @elseif($balance > 0)
                                                {{$balance}}
                                                @elseif($balance < 0)
                                                ({{abs($balance)}})
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="uk-grid">
                            <div class="uk-width-1-1">
                                <span class="uk-text-muted uk-text-small uk-text-italic">Notes:</span>
                                <p class="uk-text-small" style="font-size: 10px;">Looking forward for your business.</p>
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
<script>
    $('#sidebar_main_account').addClass('current_section');
    $('#sidebar_reports').addClass('act_item');
</script>
@endsection
