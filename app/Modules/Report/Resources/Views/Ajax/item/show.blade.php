@extends('layouts.invoice')

@section('title', 'Contactwise Item Report Details'.date("Y-m-d h-i-sa"))

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
        .uk-table tr td{

            padding: 1px 0px;
            border: none !important;
            text-align:center;
            font-size: 11px !important;

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
                  text-align:center;
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

                                <div  style="float: left; " >
                                    <i id="transaction_sort" style="color:white ; background-color: #7cb342;" class="md-btn md-btn-wave ">Transaction wise</i>
                                    <i id="date_sort" style="color:white; background-color: #7cb342;" class="md-btn md-btn-wave ">Date wise</i>

                                </div>
                                <i class="md-icon material-icons" id="invoice_print"></i>
                                <!--end  -->
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="true"> <a href="#" data-uk-modal="{target:'#coustom_setting_modal'}"><i class="material-icons">&#xE8B8;</i><span>Custom Setting</span></a>

                                </div>
                                <!--coustorm setting modal start -->
                                <div class="uk-modal" id="coustom_setting_modal">
                                    <div class="uk-modal-dialog">
                                        {!! Form::open(['url' => route('report_account_api_Contact_Item_Details_filter',$id), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}
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
                                    <p style="line-height: 5px;" class="heading_b uk-text-success"> Report Details</p>
                                    <p style="line-height: 5px;">{{ $current_branch['branch_name'] }}</p>

                                    <p style="line-height: 5px;"> {{ $start." ". " to " ." $end" }} </p>
                                </div>
                            </div>
                            <div class="uk-grid">
                                <div class="uk-width-1-1">
                                    <i class="spinner"></i>
                                    <table class="uk-table">
                                        <thead>

                                        <tr style="border-bottom: 1px solid white " class="uk-text-middle">
                                            <th class="uk-text-center" style="width: 10%">Date</th>
                                            <th class="uk-text-center" style="width: 15%">Transaction Number</th>
                                            <th class="uk-text-center" style="width: 30%"> Items </th>
                                            <th class="uk-text-center" style="width: 10%">Debit</th>
                                            <th class="uk-text-center" style="width: 10%">Credit</th>
                                            <th class="uk-text-center" style="width: 15%">Balance</th>
                                        </tr>
                                        </thead>
                                        <tbody id="contact_item_details_list">

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

           Array.prototype.groupBy = function(prop) {
               return this.reduce(function(groups, item) {
                   var val = item[prop];
                   groups[val] = groups[val] || [];
                   groups[val].push(item);
                   return groups;
               }, {});
           }
           var table = document.getElementById("contact_item_details_list");
           var datewise = [];
           var transactionwise=[];
           var single_contact_detail = "{{ $contact_route }}";

           window.onload = function () {
             $.get(single_contact_detail,function (data) {

                  transactionwise = data.groupBy('type');
                  datewise = data.groupBy('tr_date');
                  $.each(datewise, function(k, v) {

                     var tr= [];
                     var item ='';
                     var debit = 0;
                     var credit = 0;
                     var transaction_num = '';
                     tr[0]=k;
                     var row = table.insertRow(0);
                     var cell1 = row.insertCell(0);
                     var cell2 = row.insertCell(1);
                     var cell3 = row.insertCell(2);
                     var cell4 = row.insertCell(3);
                     var cell5 = row.insertCell(4);
                     var cell6 = row.insertCell(5);

                     v.forEach(function(element) {

                         if(element.type=="invoice")
                         {
                             transaction_num+="INV-"+element.invoice_number+"<br/>";
                             item += element.item_list+"("+element.inv_qty+")"+"<br/>";
                             debit=debit+parseFloat(element.debit);

                         }
                         if(element.type=="bill")
                         {
                             transaction_num+="BILL-"+element.bill_number+"<br/>";
                             item +=element.item_list+"("+element.bill_qty+")" +"<br/>";
                             credit=credit+parseFloat(element.credit);
                         }
                     });
                     tr[1] = transaction_num;
                     tr[2]=item;
                     tr[3] = debit;
                     tr[4] = credit;
                     tr[5] = debit-credit;
                     cell1.innerHTML = tr[0];
                     cell2.innerHTML = tr[1];
                     cell3.innerHTML = tr[2];
                     cell4.innerHTML = tr[3];
                     cell5.innerHTML = tr[4];
                     cell6.innerHTML = tr[5];
                     tr= [];


                 });
                  $(".spinner").remove();
             })

           };
           $("#transaction_sort").on("click",function () {
               $("#contact_item_details_list tr").remove();
               var balance = 0;
               $.each(transactionwise, function(k, v) {


                   if(k=="invoice"){

                       var row = table.insertRow(-1);
                       var cell1 = row.insertCell(0);
                       cell1.colSpan = 6;
                       cell1.style.textAlign = "left";
                       cell1.innerHTML = "<h5 style='text-transform: uppercase; padding: 5px;'>"+"#"+k+"</h5>";

                       v.forEach(function(element) {
                          balance=balance+parseFloat(element.debit);
                           var row = table.insertRow(-1);
                           var cell1 = row.insertCell(0);
                           var cell2 = row.insertCell(1);
                           var cell3 = row.insertCell(2);
                           var cell4 = row.insertCell(3);
                           var cell5 = row.insertCell(4);
                           var cell6 = row.insertCell(5);

                           cell1.innerHTML = element.tr_date;
                           cell2.innerHTML = "INV-"+element.invoice_number;
                           cell3.innerHTML =element.item_list+"("+element.inv_qty+")";
                           cell4.innerHTML = element.debit;
                           cell5.innerHTML = '';
                           cell6.innerHTML = balance;
                       });
                   }

                   if(k=="bill"){
                       var row = table.insertRow(-1);
                       var cell1 = row.insertCell(0);
                       cell1.colSpan = 6;
                       cell1.style.textAlign = "left";
                       cell1.innerHTML = "<h5 style='text-transform: uppercase;padding: 5px;'>"+"#"+k+"</h5>";
                       v.forEach(function(element) {
                           balance-=parseFloat(element.credit);
                           var row = table.insertRow(-1);
                           var cell1 = row.insertCell(0);
                           var cell2 = row.insertCell(1);
                           var cell3 = row.insertCell(2);
                           var cell4 = row.insertCell(3);
                           var cell5 = row.insertCell(4);
                           var cell6 = row.insertCell(5);

                           cell1.innerHTML = element.tr_date;
                           cell2.innerHTML = "BILL-"+element.bill_number;
                           cell3.innerHTML =element.item_list+"("+element.bill_qty+")";
                           cell4.innerHTML = '';
                           cell5.innerHTML = element.credit;
                           cell6.innerHTML = balance;

                       });
                   }


               });
           });
           $("#date_sort").on("click",function () {
               var balance = 0;

               $("#contact_item_details_list tr").remove();

               $.each(datewise, function(k, v) {

                   var tr= [];
                   var item ='';
                   var debit = 0;
                   var credit = 0;
                   var transaction_num = '';
                   tr[0]=k;
                   var row = table.insertRow(0);
                   var cell1 = row.insertCell(0);
                   var cell2 = row.insertCell(1);
                   var cell3 = row.insertCell(2);
                   var cell4 = row.insertCell(3);
                   var cell5 = row.insertCell(4);
                   var cell6 = row.insertCell(5);

                   v.forEach(function(element) {

                       if(element.type=="invoice")
                       {
                           transaction_num+="INV-"+element.invoice_number+"<br/>";
                           item += element.item_list+"("+element.inv_qty+")"+"<br/>";
                           debit=debit+parseFloat(element.debit);


                       }
                       if(element.type=="bill")
                       {
                           transaction_num+="BILL-"+element.bill_number+"<br/>";
                           item +=element.item_list+"("+element.bill_qty+")" +"<br/>";
                           credit=credit+parseFloat(element.credit);

                       }
                   });


                   tr[1] = transaction_num;
                   tr[2]=item;
                   tr[3] = debit;
                   tr[4] = credit;
                   tr[5] = debit-credit;
                   cell1.innerHTML = tr[0];
                   cell2.innerHTML = tr[1];
                   cell3.innerHTML = tr[2];
                   cell4.innerHTML = tr[3];
                   cell5.innerHTML = tr[4];
                   cell6.innerHTML = tr[5];
                   tr= [];


               });
           });
           $('#sidebar_main_account').addClass('current_section');
           $('#sidebar_reports').addClass('act_item');
       </script>
       @endsection
