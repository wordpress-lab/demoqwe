<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>


    </style>

</head>
<body style="font-family: freeserif; font-size: 10pt;">

<div role="main" class="container">

    <div class="col-md-4">
        <img style="width: 140px;height: 50px;margin-left: -30px" src="{!! asset('uploads/op-logo/'.$logo->logo) !!}" alt="">
    </div>
    <div class="row">
        <div class="col-md-4" style="text-align: center;padding-top: -90px;padding-left: 80px">
            <h1 style="font-weight: 900;text-transform: uppercase;color: green;font-size: 25px">{!! $logo->company_name !!}</h1>
            <h6 style="font-weight: 400;text-transform: uppercase">({!! $logo->street !!}, {!! $logo->city !!}, {!! $logo->state !!}, {!! $logo->country !!}, {!! $logo->zip_code !!}, {!! $logo->contact_number !!}, {!! $logo->email !!}, {!! $logo->website !!})</h6>
        </div>
    </div>
    <br>


    <div class="row" style="margin: 0;padding: 0">
        <div style="margin: 0;padding: 0">
            <p style="margin: 0;padding: 0;text-transform: uppercase">order id.{!! $t !!}</p>
        </div>
        <div style="margin: 0;padding: 0;padding-top: -20px">
            @if($order->status==0)
                <p style="margin: 0;padding: 0;text-transform: uppercase;text-align: center ">status: <span style="color: red">pending</span></p>
            @else
                <p style="margin: 0;padding: 0;text-transform: uppercase;text-align: center ">status: <span style="color: green">Confirmed</span> </p>
            @endif
        </div>
        <div style="margin: 0;padding-top: -20px;margin-right: 30px">
            <p style="text-align: right;text-transform: uppercase">issue date: {!! $order->issuDate !!}</p>
        </div>
    </div>

    <div class="row" style="border: 1px solid green">
        <div class="col-md-4">

            <h5> Customer Name: {!! $order->first_name !!} {!! $order->last_name !!}</h5>
            <h5>Ticket Number: {!! $order->ticket_number !!}</h5>

            <h5>PNR Creation Date: {!! $order->pnrcreationDate !!}</h5>
            <h5>Issue Time Limit: {!! $order->issuetimeLimit !!}</h5>
            <h5>Departure Sector: {!! $order->departureSector !!}</h5>

        </div>
        <div class="col-md-4" style="padding-left: 400px;padding-top: -140px">

            <h5>Contact Number: {!! $order->contact_number !!}</h5>
            <h5>Record Location: {!! $order->recordLocator !!}</h5>

            <h5>Document number: {!! $order->documentNumber !!}</h5>
            <h5>Return Sector: {!! $order->returnSector !!}</h5>
        </div>
        <div class="col-md-8">
            <h5 style="float: left;padding-right: 100px">Passenger: </h5>
            <h5 style="float: left;padding-right: 150px">{!! $order->adultPassenger !!} (Adult) </h5>
            <h5 style="float: left;padding-right: 120px">{!! $order->childPassenger !!} (Children)</h5>
            <h5 style="float: left">{!! $order->infantPassenger !!} (Infant) </h5>
        </div>

    </div>
    <br>

    <h4 style="text-transform: uppercase;text-decoration: underline;color: green">departure:</h4>

    <div class="row">
        <div class="col-md-4">
            <h6 style="text-transform: uppercase"> from : {!! $order->departureFrom !!}</h6>
        </div>
        <div class="col-md-4" style="padding-left: 250px;padding-top: -35px">
            <h6 style="text-transform: uppercase">To: {!! $order->arriveTo !!}</h6>
        </div>
        <div class="col-md-4" style="padding-left: 480px;padding-top: -35px">
            <h6 style="text-transform: uppercase">sector: {!! $order->departureSector !!}</h6>
        </div>

    </div>
    <div class="row">
        <div class="col-md-4">
            <h6 style="text-transform: uppercase"> date : {!! $order->departureDate !!}</h6>
        </div>
        <div class="col-md-4" style="padding-left: 250px;padding-top: -35px">
            <h6 style="text-transform: uppercase">departure time: {!! $order->departureTime !!}</h6>
        </div>
        <div class="col-md-4" style="padding-left: 480px;padding-top: -35px">
            <h6 style="text-transform: uppercase">arrival time: {!! $order->arrivalTime !!}</h6>
        </div>

    </div>
    <div class="row">
        <div class="col-md-4">
            <h6 style="text-transform: uppercase"> flight code : {!! $order->departureflightCode !!}</h6>
        </div>
        <div class="col-md-4" style="padding-left: 250px;padding-top: -35px">
            <h6 style="text-transform: uppercase">flight class: {!! $order->departureflightClass !!}</h6>
        </div>

    </div>

    <br>
    <h4 style="text-transform: uppercase;text-decoration: underline;color: green">return:</h4>

    <div class="row">
        <div class="col-md-4">
            <h6 style="text-transform: uppercase"> from : {!! $order->returnflightFrom !!}</h6>
        </div>
        <div class="col-md-4" style="padding-left: 250px;padding-top: -35px">
            <h6 style="text-transform: uppercase">To: {!! $order->returnflightTo !!}</h6>
        </div>
        <div class="col-md-4" style="padding-left: 480px;padding-top: -35px">
            <h6 style="text-transform: uppercase">sector: {!! $order->returnSector !!}</h6>
        </div>

    </div>
    <div class="row">
        <div class="col-md-4">
            <h6 style="text-transform: uppercase"> date : {!! $order->returnflightDate !!}</h6>
        </div>
        <div class="col-md-4" style="padding-left: 250px;padding-top: -35px">
            <h6 style="text-transform: uppercase">departure time: {!! $order->returnflightdepartureTime !!}</h6>
        </div>
        <div class="col-md-4" style="padding-left: 480px;padding-top: -35px">
            <h6 style="text-transform: uppercase">arrival time: {!! $order-> returnflightarrivalDate!!}</h6>
        </div>

    </div>
    <div class="row">
        <div class="col-md-4">
            <h6 style="text-transform: uppercase"> flight code : {!! $order->returnflightCode !!}</h6>
        </div>
        <div class="col-md-4" style="padding-left: 250px;padding-top: -35px">
            <h6 style="text-transform: uppercase">flight class: {!! $order->returnflightbookingClass !!}</h6>
        </div>

    </div>

    <br>
    <h4 style="text-transform: uppercase;text-decoration: underline;color: green">hotel:</h4>

    <div class="row">
        <div class="col-md-4">
            <h6 style="text-transform: uppercase"> name : {!! $order->hotel['title'] !!}</h6>
        </div>
        <div class="col-md-4" style="padding-left: 250px;padding-top: -35px">
            <h6 style="text-transform: uppercase">country: {!! $order->hotel['country'] !!}</h6>
        </div>

    </div>
    <div class="row">
        <div class="col-md-4">
            <h6 style="text-transform: uppercase"> address : {!! $order->hotel['address'] !!}</h6>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h6 style="text-transform: uppercase"> note : {!! $order->hotel['note'] !!}</h6>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h6 style="text-transform: uppercase"> comment : {!! $order->hotel_note !!}</h6>
        </div>
    </div>


</div>

</body>
</html>