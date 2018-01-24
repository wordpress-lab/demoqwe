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
                <h2 style="margin: 0;padding: 0">PAYMENT MADE</h2>
                <p style="margin: 0;padding: 0"># PM-{{ str_pad($payment_made->id, 6, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>
    </div>
</div>
<div id="footer">
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


<div class="uk-width-large-6-10">

    <div class="md-card-content invoice_content print_bg" style="margin-top: 10px;">
        <div class="container" style="font-size: 15px;">
            <div class="uk-width-small-1-2 uk-row-first" style="padding-top: -50px">
                <div class="uk-margin-bottom">
                    <span class="uk-text-muted uk-text-small uk-text-italic">Bill To: <span style="color: green">{{ $payment_made->customer->display_name }}</span> </span>
                    <address>
                        <p style="margin: 0;padding: 0">{{ $payment_made->customer->company_name }},{{ $payment_made->customer->phone_number_1 }}</p>
                        <p style="margin: 0;padding: 0">Billing Address-{{ $payment_made->customer->billing_street }},{{ $payment_made->customer->billing_city }},{{ $payment_made->customer->billing_state }},{{ $payment_made->customer->billing_zip_code }},{{ $payment_made->customer->billing_country }}</p>
                        <p style="margin: 0;padding: 0">Shipping address-{{ $payment_made->customer->shipping_street }},{{ $payment_made->customer->shipping_city }},{{ $payment_made->customer->shipping_state }},{{ $payment_made->customer->shipping_zip_code }},{{ $payment_made->customer->shipping_country }}</p>
                    </address>
                </div>
            </div>
            <div class="uk-width-small-1-2" style="padding-top: -80px;">
                <div class="uk-width-small-1-1">
                    <p style="text-align: right; width: 99%; margin: 0; padding: 0;" class="uk-text-small uk-margin-right-remove">Amount Received</p>
                    <h2 style="text-align: right; width: 99%;color: green;margin: 0" class="uk-margin-top-remove">BDT {{ $payment_made->amount }}</h2>
                </div>
                <div class="uk-width-small-1-1">
                    <p style="text-align: right; width: 99%;margin: 5px;padding: 0" class="uk-margin-top-remove">Payment Date : {{ $payment_made->payment_date }}</p>

                    <p style="text-align: right; width: 99%;margin: 0;padding: 0" class="uk-margin-top-remove">Reference Number :{{ $payment_made->reference }}</p>
                    @if($payment_made->account_id == 4)
                        @if($payment_made->invoice_show == "on")
                    <p style="text-align: right; width: 99%;margin: 0;padding: 0" class="uk-margin-top-remove">Paid Through :Check({{ $payment_made->bank_info }})</p>
                        @endif
                    @else
                        <p style="text-align: right; width: 99%;margin: 0;padding: 0" class="uk-margin-top-remove">Paid Through :{{ $payment_made->account->account_name }}</p>
                    @endif

            </div>
        </div>
        <br>

            <div class="uk-grid">
                <div class="uk-width-small-1-2 uk-row-first">
                    <div class="uk-margin-bottom" style="padding-bottom: 20px;padding-top: 20px">
                        <span class="uk-text-muted uk-text-small uk-text-italic" style="margin: 0;padding: 0">Over payment:</span>
                        <address>
                            <p style="margin: 0;padding: 0"><strong>{{ $payment_made->excess_amount }}</strong></p>
                        </address>
                    </div>
                </div>
            </div>

            <div class="uk-grid uk-margin-large-bottom" style="font-size: 12px;">
            <table width="700px">
                <thead>
                <tr>
                    <th style="text-align: center">Bill Number</th>
                    <th style="text-align: center">Bill Date</th>
                    <th style="text-align: center">Bill Amount</th>
                    <th style="text-align: center">Payment Amount</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payment_made_entries as $payment_made_entry)
                    <tr>
                        <td style="text-align: center">{{ $payment_made_entry->bill->bill_number }}</td>
                        <td style="text-align: center" class="uk-text-right">{{ $payment_made_entry->bill->bill_date }}</td>
                        <td style="text-align: center" class="uk-text-right">{{ $payment_made_entry->bill->amount }}</td>
                        <td style="text-align: center" class="uk-text-right">{{ $payment_made_entry->amount }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>

</html>
