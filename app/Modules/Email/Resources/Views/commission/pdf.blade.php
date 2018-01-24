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
                <h2 style="margin: 0;padding: 0">Sales Commission</h2>
                <p style="margin: 0;padding: 0">SC-{{ str_pad($salescommission->scNumber,6,'0',STR_PAD_LEFT) }}</p>
            </div>
        </div>
    </div>
</div>

<div id="footer">

    <div class="uk-grid">
        <div class="uk-width-1-2">
            <p class="uk-text-small uk-margin-bottom">Looking forward for your business.</p>
        </div>
    </div>
    <br>

    <div class="uk-grid">
        <div class="uk-width-1-2" style="text-align: left">
            <p class="uk-text-small uk-margin-bottom">Customer Signature</p>
        </div>
        <div class="uk-width-1-2" style="text-align: right;padding-top: -55px">
            <p class="uk-text-small uk-margin-bottom">Company Representative</p>
        </div>
    </div>

</div>

<hr>
<div class="uk-width-large-6-10">
    <div class="md-card-content invoice_content print_bg" style="margin-top: 10px;">
        <div class="user_content" style="padding-left: 85px">
            <div class="uk-margin-top">

            <div class="row">
                <div style="margin: 0;padding: 0">
                    <p style="margin: 0;padding: 0;text-transform: uppercase">Paid To</p>
                </div>
                <div style="margin: 0;padding: 0;padding-top: -20px">
                        <p style="margin: 0;padding: 0;text-transform: uppercase;padding-left: 350px">{{ $salescommission->Agents->display_name }}</p>
                </div>
            </div>
                <br>

                <div class="row" style="margin: 0;padding: 0">
                    <div style="margin: 0;padding: 0">
                        <p style="margin: 0;padding: 0;text-transform: uppercase">Date</p>
                    </div>
                    <div style="margin: 0;padding: 0;padding-top: -20px">
                        <p style="margin: 0;padding: 0;text-transform: uppercase;padding-left: 350px">{{ $salescommission->date }}</p>
                    </div>
                </div>
                <br>

                <div class="row" style="margin: 0;padding: 0">
                    <div>
                        <p style="margin: 0;padding: 0;text-transform: uppercase">Amount Paid</p>
                    </div>
                    <div style="margin: 0;padding: 0;padding-top: -20px">
                        <p style="margin: 0;padding: 0;text-transform: uppercase;padding-left: 350px">BDT {{ $salescommission->amount }}</p>
                    </div>
                </div>

                <br>

                <div class="row" style="margin: 0;padding: 0">
                    <div>
                        <p style="margin: 0;padding: 0;text-transform: uppercase">Total  Payable</p>
                    </div>
                    <div style="margin: 0;padding: 0;padding-top: -20px">
                        <p style="margin: 0;padding: 0;text-transform: uppercase;padding-left: 350px">BDT {{ $balance }}</p>
                    </div>
                </div>

                <br>

                <div class="row" style="margin: 0;padding: 0">
                    <div>
                        <p style="margin: 0;padding: 0;text-transform: uppercase">Total  Balance</p>
                    </div>
                    <div style="margin: 0;padding: 0;padding-top: -20px">
                        <p style="margin: 0;padding: 0;text-transform: uppercase;padding-left: 350px">BDT {{ $balance-$salescommission->amount }}</p>
                    </div>
                </div>

                @if($salescommission->paid_through_id == 4)

                    @if(is_null($salescommission->show))
                        <div class="row" style="margin: 0;padding: 0">
                            <div>
                                <p style="margin: 0;padding: 0;text-transform: uppercase">Paid Through</p>
                            </div>
                            <div style="margin: 0;padding: 0;padding-top: -20px">
                                <p style="margin: 0;padding: 0;text-transform: uppercase;padding-left: 350px">{{ $salescommission->Account->account_name }}</p>
                            </div>
                        </div>
                    @else

                        <div class="row" style="margin: 0;padding-top: 20px">
                            <div>
                                <p style="margin: 0;padding: 0;text-transform: uppercase">Paid Through</p>
                            </div>
                            <div style="margin: 0;padding: 0;padding-top: -20px">
                                <p style="margin: 0;padding: 0;text-transform: uppercase;padding-left: 350px">{{ $salescommission->Account->account_name }}</p>
                            </div>
                        </div>

                        <div class="row" style="margin: 0;padding-top: 20px">
                            <div>
                                <p style="margin: 0;padding: 0;text-transform: uppercase">Details</p>
                            </div>
                            <div style="margin: 0;padding: 0;padding-top: -20px">
                                <p style="margin: 0;padding: 0;text-transform: uppercase;padding-left: 350px">{{ $salescommission->bank_info }}</p>
                            </div>
                        </div>

                    @endif
                @else

                    <div class="row" style="margin: 0;padding: 0">
                        <div>
                            <p style="margin: 0;padding: 0;text-transform: uppercase">Paid Through</p>
                        </div>
                        <div style="margin: 0;padding: 0;padding-top: -20px">
                            <p style="margin: 0;padding: 0;text-transform: uppercase;padding-left: 350px">{{ $salescommission->Account->account_name }}</p>
                        </div>
                    </div>
                @endif

                <div class="uk-grid" style="padding-top: 30px">
                    <div class="uk-width-1-1">
                        <span class="uk-text-muted uk-text-small uk-text-italic">Notes: &nbsp;&nbsp; {{ $salescommission->CustomerNote }}</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

</body>

</html>
