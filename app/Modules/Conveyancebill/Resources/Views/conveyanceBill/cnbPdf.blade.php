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

    </style>
</head>

@inject('theader', '\App\Lib\TemplateHeader')


<body class="sidebar_main_open sidebar_main_swipe header_double_height" style="margin-top: 10px;margin-bottom: 40px">

@if($theader->getBanner()->headerType)
    <div class="" style="text-align: center;">

    <img src="{{ asset($theader->getBanner()->file_url) }}" height="100%" width="100%">
    </div>
@else
    <div style="text-align: center; line-height: 100%;">
        <h1 style="width: 100%;"><img style="text-align: center;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="45" width="71"/> {{ $OrganizationProfile->company_name }}</h1>
        <div style="padding-top: -25px; text-align: center;">
        {{ $OrganizationProfile->street }},{{ $OrganizationProfile->city }},{{ $OrganizationProfile->state }},{{ $OrganizationProfile->country }}
        <br>{{ $OrganizationProfile->email }},{{ $OrganizationProfile->contact_number }}
    </div>
        

    </div>
    
@endif
<br/>
<h2 style="text-transform: uppercase;margin: 0;padding: 0;text-align: center;font-weight: 300;font-size: 17px;"> <span style="border: 2px solid black;
    padding: 20px 30px;
    border-radius: 2px;">Conveyance Bill</span></h2>


<br>
<div id="header">
    
        <div class="row">
            <div class="col-md-4"> 
                Name: {{ $conveyance->user->name }}
            </div>
            <div class="col-md-4">
                Date: {{ date('d-m-Y', strtotime($conveyance->date)) }}
            </div>
        </div>
    

</div>

<br>

<div class="uk-width-large-6-10">
    <div class="md-card-content invoice_content print_bg" style="margin-top: 10px;">

        <div class="uk-grid uk-margin-large-bottom" style="font-size: 12px;">
            <table>
                <thead>
                <tr>
                    <th style="text-align: center" width="10%">From</th>
                    <th style="text-align: center">To</th>
                    <th style="text-align: center">Transport</th>
                    <th style="text-align: center">Amount</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list as $all)
                <tr>
                    <td style="text-align: center;width: 30%">{{ $all->from }}</td>
                    <td style="text-align: center;width: 40%">{{ $all->to }}</td>
                    <td style="text-align: center;width: 15%">{{ $all->transport }}</td>
                    <td style="text-align: center;width: 15%">{{ $all->amount }}</td>
                </tr>
                @endforeach

                <?php
                    $helper = new \App\Lib\Helpers;

                ?>
                
                <tr>
                    <td style="width: 30%;border: none;padding-top: 15px" colspan="2">Taka In Word: {{ ucfirst($numberTransformer->toWords($sum)) }} Taka Only</td>
                    <td style="text-align: center;width: 15%">Total Taka</td>
                    <td style="text-align: center;width: 15%">{{ $sum }}</td>
                </tr>
                </tbody>

            </table>
        </div>
        <br>
        <br>
        <br>

        <div id="header">
            <div class="col-md-4" style="float: left;font-size: 12px">
                {{ $conveyance->user->name }}
                <p style="text-decoration: overline;">Prepared by</p>
            </div>

            @if(isset($conveyance->checkBy))
                @if(!empty($conveyance->comments))
                <div class="col-md-4" style="float: left;margin-left: 140px;margin-top:-14px;font-size: 12px">
                    {{ $conveyance->checkBy->name }}
                    <br>({{ $conveyance->comments }})
                    <p style="text-decoration: overline;">Checked by</p>
                </div>
                @else
                <div class="col-md-4" style="float: left;margin-left: 140px;font-size: 12px">
                    {{ $conveyance->checkBy->name }}
                    <p style="text-decoration: overline;">Checked by</p>
                </div>
                @endif
            @else
            <div class="col-md-4" style="float: left;margin-left: 140px;margin-top:13px;font-size: 12px">
                <p style="text-decoration: overline;">Checked by</p>
            </div>
            @endif

            @if(isset($conveyance->approveBy))
            <div class="col-md-4" style="float: left;margin-left: 140px;font-size: 12px">
                {{ $conveyance->approveBy->name }}
                <p style="text-decoration: overline;">Approved by</p>
            </div>
            @else
            <div class="col-md-4" style="float: left;margin-left: 140px;margin-top:13px;font-size: 12px">
                <p style="text-decoration: overline;">Approved by</p>
            </div>
            @endif
            
            @if(isset($conveyance->approveByChireman))
            <div class="col-md-4" style="float: left;margin-left: 100px;font-size: 12px">
                {{ $conveyance->approveByChireman->name }}
                <p style="text-decoration: overline;">Approved by Chairman</p>
            </div>
            @else
            <div class="col-md-4" style="float: left;margin-left: 100px;margin-top:13px;font-size: 12px">
                <p style="text-decoration: overline;">Approved by Chairman</p>
            </div>
            @endif

        </div>


    </div>
</div>

</body>

</html>
