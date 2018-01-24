<html>

<head>
    <title>Manpower Summery</title>

    <style>
        title tr td{
            width:100%;

        }
        table{
            text-align: center;
            font-size: 10px;
        }
    </style>
</head>
<body >
<div style="text-align: center;">
    <img style="margin-bottom: -20px;"  src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="60" width="80"/>
    <p style="line-height: 1px; margin-top: 35px;" >{{ $OrganizationProfile->company_name }}</p>
    <p style="line-height: 1px; font-size: 13px;" > Manpower Summery </p>
    <p style="line-height: 0px; font-size: 9px;" >From {{$start}}  To {{$end}}</p>
</div>
<div style="text-align: center">


    <table border="1" cellpadding="4" cellspacing="0" width="100%" >


        <thead>
        <tr>
            <th>#</th>
            <th style="white-space:nowrap; width: 10%">Issue <br/>Date</th>
            <th>Order</th>
            <th>Customer</th>
            <th>Passenger</th>
            <th>Passport Number</th>

            <th>Phone</th>
            <th>Progress</th>
            <th>Delivery Date</th>
            <th>Destination <br/>Sector</th>
            <th>Invoice<br/>Amount</th>
            <th>Payable</th>
            <th>Status</th>
            <th>Vendor</th>

        </tr>
        </thead>


        <tbody>
        <?php $i=1; ?>
        @foreach($order as $value)
            <tr>
                <td>{!! $i++ !!}</td>
                <td style="white-space:nowrap; width: 10%">{!! $value->issue_date !!}</td>
                <td>{!! $value->order_id !!}</td>
                <td>{!! $value->contact['display_name'] !!}</td>
                <td>{!! $value['first_name']." ". $value['last_name'] !!}</td>
                <td>{!! $value->passport_number !!}</td>
                <td>{!! $value->sector !!}</td>
                <td>{!! $value->phone !!}</td>
                <td>{!! $value->ProgressStatus['title'] !!}</td>
                <td>{!! $value->sector !!}</td>
                <td>{!! $value->invoice['total_amount'] !!}</td>
                <td>{!! $value->bill['amount'] !!}</td>
                @if($value->status==0)
                    <td class="btn btn-danger" style="color: red; font-style: italic">Pending</td>
                @else
                    <td class="btn btn-success" style="color: green">Confirm</td>
                @endif
                <td>{!! $value->vendor['display_name'] !!}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>