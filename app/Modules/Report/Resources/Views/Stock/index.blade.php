@extends('layouts.main')

@section('title', 'Stock Report '.date("Y-m-d h-i-sa"))

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
                content: none !important;

            }

            a {
                text-decoration: none; color: black; cursor: default;
            }
        .md-card-toolbar
        {
            display:none;
        }
            .uk-table tr td{
                padding: 1px 0px;
                border: none !important;
                width: 100%;
                font-size: 11px !important;
            }
            .uk-table tr th{
                padding: 1px 2px;
                border-top: 1px solid black;
                border-bottom: 1px solid black;
                width: 100%;
                font-size: 11px !important;
            }
            .uk-table tr th:last-child{
              white-space: nowrap;
            }
            .uk-table tr th:nth-child(3){
                white-space: nowrap;
            }
            .uk-table tr th:nth-child(4){
                white-space: nowrap;
            }
            body{
                margin-top: -40px;
            }
        }
    </style>
@endsection
@section('content')
    <div class="uk-width-medium-10-10 uk-container-center reset-print">
        <div class="uk-grid uk-grid-collapse" >
            <div class="uk-width-large-10-10">
                <div class="md-card md-card-single main-print">
                    <div id="invoice_preview">
                        <div class="md-card-toolbar">
                            <div class="md-card-toolbar-actions hidden-print">
                                <i class="md-icon material-icons" onclick="print()" id="invoice_print"></i>



                                <!--end  -->
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="true"> <a href="#" data-uk-modal="{target:'#coustom_setting_modal'}"><i class="material-icons">&#xE8B8;</i><span>Custom Setting</span></a>

                                </div>
                                <!--coustorm setting modal start -->
                                <div class="uk-modal" id="coustom_setting_modal">
                                    <div class="uk-modal-dialog">
                                        {!! Form::open(['url' => 'report/stock', 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}


                                        <div class="uk-width-large-2-2 uk-width-2-2">
                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                    <label for="uk_dp_1">Form</label>
                                                    <input class="md-input" type="text" id="uk_dp_1" name="from_date" data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                                                </div>
                                            </div>
                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                    <label for="uk_dp_1">To</label>
                                                    <input class="md-input" type="text" id="uk_dp_1" name="to_date" data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
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

                            <div class="uk-grid">

                                <div class="uk-width-small-5-5 uk-text-center">
                                    <img style="margin-bottom: -20px;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/>
                                    <p style="line-height: 5px; margin-top: 35px;" class="uk-text-large">{{ $OrganizationProfile->company_name }}</p>
                                    <p style="line-height: 5px;" class="heading_b">Item Report</p>
                                    <p style="line-height: 5px;" class="uk-text-small">From {{$start}}  To {{$end}}</p>
                                </div>
                            </div>
                            <div class="uk-grid ">
                                <div class="uk-width-1-1">
                                    <table class="uk-table" cellspacing="0" width="100%"  >
                                        <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Reorder</th>
                                            <th>Stock In</th>
                                            <th>Stock Out</th>

                                            <th>Stock In Hand</th>

                                        </tr>
                                        </thead>

                                        <tfoot>
                                        <tr>
                                            <th>Item</th>
                                            <th>Reorder</th>
                                            <th>Stock In</th>
                                            <th>Stock Out</th>

                                            <th>Stock In Hand</th>



                                        </tr>
                                        </tfoot>

                                        <tbody>
                                        <?php $count = 1; ?>
                                      
                                        @foreach($stock as $value)
                                            @php
                                                $in =$value->stocks->where('created_at','>=',$start)->where('created_at','<=', $end)->sum('total');

                                                $out = $value->invoiceEntries()->join('invoices', 'invoices.id', '=', 'invoice_entries.invoice_id')->whereNull('save')->where('invoice_entries.created_at','>',$start)->where('invoice_entries.created_at','<', $end)->sum('quantity');
                                                $in_hand = $in-$out;
                                            @endphp
                                            <tr>
                                                <td><a href="{{ route('report_stock_details_item',array('id'=>$value->id,'start'=>$start,'end'=>$end)) }}"> {{ $value->item_name }} </a></td>
                                                <td>{{ $value->reorder_point  }}</td>
                                                <td>{{ $in }}</td>
                                                <td>{{ $out }}</td>
                                                <td>{{ $in_hand }}</td>




                                            </tr>
                                            @php
                                                $in =0;
                                                $out = 0;
                                                $in_hand = 0;
                                            @endphp
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

    <script>
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_reports').addClass('act_item');
    </script>

@endsection