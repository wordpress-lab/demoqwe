<html>

<head>
    <title>Vendor Status {{ $start }} to {{ $end }}</title>

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
    <p style="line-height: 1px; font-size: 13px;" > {{ $vendor }} Vendor Status </p>
    <p style="line-height: 0px; font-size: 10px;" >From {{$start}}  To {{$end}}</p>
</div>
<div style="text-align: center">

    <table  cellspacing="0" width="100%" cellpadding="3" border="1" >


        <thead>
        <tr>
            <th>Date</th>
            <th>Order Id</th>
            <th>Ticket Number</th>
            <th>Payable</th>
            <th>Paid</th>
            <th>Due</th>

        </tr>
        </thead>


        <tbody>
        @foreach($order as $value)
            <tr>
                <td>{!! date("Y-m-d",strtotime($value->created_at)) !!}</td>
                <td>{!! $value->order_id !!}</td>
                <td>{!! $value->ticket_number !!}</td>
                <td>{!! $value->bill['amount'] !!}</td>
                <td>{!! ($value->bill['amount'])-($value->bill['due_amount']) !!}</td>
                <td>{!! $value->bill['due_amount'] !!}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<script>
    window.onload =function () {

        print();

    }
</script>
</body>
</html>