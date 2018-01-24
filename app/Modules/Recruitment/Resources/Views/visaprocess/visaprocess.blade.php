<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="{{ public_path().'/css/bootstrap.min.css'}}" rel="stylesheet">

    <link href="{{ public_path().'/css/style.css' }}" rel="stylesheet">
    <style>


    </style>

</head>
<body style="font-family: freeserif; font-size: 10pt;">

<div role="main" class="container">
    <div class="row">
        <div class="col-md-4">
            <img style="width: 60px;height: 60px;padding-top: -10px" src="{!! public_path('/uploads/op-logo/'.$logo->logo) !!}" alt="">
        </div>
        <div class="col-md-8" style="text-align: center;padding-top: -70px">
            <h1 style="font-weight: 900;text-transform: uppercase;">{!! isset($frombasis->companyNameEN) ? $frombasis->companyNameEN:''  !!}</h1>
            <h4 style="font-weight: 400;text-transform: uppercase">(processing report)</h4>
        </div>
    </div>
    <div class="container">
        <div class="row" style="margin: 0;padding: 0">
            <div style="margin: 0;padding: 0">
                <p style="margin: 0;padding: 0;text-transform: uppercase">rsl:{!! isset($visaentry->registerSerial) ? $visaentry->registerSerial:'' !!}</p>
                <p style="margin: 0;padding: 0;text-transform: uppercase">rsl:{!! isset($visa->date )? $visa->date:'' !!}</p>
            </div>
            <div style="margin: 0;padding-top: -40px;margin-right: 100px">
                <p style="margin: 0;padding: 0;text-align: right;text-transform: uppercase">vls no: {!! isset($visa->vls_number) ? $visa->vls_number:''  !!}</p>
                <p style="margin: 0;padding: 0;text-align: right;text-transform: uppercase">group: {!! isset($customer->group) ? $customer->group:''  !!}</p>
                <p style="margin: 0;padding: 0;text-align: right;text-transform: uppercase">sect: {!! isset($visaentry->iqamaSector) ? $visaentry->iqamaSector:''  !!}</p>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-md-4">
                <h5 style="text-transform: uppercase;font-size: 13px">name: {!! isset($recruit->passenger_name) ? $recruit->passenger_name:''  !!}</h5>
                <h5 style="text-transform: uppercase;font-size: 13px">father's name:{!! isset($customer->fatherName) ? $customer->fatherName:''  !!} </h5>
                <h5 style="text-transform: uppercase;font-size: 13px">visa no: {!! isset($visaentry->visaNumber) ? $visaentry->visaNumber:'' !!} </h5>
                <h5 style="text-transform: uppercase;font-size: 13px">date of visa receving: {!! isset($visaentry->visaIssuedate) ? $visaentry->visaIssuedate:'' !!}</h5>
                <h5 style="text-transform: uppercase;font-size: 13px">local ref: {!! isset($local->first_name) ? $local->first_name:'' !!},{!! isset($local->last_name) ? $local->last_name:'' !!}</h5>
                <h5 style="text-transform: uppercase;font-size: 13px">local ref (phone): {!! isset($local->phone_number_1) ? $local->phone_number_1:'' !!}</h5>

            </div>
            <div class="col-md-4" style="padding-left: 370px;padding-top: -165px">
                <h5 style="text-transform: uppercase;font-size: 13px">p.p. no: {!! isset($recruit->passportNumber) ? $recruit->passportNumber:''  !!}</h5>
                <h5 style="text-transform: uppercase;font-size: 13px">profession: {!! isset($customer->professionEn) ? $customer->professionEn:''  !!}</h5>
                <h5 style="text-transform: uppercase;font-size: 13px">phone no.of sponsor:</h5>
                <h5 style="text-transform: uppercase;font-size: 13px">foreign ref:{!! isset($company->name) ? $company->name:''  !!}</h5>
                <h5 style="text-transform: uppercase;font-size: 13px">foreign ref (phone): </h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h5 style="text-transform: uppercase;font-size: 13px">1. sub.dt to emb.(for profe): {!! isset($visaentry->submissionDate) ? $visaentry->submissionDate:''  !!}</h5>
                <h5 style="text-transform: uppercase;font-size: 13px">3. submit dt.to gamca: {!! isset($gamca->submission_date) ? $gamca->submission_date:'' !!}</h5>
                <h5 style="text-transform: uppercase;font-size: 13px">5. p.p. receving date: {!! isset($recruit->passportissuedate) ? $recruit->passportissuedate:'' !!} </h5>
                <h5 style="text-transform: uppercase;font-size: 13px">7. medical fit/unfit:dt:
                    @if(isset($medicalslip->status))
                    @if($medicalslip->status==0)
                        UnFit
                        @else
                    Fit
                    @endif
                        @endif
                </h5>
                <h5 style="text-transform: uppercase;font-size: 13px">13. b.m.e.t. clearence dt:{!! isset($manpower->receivingDate) ? $manpower->receivingDate:'' !!}</h5>

            </div>
            <div class="col-md-6" style="padding-left: 370px;padding-top: -140px">
                <h5 style="text-transform: uppercase;font-size: 13px">2. delivery dt: </h5>
                <h5 style="text-transform: uppercase;font-size: 13px">6. date of medical test: {!! isset($medicalslip->testdate) ? $medicalslip->testdate:'' !!}</h5>
                <h5 style="text-transform: uppercase;font-size: 13px">8. medical report date: {!! isset($medicalslip->reportdate) ? $medicalslip->reportdate:'' !!}</h5>
                <h5 style="text-transform: uppercase;font-size: 13px">10.sub.dt.from emb(stamping):</h5>
                <h5 style="text-transform: uppercase;font-size: 13px">12.sub.dt.from bmet(stamping): {!! isset($manpower->issuingDate) ? $manpower->issuingDate:'' !!}</h5>
                <h5 style="text-transform: uppercase;font-size: 13px">15. flight date:{!! isset($flight->flightDate) ? $flight->flightDate:'' !!}</h5>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th colspan="2" style="border-right: none;text-transform: uppercase ">service charge</th>
                <th colspan="3" style="border-right: none;text-align: center;text-transform: uppercase">ldr.page no</th>
            </tr>
            <tr>
                <th>Date</th>
                <th>Particulars</th>
                <th>Folio/rct.no</th>
                <th>Amount</th>
                <th>total</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $temptotal=isset($invoice->total_amount)?$invoice->total_amount:0;
            ?>
            @foreach($payrecentry as $value)
                @php

                    $amount=$value->amount;
                    $temptotal=($temptotal-$amount);

                @endphp
            <tr>
                <td>{!! $value->created_at->toDateString() !!}</td>
                <td>{!! $value->paymentReceive->note !!}</td>
                <td>PR-{!! decbin($value->id) !!}</td>
                <td>{!! $amount !!}</td>
                <td>{!! $temptotal !!}</td>
            </tr>
                @endforeach

            </tbody>
        </table>

        <div class="row">
            <div class="col-md-6">
                <p style="text-transform: uppercase;font-weight: 900;">account's section</p>
                <p style="text-transform: uppercase;font-weight: 900;margin-top: 30px;text-decoration: overline">signature</p>
            </div>
            <div class="col-md-6" style="text-align: right;padding-top: -80px;margin: 0">
                <p style="text-transform: uppercase;font-weight: 900;">proprietor</p>
                <p style="text-transform: uppercase;font-weight: 900;margin-top: 30px;text-decoration: overline">signature</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <p style="text-transform: uppercase;font-weight: 900;">remarks(if any): {!! $visa->remarks !!}</p>
            </div>
        </div>
    </div>

</div> <!-- /container -->

</body>
</html>