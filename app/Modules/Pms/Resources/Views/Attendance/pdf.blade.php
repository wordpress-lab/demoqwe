@extends('layouts.admin')

@section('title', 'Attendence Report')

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

            #list_table_left tr th:nth-child(7) {
                display: none;
            }
            #list_table_right tr th:nth-child(7) {
                display: none;
            }
            #list_table_left tr td:nth-child(7) {
                display: none;
            }
            #list_table_right tr td:nth-child(7) {
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
                            <div class="uk-modal" id="coustom_setting_modal">
                                <div class="uk-modal-dialog">
                                
                                </div>
                            </div>
                            <!--end  -->
                        </div>

                        <h3 class="md-card-toolbar-heading-text large" id="invoice_name"></h3>
                    </div>
                    <div class="md-card-content invoice_content print_bg" style="height: 100%;">
                        
                        <div class="uk-grid" data-uk-grid-margin="">
                            @inject('theader', '\App\Lib\TemplateHeader')
                            <div class="uk-width-small-5-5 uk-text-center">
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
                                
                            </div>
                        </div>
                        <div class="uk-grid" >

                            <div class="uk-width-medium-1-1">
                                <div class="uk-form-row">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-small-1-2">
                                            <h4>Date: {{ date('d-m-Y', strtotime($date)) }}</h4>
                                            
                                        </div>
                                        <div class="uk-width-small-1-2">
                                            <h4>Site: {{ $site->company_name }}</h4>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
                            <div id="list_table_left_parent" class="uk-width-1-1" style="font-size: 12px;">
                                
                                <table id="list_table_left">
                                    <thead>
                                    <tr class="uk-text-upper">
                                        <th style="font-size: 10px">Code</th>
                                        <th style="font-size: 10px">Name</th>
                                        <th style="font-size: 10px">Entrance</th>
                                        <th style="font-size: 10px">Leave</th>
                                        <th style="font-size: 10px">Over Time</th>
                                        <th style="font-size: 10px">Status</th>                     
                                    </tr>
                                    </thead>
                                    <tbody  >
                                    @foreach($attendance as $all)
                                        <tr>

                                            <td>{{ 'EMP-'.$all->code_name }}</td>
                                            <td>{{ $all->name }}</td>
                                            <td>{{ $all->absense==1?'':(($all->leave_from!=null)&&($all->leave_to!=null))?'':$all->entrance_time }}</td>
                                            <td>{{ $all->absense==1?'':(($all->leave_from!=null)&&($all->leave_to!=null))?'':$all->leave_time }}</td>
                                            <td>{{ (($all->leave_from!=null)&&($all->leave_to!=null))?'':$all->overtime }}</td>
                                            <td>{{ ($all->absense==1)?'Absense':(($all->leave_from!=null)&&($all->leave_to!=null))?'Leave':'Present' }}</td>
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
                                <p class="uk-text-small uk-margin-bottom"></p>
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

    $('#sidebar_pms').addClass('current_section');
    $('#sidebar_pms_attendance_view').addClass('act_item');

    $( window ).load(function() {
      print();
    });
</script>
@endsection
