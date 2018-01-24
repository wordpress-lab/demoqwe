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

<div style="text-align: center; line-height: 1px;">
    <h2>Payment Receive</h2>
    <h4>{{'#INV-'.$invoice->invoice_number}}</h4>
</div>
<div style="width: 50%;line-height: 3px;  text-transform: capitalize;">
    <p>To,</p>
    <p style="font-weight: bold;">{{ $invoice->siteId['position'] }}</p>
    <p style="line-height: 18px; padding-top: -10px;">{!! nl2br($invoice->siteId['address']) !!}</p>

</div>
<div style="width: 95%;line-height: 16px;">
    <p><span style="font-weight: bold; font-size: 15;">Total Receivable : {{ $invoice->total_amount }}</span></p>
</div>

<div style="width:100%;">
   <table id="cost_info" style="width: 100%;" cellspacing="0" cellpadding="3">
      <tr>
          <th>Date</th>
          <th>payment Receipt</th>
          <th>Amount</th>
          <th>Note</th>
      </tr>
      @foreach($payment as $value)
       <tr>
           <td>{{ date('d-m-Y',strtotime($value->date)) }}</td>
           <td>{{ 'PR-'.$value->number }}</td>
           <td>{{ $value->amount }}</td>
           <td>{{ $value->note }}</td>
       </tr>
       @endforeach
   </table>
    <p style="font-weight: bold;"> Total Due : {{ $invoice->due_amount }} </p>
</div>
<br><br>
<div style="width:200%;">
    
    <table style="font-weight: bold; padding-top: -10px; padding-left: -3px; width: 100%;">
        <tr>
            <th style=" float: left; text-align: left; text-decoration: overline;">Customer Signature</th>
            <th style=" float: right; text-align: right; text-decoration: overline;">Authorized Signature</th>

        </tr>

    </table>

</div>
<br>
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