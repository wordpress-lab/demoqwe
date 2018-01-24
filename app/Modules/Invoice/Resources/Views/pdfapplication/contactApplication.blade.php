<html>
<head>
<title>Contact Information</title>
<style>
    body{
     font-family: freeserif;
     font-size: 12px;
    }

    #container{
        width: 100%;
    }
    #clear{
        clear: both;
    }
    #cost_info tr th,#cost_info tr td{
        border: 1px solid black;
        text-align: center;
    }
    .wrap {
        height: 200px;
        width: 200px;
        border: 1px solid #aaa;
        margin: 10px;
        display: flex;
    }

    .wrap span {
        align-self: flex-end;
    }

</style>
</head>
<body>
<div id="container" style="text-align: center">
    <img width="500" height="80" src="{{ public_path('img/bismillah.png') }}">
</div>
<div id="container">
    <div style="text-transform: uppercase ;width: 32%; float: left;text-align: left; position: relative">
        <h6>Anwar Al -oainah for contacting</h6>
    </div>
    <div style="width: 32%; float: left;text-align: center">
        <img max-width="120" height="80" src="{{ public_path("img/logoul.png") }}">
    </div>
    <div style="direction: rtl;text-transform: uppercase;width: 32%; float: right;text-align: right;position: relative;">
        <h6>أنوار العوينة للاتصالأنوار العوينة للاتصال</h6>
    </div>

</div>
<div id="clear"></div>
<div id="container">
    <div style="width: 40%; float: left;text-align: left; position: relative">
        <p>Date: <span style="text-decoration: underline;text-decoration-style:dotted">{{ date("Y-m-d") }} </span> </p>
    </div>
    <div style="min-width: 15%; float: left;text-align: center">

    </div>
    <div style="direction: rtl;text-transform: uppercase;width: 40%; float: right;text-align: right;position: relative;">
        <p>تاري: {{ $date }} </p>
    </div>

</div>
<div style="width: 50%;line-height: 3px;  text-transform: capitalize;">
    <p>To,</p>
    <p>The Finance Manager</p>
    <p>Al Essa industriesCon.</p>
    <p>riyadh</p>
    <p>saudi Arabia</p>

</div>
<div style="width: 95%;line-height: 16px;  text-transform: capitalize;">
    <p>Sub: <span style="text-transform: capitalize;text-decoration:underline"> Invoice for the month of {{ date("M") }}, {{ date("Y") }} of head office</span></p>
</div>
<div style="width:95%;  text-transform: capitalize;">
    <p>Dear Sir,</p>
    <p>We enclose herewith the bill of our helpers supplied to your head office . for the month of {{ date("M") }}, {{ date("Y") }}</p>
</div>
<div style="width:80%;  text-transform: capitalize;">
   <table id="cost_info" style="width: 100%;" cellspacing="0" cellpadding="3">
      <tr>
          <th>Sl#</th>
          <th> Total Hours</th>
          <th> Rate/Hour</th>
          <th> Total Amount SR.</th>
      </tr>

       <tr>
           <td>1</td>
           <td>sd</td>
           <td>sds</td>
           <td>dsd</td>
       </tr>
       <tr>
           <td>1</td>
           <td>sd</td>
           <td>sds</td>
           <td>dsd</td>
       </tr>
       <tr>
           <td>1</td>
           <td>sd</td>
           <td>sds</td>
           <td>dsd</td>
       </tr>
   </table>
    <p style="font-weight: 400"> Total Amount SR. 25,4877.20 </p>
    <p>
        please issue the cheque in the name of our establishment . we shall appreciate in early settlement of the
        bill at your convenience.
    </p>
</div>
<div style="width:70%;text-transform: capitalize;">
    <p style="font-weight: 400; line-height: 3px;text-decoration: underline"> Bank Details </p>
    <table style="width: 100%; " cellspacing="0" cellpadding="3">
        <tr>
            <th style="width: 20%"></th>
            <th style="width: 80%"></th>

        </tr>

        <tr>
            <td>Bank</td>
            <td>: Riyadh Bank</td>

        </tr>
        <tr>
            <td>A/c Name</td>
            <td>: Anwar Al875115-65254- for contracting lc 85245 code</td>

        </tr>
        <tr>
            <td>Account#</td>
            <td>: DBLAl875115-65254-</td>

        </tr>
        <tr>
            <td>IBAN#</td>
            <td>: DBLAl875115-65254-</td>

        </tr>

    </table>

    <p>
    we assure our best service in future.
    </p>
    <p style="padding-bottom: 15px;">
       Thanks and Regards
    </p>

</div>
<div style="width: 40%">
    <p style="float: left;">
       For anwar al -oalnah for contracting <br/>
       (Mashiur rahman) <br/>
        Phone : 4587562154
    </p>
</div>
<div id="container">
    <div style="width: 40%; float: left;text-align: left;">

       <p style="color: black; border: 1px solid black;margin-top:70px;padding: 5px;">Email: alem2323@gmail.com</p>
    </div>
    <div style="width: 25%; float: left; line-height: 14px; text-align: right">
   <p>
       Kingdom of Saudi Arabia <br/>
       Riyadh-Press:neighborhood <br/>
       Office  : 54785412514 <br/>
       Fax     : 57897897 <br/>
       Membership number 454,254 <br/>
       S.t 101412544455 <br/>

   </p>
    </div>

    <div style="direction: rtl; width: 25%; float: right;text-align: right; line-height: 14px; border-left: 1px solid black">

        <p>
 المملكة العربية السعودية <br/>
 الرياض-الصحافة: حي <br/>
وفيس: 54785412514 <br/>
 فاكس: 57897897 <br/>
  رقم العضوية 454،254 <br/>
 S.t 101412544455 <br/>


        </p>
    </div>

</div>
</body>
</html>