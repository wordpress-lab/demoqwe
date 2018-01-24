<html>

<head>
    <title>Ticket Summery {{ $start }} to {{ $end }}</title>


    <style>
        title tr td{
            width:90%;

        }
        table{
            text-align: center;
            font-size: 9px;

        }
    </style>

</head>
<body >
<div style="text-align: center;">
    <img style="margin-bottom: -20px;"  src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="60" width="80"/>
    <p style="line-height: 1px; margin-top: 35px;" >{{ $OrganizationProfile->company_name }}</p>
    <p style="line-height: 1px; font-size: 13px;" > Ticket Summery </p>
    <p style="line-height: 0px; font-size: 9px;" >From {{$start}}  To {{$end}}</p>
</div>
<div style="text-align: center">


    <table border="1" cellpadding="4" cellspacing="0" width="90%" >


        <thead>
        <tr>
            <th>#</th>
            <th >Issue <br/>Date</th>
            <th>Order</th>
            <th>Customer</th>
            <th>Passenger</th>
            <th>Passport Number</th>
            <th>Ticket</th>

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
                <td>{!! $value->issuDate !!}</td>
                <td>{!! $value->order_id !!}</td>
                <td>{!! $value->contact['display_name'] !!}</td>
                <td>{!! $value['first_name']." ". $value['last_name'] !!}</td>
                <td>{!! $value->passport_number !!}</td>
                <td>{!! $value->ticket_number !!}</td>
                <td>{!! $value->departureSector !!}</td>

                <td>{!! $value->invoice['total_amount'] !!}</td>
                <td>{!! $value->bill['amount'] !!}</td>
                @if($value->status==0)
                    <td class="btn btn-danger" >Pending</td>
                @else
                    <td class="btn btn-success">Confirm</td>
                @endif
                <td>{!! $value->vendor['display_name'] !!}</td>

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