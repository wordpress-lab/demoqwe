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
        
        .flex-container {
            display: -webkit-flex;
            display: flex;
            width: 100%;
        }

        .flex-item {
            float: left;
            width: 25%;
        }
        .flex-item-2 {
            width: 50%;
        }
        .margin{
            border-bottom: .2px solid black;
        }
        .clear{
            clear: both;
        }
    </style>
</head>
<body style="font-family: freeserif; font-size: 10pt;">

<div class="" role="main">

    <div class="app">
        <div class="flex-container">

            <div style="width: 50%; left: 50px;float: left;text-align: center;padding-left: 150px"> <img height="80" width="80" src="{{ asset('img/embassy.png') }}" /></div>
            <div class="flex-item" style="float: right;text-align: right;">
                <span style="text-transform: uppercase; font-weight: bold; font-size: 10px; text-align: right; ">
        سفارة المملكة العربية السعودية                  <br/>القسم القنصلي
                 <br/>Embassy of soudia arabia <br/> consular section
                </span>
            </div>
        </div>
        <div style="padding-top: 10px">
            <div style="font-size: 12px;width: 70%">Full Name: <span style="text-transform: uppercase;font-weight: bold">
                    {!! isset($data['recruit_order']['passenger_name']) ? $data['recruit_order']['passenger_name']:'' !!}, S/O {!! $data['visaform']['so'] !!}</span>
            </div>
            <div style="float: right;text-align: right;width: 30%;padding-top: -20px">
                <span style="text-transform: uppercase; font-weight: bold; font-size: 12px; text-align: right;">
:                   اسم الكامل
                </span>
            </div>
        </div>
        <div style="border-bottom: .2px solid black"></div>

        <div style="padding-top: 5px;padding-bottom: 5px">
            <div style="font-size: 12px;width: 70%">Mother`s Name:	<span style="font-weight: bold">{!! isset($data['recruit_customer']['motherName'])?$data['recruit_customer']['motherName']:'' !!}</span> </div>
            <div style="float: right;text-align: right;width: 30%;padding-top: -20px">
                <span style="text-transform: uppercase; font-weight: bold; font-size: 12px; text-align: right;">
            :        اسم الام
                </span>
            </div>
        </div>
        <div style="border-bottom: .05px solid black"></div>

        <div style="padding-top: 5px;padding-bottom: 5px">
            <div style="font-size: 12px;width: 20%;float: left">Date Of Birth: <span style="font-weight: bold">{!! isset($data['recruit_customer']['dateOfBirthEN'])?$data['recruit_customer']['dateOfBirthEN']:'' !!}</span></div>
            <div style="font-size: 12px;width: 30%;float: left; font-weight: bold"> : تاريخ الولادة
            </div>
            <div style="font-size: 12px;width: 30%;float: left">Place Of Birth: <span style="font-weight: bold">{!! isset($data['recruit_customer']['placeOfBirth'])?$data['recruit_customer']['placeOfBirth']:'' !!} </span></div>
            <div style="float: right;text-align: right;width: 20%;">
                <span style="text-transform: uppercase; font-weight: bold; font-size: 12px; text-align: right;">
            : محل الولادة
                </span>
            </div>
        </div>
        <div style="border-bottom: .05px solid black"></div>

        <div style="padding-top: 5px;padding-bottom: 5px">
            <div style="font-size: 12px;width: 30%;float: left">Previous Nationality: <span style="font-weight: bold">{!! isset($data['recruit_customer']['previousNationality'])?$data['recruit_customer']['previousNationality']:'' !!}</span></div>
            <div style="font-size: 12px;width: 20%;float: left; font-weight: bold"> :الجنسية السابقة
            </div>
            <div style="font-size: 12px;width: 30%;float: left">Present Nationality: <span style="font-weight: bold">{!! isset($data['recruit_customer']['presentNationality'])?$data['recruit_customer']['presentNationality']:'' !!} </span></div>
            <div style="float: right;text-align: right;width: 20%;">
                <span style="text-transform: uppercase; font-weight: bold; font-size: 12px; text-align: right;">
            : الجسية الحا لية
                </span>
            </div>
        </div>
        <div style="border-bottom: .05px solid black"></div>

        <div style="padding-top: 5px;padding-bottom: 5px">
            <div style="font-size: 12px;width: 20%;float: left;border-radius: 100%">Sex: <span style="font-weight: bold">Female</span>
                @if(isset($data['recruit_customer']['gender']))
                @if(strtoupper(substr($data['recruit_customer']['gender'],0,2))=="FE")
                    ✔
                @endif
                @endif
                انثي</div>
            <div style="font-size: 12px;width: 15%;float: left"> <span style="font-weight: bold">Male</span>
                @if(isset($data['recruit_customer']['gender']))
                @if(strtoupper(substr($data['recruit_customer']['gender'],0,2))=="MA")
                    ✔
                @endif
                @endif
                زكر</div>

            <div style="font-size: 12px;width: 30%;float: left">Marital Status: <span style="text-transform: uppercase;font-weight: bold">{!! isset($data['recruit_customer']['maritalStatus'])?$data['recruit_customer']['maritalStatus']:'' !!} </span></div>
            <div style="float: right;text-align: right;width: 20%;">
                <span style="text-transform: uppercase; font-weight: bold; font-size: 12px; text-align: right;">
            : الحا لية الجتما عية
                </span>
            </div>
        </div>
        <div style="border-bottom: .05px solid black"></div>

        <div style="padding-top: 5px;padding-bottom: 5px">
            <div style="font-size: 12px;width: 30%;float: left">Sect: <span style="font-weight: bold">{!! isset($data['visaentry']['iqamaSector'])?$data['visaentry']['iqamaSector']:'' !!}</span></div>
            <div style="font-size: 12px;width: 20%;float: left; font-weight: bold"> :المذهب
            </div>
            <div style="font-size: 12px;width: 30%;float: left">Religion: <span style="font-weight: bold">{!! isset($data['recruit_customer']['religionEN'])?$data['recruit_customer']['religionEN']:'' !!}</span> </div>
            <div style="float: right;text-align: right;width: 20%;">
                <span style="text-transform: uppercase; font-weight: bold; font-size: 12px; text-align: right;">
            : الديانة
                </span>
            </div>
        </div>
        <div style="border-bottom: .05px solid black"></div>

        <div style="padding-top: 2px">
            <div style="font-size: 12px;width: 20%;float: left"> &nbsp;</div>
            <div style="font-size: 12px;width: 30%;float: left; font-weight: bold"> :مصدره
            </div>
            <div style="font-size: 12px;width: 20%;float: left">:المؤهل العملي </div>
            <div style="float: right;text-align: right;width: 30%;">
                <span style="text-transform: uppercase; font-weight: bold; font-size: 12px; text-align: right;">الديانة
            :{!! isset($data['recruit_customer']['professionAR'])?$data['recruit_customer']['professionAR']:'' !!}
                </span>
            </div>
        </div>

        <div>
            <div style="font-size: 12px;width: 20%;float: left">Place of Issue: </div>
            <div style="font-size: 12px;width: 30%;float: left;"> Qualification: <span style="font-weight: bold">{!! isset($data['recruit_customer']['qualification'])?$data['recruit_customer']['qualification']:'' !!}</span> </div>
            <div style="font-size: 12px;width: 20%;float: left">Profession </div>
            <div style="float: right;text-align: right;width: 30%;">
                <span style="font-size: 12px; text-align: right;font-weight: bold">
                   {!! isset($data['recruit_customer']['professionEn'])?$data['recruit_customer']['professionEn']:'' !!}
                </span>
            </div>
        </div>
        <div style="border-bottom: .05px solid black"></div>

        <div style="padding-top: 5px;padding-bottom: 5px">
            <div style="font-size: 12px;width: 70%">Home address and telephone No: <span style="font-weight: bold">{!! isset($data['recruit_customer']['addressEN'])?$data['recruit_customer']['addressEN']:'' !!} </span> </div>
            <div style="float: right;text-align: right;width: 30%;padding-top: -20px">
                <span style="text-transform: uppercase; font-weight: bold; font-size: 12px; text-align: right;">
:                   عنوان المنزل و رقم التافون
                </span>
            </div>
        </div>

        <div style="border-bottom: .2px solid black"></div>

        <div>
            <div style="font-size: 12px;width: 70%">&nbsp;</div>
        </div>
        <div style="border-bottom: .2px solid black"></div>

        <div style="padding-top: 5px;padding-bottom: 5px">
            <div style="font-size: 12px;width: 70%">Business address and telephone No: <span style="font-weight: bold">{!! isset($data['recruit_customer']['businessAddressEN'])?$data['recruit_customer']['businessAddressEN']:'' !!}</span> </div>
            <div style="float: right;text-align: right;width: 30%;padding-top: -20px">
                <span style="text-transform: uppercase; font-weight: bold; font-size: 12px; text-align: right;">
:                 عنوان الشركة(الموسسة)و رقم التلفون
                </span>
            </div>
        </div>
        <div style="border-bottom: .2px solid black"></div>


        <div style="padding-top: 3px;padding-bottom: 3px;">
            <div style="font-size: 10px;width: 15%;float: left;text-align: center;height: 30px">Purpose of Travel: </div>
            <div style="font-size: 10px;width: 8%;float: left;border: 1px solid black;text-align: center;height: 30px;margin-left: 8px"> عمل<br> work
                @if(isset($data['recruit_customer']['purposeOfTravel']))
                    @if(strtoupper(substr($data['recruit_customer']['purposeOfTravel'],0,2))=="WO")
                        ✔
                    @endif
                @endif
                </div>
            <div style="font-size: 10px;width: 8%;float: left;border: 1px solid black;text-align: center;height: 30px;margin-left: 8px"> مرور <br>Transit
                @if(isset($data['recruit_customer']['purposeOfTravel']))
                    @if(strtoupper(substr($data['recruit_customer']['purposeOfTravel'],0,2))=="TR")
                        ✔
                    @endif
                @endif
            </div>
            <div style="font-size: 10px;width: 8%;float: left;border: 1px solid black;text-align: center;height: 30px;margin-left: 8px"> زيارة <br>Visit
                @if(isset($data['recruit_customer']['purposeOfTravel']))
                    @if(strtoupper(substr($data['recruit_customer']['purposeOfTravel'],0,2))=="VI")
                        ✔
                    @endif
                @endif
            </div>
            <div style="font-size: 10px;width: 8%;float: left;border: 1px solid black;text-align: center;height: 30px;margin-left: 8px"> عمرة<br>Umrah
                @if(isset($data['recruit_customer']['purposeOfTravel']))
                    @if(strtoupper(substr($data['recruit_customer']['purposeOfTravel'],0,2))=="UM")
                        ✔
                    @endif
                @endif
            </div>
            <div style="font-size: 10px;width: 8%;float: left;border: 1px solid black;text-align: center;height: 30px;margin-left: 8px"> للاقامة <br>Residence
                @if(isset($data['recruit_customer']['purposeOfTravel']))
                    @if(strtoupper(substr($data['recruit_customer']['purposeOfTravel'],0,2))=="RE")
                        ✔
                    @endif
                @endif
            </div>
            <div style="font-size: 10px;width: 8%;float: left;border: 1px solid black;text-align: center;height: 30px;margin-left: 8px"> حج <br>Hajj
                @if(isset($data['recruit_customer']['purposeOfTravel']))
                    @if(strtoupper(substr($data['recruit_customer']['purposeOfTravel'],0,2))=="HA")
                        ✔
                    @endif
                @endif
            </div>
            <div style="font-size: 10px;width: 10%;float: left;border: 1px solid black;text-align: center;height: 30px;margin-left: 8px"> دبلوماسيت  <br>Diplomacy
                @if(isset($data['recruit_customer']['purposeOfTravel']))
                    @if(strtoupper(substr($data['recruit_customer']['purposeOfTravel'],0,2))=="DI")
                        ✔
                    @endif
                @endif
            </div>

            <div style="float: right;text-align: right;width: 20%;padding-top: -20px">
                <span style="text-transform: uppercase; font-weight: bold; font-size: 12px; text-align: right;">
            :        الغابة من السقر
                </span>
            </div>
        </div>
        <div style="border-bottom: .05px solid black"></div>

        <div>
            <div style="font-size: 12px;width: 20%;float: left"> &nbsp;</div>
            <div style="font-size: 12px;width: 30%;float: left; font-weight: bold"> : محل الاصدار
            </div>
            <div style="font-size: 12px;width: 20%;float: left">: تاريخ اللاصدار  </div>
            <div style="float: right;text-align: right;width: 30%;">
                <span style="text-transform: uppercase; font-weight: bold; font-size: 12px; text-align: right;">
     :     رقم الجواز
                </span>
            </div>
        </div>

        <div>
            <div style="font-size: 12px;width: 30%;float: left">Place of Issue: <span style="font-weight: bold">{!! isset($data['recruit_order']['placeofissue'])?$data['recruit_order']['placeofissue']:'' !!}</span> </div>
            <div style="font-size: 12px;width: 40%;float: left;">Date of  Passport issued: <span style="font-weight: bold">{!! isset($data['recruit_order']['passportissuedate'])?$data['recruit_order']['passportissuedate']:'' !!}</span> </div>
            <div style="font-size: 12px;width: 30%;float: left">Passport No: <span style="font-weight: bold">{!! isset($data['recruit_order']['passportNumber'])?$data['recruit_order']['passportNumber']:'' !!}</span> </div>
        </div>
        <div style="padding-top: 2px">
            <div style="font-size: 12px;width: 60%;float: left"> Date of Passport`s expiry: <span style="font-weight: bold">  {!! isset($data['recruit_order']['passportissuedate']) ? date('Y-m-d',strtotime($data['recruit_order']['passportissuedate'].'+5 years')-('+1 day')):'' !!} </span> </div>
            <div style="float: right;text-align: right;width: 30%;">
                <span style="text-transform: uppercase; font-weight: bold; font-size: 12px; text-align: right;">
     :    تاريخ انتهاء صلاحية الجواز
                </span>
            </div>
        </div>

        <div style="border-bottom: .05px solid black"></div>

        <div>
            <div style="font-size: 12px;width: 35%;float: left; font-weight: bold;margin-left: 50px"> :مادة الاقامة باامماكة
            </div>
            <div style="font-size: 12px;width: 25%;float: left">:تاريخ الوصول </div>
            <div style="float: right;text-align: right;width: 30%;">
                <span style="text-transform: uppercase; font-weight: bold; font-size: 12px; text-align: right;">
     :    تاريخ المغادرة
                </span>
            </div>
        </div>

        <div>
            <div style="font-size: 12px;width: 40%;float: left">Duration of stay in the Kingdom: <span style="font-weight: bold"></span></div>
            <div style="font-size: 12px;width: 30%;float: left;">Date of Arrival: <span style="font-weight: bold"></span> </div>
            <div style="font-size: 12px;width: 30%;float: left">Date of Departure: <span style="font-weight: bold"></span></div>
        </div>

        <div style="border-bottom: .05px solid black"></div>

        <div>
            <div style="font-size: 12px;width: 15%;float: left; "> :تاريخ</div>
            <div style="font-size: 12px;width: 15%;float: left;">
 ايصال رقم ()</div>
            <div style="font-size: 12px;width: 10%;float: left">:تاريخ</div>
            <div style="font-size: 12px;width: 15%;float: left">
                بسيك ؤقم()</div>
            <div style="font-size: 12px;width: 10%;float: left">
                نقدا()</div>
            <div style="font-size: 12px;width: 15%;float: left">
                مجاملت()</div>
            <div style="float: right;text-align: right;width: 20%;">
                <span style="text-transform: uppercase; font-weight: bold; font-size: 12px; text-align: right;">
     :  طريقة الدفع
                </span>
            </div>
        </div>

        <div>
            <div style="font-size: 12px;width: 15%;float: left">Mode of Payment</div>
            <div style="font-size: 12px;width: 15%;float: left;">( )Free </div>
            <div style="font-size: 12px;width: 15%;float: left">( )Cash</div>
            <div style="font-size: 12px;width: 15%;float: left">( )Cheque No:</div>
            <div style="font-size: 12px;width: 15%;float: left">Date:</div>
            <div style="font-size: 12px;width: 10%;float: left">( )No:</div>
            <div style="font-size: 12px;width: 15%;float: left">( )Date:</div>
        </div>

        <div style="border-bottom: .005px solid black"></div>

        <div style="padding-top: 5px;padding-bottom: 5px">
            <div style="font-size: 12px;width: 30%;float: left">Relationship:</div>
            <div style="font-size: 12px;width: 40%;float: left;"> سلته</div>
            <div style="float: right;text-align: right;width: 30%;">
                <span style="text-transform: uppercase; font-size: 12px; text-align: right;">
     :  اسم المحرم
                </span>
            </div>
        </div>

        <div style="border-bottom: .005px solid black"></div>

        <div style="padding-top: 5px;padding-bottom: 5px">
            <div style="font-size: 12px;width: 30%;float: left">Destination :</div>
            <div style="font-size: 12px;width: 20%;float: left;">: لوصول بالمملكة</div>
            <div style="font-size: 12px;width: 20%;float: left;">Carrier`s Name: <span style="font-weight: bold">{!! isset($data['flight']['carrierName'])?$data['flight']['carrierName']:'' !!}</span></div>
            <div style="float: right;text-align: right;width: 30%;">
                <span style="text-transform: uppercase; font-size: 12px; text-align: right;">
     : اسم الشركة الناقلة
                </span>
            </div>
        </div>

        <div style="border-bottom: .005px solid black"></div>

        <div style="padding-top: 5px;padding-bottom: 5px">
            <div style="font-size: 12px;width: 60%;float: left">Dependents traveling in the same passport:</div>
            <div style="float: right;text-align: right;width: 40%;">
                <span style="text-transform: uppercase; font-size: 12px; text-align: right;">
     : ايضاحات تخص افراد(المضافين) علي نفس جواز السفر
                </span>
            </div>
        </div>

        <table border="1" width="100%" style="border: .5px solid #002b36">
            <thead>

            <tr>
                <td style="width: 25%;text-align: center">نوع الصلة
                    <br>  Relationship</td>
                <td style="width: 25%;text-align: center">تاريج الميلاد
                    <br> Date of Birth
                </td>
                <td style="width: 25%;text-align: center">الجنس
                    <br> Sex
                </td>
                <td style="width: 25%;text-align: center">الاسم بالكامل
                    <br> Full name
                </td>
            </tr>
            </thead>
            <tbody>
            @foreach($data['visaform']['formBulk'] as $item)
            <tr>
                <td style="text-align: center">{{ $item->relationship }}</td>
                <td style="text-align: center">{{ $item->dateofBirth }}</td>
                <td style="text-align: center">{{ $item->gender }}</td>
                <td style="text-align: center">{{ $item->name }}</td>
            </tr>
          @endforeach
            </tbody>
        </table>

        <div style="padding-top: 5px;padding-bottom: 5px">
            <div style="font-size: 12px;width: 60%;float: left">Name and address of Company or individual in the Kingdom:</div>
            <div style="float: right;text-align: right;width: 40%;">
                <span style="text-transform: uppercase; font-weight: bold; font-size: 12px; text-align: right;">
     : اسم وعنوان الشركة أو اسم الشخص وعنوانة بالمملكة
                </span>
            </div>
        </div>
        <div style="border-bottom: .005px solid black"></div>

        <div style="padding-top: 5px;padding-bottom: 5px">
            <div style="font-size: 12px;width: 100%;float: left;text-transform: uppercase"> <span style="font-weight: bold">{!! isset($data['Company']['name'])?$data['Company']['name']:'' !!} ,{!! isset($data['Company']['companyAddress'])?$data['Company']['companyAddress']:'' !!}</span></div>
        </div>

        <div style="border-bottom: .005px solid black"></div>

        <div>
            <div style="font-size: 12px;width: 60%;float: left">The undersigned hereby certify that all the information I have provided are correct.</div>
            <div style="float: right;text-align: right;width: 40%;">
                <span style="text-transform: uppercase; font-weight: bold; font-size: 12px; text-align: right;">
     انا الموقع ادناه اقر بان كل المعلومات التي دوتقها صحيحة
                </span>
            </div>
        </div>
        <div>
            <div style="font-size: 12px;width: 60%;float: left">I will abide by the laws of the Kingdom during the period of my residence in it.</div>
            <div style="float: right;text-align: right;width: 40%;">
                <span style="text-transform: uppercase; font-weight: bold; font-size: 12px; text-align: right;">
    وساكون سلتز سابقو انين الممكت اثناء فتر و جودي بها
                </span>
            </div>
        </div>

        <div>
            <div style="font-size: 12px;width: 15%;float: left">Date:</div>
            <div style="font-size: 12px;width: 15%;float: left; font-weight: bold">التريخ </div>
            <div style="font-size: 12px;width: 15%;float: left">Signature:</div>
            <div style="font-size: 12px;width: 10%;float: left">:التوقيع</div>
            <div style="font-size: 12px;width: 30%;float: left">Name: <span style="font-weight: bold">{!! isset($data['recruit_order']['passenger_name']) ? $data['recruit_order']['passenger_name']:'' !!}</span></div>

        </div>

        <div>
            <div style="font-size: 12px;width: 60%;float: left;text-decoration: underline">For official use only:</div>

        </div>

        <div>
            <div style="font-size: 12px;width: 20%;float: left">Date: </div>
            <div style="font-size: 12px;width: 25%;float: left;">Authorization:  </div>


        </div>

        <div style="border-bottom: .005px solid black"></div>

        <div style="padding-top: 5px;padding-bottom: 5px">
            <div style="font-size: 12px;width: 35%;float: left">Visit/Work for:</div>
            <div style="font-size: 12px;width: 35%;float: left; font-weight: bold">صالح بن عاتق بن صالح الغشمري</div>
            <div style="float: right;text-align: right;width: 30%;">
                <span style="text-transform: uppercase; font-weight: bold; font-size: 12px; text-align: right;">
  :لزيارة-العمل لدي
                </span>
            </div>
        </div>

        <div style="border-bottom: .005px solid black"></div>

        <div style="padding-top: 5px;padding-bottom: 5px">
            <div style="font-size: 12px;width: 25%;float: left">Date: <span style="font-weight: bold"></span></div>
            <div style="font-size: 12px;width: 20%;float: left; font-weight: bold">:وتاريخ</div>
            <div style="font-size: 12px;width: 30%;float: left;">VISA NO: <span style="font-weight: bold"></span></div>

        </div>

        <div style="border-bottom: .005px solid black"></div>

        <div style="padding-top: 5px;padding-bottom: 5px">
            <div style="font-size: 12px;width: 20%;float: left">FEE COLLECTED:</div>
            <div style="font-size: 12px;width: 15%;float: left; font-weight: bold">:المبلغ المحصل</div>
            <div style="font-size: 12px;width: 20%;float: left;">Type:</div>
            <div style="font-size: 12px;width: 10%;float: left; font-weight: bold">:نوعها</div>
            <div style="font-size: 12px;width: 15%;float: left;">Duration:</div>
            <div style="float: right;text-align: right;width: 20%;">
                <span style="text-transform: uppercase; font-weight: bold; font-size: 12px; text-align: right;">
  :مدتها
                </span>
            </div>
        </div>

        <div style="border-bottom: .005px solid black"></div>

        <div>
            <div style="font-size: 12px;width: 30%;float: left">&nbsp;</div>

        </div>
        <div>
            <div style="font-size: 12px;width: 60%;float: left">Head of consular section</div>
            <div style="float: right;text-align: right;width: 40%;">
                <span style="text-transform: uppercase; font-weight: bold; font-size: 12px; text-align: right;">Check by</span>
            </div>
        </div>
    </div>

</div>

</body>
</html>