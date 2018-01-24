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



<div role="main" style="padding-top: 200px">

    <div class="potro_1">
        <h2 style="text-align: center;text-decoration: underline;">অভিভাবকের অনাপত্তি পত্র</h2>
        <br>
        <br>
        <br>
        <div class="content">
            <p style="line-height: 50px;font-size: 20px;">আমি নিম্ন স্বাক্ষরকারী জনাব, {!! $customer->passengerNameBN !!}, {!! $customer->addressBN !!} ধর্মঃ {!! $customer->religionBN !!}
                <br>
              উল্লেখ্য যে , {!! $customer->passengerNameBN !!} ,{!! $customer->relationWithCustomer_1 !!}: {!! $customer->guardianName !!} অনাপত্তি পত্র দাখিল করেছেন।
            </p>
        </div>

    </div>

    <div class="potro_1" style="padding-top: 500px">
        <h2 style="text-align: center;text-decoration: underline;">পাতা / ০২</h2>
        <br>
        <br>
        <br>
        <div class="content">
            <p style="line-height: 20px;line-height: 50px;font-size: 20px;">
                আমি ঘোষনা করিতেছি যে , আমার {!! $customer->relationWithCustomer_2 !!}:{!!  $customer->passengerNameBN !!} বেগম পাসপোর্ট নং {!! $customer->passportNumberBN !!} {!! $customer->destination !!} নিয়োগকর্তা {!! $contact->company_name !!} এর অধীনে {!! $customer->professionBn !!} হিসাবে চাকুরী নিয়ে {!! $customer->destination !!} গমন করলে আমার কোন ধরনের আপত্তি নাই বা থাকিবে না।
            </p>
        </div>

    </div>


    <div class="potro_1" style="padding-top: 300px">
        <h2 style="text-align: center;text-decoration: underline;">পাতা / ০৩</h2>
        <br>
        <br>
        <br>
        <div class="content">
            <p style="line-height: 50px;font-size: 20px;">
                আমি আরও ঘোষনা করিতেছি যে , ভবিষ্যতে আমার {!! $customer->relationWithCustomer_2 !!} কে {!! $customer->destination !!} প্রেরনের জন্য রি/এজেন্সির বিরুদ্ধে কোনরূপ আপত্তি তুলিব না। আমি স্বেচ্ছায় বিনা প্ররোচনায় নিম্নে স্বাক্ষর করিলাম।
            </p>
        </div>
        <br>
        <br>

        <h4 style="text-decoration: underline">অভিভাবকের স্বাক্ষর</h4>
        <br>
        <br>
        <br>

        <h4>নাম        : {!! $customer->guardianName !!}</h4>
        <h4>পিতার নাম  : {!! $customer->guardianFatherName !!} </h4>
        <h4>ঠিকানা      : {!! $customer->guardianAddressBN !!}, ধর্ম : {!! $customer->guardianReligion !!} </h4>

    </div>

</div> <!-- /container -->


</body>
</html>