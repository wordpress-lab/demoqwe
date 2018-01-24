<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">

    <style>
        body{
            text-transform:uppercase;
        }

        table#header tr td {
            text-align: left;
            text-transform:uppercase;
            width: 33%;
            font-size: 12px;
            font-weight: bold;

        }

        table#body tr td {
            text-align: left;
        }
        table#body tr tr:first-child td {
            border-bottom: 1px solid grey;
            padding: 10px;
        }

    </style>
</head>

<body>

<div class="uk-grid" style="text-align: center;" data-uk-grid-margin="">                         
    <div class="uk-width-small-5-5 uk-text-center">
        <img style="margin-bottom: -10px; margin-top: -20px;" class="logo_regular" src="{{ public_path('/uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/>
        <p style="line-height: 3px; margin-top: 30px;  font-size: 13; text-transform:capitalize;" class="uk-text-large">{{ $OrganizationProfile->company_name }}</p>
        <p style="line-height: 3px;" class="heading_b uk-text-success">IATA BILL</p>
        <p style="line-height: 3px; font-size: 13;" class="uk-text-small">42 30 4312</p>
        <p style="line-height: 3px; font-size: 10;" class="uk-text-small">From {{$start}}  To {{$end}}</p>
    </div>
</div>

<hr  style="height: 2px; color: #0a001f" />
<table id="body" style="width: 100%; text-align: left; vertical-align: top; font-size: 10px;">

    <tr>
        <td style="border-bottom: 1px solid black; padding: 7px;">Serial</td>
        <td style="border-bottom: 1px solid black; padding: 7px;">Passenger Name</td>
        <td style="border-bottom: 1px solid black;padding: 7px;">Ticket Number</td>
        <td style="border-bottom: 1px solid black; padding: 7px;">Issue Date</td>
        <td style="border-bottom: 1px solid black; padding: 7px;">Transaction Amount</td>
        <td style="border-bottom: 1px solid black; padding: 7px;">Fare Amount</td>
        <td style="border-bottom: 1px solid black; padding: 7px; width: 100px;"> <br/>Tax </td>
        <td style="border-bottom: 1px solid black; padding: 7px;">Commission Rate </td>
        <td style="border-bottom: 1px solid black; padding: 7px;">Amt Rate </td>
        <td style="border-bottom: 1px solid black; padding: 7px;width: 100px;"> Tax on Comm </td>
        <td style="border-bottom: 1px solid black; padding: 7px;"> Balance Payable</td>


    </tr>


    <?php $i=1; ?>
    @foreach($ita as $value)


        {!! $total=$value->Ticket_order->sum('amount') !!}
        {!!  $total_tax =$total_tax+$total !!}
        {!! $fare= $fare+$value->fareAmount !!}
        {!! $balance=($value->fareAmount)+$total !!}
        {!!
         $amt=($value->fareAmount)*(($value->commissionRate)/100)

        !!}
        {!! $total_amt = $amt+$total_amt !!}
        {!! $total_tex_com+= $value->taxOnCommission !!}
        {!! $com = $value->taxOnCommission !!}
        <tr>
            <td>{!! $i++ !!}</td>
            <td style="text-align: left;">{!! $value->first_name." ".$value->last_name !!}</td>
            <td>{!! $value->ticket_number !!}</td>
            <td>{!! $value->issuDate !!}</td>
            <td>{!! $balance !!}</td>
            {!! $total_trans += $balance  !!}
            <td>{!! $f= $value->fareAmount !!}</td>
            {!! $fare_to_amount+=$f !!}

            <td width="50px">
                @foreach($value->Ticket_order as $item)
                    {!! $item->amount !!} {!! $item->title !!}<br>
                @endforeach
            </td>
            <td>{!! $value->commissionRate !!}</td>
            <td>{!! (integer)$amt !!}</td>
            <td>
                - {!! (integer)$value->taxOnCommission !!}
            </td>

            <td> {!! (integer)$b=$balance-$amt+$com !!} </td>
            {!! $balance_total+= $b    !!}
        </tr>

    @endforeach
    <tr >
        <td style="border-top: 1px solid black">Total</td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black">{{ $total_trans }}</td>
        <td style="border-top: 1px solid black"> {{ $fare_to_amount }}</td>

        <td style="border-top: 1px solid black" width="50px">
            {{ $total_tax }}
        </td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black">{{ (integer)$total_amt }}</td>
        <td style="border-top: 1px solid black">
            {{ (integer)$total_tex_com }}
        </td>
        <td style="border-top: 1px solid black">  {{ (integer)$balance_total }} </td>
    </tr>

    <tr >
        <td style="border-top: 1px solid black">ADM Fee</td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>

        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black">+{{ $refund_others_adm_fee }}</td>
    </tr>

    <tr >
        <td style="border-top: 1px solid black">Refund</td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>

        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black">-{{ $refund_invoice }}</td>
    </tr>

    <tr >
        <td style="border-top: 1px solid black">D/F Air Commission</td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>

        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black">+{{ $refund_others_commission }}</td>
    </tr>

    <tr >
        <td style="border-top: 1px solid black">Total BSP Sales</td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>

        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black"></td>
        <td style="border-top: 1px solid black">{{ (integer)$balance_total + $refund_others_adm_fee - $refund_invoice + $refund_others_commission }}</td>
    </tr>

</table>

@if(count($ita)==0)
    <div style="padding-top: 50px; ">

        <p style="text-align: center;color: red;">There is no Billing Found</p>
    </div>

@endif

</body>

</html>