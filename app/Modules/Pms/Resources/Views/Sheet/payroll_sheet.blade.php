<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
<title> Payroll Sheet </title>
    <style>
        table#header tr td {
            text-align: left;
            width: 33%;
            font-size: 15px;
        }

        table#body {
            border-collapse: collapse;
        }

        table#body tr td {
            border: 1px solid black;
            text-align: center;
        }

        table#body tr tr:first-child td {
            border-bottom: 1px solid grey;
            padding: 10px;
        }

    </style>
</head>

<body>

<div style="text-align: center;">
    <h3>PAYROLL</h3>
</div>
<div style="text-align: right; font-size: 11px;">
    FOR THE PERIOD FROM {{ strtoupper(date("F d Y",strtotime($site_period["period_from"]))) }}  TO {{ strtoupper(date("F d Y",strtotime($site_period["period_to"]))) }}
</div>
<div style="font-size: 10px; text-align: justify;">
    <p>WE HEREBY ACKNOWLEDGE TO HAVE RECEIVED FROM <span><b>{{ $site_period["siteId"]["company_name"]?strtoupper($site_period["siteId"]["company_name"]):'........' }}</b></span> AT ITS OFFICE AT <span><b>{{ $site_period["siteId"]["address"]?strtoupper($site_period["siteId"]["address"]):'......' }}</b></span>
    THE SUM SPECIFIED OPPOSITE OUR RESPECTIVE NAMES, AS FULL COMPENSATION FOR THE PERIOD.</p>
</div>

<table id="body" style="width: 100%; text-align: left; vertical-align: middle; font-size: 10px;">

    <tr>
        <td style="border-bottom: 1px solid black; padding: 7px; font-weight: bold">SL<br>NO.</td>
        <td style="border-bottom: 1px solid black; padding: 7px; text-align: center; font-weight: bold">EMPLOYEE<br>NAME</td>
        <td style="border-bottom: 1px solid black;padding: 7px; text-align: center; font-weight: bold">BASIC<br>RATE</td>
        <td style="border-bottom: 1px solid black; padding: 7px; font-weight: bold">ALLOWANCE</td>
        <td style="border-bottom: 1px solid black; padding: 7px; font-weight: bold">TOTAL</td>
        <td style="border-bottom: 1px solid black; padding: 7px; font-weight: bold">OVER<br>TIME</td>
        <td style="border-bottom: 1px solid black; padding: 7px; font-weight: bold">RATE OF<br>OVER TIME</td>
        <td style="border-bottom: 1px solid black; padding: 7px; width: 100px; text-align: center; font-weight: bold">OVER<br/>TIME<br>AMOUNT </td>
        <td style="border-bottom: 1px solid black; padding: 7px; width: 100px; text-align: center; font-weight: bold">TOTAL<br/>PAYABLE</td>
        <td style="border-bottom: 1px solid black; padding: 7px; text-align: center; font-weight: bold">DAYS<br>ABSENT</td>
        {{--<td style="border-bottom: 1px solid black; padding: 7px; text-align: center;" colspan="3">Allowance--}}
            {{--<table id="sub" style="width: 125%; border-top: 1px solid black;">--}}
                {{--<tr>--}}
                    {{--@foreach($site_allowance as $value)--}}
                    {{--<th>{{ str_limit($value->name,4) }}</th>--}}
                    {{--@endforeach--}}

                {{--</tr>--}}
            {{--</table>--}}
        {{--</td>--}}
        {{--<td style="border-bottom: 1px solid black; padding: 7px;width: 100px; text-align: center;">Total<br>Allowance </td>--}}
        <td style="text-transform: uppercase;font-weight: bold;border-bottom: 1px solid black; width: 15% !important; padding: 7px; text-align: center;" colspan="2">Deduction

        </td>
        <td style="text-transform: uppercase;font-weight: bold;border-bottom: 1px solid black; padding: 7px;width: 100px; text-align: center;">Total<br>Deduction </td>
        <td style="border-bottom: 1px solid black; padding: 7px; text-align: center; font-weight: bold">NET<br>AMOUNT<br>PAID</td>
        <td style="border-bottom: 1px solid black; padding: 7px; text-align: center; font-weight: bold">SIGNATURE OF PAYEE</td>


    </tr>

   @php
       $basic_salary = 0;
       $food_allowance = 0;
       $total = 0;
       $overtime = 0;
       $overtime_amount_per_hour = 0;
       $total_overtime = 0;
       $total_payable = 0;
       $tdays_absent = 0;
       $net_total_deduction = null;
       $net_advanced = 0;
       $net_absence = 0;
   @endphp
    <tr>
        <td colspan="10"></td>
        @foreach($site_deduction as $value)
            @php
            $deduct_sector[] = $value->id;
            @endphp

        @endforeach
        <td style="font-weight: bold;">ABSENCE</td>
        <td style="font-weight: bold; padding: 5px;">ADVANCE</td>
        <td colspan="3"></td>


    </tr>
    @foreach($data as $key=>$item)
        @php
            $basic_salary+= $item["basic_pay"];
            $food_allowance+= $item["allowance"];
            $total+= $item["total"];
            $overtime+= $item["overtime"];
            $overtime_amount_per_hour+= $item["overtime_amount_per_hour"];
            $total_overtime+= $item["total_overtime"];
            $total_payable+= $item["total"]+$item["total_overtime"];
            $tdays_absent+= $item["days_absent"];
            $deduction_data = $item->deduction;
            $sector_wise = [];
            $newsector = null;
            $total_deduction = null;
        @endphp

        <tr>
            <td>{{ ++$key }} </td>
            <td>{{ $item["name"] }}</td>
            <td>{{ $item["basic_pay"]>0?$item["basic_pay"]:'' }}</td>
            <td>{{ $item["allowance"]>0?$item["allowance"]:'' }}</td>
            <td>{{ $item["total"]>0?$item["total"]:'' }}</td>
            <td>{{ $item["overtime"]>0?$item["overtime"]:'' }}</td>
            <td>{{ $item["overtime_amount_per_hour"]>0?$item["overtime_amount_per_hour"]:'' }}</td>
            <td>{{ $item["total_overtime"]>0?$item["total_overtime"]:'' }}</td>
            <td>{{ ($item["total"]+$item["total_overtime"])>0?($item["total"]+$item["total_overtime"]):'' }}</td>
            <td>{{ $item["days_absent"]>0?$item["days_absent"]:'' }}</td>
            @foreach($deduct_sector as $key=>$value)
                @foreach($deduction_data as $item2)

                 @php
                 $newsector = ' ';
                 @endphp
                 @if($item2['pms_sectors_id']==2)
                        @php
                            $newsector= $item2['sector_amount'];
                        @endphp
                  @break;
                 @endif


                @endforeach
               @php

               @endphp
            @endforeach
            <td>{{ $item["deductionAbsense"]>0?$item["deductionAbsense"]:'' }}</td>
            <td>{{ $newsector }}</td>
           @php
               $total_deduction= $newsector+$item["deductionAbsense"];
              $net_total_deduction+=$total_deduction;
              $net_absence += $item["deductionAbsense"];
              $net_advanced += $newsector;

           @endphp
            <td>{{ $total_deduction>0?$total_deduction:''}} </td>
            <td> {{ $item["netAmountPaid"] }} </td>
            <td> </td>

        </tr>

    
     @endforeach
    <tr>
        <td># </td>
        <td> TOTAL</td>
        <td>{{  $basic_salary }}</td>
        <td> {{ $food_allowance }}</td>
        <td> {{ $total  }}</td>
        <td> {{ $overtime }}</td>
        <td> {{ $overtime_amount_per_hour }}</td>
        <td> {{ $total_overtime }}</td>
        <td> {{ $total_payable}}</td>
        <td> {{  $tdays_absent }}</td>





        {{--<td>Total</td>--}}
        {{--<td>Total</td>--}}

        <td>{{ $net_absence }}</td>
        <td>{{ $net_advanced }}</td>
        <td>{{ $net_total_deduction }}</td>
        <td></td>
        <td></td>


    </tr>
</table>

<div style="font-size: 10px;">
    <p>I HEREBY CERTIFY that I have personally paid in cash to each employee whose name appears above the amount set opposite his/her name.</p>
</div>
<br>
<table id="header"  style="width: 100%">

    <tr>
        <td style="text-align: left; font-size: 10px;">APPROVED BY</td>
        <td style="text-align: left; font-size: 10px;">CERTIFIED CORRECT</td>
        <td style="text-align: right; font-size: 10px;"></td>

    </tr>
    
    <tr>
        <td style="padding-top: 40px; text-align: left; font-size: 10px;"><span style="display:inline-block; border-top:1px dotted black; padding-top:6px;">DISBURSING OFFICER</span></td>
        <td style="padding-top: 40px; text-align: left; font-size: 10px;"><span style="display:inline-block; border-top:1px dotted black; padding-top:6px;">PAYMASTER</span></td>
        <td style="padding-top: 40px; text-align: right; font-size: 10px;"><span style="display:inline-block; border-top:1px dotted black; padding-top:6px;">DEPARTMENT HEAD</span></td>

    </tr>

</table>

</body>

</html>