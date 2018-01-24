<!DOCTYPE html>
<!--[if lte IE 9]>
<html class="lte-ie9" lang="en">
<![endif]-->
<!--[if gt IE 9]><!-->
<html lang="en" ng-app="app">
<!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no" />

    <link rel="icon" type="image/png" href="{{ url('admin/assets/img/favicon-16x16.png') }}" sizes="16x16">
    <link rel="icon" type="image/png" href="{{ url('admin/assets/img/favicon-32x32.png') }}" sizes="32x32">

    <title>@yield('title')</title>


    <!-- themes -->
    <link rel="stylesheet" href="{{ url('admin/assets/css/themes/themes_combined.min.css') }}" media="all">

    <!-- matchMedia polyfill for testing media queries in JS -->
    <!--[if lte IE 9]>
    <script type="text/javascript" src="{{ url('admin/bower_components/matchMedia/matchMedia.js') }}"></script>
    <script type="text/javascript" src="{{ url('admin/bower_components/matchMedia/matchMedia.addListener.js') }}"></script>
    <link rel="stylesheet" href="{{ url('admin/assets/css/ie.css') }}" media="all">
    <![endif]-->

    <script type="text/javascript" src="https://cdn.jsdelivr.net/sweetalert2/6.4.4/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.4.4/sweetalert2.min.css">

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th{
            border: 1px solid #ccc;
        }
        td {

            height: 2em;
            border: 1px solid #ccc;
        }
        @page { margin: 180px 50px; }
        #header { position: fixed; left: 0px; top: -190px; right: 0px; height: 150px;padding-top: 20px }
        #footer { position: fixed; left: 0px; bottom: -140px; right: 0px; height: 150px; }
        #footer .page:after { content: counter(page, upper-roman); }

    </style>
</head>

<body class="sidebar_main_open sidebar_main_swipe header_double_height" style="margin-top: 30px;margin-bottom: 40px">
<?php
$helper = new \App\Lib\Helpers;
?>

<div id="header">
    <div class="col-md-4">
        <img style="padding-top: 20px;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="50" width="50"/>
    </div>
    <div class="" style="text-align: center;padding-top: -70px">
        <h1 style="text-transform: uppercase">{{ $OrganizationProfile->company_name }}</h1>
        <p style="margin: 0;padding: 0">{{ $OrganizationProfile->street }},{{ $OrganizationProfile->city }},{{ $OrganizationProfile->state }},{{ $OrganizationProfile->country }}</p>
        <p>{{ $OrganizationProfile->email }},{{ $OrganizationProfile->contact_number }}</p>
    </div>

    <div>
        <div style="font-size: 12px;text-align: center">
            <div >
                <h2 style="margin: 0;padding: 0">INVOICE</h2>
                <p style="margin: 0;padding: 0"># INV-{{ str_pad($invoice->invoice_number, 6, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>
    </div>
</div>
<div id="footer">

    <div class="uk-grid">
        <div class="uk-width-1-2">
            <p class="uk-text-small uk-margin-bottom">Looking forward for your business.</p>
            @if($invoice->file_name)
                <a href="{{ url('invoice/invoice-download'.'/'.$invoice->file_name) }}"><p class="uk-text-medium uk-margin-bottom">Download Attachment</p></a>
            @endif
        </div>
    </div>

    <div class="uk-grid">
        <div class="uk-width-1-2" style="text-align: left">
            <p class="uk-text-small uk-margin-bottom">Customer Signature</p>
        </div>
        <div class="uk-width-1-2" style="text-align: right;padding-top: -55px">
            <p class="uk-text-small uk-margin-bottom">Company Representative</p>
        </div>

    </div>
</div>


<div class="uk-width-large-6-10">

    <div class="md-card-content invoice_content print_bg" style="margin-top: 10px;">

        <input type="hidden" ng-init="invoice_id='asdfg'" value="{{$invoice->id}}" name="invoice_id" ng-model="invoice_id">

        <div class="container" style="font-size: 15px;">
            <div class="uk-width-small-1-2 uk-row-first" style="padding-top: -50px">
                <div class="uk-margin-bottom">
                    <span class="uk-text-muted uk-text-small uk-text-italic">Bill To: <span style="color: green">{{ $invoice->customer->display_name }}</span> </span>
                    <address>
                        <p style="margin: 0;padding: 0">{{ $invoice->customer->company_name }},{{ $invoice->customer->phone_number_1 }}</p>
                        <p style="margin: 5px;padding: 0">Billing Address-{{ $invoice->customer->billing_street }},{{ $invoice->customer->billing_city }},{{ $invoice->customer->billing_state }},{{ $invoice->customer->billing_zip_code }},{{ $invoice->customer->billing_country }}</p>
                        <p style="margin: 0;padding: 0">Shipping address-{{ $invoice->customer->shipping_street }},{{ $invoice->customer->shipping_city }},{{ $invoice->customer->shipping_state }},{{ $invoice->customer->shipping_zip_code }},{{ $invoice->customer->shipping_country }}</p>
                    </address>
                </div>
            </div>
            <div class="uk-width-small-1-2" style="padding-top: -80px;">
                <div class="uk-width-small-1-1">
                    <p style="text-align: right; width: 99%; margin: 0; padding: 0;" class="uk-text-small uk-margin-right-remove">Balance Due</p>
                    <h2 style="text-align: right; width: 99%;color: green;margin: 0" class="uk-margin-top-remove">BDT {{ $helper->getDueBalance($invoice->id) }}</h2>
                </div>
                <div class="uk-width-small-1-1">
                    <p style="text-align: right; width: 99%;margin: 5px;padding: 0" class="uk-margin-top-remove">Invoice Date: {{ $invoice->invoice_date }}</p>

                    <p style="text-align: right; width: 99%;margin: 0;padding: 0" class="uk-margin-top-remove">Due Date: {{ $invoice->payment_date }}</p>
                </div>
            </div>
        </div>
        <br>
        <div class="uk-grid uk-margin-large-bottom" style="font-size: 12px;">
            <table width="700px">
                <thead>
                <tr>
                    <th style="text-align: center" width="10%">#</th>
                    <th style="text-align: center">Item</th>
                    <th style="text-align: center">Qty</th>
                    <th style="text-align: center">Rate</th>
                    <th style="text-align: center">Discount(%)</th>
                    <th style="text-align: center">Amount</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($invoice_entries as $invoice_entry)
                    <tr>
                        <td style="text-align: center">{{ $i++ }}</td>
                        <td style="text-align: center">{{ $invoice_entry->item->item_name }}</td>
                        <td style="text-align: center" class="uk-text-right">{{ $invoice_entry->quantity }}</td>
                        <td style="text-align: center" class="uk-text-right">{{ $invoice_entry->rate }}</td>
                        <td style="text-align: center" class="uk-text-right">{{ $invoice_entry->discount }}%</td>
                        <td style="text-align: center" class="uk-text-right">{{ $invoice_entry->amount }}</td>
                    </tr>
                @endforeach
                <tr class="uk-table-middle">
                    <td class="no-border-bottom"></td>
                    <td class="no-border-bottom"></td>
                    <td class="no-border-bottom"></td>
                    <td class="no-border-bottom"></td>
                    <td style="text-align: center" class="uk-text-right no-border-bottom">Sub Total</td>
                    <td style="text-align: center" class="uk-text-right no-border-bottom">{{ $sub_total }}</td>
                </tr>

                @if($invoice->tax_total>0)
                    <tr class="uk-table-middle">
                        <td class="no-border-bottom"></td>
                        <td class="no-border-bottom"></td>
                        <td class="no-border-bottom"></td>
                        <td class="no-border-bottom"></td>
                        <td style="text-align: center" class="uk-text-right no-border-bottom">Tax</td>
                        <td style="text-align: center" class="uk-text-right no-border-bottom">{{ $invoice->tax_total }}</td>
                    </tr>
                @endif

                @if($invoice->shipping_charge>0)
                    <tr class="uk-table-middle">
                        <td class="no-border-bottom"></td>
                        <td class="no-border-bottom"></td>
                        <td class="no-border-bottom"></td>
                        <td class="no-border-bottom"></td>
                        <td style="text-align: center" class="uk-text-right no-border-bottom">Shipping Charge</td>
                        <td style="text-align: center" class="uk-text-right no-border-bottom">{{ $invoice->shipping_charge }}</td>
                    </tr>
                @endif

                @if($invoice->adjustment > 0 || $invoice->adjustment < 0)
                    <tr class="uk-table-middle">
                        <td class="no-border-bottom">

                        </td>
                        <td class="no-border-bottom"></td>
                        <td class="no-border-bottom"></td>
                        <td class="no-border-bottom"></td>
                        <td style="text-align: center" class="uk-text-right no-border-bottom">Adjustment</td>
                        <td style="text-align: center" class="uk-text-right no-border-bottom">{{ $invoice->adjustment }}</td>
                    </tr>
                @endif

                <tr class="uk-table-middle">
                    <td class="no-border-bottom">

                    </td>
                    <td class="no-border-bottom">{{ucfirst($numberTransformer->toWords($invoice->total_amount))}} BDT Only</td>
                    <td class="no-border-bottom"></td>
                    <td class="no-border-bottom"></td>
                    <td style="text-align: center" class="uk-text-right no-border-bottom">Total</td>
                    <td style="text-align: center" class="uk-text-right no-border-bottom">{{ $invoice->total_amount }}</td>
                </tr>
                <tr class="uk-table-middle">
                    <td class="no-border-bottom"></td>
                    <td class="no-border-bottom"></td>
                    <td class="no-border-bottom"></td>
                    <td class="no-border-bottom"></td>
                    <td style="text-align: center" class="uk-text-right no-border-bottom" style="background: #efefef">Balance Due</td>
                    <td style="text-align: center" class="uk-text-right no-border-bottom" style="background: #efefef">BDT {{ $helper->getDueBalance($invoice->id) }}</td>
                </tr>

                </tbody>
            </table>
        </div>
        <br>
        <div class="uk-grid">
            <div class="uk-width-1-2">
                <span class="uk-text-muted uk-text-small uk-text-italic" style="text-transform: uppercase;">Notes:</span>
                <p class="uk-text-small uk-margin-bottom">{{$invoice->customer_note}}</p>
                @if($invoice->file_name)
                    <a href="{{ url('invoice/invoice-download'.'/'.$invoice->file_name) }}"><p class="uk-text-medium uk-margin-bottom">Download Attachment</p></a>
                @endif
            </div>
        </div>
        <div class="uk-grid uk-margin-large-bottom" style="font-size: 12px;">
            <div class="uk-width-1-1">
                <table class="uk-table">
                    <thead>
                    <tr class="uk-text-upper">
                        <th style="text-align: center;" width="10%">#</th>
                        <th style="text-align: center" width="50%">Invoice No</th>
                        <th style="text-align: center" class="uk-text-right" width="40%">Due</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; $total_due = 0;?>
                    @foreach($invoices as $invoice_data)
                        @if($invoice_data->id !=$invoice->id && $invoice_data->customer_id ==$invoice->customer_id )
                            <tr class="uk-table-middle">
                                <td style="text-align: center">{{ $i++ }}</td>

                                <td style="text-align: center">INV-{{ str_pad($invoice_data->invoice_number, 6, '0', STR_PAD_LEFT) }}</td>
                                <td style="text-align: center" class="uk-text-right">BDT {{ $helper->getDueBalance($invoice_data->id) }}</td>
                                <?php $total_due = $total_due+$helper->getDueBalance($invoice_data->id); ?>
                            </tr>
                        @endif
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>

</html>
