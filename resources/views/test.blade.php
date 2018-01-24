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

    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{!! asset('css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

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

        td {

            height: 2em;
            border: 1px solid #ccc;

        }
        #header_table tr td{
           border: none;
            text-align: right;
        }
        #header_ tr td{
           border: none;
            padding: 0;
            margin: 0;
            float: left;
            text-align: left;

        }
        #header_code tr td{
            border: none !important;
        }
        #inertable tr td{

            border: 1px solid black;

        }



    </style>
</head>

<body style="margin-top: 150px;margin-bottom: 40px;font-family: freeserif; font-size: 10pt;">

<div id="header">

    <div class="" style="text-align: center;">
        <p style="text-transform: uppercase;font-size: 30px;color: #6BBD71;font-weight: 900">চালান ফরম</p>

    </div>
    <div class="row">

            <table id="header_table">
                <tr>
                    <td style="padding-right: 100px;font-size: 15px">টি , আর ফরম নং ৬ (এস , আর ৩৭ দ্রষ্টব্য)</td>
                    <td style="width: 30%">
                        <table id="inertable">
                            <tr>
                                <td style="text-align: center;border-right: none">১ম (মূল) কপি</td>
                                <td style="text-align: center;border-left: none;border-right: none">২য় কপি</td>
                                <td style="text-align: center;border-left: none">৩য় কপি</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>


    </div>

    <div>
        <div class="col-md-4">
            <h4 style="padding-left: 250px">চালান নং................................................তারিখ:......................................</h4>
            <br>
            <h4 style="padding-left: 100px;padding-top: -30px">বাংলাদেশ ব্যাংক সোনালী ব্যাংকের ...................................................জেলার:.................................................. শাখার টাকা জমা দেওয়ার চালান।</h4>
        </div>
    </div>

    <div class="row">
        <table id="header_code" style="width: 50%;margin-left: 16px;text-align: center;">
            <tr>
                <td>
                    <span>কোড নং</span>
                </td>
                <td style="border: 1px solid black">
                    <span>১</span>
                </td>
                <td style="padding-left: 10px"></td>
                <td >
                    <table id="inertable">
                        <tr>
                            <td>১</td>
                            <td>১</td>
                            <td>৪</td>
                            <td>১</td>
                        </tr>
                    </table>
                </td>
                <td style="padding-left: 10px"></td>
                <td>
                    <table id="inertable">
                        <tr>
                            <td>০</td>
                            <td>০</td>
                            <td>০</td>
                            <td>৫</td>
                        </tr>
                    </table>
                </td>
                <td style="padding-left: 10px"></td>
                <td>
                    <table id="inertable">
                        <tr>
                            <td>০</td>
                            <td>১</td>
                            <td>১</td>
                            <td>১</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        </div>
    </div>

<br>


<div class="uk-width-large-6-10">
    <div class="md-card-content invoice_content print_bg">

        <div class="uk-grid uk-margin-large-bottom" style="font-size: 12px;">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td colspan="4" style="text-align: center">জমা প্রদানকারী কর্তৃক পূরণ করিতে হইবে</td>
                    <td colspan="2" style="text-align: center">টাকার অংক</td>
                    <td rowspan="2" style="text-align: center">বিভাগের নাম এবং চালানের পৃষ্ঠাঙ্কনকারী কর্মকর্তার নাম,পদবী ও দপ্তর</td>
                </tr>
                <tr>
                    <td style="text-align: center;width: 15%">যার মারফত প্রদত্ত হইলে তাহার নাম ও ঠিকানা</td>
                    <td style="text-align: center;width: 25%">যে ব্যক্তির/প্রতিষ্ঠানের পক্ষ হইতে টাকা প্রদত্ত হইলে তাহার নাম,পদবী ও ঠিকানা</td>
                    <td style="text-align: center;width: 15%">কি বাবদ জমা দেওয়া হইল তাহার বিবরন</td>
                    <td style="text-align: center;width: 15%">মুদ্রা ও নোটের বিবরন /ড্রাফ্‌ট-পে-অর্ডার ও চেকের বিবরন </td>
                    <td style="text-align: center;width: 8%">টাঁকা</td>
                    <td style="text-align: center;width: 5%">পয়সা</td>
                </tr>
                <tr>
                    <td style="text-align: center;" rowspan="2"></td>
                    <td style="text-align: center;" rowspan="2"></td>
                    <td style="text-align: center;" rowspan="2">ধারা -53B মোতাবেক জনশক্তি রপ্তানি হইতে উৎসে কর্তিত আইকর</td>
                    <td style="text-align: center;">নগদ</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                </tr>
                <tr>
                    <td style="text-align: center;">মোট টাঁকা</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>

                </tr>
                <tr>
                    <td style="" colspan="4">টাকা ( কথাই )</td>
                    <td style="text-align: center;" colspan="3"></td>

                </tr>
                <tr>
                    <td colspan="4">টাকা পাওয়া গেল</td>
                    <td style="text-align: center;" colspan="3" rowspan="3">ম্যানেজার
                        <br>
                        বাংলাদেশ / সুনালী ব্যাংক
                    </td>

                </tr>

                <tr>
                    <td style="border-right: 0px solid white" colspan="4"> তারিখ ...................................... <br>
                    </td>


                </tr>


                </tbody>
            </table>
            <p style="padding-top: 20px;font-size: 15px"> নোট : ১। <span>সংশ্লিষ্ট দপ্তরের সহিত যোগাযোগ করিয়া সঠিক কোড নাম্বার জানিয়া লইবেন । </span></p>
            <p style="margin: 0;padding: 0;padding-left: 25px;font-size: 15px"> ২ ।  <span> যে সকল ক্ষেত্রে কর্মকর্তা কর্তৃক পৃষ্ঠাঙ্কন প্রয়োজন , সে সকল ক্ষেত্রে প্রযোজ্য হইবে । </span></p>
            <p style="margin: 0;padding: 0;font-size: 15px"> বাঃ সঃ মুঃ - ৯৭/৯৮-১৮০৫০ এফ (কম-১)-১,৫০,০০,০০০ কপি (সি-৬৮) ১৯৯৮ । </p>
        </div>

    </div>
</div>

</body>

</html>
