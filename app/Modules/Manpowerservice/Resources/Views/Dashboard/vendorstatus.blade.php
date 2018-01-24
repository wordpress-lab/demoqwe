<html>

<head>
    <title>Vendor Status</title>

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
    <p style="line-height: 1px; font-size: 13px;" > Vendor Status </p>
    <p style="line-height: 0px; font-size: 10px;" >From {{$start}}  To {{$end}}</p>
</div>
<div style="text-align: center">

    <table  cellspacing="0" width="100%" cellpadding="3" border="1" >


        <thead>
        <tr>
            <th>Vendor Name</th>
            <th>Total Order</th>
            <th>Total Bill</th>
            <th>Total Payable</th>
            <th>Total Paid</th>
            <th>Balance</th>

        </tr>
        </thead>


        <tbody>
        @foreach($vendor as $value)
            <tr>
                <td>{!! $value->vendor['display_name'] !!}</td>


                <td>{{ $value->total_order }}</td>


                <td>{!! $value->total_bill !!}</td>
                <td>{!! $value->total_amount !!}</td>
                <td>{!! ($value->total_amount)-($value->due_amount) !!}</td>
                <td>{!! $value->due_amount !!}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>