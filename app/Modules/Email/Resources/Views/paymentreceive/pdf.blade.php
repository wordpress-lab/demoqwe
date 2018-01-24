
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
                <h2 style="margin: 0;padding: 0">PAYMENT RECEIPT</h2>
                <p style="margin: 0;padding: 0"># PR-{{ str_pad($paymentreceive->id, 6, '0', STR_PAD_LEFT) }}</p>
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
                    <span class="uk-text-muted uk-text-small uk-text-italic">Bill To: <span style="color: green">{{ $paymentreceive->paymentContact->display_name }}</span> </span>
                    <address>
                        <p style="margin: 5px;padding: 0">{{ $paymentreceive->paymentContact->company_name }},{{ $paymentreceive->paymentContact->phone_number_1 }}</p>
                        <p style="margin: 5px;padding: 0">Billing Address-{{ $paymentreceive->paymentContact->billing_street }},{{ $paymentreceive->paymentContact->billing_city }},{{ $paymentreceive->paymentContact->billing_state }},{{ $paymentreceive->paymentContact->billing_zip_code }},{{ $paymentreceive->paymentContact->billing_country }}</p>
                        <p style="margin: 5px;padding: 0">Shipping address-{{ $paymentreceive->paymentContact->shipping_street }},{{ $paymentreceive->paymentContact->shipping_city }},{{ $paymentreceive->paymentContact->shipping_state }},{{ $paymentreceive->paymentContact->shipping_zip_code }},{{ $paymentreceive->paymentContact->shipping_country }}</p>
                    </address>
                </div>
            </div>
            <div class="uk-width-small-1-2" style="padding-top: -90px;">
                <div class="uk-width-small-1-1">
                    <p style="text-align: right; width: 99%; margin: 0; padding: 0;" class="uk-text-small uk-margin-right-remove">Amount Received</p>
                    <h2 style="text-align: right; width: 99%;color: green;margin: 0" class="uk-margin-top-remove">
                        <?php $amount = $paymentreceive->amount;?>
                        BDT <?php echo number_format((float)$amount, 2, '.', '');?></h2>
                </div>
                <div class="uk-width-small-1-1">
                    <p style="text-align: right; width: 99%;margin: 5px;padding: 0" class="uk-margin-top-remove">Payment Date : {{$paymentreceive->updated_at->format('d-m-Y')}}</p>
                    <p style="text-align: right; width: 99%;margin: 0;padding: 0" class="uk-margin-top-remove">Reference Number: {{$paymentreceive->reference}}</p>
                    <p style="text-align: right; width: 99%;margin: 0;padding: 0" class="uk-margin-top-remove">Payment Mode: {{$paymentreceive->PaymentMode->mode_name}}</p>
                </div>
            </div>
        </div>
        <br>

        <div class="uk-grid">
            <div class="uk-width-small-1-2 uk-row-first">
                <div class="uk-margin-bottom">
                    <span class="uk-text-muted uk-text-small uk-text-italic"  style="margin: 5px 0px;padding: 0">Over payment:</span>
                    <address>
                        <p  style="margin: 0px 0;padding: 0"><strong>{{$paymentreceive->excess_payment}}</strong></p>
                    </address>
                </div>
            </div>
        </div>
        <div class="uk-grid uk-margin-large-bottom" style="font-size: 12px;padding-top: 20px">
            <table width="700px">
                <thead>
                <tr>
                    <th style="text-align: center" width="20%">Invoice Number</th>
                    <th style="text-align: center">Invoice Date</th>
                    <th style="text-align: center">Invoice Amount </th>
                    <th style="text-align: center">Payment Amount</th>
                </tr>
                </thead>
                <tbody>
                <tbody>
                @foreach($paymentreceive->PaymentReceiveEntryData as $PREData)
                    @foreach($invoice as $invoiceData)
                        @if($PREData->invoice_id == $invoiceData->id)
                            <tr class="uk-table-middle">
                                <td style="text-align: center"> INV-{{ str_pad($invoiceData->invoice_number, 6, '0', STR_PAD_LEFT) }}</td>
                                <td style="text-align: center">{{$invoiceData->updated_at->format('d-m-Y')}}</td>
                                <td style="text-align: center">{{$invoiceData->total_amount}}</td>
                                <td style="text-align: center">{{$PREData->amount}}</td>
                            </tr>

                        @endif
                    @endforeach
                @endforeach
                </tbody>

            </table>
        </div>
        <br>
    </div>
</div>

</body>

</html>
