@extends('layouts.admin')

@section('title', 'Report')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

{{--@section('content_header')
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
                            <li><a href="{{route('report_account_product')}}">Product Report</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
@endsection--}}

@section('content')
    <div class="md-card">
        <div class="md-card-content">
            <div class="uk-grid uk-grid-divider" data-uk-grid-margin>
                <div class="uk-width-large-1-3 uk-width-medium-1-2">

                    <h3 class="heading_a"><i class="material-icons">&#xE0AF;</i> Analytical Report</h3>
                    <ul class="md-list">

                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{route('recrutereport_total_ticket_report')}}"><i class="material-icons">&#xE315;</i>Total Ticket Under Vendors</a></span>
                            </div>
                        </li>
                        <li hidden>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{route('recrutereport_company')}}"><i class="material-icons">&#xE315;</i>Total Okala Under Company</a></span>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{route('recrutereport_total_visa_report')}}"><i class="material-icons">&#xE315;</i>Total Visa Type Under Company</a></span>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{ route('recrutereport_reference_report') }}"><i class="material-icons">&#xE315;</i>Reference Wise Report</a></span>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{route('account_report_incomestatement_visa_index')}}"><i class="material-icons">&#xE315;</i>Income Statement</a></span>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="uk-width-large-1-3 uk-width-medium-1-2">
                    <h3 class="heading_a"><i class="material-icons">&#xE0AF;</i> Processing Report</h3>
                    <ul class="md-list">
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{route('recrutereport_customer_report')}}"><i class="material-icons">&#xE315;</i>Customer Report</a></span>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{route('recrutereport_medical_slip_report')}}"><i class="material-icons">&#xE315;</i>Medical Slip</a></span>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{route('recrutereport_mofa_report')}}"><i class="material-icons">&#xE315;</i>Mofa</a></span>
                            </div>
                        </li>
                        <li hidden>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="#"><i class="material-icons">&#xE315;</i>Okala</a></span>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{ route('recrutereport_fit_card_report') }}"><i class="material-icons">&#xE315;</i>Fit Card</a></span>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{ route('recrutereport_police_clearance_report') }}"><i class="material-icons">&#xE315;</i>Police Clearance</a></span>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{ route('recrutereport_medical_slip_form_report') }}"><i class="material-icons">&#xE315;</i>Medical Slip Form</a></span>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="uk-width-large-1-3 uk-width-medium-1-2">
                    <h3 class="heading_a"><i class="material-icons">&#xE0AF;</i> Processing Report</h3>
                    <ul class="md-list">
                        
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{ route('recrutereport_finger_report') }}"><i class="material-icons">&#xE315;</i>Finger</a></span>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{ route('recrutereport_training_report') }}"><i class="material-icons">&#xE315;</i>Training</a></span>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{ route('recrutereport_manpower_report') }}"><i class="material-icons">&#xE315;</i>Manpower</a></span>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{ route('recrutereport_completion_report') }}"><i class="material-icons">&#xE315;</i>Completion</a></span>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{ route('recrutereport_submission_report') }}"><i class="material-icons">&#xE315;</i>Submission</a></span>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{ route('recrutereport_confirmation_report') }}"><i class="material-icons">&#xE315;</i>Confirmation</a></span>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{ route('recrutereport_visa_report') }}"><i class="material-icons">&#xE315;</i>Visa</a></span>
                            </div>
                        </li>
                        
                    </ul>
                </div>
                {{--<div class="uk-width-large-1-3 uk-width-medium-1-2">
                    <h3 class="heading_a"><i class="material-icons">&#xE8D3;</i> Accountant</h3>

                    <ul class="md-list">
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{route('report_account_transactions')}}"><i class="material-icons">&#xE315;</i>Account Transactions</a></span>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{route('report_account_general_ledger_search')}}"><i class="material-icons">&#xE315;</i>General Ledger</a></span>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{route('report_account_journal_search')}}"><i class="material-icons">&#xE315;</i>Journal Report</a></span>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{route('report_account_trial_balance_search')}}"><i class="material-icons">&#xE315;</i>Trial Balance</a></span>
                            </div>
                        </li>
                    </ul>
                </div>--}}
                {{--<div class="uk-width-large-1-3 uk-width-medium-1-2">
                    <h3 class="heading_a"><i class="material-icons">&#xE8CC;</i> Sales</h3>

                    <ul class="md-list">
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{route('report_account_customer')}}"><i class="material-icons">&#xE315;</i>Sales by Customer</a></span>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="report_sales_by_item.html"><i class="material-icons">&#xE315;</i>Sales by Item</a></span>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{route('report_account_product')}}"><i class="material-icons">&#xE315;</i>Product Report</a></span>
                            </div>
                        </li>
                    </ul>
                </div>--}}
            </div>
            <hr>
            <div class="uk-grid uk-grid-divider" data-uk-grid-margin>
                <div class="uk-width-large-1-3 uk-width-medium-1-2">

                    <h3 class="heading_a"><i class="material-icons">&#xE0AF;</i> Iqama</h3>
                    <ul class="md-list">

                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{ route('recrutereport_iqama_approval_report') }}"><i class="material-icons">&#xE315;</i>Approval</a></span>
                            </div>
                        </li>

                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{ route('recrutereport_iqama_insurance_report') }}"><i class="material-icons">&#xE315;</i>Insurance</a></span>
                            </div>
                        </li>

                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{ route('recrutereport_iqama_submission_report') }}"><i class="material-icons">&#xE315;</i>Submission</a></span>
                            </div>
                        </li>

                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{ route('recrutereport_iqama_receive_report') }}"><i class="material-icons">&#xE315;</i>Receive</a></span>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="uk-width-large-1-3 uk-width-medium-1-2">

                    <h3 class="heading_a"><i class="material-icons">&#xE0AF;</i> Iqama Delivery</h3>
                    <ul class="md-list">
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{ route('recrutereport_iqama_clearance_report') }}"><i class="material-icons">&#xE315;</i>Clearance</a></span>
                            </div>
                        </li>

                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{ route('recrutereport_iqama_recipient_report') }}"><i class="material-icons">&#xE315;</i>Recipient</a></span>
                            </div>
                        </li>

                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{ route('recrutereport_iqama_acknowledgement_report') }}"><i class="material-icons">&#xE315;</i>Acknowledgement</a></span>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="uk-width-large-1-3 uk-width-medium-1-2">

                    <h3 class="heading_a"><i class="material-icons">&#xE0AF;</i> Kafala</h3>
                    <ul class="md-list">
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{ route('recrutereport_iqama_before_report') }}"><i class="material-icons">&#xE315;</i>Before 60 Days</a></span>
                            </div>
                        </li>

                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{ route('recrutereport_iqama_after_report') }}"><i class="material-icons">&#xE315;</i>After 60 Days</a></span>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        

        @endsection
        @section('scripts')
            <script type="text/javascript">
                $('#sidebar_recruit').addClass('current_section');
                $('#sidebar_customer_report').addClass('act_item');
            </script>
@endsection