@extends('layouts.invoice')

@section('title', 'Challan')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('scripts')
    <script src="{{url('app/moneyin/invoice/invoice.module.js')}}"></script>
    <script src="{{url('app/moneyin/invoice/invoice.useCredit.js')}}"></script>
    <script src="{{url('app/moneyin/invoice/invoice.excessPayment.js')}}"></script>
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
        }
    </style>
@endsection
@section('content')
    <div class="uk-width-medium-10-10 uk-container-center reset-print">
        <div class="uk-grid uk-grid-collapse" data-uk-grid-margin>
            <div class="uk-width-large-2-10 hidden-print uk-visible-large">
                <div class="md-list-outside-wrapper">
                    <ul class="md-list md-list-outside">

                        <li class="heading_list">Recent Challan</li>

                        @foreach($invoices as $invoice_data)
                        <li>
                            <a href="{{ url('/invoice/challan'.'/'.$invoice_data->id) }}" class="md-list-content">
                                <span class="md-list-heading uk-text-truncate">{{ $invoice_data->customer->display_name }} <span class="uk-text-small uk-text-muted">({{ $invoice_data->created_at->format('d M Y') }})</span></span>
                                <span class="uk-text-small uk-text-muted">INV-{{ str_pad($invoice_data->invoice_number, 6, '0', STR_PAD_LEFT) }}</span>
                            </a>
                        </li>
                        @endforeach

                        <li class="uk-text-center">
                            <a class="md-btn md-btn-primary md-btn-mini md-btn-wave-light waves-effect waves-button waves-light uk-margin-top" href="{{ url('/invoice') }}">See All</a>
                        </li>

                    </ul>
                </div>
            </div>

            <?php
            $helper = new \App\Lib\Helpers;
            ?>

            <div class="uk-width-large-6-10">
                <div class="md-card md-card-single main-print">
                    <div id="invoice_preview">
                        <div class="md-card-toolbar" style="border-bottom: 0px solid rgba(0,0,0,.12);">
                            <div class="md-card-toolbar-actions hidden-print">
                                <i class="md-icon material-icons" id="invoice_print"></i>
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="false">
                                    <i class="md-icon material-icons"></i>
                                    <div class="uk-dropdown" aria-hidden="true">
                                        <ul class="uk-nav">
                                             <li>
                                                <a href="{{ url('/invoice/show'.'/'.$invoice->id) }}">Invoice</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                        <div class="md-card-content invoice_content print_bg" style="">
                            <div class="uk-grid" data-uk-grid-margin style="text-align: center;">
                                <h1 style="width: 100%; text-align: center;"><img style="text-align: center;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/> {{ $OrganizationProfile->company_name }}</h1>
                            </div>
                            <div class="" style="text-align: center;">
                               
                                <p>{{ $OrganizationProfile->street }},{{ $OrganizationProfile->city }},{{ $OrganizationProfile->state }},{{ $OrganizationProfile->country }}</p>
                               
                                <p style="margin-top: -17px;">{{ $OrganizationProfile->email }},{{ $OrganizationProfile->contact_number }}</p>
                            </div>
                            
                            <div class="uk-grid" data-uk-grid-margin>
                                
                                <div class="uk-width-5-5">
                                    <div class="uk-grid">
                                        <h2 style="text-align: center; width: 90%;" class="">
                                            @if($helper->getPaymentStatus($invoice->id) == "Draft")
                                            DRAFT CHALLAN
                                            @else
                                            CHALLAN
                                            @endif
                                        </h2>
                                        <p style="text-align: center; width: 90%;" class="uk-text-small uk-text-muted uk-margin-top-remove"># CHA-{{ str_pad($invoice->invoice_number, 6, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                                
                            </div>
                            <input type="hidden" ng-init="invoice_id='asdfg'" value="{{$invoice->id}}" name="invoice_id" ng-model="invoice_id">

                            <div class="uk-grid">
                                <div class="uk-width-small-1-2 uk-row-first">
                                    <div class="uk-margin-bottom">
                                        <span class="uk-text-muted uk-text-small uk-text-italic">Bill To:</span>
                                        <address>
                                            <p><strong>{{ $invoice->customer->display_name }}</strong></p>
                                            @if(!empty($invoice->customer->company_name) && !empty($invoice->customer->phone_number_1))
                                            <p>
                                                {{ $invoice->customer->company_name }},{{ $invoice->customer->phone_number_1 }}
                                            </p>
                                            @endif
                                            <p>Billing Address-
                                                @if(!empty($invoice->customer->billing_street))
                                                {{ $invoice->customer->billing_street }},
                                                @endif
                                                @if(!empty($invoice->customer->billing_city))
                                                {{ $invoice->customer->billing_city }},
                                                @endif
                                                @if(!empty($invoice->customer->billing_state))
                                                {{ $invoice->customer->billing_state }},
                                                @endif
                                                @if(!empty($invoice->customer->billing_zip_code))
                                                {{ $invoice->customer->billing_zip_code }},
                                                @endif
                                                {{ $invoice->customer->billing_country }}
                                            </p>
                                            <p>Shipping address-
                                                @if(!empty($invoice->customer->shipping_street))
                                                {{ $invoice->customer->shipping_street }},
                                                @endif
                                                @if(!empty($invoice->customer->shipping_city))
                                                {{ $invoice->customer->shipping_city }},
                                                @endif
                                                @if(!empty($invoice->customer->shipping_state))
                                                {{ $invoice->customer->shipping_state }},
                                                @endif
                                                @if(!empty($invoice->customer->shipping_zip_code))
                                                {{ $invoice->customer->shipping_zip_code }},
                                                @endif
                                                {{ $invoice->customer->shipping_country }}
                                            </p>
                                        </address>
                                    </div>
                                </div>
                                <div class="uk-width-small-1-2">
                                    <table id="info" class="uk-table inv_top_right_table">
                                        <tr class="uk-table-middle">
                                            <td class="uk-text-right no-border-bottom">Invoice Date :</td>
                                            <td class="uk-text-right no-border-bottom">{{ $invoice->invoice_date }}</td>
                                        </tr>
                                        <tr>
                                            <td class="uk-text-right"> Invoice No </td>
                                            <td class="uk-text-right no-border-bottom">INV-{{ str_pad($invoice->invoice_number, 6, '0', STR_PAD_LEFT) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="uk-grid uk-margin-large-bottom" style="font-size: 12px;">
                                <div class="uk-width-1-1">
                                    <table border="1" id="table_center" class="uk-table" style="font-size: 12px;" report_table >
                                        <thead>
                                        <tr class="uk-text-upper">
                                            <th style="border-bottom: none;">#</th>
                                            <th style="border-bottom: none;">Particulars</th>
                                            <th colspan="2" style="border-bottom: none;">Quantity</th>
                                            <th class="uk-text-right" style="border-bottom: none;">Remarks</th>
                                        </tr>
                                        <tr class="uk-text-upper">
                                            <th style="border-bottom: none;"></th>
                                            <th style="border-bottom: none;"></th>
                                            <th class="uk-text-right" style="border-bottom: none;">PCS</th>
                                            <th class="uk-text-right" style="border-bottom: none;">CTN</th>
                                            <th class="uk-text-right" style="border-bottom: none;"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; $total_quantity = 0; $total_ctn = 0;?>
                                        @foreach($invoice_entries as $invoice_entry)
                                        @if($invoice_entry->item->item_category_id == 1)
                                        <tr class="uk-table-middle">
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $invoice_entry->item->item_name }}</td>
                                            
                                            <?php 
                                                $total_quantity = $total_quantity+$invoice_entry->quantity;
                                                $total_ctn += $invoice_entry->carton;;
                                            ?>
                                            <td class="uk-text-right">{{ $invoice_entry->quantity }}</td>
                                            <td class="uk-text-right">{{ $invoice_entry->carton }}</td>
                                            <td class="uk-text-right">{{ $invoice_entry->remarks }}</td>
                                            
                                        </tr>
                                        @endif
                                        @endforeach

                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom">
                                             ({{ ucfirst($numberTransformer->toWords($total_quantity))}})
                                            </td>
                                            <td class="uk-text-right no-border-bottom">{{ $total_quantity }}</td>
                                            <td class="uk-text-right no-border-bottom">{{ $total_ctn }}</td>
                                            <td class="uk-text-right no-border-bottom"></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="uk-grid">
                                <div class="uk-width-1-2" style="text-align: left">
                                    <p class="uk-text-small uk-margin-bottom">Customer Signature</p>
                                </div>
                                <div class="uk-width-1-2" style="text-align: right">
                                    <p class="uk-text-small uk-margin-bottom">Company Representative</p>
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

            <div class="uk-width-large-2-10 hidden-print uk-visible-large">
                <div class="md-list-outside-wrapper">
                    @if(Session::has('challan_msg'))
                        <div class="uk-alert uk-alert-success" data-uk-alert="">
                            <a href="#" class="uk-alert-close uk-close"></a>
                            {{ Session::get('challan_msg') }}
                        </div>
                    @endif
                    {{ Form::open(['url' => route('invoice_challan_update',$invoice->id), 'method' => 'post', 'id' => 'user_edit_form']) }}
                    <ul class="md-list md-list-outside">
                        
                        <li class="heading_list">Items</li>

                        @foreach($invoice_entries as $invoice_entry)
                        <li>
                            <div class="md-list-content">
                                <span class="md-list-heading"><label style="color: #757575;">Item name:</label>{{ $invoice_entry->item->item_name }}</span>
                                <span class="md-list-heading"><label style="color: #757575;">Quantity(in pcs):</label>{{ $invoice_entry->quantity }}</span>
                                <br>
                                <label>Quantity(in carton)</label><input type="text" class="md-input uk-form-width-small" name="carton[]" value="{{ $invoice_entry->carton }}">
                                <label>Remarks</label><input type="text" class="md-input uk-form-width-small" name="remarks[]" value="{{ $invoice_entry->remarks }}">
                            </div>
                            
                        </li>
                        @endforeach

                        <li class="uk-text-center">
                            <button type="submit" class="md-btn md-btn-primary md-btn-mini md-btn-wave-light waves-effect waves-button waves-light uk-margin-top">Save</button>
                        </li>
                        
                    </ul>
                    {{ Form::close() }}
                </div>
            </div>
            
        </div>

        {{--model--}}
        @include('invoice::invoice.use_credit')
        @include('invoice::invoice.use_excess_payments')

    </div>
@endsection

@section('sweet_alert')
    <script>
        $('.payment_receive_delete_btn').click(function () {
            var id = $(this).next('.payment_receive_entry_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this! If you delete this",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "/payment-received/delete-payment-receive-entry/"+id;
            })
        })

        $('.credit_receive_entry_delete_btn').click(function () {
            var id = $(this).next('.credit_receive_entry_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this! If you delete this",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "/invoice/delete-credit/"+id;
            })
        })
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_invoice').addClass('act_item');

        $(window).load(function(){
            $("#tiktok_account").trigger('click');

        })
    </script>
@endsection
