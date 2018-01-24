<html>
<head>
<title>Contact Information</title>
<style>
    body{
     font-family: freeserif;
     font-size: 14px;
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
    <img width="150" height="35" src="{{ public_path('/img/bismillah.jpeg') }}">
</div>
<div id="container">
    <div style="text-transform: uppercase ;width: 32%; float: left;text-align: left; position: relative">
        <h4>{{ $company->name_en }}</h4>
    </div>
    <div style="width: 32%; float: left;text-align: center">
        @if($company->logo_url)<img src="{{ public_path('/uploads/company-logo/'.$company->logo_url) }}" width="100" height="30">@endif
    </div>
    <div style="direction: rtl;text-transform: uppercase;width: 32%; float: right;text-align: right;position: relative;">
        <h4>{{ $company->name_ar }}</h4>
    </div>

</div>
<div id="clear"></div>
<div id="container">
    <div style="width: 40%; float: left;text-align: left; position: relative">
        <p>Date: <span style="text-transform: uppercase ;">{{ date('dS F, Y',strtotime($invoice->invoice_date)) }} </span> </p>
    </div>
    <div style="min-width: 15%; float: left;text-align: center">

    </div>
    <div style="direction: rtl;text-transform: uppercase;width: 40%; float: right;text-align: right;position: relative;">
        <p>تاريخ: {{ $date }} </p>
    </div>

</div>
<div style="width: 50%;line-height: 3px;  text-transform: capitalize;">
    <p>To,</p>
    <p style="font-weight: bold;">{{ $invoice->siteId['position'] }}</p>
    <p style="line-height: 18px; padding-top: -10px;">{!! nl2br($invoice->siteId['address']) !!}</p>

</div>
<div style="width: 95%;line-height: 16px;">
    <p>Sub: <span style="text-decoration:underline; font-weight: bold;"> Invoice for the Month of {{ date("F",strtotime($invoice->invoice_from_date)) }}, {{ date("Y",strtotime($invoice->invoice_from_date)) }} of Head Office</span></p>
</div>
<div style="width:95%;">
    <p>Dear Sir,</p>
    <p>We enclose herewith the bill of our helpers supplied to your head office. for the month of {{ date("F",strtotime($invoice->invoice_from_date)) }}, {{ date("Y",strtotime($invoice->invoice_from_date)) }}</p>
</div>
<div style="width:100%;">
   <table id="cost_info" style="width: 100%;" cellspacing="0" cellpadding="3">
      <tr>
          <th>Sl#</th>
          <th> Total Hours</th>
          <th> Rate/Hour</th>
          <th> Total Amount SR.</th>
      </tr>

       <tr>
           <td>1</td>
           <td>{{ $invoice->total_hours }}</td>
           <td>{{ $invoice->per_hour_rate }}</td>
           <td>{{ $invoice->total_amount }}</td>
       </tr>
   </table>
    <p style="font-weight: bold;"> Total Amount SR. {{ $invoice->total_amount }} </p>
    <p>
        Please issue the cheque in the name of our establishment. We shall appreciate in early settlement of the bill at your convenience.
    </p>
</div>
<div style="width:100%;">
    <p style="font-weight: bold; line-height: 1px;text-decoration: underline;"> Bank Details </p>
    <table style="width: 200%; " cellspacing="0" cellpadding="3" style="font-weight: bold; padding-top: -10px; padding-left: -3px">
        <tr>
            <th style="width: 80%;"></th>
            <th style="width: 80%"></th>

        </tr>

        <tr>
            <td>Bank</td>
            <td>: {{ $company->bank_name }}</td>

        </tr>
        <tr>
            <td>A/C Name</td>
            <td>: {{ $company->account_name }}</td>

        </tr>
        <tr>
            <td>Account#</td>
            <td>: {{ $company->account_number }}</td>

        </tr>
        <tr>
            <td>IBAN#</td>
            <td>: {{ $company->iban }}</td>

        </tr>

    </table>

    <p>
    We assure our best service in future.
    </p>
    <p style="padding-bottom: 15px;">
       Thanks and Regards.
    </p>

</div>
<div style="width: 40%">
    <p style="float: left;">
       <span style="font-weight: bold;">For {{ $company->name_en }}</span> <br/>
       {{ $company->person_name?'('.$company->person_name.')':' ' }} <br/>
        Phone : {{ $company->person_number }}
    </p>
</div>
<div id="container">
    <div style="width: 40%; float: left;text-align: left;">

       <p style="color: black; border: 1px solid black;margin-top:70px;padding: 5px; background-color: black;
       color: white;">Email: {{ $company->email }}</p>
    </div>
    <div style="width: 40%; float: left; line-height: 14px; text-align: right">
   
      <p>{!! nl2br($company->address_en) !!}</p>

    </div>

    <div style="direction: rtl; width: 15%; float: right;text-align: right; line-height: 14px; border-left: 1px solid black">

        <p>{!! nl2br($company->address_ar) !!}</p>

    </div>

</div>
</body>
</html>