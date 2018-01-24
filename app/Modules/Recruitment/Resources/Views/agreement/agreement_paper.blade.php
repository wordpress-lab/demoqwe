<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


    <style>
        {{ $bootstrap.'<br/>'.$style }}

        tr,th {
            border: 1px solid;
        }
        tr,td{
            border: 1px solid;
            text-align: center;
        }

    </style>

</head>
<body style="font-family: freeserif; font-size: 10pt;">
<div role="main">
    <div class="app" style="padding-top: 300px;">
        <h2 style="text-align: center;text-decoration: underline">অঙ্গীকারনামা</h2>
        <br>
        <br>
        <br>

        <div class="content">
            <p>সম্মান প্রদর্শন পূর্বক নিবেদন এই যে ,আমি নিম্ন স্বাক্ষরকারী ,{!! $formbasis->ownerNameBN !!},{!! $formbasis->ownerDesignationBN !!} {!! $formbasis->companyNameBN !!} ({!! $formbasis->licenceBN !!}) ,({!! $formbasis->addressBN !!})।
              উক্ত {!! $agreement['0']->gender !!} তাদের কর্মস্থলে যাবতীয় বিষয়াদি, বেতন, অবস্থান, থাকা, খাওয়া ও সামাজিক নিরাপত্তা সম্পর্কে নিশ্চিত হইয়াছেন । তারপরও আমি এই মর্মে অঙ্গীকার করতেছি যে,{!! $agreement['0']->country_name !!} অবস্থিত {!! $agreement['0']->gender !!} কর্মীর সমস্ত দায় দায়িত্ব আমি বহন করিব।
            </p>
        </div>
        <br>
    </div>



    <div class="app" style="padding-top: 200px;">

        <h2 style="text-align: center;text-decoration: underline">(পাতা-২)</h2>
        <br>
        <br>
        <br>

        <div class="content">
            <p>আমি এই মর্মে আরও অঙ্গীকার করিতেছি যে , {!! $agreement['0']->country_name !!} অবস্থিত {!! $agreement['0']->gender !!} কর্মস্থলে বেতন ,থাকা-খাওয়া ও অন্যান্য সুযোগ সুবিধার ব্যাপারে নিশ্চিত হইয়া তাহাদেরকে পাঠাইতেছি। তাহাদের কর্মস্থলে চাকুরি সংক্রান্ত কোনরুপ সমস্যা হইলে তাহা সমাধানের ব্যবস্থা করিব।অন্যথায় কর্মীগণকে বিমান ভাড়া দিয়ে ফেরত আনিতে বাধ্য থাকিব।উপস্থাপিত ভিসাগুলী একক এবং গ্রুপ ভুক্ত নয় নিশ্চয়তা প্রদান করিলাম সে ক্ষেত্রে পরবর্তীতে বর্ণিত বিষয়ে গ্রুপ ভাঙ্গার অভিযোগ পাওয়া গেলে প্রবাসি কল্যাণ ও বৈদেশিক কর্মসংস্থান মন্ত্রণালয়,জনশক্তি কর্মসংস্থান ও প্রশিক্ষন ব্যুরো অথবা সরকার আমার রিক্রুটিং এজেন্সির বিরুদ্ধে বিধি অনুযায়ী অভিবাসী আইন ২০১৩ ইং অনুযায়ী যে কোন শাস্তি মেনে নিতে বাধ্য থাকিব।
            </p>
        </div>
        <br>

    </div>


    <div class="app" style="padding-top: 200px;">

        <h2 style="text-align: center;text-decoration: underline">(পাতা-৩)</h2>
        <br>
        <br>
        <br>
        <h2 style="text-align: center;text-decoration: underline">{!! $agreement['0']->country_name !!} গামী সত্যায়িত {!! $agreement['0']->gender !!} কর্মীর তালিকা</h2>
        <br>
        <div class="content">
            <table class="table table-bordered">
                <thead>
                <tr style="text-align: center">
                    <td style="height: 40px;text-align: center">নং </td>
                    <td style="height: 40px;text-align: center">কর্মীর নাম</td>
                    <td style="height: 40px;text-align: center">পাসপোর্ট নং </td>
                    <td style="height: 40px;text-align: center">জন্ম তারিখ</td>

                </tr>
                </thead>
                <?php
                $i=1;
                ?>
                <tbody>
                @foreach($agreement2 as $agree)

                <tr>
                    <td style="height: 40px">{!! $i++ !!}</td>
                    <td>{!! $agree->passenger_name !!} </td>
                    <td>{!! $agree->passportNumber !!} </td>
                    <td>{!! $agree->display_name !!} </td>

                </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <br>

    </div>

</div> <!-- /container -->

</body>
</html>