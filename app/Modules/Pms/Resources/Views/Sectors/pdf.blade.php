@extends('layouts.invoice')

@section('title', 'Payslip')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style>



        #table_center th,td{
            border-bottom-color: black !important;
        }
        table#info{
            font-size: 12px !important;
            line-height: 2px;
            border: 1px solid black !important;
            min-width: 200px;
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
            body {

              margin-top: -100px;
            }

            #print{
                display: none;
            }
        }
    </style>
@endsection
@section('content')

    <div class="uk-width-medium-10-10 uk-container-center reset-print">
        <div class="uk-grid uk-grid-collapse" data-uk-grid-margin>
            <div class="uk-width-large-2-10 hidden-print uk-visible-large">
                <div class="md-list-outside-wrapper">
                    <ul class="md-list md-list-outside">

                        <li class="heading_list">Recent Payslip</li>

                        

                        <li class="uk-text-center">
                            <a class="md-btn md-btn-primary md-btn-mini md-btn-wave-light waves-effect waves-button waves-light uk-margin-top" href="#">See All</a>
                        </li>

                    </ul>
                </div>
            </div>

            <?php
            $helper = new \App\Lib\Helpers;

            ?>
            @inject('theader', '\App\Lib\TemplateHeader')
            <div class="uk-width-large-8-10">
                <div class="md-card md-card-single main-print">
                    <div id="invoice_preview">

                        <div class="md-card-content invoice_content print_bg" style="margin-top: 0px;">

                           @if($theader->getBanner()->headerType)
                                <div class="" style="text-align: center;">

                                <img src="{{ asset($theader->getBanner()->file_url) }}">
                                </div>
                            @else
                                <div class="uk-grid" data-uk-grid-margin style="text-align: center; margin-top:50px;">
                                    <h1 style="width: 100%; text-align: center;"><img style="text-align: center;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/> {{ $OrganizationProfile->company_name }}</h1>
                                </div>
                                <div class="" style="text-align: center;">

                                    <p>{{ $OrganizationProfile->street }},{{ $OrganizationProfile->city }},{{ $OrganizationProfile->state }},{{ $OrganizationProfile->country }}</p>

                                    <p style="margin-top: -17px;">{{ $OrganizationProfile->email }},{{ $OrganizationProfile->contact_number }}</p>
                                </div>
                           @endif


                            <div class="uk-grid" data-uk-grid-margin>
                                
                                <div class="uk-width-5-5" style="font-size: 12px;">
                                    <div class="uk-grid">
                                        <h2 style="text-align: center; width: 90%;" class="">
                                            
                                              PAYSLIP
                                            
                                        </h2>
                                        <p style="text-align: center; width: 90%;" class="uk-text-small uk-text-muted uk-margin-top-remove"># PS-000001</p>
                                    </div>
                                </div>
                                
                            </div>
                            <input type="hidden" ng-init="invoice_id='asdfg'" value="" name="invoice_id" ng-model="invoice_id">

                            <div class="uk-grid" style="font-size: 12px;">
                                <div class="uk-width-small-1-2 uk-row-first">
                                    <div class="uk-margin-bottom">
                                        <span ><b> Name:</b></span>
                                        <address>
                                            <p><strong></strong></p>
                                            <p>
                                                
                                            </p>

                                            <p><b>Id Site: </b></p>
                                            <p> <b>Passport Number: </b></p>
                                            <p> <b>Iqama Number: </b></p>
                                            <p> <b>Mobile Number: </b></p>
                                        </address>
                                    </div>
                                </div>
                                <div class="uk-width-small-1-2">
                                    <div class="uk-width-small-1-1">
                                        
                                    </div>
                                    <table id="info" class="uk-table inv_top_right_table" style="width: 50px;">
                                      
                                        <tr class="uk-table-middle">
                                            <td class="uk-text-left ">From </td>
                                            <td class="uk-text-center "></td>
                                        </tr>
                                        <tr class="uk-table-middle">
                                            <td class="uk-text-left ">To </td>
                                            <td class="uk-text-center "></td>
                                        </tr>
                                        <tr class="uk-table-middle">
                                            <td class="uk-text-left ">Days Worked </td>
                                            <td class="uk-text-center "></td>
                                        </tr>
                                        <tr class="uk-table-middle">
                                            <td class="uk-text-left ">Overtime </td>
                                            <td class="uk-text-center "></td>
                                        </tr>
                                        <tr class="uk-table-middle">
                                            <td class="uk-text-left ">Absent </td>
                                            <td class="uk-text-center "></td>
                                        </tr>
                                       
                                    </table>
                                </div>
                            </div>
                            <div class="uk-grid uk-margin-large-bottom" style="font-size: 12px;">
                                <div class="uk-width-1-1">
                                    <table id="table_center" border="1" class="uk-table"  >
                                        <thead>
                                        <tr class="uk-text-upper">
                                            <th class="uk-text-center" colspan="2">
                                            Earnings Amount</th>
                                            <th class="uk-text-center" colspan="2">Deduction Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                          <td>January</td>
                                          <td>$100</td>
                                          <td>January</td>
                                          <td>$100</td>
                                        </tr>
                                        <tr>
                                          <td>February</td>
                                          <td>$80</td>
                                          <td>January</td>
                                          <td>$100</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                    
                                    
                                    <div style="height: 35px; width: 40%;  padding: 8px; border: 1px solid black"><b>Total Outstanding :  BDT  </b></div>
                                </div>
                            </div>
                            <div class="uk-grid">
                                <div class="uk-width-1-2">

                                    <span class="uk-text-muted uk-text-small uk-text-italic">Notes:</span>
                                    <p class="uk-text-small uk-margin-bottom"></p>



                                </div>
                            </div>

                            <div class="uk-grid">
                                <div class="uk-width-1-2" style="text-align: left">
                                    <p class="uk-text-small uk-margin-bottom">Employer's Signature</p>
                                </div>
                                <div class="uk-width-1-2" style="text-align: right">
                                    <p  class="uk-text-small uk-margin-bottom">Employee's Signature</p>
                                </div>
                            </div>
                             <div class="uk-grid">
                                <div class="uk-width-1-2">
                                    <p class="uk-text-small uk-margin-bottom">Looking forward for your business.</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>

        </div>

@endsection

