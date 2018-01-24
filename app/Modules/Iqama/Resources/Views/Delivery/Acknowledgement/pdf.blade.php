<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">

    <style>
       .header{
           text-align: center;
       }
      .main{

      }
    </style>
    <title> {{ $recruit["passenger_name"] }} Acknowledgement {{  $recruit["paxid"] }}</title>
</head>

<body >

<div>
  <div id="main">

        <div class="header">

            @if($header->headerType)
               <img src="{{ $image }}"  height="200" width="100%"/>
            @else
                <div style="font-size: 30px;"> {{ $OrganizationProfile["company_name"] }}</div>
                <div  style="font-size: 13px;"> {{ $OrganizationProfile["street"].",".$OrganizationProfile["state"].",".$OrganizationProfile["country"] }}</div>
                <div  style="font-size: 13px;"> {{ $OrganizationProfile["email"].",".$OrganizationProfile["contact_number"] }} </div>
                <hr style="color: lightgrey; size: 1px; " />
            @endif

        </div>


        <div class="header" style="text-align: right;">
          <div> {{ date("d M,Y", strtotime($recruit["ack_receive_date"])) }} </div>
        </div>
        <br>
        @if($img_type == 1)
          <div class="header">
            <div> <img src="{{ $image_2 }}" class="img-responsive" style="width: 90%;"> </div>
          </div>
        @endif
        <br>
        <div style="text-align: left; font-size: 13px; font-family: Georgia, Times; padding-top:10px;">
           I {{ $recruit["rec_recipient_name"] }} on behalf of  {{ $recruit["passenger_name"] }} received the iqama documents.
        </div>
        <br>
         <div style="text-align: left; font-size: 13px; font-family: Georgia, Times; padding-top:10px;">
           Relationship with {{ $recruit["passenger_name"] }} :  {{ $recruit["relational_passenger"] }}.
        </div>

        <div style="width:50%; text-align: left; float: left; text-decoration: underline; margin-top: 100px">
            <h5 > Authorized Signature</h5>
        </div>
        <div style="width:50%; text-align: right; float: right ;text-decoration: underline;">
         <h5> Recipient Signature</h5>
       </div>

  </div>
</div>
</body>

</html>