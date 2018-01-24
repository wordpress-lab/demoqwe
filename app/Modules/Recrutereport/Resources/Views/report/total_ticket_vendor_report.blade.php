@extends('layouts.admin')

@section('title', 'Ticket Report')

@section('header')
    @include('inc.header')
@endsection

@section('styles')
    <style>
        #list_table_right tr td:nth-child(1){

            white-space:nowrap;
        }
        #list_table_left , #list_table_right{
           width: 100%;
           padding: 10px;

        }
        #list_table_left tr td, #list_table_right tr td{
              text-align: center;
          }
        #list_table_left tr th, #list_table_right tr th{
           border-bottom: 1px solid black;
           border-top: 1px solid black;
           font-size: 10px;
        }
        #list_table_left tr td:nth-child(1),#list_table_left tr td:last-child,#list_table_left tr th:last-child,#list_table_right tr td:last-child{

            white-space:nowrap;
        }
        @media print {

            a[href]:after {
                content:"" !important;
            }
            a{
                text-decoration: none;
            }

            #list_table_left , #list_table_right{
              border:none;
             font-size: 11px !important;

            }
            #list_table_right{
                margin-left: 10px;
            }
            body{
                margin-top: -40px;
            }
            #total, #table_close,#table_open,#list_table_left,#list_table_right{
                font-size: 11px !important;
            }
            .md-card-toolbar{
                display: none;
            }

            #list_table_left tr th:nth-child(9) {
                display: none;
            }
            #list_table_right tr th:nth-child(9) {
                display: none;
            }
            #list_table_left tr td:nth-child(9) {
                display: none;
            }
            #list_table_right tr td:nth-child(9) {
                display: none;
            }

        }
    </style>
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
<div class="uk-width-medium-10-10 uk-container-center reset-print" >
    <div class="uk-grid uk-grid-collapse" >
        <div class="uk-width-large-10-10" >
            <div class="md-card md-card-single main-print">
                <div id="invoice_preview hidden-print">
                    <div class="md-card-toolbar hidden-print">
                        <div class="md-card-toolbar-actions hidden-print">
                            <i class="md-icon material-icons" id="invoice_print"></i>


                           
                            <!--end  -->
                            
                            <!--coustorm setting modal start -->
                            
                            <!--end  -->
                        </div>

                        <h3 class="md-card-toolbar-heading-text large" id="invoice_name"></h3>
                    </div>
                    <div class="md-card-content invoice_content print_bg" style="height: 100%;">
                        
                        <div class="uk-grid" data-uk-grid-margin="">
                            
                            <div class="uk-width-small-5-5 uk-text-center">
                                <img style="margin-bottom: -20px;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/>
                                <p style="line-height: 5px; margin-top: 35px;" class="uk-text-large">{{ $OrganizationProfile->company_name }}</p>
                                <p style="line-height: 5px;" class="heading_b uk-text-success">Vendor Report</p>
                                @if(isset ($branch_find))
                                <p style="line-height: 5px;" class="uk-text-small">Branch Name: {{ $branch_find->branch_name }}</p>
                                @endif
                                <p style="line-height: 5px;" class="uk-text-small">From {{date('d-m-Y', strtotime($start))}}  To {{date('d-m-Y', strtotime($end))}}</p>
                                
                            </div>
                        </div>
                        <div class="uk-grid" >
                                
                            <div id="list_table_left_parent" class="uk-width-1-1" style="font-size: 12px;">
                                
                                <table id="list_table_left">
                                    <thead>
                                    <tr class="uk-text-upper">
                                        <th style="font-size: 10px">Serial</th>
                                        <th style="font-size: 10px">Date of Flight</th>
                                        <th style="font-size: 10px">Ticket Number</th>
                                        <th style="font-size: 10px">Pax Id</th>
                                        <th style="font-size: 10px">Passenger Name</th>
                                        <th style="font-size: 10px">Total Amount</th>
                                        <th style="font-size: 10px">Total Paid</th>
                                        <th style="font-size: 10px">Total Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody  >
                                    <?php $i=1; ?>
                                    @foreach($confirm as $value)
                                        <tr>

                                            <td>{!! $i++ !!}</td>
                                            <td>{{ date('d-m-Y', strtotime($value->date_of_flight)) }}</td>
                                            <td>{{ $value->e_ticket_number }}</td>
                                            <td>{{ $value->paxId?$value->paxId['paxid']:'' }}</td>
                                            <td>{{ $value->paxId?$value->paxId['passenger_name']:'' }}</td>
                                            <td>{{ ($value->paxId && $value->paxId->invoice)?$value->paxId->invoice['total_amount']:'' }}</td>
                                            <td>{{ ((($value->paxId && $value->paxId->invoice)?$value->paxId->invoice['total_amount']:'')-(($value->paxId && $value->paxId->invoice)?$value->paxId->invoice['due_amount']:'')) }}</td>
                                            <td>{{ ($value->paxId && $value->paxId->invoice)?$value->paxId->invoice['due_amount']:'' }}</td>
                                        </tr>

                                    @endforeach
                                   
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="uk-grid">

                                <span class="uk-text-muted uk-text-small uk-text-italic">Notes:</span>
                                <p class="uk-text-small"></p>

                        </div>


                        <div class="uk-grid">
                            <div class="uk-width-1-2" style="text-align: left">
                                <p class="uk-text-small uk-margin-bottom">Accounts Signature</p>
                            </div>
                            <div class="uk-width-1-2" style="text-align: right">
                                <p class="uk-text-small uk-margin-bottom">Authorized Signature</p>
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
<script src="{{ url('admin/bower_components/handlebars/handlebars.min.js')}}"></script>
<script src="{{ url('admin/assets/js/custom/handlebars_helpers.min.js')}}"></script>

<!--  invoices functions -->
<script src="{{ url('admin/assets/js/pages/page_invoices.min.js')}}"></script>
<script type="text/javascript">

    $("#invoice_print").click(function(){
       $("#list_table_right").removeClass('uk_table');
       $("#list_table_left").removeClass('uk_table');
    });

    $('#sidebar_recruit').addClass('current_section');
    $('#sidebar_customer_report').addClass('act_item');
</script>
@endsection
