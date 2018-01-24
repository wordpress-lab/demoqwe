@extends('layouts.invoice')

@section('title', 'Contact Report '.date("Y-m-d h-i-sa"))

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
            .uk-table{
                border: 1px solid black;
            }
            .uk-table tr td{
                white-space: nowrap;
                padding: 1px 0px;
                border: 1px solid black;
                width: 100%;
                font-size: 11px !important;
            }
            .uk-table tr td:first-child,.uk-table tr th:first-child{
                text-align: center !important;
            }
            .uk-table tr th ,.uk-table:last-child tr td{

                white-space: nowrap;
                padding: 1px 5px;
                border: 1px solid black;

                width: 100%;
                font-size: 11px !important;
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

                        <div  class="md-card-toolbar hidden-print">


                            <div style="width: 100%" class="md-card-toolbar-actions hidden-print">

                                <div  style="float: right; " data-uk-button-radio="{target:'.md-btn'}">

                                    <select id="contact_category_dropbox" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select with Contact category">
                                        <option value="">Select...</option>
                                        <option value="all">All</option>
                                         @foreach($category as $item)
                                            <option value="{{ $item['id'] }}">{{ $item['contact_category_name'] }}</option>
                                         @endforeach
                                    </select>

                                </div>
                                <div style="float: right">
                                <input id="search_customer" type="text" class="md-input" placeholder="search customer " style="position: relative; top:-10px; width: 300px;">
                                </div>
                                <i class="md-icon material-icons" id="invoice_print"></i>



                                <!--end  -->
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="true"> <a href="#" data-uk-modal="{target:'#coustom_setting_modal'}"><i class="material-icons">&#xE8B8;</i><span>Custom Setting</span></a>

                                </div>
                                <!--coustorm setting modal start -->
                                <div class="uk-modal" id="coustom_setting_modal">
                                    <div class="uk-modal-dialog">
                                        {!! Form::open(['url' => route('report_account_contact_list_search'), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}


                                        <div class="uk-modal-header">
                                            <h3 class="uk-modal-title">Select Date Range and Transaction Type <i class="material-icons" data-uk-tooltip="{pos:'top'}" title="headline tooltip">&#xE8FD;</i></h3>
                                        </div>

                                        <div class="uk-width-large-2-2 uk-width-2-2">
                                            @if(Auth::user()->branch_id==1)
                                                <div class="uk-width-large-2-2 uk-width-2-2">
                                                    <div class="uk-input-group">
                                                        <label for="branch_id" style="margin-left: 10px;">Branch </label>
                                                        <select data-uk-tooltip="{pos:'top'}" style="width:400px;padding: 5px; border-top:none; border-left:none; border-right:none; border-bottom:1px solid lightgray"  id="branch_id" name="branch_id">
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

                            <div class="uk-grid" >

                                <div class="uk-width-small-5-5 uk-text-center">
                                    <img style="margin-bottom: -20px;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/>
                                    <p style="line-height: 6px; margin-top: 35px;" class="uk-text-large">{{ $OrganizationProfile->company_name }}</p>
                                    <p style="line-height: 6px;" class="heading_b">Contact Report</p>
                                    <p style=" line-height: 6px;" class="">{{ $current_branch['branch_name'] }}</p>
                                    @if(isset($start) && isset($end))
                                    <p style="line-height: 6px;" > {{ $start. " to ". $end }} </p>
                                    @endif

                                </div>
                            </div>
                            <div class="uk-grid">
                                <div class="uk-width-1-1">
                                    <table id="contact_filter_table" class="uk-table">
                                        <thead>
                                        <tr class="uk-text-upper">
                                            <th class="uk-text-center">Contact Name</th>
                                            <th class="uk-text-center">Opening Balance </th>
                                            <th class="uk-text-center"> Debit  </th>
                                            <th class="uk-text-center">Credit</th>
                                            <th class="uk-text-center">Balance</th>

                                        </tr>
                                        </thead>
                                        <tbody id="sortbyalpa">
                                        @inject('contactlist', 'App\Modules\Report\Http\Response\ContactReport')
                                        @php
                                            $total_purchase = 0;
                                        @endphp
                                        @foreach($list as $contact)
                                        @if($contact['contact'])
                                            @php
                                               $openning_all = $contactlist->openningBalance($contact->contact['id'],$start);
                                               $openning_balance = $contactlist->sumDrCR($openning_all);
                                               $transactionBalance_all = $contactlist->transactionBalance($contact->contact['id'],$start,$end);
                                               $transactionBalance= $contactlist->sumDrCR($transactionBalance_all);
                                               $balance= $openning_balance['dr'] - $openning_balance['cr'];
                                            @endphp
                                        <tr class="uk-table-middle">
                                            <td style="display: none;"> {{ $contact->contact['contact_category_id'] }}</td>
                                            <td class="uk-text-center"><a target="_blank" href=" {{ route("report_account_single_contact_details",['id'=>$contact->contact['id'],"branch"=>$current_branch["id"],"start"=>$start,"end"=>$end]) }}" >{{ $contact->contact['display_name'] }}</a></td>
                                            <td class="uk-text-center"> {{ $balance }}</td>
                                            <td class="uk-text-center"> {{ $transactionBalance['dr'] }} </td>
                                            <td class="uk-text-center"> {{ $transactionBalance['cr'] }} </td>
                                            <td class="uk-text-center"> {{ ($balance+$transactionBalance['dr']) - $transactionBalance['cr'] }} </td>

                                        </tr>
                                        @endif
                                        @endforeach
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

              sortTable(1);
          };

       $("#search_customer").on("input",function () {
           var cat_id = $(this).val().toUpperCase();
           // Declare variables
           var  filter, table, tr, td, i;

           filter = cat_id
           table = document.getElementById("contact_filter_table");
           tr = table.getElementsByTagName("tr");
           if(filter=='all')
           {
               for (i = 0; i < tr.length; i++) {
                   td = tr[i].getElementsByTagName("td")[1];
                   if (td) {

                       tr[i].style.display = "";

                   }
               }
               return false;
           }
           // Loop through all table rows, and hide those who don't match the search query
           for (i = 0; i < tr.length; i++) {
               td = tr[i].getElementsByTagName("td")[1];
               if (td) {
                   if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                       tr[i].style.display = "";
                   } else {
                       tr[i].style.display = "none";
                   }
               }
           }
       })

        $("#contact_category_dropbox").on('change',function () {
           var cat_id = $(this).val();
            // Declare variables
            var  filter, table, tr, td, i;

            filter = cat_id
            table = document.getElementById("contact_filter_table");
            tr = table.getElementsByTagName("tr");
           if(filter=='all')
           {
               for (i = 0; i < tr.length; i++) {
                   td = tr[i].getElementsByTagName("td")[0];
                   if (td) {

                           tr[i].style.display = "";

                   }
               }
             return false;
           }
            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }

        });

          function sortTable(n) {
              var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
              table = document.getElementById("sortbyalpa");
              switching = true;
              //Set the sorting direction to ascending:
              dir = "asc";
              /*Make a loop that will continue until
               no switching has been done:*/
              while (switching) {
                  //start by saying: no switching is done:
                  switching = false;
                  rows = table.getElementsByTagName("TR");
                  /*Loop through all table rows (except the
                   first, which contains table headers):*/
                  for (i = 1; i < (rows.length - 1); i++) {
                      //start by saying there should be no switching:
                      shouldSwitch = false;
                      /*Get the two elements you want to compare,
                       one from current row and one from the next:*/
                      x = rows[i].getElementsByTagName("TD")[n];
                      y = rows[i + 1].getElementsByTagName("TD")[n];
                      /*check if the two rows should switch place,
                       based on the direction, asc or desc:*/
                      if (dir == "asc") {
                          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                              //if so, mark as a switch and break the loop:
                              shouldSwitch= true;
                              break;
                          }
                      } else if (dir == "desc") {
                          if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                              //if so, mark as a switch and break the loop:
                              shouldSwitch= true;
                              break;
                          }
                      }
                  }
                  if (shouldSwitch) {
                      /*If a switch has been marked, make the switch
                       and mark that a switch has been done:*/
                      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                      switching = true;
                      //Each time a switch is done, increase this count by 1:
                      switchcount ++;
                  } else {
                      /*If no switching has been done AND the direction is "asc",
                       set the direction to "desc" and run the while loop again.*/
                      if (switchcount == 0 && dir == "asc") {
                          dir = "desc";
                          switching = true;
                      }
                  }
              }
          }
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_reports').addClass('act_item');
    </script>
@endsection
