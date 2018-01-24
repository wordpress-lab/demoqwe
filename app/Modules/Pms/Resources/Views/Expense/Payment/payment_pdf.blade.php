@extends('layouts.invoice')

@section('title', 'Payment')

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

            <div class="uk-width-large-8-10">
                <div class="md-card md-card-single main-print">
                    <div id="invoice_preview">

                        <div class="md-card-toolbar" style="border-bottom: 0px solid rgba(0,0,0,.12);">

                            <div class="md-card-toolbar-actions hidden-print">

                                <span  style="display: none;" id="loaded_n_total"></span>
                                <span  id="status"></span>   <progress id="progressBar" value="0" max="100" style="float: left;margin-right: 15px; margin-top: 10px; height: 20px;width:300px; display: none;"></progress>
                                
                               

                                <i class="md-icon material-icons" id="invoice_print"></i>
                                
                            </div>
                        </div>

                        <div class="md-card-content invoice_content print_bg" style="margin-top: 0px;">

                                <div class="uk-grid" data-uk-grid-margin style="text-align: center; margin-top:50px;">
                                    <h1 style="width: 100%; text-align: center;"><img style="text-align: center;" class="logo_regular" src="{{ url('uploads/company-logo/'.$payslip->sheetId->companyId['logo_url']) }}" alt="" height="15" width="71"/> {{ $payslip->sheetId->companyId['name_en'] }}</h1>
                                </div>
                                <div class="" style="text-align: center;">

                                    <p>{{ $payslip->sheetId->companyId['address_en'] }}</p>

                                    <p style="margin-top: -17px;">{{ $payslip->sheetId->companyId['email'] }}</p>
                                </div>



                            <div class="uk-grid" data-uk-grid-margin>
                                
                                <div class="uk-width-5-5" style="font-size: 12px;">
                                    <div class="uk-grid">
                                        <h2 style="text-align: center; width: 90%;" class="">
                                            
                                              PAYSLIP
                                            
                                        </h2>
                                        <p style="text-align: center; width: 90%;" class="uk-text-small uk-text-muted uk-margin-top-remove"># {{ "PS-".$payslip->number }}</p>
                                    </div>
                                </div>
                                
                            </div>
                            <input type="hidden" ng-init="invoice_id='asdfg'" value="" name="invoice_id" ng-model="invoice_id">

                            <div class="uk-grid" style="font-size: 12px;">
                                <div class="uk-width-small-1-2 uk-row-first">
                                    <div class="uk-margin-bottom">
                                        <span ><b>Employee Name: {{ $payslip->employeeId['name'] }}</b></span>
                                        <address>
                                            <p><strong></strong></p>
                                            <p>
                                                
                                            </p>
                                            <p> <b>Employee ID: EMP-{{ $payslip->employeeId['code_name'] }}</b></p>
                                            <p><b>Site Name: {{ $payslip->sheetId->siteId?$payslip->sheetId->siteId['company_name']:'' }}</b></p>
                                            <p> <b>Passport Number: {{ $payslip->employeeId['passport_number'] }}</b></p>
                                            <p> <b>Iqama Number: {{ $payslip->employeeId['iqama_number'] }}</b></p>
                                            <p> <b>Mobile Number: {{ $payslip->employeeId['mobile_number'] }}</b></p>
                                        </address>
                                    </div>
                                </div>
                                <div class="uk-width-small-1-2">
                                    <div class="uk-width-small-1-1">
                                        
                                    </div>
                                    <table id="info" class="uk-table inv_top_right_table" style="width: 50px;">
                                      
                                        <tr class="uk-table-middle">
                                            <td class="uk-text-left ">From </td>
                                            <td class="uk-text-center ">{{ date('F d, Y' ,strtotime($payslip->sheetId['period_from'])) }}</td>
                                        </tr>
                                        <tr class="uk-table-middle">
                                            <td class="uk-text-left ">To </td>
                                            <td class="uk-text-center ">{{ date('F d, Y' ,strtotime($payslip->sheetId['period_to'])) }}</td>
                                        </tr>
                                        
                                        <tr class="uk-table-middle">
                                            <td class="uk-text-left ">Overtime </td>
                                            <td class="uk-text-center ">{{ $payslip->over_time }}</td>
                                        </tr>
                                        <tr class="uk-table-middle">
                                            <td class="uk-text-left ">Absent </td>
                                            <td class="uk-text-center ">{{ $payslip->days_absent }}</td>
                                        </tr>
                                       
                                    </table>
                                </div>
                            </div>
                            <div style="height: 35px; width: 30%;  padding: 8px; border: 1px solid black"><b>Total Payable : {{ number_format($payslip->total_payable, 2, '.', '') }}</b></div>
                            <br>
                            <div class="uk-grid uk-margin-large-bottom" style="font-size: 12px;">
                                <div class="uk-width-1-1">
                                    <table id="table_center" border="1" class="uk-table"  >
                                        <thead>
                                        <tr class="uk-text-upper">
                                            <th class="uk-text-center">Date</th>
                                            <th class="uk-text-center">Voucher Number</th>
                                            <th class="uk-text-center">Amount</th>
                                            <th class="uk-text-center">Note</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($payment as $value)
                                            <tr class="uk-table-middle">
                                                <td class="uk-text-center">{{ date('d-m-Y',strtotime($value->date)) }}</td>
                                                <td class="uk-text-center">{{ 'PV-'.$value->number }}</td>
                                                <td class="uk-text-center">{{ $value->amount }}</td>
                                                <td class="uk-text-center">{{ $value->note }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    
                                    
                                    <div style="height: 35px; width: 30%;  padding: 8px; border: 1px solid black"><b>Total Paid : {{ number_format($payslip->total_paid, 2, '.', '') }}</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Total Due : {{ number_format($payslip->total_due, 2, '.', '') }}</b></div>
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
                                
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>

        </div>

@endsection

@section('scripts')
<script type="text/javascript">
    $('#sidebar_pms').addClass('current_section');
    $('#pms_payroll_payslip').addClass('act_item');
    $(window).load(function(){
        $("#pms_tiktok").trigger('click');
        $("#pms_payroll_tiktok").trigger('click');
        $("#pms_assign_tiktok").trigger('click');
    })
</script>
@endsection