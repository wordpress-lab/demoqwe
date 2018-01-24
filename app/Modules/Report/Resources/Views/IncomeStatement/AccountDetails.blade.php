@extends('layouts.admin')

@section('title', 'Visa IncomeStatement Report '.date("Y-m-d h-i-sa"))

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('styles')
    <style>
        .no_display{
            display: none;
            text-align: center;
        }

        @media print {
            a[href]:after {
                content:"" !important;

            }
            a{
                text-decoration: none;
            }
            body{
                margin-top: -140px;
            }
            #profit_loss{
                font-size: 11px !important;
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
                                        {!! Form::open(['url' => route("deatils_data_account_report_account_details_filter",["id"=>$account_name["id"],"group"=>$group]), 'method' => 'GET', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}
                                        <div class="uk-modal-header">
                                            <h3 class="uk-modal-title">Select Date Range <i class="material-icons" data-uk-tooltip="{pos:'top'}" title="headline tooltip">&#xE8FD;</i></h3>
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
                                            <button type="submit"  class="md-btn md-btn-flat md-btn-flat-primary">Search</button>
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
                                    <p style="line-height: 12px;" class="heading_b">Income Statement</p>
                                    <p style="line-height: 12px;" class="uk-text-medium">$$ {{ $account_name["account_name"] }} $$</p>
                                    <p style="line-height: 5px;" class="uk-text-small">From {{$start}}  To {{$end}}</p>
                                </div>
                            </div>
                            <div class="uk-grid uk-margin-large-bottom">
                                <div class="uk-width-1-1">
                                    <i class="spinner"></i>
                                    <table style="width: 100%" id="visa_income_loss">
                                        <thead>
                                        <tr class="uk-text-upper">
                                            <th class="uk-text-left" style="display: none;"></th>
                                            <th class="uk-text-left">Transaction Id</th>
                                            <th class="uk-text-right">Debit</th>
                                            <th class="uk-text-right">Credit</th>
                                            <th class="uk-text-right">Balance</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                        $visa = ["visa_income","visa_expense","visa_processing_expense","visa_processing_income"];
                                        $others = ["direct_income","direct_expense","indirect_expense","indirect_income"];


                                        //calculation
                                        $balance = 0;
                                        $debit = 0;
                                        $credit = 0;
                                        @endphp
                                         @if(in_array($group,$visa))
                                             @foreach($report_data as $value)
                                                 <tr>
                                                     <td style="display: none;"></td>
                                                     <td>{{ $value["type"] }}-{{ $value["serial_number"] }}</td>
                                                     <td class="uk-text-right">{{ $value["amount"] }}</td>
                                                     <td class="uk-text-right"> </td>
                                                     <td class="uk-text-right">{{ $balance+=$value["amount"] }}</td>
                                                 </tr>
                                             @endforeach

                                         @endif

                                        @if(in_array($group,$others))

                                            @foreach($report_data as $value)

                                                <tr>
                                                    <td style="display: none;"></td>
                                                    <td>
                                                        @if($value["invoice_id"])
                                                        {{ "INV-".$value["invoice"]["invoice_number"]  }}
                                                        @elseif($value["income_id"])
                                                            {{ "INC-".str_pad($value["income"]["income_number"],6,0,STR_PAD_LEFT )  }}
                                                        @elseif($value["bill_id"])
                                                            {{ "BILL-".$value["bill"]["bill_number"] }}
                                                        @elseif($value["expense_id"])
                                                            {{ "EXP-".str_pad($value["expense"]["expense_number"],6,0,STR_PAD_LEFT) }}
                                                        @elseif($value["payment_receives_id"])
                                                            {{ "PR-".$value["paymentReceive"]["pr_number"] }}
                                                        @elseif($value["payment_made_id"])
                                                            {{ "PM-".$value["paymentMade"]["pm_number"] }}
                                                        @elseif($value["salesComission_id"])
                                                            {{ "SC-".str_pad($value["SalesCommission"]["scNumber"],6,0,STR_PAD_LEFT) }}
                                                        @elseif($value["bank_id"])
                                                            {{ "BANK-".str_pad($value["bank_id"],6,0,STR_PAD_LEFT) }}
                                                        @endif
                                                    </td>
                                                    <td class="uk-text-right">
                                                        @if($value["debit_credit"]==1)
                                                        {{ $value["amount"] }}
                                                        @endif
                                                    </td>
                                                    <td class="uk-text-right">
                                                        @if($value["debit_credit"]==0)
                                                            {{ $value["amount"] }}
                                                        @endif
                                                    </td>
                                                    <td class="uk-text-right">
                                                        @if($value["debit_credit"]==1)
                                                        {{ $balance+=$value["amount"] }}
                                                        @endif
                                                        @if($value["debit_credit"]==0)
                                                        {{ $balance-=$value["amount"] }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                      @php
                                       $balance = 0;
                                      @endphp
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
        <script src="{{ url('admin/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ url('admin/bower_components/handlebars/handlebars.min.js')}}"></script>
        <script src="{{ url('admin/assets/js/custom/handlebars_helpers.min.js')}}"></script>

        <!--  invoices functions -->
        <script src="{{ url('admin/assets/js/pages/page_invoices.min.js')}}"></script>
        <script type="text/javascript">
            var datalist = null;
            var start_date = "{{ $start }}";
            var end_date = "{{ $end }}";

            var url = '{{ $detail_url }}';
            window.onload =  function () {

                $.get(url, function(data, status){
                    var reorderdata = [];

                    data.forEach(function(v) {

                        reorderdata.push([k, v.account_name, v.amount,v.amount,v.id]);
                    });



    //                $('#visa_income_loss').DataTable({
    //                    "paging": false,
    //                    "searching": false,
    //                    "bFilter": false,
    //                    "bInfo": false,
    //                    "bPaginate":false,
    //                    info: false,
    //                    rowReorder: {
    //                        enable: false
    //                    },
    //
    //                    "ordering": false,
    //                    data:reorderdata,
    //                    "columnDefs": [
    //                        { className: "no_display", "targets": [ 0 ] },
    //                        { className: "uk-text-right", "targets": [ 2 ] },
    //                        {
    //                            "targets": 1,
    //
    //                            "render": function ( link, type, row ) {
    //
    //                                if(row[0]=="group"){
    //                                    return "<b>"+link+"</b>";
    //                                }
    //                                if(row[0]=="group_sub_total"){
    //                                    return "<div style='text-align: right' >"+link+"</div>";
    //                                }
    //                                return "<a target='_blank' href="+detailurl+"/"+row[0]+">"+link+"</a>";
    //
    //                            }
    //                        }
    //                    ]
    //                });
                    $(".spinner").remove();



                }).fail(function() {
                    $(".spinner").remove();
                    alert("Loading fail.Please contact with your vendor.");

                });
            };
            $(".spinner").remove();
            $('#sidebar_main_account').addClass('current_section');
            $('#sidebar_reports').addClass('act_item');
        </script>
    @endsection
