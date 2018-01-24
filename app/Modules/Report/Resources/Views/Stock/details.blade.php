@extends('layouts.main')

@section('title', 'Stock Details Report '.date("Y-m-d h-i-sa"))

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style>
        @media print {
            .user_heading{
                display: none !important;
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
            .uk-table tr th:last-child,.uk-table tr th:nth-child(3){
               white-space: nowrap;

            }
            .uk-table tr td:last-child{
                text-align: right;
            }
            .uk-table tr td:first-child{
                text-align: left;
            }

            body{
                margin-top: -40px;
                text-align: center;
            }

        }
    </style>
@endsection

@section('content')

    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <h3 style="float: left; color: white;">Stock Report</h3>
                            <i style="color: whitesmoke; float: right;" class="md-icon material-icons" onclick="print()" id="invoice_print"></i>
                        </div>
                        <div>
                            <div class="uk-grid" data-uk-grid-margin style="margin-top: 20px;">

                                <div class="uk-width-small-5-5 uk-text-center">
                                    <img style="margin-bottom: -20px;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/>
                                    <p style="line-height: 5px; margin-top: 35px;" class="uk-text-large">{{ $OrganizationProfile->company_name }}</p>
                                    <p style="line-height: 5px;" class="heading_b">Stock Report</p>
                                    <p style="line-height: 5px;" class="uk-text-small">From {{$start}}  To {{$end}}</p>
                                </div>
                            </div>

                        </div>
                        <div class="user_content">
                            <div class="uk-overflow-container ">
                                <h4><span style="padding-right: 20px; float: left">Total Stock In : <span id="stockin"></span></span>  <span style="padding-right: 20px;">Total Stock Out : <span id="stockout"></span></span> <span style="padding-right: 20px; float: right">Stock In Hand : <span id="stockhand"></span></span></h4>

                                <div class="uk-grid">
                                    <div class="uk-width-1-2">
                                        <table class="uk-table" cellspacing="0" width="100%"  >
                                            <thead>
                                            <tr>
                                                <th id="sortby">Date</th>
                                                <th>Transaction</th>
                                                <th>Stock In</th>


                                                <th>Total Stock In</th>

                                            </tr>
                                            </thead>

                                            <tfoot>
                                            <tr>
                                                <th>Date</th>
                                                <th>Transaction</th>
                                                <th>Stock In</th>


                                                <th>Total Stock In</th>


                                            </tr>
                                            </tfoot>

                                            <tbody id="in">
                                            @php
                                                $stocktotal = 0;
                                            @endphp
                                            @foreach($stock->stocks as $value)
                                                @php

                                                    $stocktotal =$stocktotal+$value->total;
                                                @endphp
                                                <tr>
                                                    <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                                    <td>
                                                        @if( $value->bill)
                                                            BILL-{{ $value->bill->bill_number }}
                                                        @elseif($value->creditNote)
                                                            CN-{{ $value->creditNote->credit_note_number }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $value->total }}</td>

                                                    <td> {{ $stocktotal }}</td>



                                                </tr>
                                            @endforeach


                                            </tbody>
                                        </table>

                                    </div>

                                    <div class="uk-width-1-2">

                                        <table class="uk-table" cellspacing="0" width="100%"  >
                                            <thead>
                                            <tr>
                                                <th id="sortby">Date</th>
                                                <th>Transaction</th>

                                                <th>Stock Out</th>

                                                <th>Total Stock Out</th>

                                            </tr>
                                            </thead>

                                            <tfoot>
                                            <tr>
                                                <th>Date</th>
                                                <th>Transaction</th>

                                                <th>Stock Out</th>

                                                <th>Total Stock Out</th>


                                            </tr>
                                            </tfoot>

                                            <tbody id="out">
                                            @php
                                                $stocktotal =0;
                                            @endphp

                                            @foreach($stock->invoiceEntries as $value)
                                                @if($value->invoice->save==null)
                                                    <tr>
                                                        <td> {{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                                        <td>
                                                            @if( $value->invoice_id)
                                                                INV-{{ $value->invoice->invoice_number }}

                                                            @endif
                                                        </td>

                                                        <td>{{ $value->quantity }}</td>

                                                        <td>{{ $stocktotal=$stocktotal+$value->quantity }}</td>



                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>
                            <!-- Add branch plus sign -->


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

        window.onload = function () {

           var stockin = $('#in tr:last-child td:last-child').text();
           var stockout = $('#out tr:last-child td:last-child').text();

           var totalstock = parseInt(stockin) - parseInt(stockout);
            $('#stockin').text(stockin);
            $('#stockout').text(stockout);
            $('#stockhand').text(totalstock||'');

        }
    </script>

@endsection