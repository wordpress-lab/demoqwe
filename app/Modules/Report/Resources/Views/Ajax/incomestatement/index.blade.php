@extends('layouts.admin')

@section('title', 'Income Statement Report '.date("Y-m-d h-i-sa"))

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

        }
        .td_group_color_right {
            background-color: lightgray ;
            color:black;
            text-align: right;
        }
        .td_group_color_left {
            background-color: lightgray ;
            color:black;
            text-align: left;
        }
        .text_right {
            text-align: right !important;
        }
        #visa_income_loss{
            margin: 0 auto;
        }
        #visa_income_loss tr td{
           padding: 5px;
        }
        @media print {
            #visa_income_loss tr th{
                border-top: 1px solid black;
                border-bottom: 1px solid black;
            }
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
                                {!! Form::open(['url' => route("account_report_incomestatement_visa_index_filter"), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}
                                    <div class="uk-modal-header">
                                        <h3 class="uk-modal-title">Select Date Range <i class="material-icons" data-uk-tooltip="{pos:'top'}" title="headline tooltip">&#xE8FD;</i></h3>
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
                                <p style="line-height: 5px;" class="heading_b uk-text-success">Income Statement</p>
                                <p style="line-height: 5px;" class="uk-text-small">From {{$start}}  To {{$end}}</p>
                            </div>
                        </div>
                        <div class="uk-grid uk-margin-large-bottom">
                            <div class="uk-width-1-1">
                                <i class="spinner"></i>
                                <table class="uk-table" id="visa_income_loss">
                                    <thead>
                                    <tr class="uk-text-upper">
                                        <th class="uk-text-left" style="display: none;"></th>
                                        <th class="uk-text-left">ACCOUNT</th>
                                        <th class="uk-text-right">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody id="filter_table_style">


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
    var detailurl = '{{ $detail_url }}';
    var url = '{{ route("api_index_data_account_report_incomestatement_visa_index") }}';
     window.onload =  function () {

         $.get(url,{start:start_date,end:end_date}, function(data, status){
             var reorderdata = [];
             console.log(data);
             reorderdata.push(['group', "Company Visa Income", '']);
             data.visa_income.forEach(function(v) {

             reorderdata.push([v.id+"/"+"visa_income", v.account_name, v.amount]);
             });
             reorderdata.push(['group_sub_total', "Total Company Visa Income", parseFloat(data.gross_profit_1)]);
             reorderdata.push(['group', "Cost of Company Visa", '']);
             data.visa_expense.forEach(function(v) {

                 reorderdata.push([v.id+"/"+"visa_expense", v.account_name, v.amount]);
             });
             reorderdata.push(['group_sub_total', "Total Cost of Company Visa", parseFloat(data.gross_profit_2)]);
             reorderdata.push(['group2', "Gross Profit", parseFloat(data.gross_profit_1)-parseFloat(data.gross_profit_2)]);

             reorderdata.push(['group', "Visa Processing Income", '']);
             data.visa_processing_income.forEach(function(v) {

                 reorderdata.push([v.id+"/"+"visa_processing_income", v.account_name, v.amount]);
             });
             reorderdata.push(['group_sub_total', "Total Visa Processing Income", parseFloat(data.gross_profit_3)]);


             reorderdata.push(['group', "Visa Processing Expense", '']);
             data.visa_processing_expense.forEach(function(v) {

                 reorderdata.push([v.id+"/"+"visa_processing_expense", v.account_name, v.amount]);
             });
             reorderdata.push(['group_sub_total', "Total Visa Processing Expense", parseFloat(data.gross_profit_4)]);
             reorderdata.push(['group2', "Gross Profit", parseFloat(data.gross_profit_3)-parseFloat(data.gross_profit_4)]);


             reorderdata.push(['group', "Direct Income", '']);
             data.direct_income.forEach(function(v) {
                 var direct_income_debit = parseFloat(v.debit);
                 var direct_income_credit = parseFloat(v.credit);
                 if(v.debit==null || v.debit=='')
                 {
                     direct_income_debit = 0;
                 }
                 if(v.credit==null||v.credit==''){
                     direct_income_credit = 0;
                 }
                 reorderdata.push([v.id+"/"+"direct_income", v.account_name, direct_income_credit-direct_income_debit]);
             });
             reorderdata.push(['group_sub_total', "Total Direct Income", parseFloat(data.direct_income_credit)-parseFloat(data.direct_income_debit)]);
             reorderdata.push(['group', "Direct Expense", '']);
             data.direct_expense.forEach(function(v) {
                 var direct_expense_debit = parseFloat(v.debit);
                 var direct_expense_credit = parseFloat(v.credit);
                 if(v.debit==null || v.debit=='')
                 {
                     direct_expense_debit = 0;
                 }
                 if(v.credit==null||v.credit==''){
                     direct_expense_credit = 0;
                 }
                 reorderdata.push([v.id+"/"+"direct_expense", v.account_name,direct_expense_debit-direct_expense_credit]);
             });
             var grossprofit_3 = (parseFloat(data.direct_income_credit)-parseFloat(data.direct_income_debit)) -(parseFloat(data.direct_expense_debit)-parseFloat(data.direct_expense_credit));
             reorderdata.push(['group_sub_total', "Total Direct Expense", parseFloat(data.direct_expense_debit)-parseFloat(data.direct_expense_credit)]);
             reorderdata.push(['group2', "Gross Profit", grossprofit_3]);
             reorderdata.push(['group', "Indirect Income", '']);

             data.indirect_income.forEach(function(v) {
                 var indirect_debit = parseFloat(v.debit);
                 var indirect_credit = parseFloat(v.credit);
                 if(v.debit==null || v.debit=='')
                 {
                     indirect_debit = 0;
                 }
                 if(v.credit==null||v.credit==''){
                     indirect_credit = 0;
                 }

                 reorderdata.push([v.id+"/"+"indirect_income", v.account_name, indirect_credit-indirect_debit]);
             });
             reorderdata.push(['group_sub_total', "Total Indirect Income", parseFloat(data.indirect_income_credit)-parseFloat(data.indirect_income_debit)]);
             reorderdata.push(['group', "Indirect Expense", '']);

             data.indirect_expense_17.forEach(function(v) {
                 var indirect_expense_debit = parseFloat(v.debit);
                 var indirect_expense_credit = parseFloat(v.credit);
                 if(v.debit==null || v.debit=='')
                 {
                     indirect_expense_debit = 0;
                 }
                 if(v.credit==null||v.credit==''){
                     indirect_expense_credit = 0;
                 }
                 reorderdata.push([v.id+"/"+"indirect_expense"+"?account=17", v.account_name, indirect_expense_debit-indirect_expense_credit]);
             });
             data.indirect_expense_19.forEach(function(v) {
                 var indirect_expense_debit = parseFloat(v.debit);
                 var indirect_expense_credit = parseFloat(v.credit);
                 if(v.debit==null || v.debit=='')
                 {
                     indirect_expense_debit = 0;
                 }
                 if(v.credit==null||v.credit==''){
                     indirect_expense_credit = 0;
                 }
                 reorderdata.push([v.id+"/"+"indirect_expense"+"?account=19", v.account_name, indirect_expense_credit-indirect_expense_debit]);
             });
             reorderdata.push(['group_sub_total', "Total Indirect Expense", (parseFloat(data.indirect_expense_debit_17)-parseFloat(data.indirect_expense_credit_17))+(parseFloat(data.indirect_expense_credit_19)-parseFloat(data.indirect_expense_debit_19))]);
            var net_direct_expense = parseFloat(data.direct_expense_debit)-parseFloat(data.direct_expense_credit);
            var net_direct_income = parseFloat(data.direct_income_credit)-parseFloat(data.direct_income_debit);
            var net_indirect_income = parseFloat(data.indirect_income_credit)-parseFloat(data.indirect_income_debit);
            var net_indirect_expense =(parseFloat(data.indirect_expense_debit_17)-parseFloat(data.indirect_expense_credit_17))+(parseFloat(data.indirect_expense_credit_19)-parseFloat(data.indirect_expense_debit_19));
            var net_visa_income = parseFloat(data.gross_profit_1);
            var net_visa_expense = parseFloat(data.gross_profit_2);
            var net_visa_proc_income = parseFloat(data.gross_profit_3);
            var net_visa_proc_expense = parseFloat(data.gross_profit_4);

             var net_income =net_visa_income -net_visa_expense+net_visa_proc_income-net_visa_proc_expense+net_direct_income-net_direct_expense+net_indirect_income-net_indirect_expense;
              console.log(net_indirect_expense);
              console.log(net_indirect_income);
             reorderdata.push(['group2', "Net Profit/Loss",net_income]);

             $('#visa_income_loss').DataTable({
                 "paging": false,
                 "searching": false,
                 "bFilter": false,
                 "bInfo": false,
                 "bPaginate":false,
                 info: false,
                 rowReorder: {
                     enable: false
                 },

                 "ordering": false,
                 data:reorderdata,
                 "columnDefs": [
                     { className:"no_display", "targets": [ 0 ] },
                     { className:"uk-text-right", "targets": [ 2 ] },
                     {
                         "targets": 1,

                         "render": function ( link, type, row ) {

                             if(row[0]=="group"||row[0]=="group2"){

                               return "<b style=''>"+link+"</b>";
                             }
                             if(row[0]=="group_sub_total"){
                                 return "<div style='text-align: left' >"+link+"</div>";
                             }
                             return "<a target='_blank' href="+detailurl+"/"+row[0]+">"+link+"</a>";

                         }
                     }
                 ]
             });
             $(".spinner").remove();


            setTimeout(setColSpan,30);




         }).fail(function() {
             $(".spinner").remove();
             alert("Loading fail.Please contact with your vendor.");

         });
     };
    $('#sidebar_main_account').addClass('current_section');
    $('#sidebar_reports').addClass('act_item');
    $("#invoice_print").on("click",function () {
      $("#visa_income_loss").removeClass("uk-table");
    });
    function setColSpan() {
        var sp_table = document.getElementById("filter_table_style");
        for (var i = 0, row; row = sp_table.rows[i]; i++) {

            if(row.cells[0].innerText=="group"){

                row.cells[1].colSpan=2;
                row.cells[1].className = "td_group_color_left";
                row.cells[2].remove();


            }
            if(row.cells[0].innerText=="group_sub_total"){

                row.cells[2].className = "td_group_color_right";
                row.cells[1].className = "text_right";

            }
            if(row.cells[0].innerText=="group2"){

                row.cells[2].className = "td_group_color_right";
                row.cells[1].className = "text_right";

            }

        }
      }
</script>
@endsection
