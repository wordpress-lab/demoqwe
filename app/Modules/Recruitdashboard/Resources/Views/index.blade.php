@extends('layouts.main')

@section('title', 'Recruit Dashboard')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section("styles")
    <style>
        #details tr td{
            text-align: center;
        }
    </style>
@endsection
@section('content')
    @if(Session::has('msg'))
        <div class="uk-alert uk-alert-success" data-uk-alert>
            <a href="#" class="uk-alert-close uk-close"></a>
            {!! Session::get('msg') !!}
        </div>
    @endif

 <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_content">

                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px; width: 100%" class="dt_colVis_buttons"></div>
                                <table class="uk-table " style="" cellspacing="0" width="100%" id="saven_table" >
                                    <thead>
                                    <tr>
                                        <th style="width: 4px">#</th>
                                        <th style="width: 4px">#Serial</th>
                                        <th id="reset_width">Pax ID</th>
                                        <th >Passenger Name</th>
                                        <th >Reference</th>
                                        <th >Visa(Bill Number)</th>
                                        <th style="display: none;">Order(Invoice Number)</th>
                                        <th style="display: none;">Okala</th>
                                        <th style="display: none;">Gamca</th>
                                        <th style="display: none;">Report</th>
                                        <th style="display: none;">Mofa</th>
                                        <th style="display: none;">Fit Card</th>
                                        <th style="display: none;">Poice Clearance</th>
                                        <th style="display: none;">Masaned</th>
                                        <th style="display: none;">Visa Stamping</th>
                                        <th style="display: none;">Finger</th>
                                        <th style="display: none;">Training</th>
                                        <th style="display: none;">Manpower</th>
                                        <th style="display: none;">Completion</th>
                                        <th style="display: none;">Flight Submission</th>
                                        <th  style="display: none;">Flight Confirmation</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <?php
                                    $i=1;
                                    ?>
                                    <tbody id="saven_table_body">
                                    @foreach ($Rorder as $value)

                                        <tr id="toggle_details">
                                            <td style="font-size: 20px; color: #2196f3;width: 50px;">&#43;</td>
                                            <td>{{ $i++ }}</td>
                                <td id="col_details">
                                    {!!$value->paxid !!}
                                    <table id="details" style="width: 100%; display: none ;font-size: 11px;">
                                        <tr ><td colspan="4"><button class="md-btn md-btn-warning md-btn-wave-light waves-effect waves-button waves-light" id="hide">Close</button></td></tr>
                                        <tr style="background-color: #0a001f; color: goldenrod; font-size: 18px; text-align: center">
                                            <td>Title</td>
                                            <td>Details</td>

                                        </tr>

                                        <tr>
                                            <td>Reference Name</td>
                                            <td>
                                             {{ $value->customer['display_name'] }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Register Serial</td>
                                            <td>
                                             {{ $value->registerserial['registerSerial'] }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Medical Slip</td>
                                            <td>
                                               {{ $value->medicalslipFromPax->last()['dateOfApplication'] }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Bill</td>
                                            <td>
                                                @if($value->bill)
                                                    (BILL-{{ $value->bill['bill_number'] }})
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Invoice</td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($value->created_at)) }}
                                                @if($value->invoice)
                                                    ( INV-{{ $value->invoice['invoice_number'] }})
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Report</td>
                                            <td>
                                                {{ $value->medical_slip["medical_report_date"] }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Mofa</td>
                                            <td>
                                                @if($value->mofas)
                                                    {{ $value->mofas["mofaDate"] }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Fit Card</td>
                                            <td>
                                                @if($value->fitcard)
                                                    {{ $value->fitcard["receive_date"] }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Police Clearance</td>
                                            <td>
                                                {{ $value->police?$value->police->submission_date:'' }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Visa Stamping</td>
                                            <td>
                                                {{ $value->visas?$value->visas->send_date:'' }}
                                                <br>{{ $value->visas?$value->visas->return_date:'' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Finger</td>
                                            <td>
                                                @if($value->finger)
                                                    {{ $value->finger['assignedDate'] }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Training</td>
                                            <td>
                                                {{ $value->training?$value->training->received_date:'' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Manpower</td>
                                            <td>
                                                {{$value->manpower['issuingDate']}} </br>{{$value->manpower['receivingDate']}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Completion</td>
                                            <td>
                                                {{ $value->completion['date'] }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Flight Submission</td>
                                            <td>
                                                {{ $value->submission['submission_date'] }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Flight Confirmation</td>
                                            <td>
                                                {{ $value->confirmation['date_of_flight'] }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Insurance</td>
                                            <td>{{ $value->insurance['date_of_payment']?date("Y-m-d",strtotime($value->insurance['date_of_payment'])):'' }}</td>

                                        </tr>
                                        <tr>
                                            <td> Submission</td>
                                            <td>{{ $value->iqamaSubmission['submission_date']?date("Y-m-d",strtotime($value->iqamaSubmission['submission_date'])):'' }}</td>

                                        </tr>
                                        <tr>
                                            <td> Receive</td>
                                            <td>{{ date("Y-m-d",strtotime($value->iqamaReceive['receive_date'])) }}</td>
                                        </tr>
                                        <tr>
                                            <td> Recipient</td>
                                            <td>{{ $value->reciepient['recipient_name'] }}</td>
                                        </tr>
                                        <tr>
                                            <td> Before 60 days</td>
                                            <td>{{ $value->beforeSixtyDays['date_of_kafala']?date("Y-m-d",strtotime($value->beforeSixtyDays['date_of_kafala'])):'' }}</td>
                                        </tr>
                                        <tr>
                                            <td>After 60 days</td>

                                            <td>{{ $value->afterSixtyDays['receive_date']?date("Y-m-d",strtotime($value->afterSixtyDays['receive_date'])):'' }}</td>
                                        </tr>

                                    </table>
                                </td>
                                <td>{!! $value->passenger_name !!} </td>
                                <td>{{  $value->customer['display_name'] }}</td>
                                <td>
                                    {{ $value->registerserial['registerSerial'] }}
                                    @if($value->bill)
                                    (BILL-00000{{ $value->bill->bill_number }})
                                    @endif
                                </td>
                                <td style="display: none;">{{ date('d-m-Y', strtotime($value->created_at)) }}
                                    @if($value->invoice)
                                    ({{ $value->invoice->invoice_number }})
                                    @endif
                                </td>
                                <td style="display: none;">
                                    @if($value->okala)
                                        @if($value->okala->status === 0)
                                            Not Ok
                                        @elseif($value->okala->status === 1)
                                            Ok
                                        @endif
                                    @endif
                                </td>
                                <td style="display: none;"></td>
                                <td style="display: none;">
                                    @if($value->medical_slip)
                                        @if($value->medical_slip->status === 0)
                                            Not Ok
                                        @elseif($value->medical_slip->status === 1)
                                            Ok
                                        @endif
                                    @endif
                                </td>
                                <td style="display: none;">
                                    @if($value->mofa)
                                        @if($value->mofa->status === 0)
                                            Not Ok
                                        @elseif($value->mofa->status === 1)
                                            Ok
                                        @endif
                                    @endif
                                </td>
                                <td style="display: none;">
                                    @if($value->fitcard)
                                        {{ $value->fitcard->receive_date }}
                                    @endif
                                </td>
                                <td style="display: none;">{{ $value->police?$value->police->submission_date:'' }}</td>
                                <td style="display: none;">{{ $value->musanand?$value->musanand->issue_date:'' }}</td>
                                <td style="display: none;">{{ $value->visas?$value->visas->send_date:'' }}
                                    <br>{{ $value->visas?$value->visas->return_date:'' }}
                                </td>
                                <td style="display: none;">
                                    @if($value->finger)
                                        @if($value->finger['bmet_status'] === 0)
                                            Not Ok
                                        @elseif($value->finger['bmet_status'] === 1)
                                            Ok
                                        @endif
                                    @endif
                                </td>
                                <td style="display: none;">{{ $value->training?$value->training->received_date:'' }}</td>
                                <td style="display: none;">{{$value->manpower['issuingDate']}} </br>{{$value->manpower['receivingDate']}}</td>
                                <td style="display: none;">{{ $value->completion['smart_card_number'] }}</td>
                                <td style="display: none;">{{ $value->submission['expected_flight_date'] }}<br>
                                    @if($value->submission['owner_approval'] === 0)
                                        Not Ok
                                    @elseif($value->submission['owner_approval'] === 1)
                                        Ok
                                    @endif
                                </td>
                                <td style="display: none;">{{ $value->confirmation['date_of_flight'] }}<br>
                                    @if($value->confirmation['bill'])
                                    (BILL-00000{{ $value->confirmation['bill']->bill_number }})
                                    @endif
                                </td>

                                <td  class="uk-text-center">
                                    <a href="{{ route('customer_information_edit' , $value->paxid) }}" class="batch-edit"><i class="md-icon material-icons uk-margin-right">&#xE8F4;</i></a>
                                    {{-- <a href="#" class="batch-edit" data-uk-modal="{target:'#edit_modal{{$data->course_id}}'}"><i class="md-icon material-icons uk-margin-right">&#xE254;</i></a>--}}
                                </td>
                               </tr>


                                    @endforeach
                                    </tbody>
                                 </table>
                            </div>
                        </div>
                     </div>
                  </div>
  </div>

    <div class="uk-grid uk-grid-width-medium-1-1" data-uk-grid="{gutter:24}" style="position: relative; margin-left: -24px; height: 414px;">
        <div data-grid-prepared="true" style="position: absolute; box-sizing: border-box; padding-left: 24px; padding-bottom: 24px; top: 0px; opacity: 1; left: 0px;">
            <div  class="md-card md-card-collapsed"  style="">
                <div class="md-card-toolbar">
                    <div class="md-card-toolbar-actions">
                        <i class="md-icon material-icons md-card-fullscreen-activate"></i>
                        <i id="toggle_header" class="md-icon material-icons md-card-toggle" style="opacity: 1; transform: scale(1);"></i>
                        <i class="md-icon material-icons md-card-close"></i>
                    </div>
                    <h3 onclick="togglewindow(this)" style="width: 80%;" class="md-card-toolbar-heading-text ">
                        Medical Report Date Reminder <sup class="uk-badge" style="border-radius:50%; margin-bottom: 5px;">{{ count($medical_report_date_reminder) }}</sup>

                    </h3>





                </div>
                <div class="md-card-content" style="display: block;">
                    <div class="uk-grid" data-uk-grid-margin>

                        <div class="uk-width-large-10-10">

                            <h2 style="background-color: #073642;text-align: center;color: white"> Medical Report Date Reminder </h2>
                                <div class="user_content">
                                    <div class="uk-overflow-container uk-margin-bottom">
                                        <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                        <table class="uk-table" cellspacing="0" width="100%" id="eleventh_table" >
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Pax ID</th>
                                                <th>Passenger Name</th>
                                                <th>Medical Report Date</th>
                                                <th>Days Left</th>

                                                {{--<th class="uk-text-center">Action</th>--}}
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Pax ID</th>
                                                <th>Passenger Name</th>
                                                <th>Medical Report Date</th>
                                                <th>Days Left</th>

                                                {{--<th class="uk-text-center">Action</th>--}}
                                            </tr>
                                            </tfoot>
                                            <?php
                                            $k=1;
                                            ?>
                                            <tbody>
                                            @foreach ($medical_report_date_reminder as $value)
                                                <tr>
                                                    <td>{!! $k++ !!}</td>
                                                    <td>{!!$value->paxid  !!}</td>
                                                    <td>{{ $value->passenger_name }}</td>
                                                    <td>
                                                        @if($value->medical_report_date)
                                                        {{ date("d-m-Y",strtotime($value->medical_report_date)) }}
                                                        @else
                                                        n/a
                                                        @endif
                                                    </td>
                                                    <td>

                                                        {{ $value->leftdays." "."days" }}

                                                    </td>


                                                    {{--<td class="uk-text-center">--}}
                                                    {{--<a href="#" class="batch-edit"><i class="md-icon material-icons uk-margin-right">&#xE8F4;</i></a>--}}
                                                    {{--</td>--}}
                                                </tr>

                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div data-grid-prepared="true" style="position: absolute; box-sizing: border-box; padding-left: 24px; padding-bottom: 24px; top: 0px; opacity: 1; left: 0px;">
            <div  class="md-card md-card-collapsed"  style="">
                <div class="md-card-toolbar">
                    <div class="md-card-toolbar-actions">
                        <i class="md-icon material-icons md-card-fullscreen-activate"></i>
                        <i id="toggle_header" class="md-icon material-icons md-card-toggle" style="opacity: 1; transform: scale(1);"></i>
                        <i class="md-icon material-icons md-card-close"></i>
                    </div>
                    <h3 onclick="togglewindow(this)" style="width: 80%;" class="md-card-toolbar-heading-text ">
                        Next Visit Date Reminder <sup class="uk-badge" style="border-radius:50%; margin-bottom: 5px;">{{ count($nextvisit) }}</sup>

                    </h3>





                </div>
                <div class="md-card-content" style="display: block;">
                    <div class="uk-grid" data-uk-grid-margin>

                        <div class="uk-width-large-10-10">

                            <h2 style="background-color: #2b542c ;text-align: center;color: white"> Next Visit Date Reminder </h2>
                                <div class="user_content">
                                    <div class="uk-overflow-container uk-margin-bottom">
                                        <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                        <table class="uk-table" cellspacing="0" width="100%" id="ninth_table" >
                                            <thead>
                                            <tr>
                                                <th>Pax ID</th>
                                                <th>Report Date</th>
                                                <th>Next Visit Date</th>
                                                <th>Days Left</th>

                                                {{--<th class="uk-text-center">Action</th>--}}
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th>Pax ID</th>
                                                <th>Report Date</th>
                                                <th>Next Visit Date</th>
                                                <th>Days Left </th>

                                                {{--<th class="uk-text-center">Action</th>--}}
                                            </tr>
                                            </tfoot>
                                            <?php
                                            $i=1;
                                            ?>
                                            <tbody>
                                            @foreach ($nextvisit as $value)
                                                <tr>
                                                    <td>{!!$value->paxId['paxid']  !!}</td>
                                                    <td>{{ $value->paxId['passenger_name'] }}</td>
                                                    <td>
                                                        @if($value->medical_visit_date)
                                                        {{ date("d-m-Y",strtotime($value->medical_visit_date)) }}
                                                        @else
                                                        n/a
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($value->leftdays)
                                                        {{ $value->leftdays." "."days" }}
                                                        @else
                                                          n/a
                                                        @endif
                                                    </td>


                                                    {{--<td class="uk-text-center">--}}
                                                    {{--<a href="#" class="batch-edit"><i class="md-icon material-icons uk-margin-right">&#xE8F4;</i></a>--}}
                                                    {{--</td>--}}
                                                </tr>

                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div data-grid-prepared="true" style="position: absolute; box-sizing: border-box; padding-left: 24px; padding-bottom: 24px; top: 0px; opacity: 1; left: 0px;">
            <div  class="md-card md-card-collapsed"  style="">
                <div class="md-card-toolbar">
                    <div class="md-card-toolbar-actions">
                        <i class="md-icon material-icons md-card-fullscreen-activate"></i>
                        <i id="toggle_header" class="md-icon material-icons md-card-toggle" style="opacity: 1; transform: scale(1);"></i>
                        <i class="md-icon material-icons md-card-close"></i>
                    </div>
                    <h3 onclick="togglewindow(this)" style="width: 80%;" class="md-card-toolbar-heading-text ">
                        Passport Submit Reminder <sup class="uk-badge" style="border-radius:50%; margin-bottom: 5px;">{{ count($passport) }}</sup>
                    </h3>





                </div>
                <div class="md-card-content" style="display: block;">
                    <div class="uk-grid" data-uk-grid-margin>

                        <div class="uk-width-large-10-10">

                            <h2 style="background-color: #007f7f ;text-align: center;color: white"> Passport Submit Reminder</h2>
                                <div class="user_content">
                                    <div class="uk-overflow-container uk-margin-bottom">
                                        <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                        <table class="uk-table" cellspacing="0" width="100%" id="eight_table" >
                                            <thead>
                                            <tr>
                                                <th>Pax ID</th>
                                                <th>Passenger Name</th>
                                                <th>Received Date</th>
                                                <th>Time Left</th>

                                                {{--<th class="uk-text-center">Action</th>--}}
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th>Pax ID</th>
                                                <th>Passenger Name</th>
                                                <th>Received Date</th>
                                                <th>Time Left</th>

                                                {{--<th class="uk-text-center">Action</th>--}}
                                            </tr>
                                            </tfoot>
                                            <?php
                                            $i=1;
                                            ?>
                                            <tbody>
                                            @foreach ($passport as $value)
                                                <tr>
                                                    <td>{!!$value->medicalslipFromPax['paxid']  !!}</td>
                                                    <td>{{ $value->medicalslipFromPaxpassenger_name['passenger_name'] }}</td>
                                                    <td>{{ date("d-m-Y",strtotime($value->created_at)) }}</td>
                                                    <td>{{ $value->leftdays." "."days" }}</td>


                                                    {{--<td class="uk-text-center">--}}
                                                    {{--<a href="#" class="batch-edit"><i class="md-icon material-icons uk-margin-right">&#xE8F4;</i></a>--}}
                                                    {{--</td>--}}
                                                </tr>

                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div data-grid-prepared="true" style="position: absolute; box-sizing: border-box; padding-left: 24px; padding-bottom: 24px; top: 0px; opacity: 1; left: 0px;">
            <div class="md-card md-card-collapsed" style="">
                <div class="md-card-toolbar">
                    <div class="md-card-toolbar-actions">
                        <i class="md-icon material-icons md-card-fullscreen-activate"></i>
                        <i id="toggle_header" class="md-icon material-icons md-card-toggle" style="opacity: 1; transform: scale(1);"></i>
                        <i class="md-icon material-icons md-card-close"></i>
                    </div>
                    <h3 onclick="togglewindow(this)" style="width: 70%"  class="md-card-toolbar-heading-text">
                        Mofas Reminder <sup class="uk-badge" style="border-radius:50%; margin-bottom: 5px;">{{ count($recruit) }}</sup>
                    </h3>
                </div>
                <div class="md-card-content" style="display: block;">
                    <div class="uk-grid" data-uk-grid-margin>

                        <div class="uk-width-large-10-10">

                            <h2 style="background-color: #7CB343;text-align: center;color: white">Mofas Reminder</h2>
                                <div class="user_content">
                                    <div class="uk-overflow-container uk-margin-bottom">
                                        <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                        <table class="uk-table" cellspacing="0" width="100%" id="third_table" >
                                            <thead>
                                            <tr>
                                                <th>Pax ID</th>
                                                <th>Passenger Name</th>
                                                <th>Ref Name</th>
                                                <th>Time Left</th>
                                                <th>Report Date</th>
                                                {{--<th class="uk-text-center">Action</th>--}}
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th>Pax ID</th>
                                                <th>Passenger Name</th>
                                                <th>Ref Name</th>
                                                <th>Time Left</th>
                                                <th>Report Date</th>
                                                {{--<th class="uk-text-center">Action</th>--}}
                                            </tr>
                                            </tfoot>
                                            <?php
                                            $i=1;
                                            ?>
                                            <tbody>
                                            @foreach ($recruit as $value)
                                                <tr>
                                                    <td>{!!$value->paxid  !!}</td>
                                                    <td>{{ $value->passenger_name }}</td>
                                                    <td>{{ $value->display_name }}</td>
                                                    <td>
                                                        <?php

                                                        $my_date = new DateTime($value->medical_report_date);
                                                        $my_date->modify('+3 day');

                                                        $my_date2 = new DateTime(date('Y-m-d'));
                                                        if ($my_date<$my_date2){
                                                            echo '0 Days';
                                                        }else{

                                                            echo $my_date2->diff($my_date)->days.' Days';
                                                        }


                                                        ?>
                                                    </td>
                                                    <td>{{ $value->medical_report_date }}</td>

                                                    {{--<td class="uk-text-center">--}}
                                                    {{--<a href="#" class="batch-edit"><i class="md-icon material-icons uk-margin-right">&#xE8F4;</i></a>--}}
                                                    {{--</td>--}}
                                                </tr>

                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div data-grid-prepared="true" style="position: absolute; box-sizing: border-box; padding-left: 24px; padding-bottom: 24px; top: 73px; opacity: 1; left: 0px;">
            <div class="md-card md-card-collapsed">
                <div class="md-card-toolbar">
                    <div class="md-card-toolbar-actions">
                        <i class="md-icon material-icons md-card-fullscreen-activate"></i>
                        <i id="toggle_header" class="md-icon material-icons md-card-toggle" style="opacity: 1; transform: scale(1);"></i>
                        <i class="md-icon material-icons md-card-close"></i>
                    </div>
                    <h3 onclick="togglewindow(this)" style="width: 70%" class="md-card-toolbar-heading-text">
                        Processing Reminder  <sup class="uk-badge" style="border-radius:50%; margin-bottom: 5px;">{{ count($recruit2) }}</sup>
                    </h3>
                </div>
                <div class="md-card-content" style="display: none;">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-large-10-10">
                            <h2 style="background-color: #ff6d00;text-align: center;color: white">Processing Reminder</h2>
                                <div class="user_content">
                                    <div class="uk-overflow-container uk-margin-bottom">
                                        <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                        <table class="uk-table" cellspacing="0" width="100%" id="second_table" >
                                            <thead>
                                            <tr>
                                                <th>Pax ID</th>
                                                <th>Passenger Name</th>
                                                <th>Ref Name</th>
                                                <th>Time Left</th>
                                                <th>Fit Card Date</th>
                                                {{--<th class="uk-text-center">Action</th>--}}
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th>Pax ID</th>
                                                <th>Passenger Name</th>
                                                <th>Ref Name</th>
                                                <th>Time Left</th>
                                                <th>Fit Card Date</th>
                                                {{--<th class="uk-text-center">Action</th>--}}
                                            </tr>
                                            </tfoot>
                                            <?php
                                            $i=1;
                                            ?>
                                            <tbody id="saven_table">
                                            @foreach ($recruit2 as $value)
                                                <tr>

                                                    <td>{!!$value->paxid  !!}</td>
                                                    <td>{{ $value->passenger_name }}</td>
                                                    <td>{{ $value->display_name }}</td>
                                                    <td class="uk-text-center">
                                                        <?php

                                                        $my_date = new DateTime($value->receive_date);
                                                        $my_date->modify('+70 day');

                                                        $my_date2 = new DateTime(date('Y-m-d'));
                                                        if ($my_date<$my_date2){
                                                            echo '0 Days';
                                                        }else{

                                                            echo $my_date2->diff($my_date)->days.' Days';
                                                        }

                                                        ?>
                                                    </td>
                                                    <td>{{$value->receive_date }}</td>

                                                </tr>

                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div data-grid-prepared="true" style="position: absolute; box-sizing: border-box; padding-left: 24px; padding-bottom: 24px; top: 146px; opacity: 1; left: 0px;">
            <div class="md-card md-card-collapsed">
                <div class="md-card-toolbar">
                    <div class="md-card-toolbar-actions">
                        <i class="md-icon material-icons md-card-fullscreen-activate"></i>
                        <i  id="toggle_header" class="md-icon material-icons md-card-toggle" style="opacity: 1; transform: scale(1);"></i>
                        <i class="md-icon material-icons md-card-close"></i>
                    </div>
                    <h3 onclick="togglewindow(this)" style="width: 70%" class="md-card-toolbar-heading-text">
                        Cancelled Orders  <sup class="uk-badge" style="border-radius:50%; margin-bottom: 5px;">{{ count($cancelled_order) }}</sup>
                    </h3>
                </div>
                <div class="md-card-content" style="display: none;">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-large-1-1">
                            <h2 style="background-color: darkred;text-align: center;color: white">Cancelled Orders</h2>

                                <div class="user_content">
                                    <div class="uk-overflow-container uk-margin-bottom">
                                        <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                        <table class="uk-table" cellspacing="0" width="100%" id="fourth_table" >
                                            <thead>
                                            <tr>
                                                <th>Ref. Name</th>
                                                <th>Cancelled Order</th>
                                                <th>Substitute Order</th>
                                                <th>Last Updated</th>
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th>Ref. Name</th>
                                                <th>Cancelled Order</th>
                                                <th>Substitute Order</th>
                                                <th>Last Updated</th>
                                            </tr>
                                            </tfoot>
                                            <?php
                                            $i=1;
                                            ?>
                                            <tbody>
                                            @foreach ($cancelled_order as $value)
                                                <tr>
                                                    <td>{!!$value->display_name  !!}</td>
                                                    <td>{{ $value->paxid }} ({{ $value->passenger_name }})</td>
                                                    <td>{{ $value->substitued_order }}</td>
                                                    <td>
                                                        {{ $value->updated_by }}
                                                    </td>

                                                </tr>

                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div data-grid-prepared="true" style="position: absolute; box-sizing: border-box; padding-left: 24px; padding-bottom: 24px; top: 219px; opacity: 1; left: 0px;">
            <div class="md-card md-card-collapsed">
                <div class="md-card-toolbar">
                    <div class="md-card-toolbar-actions">
                        <i class="md-icon material-icons md-card-fullscreen-activate"></i>
                        <i id="toggle_header" class="md-icon material-icons md-card-toggle" style="opacity: 1; transform: scale(1);"></i>
                        <i class="md-icon material-icons md-card-close"></i>
                    </div>
                    <h3 onclick="togglewindow(this)" style="width: 70%" class="md-card-toolbar-heading-text">
                        Visa Validity Reminder <sup class="uk-badge" style="border-radius:50%; margin-bottom: 5px;">{{ count($visa_vil_reminder) }}</sup>
                    </h3>
                </div>
                <div class="md-card-content" style="display: none;">

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-large-1-1">
                            <h2 style="background-color: dimgrey;text-align: center;color: white">Visa Validity Reminder</h2>

                                <div class="user_content">
                                    <div class="uk-overflow-container uk-margin-bottom">
                                        <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                        <table class="uk-table" cellspacing="0" width="100%" id="fifth_table" >
                                            <thead>
                                            <tr>
                                                <th>Company Name</th>
                                                <th>Reference</th>
                                                <th>Visa Number</th>
                                                <th>Left Days</th>
                                                <th>Stamping Left</th>
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th>Company Name</th>
                                                <th>Reference</th>
                                                <th>Visa Number</th>
                                                <th>Left Days</th>
                                                <th>Stamping Left </th>
                                            </tr>
                                            </tfoot>
                                            <?php
                                            $i=1;
                                            ?>
                                            <tbody>
                                            @foreach ($visa_vil_reminder as $visa)
                                                @if($visa->numberofVisa-$visa->RecruitOrder->count()!=0)
                                                    <tr>
                                                        <td>{!!isset($visa->Company)?$visa->Company->name:''  !!}</td>
                                                        <td>{!! isset($visa->Contact)?$visa->Contact->display_name:''  !!}</td>
                                                        <td>{{ $visa->visaNumber }}</td>
                                                        <td>
                                                            {{ $visa->leftdays }}
                                                        </td>
                                                        <td>
                                                            {{ $visa->numberofVisa-$visa->RecruitOrder->count() }}

                                                        </td>

                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div data-grid-prepared="true" style="position: absolute; box-sizing: border-box; padding-left: 24px; padding-bottom: 24px; top: 292px; opacity: 1; left: 0px;">
            <div class="md-card md-card-collapsed">
                <div class="md-card-toolbar">
                    <div class="md-card-toolbar-actions">
                        <i class="md-icon material-icons md-card-fullscreen-activate"></i>
                        <i  id="toggle_header" class="md-icon material-icons md-card-toggle" style="opacity: 1; transform: scale(1);"></i>
                        <i class="md-icon material-icons md-card-close"></i>
                    </div>
                    <h3 onclick="togglewindow(this)" style="width: 70%" class="md-card-toolbar-heading-text">
                        Visa Stamping Without Payment  <sup class="uk-badge" style="border-radius:50%; margin-bottom: 5px;">{{ count($stamping_without_payment) }}</sup>
                    </h3>
                </div>
                <div class="md-card-content" style="display: none;">

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-large-1-1">
                            <h2 style="background-color: chocolate;text-align: center;color: white">Visa Stamping Without Payment</h2>

                            <div class="user_content">
                                <div class="uk-overflow-container uk-margin-bottom">
                                    <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                    <table class="uk-table" cellspacing="0" width="100%" id="six_table" >
                                        <thead>
                                        <tr>
                                            <th>Pax Id</th>
                                            <th>Reference</th>
                                            <th>Passenger Name</th>
                                            <th>Visa Stamping Date</th>
                                            <th>Due </th>

                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Pax Id</th>
                                            <th>Reference</th>
                                            <th>Passenger Name</th>
                                            <th>Visa Stamping Date</th>
                                            <th>Due </th>
                                        </tr>
                                        </tfoot>
                                        <?php
                                        $i=1;
                                        ?>
                                        <tbody>
                                        @foreach ($stamping_without_payment as $stamping)

                                            <tr>
                                                <td>{{ $stamping->paxId['paxid'] }}</td>
                                                <td>{{ isset($stamping->paxId->customer->display_name)?$stamping->paxId->customer['display_name']:'' }}</td>

                                                <td>{{ $stamping->paxId['passenger_name'] }}</td>
                                                <td>
                                                    {{ $stamping['return_date'] }}
                                                </td>
                                                <td>
                                                    {{ $stamping->paxId->invoice['due_amount'] }}
                                                </td>


                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div data-grid-prepared="true" style="position: absolute; box-sizing: border-box; padding-left: 24px; padding-bottom: 24px; top: 365px; opacity: 1; left: 0px;">
            <div class="md-card md-card-collapsed">
                <div class="md-card-toolbar">
                    <div class="md-card-toolbar-actions">
                        <i class="md-icon material-icons md-card-fullscreen-activate"></i>
                        <i id="toggle_header" class="md-icon material-icons md-card-toggle"></i>
                        <i class="md-icon material-icons md-card-close"></i>
                    </div>
                    <h3 onclick="togglewindow(this)" style="width: 70%" class="md-card-toolbar-heading-text">
                       Manpower Reminder <sup class="uk-badge" style="border-radius:50%; margin-bottom: 5px;">{{ count($manpower_payment)  }}</sup>
                    </h3>
                </div>
                <div class="md-card-content" style="display: none;">

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-large-1-1">
                            <h2 style="background-color: maroon;text-align: center;color: white">Manpower Reminder </h2>

                            <div class="user_content">
                                <div class="uk-overflow-container uk-margin-bottom">
                                    <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                    <table class="uk-table" cellspacing="0" width="100%" id="six_table" >
                                        <thead>
                                        <tr>
                                            <th>Pax Id</th>
                                            <th>Passenger Name</th>
                                            <th>Ref Name</th>
                                            <th>Fit Card Date</th>
                                            <th>Days Left </th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Pax Id</th>
                                            <th>Passenger Name</th>
                                            <th>Ref Name</th>
                                            <th>Fit Card Date</th>
                                            <th>Days Left </th>
                                        </tr>
                                        </tfoot>

                                        <tbody>
                                        @foreach ($manpower_payment as $manpower)

                                            <tr>
                                                <td>{{ $manpower->pax_Id['paxid'] }}</td>
                                                <td>{{ $manpower->pax_Id['passenger_name'] }}</td>
                                                <td>{{ $manpower->pax_Id->customer['display_name']}}</td>
                                                <td>{{ $manpower['receive_date']}}</td>
                                                <td>{{ $manpower['leftdays']}}</td>
                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div data-grid-prepared="true" style="position: absolute; box-sizing: border-box; padding-left: 24px; padding-bottom: 24px; top: 365px; opacity: 1; left: 0px;">
            <div class="md-card md-card-collapsed">
                <div class="md-card-toolbar">
                    <div class="md-card-toolbar-actions">
                        <i class="md-icon material-icons md-card-fullscreen-activate"></i>
                        <i id="toggle_header" class="md-icon material-icons md-card-toggle"></i>
                        <i class="md-icon material-icons md-card-close"></i>
                    </div>
                    <h3 onclick="togglewindow(this)" style="width: 70%" class="md-card-toolbar-heading-text">
                       Dukhliya Reminder <sup class="uk-badge" style="border-radius:50%; margin-bottom: 5px;">{{ count($dukhliya) }}</sup>
                    </h3>
                </div>
                <div class="md-card-content" style="display: none;">

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-large-1-1">
                            <h2 style="background-color: green;text-align: center;color: white">Dukhliya Reminder </h2>

                            <div class="user_content">
                                <div class="uk-overflow-container uk-margin-bottom">
                                    <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                    <table class="uk-table" cellspacing="0" width="100%" id="ten_table" >
                                        <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Pax Id</th>
                                            <th>Passenger Name</th>
                                            <th>Date of Flight</th>
                                            <th>Days Passed</th>

                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Pax Id</th>
                                            <th>Passenger Name</th>
                                            <th>Date of Flight</th>
                                            <th>Days Passed</th>
                                        </tr>
                                        </tfoot>

                                        <tbody>
                                        @foreach ($dukhliya as $key=>$item)

                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $item->paxId['paxid'] }}</td>
                                                <td>{{ $item->paxId['passenger_name'] }}</td>
                                                <td>{{ $item['date_of_flight'] }}</td>

                                                <td>{{ $item['passdays']}}</td>
                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

     function deleterow(link) {
     UIkit.modal.confirm('Are you sure?', function(){
     window.location.href = link;
       });
   }
    </script>
@endsection

@section('scripts')
    <script>
        function togglewindow(ele) {
           var i=0;
         $(ele).prev().find("#toggle_header").click();

        }

        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_recruit_dashboard').addClass('act_item');
        $('#second_table').DataTable({
            "pageLength": 50
        });
        $('#third_table').DataTable({
            "pageLength": 50
        });
        $('#fourth_table').DataTable({
            "pageLength": 50
        });
        $('#fifth_table').DataTable({
            "pageLength": 50
        });
        $('#six_table').DataTable({
            "pageLength": 50
        });
        $('#saven_table').DataTable({
            "pageLength": 50
        });
        $('#eight_table').DataTable({
            "pageLength": 50
        });
        $('#ten_table').DataTable({
            "pageLength": 50
        });
        $('#eleventh_table').DataTable({
            "pageLength": 50
        });




      $("#saven_table_body tr#toggle_details").on("click",function (e) {

          this.cells[0].innerHTML = "&#45;";
          $.each($(this).children(), function( index, value ) {
              if(index==2){
               $(value).css("width","75%").children("table").fadeIn(800);
              }
              if(index==1){
                  $(value).css("width","5%");
              }
              if(index==21){
                  return false;
              }

          });

      } );

        $("button#hide").on("click",function (e) {

           e.stopPropagation();
         $(this).parents("#toggle_details").children(":first").html("&#43;");
         // console.log($(this).children("table").hide());

         $(this).parents("#details").hide();

         $(this).parents("#details").fadeOut(800);

        });

    </script>
@endsection
