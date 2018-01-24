@extends('layouts.invoice')

@section('title', 'Item Report '.date("Y-m-d h-i-sa"))

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('styles')
    <style>
        .update-picker-year option,.update-picker-month option{
              color:black !important;
              background: white; !important;
              
          }

        @media print {
            a[href]:after {
                content:"" !important;

            }
            a{
                text-decoration: none;
            }
            #group_pr {
                background-color: #e1e1e1 !important;
                color: black !important;
                font-size: 14px !important;
                font-family: Georgia, Times, "Times New Roman", serif;
            }
            table.uk-table {
                margin-top: -20px;
                width: 100% !important;
                font-family: Georgia, Times, "Times New Roman", serif;
            }
            .uk-table tr td{

                  padding: 1px 0px;
                  border: none !important;

                  font-size: 11px !important;

              }
            .uk-table tr td:first-child,.uk-table tr th:first-child{
                text-align: left !important;

            }
            .uk-table tr th ,.uk-table:last-child tr td{


                padding: 1px 5px;
                border-top: 1px solid black;
                border-bottom: 1px solid black;

                font-size: 11px !important;
            }
            .uk-table tr th:nth-child(3){
                width: 18% !important;


            }
            body{
                margin-top: -50px;
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

                                <div  style="float: left; " data-uk-button-radio="{target:'.md-btn'}">
                                    <a  href="?group=true" style="color:white ; background-color: #7cb342;" class="md-btn md-btn-wave ">Transaction wise</a>
                                    <a href="?flat=true" style="color:white; background-color: #7cb342;" class="md-btn md-btn-wave ">Date wise</a>

                                </div>
                                <i class="md-icon material-icons" id="invoice_print"></i>
                                <!--end  -->
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="true"> <a href="#" data-uk-modal="{target:'#coustom_setting_modal'}"><i class="material-icons">&#xE8B8;</i><span>Custom Setting</span></a>

                                </div>
                                <!--coustorm setting modal start -->
                                <div class="uk-modal" id="coustom_setting_modal">
                                    <div class="uk-modal-dialog">
                                        {!! Form::open(['url' => route('report_account_single_contact_details_by_date',$id), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}
                                        <div class="uk-modal-header">
                                            <h3 class="uk-modal-title">Select Date Range and Transaction Type <i class="material-icons" data-uk-tooltip="{pos:'top'}" title="headline tooltip">&#xE8FD;</i></h3>
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
                                    <p style="line-height: 5px;" class="heading_b">{{ $customer['display_name'] }} Report Details</p>
                                    <p style="line-height: 5px;">{{ $current_branch['branch_name'] }}</p>

                                    <p style="line-height: 5px;"> {{ $start." ". " to " ." $end" }} </p>
                                </div>
                            </div>
                            <div class="uk-grid">
                                <div class="uk-width-1-1">
                                    <table class="uk-table">
                                        <thead>
                                        <tr style="border-bottom: 1px solid white " class="uk-text-middle">
                                            <th class="uk-text-center" style="width: 10%">Date</th>
                                            <th class="uk-text-center" style="width: 15%">Transaction ID </th>
                                            <th class="uk-text-center" style="width: 30%"> Particulars  </th>
                                            <th class="uk-text-center" style="width: 10%">Debit</th>
                                            <th class="uk-text-center" style="width: 10%">Credit</th>
                                            <th class="uk-text-center" style="width: 15%">Balance</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $total_purchase = 0;
                                            $balance = $openning_balance['dr'] - $openning_balance['cr'];

                                        @endphp
                                        <tr style="border-bottom: 0px solid white " class="uk-text-middle">
                                            <td class="uk-text-center">{{ date("d-m-Y",strtotime($start)) }}</td>
                                            <td class="uk-text-center"></td>
                                            <td class="uk-text-center"> Openning Balance  </td>
                                            <td class="uk-text-center">{{ $openning_balance['dr'] }}</td>
                                            <td class="uk-text-center">{{ $openning_balance['cr'] }}</td>
                                            <td class="uk-text-center">{{ $balance }}</td>

                                        </tr>
                                        @if($groupbytype==1)
                                            @foreach($list as $key =>$type)
                                                @php
                                                    $type = $type->sortBy('jurnal_type');
                                                @endphp

                                               @if($key!="invoice")
                                                   <tr id="{{ $key }}" class="md-bg-grey-300" style="color: black;padding-top:10px; " class="uk-table-middle">

                                                       <td style="text-transform: uppercase " id="group_pr" title="{{ $key }}" colspan="6" class="uk-text-left"> {{ $key }} </td>
                                                   </tr>
                                               @foreach($type as $contact)


                                               <tr class="uk-table-middle">
                                                                <td class="uk-text-center">{{ date("d-m-Y",strtotime($contact['assign_date'])) }}</td>
                                                                <td class="uk-text-center"> {{ $contact['transectionid'] }} </td>
                                                                <td class="uk-text-center"> {{ $contact['particularsname'] }} </td>
                                                                <td class="uk-text-center">
                                                                    @if($contact['jurnal_type']=="payment_made2"||$contact['jurnal_type']=="credit note refund")
                                                                       @php
                                                                       $balance=$balance+$contact['amount'];
                                                                       @endphp
                                                                        {{ $contact['amount'] }}
                                                                    @endif

                                                                    @if($contact['jurnal_type']=="bank" && $contact['debit_credit']==1)
                                                                            @php
                                                                                $balance=$balance+$contact['amount'];
                                                                            @endphp
                                                                        {{ $contact['amount'] }}
                                                                    @endif
                                                                        @if($contact['jurnal_type']=="expense"&&$contact['debit_credit']==1)
                                                                            @php
                                                                                $balance=$balance+$contact['amount'];
                                                                            @endphp
                                                                        {{ $contact['amount'] }}
                                                                    @endif
                                                                    @if($contact['jurnal_type']=="journal"&& $contact['debit_credit']==1)
                                                                            @php
                                                                                $balance=$balance+$contact['amount'];
                                                                            @endphp
                                                                            {{  $contact['amount'] }}
                                                                    @endif
                                                                    @if($contact['jurnal_type']=="sales_commission"&&$contact['debit_credit']==1)
                                                                            @php
                                                                                $balance=$balance+$contact['amount'];
                                                                            @endphp
                                                                            {{ $contact['amount'] }}
                                                                    @endif
                                                                    @if($contact['jurnal_type']=="income" &&$contact['debit_credit']==1)
                                                                            @php
                                                                                $balance=$balance+$contact['amount'];
                                                                            @endphp
                                                                            {{ $contact['amount'] }}
                                                                    @endif
                                                                    {{--@if($contact['jurnal_type']=="invoice"&&$contact['account_name_id']==21)--}}
                                                                         {{--{{ $contact['amount'] }}--}}
                                                                    {{--@endif--}}
                                                                </td>
                                                                <td class="uk-text-center">
                                                                    @if($contact['jurnal_type']=="bill" || $contact['jurnal_type']=="payment_receive2"||$contact['jurnal_type']=="credit note")
                                                                        @php
                                                                            $balance=$balance-$contact['amount'];
                                                                        @endphp
                                                                        {{ $contact['amount'] }}
                                                                    @endif
                                                                   @if($contact['jurnal_type']=="bank" && $contact['debit_credit']==0)
                                                                            @php
                                                                                $balance=$balance-$contact['amount'];
                                                                            @endphp
                                                                            {{ $contact['amount'] }}
                                                                   @endif
                                                                    @if($contact['jurnal_type']=="expense" && $contact['debit_credit']==0)
                                                                            @php
                                                                                $balance=$balance-$contact['amount'];
                                                                            @endphp
                                                                        {{ $contact['amount'] }}
                                                                    @endif
                                                                    @if($contact['jurnal_type']=="journal" && $contact['debit_credit']==0)
                                                                            @php
                                                                                $balance=$balance-$contact['amount'];
                                                                            @endphp
                                                                            {{ $contact['amount'] }}
                                                                    @endif
                                                                    @if($contact['jurnal_type']=="sales_commission"&&$contact['debit_credit']==0)
                                                                            @php
                                                                                $balance=$balance-$contact['amount'];
                                                                            @endphp
                                                                            {{ $contact['amount'] }}
                                                                    @endif
                                                                    @if($contact['jurnal_type']=="income" &&$contact['debit_credit']==0)
                                                                            @php
                                                                                $balance=$balance-$contact['amount'];
                                                                            @endphp
                                                                            {{ $contact['amount'] }}
                                                                    @endif



                                                                </td>
                                                                <td class="uk-text-center"> {{ $balance }} </td>
                                                            </tr>



                                               @endforeach
                                        @endif
                                                @if($key=="invoice")
                                                    <tr id="{{ $key }}" class="md-bg-grey-300" style="color: black;padding-top:10px; " class="uk-table-middle">
                                                        <td  style="text-transform: uppercase" id="group_pr"  colspan="6" class="uk-text-left"> {{ $key }} </td>
                                                    </tr>
                                                    @foreach($type as $contact)
                                                        {{--@if($contact['jurnal_type']=="invoice"&&$contact['account_name_id']==21)--}}
                                                        {{--{{ $contact['amount'] }}--}}
                                                        {{--@endif--}}
                                                       @if($contact['account_name_id']==5)
                                                           <tr class="uk-table-middle">
                                                               <td class="uk-text-center">{{ date("d-m-Y",strtotime($contact['assign_date'])) }}</td>
                                                               <td class="uk-text-center"> {{ $contact['transectionid']  }} </td>
                                                               <td class="uk-text-center">  {{ $contact['particularsname'] }} </td>
                                                               <td class="uk-text-center">
                                                                   @php
                                                                       $balance=$balance+$contact['amount'];
                                                                   @endphp
                                                                   {{ $contact['amount'] }}
                                                               </td>
                                                               <td class="uk-text-center">


                                                               </td>
                                                               <td class="uk-text-center"> {{ $balance }} </td>
                                                           </tr>
                                                        @endif
                                                        @if($contact['account_name_id']==21)
                                                        <tr class="uk-table-middle">
                                                            <td class="uk-text-center">{{ date("d-m-Y",strtotime($contact['assign_date'])) }}</td>
                                                            <td class="uk-text-center"> {{ $contact['transectionid']  }} </td>
                                                            <td class="uk-text-center"> Discount  </td>
                                                            <td class="uk-text-center">
                                                                @php
                                                                    $balance=$balance+$contact['amount'];
                                                                @endphp
                                                                 {{ $contact['amount'] }}
                                                            </td>
                                                            <td class="uk-text-center">


                                                            </td>
                                                            <td class="uk-text-center"> {{ $balance }} </td>
                                                    </tr>

                                                        <tr class="uk-table-middle">
                                                            <td class="uk-text-center">{{ date("d-m-Y",strtotime($contact['assign_date'])) }}</td>
                                                            <td class="uk-text-center"> {{ $contact['transectionid'] }} </td>
                                                            <td class="uk-text-center"> Discount Adjustment</td>
                                                            <td class="uk-text-center">


                                                            </td>
                                                            <td class="uk-text-center">
                                                                @php
                                                                    $balance=$balance-$contact['amount'];
                                                                @endphp
                                                                {{ $contact['amount'] }}
                                                            </td>
                                                            <td class="uk-text-center"> {{ $balance }} </td>
                                                        </tr>
                                                        @endif


                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                       @if($flatrow==1)

                                       @foreach($list as $contact)
                                            @if($contact['jurnal_type']!="invoice")
                                            <tr class="uk-table-middle">
                                                <td class="uk-text-center">{{ date("d-m-Y",strtotime($contact['assign_date'])) }}</td>
                                                <td class="uk-text-center"> {{ $contact['transectionid'] }} </td>
                                                <td class="uk-text-center"> {{ $contact['particularsname'] }} </td>
                                                <td class="uk-text-center">
                                                    @if($contact['jurnal_type']=="payment_made2"||$contact['jurnal_type']=="credit note refund")
                                                        @php
                                                            $balance=$balance+$contact['amount'];
                                                        @endphp
                                                        {{ $contact['amount'] }}
                                                    @endif
                                                    @if($contact['jurnal_type']=="bank" && $contact['debit_credit']==1)
                                                            @php
                                                                $balance=$balance+$contact['amount'];
                                                            @endphp
                                                            {{ $contact['amount'] }}
                                                    @endif
                                                    @if($contact['jurnal_type']=="expense"&&$contact['debit_credit']==1)
                                                            @php
                                                                $balance=$balance+$contact['amount'];
                                                            @endphp
                                                            {{ $contact['amount'] }}
                                                    @endif
                                                    @if($contact['jurnal_type']=="journal"&&$contact['debit_credit']==1)
                                                            @php
                                                                $balance=$balance+$contact['amount'];
                                                            @endphp
                                                            {{ $contact['amount'] }}
                                                    @endif
                                                    @if($contact['jurnal_type']=="sales_commission"&&$contact['debit_credit']==1)
                                                            @php
                                                                $balance=$balance+$contact['amount'];
                                                            @endphp
                                                            {{ $contact['amount'] }}
                                                    @endif
                                                        @if($contact['jurnal_type']=="income" &&$contact['debit_credit']==1)
                                                            @php
                                                                $balance=$balance+$contact['amount'];
                                                            @endphp
                                                            {{ $contact['amount'] }}
                                                        @endif

                                                </td>
                                                <td class="uk-text-center">
                                                    @if($contact['jurnal_type']=="bill" || $contact['jurnal_type']=="payment_receive2"||$contact['jurnal_type']=="credit note")
                                                        @php
                                                            $balance=$balance-$contact['amount'];
                                                        @endphp
                                                        {{ $contact['amount'] }}
                                                    @endif
                                                   @if($contact['jurnal_type']=="bank" && $contact['debit_credit']==0)
                                                            @php
                                                                $balance=$balance-$contact['amount'];
                                                            @endphp
                                                            {{ $contact['amount'] }}
                                                    @endif
                                                    @if($contact['jurnal_type']=="expense" && $contact['debit_credit']==0)
                                                            @php
                                                                $balance=$balance-$contact['amount'];
                                                            @endphp
                                                        {{ $contact['amount'] }}
                                                    @endif
                                                    @if($contact['jurnal_type']=="journal" && $contact['debit_credit']==0)
                                                            @php
                                                                $balance=$balance-$contact['amount'];
                                                            @endphp
                                                        {{ $contact['amount'] }}
                                                    @endif
                                                        @if($contact['jurnal_type']=="sales_commission" && $contact['debit_credit']==0)
                                                            @php
                                                                $balance=$balance-$contact['amount'];
                                                            @endphp
                                                            {{ $contact['amount'] }}
                                                        @endif
                                                     @if($contact['jurnal_type']=="income" &&$contact['debit_credit']==0)
                                                            @php
                                                                $balance=$balance-$contact['amount'];
                                                            @endphp
                                                            {{ $contact['amount'] }}
                                                      @endif

                                                </td>
                                                <td class="uk-text-center"> {{  $balance }}</td>
                                            </tr>
                                           @endif
                                            @if($contact['jurnal_type']=="invoice")

                                                @if($contact['account_name_id']==5)
                                                    <tr class="uk-table-middle">
                                                        <td class="uk-text-center">{{ date("d-m-Y",strtotime($contact['assign_date'])) }}</td>
                                                        <td class="uk-text-center"> {{ $contact['transectionid'] }} </td>
                                                        <td class="uk-text-center"> {{ $contact['particularsname'] }} </td>
                                                        <td class="uk-text-center">
                                                            @php
                                                                $balance=$balance+$contact['amount'];
                                                            @endphp
                                                            {{ $contact['amount'] }}


                                                        </td>
                                                        <td class="uk-text-center">



                                                        </td>
                                                        <td class="uk-text-center"> {{ $balance }} </td>
                                                    </tr>
                                                 @endif
                                                @if($contact['account_name_id']==21)
                                                <tr class="uk-table-middle">
                                                    <td class="uk-text-center">{{ date("d-m-Y",strtotime($contact['assign_date'])) }}</td>
                                                    <td class="uk-text-center"> {{ $contact['transectionid'] }} </td>
                                                    <td class="uk-text-center"> Discount </td>
                                                    <td class="uk-text-center">
                                                        @php
                                                            $balance=$balance+$contact['amount'];
                                                        @endphp
                                                            {{ $contact['amount'] }}


                                                    </td>
                                                    <td class="uk-text-center">



                                                    </td>
                                                    <td class="uk-text-center"> {{ $balance }} </td>
                                                </tr>
                                                <tr class="uk-table-middle">
                                                    <td class="uk-text-center">{{ date("d-m-Y",strtotime($contact['assign_date'])) }}</td>
                                                    <td class="uk-text-center"> {{ $contact['transectionid'] }} </td>
                                                    <td class="uk-text-center"> Discount Adjustment </td>
                                                    <td class="uk-text-center">




                                                    </td>
                                                    <td class="uk-text-center">
                                                        @php
                                                            $balance=$balance-$contact['amount'];
                                                        @endphp
                                                        {{ $contact['amount'] }}

                                                    </td>
                                                    <td class="uk-text-center"> {{ $balance }} </td>
                                                </tr>
                                                @endif
                                            @endif

                                       @endforeach
                                       @endif
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
           window.onload = function () {
            $("#payment_made2 td:first-child").text("payment made");
            $("#payment_receive2 td:first-child").text("payment receive");
            $("#sales_commission td:first-child").text("Sales Commission");

           };

           $('#sidebar_main_account').addClass('current_section');
           $('#sidebar_reports').addClass('act_item');
       </script>
       @endsection
