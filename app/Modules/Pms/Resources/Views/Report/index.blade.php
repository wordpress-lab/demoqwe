@extends('layouts.admin')

@section('title', 'PMS Report')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section("styles")
    <style>
        #contact_name_search {

        }

        #myUL {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #myUL li a {
            border: 1px solid #ddd;
            margin-top: -1px; /* Prevent double borders */
            background-color: #f6f6f6;
            padding: 12px;
            text-decoration: none;
            font-size: 18px;
            color: black;
            display: block
        }

        #myUL li a:hover:not(.header) {
            background-color: #eee;
        }
       /* */
        #myUL_contact_wise {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #myUL_contact_wise li a {
            border: 1px solid #ddd;
            margin-top: -1px; /* Prevent double borders */
            background-color: #f6f6f6;
            padding: 12px;
            text-decoration: none;
            font-size: 18px;
            color: black;
            display: block
        }

        #myUL_contact_wise li a:hover:not(.header) {
            background-color: #eee;
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
                            <li id="profit"><a href="{{route('report_account_profit_loss')}}">Profit and Loss</a></li>
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
    <div class="md-card">
        <div class="md-card-content">
            <div class="uk-grid uk-grid-divider" data-uk-grid-margin>
                <div class="uk-width-large-1-3 uk-width-medium-1-2">
                   
                    <h3 class="heading_a"><i class="material-icons">&#xE0AF;</i> Business Overview</h3>
                    <ul class="md-list">
                        
                        <li>
                            <div class="md-list-content reports_list">
                                 <span class="md-list-heading"><a href="#"><i class="material-icons">&#xE315;</i>Cash Book</a></span>
                            </div>
                        </li>

                        {{--<li>--}}
                            {{--<div class="md-list-content reports_list">--}}
                                {{--<span class="md-list-heading"><a href="{{route('report_account_cash_flow_statement')}}"><i class="material-icons">&#xE315;</i>Cash Flow Statement</a></span>--}}
                            {{--</div>--}}
                        {{--</li>--}}
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="#"><i class="material-icons">&#xE315;</i>General Ledger</a></span>
                            </div>
                        </li>
                    </ul>

                </div>
                <div class="uk-width-large-1-3 uk-width-medium-1-2">
                   <h3 class="heading_a"><i class="material-icons">&#xE8D3;</i></h3>

                    <ul class="md-list">
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{route('pms_report_employee_wise')}}"><i class="material-icons">&#xE315;</i>Employeewise Report</a></span>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content reports_list">
                                <span class="md-list-heading"><a href="{{route('pms_report_employee_wise')}}"><i class="material-icons">&#xE315;</i>Sitewise Report</a></span>
                            </div>
                        </li>

                    </ul>

                </div>
                <div class="uk-width-large-1-3 uk-width-medium-1-2">

                </div>
                 <div class="uk-width-large-1-3 uk-width-medium-1-2">
                   

                </div>
                <div class="uk-width-large-1-3 uk-width-medium-1-2">
                  
                </div>
                <div class="uk-width-large-1-3 uk-width-medium-1-2">
                    
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
    {{--<script type="text/javascript">--}}
        {{--var list = {};--}}
        {{--var contact_wise_list={};--}}
        {{--$("form").submit(function() {--}}
            {{--$("form").attr('target', '_blank');--}}
            {{--return true;--}}
        {{--});--}}
        {{--$('#sidebar_main_account').addClass('current_section');--}}
        {{--$('#sidebar_reports').addClass('act_item');--}}
        {{--var display_name_url = "{{ route("report_account_contact_list_apiContactName_by_search") }}";--}}
        {{--var display_contact_wise_name_url = "{{ route("report_account_contactwise_api_list_alpha_name_search") }}";--}}

        {{--var list_url = "{{ route("report_account_contact_list_contact_by_search") }}";--}}
       {{--$("body").on("click",function () {--}}
           {{--$("#myUL").empty();--}}
           {{--$("#myUL_contact_wise").empty();--}}
           {{--list={};--}}
           {{--contact_wise_list={};--}}
       {{--});--}}

        {{--$("#contact_name_search").on("input keyup",function () {--}}
          {{--var contact_name=$(this).val().trim();--}}
            {{--$("#myUL").empty();--}}

             {{--if(contact_name.length>2){--}}
                 {{--$.get(display_name_url,{"name":contact_name},function (options) {--}}

                     {{--list = options;--}}
                 {{--});--}}
                 {{--$.each(list, function(index,data) {--}}
                     {{--$("#myUL").append($("<li>", {}).prepend($("<a>", { href: data.url,'target':'_blank' }).text(data.display_name)));--}}
                 {{--});--}}
             {{--}--}}

        {{--});--}}

        {{--$("#contactwise_name_search").on("input keyup",function () {--}}
            {{--var contactwise_name=$(this).val().trim();--}}
            {{--$("#myUL_contact_wise").empty();--}}

            {{--if(contactwise_name.length>2){--}}
                {{--$.get(display_contact_wise_name_url,{"name":contactwise_name},function (options) {--}}

                    {{--contact_wise_list = options;--}}
                {{--});--}}
                {{--$.each(contact_wise_list, function(index,data) {--}}
                    {{--$("#myUL_contact_wise").append($("<li>", {}).prepend($("<a>", { href: data.url,'target':'_blank' }).text(data.display_name)));--}}
                {{--});--}}
            {{--}--}}

        {{--});--}}
    {{--</script>--}}
@endsection