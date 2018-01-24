<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


</head>
<style type="text/css">
    {{ $bootstrap.'<br/>'.$style }}    
</style>

<body style="font-family: freeserif; font-size: 10pt;">

<?php $convert=new \App\Lib\Helpers() ?>

<div class="theme-showcase" role="main">

    <div class="app" style="padding-top: 150px">
        <h4 class="pull-right" style="padding-right: 50px;text-align: right;">তারিখঃ{!! $convert->englishtobangla($immigration->applicationDate) !!}</h4>
        <h4>বরাবর,</h4>
        <h4>মহাপরিচালক</h4>
        <h4>জনশক্তি,কর্মসংস্থান ও প্রশিক্ষণ ব্যুরো</h4>
        <h4>৭১-৭২,পুরাতন-এলিফ্যান্ট রোড,</h4>
        <h4>নিউ ইস্কাটন রোড,ঢাকা-১০০০ ।</h4>


        <h4>দৃষ্টি আকর্ষণ : পরিচালক (বহির্গমন) ।</h4>
        <br>

        <h4>বিষয়ঃ {!! $immigration->country_name !!}গামী {!! $convert->bn2enNumber($immigration->total_person) !!}({!! $convert->number($immigration->total_person) !!})জন {!! $immigration->gender !!} বহির্গমন ছাড়পত্রের জন্য আবেদন ।</h4>
        <br>

        <h4>জনাব,</h4>
        <div class="content">
            <p>
                {!! $immigration->country_name !!}গামী বিভিন্ন নিয়োগকর্তার অধীনে  {!! $convert->bn2enNumber($immigration->total_person) !!}({!! $convert->number($immigration->total_person) !!}) জন {!! $convert->number($immigration->gender) !!} ভিসা সংগ্রহ করিয়াছি। ভিসা গুলো সঠিক আছে। উক্ত সৌদি আরবগামী কর্মীদের বেতন ভাতা ও অনন্যা কাগজপত্র সঠিক আছে। কর্মীদের যদি সেখানে কোনরুপ অসুবিধার সম্মুখীন হয় তবে আমার রি/এজেন্সি তাহার সম্পূর্ণ দায় দায়িত্ব বহন করিবে।

            </p>
            <br>
            <p>
                এমতাবস্থায় উক্ত {!! $convert->bn2enNumber($immigration->total_person) !!}({!! $convert->number($immigration->total_person) !!}) জন {!! $convert->number($immigration->gender) !!} বহির্গমন ছাড়পত্র প্রদানের জন্য আপনাকে বিশেষ ভাবে অনুরোধ করিতেছি।
            </p>
        </div>

        <br>

        <h4>ধন্যবাদান্তে</h4>

        <h4>{!! $formbasis->ownerNameBN !!}</h4>
        <h4>{!! $formbasis->ownerDesignationBN !!}</h4>

    </div>

<?php

        $immi=new \App\Lib\Helpers();

    ?>


    <div class="popup" style="padding-top: 230px">
        <div class="content">
            <p style="line-height: 30px;font-size: 18px;">/ রিক্রুটিং এজেন্সি <span style="font-size: 18px">{!! $formbasis->companyNameBN !!}({!! $formbasis->licenceBN !!})</span>, {!! $formbasis->country_name !!} চাকুরী নিয়ে গমনের উদ্দেশে {!! $immi->englishtobangla($immigration->applicationDate) !!} ইং তারিখে মোট {!! $immigration->country_name !!} {!! $immi->bn2enNumber($immigration->total_person) !!} ({!! $immi->number($immigration->total_person) !!}) {!! $convert->number($immigration->gender) !!} ভিসার বহির্গমন ছাড়পত্রের আবেদন করেছেন।
            </p>
        </div>
        <br>
        <h4 style="text-decoration: underline;text-align: center;">{!! $immigration->country_name !!}গামী {!! $immi->bn2enNumber($immigration->total_person) !!} ({!! $immi->number($immigration->total_person) !!}) জন কর্মীর তালিকা</h4>
        <br>

        <table class="table table-bordered">
            <thead>
            <tr>
                <td style="height: 40px;text-align: center">ক্রমিক নং</td>
                <td style="height: 40px;text-align: center">কর্মীর নাম</td>
                <td style="height: 40px;text-align: center">পাসপোর্ট নং</td>
                <td style="height: 40px;text-align: center">জন্ম তারিখ</td>
                <td style="height: 40px;text-align: center">ভিসা অ্যাডভাইস নম্বর</td>
                <td style="height: 40px;text-align: center">পেশা</td>

            </tr>
            </thead>
            <tbody>

            <?php
            $i=1;
            $contact= new \App\Lib\Immigration();

            ?>

            @foreach($immigrationpax as $value)
            <tr>
                <td style="height: 30px;text-align: center">{!! $i++ !!}</td>
                <td style="height: 30px;text-align: center">{!! $contact->contact($value->pax_id)->passenger_name !!}</td>
                <td style="height: 30px;text-align: center">{!! $contact->contact($value->pax_id)->passportNumber !!}</td>
                <td style="height: 30px;text-align: center">{!! $contact->recruit_customer($value->pax_id)->dateOfBirthEN !!}</td>
                <td style="height: 30px;text-align: center">{!! $contact->recruit_customer($value->pax_id)->visaAdvice !!}</td>
                <td style="height: 30px;text-align: center">{!! $contact->recruit_customer($value->pax_id)->professionEn !!}</td>
            </tr>
                @endforeach

            </tbody>
        </table>

        <div class="content">
            <p style="line-height: 30px;font-size: 18px;">
              / আবেদন পত্রের সাথে রি/এজেন্সি বিধি মোতাবেক ভিসার ফটোকপি ও বিএমইটি কর্তৃক মূল প্রশিক্ষন সনদ , পাসপোর্টর ফটোকপি এবং অন্যান্য কাগজপত্র দাখিল করেছে। কর্মীর ভিসা ও অন্যান্য কাগজপত্রের সঠিকতা সম্পর্কে রি/এজেন্সি নিজ অফিস প্যাডে এবং {!! $immigration->stampFee !!}/- টাকার নন-জুডিশিয়াল স্ট্যাম্পে অঙ্গীকারনামা দাখিল করেছে। রি/এজেন্সি অঙ্গীকারনামায় উল্লেখ করেছে যে, উল্লেখিত কর্মী একক ভিসাই বিদেশে কাজ নিয়ে যাচ্ছে , এখানে কোনরূপ দলীয় (গ্রুপ) ভিসা ভাঙ্গা হইনি। কর্মীকে বিদেশ প্রেরনের পর কোন অসুবিধা হলে তাদের দেশে ফেরত আনাসহ রি/এজেন্সি ক্ষতিপূরণ প্রদান করবে। কর্মী {!! $immigration->stampFee !!}/- টাকার নন-জুডিশিয়াল স্ট্যাম্পে অঙ্গীকারনামা ও চুক্তিনামা দাখিল করেছে। রি/ লাইসেন্সটি {!! $immigration->licenseValidity !!} ইং সাল পর্যন্ত নবায়ন আছে।
            </p>
        </div>
        <br>

        <h4 style="line-height: 30px;font-size: 18px; margin-left: 30px;"> / দাখিলকৃত ভিসার সঠিকতা উল্লেখ পূর্বক উক্ত ভিসা একক কিনা যাচাইয়ের নিমিত্তে নথিখানা অনুবাদ শাখায় প্রেরন করা যেতে পারে।</h4>
    </div>


    <div class="popup_3">
        <div class="content">
            <p style="line-height: 30px;font-size: 18px;">
                / নোটানুছেদ  ............... হতে ...............পর্যন্ত সদয় দেখা যেতে পারে। {!! $immigration->authentication !!}
            </p>
            <p style="line-height: 30px;font-size: 18px;">
                / সংশ্লিষ্ট রি/ এজেন্সি কর্তৃক {!! $immigration->country_name !!}গামী {!! $immi->bn2enNumber($immigration->total_person) !!} ({!! $immi->number($immigration->total_person) !!}) জন কর্মীর অনুকুলে বহির্গমন ছাড়পত্র প্রাপ্তির নিমিত্ত সরকার নির্ধারিত আয়কর , কল্যাণ ফি এবং স্মার্ট কার্ড বাবদ প্রদত্ত পে-অর্ডার ও চালান অত্র শাখায় জমা প্রদান করেছেন । যার তথ্য নিম্নে সন্নিবেশিত করা হল। দাখিলকৃত ভিসা সমূহ গ্রুপভুক্ত নহে।
            </p>
        </div>
        <br>

        <table class="table table-bordered">
            <thead>
            <tr style="text-align: center">
                <td style="height: 40px;text-align: center;width: 10%">ফি সমূহ</td>
                <td style="height: 40px;text-align: center">জনপ্রতি হার</td>
                <td style="height: 40px;text-align: center;width: 10%">কর্মীর সংখ্যা</td>
                <td style="height: 40px;text-align: center;width: 10%">মোট টাকা</td>
                <td style="height: 40px;text-align: center;width: 30%">পে অর্ডার নং তারিখ,ব্যাংক ও শাখার নাম</td>
                <td style="height: 40px;text-align: center;width: 20%">মন্তব্য (সমন্বয়ের ক্ষেত্রে)</td>

            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="height: 30px;text-align: center">কল্যাণ ফি</td>
                <td style="height: 30px;text-align: center">{!! $immi->bn2enNumber($immigration->unitWelfareFee) !!}/-</td>
                <td style="vertical-align:middle;text-align: center;" rowspan="3">{!! $immi->bn2enNumber($immigration->total_person) !!} জন </td>
                <td style="height: 30px;text-align: center">{!! $immi->bn2enNumber(($immigration->unitWelfareFee)*($immigration->total_person)) !!}/-</td>
                <td style="vertical-align:middle;text-align: center;" rowspan="3">{!! $immi->englishtobangla($immigration->applicationDate) !!}
                    <br> {!! $immigration->payOrderDetails !!}</td>
                <td style="height: 30px;text-align: center">{!! $immigration->WelfareComment !!}</td>
            </tr>
            <tr style="height: 100px;text-align: center">
                <td style="vertical-align: middle;height: 60px;text-align: center">আয়কর</td>
                <td style="height: 60px;text-align: center">
                    <h5>{!! $immi->bn2enNumber($immigration->unitIncomeTaxNAFee) !!}/-</h5>
                    <p>(অসত্যায়িত ভিসার ক্ষেত্রে)</p>
                    <h5>{!! $immi->bn2enNumber($immigration->unitIncomeTaxSAFee) !!}/-</h5>
                    <p>(শুধু মাত্র সৌদি আরব ক্ষেত্রে)</p>
                </td>
                <td style="vertical-align: middle;height: 60px;text-align: center">
                    @if($immigration->incomeTaxType==0)
                        {!! $immi->bn2enNumber(($immigration->unitIncomeTaxNAFee)*($immigration->total_person)) !!}/-
                        @else
                        {!! $immi->bn2enNumber(($immigration->unitIncomeTaxSAFee)*($immigration->total_person)) !!}/-
                    @endif
                </td>
                <td style="vertical-align: middle;height: 60px;text-align: center">{!! $immigration->incomeTaxComment !!}</td>

            </tr>
            <tr>
                <td style="height: 30px;text-align: center">স্মার্ট কার্ড ফি</td>
                <td style="height: 30px;text-align: center">{!! $immi->bn2enNumber($immigration->unitSmartCardFee) !!}/-</td>
                <td style="height: 30px;text-align: center">{!! $immi->bn2enNumber(($immigration->unitSmartCardFee)*($immigration->total_person)) !!}/-</td>
                <td style="height: 30px;text-align: center">{!! $immigration->SmartCardComment !!}</td>

            </tr>
            </tbody>
        </table>

        <div class="content">
            <p style="line-height: 30px;font-size: 18px;">
               / এমতাবস্থায় সংশ্লিষ্ট রিক্রুটিং এজেন্সী কর্তৃক আবেদনকৃত {!! $immi->bn2enNumber($immigration->total_person) !!} ({!! $immi->number($immigration->total_person) !!}) জন সৌদি আরবগামি পুরুষ কর্মীর একক বহির্গমন ছাড়পত্র অনুমোদন করা যেতে পারে।
            </p>
        </div>
    </div>

</div> <!-- /container -->

</body>
</html>