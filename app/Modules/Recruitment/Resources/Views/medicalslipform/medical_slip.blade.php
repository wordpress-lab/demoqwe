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

        td{
            border: 1px solid;
            text-align: center;
        }

        #bold{
            font-weight: 900 !important;
            text-decoration: underline;
        }

        #reference{
            bottom: 0;
            top: 0;
            text-align: right;
            float: right;
            font-weight: bold;
            font-size: 15px;
        }


    </style>

</head>
<body style="font-family: freeserif; font-size: 10pt;">



<div role="main" >

    <div class="app" style="padding-top: 100px">
        <div id="reference">Ref: MLO{{ date('Y', strtotime($basis[0]->dateOfApplication)).'-'.str_pad($basis[0]->medicalslip_id, 6, '0', STR_PAD_LEFT) }}</div>

        <p style="font-weight: 400;font-size: 20px; float: left;">তারিখঃ
            <?php
            $currentDate =  $basis[0]->dateOfApplication;
            $engDATE = array(1,2,3,4,5,6,7,8,9,0,January,February,March,April,May,June,July,August,September,October,November,December,Saturday,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday);
            $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার','
বুধবার','বৃহস্পতিবার','শুক্রবার'
            );
            $convertedDATE = str_replace($engDATE, $bangDATE, $currentDate);
            echo "$convertedDATE";
            ?>

        </p>

        <p style="font-weight: 400;font-size: 20px">বরাবর</p>
        <p style="font-weight: 400;font-size: 20px;padding: 0;line-height: 12px">প্রেসিডেন্ট</p>
        <p style="font-weight: 400;font-size: 20px ;padding: 0;line-height: 12px">গামকা</p>
        <p style="font-weight: 400;font-size: 20px ;padding: 0;line-height: 12px">২৫০৫/২৫০৬ মাদানি এভিনিউ</p>
        <p style="font-weight: 400;font-size: 20px ;padding: 0;line-height: 12px">ভাটারা, (১০০ ফিটরাস্তা) ঢাকা-১২১২</p>
        <br>
        <h6 id="bold" style="font-size: 20px;">বিষয়ঃ মেডিকেল স্লিপের জন্য আবেদন</h6>
        <p style="font-weight: 400;font-size: 20px">জনাব,</p>
        <div class="content">
            <p style="font-size: 20px">নিম্নলিখিত, {!! $basis[0]->country_name !!} গমন ইচ্ছুক যাত্রীদের স্বাস্থ্য পরীক্ষা নিশ্চিত করার লক্ষ্যে প্রয়োজনীয় মেডিকেল স্লিপ প্রদান এর জন্য বিনীত অনুরোধ করছি ।
            </p>
        </div>
        
        <br>
        <table class="table table-bordered">
            <thead>
            <tr style="text-align: center">
                <td style="height: 40px;text-align: center;font-size: 17px">ক্রমিক নং </td>
                <td style="height: 40px;text-align: center;font-size: 17px">যাত্রীর নাম</td>
                <td style="height: 40px;text-align: center;font-size: 17px">পাসপোর্ট নাম্বার</td>

            </tr>
            </thead>
            <?php
            $i=1;
            ?>
            <tbody>
            @foreach($basis as $value)
                <tr>
                    <td style="height: 40px;font-size: 17px">{!! $i++ !!}</td>
                    <td style="font-size: 17px">{!! $value->passenger_name !!}</td>
                    <td style="font-size: 17px">{!! $value->passportNumber !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <br>

        <!-- <div class="content">
            <p style="font-size: 20px">
                উল্লেক্ষ্য ,উপরোক্ত যাত্রীদের ভিসা প্রাপ্তির প্রক্রিয়া সম্পন্ন করার জন্য মেডিকেল স্লিপ প্রয়োজন সুতরাং ভিসা সংক্রান্ত সকল দায় দায়িত্ব আমাদের।
            </p>
        </div> -->
        <br>

        <h4>ধন্যবাদান্তে</h4>

       <h4>{!! $formbasis->ownerNameBN !!}</h4>
        <h4>{!! $formbasis->ownerDesignationBN !!}</h4>
       <h4>{!! $formbasis->companyNameBN !!}</h4>

    </div>

</div> <!-- /container -->

</body>
</html>