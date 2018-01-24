@extends('layouts.main')

@section('title', 'Dashboard')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section("styles")
    <style>
        .uk-accordion-title:after {
            color:white !important;
        }
    </style>
@endsection
@section('content')

<div class="uk-grid uk-grid-width-large-1-1 uk-grid-width-medium-1-1 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-sortable data-uk-grid-margin>

    <div class="uk-grid" data-uk-grid-margin="">
        <div class="uk-width-large-1-1 uk-width-large-1-2">
            <div class="uk-width-medium-1-1">
                <label for="uk_dp_end">Search By Paxid</label>
                <input class="md-input" name="pax_id" type="text" id="search_pax_id">
            </div>
        </div>

        <div class="uk-width-large-1-6 uk-width-medium-1-1">
            <div class="uk-width-medium-1-6">
                <button class="md-btn" type="submit" id="search" data-uk-button>Search</button>
            </div>
        </div>
        <span id="validate" style="color: red;"></span>
    </div>
</div>

     @if(Auth::user()->type==0)
    <div class="uk-grid uk-grid-width-large-1-2 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-grid-margin="" data-uk-sortable="">
        <div>
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid">
                        <div class="uk-width-1-2">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right">
                                <span class="peity_orders peity_data">64/100</span>
                            </div>
                            <a href="{{ route("invoice") }}?due=1">
                            <h2 class="uk-margin-remove"><span class="countUpMe">{{ number_format((double)$total_receivale,2,'.','') }}</span> BDT</h2>
                            <span class="uk-text-muted uk-text-small">Total Receivable</span>
                             </a>
                        </div>
                        <div class="uk-width-1-2" style="text-align: right; border-left: 1px solid darkgray ">
                            <a href="{{ route("invoice") }}?due=1">
                            <span class="uk-text-muted uk-text-small">Total Due Invoices</span>
                            <h2 class="uk-margin-remove"  ><span class="countUpMe" >{{ $total_invoice }}</span></h2>
                            </a>

                        </div>
                    </div>



                </div>
            </div>
        </div>


        <div>
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid">
                        <div class="uk-width-1-2">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right">
                                <span class="peity_orders peity_data">64/100</span>
                            </div>
                            <a href="{{ route("bill") }}?due=1">
                            <h2 class="uk-margin-remove"><span class="countUpMe">{{ number_format((double)$total_payable,2,'.','') }} </span> BDT</h2>
                            <span class="uk-text-muted uk-text-small">Total Payable</span>
                            </a>
                        </div>
                        <div class="uk-width-1-2" style="text-align: right; border-left: 1px solid darkgray ">
                            <a href="{{ route("bill") }}?due=1">
                            <span class="uk-text-muted uk-text-small">Total Due Bills</span>
                            <h2 class="uk-margin-remove"  ><span class="countUpMe" >{{ $total_bill }}</span></h2>
                            </a>


                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
    <div class="uk-grid uk-grid-width-large-1-3 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-grid-margin="" data-uk-sortable="">



        <div>
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-float-right uk-margin-top uk-margin-small-right">
                        <span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span>
                    </div>

                   <a href="{{ route("report_cashbook") }}">
                       <h2 class="uk-margin-remove"><span class="countUpMe">{{ $todayincome }}</span> BDT</h2>
                       <span class="uk-text-muted uk-text-small">Today Income</span>
                   </a>

                </div>
            </div>
        </div>


        <div>
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-float-right uk-margin-top uk-margin-small-right">
                        <span class="peity_orders peity_data">64/100</span>
                    </div>

                    <a href="{{ route("report_cashbook") }}">
                    <h2 class="uk-margin-remove"><span class="countUpMe">{{ $todayexpense }}</span> BDT</h2>
                    <span class="uk-text-muted uk-text-small">Today Expense</span>
                    </a>
                </div>
            </div>
        </div>


        <div>
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-float-right uk-margin-top uk-margin-small-right">
                        <span class="peity_live peity_data">5,3,9,6,5,9,7,3,5,2,5,3,9,6,5,9,7,3,5,2</span>
                    </div>

                    <a href="{{ route("report_cashbook") }}">
                    <h2 class="uk-margin-remove" id="peity_live_text">{{ $cash_in_hand }} BDT</h2>
                    <span class="uk-text-muted uk-text-small">Cash in Hand</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
        
        <div class="uk-grid uk-grid-width-large-1-2 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-grid-margin="" data-uk-sortable="">
            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right">
                            <span class="peity_orders peity_data">64/100</span>
                        </div>
                        <br/>
                        <a href="{{ route("bank_report") }}?todaydeposit=1">
                        <h2 class="uk-margin-remove"><span class="countUpMe">{{ $total_deposit }}</span> BDT</h2>
                        <span class="uk-text-muted uk-text-small">Total Deposit Today</span>
                       </a>
                    </div>
                </div>
            </div>

            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right">
                            <span class="peity_orders peity_data">64/100</span>
                        </div>
                        <br/>
                        <a href="{{ route("bank_report") }}?todaywithdraw=1">
                        <h2 class="uk-margin-remove"><span class="countUpMe">{{ $total_withdraw }}</span> BDT</h2>
                        <span class="uk-text-muted uk-text-small">Total Withdrawal Today</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <hr>

        <div class="uk-grid uk-grid-width-large-1-2 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-grid-margin="" data-uk-sortable="">
            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right">
                            <span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span>
                        </div>
                        <a href="{{ route("order") }}?today=1">
                        <h2 class="uk-margin-remove"><span class="countUpMe">{{ $customer }}</span></h2>
                        <span class="uk-text-muted uk-text-small">Today Customer</span>
                        </a>
                    </div>
                </div>
            </div>

            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right">
                            <span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span>
                        </div>
                        <a href="{{ route("medical_slip_form_index") }}?today=1">
                        <h2 class="uk-margin-remove"><span class="countUpMe">{{ $medical_slip }}</span></h2>
                        <span class="uk-text-muted uk-text-small">Today Medical Slip</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="uk-grid uk-grid-width-large-1-1 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-grid-margin="" data-uk-sortable="">

            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-grid">
                            <div class="uk-width-1-4">
                                <div class="uk-float-right uk-margin-top uk-margin-small-right">
                                    <span class="peity_orders peity_data">64/100</span>
                                </div>
                                <h2 class="uk-margin-remove"><span class="countUpMe">TODAY REPORT</span></h2>
                            </div>
                            <div class="uk-width-1-4" style="text-align: right; border-left: 1px solid darkgray ">
                                <div class="uk-float-right uk-margin-top uk-margin-small-right">
                                    <span class="peity_orders peity_data">64/100</span>
                                </div>
                                <a href="{{ route("medicalslip") }}?fit=1">
                                <h2 class="uk-margin-remove"><span class="countUpMe">{{ $report_fit }}</span></h2>
                                <span class="uk-text-muted uk-text-small">Fit</span>
                                </a>
                            </div>
                            <div class="uk-width-1-4" style="text-align: right; border-left: 1px solid darkgray ">
                                <a href="{{ route("medicalslip") }}?unfit=1">
                                <h2 class="uk-margin-remove"  ><span class="countUpMe" >{{ $report_unfit }}</span></h2>
                                <span class="uk-text-muted uk-text-small">Unfit</span>
                                </a>
                            </div>
                            <div class="uk-width-1-4" style="text-align: right; border-left: 1px solid darkgray ">
                                <a href="{{ route("medicalslip") }}?nextvisitdate=1">
                                <h2 class="uk-margin-remove"  ><span class="countUpMe" >{{ $report_next_visit }}</span></h2>
                                <span class="uk-text-muted uk-text-small">Next Visit Date</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-grid-margin="" data-uk-sortable="">
            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right">
                            <span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span>
                        </div>
                        <a href="{{ route("mofa") }}?today=1">
                        <h2 class="uk-margin-remove"><span class="countUpMe">{{ $mofa }}</span></h2>
                        <span class="uk-text-muted uk-text-small">Today Mofa</span>
                        </a>
                    </div>
                </div>
            </div>

            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right">
                            <span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span>
                        </div>
                        <a href="{{ route("fit_card") }}?today=1">
                        <h2 class="uk-margin-remove"><span class="countUpMe">{{ $fitcard }}</span></h2>
                        <span class="uk-text-muted uk-text-small">Today Fit Card</span>
                        </a>
                    </div>
                </div>
            </div>

            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right">
                            <span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span>
                        </div>
                        <a href="{{ route("police_clearance_index") }}?today=1">

                        <h2 class="uk-margin-remove"><span class="countUpMe">{{ $police_clearance }}</span></h2>
                        <span class="uk-text-muted uk-text-small">Today Police Clearance</span>
                       </a>
                    </div>
                </div>
            </div>

            <div>
                <div class="md-card">
                    <div class="md-card-content">

                        <div class="uk-float-right uk-margin-top uk-margin-small-right">
                            <span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span>
                        </div>
                        <a href="{{ route("visa") }}?today=1">
                        <h2 class="uk-margin-remove"><span class="countUpMe">{{ $visa }}</span></h2>
                        <span class="uk-text-muted uk-text-small">Total Left Visa</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-grid uk-grid-width-large-1-1 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-grid-margin="" data-uk-sortable="">

            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-grid">
                            <div class="uk-width-1-3">
                                <div class="uk-float-right uk-margin-top uk-margin-small-right">
                                    <span class="peity_orders peity_data">64/100</span>
                                </div>
                                <h2 class="uk-margin-remove"><span class="countUpMe">TODAY STAMPING</span></h2>
                            </div>
                            <div class="uk-width-1-3" style="text-align: right; border-left: 1px solid darkgray ">
                                <div class="uk-float-right uk-margin-top uk-margin-small-right">
                                    <span class="peity_orders peity_data">64/100</span>
                                </div>
                                <a href="{{ route("visastamp") }}?sendtoday=1">
                                <h2 class="uk-margin-remove"><span class="countUpMe">{{ $stamping_send_date }}</span></h2>
                                <span class="uk-text-muted uk-text-small">Send Date</span>
                                </a>

                            </div>
                            <div class="uk-width-1-3" style="text-align: right; border-left: 1px solid darkgray ">
                                <a href="{{ route("visastamp") }}?receivetoday=1">
                                <h2 class="uk-margin-remove"  ><span class="countUpMe" >{{ $stamping_receive_date }}</span></h2>
                                <span class="uk-text-muted uk-text-small">Receive Date</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-grid-margin="" data-uk-sortable="">
            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right">
                            <span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span>
                        </div>
                        <a href="{{ route("fingerprint_index") }}?today=1">
                        <h2 class="uk-margin-remove"><span class="countUpMe">{{ $finger }}</span></h2>
                        <span class="uk-text-muted uk-text-small">Today Finger</span>
                        </a>

                    </div>
                </div>
            </div>

            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right">
                            <span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span>
                        </div>
                        <a href="{{ route("training_index") }}?today=1">
                        <h2 class="uk-margin-remove"><span class="countUpMe">{{ $training }}</span></h2>
                        <span class="uk-text-muted uk-text-small">Today Training</span>
                        </a>
                    </div>
                </div>
            </div>

            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right">
                            <span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span>
                        </div>

                        <a href="{{ route("manpower_index") }}?today=1">
                        <h2 class="uk-margin-remove"><span class="countUpMe">{{ $manpower }}</span></h2>
                        <span class="uk-text-muted uk-text-small">Today Manpower</span>
                        </a>
                    </div>
                </div>
            </div>

            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right">
                            <span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span>
                        </div>

                        <a href="{{ route("completion_index") }}?today=1">
                        <h2 class="uk-margin-remove"><span class="countUpMe">{{ $completion }}</span></h2>
                        <span class="uk-text-muted uk-text-small">Today Completion</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-grid uk-grid-width-large-1-2 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-grid-margin="" data-uk-sortable="">
            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right">
                            <span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span>
                        </div>

                        <a href="{{ route("submission") }}?today=1">
                        <h2 class="uk-margin-remove"><span class="countUpMe">{{ $submission }}</span></h2>
                        <span class="uk-text-muted uk-text-small">Today Submission</span>
                        </a>
                    </div>
                </div>
            </div>

            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right">
                            <span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span>
                        </div>
                        <a href="{{ route("confirmation") }}?today=1">
                        <h2 class="uk-margin-remove"><span class="countUpMe">{{ $confirmation }}</span></h2>
                        <span class="uk-text-muted uk-text-small">Today Confirmation</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-grid">
            <div class="uk-width-1-1">
                <h3 style="background-color: maroon; color: white; padding: 10px; text-align: center"> Kafala And Iqama </h3>
            </div>
        </div>
    <div class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-grid-margin="" data-uk-sortable="">
        <div>
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-float-right uk-margin-top uk-margin-small-right">
                        <span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span>
                    </div>
                    <a id="iqama_insurance_index" href="">
                        <h2 class="uk-margin-remove"><span class="countUpMe"></span></h2>
                        <span class="uk-text-muted uk-text-small">Today Iqama Insurance</span>
                    </a>

                </div>
            </div>
        </div>

        <div>
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-float-right uk-margin-top uk-margin-small-right">
                        <span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span>
                    </div>
                    <a id="iqama_submission_index" href="">
                        <h2 class="uk-margin-remove"><span class="countUpMe"></span></h2>
                        <span class="uk-text-muted uk-text-small">Today Iqama Submission</span>
                    </a>
                </div>
            </div>
        </div>

        <div>
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-float-right uk-margin-top uk-margin-small-right">
                        <span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span>
                    </div>

                    <a id="iqama_receive_index" href="">
                        <h2 class="uk-margin-remove"><span class="countUpMe"></span></h2>
                        <span class="uk-text-muted uk-text-small">Today Iqama Receive</span>
                    </a>
                </div>
            </div>
        </div>

        <div>
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-float-right uk-margin-top uk-margin-small-right">
                        <span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span>
                    </div>

                    <a id="iqama_delivery_clearance_index_22" href="">
                        <h2 class="uk-margin-remove"><span class="countUpMe"></span></h2>
                        <span class="uk-text-muted uk-text-small">Today Iqama Delivery Clearance</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="uk-grid uk-grid-width-large-1-2 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-grid-margin="" data-uk-sortable="">
        <div>
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-float-right uk-margin-top uk-margin-small-right">
                        <span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span>
                    </div>

                    <a id="iqama_Delivery_receipient_index_2" href="">
                        <h2 class="uk-margin-remove"><span class="countUpMe"></span></h2>
                        <span class="uk-text-muted uk-text-small">Today Delivery Receipient</span>
                    </a>
                </div>
            </div>
        </div>

        <div>
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-float-right uk-margin-top uk-margin-small-right">
                        <span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span>
                    </div>
                    <a id="iqama_Delivery_acknowledgement_index_2" href="">
                        <h2 class="uk-margin-remove"><span class="countUpMe"></span></h2>
                        <span class="uk-text-muted uk-text-small">Today Iqama Acknowledgement</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="uk-grid uk-grid-width-large-1-2 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-grid-margin="" data-uk-sortable="">
        <div>
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-float-right uk-margin-top uk-margin-small-right">
                        <span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span>
                    </div>

                    <a id="iqama_kafala_before_index" href="">
                        <h2 class="uk-margin-remove"><span class="countUpMe"></span></h2>
                        <span class="uk-text-muted uk-text-small">Today Kafala Before 60 Days</span>
                    </a>
                </div>
            </div>
        </div>

        <div>
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-float-right uk-margin-top uk-margin-small-right">
                        <span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span>
                    </div>
                    <a id="iqama_kafala_after_index_2" href="">
                        <h2 class="uk-margin-remove"><span class="countUpMe"></span></h2>
                        <span class="uk-text-muted uk-text-small">Today Kafala After 60 Days </span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="uk-grid">
        <div  class="uk-width-1-1">
       <h3 style="background-color: #1976d2;; padding: 10px; color:white" class=""> Approval Reminder  </h3>
        </div>
    </div>
   <div class="uk-grid">


       <div class="uk-width-1-2">
           <div class="uk-accordion" data-uk-accordion id="iqama">
               <h3 class="uk-accordion-title uk-accordion-title-primary" style="opacity: .8;">Iqama Approval</h3>
               <div class="uk-accordion-content">
                   <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                       <thead>
                       <tr>
                           <th>#</th>
                           <th>Pax Id</th>
                           <th>Passenger Name</th>
                           <th class="uk-text-center">Owner Approval</th>
                       </tr>
                       </thead>

                       @php
                           $i = 1;
                       @endphp
                       <tbody>
                       @foreach($iqamaApproval as $value)

                           <tr>
                               <td style="width: 8%">{{ $i++ }}</td>
                               <td>{{ $value->paxid }}</td>
                               <td>{{ $value->passenger_name }}</td>
                               <td class="uk-text-center" style="white-space:nowrap !important;">
                                   @if(is_null($value['iqamaApproval']['apprivalstatus']))
                                       <a title="no approval" href=" {!! $usertype==0? route('iqama_approval_submission',$value->id):'#' !!}" class="batch-edit"><i class="material-icons" style="color: #555555;">&#xE913;</i></a>

                                   @else

                                       <a title="{{ $usertype==1?"no permission":'' }}" href=" {!! $usertype==0? route('iqama_approval_submission',$value->id):'#' !!}" class="batch-edit"><i class="material-icons" style="color: {{ $value['iqamaApproval']['apprivalstatus']==1?"green":"red" }}">&#xE913;</i></a>

                                   @endif
                               </td>
                           </tr>

                       @endforeach

                       </tbody>
                   </table>
               </div>

           </div>

       </div>

       <div class="uk-width-1-2">
           @php
               $i=1;
           @endphp

           <div class="uk-accordion" data-uk-accordion id="stamp">
               <h3 class="uk-accordion-title uk-accordion-title-primary" style="opacity: .8;">Stamping Approval</h3>
               <div class="uk-accordion-content">
                   <table class="uk-table" cellspacing="0" width="100%" id="first_table" >
                       <thead>
                       <tr>
                           <th>#</th>
                           <th>Pax Id</th>
                           <th>Passenger Name</th>
                           <th>Visa Category</th>
                           <th class="uk-text-center">Owner Approval</th>
                       </tr>
                       </thead>

                       <tbody>
                       @foreach($stampingAproval as $value)

                           <tr>
                               <td>{{ $i++ }}</td>
                               <td>{{ $value->paxid }}</td>
                               <td>{{ $value->passenger_name }}</td>
                               <td>
                                   @if($value->visa_category_id == '1')
                                       Company Visa (Free)
                                   @elseif($value->visa_category_id == '2')
                                       Company Visa (Contact)
                                   @elseif($value->visa_category_id == '3')
                                       Processing Visa
                                   @endif
                               </td>
                               <td class="uk-text-center" style="white-space:nowrap !important;">

                                   @if($value->stamp_approval['status']==1)

                                       <a href="{!! route('stamp_approval',$value->id) !!}" class="batch-edit"><i class="material-icons" style="color: green">&#xE913;</i></a>
                                   @elseif($value->stamp_approval['status']==null)
                                       <a href="{!! route('stamp_approval',$value->id) !!}" class="batch-edit"><i class="material-icons" style="color: #555555;">&#xE913;</i></a>
                                   @elseif($value->stamp_approval['status']==0)
                                       <a href="{!! route('stamp_approval',$value->id) !!}" class="batch-edit"><i class="material-icons" style="color: red">&#xE913;</i></a>

                                   @endif
                               </td>
                           </tr>

                       @endforeach

                       </tbody>
                   </table>
               </div>

           </div>


       </div>
   </div>
   <div class="uk-grid">
       <div class="uk-width-1-1">
           <div class="uk-accordion" data-uk-accordion id="flight">
               <h3 class="uk-accordion-title uk-accordion-title-primary" style="opacity: .8;">Flight Submission</h3>
               <div class="uk-accordion-content">
                   <table class="uk-table" cellspacing="0" width="100%" id="second_table" >
                       <thead>
                       <tr>
                           <th>#</th>
                           <th>Pax Id</th>
                           <th>Submission Date</th>
                           <th>Expected Flight Date</th>
                           <th>Due-Amount</th>

                           <th class="uk-text-center">Owner Approval</th>
                       </tr>
                       </thead>
                       @php
                           $i=1;
                       @endphp
                       <tbody>
                       @foreach($flightSubmission as $value)

                           @if($value->owner_approval!=1)
                           <tr>
                               <td>{{ $i++ }}</td>
                               <td>{{ $value->paxid }}</td>
                               <td>{{ $value->submission_date }}</td>
                               <td>{{ $value->expected_flight_date }}</td>
                               <td>{{ $value->invoice['due_amount'] }}</td>

                               @if($value->owner_approval==1)
                                   <td class="uk-text-center">
                                       <a href="{!! route('owner_approval',$value->id) !!}" class="batch-edit"><i class="material-icons" style="color: green;">&#xE913;</i></a>
                                   </td>
                               @elseif($value->owner_approval==null)
                                   <td class="uk-text-center">
                                       <a href="{!! route('owner_approval',$value->id) !!}" class="batch-edit"><i class="material-icons" style="color: #555555;">&#xE913;</i></a>
                                   </td>
                               @elseif($value->owner_approval==0)
                                   <td class="uk-text-center">
                                       <a href="{!! route('owner_approval',$value->id) !!}" class="batch-edit"><i class="material-icons" style="color: red;">&#xE913;</i></a>
                                   </td>
                               @endif

                           </tr>
                           @endif

                       @endforeach

                       </tbody>
                   </table>
               </div>

           </div>

       </div>
   </div>
    <div id="page_content_inner">
        <div id="page_content_inner">
            <h3 class="heading_b uk-margin-bottom">
                <a style="margin: 10px;" class="md-btn md-btn-warning md-bg-deep-orange-700 md-btn-large md-btn-wave-light md-btn-icon" data-uk-modal="{target:'#modal_default'}" href="javascript:void(0)">
                    <i class="material-icons">note_add</i>
                    Add Reminder
                </a>
            </h3>
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-1-2">
                    <div class="md-card">
                        <div class="md-card-content">
                            <h3 class="heading_a uk-margin-bottom">Reminders From Tomorrow</h3>
                            <div class="scrollbar-inner">
                                <div class="timeline timeline_small uk-margin-bottom" id="reminder-1">
                                    @foreach($nextreminder as $value)
                                        <div class="timeline_item" v-for="item in items">
                                            <div class="timeline_icon timeline_icon_success"><i class="material-icons">&#xE85D;</i></div>
                                            <div class="timeline_date">

                                                @if(explode(' ',$value->reminddatetime)[0]=="0000-00-00")
                                                    {{  explode(' ',$value->created_at)[0]  }} <span>At {{ explode(' ',$value->created_at)[1] }}</span>
                                                @else
                                                    {{ explode(' ',$value->reminddatetime)[0] }} <span>At {{ explode(' ',$value->reminddatetime)[1] }}</span>
                                                @endif

                                                <a class="re_delete_btn" onclick="removereminder(this); return false;"  href="{{ route('dashboard_reminder_destroy',$value->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                                                <input type="hidden" class="rem_id" value="{{ $value->id }}">

                                            </div>
                                            <div class="timeline_content">
                                                {{ $value->note }}
                                            </div>
                                        </div>
                                    @endforeach
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-2">
                    <div class="md-card">
                        <div class="md-card-content">
                            <h3 class="heading_a uk-margin-bottom">Today</h3>
                            <div class="scrollbar-inner">
                                <div class="timeline timeline_small uk-margin-bottom" id="reminder-1">
                                    @foreach($todayreminder as $value)
                                        <div class="timeline_item" v-for="item in items">
                                            <div class="timeline_icon timeline_icon_success"><i class="material-icons">&#xE85D;</i></div>
                                            <div class="timeline_date">
                                                {{  explode(' ',$value->reminddatetime)[0]  }} <span>At {{ explode(' ',$value->reminddatetime)[1] }}</span>
                                                <a class="re_delete_btn" onclick="removereminder(this); return false;"  href="{{ route('dashboard_reminder_destroy',$value->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                                                <input type="hidden" class="rem_id" value="{{ $value->id }}">
                                            </div>
                                            <div class="timeline_content">
                                                {{ $value->note }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    @elseif((Auth::user()->type==1))
         <div id="page_content_inner">

             <h3 class="heading_b uk-margin-bottom">
                 <a style="margin: 10px;" class="md-btn md-btn-warning md-bg-deep-orange-700 md-btn-large md-btn-wave-light md-btn-icon" data-uk-modal="{target:'#modal_default'}" href="javascript:void(0)">
                     <i class="material-icons">note_add</i>
                     Add Reminder
                 </a>
             </h3>

             <div class="uk-grid" data-uk-grid-margin>
                 <div class="uk-width-1-2">
                     <div class="md-card">
                         <div class="md-card-content">
                             <h3 class="heading_a uk-margin-bottom">Reminders From Tomorrow</h3>
                             <div class="scrollbar-inner">




                                         <div class="timeline timeline_small uk-margin-bottom" id="reminder-1">
                                             @foreach($nextreminder as $value)
                                                 <div class="timeline_item" v-for="item in items">
                                                     <div class="timeline_icon timeline_icon_success"><i class="material-icons">&#xE85D;</i></div>
                                                     <div class="timeline_date">

                                                         @if(explode(' ',$value->reminddatetime)[0]=="0000-00-00")
                                                             {{  explode(' ',$value->created_at)[0]  }} <span>At {{ explode(' ',$value->created_at)[1] }}</span>
                                                         @else
                                                             {{ explode(' ',$value->reminddatetime)[0] }} <span>At {{ explode(' ',$value->reminddatetime)[1] }}</span>
                                                         @endif

                                                         <a class="re_delete_btn" onclick="removereminder(this); return false;"  href="{{ route('dashboard_reminder_destroy',$value->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                                                         <input type="hidden" class="rem_id" value="{{ $value->id }}">

                                                     </div>
                                                     <div class="timeline_content">
                                                         {{ $value->note }}
                                                     </div>
                                                 </div>
                                             @endforeach
                                         </div>



                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="uk-width-1-2">
                     <div class="md-card">
                         <div class="md-card-content">
                             <h3 class="heading_a uk-margin-bottom">Today</h3>
                             <div class="scrollbar-inner">




                                 <div class="timeline timeline_small uk-margin-bottom" id="reminder-1">
                                     @foreach($todayreminder as $value)
                                         <div class="timeline_item" v-for="item in items">
                                             <div class="timeline_icon timeline_icon_success"><i class="material-icons">&#xE85D;</i></div>
                                             <div class="timeline_date">


                                                     {{  explode(' ',$value->reminddatetime)[0]  }} <span>At {{ explode(' ',$value->reminddatetime)[1] }}</span>




                                                 <a class="re_delete_btn" onclick="removereminder(this); return false;"  href="{{ route('dashboard_reminder_destroy',$value->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                                                 <input type="hidden" class="rem_id" value="{{ $value->id }}">

                                             </div>
                                             <div class="timeline_content">
                                                 {{ $value->note }}
                                             </div>
                                         </div>
                                     @endforeach
                                 </div>



                             </div>
                         </div>
                     </div>
                 </div>
             </div>

         </div>
    @endif
@endsection
@section('scripts')
    <script type="text/javascript">
        var accordion = UIkit.accordion(document.getElementById('iqama'), {
            showfirst:false
        });
        var accordion = UIkit.accordion(document.getElementById('flight'), {
            showfirst:false
        });
        var accordion = UIkit.accordion(document.getElementById('stamp'), {
            showfirst:false
        });
        $('#data_table_2').DataTable({
            "pageLength": 50
        });
        $('#data_table_3').DataTable({
            "pageLength": 50
        });
        $('#data_table_4').DataTable({
            "pageLength": 50
        });
        $('#data_table_5').DataTable({
            "pageLength": 50
        });
        $('#first_table').DataTable({
            "pageLength": 50
        });
        $('#second_table').DataTable({
            "pageLength": 50
        });
        $('#sidebar_master_dashboard').addClass('current_section');
         var iqama_summery = "{{ route("iqama_summery_deshboard_api") }}";
         var kafala_summery = "{{ route("iqama_kafala_summery_master_deshboard_api") }}";

         var iqama_insurance_index = "{{ route("iqama_insurance_index",['today'=>1]) }}";
         var iqama_submission_index = "{{ route("iqama_submission_index",['today'=>1]) }}";
         var iqama_receive_index = "{{ route("iqama_receive_index",['today'=>1]) }}";
         var iqama_Delivery_Clearance_index = "{{ route("iqama_Delivery_Clearance_index",['today'=>1]) }}";
         var iqama_Delivery_receipient_index = "{{ route("iqama_Delivery_receipient_index",['today'=>1]) }}";
         var iqama_Delivery_acknowledgement_index = "{{ route("iqama_Delivery_acknowledgement_index",['today'=>1]) }}";

         var iqama_kafala_before_index = "{{ route("iqama_kafala_index",['today'=>1]) }}";
         var iqama_kafala_after_index = "{{ route("iqama_kafala_after_index",['today'=>1]) }}";

        window.onload = function () {
            $.get(iqama_summery,function (iqamadata) {

                $("#iqama_insurance_index").attr("href",iqama_insurance_index).children(":first").html("<span class='countUpMe'>"+iqamadata[0].total_insur+"</span>");
                $("#iqama_submission_index").attr("href",iqama_submission_index).children(":first").html("<span class='countUpMe'>"+iqamadata[0].total_subm+"</span>");
                $("#iqama_receive_index").attr("href",iqama_receive_index).children(":first").html("<span class='countUpMe'>"+iqamadata[0].total_rcv+"</span>");
                $("#iqama_delivery_clearance_index_22").attr("href",iqama_Delivery_Clearance_index).children(":first").html("<span class='countUpMe'>"+iqamadata[0].total_clr+"</span>");

                $("#iqama_Delivery_receipient_index_2").attr("href",iqama_Delivery_receipient_index).children(":first").html("<span class='countUpMe'>"+iqamadata[0].total_rcpnt+"</span>");
                $("#iqama_Delivery_acknowledgement_index_2").attr("href",iqama_Delivery_acknowledgement_index).children(":first").html("<span class='countUpMe'>"+iqamadata[0].total_ack+"</span>");



            });

            $.get(kafala_summery,function (kafaladata) {
                var after = kafaladata[0].kafala_total_after_days;
                $("#iqama_kafala_before_index").attr("href",iqama_kafala_before_index).children(":first").html("<span class='countUpMe'>"+kafaladata[0].kafala_total_before_days+"</span>");
                $("#iqama_kafala_after_index_2").attr("href",iqama_kafala_after_index).children(":first").html("<span class='countUpMe'>"+after+"</span>");

            });

        };

        $('#search').on('click',function(){
            var search_pax_id = $('#search_pax_id').val();

            if(search_pax_id == ""){
                $("#validate").show();
                $("#validate").html("Field is required");
            }
            else{
                $("#validate").hide();
                $.get("{{route('master_dashboard_search',['id' => ''])}}/"+search_pax_id,function(data){
                    if($.isEmptyObject(data)){
                        $("#validate").show();
                        $("#validate").html("Paxid doesn't match!!");
                    }else{
                        if(data.status == 0 || data.status == null){
                            $("#validate").show();
                            $("#validate").html("Paxid is in archive module!!");
                        }
                        else if(data.status == 1){
                            $("#validate").show();
                            $("#validate").html("Paxid match!!");
                            var win = window.open("{{ route('customer_dashboard',['id' => '']) }}/"+data.paxid, '_blank');
                            win.focus();
                        }
                    }
                });
            }
            
        });
        
    </script>
@endsection