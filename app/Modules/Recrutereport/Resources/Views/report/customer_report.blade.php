@extends('layouts.main')

@section('title', 'Recruite Report')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
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
                    <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                    <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                        <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Pax ID</th>
                            <th>Passenger Name</th>
                            <th>Reference</th>
                            <th>Visa(Bill Number)</th>
                            <th>Order(Invoice Number)</th>


                            <th>Report</th>
                            <th>Mofa</th>
                            <th>Fit Card</th>
                            <th>Police Clearance</th>

                            <th>Visa Stamping</th>
                            <th>Finger</th>
                            <th>Training</th>
                            <th>Manpower</th>
                            <th>Completion</th>
                            <th>Flight Submission</th>
                            <th>Flight Confirmation</th>

                            <th>Insurance</th>
                            <th>Submission</th>
                            <th>Receive</th>
                            <th>Recipient</th>
                            <th>Before 60 days</th>
                            <th>After 60 days</th>
                            <th class="uk-text-center">Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Serial</th>
                            <th>Pax ID</th>
                            <th>Passenger Name</th>
                            <th>Reference</th>
                            <th>Visa(Bill Number)</th>
                            <th>Order(Invoice Number)</th>


                            <th>Report</th>
                            <th>Mofa</th>
                            <th>Fit Card</th>
                            <th>Police Clearance</th>

                            <th>Visa Stamping</th>
                            <th>Finger</th>
                            <th>Training</th>
                            <th>Manpower</th>
                            <th>Completion</th>
                            <th>Flight Submission</th>
                            <th>Flight Confirmation</th>

                            <th>Insurance</th>
                            <th>Submission</th>
                            <th>Receive</th>
                            <th>Recipient</th>

                            <th>Before 60 days</th>
                            <th>After 60 days</th>

                            <th class="uk-text-center">Action</th>
                        </tr>
                        </tfoot>
                        <?php
                        $i=1;
                        ?>
                        <tbody>
                        @foreach ($recruit_order as $value)
                            <tr>
                                <td>{!! $i++ !!}</td>
                                <td>{!!$value->paxid !!}</td>
                                <td>{!!$value->passenger_name !!}</td>
                                <td>{{ $value->customer['display_name'] }}</td>
                                <td>{{ $value->registerserial['registerSerial'] }}
                                    @if($value->bill)
                                    (BILL-00000{{ $value->bill['bill_number'] }})
                                    @endif
                                </td>
                                <td>{{ date('d-m-Y', strtotime($value->created_at)) }}
                                    @if($value->invoice)
                                    (INV-{{ $value->invoice['invoice_number'] }})
                                    @endif
                                </td>


                                <td>
                                    {{ $value->medical_slip["medical_report_date"] }}
                                </td>
                                <td>
                                    {{ $value->mofas["mofaDate"] }}
                                </td>
                                <td>
                                    @if($value->fitcard)
                                        {{ $value->fitcard['receive_date'] }}
                                    @endif
                                </td>
                                <td>{{ $value->police?$value->police->submission_date:'' }}</td>

                                <td>{{ $value->visas?$value->visas->send_date:'' }}
                                    <br>{{ $value->visas?$value->visas->return_date:'' }}
                                </td>
                                <td>
                                    @if($value->finger)
                                        {{ $value->finger['assignedDate'] }}
                                    @endif
                                </td>
                                <td>{{ $value->training?$value->training->received_date:'' }}</td>
                                <td>{{$value->manpower['issuingDate']}} </br>{{$value->manpower['receivingDate']}}</td>
                                <td>{{ $value->completion['date'] }}</td>
                                <td>{{ $value->submission['submission_date'] }}<br>
                                    @if($value->submission['owner_approval'] == "0")
                                        Not Ok
                                    @elseif($value->submission['owner_approval'] == "1")
                                        Ok
                                    @endif    
                                </td>
                                <td>{{ $value->confirmation['date_of_flight'] }}<br>
                                    @if($value->confirmation['bill'])
                                    (BILL-00000{{ $value->confirmation['bill']->bill_number }})
                                    @endif
                                </td>
                                <td>{{ $value->insurance['date_of_payment']?date("Y-m-d",strtotime($value->insurance['date_of_payment'])):'' }}</td>
                                <td>{{ $value->iqamaSubmission['submission_date']?date("Y-m-d",strtotime($value->iqamaSubmission['submission_date'])):'' }}</td>
                                <td>{{ $value->iqamaReceive['receive_date']?date("Y-m-d",strtotime($value->iqamaReceive['receive_date'])):'' }}</td>
                                <td>{{ $value->reciepient['recipient_name'] }}</td>

                                <td>{{ $value->beforeSixtyDays['date_of_kafala']?date("Y-m-d",strtotime($value->beforeSixtyDays['date_of_kafala'])):'' }}</td>
                                <td>{{ $value->afterSixtyDays['receive_date']?date("Y-m-d",strtotime($value->afterSixtyDays['receive_date'])):'' }}</td>

                                <td class="uk-text-center">
                                    <a href="{{ route('customer_update' , $value->paxid) }}" class="batch-edit"><i class="md-icon material-icons uk-margin-right">&#xE8F4;</i></a>
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

@endsection

@section('scripts')
    <script>
        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_customer_report').addClass('act_item');
    </script>
@endsection
