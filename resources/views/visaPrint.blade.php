<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        .flex-container {
            display: -webkit-flex;
            display: flex;
            width: 700px;
            height: auto;
            border-bottom: 1px solid black;

        }

        .flex-item {

            width: 30%;
            margin: 1px;
        }

        .flex-item-2 {

            width: 50%;
            margin: 1px;
        }

        .checkmark {
            display: inline-block;
        }
        .checkmark:after {
            /*Add another block-level blank space*/
            content: '';
            display: block;
            /*Make it a small rectangle so the border will create an L-shape*/
            width: 3px;
            height: 6px;
            /*Add a white border on the bottom and left, creating that 'L' */
            border: solid #000;
            border-width: 0 2px 2px 0;
            /*Rotate the L 45 degrees to turn it into a checkmark*/
            transform: rotate(45deg);
        }

        @media print
        {
            .no-print, .no-print *
            {
                display: none !important;
            }
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>
    <script src=" {{ asset('js/html2canvas.js') }}"></script>

    <script>

        function genPDF() {


            html2canvas(document.getElementById('testdiv'),{
                onrendered : function(canvas){
                    var img = canvas.toDataURL('image/png');
                    var doc= new jsPDF();
                    doc.addImage(img,'JPEG',10 ,10);
                    doc.save('visaform.pdf');
                },
                background:'#fff'

            })
        }
    </script>
</head>


<body >
<a href="javascript:genPDF()" class="no-print">Download PDF</a>
<div id="testdiv" style="margin-top: 40px;">
    <div class="flex-container">
        <div class="flex-item"><img height="80" width="80" src="{{ asset('img/user.png') }}" /></div>
        <div class="flex-item" style="position: relative; left: 50px;"> <img height="80" width="80" src="{{ asset('img/embassy.png') }}" /></div>
        <div class="flex-item"> <span style="text-transform: uppercase; font-weight: bold; font-size: 10px; text-align: right; position: relative; left:120px; ">
        سفارة المملكة العربية السعودية <br/>القسم القنصلي
        <br/>Embassy of soudia arabia <br/> consular section</span></div>
    </div>
    <div class="flex-container">
        <div class="flex-item-2"> Full Name: <span style="text-transform: uppercase; font-size: 12px; font-weight: bold">{{ strtoupper($full_name) }} .S/O {{ strtoupper($visaform->so) }}</span> </div>
        <div class="flex-item-2"> <span style="text-align: right; position: relative; right: -280px; top:-0px;">  :نورول أمين</span></div>

    </div>

    <div class="flex-container">
        <div class="flex-item-2"> Mothers Name: <span style="text-transform: uppercase; font-size: 12px; font-weight: bold">{{ $recruit_customer->motherName }}</span> </div>
        <div class="flex-item-2"> <span style="text-align: right; position: relative; right: -284px; top:-0px;">نورول أمين</span></div>

    </div>

    <div class="flex-container">
        <div class="flex-item">Date Of Birth : <span style="text-align: center"> {{ $recruit_customer->dateOfBirthEN }} </span></div>
        <div class="flex-item" style="width: 50%"> Place Of birth : <span style="text-transform: uppercase; font-weight: bold; font-size: 12px;"> {{ strtoupper($recruit_customer->placeOfBirth) }}</span></div>
        <div class="flex-item" style="width: 20%"><span style="text-align: left; position: relative; left:78px; top:-0px;">نورول أمين</span></div>
    </div>
    <div class="flex-container">
        <div class="flex-item" style="width: 45%">Previous Nationality :  <span style="text-transform: uppercase; font-weight: bold;font-size: 12px;">&nbsp;{{ strtoupper($recruit_customer->previousNationality) }} &nbsp; &nbsp;</span> </div>
        <div class="flex-item" style="width: 35%"> &nbsp;&nbsp;&nbsp;Present Nationality : <span style="text-transform: uppercase; font-weight: bold;font-size: 12px;">&nbsp;&nbsp;{{ strtoupper($recruit_customer->presentNationality) }} </span></div>
        <div class="flex-item" style="width: 15%"><span style="text-align: left; position: relative; left:80px; top:-0px;">لاكشميبور </span></div>
    </div>
    <div class="flex-container">
        <div class="flex-item" style="width: 100%"> Sex :

            <span style="border: 1px solid black;">Female
                @if(strtoupper(substr($recruit_customer->gender,0,2))=="FE")
                    <span class="checkmark"></span>
                @endif
            </span>


            <span style="border: 1px solid black; margin: 1px; "> Male
                @if(strtoupper(substr($recruit_customer->gender,0,2))=="MA")
                    <span class="checkmark"></span>
                @endif
                </span>

            &nbsp; <span>:متزوجة أو غير متزوجة</span>&nbsp;
            &nbsp; Marital Status: <span style="text-transform: uppercase; font-weight: bold;font-size: 11px;">{{ strtoupper($recruit_customer->maritalStatus) }}</span>&nbsp;
            <span style="text-align: left; position: relative; left:130px; top:-0px;" > :متزوجة أو غير متزوجة</span>
        </div>

    </div>

    <div class="flex-container">
        <div class="flex-item" style="width: 100%">
            Sect : {{ $visaentry->iqamaSector }}  <span style="padding-left: 30px;">:أو غير متزوجة</span>


            &nbsp; Religion: &nbsp;<span style="text-transform: uppercase;font-weight: bold; font-size: 12px;">{{ strtoupper($recruit_customer->religionEN) }} &nbsp; &nbsp;</span>&nbsp;
            &nbsp;<span style="text-align: right; position: relative; " > :متزوجة أو غير متزوجة </span>
        </div>
    </div>

    <div class="flex-container">
        <div   style="width: 25%;"> <span style="text-align: left; position: relative; top:18px;" >Place Of Issue : {{ strtoupper($recruit_customer->destination) }} &nbsp;</span></div>
        <div  style="width: 25%">    :الإسلام
            <br/>
            Qualification: {{ strtoupper($recruit_customer->qualification) }} &nbsp;</div>
        <div  style="width: 25%">                                                                       :الإسلام
            <br/>
            Profession:
        </div>
        <div  style="width: 25%; text-align: right">:الإسلام
            <br/>
            {{ strtoupper($recruit_customer->professionEn) }}</div>
    </div>

    <div class="flex-container">
        <div class="flex-item-2" style="width: 75%"> Home Address and telephone No: <span style="text-transform: uppercase; font-size: 12px; font-weight: bold ">{{ strtoupper($recruit_customer->addressEN) }}</span> </div>
        <div class="flex-item-2" style="width: 25%; text-align: right">  نورول:نورول أمين</div>

    </div>

    <div class="flex-container">
        <div class="flex-item-2" style="width: 75%"> Business Address and telephone No: <span style="text-transform: uppercase; font-size: 12px; font-weight: bold ">{{ strtoupper($recruit_customer->businessAddressEN) }}</span></div>
        <div class="flex-item-2" style="width: 25%; text-align: right">  نورول:نورول أمين:</div>

    </div>

    <div class="flex-container">
        <div style="width: 100%; text-align: center"> <span style="text-transform: uppercase; position: relative; text-align: center; font-size: 12px; font-weight: bold "> Shawan Tower ,2/c purana paltan ,Dhaka-1000,tel:947854 </span></div>


    </div>
    <div class="flex-container">
        <div  style="width: 80%;padding: 10px 0px; font-size: 12px;">  Purpose of Travel :
            <span style="border: 1px solid black;margin: 1px; padding: 5px;">  work
                @if(strtoupper(substr($recruit_customer->purposeOfTravel,0,2))=="WO")
                    <span class="checkmark"></span>
                @endif
            </span>
            <span style=" border: 1px solid black;margin: 1px; padding: 5px;"> Transit
                @if(strtoupper(substr($recruit_customer->purposeOfTravel,0,2))=="TR")
                    <span class="checkmark"></span>
                @endif
            </span>
            <span style="border: 1px solid black;margin: 1px; padding: 5px;"> Visit  <
                @if(strtoupper(substr($recruit_customer->purposeOfTravel,0,2))=="VI")
                    <span class="checkmark"></span>
                @endif
            </span>
            <span style="border: 1px solid black;margin: 1px; padding: 5px;"> Umrah
                @if(strtoupper(substr($recruit_customer->purposeOfTravel,0,2))=="UM")
                    <span class="checkmark"></span>
                @endif
            </span>
            <span style=" border: 1px solid black;margin: 1px; padding: 5px;"> Residence
                @if(strtoupper(substr($recruit_customer->purposeOfTravel,0,2))=="RE")
                    <span class="checkmark"></span>
                @endif
            </span>

            <span style=" border: 1px solid black;margin: 1px; padding: 5px; "> Hajj
                @if(strtoupper(substr($recruit_customer->purposeOfTravel,0,2))=="HA")
                    <span class="checkmark"></span>
                @endif
            </span>
            <span style=" border: 1px solid black;margin: 1px; padding: 5px; "> Diplomacy
                @if(strtoupper(substr($recruit_customer->purposeOfTravel,0,2))=="DI")
                    <span class="checkmark"></span>
                @endif
            </span>
        </div>
        <div  style="width: 20%; padding: 5px 0px; text-align: right">  نورول:نورول أمين:</div>

    </div>

    <div class="flex-container" style="font-size: 14px;">
        <div class="flex-item" style="width: 45%">مكان صدوره: <br/>  Place of Issue :<span style="text-align: center"> {{ $recruit_order->placeofissue }}</span> <br/> Date of passport's Expiry :<span style="text-align: center"> {{ $recruit_order->passportDate }}</span> </div>
        <div class="flex-item" style="width: 30%"> تاريخ إصدار الجواز: <br/>Date Passport Issue : <span style="text-transform: uppercase; font-weight: bold">{{ $recruit_order->passportissuedate }}</span></div>
        <div class="flex-item" style="width: 25%; text-align: right">  رقم جواز السفر: <br/> Passport No : <span style="text-align: center">  {{ $recruit_order->passportNumber }} </span> <br/> <span style="text-align: center"> تاريخ انتهاء جواز السفر: </span>
        </div>
    </div>
    <div class="flex-container" style="font-size: 13px;">
        <div class="flex-item" style="width: 45%">:مكان صدور<br/>  Duration stay in the kingdom :<span style="text-align: center"> {{ $recruit_customer->durationOfStay }}</span> </div>
        <div class="flex-item" style="width: 30%"> تاريخ إصدار الجواز: <br/>Date of arrival : <span style="text-transform: uppercase; font-weight: bold"> {{ $recruit_customer->arrivalDate }}</span></div>
        <div class="flex-item" style="width: 25%; text-align: right">  تاريخ إصدار الجواز: <br/>  <span style="position: relative; right: 25px;"> Date of departure : {{ $recruit_customer->departureDate }}</span>
        </div>
    </div>

    <div class="flex-container">
        <div  style="width: 20%;padding: 5px 0px;"> Mode of Payment :دفع
        </div>
        <div  style="width: 80%; padding: 5px 0px; text-align: right">

            <span style="word-spacing:10px; ">   ()  نبات مدقي ()  نبات مدقي   ()  نبات مدقي ()  نبات مدقي ()  نبات مدقي</span>
            <br/>
            <span style=" position: relative; right: 100px; word-spacing:10px;  "> Fee() Cash() Check No () Date: No() Date: </span>
        </div>

    </div>

    <div class="flex-container">
        <div class="flex-item" style="width: 45%"> Relationship :</div>
        <div class="flex-item" style="width: 30%"> تاريخ إصدا:</div>
        <div class="flex-item" style="width: 25%; text-align: right; padding-right: 10px;">  تاريخ إصدار </div>
    </div>
    <div class="flex-container" style="font-size: 14px;">
        <div class="flex-item" style="width: 35%"> Destination : {{ strtoupper($recruit_customer->destination) }}</div>
        <div class="flex-item" style="width: 15%;text-align: right"> تاريخ تاريخ:</div>
        <div class="flex-item" style="width: 35%; text-align: center"> Carrier's name:
           @if(isset($flight->carrierName))
            {{ strtoupper($flight->carrierName) }}
           @endif
        </div>
        <div class="flex-item" style="width: 15%; text-align: right;padding-right: 10px;">  تاريخ  </div>
    </div>
    <div class="flex-container">
        <div class="flex-item" style="width: 50%"> Dependents traveling in the same passport:</div>
        <div class="flex-item" style="width: 50%;text-align: right;"> المعالين السفر في نفس جواز السفر:</div>

    </div>
    <div class="flex-container">
        <table cellpadding="0" cellspacing="0" width="100%" border="1">
            <thead>
            <tr>
                <th width="25%">
                    العلاقات

                    <br/>
                    <span style="font-size: 14px; font-weight: bold "> RelationShip</span>
                </th>
                <th width="25%">
                    تاريخ الولادة

                    <br/>
                    <span style="font-size: 14px; font-weight: bold "> Date of Birth </span>
                </th>
                <th width="25%">
                    جنس
                    <br/>
                    <span style="font-size: 14px; font-weight: bold ">  Sex </span>
                </th>
                <th width="25%">
                    الاسم الكامل
                    <br/>
                    <span style="font-size: 14px; font-weight: bold "> Full name </span>
                </th>
            </tr>
            </thead>
            @foreach($visaform->formBulk as $item)
                <tr>
                    <td width="25%">{{ $item->relationship }}</td>
                    <td width="25%">{{ $item->dateofBirth }}</td>
                    <td width="25%">{{ $item->gender }}</td>
                    <td width="25%">{{ $item->name }}</td>
                </tr>
            @endforeach

        </table>
    </div>
    <div class="flex-container">
        <div class="flex-item" style="width: 60%"> Name and address of company or individual in the kingdom :</div>
        <div class="flex-item" style="width: 40%;text-align: right"> المعالين السفر في نفس جواز السفر:</div>

    </div>
    <div class="flex-container">
        <div class="flex-item" style="width: 100%; font-size: 12px;"> {{ strtoupper($Company->name) }} ,{{ strtoupper($Company->companyAddress) }}</div>
    </div>
    <div class="flex-container" style="border: none;">
        <div class="flex-item" style="width: 60%;font-size: 15px;">  The undersigned hereby certify that all information I have provoder are correct . <br/>
            I will abide by the laws of the Kingdom during the period of my residence in it.</div>
        <div class="flex-item" style="width: 40%; font-size: 14px;text-align: right"> في الواقع, في الحقيقة, في البداية, في نفس الوقت, في النهاية, في <br/>الخارج, في البيت, في الوقت الحالي, في الصباح, في المستقبل</span></div>

    </div>

    <div class="flex-container" style="border: none;" >
        <div class="flex-item" style="width: 15%"> Date :</div>
        <div class="flex-item" style="width: 15%;text-align: right"> تاريخ :</div>
        <div class="flex-item" style="width: 15%; text-align: left"> Signature:</div>
        <div class="flex-item" style="width: 20%; text-align: right;padding-right:3px;">  تاريخ  </div>
        <div class="flex-item" style="width: 40%; text-align: left;padding-left:5px;">  Name :<span style="text-transform: uppercase"> {{ strtoupper($Company->referencename) }}</span>  </div>
        <div class="flex-item" style="width: 25%; text-align: right">  اسم </div>
    </div>

    <div class="flex-container" style="border: none;">
        <div class="flex-item" style="width: 60%;font-size: 12px;">   <span style="text-decoration: underline; font-weight: bold"> For official use only </span></div>
        <div class="flex-item" style="width: 40%; font-size: 12px;text-align: right"><span style="text-align: right;text-decoration: underline; font-weight: bold;border-bottom-color:white"> للاستخدام الرسمي فقط:</span></div>

    </div>

    <div class="flex-container" >
        <div class="flex-item" style="width: 25%"> Date : {{ $visaform->officeDate }}</div>
        <div class="flex-item" style="width: 25%">Authorization</div>
        <div class="flex-item" style="width: 20%; text-align: right"> {{ $visaform->authorization }} </div>
        <div class="flex-item" style="width: 30%; text-align: right">  تاريختاريختاريختاريخ إصدا:</div>

    </div>
    <div class="flex-container" >
        <div class="flex-item" style="width: 40%"> Visit /Works for:</div>
        <div class="flex-item" style="width: 35%; text-align: left ">في  الحالي, ففي المستقبل</div>

        <div class="flex-item" style="width: 30%; text-align: right">  قع, في الحقيقة, في البدالصباح, إصدا:</div>

    </div>

    <div class="flex-container" >
        <div class="flex-item" style="width: 25%"> Date : </div>
        <div class="flex-item" style="width: 15%">ستقبل</div>
        <div class="flex-item" style="width: 30%; text-align: left"> Visa No: </div>
        <div class="flex-item" style="width: 30%; text-align: right">  تأشيرة إصدا:</div>

    </div>
    <div class="flex-container" >
        <div class="flex-item" style="width: 25%"> Fee Collection: : </div>
        <div class="flex-item" style="width: 15%">:مجموعة الرسوم</div>
        <div class="flex-item" style="width: 15%; text-align: left"> Type: </div>
        <div class="flex-item" style="width: 15%; text-align: right">  تأشيرة :</div>
        <div class="flex-item" style="width: 15%; text-align: left">  Duration :</div>
        <div class="flex-item" style="width: 15%; text-align: right">  الزمنية :</div>

    </div>

    <div class="flex-container" style="border: none;">
        <div class="flex-item" style="width: 35%">  <span style=" font-weight: bold"> رئيس القسم القنصلي<br/> Head of Consular Section </span>:</div>
        <div class="flex-item" style="width: 30%; text-align: left ">{{ $visaform->footerNumber }} ففي المستقبل</div>

        <div class="flex-item" style="width: 35%; text-align: right"> <span style="text-align: right; font-weight: bold;border-bottom-color:white">فحص بواسطة
 <br/> Checked By</span> </div>

    </div>
</div>
<script type="text/javascript">
    window.onload = function() { window.print(); }
</script>
</body>
</html>