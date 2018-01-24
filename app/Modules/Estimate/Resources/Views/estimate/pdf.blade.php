<!DOCTYPE html>

<head>

    <title>Estimate </title>



    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 15px;
        }
        th{
            border: 1px solid #ccc;
        }
        td {

            height: 2em;
            border: 1px solid #ccc;
            text-align: center;
        }
        .column-left{ float: left; width: 50%; }
        .column-right{ float: right; width: 50%; }
        .container { margin-top: 15px;}
        @page { margin: 180px 50px; }
        #footer { position: fixed; left: 0px; bottom: -75px; right: 0px;   }
        #header { position: fixed; left: 0px; top: -140px;   right: 0px; text-align: center; }

        #footer .page:after { content: counter(page, upper-roman); }
    </style>
</head>

<body style="margin-top: 40px;">
<div id="header">
    @inject('theader', '\App\Lib\TemplateHeader')
    @if($theader->getBanner()->headerType)
  <img style="margin-top: -40px; " class="logo_regular" src="{{ asset($theader->getBanner()->file_url) }}" alt=""  width="100%"/>
    @else
   <img style="margin-top: -40px;" height="100" class="logo_regular" src="{{ asset('uploads/op-logo/logo.png') }}" alt=""  width="100%"/>
    @endif

</div>
@php
$number = new \App\Lib\NumberFormat();
@endphp

<div style=" clear: both;"></div>
<div id="footer">
    <div class="container" style="padding-top: 0px;">


        <div class="column-left" style="text-align: left;line-height: 3px;">
            <p> {!! $estimate->left_notation !!}</p>

        </div>

        <div class="column-right" style="text-align: right;line-height: 5px;">
            <p> {!! $estimate->right_notation !!}</p>

        </div>
    </div>
    <div style=" clear: both;"></div>
    <div  class="container" style="text-align: center;line-height: 3px;">

            <p>{{ $OrganizationProfile->street }},{{ $OrganizationProfile->city }}-{{ $OrganizationProfile->zip_code }},{{ $OrganizationProfile->country }}  </p>

            <p>Cell:{{ $OrganizationProfile->contact_number  }},Email:{{ $OrganizationProfile->email }}</p>




    </div>
</div>

  <div class="container" >

      <div class="column-left">Ref: {{ $estimate->ref }}</div>
      <div class="column-right" style="text-align: right">Date: {{ $estimate->date }}</div>
  </div>

  <div class="container">

   <div style="text-align: center; text-transform: uppercase;text-decoration: underline">
       Estimate
   </div>
  </div>

  <div class="container">

      <div class="column-left" style="line-height: 2px;">
          <p>{{ $estimate->customer->display_name }} </p>
          <p> {{ $estimate->customer->billing_street }}</p>
          <p> {{ $estimate->customer->billing_state }} , {{ $estimate->customer->billing_city }}-{{ $estimate->customer->billing_zip_code }}</p>
          <p> {{ $estimate->customer->billing_country }}</p>
      </div>

  </div>
<div style=" clear: both;"></div>
  <div class="container">

      <div class="column-left" style="line-height: 2px;width: 98%">
        <p>Attn: <b>{{ $estimate->attn }}</b></p>
          <p>&nbsp;  &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;{{ $estimate->attn_designation }}</p>
      </div>

  </div>

  <div style=" clear: both;"></div>
  <div class="container">

      <div class="column-left" style="line-height: 2px; width: 98%">
          <p>Sub: <b>{{ $estimate->subject }}</b></p>

      </div>

  </div>
@php
   // $towaord = new  \App\Lib\NumberFormat;

@endphp
  <div style=" clear: both;"></div>
  <div class="container">

      <div class="column-left" style=" width: 98%">
          <p>
       {!! $estimate->heading !!}

          </p>
      </div>

  </div>
  <div style=" clear: both;"></div>
  <div class="container" >

   <table>
       <caption style="text-align: left">{!! $estimate->table_head !!}  </caption>
       <tr>
           <td>#</td>
           <td>Item</td>
           <td>Qty</td>
           <td>Rate</td>
           <td>Discount (%)</td>
           <td>Amount </td>
       </tr>
      @foreach($estimate_entry as $key=> $value)
       <tr>
           <td>{{ ++$key }}</td>
           <td>{{ $value->item->item_name }}</td>
           <td>{{ $value->quantity }}</td>
           <td>{{ $value->rate }}</td>
           <td>{{ $value->discount }} (%)</td>
           <td>{{ $value->amount }} </td>
       </tr>

      @endforeach



       <tr >
           <td colspan="5" style="text-align: right;padding-right: 6px;">Tax</td>
           <td colspan="1">{{ $estimate->tax_total?$estimate->tax_total:0 }}</td>

       </tr>
       <tr >
           <td colspan="5" style="text-align: right;padding-right: 6px;">Shipping Charge</td>
           <td colspan="1">{{ $estimate->shipping_charge }}</td>

       </tr>
       <tr >
           <td colspan="5" style="text-align: right;padding-right: 6px;">Adjustment</td>
           <td colspan="1">{{ $estimate->adjustment }}</td>

       </tr>
       <tr >
           <td colspan="5" style="text-align: right;padding-right: 6px;"> Total </td>
           <td colspan="1" >{{ $estimate->total_amount }}</td>

       </tr>
   </table>

   <p>Total Amount in words: {{ $estimate->total_amount }} only</p>
  </div>

<div style=" clear: both;"></div>
<div class="container">

    <div class="column-left" style=" width: 98%;padding-top: 15px;">
        {!! $estimate->terms_conditions !!}

    </div>

</div>

<div style=" clear: both;"></div>

<div class="container">


    <div class="column-left" style="text-align: left">
        <p>Thank you, </p>
        <p>Sincerely yours,</p>
    </div>


</div>
<div style=" clear: both;"></div>




</body>

</html>
