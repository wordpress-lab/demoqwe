@extends('layouts.admin')

@section('title', 'Customer Account')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style>
        .css-serial {
            counter-reset: serial-number;  /* Set the serial number counter to 0 */
        }

        .css-serial td:first-child:before {
            counter-increment: serial-number;  /* Increment the serial number counter */
            content: counter(serial-number);  /* Display the counter */
        }
    </style>

    <link rel="stylesheet" href="{{url('admin/bower_components/kendo-ui/styles/kendo.common-material.min.css')}}"/>
    <link rel="stylesheet" href="{{url('admin/bower_components/kendo-ui/styles/kendo.material.min.css')}}" id="kendoCSS"/>
@endsection
@section('content')

    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                @include('inc.customer_nav')

                <div class="uk-width-xLarge-8-10  uk-width-large-8-10">


                    <div  class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-sortable data-uk-grid-margin>
                        <div>
                            <div class="md-card">
                                <div class="md-card-content">

                                    <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_visitors peity_data">5,3,9,6,5,9,7</span></div>
                                    <span class="uk-text-muted uk-text-small">Total Recievable</span>
                                    <h2 class="uk-margin-remove">‎৳ <span class="countUpMe">
                                                @if(isset($totalamount->total_amount))
                                                {{ $totalamount->total_amount }}
                                            @else
                                                000
                                            @endif
                                            </span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="md-card">
                                <div class="md-card-content">
                                    <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span></div>
                                    <span class="uk-text-muted uk-text-small">Total Recieved</span>
                                    <h2 class="uk-margin-remove">‎৳
                                        <span class="countUpMe">
                                                 @php
                                                     $total =000;
                                                 @endphp
                                            @foreach($payment_entry as $value)
                                                @php

                                                    $total+=$value->amount;
                                                @endphp


                                            @endforeach
                                            @if($total==0)
                                                000
                                            @else
                                                {{ $total }}
                                            @endif
                                            </span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="md-card">
                                <div class="md-card-content">
                                    <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_orders peity_data">64/100</span></div>
                                    <span class="uk-text-muted uk-text-small">Total Due</span>
                                    <h2 class="uk-margin-remove">‎৳ <span class="countUpMe">
                                                @php
                                                    if(isset($totalamount->total_amount)){
                                                     $due= $totalamount->total_amount - $total;
                                                    }else{
                                                    $due = "000";
                                                    }

                                                @endphp
                                            {{ $due }}
                                            </span></h2>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="md-card">
                                <div class="md-card-content" onload="totalExpense();">
                                    <div  class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_orders peity_data">64/100</span></div>
                                    <span class="uk-text-muted uk-text-small">Total Expense</span>
                                    <h2 class="uk-margin-remove">‎৳ <span id="expense_num" class="countUpMe">52654</span></h2>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <div class="md-card-toolbar-actions">
                                <i class="md-icon material-icons md-card-fullscreen-activate" >&#xE5D0;</i>
                                <i class="md-icon material-icons md-card-toggle">&#xE316;</i>
                                <i class="md-icon material-icons md-card-close">&#xE14C;</i>
                            </div>
                            <h3 class="md-card-toolbar-heading-text">
                                Income
                            </h3>
                        </div>
                        <div class="md-card-content">
                            <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                <thead>
                                <tr class="md-bg-blue-900">
                                    <th colspan="3" style="text-align: left; color: white">SERVICE CHARGE:</th>
                                    <th colspan="3" style="text-align: right; color: white">LDR. PAGE NO.</th>


                                </tr>
                                <tr>
                                    <th width="15%" class="uk-text-center">DATE</th>
                                    <th width="35%" class="uk-text-center">PARTICULARS</th>
                                    <th width="15%" class="uk-text-center">FOLIO/RCT.NO</th>
                                    <th width="8%" class="uk-text-center">Amount</th>
                                    <th  width="17%" class="uk-text-center">Total Amount</th>
                                    <th  width="10%" class="uk-text-center">Action</th>
                                </tr>
                                </thead>

                             @php
                             if(isset($totalamount->total_amount)){
                              $temptotal =$totalamount->total_amount;
                             }else{
                             $temptotal = 0;
                             }

                             @endphp

                                <tbody>
                                @foreach($payment_entry as $value)
                                    @php
                                        $temptotal =$temptotal - $value->amount;
                                    @endphp
                                <tr>
                                    <td width="15%" class="uk-text-center">{{ date("d-m-Y", strtotime($value->created_at)) }}</td>
                                    <td width="35" class="uk-text-left">{{ $value->paymentReceive->note }}</td>
                                    <td width="15%" class="uk-text-center">PR-{{ decbin($value->id) }}</td>
                                    <td width="8%" class="uk-text-center">{{ $value->amount }}</td>
                                    <td width="17%" class="uk-text-center">{{ $temptotal }}</td>
                                    <td width="10%" class="uk-text-center">
                                        <a href="{{ route('payment_received_show', ['id' => $value->id]) }}"><i data-uk-tooltip="{pos:'top'}" title="View" class="md-icon material-icons">visibility</i></a>
                                    </td>
                                </tr>
                               @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="md-card">
                        <div class="md-card-toolbar md-bg-teal-800">
                            <div class="md-card-toolbar-actions md-color-teal-50" >
                                <i class="md-icon material-icons md-card-fullscreen-activate md-color-teal-50" >&#xE5D0;</i>
                                <i class="md-icon material-icons md-card-toggle md-color-teal-50">&#xE316;</i>
                                <i class="md-icon material-icons md-card-close md-color-teal-50">&#xE14C;</i>
                            </div>
                            <h3 class="md-card-toolbar-heading-text md-color-teal-50">
                                Expense
                            </h3>
                        </div>
                        <div class="md-card-content">
                            <table  class="uk-table css-serial" cellspacing="0" width="100%" id="data_table" >
                                <thead>

                                <tr>
                                    <th width="10%" class="uk-text-center">SERIAL</th>
                                    <th width="15%" class="uk-text-center">DATE</th>
                                    <th width="20%" class="uk-text-center">SECTOR</th>
                                    <th width="20%" class="uk-text-center">VENDOR</th>
                                    <th  width="20%" class="uk-text-center">Amount</th>
                                    <th  width="15%" class="uk-text-center">Action</th>
                                </tr>
                                </thead>


                                <tbody id="expense">
                                @php
                                    $con = new Helpers();
                                   $Customerexpense  = new App\Lib\Customerexpense();
                                @endphp

                                @foreach ($recruitexpensepax as $value)

                                    @if($value->RecruiteExpense->expense_id)
                                   @php
                                       $var1 = $Customerexpense->RecruitExpense($value->recruitExpenseid);
                                       $var2 = $Customerexpense->var2($value->recruitExpenseid, $value->paxid);
                                   @endphp
                                   @if(isset($value->RecruiteExpense->amount->amount))
                                    <tr>
                                        <td width="10%" class="uk-text-center"></td>
                                        <td width="15" class="uk-text-center">{{ date("d-m-Y", strtotime($value->created_at)) }}</td>
                                        <td width="20%" class="uk-text-center"> {{ $value->RecruiteExpense->Sector->title }}</td>
                                        <td width="20%" class="uk-text-center"> {{ $con->getCustomerName($value->RecruiteExpense->amount->vendor_id) }}</td>
                                        <td width="20%" class="uk-text-center"> {{ round($value->RecruiteExpense->amount->amount*$var2/$var1,3) }}</td>
                                        <td width="15%" class="uk-text-center">
                                            <a href="{{ $value->RecruiteExpense->id }}"><i data-uk-tooltip="{pos:'top'}" title="View" class="md-icon material-icons">visibility</i></a>

                                        </td>
                                    </tr>
                                     @endif

                                    @endif
                                 @endforeach

                                </tbody>
                            </table>
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




    <script src="{{ url('admin/assets/js/kendoui_custom.min.js')}}"></script>
    <!--  kendoui functions -->
    <script src="{{ url('admin/assets/js/pages/kendoui.min.js')}}"></script>

      <script>
         function totalExpense()
         {
             var expense_num = document.getElementById("expense_num").innerText;

             var oTable = document.getElementById("expense");

             var rowLength = oTable.rows.length;
             var sum = 0;            //loops through rows
             for (i = 0; i < rowLength; i++){

                 //gets cells of current row
                 var oCells = oTable.rows[i].cells[4].innerText;

                 sum =sum+ parseFloat(oCells);

             }
             document.getElementById("expense_num").innerText = sum;



         }
         window.onload = function(){ totalExpense(); };

         $('#sidebar_recruit').addClass('current_section');
         $('#sidebar_customer').addClass('act_item');
         $('.customer_account').addClass('md-bg-blue-grey-100');
      </script>


@endsection

