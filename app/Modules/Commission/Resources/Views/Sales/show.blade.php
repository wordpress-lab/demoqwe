@extends('layouts.invoice')

@section('title', 'Sales Commission')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @inject('theader', '\App\Lib\TemplateHeader')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style>
        #table_center th,td{
            border-color: black !important;

        }
        table#info{
            font-size: 12px !important;
            line-height: 2px;
            border: 1px solid black !important;

            float:right;
        }
        table#info tr td{
            border: 1px solid black !important;
        }
        table#info tr{
            padding: 0px;
            border: 1px solid black !important;
        }

        @media print {

            @if($theader->getBanner()->headerType)
                     h1,p,h2 {
                font-size: 13px;
            }
            #company {

                display:block;
                position: relative;
                top:-10px;
            }
            #hrd{
                position: relative;
                top:-20px;
            }

            #table_center th,td{

                font-size: 11px;

            }

            #payemnt_rec{

            }
            #payemnt_code{
                position: relative;
                top:-9px;

            }

            #address_info{
                position: relative;
                top:-60px;

            }
            #recieve{
                position: relative;
                top:-183px;
            }
            #amount{
                font-size: 10px;
            }

            table#info{
                width: 50%;
                position: relative;
                top:-47px;
            }
            #excess_payment{
                position: relative;
                top:-270px;
            }
            #table_center{
                position: relative;
                top:-300px;
            }
            #look{
                position: relative;
                top:0px;
            }
            body{
                margin-top: -50px;
            }

            #table_content,#date{
                position: relative;
                top:-20px;

            }

            #amount{
                position: relative;
                top:-40px;
            }

            #pay{
                position: relative;
                top:-60px;
            }

            #balanace{
                position: relative;
                top:-80px;
            }
            label,h3{
                font-size: 11px !important;
            }

            #through{
                position: relative;
                top:-100px;
            }
            hr{
                display: none;
            }

            @else

 h1,p,h2 {
                font-size: 12px;
            }
            #company {

            position: relative;
            top:-20px;
            }
            #hrd{
             position: relative;
             top:-20px;
            }
            #company_h{
                margin-bottom: -16px;
            }

            #table_center th,td{

                font-size: 11px;

            }

            #payemnt_rec{

            }
            #payemnt_code{
                position: relative;
                top:-9px;

            }

            #address_info{
                position: relative;
                top:-60px;

            }
            #recieve{
                position: relative;
                top:-183px;
            }
            #amount{
                font-size: 10px;
            }

            table#info{
                width: 50%;
                position: relative;
                top:-47px;
            }
            #excess_payment{
                position: relative;
                top:-270px;
            }
            #table_center{
                position: relative;
                top:-300px;
            }
            #look{
                position: relative;
                top:0px;
            }
            body{
                margin-top: -50px;
                font-size: 13px;
            }

            #table_content,#date{
                position: relative;
                top:-20px;

            }

            #amount{
              position: relative;
              top:-40px;
         }

          #pay{
              position: relative;
              top:-60px;
          }

            #balanace{
                position: relative;
                top:-80px;
            }
            label,h3{
                font-size: 11px !important;
            }

            #through{
                position: relative;
                top:-100px;
            }




        @endif

      }

        #tiktok_table tr td{
            padding: 5px !important;
            font-size: 14px;
        }
        #tiktok_table tr td:nth-child(even){
            text-align: right;
        }
    </style>
@endsection

@section('content')
    <div class="uk-width-medium-10-10 uk-container-center reset-print">
        <div class="uk-grid uk-grid-collapse" data-uk-grid-margin>
            <div class="uk-width-large-2-10 hidden-print uk-visible-large">
                <div class="md-list-outside-wrapper">
                    <ul class="md-list md-list-outside">

                        <li class="heading_list">Recent Sales Commission</li>

                        @foreach($recent as $value)
                            <li>
                                <a href="{{ route('sales_commission_show', ['id' => $value->id]) }}" class="md-list-content">
                                    <span class="md-list-heading uk-text-truncate">{{ $value->Agents->display_name }}</span>
                                    <span class="uk-text-small uk-text-muted">{{ $value->date }}</span>
                                    <span class="uk-text-small uk-text-muted">{{ str_pad($value->scNumber,6,0,STR_PAD_LEFT) }}</span>
                                </a>
                            </li>
                        @endforeach

                        <li class="uk-text-center">
                            <a class="md-btn md-btn-primary md-btn-mini md-btn-wave-light waves-effect waves-button waves-light uk-margin-top" href="{{ route('sales_commission') }}">See All</a>
                        </li>

                    </ul>
                </div>
            </div>

            <?php
            $helper = new \App\Lib\Helpers;
            ?>

            <div class="uk-width-large-8-10">
                <div class="md-card md-card-single main-print">
                    <div id="invoice_preview">
                        <div class="md-card-toolbar hidden-print">
                            <div class="md-card-toolbar-actions hidden-print">
                                <i class="md-icon material-icons" id="invoice_print"></i>
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="false">
                                    <i class="md-icon material-icons"></i>
                                    <div class="uk-dropdown" aria-hidden="true">
                                        <ul class="uk-nav">
                                            <li>
                                                <a href="{{ route('sales_commission_edit', ['id' => $salescommission->id]) }}">Edit</a>
                                            </li>
                                            <li>
                                                <a class="uk-text-danger" href="{{ route('sales_commission_delete', ['id' => $salescommission->id]) }}">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <h3 class="md-card-toolbar-heading-text large" id="invoice_name">Sales Commission</h3>
                        </div>
                        <div class="md-card-content invoice_content print_bg" style="height: 301px;">

                            @inject('theader', '\App\Lib\TemplateHeader')
                            @if($theader->getBanner()->headerType)
                                <div class="" style="text-align: center; margin-bottom: 10px;">

                                    <img src="{{ asset($theader->getBanner()->file_url) }}">
                                </div>
                            @else
                                <div class="uk-grid" data-uk-grid-margin style="text-align: center;">
                                    <h1 style="width: 100%; text-align: center; margin-top: 20px;"><img style="text-align: center;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/> {{ $OrganizationProfile->company_name }}</h1>
                                </div>
                                <div class="" style="text-align: center;">

                                    <p>{{ $OrganizationProfile->street }},{{ $OrganizationProfile->city }},{{ $OrganizationProfile->state }},{{ $OrganizationProfile->country }}</p>

                                    <p style="margin-top: -17px;">{{ $OrganizationProfile->email }},{{ $OrganizationProfile->contact_number }}</p>
                                </div>
                            @endif

                            <hr/>
                            <div class="uk-grid" style="margin-top: -15px;">
                                <div  style="width: 80%; margin: auto;" class="uk-width-medium-1-1">
                                    <table border="1" id="tiktok_table" width="100%">
                                        <caption style="text-align: center;font-size: 16px; color: black">
                                            <span>
                                                Sales Commission<br/>
                                                SC-{{ str_pad($salescommission->scNumber,6,'0',STR_PAD_LEFT) }}
                                            </span>

                                        </caption>
                                        <tr>
                                            <td>Paid To</td>
                                            <td>{{ $salescommission->Agents->display_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Date</td>
                                            <td>{{ $salescommission->date }}</td>
                                        </tr>
                                        <tr>
                                            <td>Amount Paid</td>
                                            <td>BDT {{ $salescommission->amount }}</td>
                                        </tr>
                                        <tr>
                                            <td>Total  Payable</td>
                                            <td>BDT {{ $balance }}</td>
                                        </tr>
                                        <tr>
                                            <td>Total  Balance</td>
                                            <td>BDT {{ $balance-$salescommission->amount }}</td>
                                        </tr>
                                        @if($salescommission->paid_through_id)

                                            @if(is_null($salescommission->show))
                                            <tr>
                                                <td>Paid Through</td>
                                                <td>{{ $salescommission->Account->account_name }}</td>
                                            </tr>
                                            @else
                                           <tr>
                                             <td>Paid Through</td>
                                             <td>{{ $salescommission->Account->account_name }}</td>
                                           </tr>
                                           <tr>
                                               <td>Bank Info</td>
                                               <td>{{ $salescommission->bank_info }}</td>
                                           </tr>
                                            @endif
                                          @else
                                           <tr>
                                               <td> Paid Through</td>
                                               <td>{{ $salescommission->Account->account_name }}</td>
                                           </tr>
                                        @endif

                                        <caption style="margin-top: 30px;" align="bottom">
                                            <span style="float: left" class="uk-text-small uk-margin-bottom">Customer Signature</span>
                                            <span style="float: right" class="uk-text-small uk-margin-bottom">Company Representative</span>
                                        </caption>
                                     </table>
                                 </div>
                             </div>






                            <div class="uk-grid">
                                <div class="uk-width-1-1">
                                    <span class="uk-text-muted uk-text-small uk-text-italic">Notes: &nbsp;&nbsp; {{ $salescommission->CustomerNote }}</span>

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

        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_sales_commission').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        });

    </script>
@endsection
