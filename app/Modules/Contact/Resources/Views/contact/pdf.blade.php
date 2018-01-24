@extends('layouts.admin')

@section('title', 'All Customer Report')

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

            #list_table_left tr th:nth-child(10) {
                display: none;
            }
            #list_table_right tr th:nth-child(10) {
                display: none;
            }
            #list_table_left tr td:nth-child(10) {
                display: none;
            }
            #list_table_right tr td:nth-child(10) {
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
                        </div>

                        <h3 class="md-card-toolbar-heading-text large" id="invoice_name"></h3>
                    </div>
                    <div class="md-card-content invoice_content print_bg" style="height: 100%;">
                        
                        <div class="uk-grid" data-uk-grid-margin="">
                            
                            <div class="uk-width-small-5-5 uk-text-center">
                                <img style="margin-bottom: -20px;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/>
                                <p style="line-height: 5px; margin-top: 35px;" class="uk-text-large">{{ $OrganizationProfile->company_name }}</p>
                                <p style="line-height: 5px;" class="heading_b uk-text-success">Customer List</p>
                            </div>
                        </div>
                        <div class="uk-grid" >
                                
                            <div id="list_table_left_parent" class="uk-width-1-1" style="font-size: 12px;">
                                
                                <table id="list_table_left">
                                    <thead>
                                    <tr class="uk-text-upper">
                                        <th style="font-size: 10px">Serial</th>
                                        <th style="font-size: 10px">Name</th>
                                        <th style="font-size: 10px">Display Name</th>
                                        <th style="font-size: 10px">Company Name</th>
                                        <th style="font-size: 10px">Email</th>
                                        <th style="font-size: 10px">Phone Number</th>
                                        <th style="font-size: 10px">Category</th>
                                        <th style="font-size: 10px">Billing Address</th>
                                        <th style="font-size: 10px">Shipping Address</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody  >
                                    <?php $i=1; ?>
                                    @foreach($contacts as $contact)
                                        <tr>
                                            <td>{!! $i++ !!}</td>
                                            <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                                            <td>{{ $contact->display_name }}</td>
                                            <td>{{ $contact->company_name }}</td>
                                            <td>{{ $contact->email_address }}</td>
                                            <td>{{ $contact->phone_number_1 }}</td>
                                            <td>{{ $contact->contactCategory['contact_category_name'] }}</td>
                                            <td>
                                                {{ $contact->billing_street?$contact->billing_street.', ':'' }}
                                                {{ $contact->billing_city?$contact->billing_city.', ':'' }}
                                                {{ $contact->billing_state?$contact->billing_state.', ':'' }}
                                                {{ $contact->billing_zip_code?$contact->billing_zip_code.', ':'' }}
                                                {{ $contact->billing_country?$contact->billing_country:'' }}
                                            </td>
                                            <td>
                                                {{ $contact->shipping_street?$contact->shipping_street.', ':'' }}
                                                {{ $contact->shipping_city?$contact->shipping_city.', ':'' }}
                                                {{ $contact->shipping_state?$contact->shipping_state.', ':'' }}
                                                {{ $contact->shipping_zip_code?$contact->shipping_zip_code.', ':'' }}
                                                {{ $contact->shipping_country?$contact->shipping_country:'' }}
                                            </td>
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

    $( window ).load(function() {
      print();
    });

    $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_contact').addClass('act_item');
</script>
@endsection
