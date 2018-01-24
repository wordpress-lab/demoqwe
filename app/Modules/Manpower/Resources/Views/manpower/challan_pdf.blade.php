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


    <title>@yield('title','Challan Pdf')</title>



    <style>

        {{ $bootstrap }}

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

        div {
            text-align: justify;
            text-justify: inter-word;
        }

        body{
            margin: 0;
            padding: 0;
            font-family: 'AdorshoLipi', Arial, sans-serif !important;

            text-align: justify;
            text-justify: inter-word;

        }
        .app{
            margin-top: 500px;
        }
        .content{

            font-size: 18px;
        }
        .potro_1{
            margin-top: 40px;
        }

        .document{

            margin-top: 50px;

        }
        .popup{

            padding-top: 200px;
        }
        .popup_3{

            padding-top: 230px;
        }

        .st{
            width: 500px;
        }



    </style>
</head>

<body style="margin-top: 150px;margin-bottom: 40px;font-family: freeserif; font-size: 10pt;">

{{--<div style="padding-top: 150px"></div>--}}
<!-- 2nd Page -->
@for($i=0;$i<3;$i++)
@if($i==0)
<div>
@else
<div style="page-break-before: always;">
@endif
    <div id="header">

        <div class="" style="text-align: center; line-height: 10px;">
            <p style="text-transform: uppercase;font-size: 30px;color: black;font-weight: 900">চালান ফরম</p>

        </div>
        <div class="row">

                <table id="header_table">
                    <tr>
                        <td style="padding-right: 100px;font-size: 15px">টি , আর ফরম নং ৬ (এস , আর ৩৭ দ্রষ্টব্য)</td>
                        <td style="width: 30%">
                            <table id="inertable">
                                <tr>
                                    <td style="text-align: center;">১ম (মূল) কপি</td>
                                    <td style="text-align: center;border-left: none;">২য় কপি</td>
                                    <td style="text-align: center;border-left: none">৩য় কপি</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>


        </div>
        <?php $helper=new \App\Lib\Helpers() ?>
        <div>
            <div class="col-md-4">
                <h4 style="padding-left: 350px">চালান নং <span style="border-bottom: 1px dotted #000;
        text-decoration: none;">&nbsp;&nbsp;&nbsp;{!! $challan->challanNo !!}&nbsp;&nbsp;&nbsp;</span> &nbsp;&nbsp;&nbsp; তারিখ:&nbsp;&nbsp;&nbsp;<span style="border-bottom: 1px dotted #000;
        text-decoration: none;">{!! $helper->englishtobangla($challan->challanDate) !!}</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4>
                <br>
                <h4 style="padding-left: 220px;padding-top: -30px">বাংলাদেশ ব্যাংক/ সোনালী ব্যাংকের &nbsp;&nbsp; <span style="border-bottom: 1px dotted #000;
        text-decoration: none;">{!! $challan->district !!}</span> &nbsp;&nbsp;জেলার:&nbsp;&nbsp;&nbsp; <span style="border-bottom: 1px dotted #000;
        text-decoration: none;">{!! $challan->branch !!}</span> &nbsp;&nbsp; শাখার টাকা জমা দেওয়ার চালান।</h4>
            </div>
        </div>

        <div class="row">
            <table id="header_code" style="width: 50%;margin-left: 16px;text-align: center;">
                <tr>
                    <td>
                        <span>কোড নং</span>
                    </td>
                    <td style="border: 1px solid black ">
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
                        <td rowspan="2" style="text-align: center; width: 90px; padding: 0px 2px 0px 2px; ">বিভাগের নাম এবং চালানের পৃষ্ঠাঙ্কনকারী কর্মকর্তার নাম,পদবী ও দপ্তর</td>
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
                        <td style="text-align: center;" rowspan="2">{!! $challan->fromAddress !!}</td>
                        <td style="text-align: center;" rowspan="2">{!! $challan->organizationAddress !!}</td>
                        <td style="text-align: center;" rowspan="2">ধারা -53B মোতাবেক জনশক্তি রপ্তানি হইতে উৎসে কর্তিত আয়কর</td>
                        <td style="text-align: center;">
                            নগদ
                            <br>
                            {!! $helper->bn2enNumber($challan->rate_1) !!} x  {!! $helper->bn2enNumber($challan->quantity_1) !!}
                            <br>
                            {!! $helper->bn2enNumber($challan->rate_2) !!} x  {!! $helper->bn2enNumber($challan->quantity_2) !!}
                            <br>
                            {!! $helper->bn2enNumber($challan->rate_3) !!} x  {!! $helper->bn2enNumber($challan->quantity_3) !!}
                        </td>

                       @php
                            $first_total=$challan->rate_1*$challan->quantity_1;
                            $second_total=$challan->rate_2*$challan->quantity_2;
                            $third_total=$challan->rate_3*$challan->quantity_3;
                            $total=$first_total+$second_total+$third_total;

                            $explod=explode('.',$total);
                            $one=$explod[0];
                            $two=$explod[1];
                       @endphp

                        <td style="text-align: center;">{!! $helper->bn2enNumber($one) !!}</td>
                        <td style="text-align: center;">{!! $helper->bn2enNumber($two) !!}০</td>
                        <td style="text-align: center;"></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">মোট টাঁকা</td>
                        <td style="text-align: center;">{!! $helper->bn2enNumber($one) !!}</td>
                        <td style="text-align: center;">{!! $helper->bn2enNumber($two) !!}০</td>
                        <td style="text-align: center;"></td>

                    </tr>
                    <tr>
                        <td style="" colspan="4">টাকা ( কথায় ) : {!! $challan->amount_bangla !!}</td>
                        <td style="text-align: center;" colspan="3"></td>

                    </tr>
                    <tr>
                        <td colspan="4">টাকা পাওয়া গেল</td>
                        <td style="text-align: center;" colspan="3" rowspan="3">ম্যানেজার
                            <br>
                            বাংলাদেশ ব্যাংক/ সোনালী ব্যাংক
                        </td>
                    </tr>

                    <tr>
                        <td style="border-right: 0px solid white" colspan="4"> তারিখ : {!! $helper->englishtobangla($challan->challanDate) !!} <br>
                        </td>
                    </tr>


                    </tbody>
                </table>
                <p style="padding-top: 20px;font-size: 15px"> নোট : ১। <span>সংশ্লিষ্ট দপ্তরের সহিত যোগাযোগ করিয়া সঠিক কোড নাম্বার জানিয়া লইবেন । </span></p>
                <p style="margin: 0;padding: 0;padding-left: 25px;font-size: 15px"> ২ ।  <span> যে সকল ক্ষেত্রে কর্মকর্তা কর্তৃক পৃষ্ঠাঙ্কন প্রয়োজন , সে সকল ক্ষেত্রে প্রযোজ্য হইবে । </span></p>
                
            </div>

        </div>
    </div>
</div>
@endfor

</body>

</html>
