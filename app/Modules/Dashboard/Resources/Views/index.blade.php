@extends('layouts.main')

@section('title', 'Dashboard')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
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
    <div class="uk-grid" data-uk-grid-margin>
        <div style=" width: 23%">
            <div class="uk-grid uk-grid-width-large-1-1 uk-grid-width-medium-1-1 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-grid-margin="" data-uk-sortable="">
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
            </div>

            <div class="uk-grid uk-grid-width-large-1-1 uk-grid-width-medium-1-1 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-grid-margin="" data-uk-sortable="">
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
        </div>
        <div style="width: 70%">
            <div class="md-card">
                    <div class="md-card">
                            <div class="uk-accordion" id="accor" data-uk-accordion>
                                <h3 class="uk-accordion-title uk-accordion-title-primary">Overdue Receivables</h3>
                                <div class="uk-accordion-content">
                                    <div class="uk-overflow-container">
                                        <table class="uk-table" id="data_table_1">
                                            <thead>
                                            <tr>
                                                <th class="uk-text-nowrap">Invoice</th>
                                                <th class="uk-text-nowrap">Amount</th>
                                                <th class="uk-text-nowrap">Date</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <h3 class="uk-accordion-title uk-accordion-title-success">Overdue Payables</h3>
                                <div class="uk-accordion-content">

                                    <div class="uk-overflow-container">
                                        <table class="uk-table" id="data_table_2">
                                            <thead>
                                            <tr>
                                                <th class="uk-text-nowrap">Bill</th>
                                                <th class="uk-text-nowrap">Amount</th>
                                                <th class="uk-text-nowrap">Date</th>
                                                <th style="display: none;" class="uk-text-nowrap"></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <h3 class="uk-accordion-title uk-accordion-title-warning">Stock in Today</h3>
                                <div class="uk-accordion-content">
                                    <div class="uk-overflow-container">
                                        <table class="uk-table" id="data_table_3">
                                            <thead>
                                            <tr>
                                                <th class="uk-text-nowrap">Product</th>
                                                <th class="uk-text-nowrap">Count</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($today_stock as $value )
                                                <tr class="uk-table-middle">
                                                    <td class="uk-width-3-10 uk-text-nowrap"><a href="#">{{ $value->item->item_name }}</a></td>
                                                    <td class="uk-width-2-10 uk-text-nowrap"><span class="uk-badge">{{ $value->sum }}</span></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <h3 class="uk-accordion-title uk-accordion-title-danger">Stock out Today</h3>
                                <div class="uk-accordion-content">

                                    <div class="uk-overflow-container">
                                        <table class="uk-table" id="data_table_4">
                                            <thead>
                                            <tr>
                                                <th class="uk-text-nowrap">Product</th>
                                                <th class="uk-text-nowrap">Count</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($today_out_stock as $value )
                                                <tr class="uk-table-middle">
                                                    <td class="uk-width-3-10 uk-text-nowrap"><a href="#">{{ $value->item->item_name }}</a></td>
                                                    <td class="uk-width-2-10 uk-text-nowrap"><span class="uk-badge">{{ $value->sum }}</span></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <h3 class="uk-accordion-title uk-accordion-title-danger md-bg-deep-purple-A400" >Reorder</h3>
                                <div class="uk-accordion-content">
                                    <div class="uk-overflow-container">
                                        <table class="uk-table" id="data_table_5">
                                            <thead>
                                            <tr>
                                                <th class="uk-text-nowrap">Product</th>
                                                <th class="uk-text-nowrap">Count</th>
                                                <th style="display: none;" class="uk-text-nowrap"></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

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
    <script src="{!! asset('admin/assets/js/custom/datatables/dataTables.scroller.min.js') !!}"></script>
    <script type="text/javascript">
        var overdue = "{{ route("dashboard_overDueReceivable_api") }}";
        var invoice_route = "{{ route('dashboard_overDueReceivable_invoice_show_api',["id"=>'']) }}";
        var reorder = "{{ route("dashboard_reorder_list_api") }}";
        var inventory_route = "{{ route('inventory_show',["id"=>'']) }}";
        var overdue_pay = "{{ route("dashboard_overduePayable_list_api") }}";
        var overdue_pay_bill = "{{ route('bill_show',["id"=>'']) }}";


          window.onload = function () {
              $.get(overdue,function (datalist) {
                  var data = [];
                    $.each(datalist, function(k, v) {
                      data.push([v.id, v.due_amount, v.payment_date ] );
                  });


                  $('#data_table_1').DataTable({
                      "pageLength": 50,
                      data:           data,
                      deferRender:    false,
                      scrollY:        200,
                      scrollCollapse: true,
                      scroller:       true,
                      "columnDefs": [
                          {
                              "targets": 0,
                              "render": function ( link, type, row ) {
                                      return "<a target='_blank' href="+invoice_route+"/"+link+">"+"INV-"+padLeft(link,6)+"</a>";
                                  return link;
                              }
                          }
                      ]
                  });
              });
              // overdue payable
              $.get(overdue_pay,function (overduelist) {
                  var overduedata = [];
                  $.each(overduelist, function(k, v) {

                      overduedata.push([v.id, v.due_amount, v.due_date,v.bill_number ] );
                  });
                  $('#data_table_2').DataTable({
                      "pageLength": 50,
                      data:           overduedata,
                      deferRender:    false,
                      scrollY:        200,
                      scrollCollapse: true,
                      scroller:       true,
                      "columnDefs": [
                          {
                              "targets": [ 3 ],
                              "visible": false
                          },
                          {
                              "targets": 0,

                              "render": function ( link, type, row ) {

                                  return "<a target='_blank' href="+overdue_pay_bill+"/"+link+">"+"BILL-"+padLeft(link,6)+"</a>";
                                  return link;
                              }
                          }
                      ]
                  });
              });
              //reorder

              $.get(reorder,function (reorderlist) {
                  var reorderdata = [];
                    $.each(reorderlist, function(k, v) {

                      reorderdata.push([v[1], v[0],k ] );
                  });
                  $('#data_table_5').DataTable({
                      "pageLength": 30,
                      data:reorderdata,

                      "columnDefs": [
                          {
                              "targets": [ 2 ],
                              "visible": false
                          },
                          {
                              "targets": 0,
                              "render": function ( link, type, row ) {

                                return "<a target='_blank' href="+inventory_route+"/"+row[2]+">"+row[0]+"</a>";

                              }
                          }
                      ]
                  });
              });


          }
        var accordion = UIkit.accordion(document.getElementById('accor'), {
            showfirst:false

        });


        $('#data_table_3').DataTable({
            "pageLength": 50
        });
        $('#data_table_4').DataTable({
            "pageLength": 50
        });

        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_dashboard').addClass('act_item');
        function padLeft(nr, n, str){
            return Array(n-String(nr).length+1).join(str||'0')+nr;
        }
    </script>
@endsection