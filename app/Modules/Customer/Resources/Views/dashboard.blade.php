@extends('layouts.admin')

@section('title', 'Customer Dashboard')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection



@section('content')
    <div class="uk-width-large-10-10">

        <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
            @include('inc.customer_nav')

            <div class="uk-width-xLarge-8-10  uk-width-large-8-10">

                    <div  class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-sortable data-uk-grid-margin>
                        <div>
                            <div class="md-card">
                                <div class="md-card-content">

                                    <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_visitors peity_data">5,3,9,6,5,9,7</span></div>
                                    <span class="uk-text-muted uk-text-small">Total Recievable</span>
                                    <h2 class="uk-margin-remove">‎৳ <span class="countUpMe">
                                                @if(isset($totalamount->total_amount))
                                                {{ $totalamount->total_amount }}
                                            @else
                                                000
                                            @endif
                                            </span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="md-card">
                                <div class="md-card-content">
                                    <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span></div>
                                    <span class="uk-text-muted uk-text-small">Total Recieved</span>
                                    <h2 class="uk-margin-remove">‎৳
                                        <span class="countUpMe">
                                                 @php
                                                     $total =000;
                                                 @endphp
                                            @foreach($payment_entry as $value)
                                                @php

                                                    $total+=$value->amount;
                                                @endphp


                                            @endforeach
                                            @if($total==0)
                                                000
                                            @else
                                                {{ $total }}
                                            @endif
                                            </span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="md-card">
                                <div class="md-card-content">
                                    <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_orders peity_data">64/100</span></div>
                                    <span class="uk-text-muted uk-text-small">Total Due</span>
                                    <h2 class="uk-margin-remove">‎৳ <span class="countUpMe">
                                                @php
                                                    if(isset($totalamount->total_amount)){
                                                     $due= $totalamount->total_amount - $total;
                                                    }else{
                                                    $due = "000";
                                                    }

                                                @endphp
                                            {{ $due }}
                                            </span></h2>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="md-card">
                                <div class="md-card-content" onload="totalExpense();">
                                    <div  class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_orders peity_data">64/100</span></div>
                                    <span class="uk-text-muted uk-text-small">Total Expense</span>
                                    <h2 class="uk-margin-remove">‎৳ <span id="expense_num" class="countUpMe">{{ $expense }}</span></h2>
                                </div>
                            </div>
                        </div>

                    </div>


                <div class="md-card">

             <div class="md-card-content">
                 <div class="uk-grid" data-uk-grid-margin>

                     <div class="uk-width-medium-1-1">

                             <div class="md-card-content">
                                 <ul class="uk-tab" data-uk-tab="{connect:'#settings_users', animation: 'slide-horizontal' }">
                                     <li class="uk-active"><a href="#">Genaral</a></li>
                                     <li><a href="#">Medical & Clearance</a></li>
                                     <li><a href="#">Stamping</a></li>
                                     <li><a href="#">Manpower</a></li>
                                     <li><a href="#">Flight</a></li>
                                     <li><a href="#">Iqama</a></li>
                                     <li><a href="#">Kafala</a></li>
                                     <li><a href="#">View</a></li>

                                 </ul>
                                 <ul id="settings_users" class="uk-switcher uk-margin">
                                     <li>
                                         <table class="uk-table">
                                             <tr style="background-color: #073642; color: white">

                                                 <td>Pax ID</td>
                                                 <td>Passenger Name</td>
                                                 <td>Reference</td>
                                                 <td>Visa (bill)</td>
                                                 <td>Order(Invoice Number)</td>
                                             </tr>
                                             <tr>
                                                 <td>{!!$recruit_order->paxid !!}</td>
                                                 <td>{!!$recruit_order->passenger_name !!}</td>
                                                 <td>{{ $recruit_order->customer['display_name'] }}</td>
                                                 <td>{{ $recruit_order->registerserial['registerSerial'] }}
                                                     @if($recruit_order->bill)
                                                         (BILL-{{ $recruit_order->bill['bill_number'] }})
                                                     @endif
                                                 </td>
                                                 <td>{{ date('d-m-Y', strtotime($recruit_order->created_at)) }}
                                                     @if($recruit_order->invoice)
                                                         ( INV-{{ $recruit_order->invoice['invoice_number'] }})
                                                     @endif
                                                 </td>

                                             </tr>
                                         </table>


                                     </li>
                                     <li>
                                         <table class="uk-table">
                                             <tr style="background-color: #073642; color: white">


                                                 <td>Report</td>
                                                 <td>Mofa</td>
                                                 <td>Fit Card</td>
                                                 <td>Police Clearance</td>
                                             </tr>
                                             <tr>


                                                 <td>
                                                   {{ $recruit_order->medical_slip["medical_report_date"] }}
                                                 </td>

                                                 <td>
                                                  {{ $recruit_order->mofas["mofaDate"] }}
                                                 </td>
                                                 <td>
                                                  {{ $recruit_order->fitcard["receive_date"] }}
                                                 </td>
                                                 <td>{{ $recruit_order->police?$recruit_order->police->submission_date:'' }}</td>

                                             </tr>
                                         </table>
                                     </li>
                                     <li>
                                         <table class="uk-table">
                                             <tr style="background-color: #073642; color: white">

                                                 <td>Outgoing</td>
                                                 <td>Incoming</td>

                                             </tr>
                                             <tr>
                                              <td> {{ $recruit_order->visas["send_date"] }}  </td>
                                              <td> {{ $recruit_order->visas["return_date"] }}  </td>
                                             </tr>
                                         </table>
                                     </li>
                                     <li>
                                         <table class="uk-table">
                                             <tr style="background-color: #073642; color: white">

                                                 <td>Finger</td>
                                                 <td>Training</td>
                                                 <td>Manpower</td>
                                                 <td>Completion</td>
                                             </tr>
                                             <tr>

                                                 <td>{{ $recruit_order->finger['assignedDate'] }}<br>

                                                 </td>
                                                 <td>{{ $recruit_order->training['received_date'] }}<br>

                                                 </td>
                                                 <td>{{ $recruit_order->manpower['issuingDate'] }}</td>
                                                 <td>{{ $recruit_order->completion['date'] }}</td>
                                             </tr>
                                         </table>
                                     </li>
                                     <li>
                                         <table class="uk-table">
                                             <tr style="background-color: #073642; color: white">
                                                 <td>Submission</td>
                                                 <td>Confirmation</td>
                                             </tr>
                                             <tr>
                                             <td> {{ $recruit_order->submission['submission_date'] }} </td>
                                             <td> {{ $recruit_order->confirmation['date_of_flight'] }} </td>

                                             </tr>
                                         </table>
                                     </li>
                                     <li>
                                         <table class="uk-table">
                                             <tr style="background-color: #073642; color: white">

                                                 <td>Insurance</td>
                                                 <td>Submission</td>
                                                 <td>Receive</td>
                                                 <td>Recipient</td>

                                             </tr>
                                             <tr>
                                             <td>{{ $recruit_order->insurance['date_of_payment']?date("Y-m-d",strtotime($recruit_order->insurance['date_of_payment'])):'' }}</td>
                                             <td>{{ $recruit_order->iqamaSubmission['submission_date']?date("Y-m-d",strtotime($recruit_order->iqamaSubmission['submission_date'])):'' }}</td>
                                             <td>{{ $recruit_order->iqamaReceive['receive_date']?date("Y-m-d",strtotime($recruit_order->iqamaReceive['receive_date'])):'' }}</td>

                                             <td>{{ $recruit_order->reciepient['recipient_name'] }}</td>
                                             </tr>
                                         </table>
                                     </li>
                                     <li>
                                         <table class="uk-table">
                                             <tr style="background-color: #073642; color: white">
                                                 <td>Before 60 days</td>
                                                 <td>After 60 days</td>
                                             </tr>
                                             <tr>
                                                <td>{{ $recruit_order->beforeSixtyDays['date_of_kafala']?date("Y-m-d",strtotime($recruit_order->beforeSixtyDays['date_of_kafala'])):'' }}</td>
                                                <td>{{ $recruit_order->afterSixtyDays['receive_date']?date("Y-m-d",strtotime($recruit_order->afterSixtyDays['receive_date'])):'' }}</td>
                                             </tr>
                                         </table>
                                     </li>
                                     <li style="text-align: center">
                                       <a href="{{ route('customer_account' , $recruit_order->paxid) }}" class="md-btn md-btn-primary md-btn-block md-btn-large">Show Details</a>

                                     </li>
                                 </ul>
                             </div>

                     </div>
                 </div>



            </div>
            <hr>
            <div class="md-card-content">
                <h3 class="full_width_in_card heading_c">
                    <span class="">
                        <label for="sales_information" class="inline-label">
                            File
                        </label>
                    </span>
                </h3>

                <div class="uk-overflow-container">
                    <table class="uk-table">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Created At</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Created At</th>
                        </tr>
                        </tfoot>

                        <tbody>
                        @if($recruit_order->order_file->count())
                            @foreach($recruit_order->order_file as $all)
                            <tr>
                                <td><a title="Open File" data-uk-tooltip="{pos:'top'}" target="_blank" href="{{ route('order_download',$all->id?$all->id:0) }}">{{ trim($all->title) }}</a></td>
                                <td>{{ $all->created_at?$all->created_at->format('d-M-Y H:i:s'):'' }}</td>
                            </tr>
                            @endforeach
                        @endif

                        @if(count($recruit_order->mofas['mofa_file']))
                            @foreach($recruit_order->mofas['mofa_file'] as $file)
                            <tr>
                                <td><a title="Open File" data-uk-tooltip="{pos:'top'}" target="_blank" href="{{ route('mofa_mofa_download',$file->id?$file->id:0) }}">{{ trim($file->title) }}</a></td>
                                <td>{{ $file->created_at?$file->created_at->format('d-M-Y H:i:s'):'' }}</td>
                            </tr>
                            @endforeach
                        @endif

                        @if(count($recruit_order->fitcard['fit_card_file']))
                            @foreach($recruit_order->fitcard['fit_card_file'] as $file)
                            <tr>
                                <td><a title="Open File" data-uk-tooltip="{pos:'top'}" target="_blank" href="{{ route('fit_card_download',$file->id?$file->id:0) }}">{{ trim($file->title) }}</a></td>
                                <td>{{ $file->created_at?$file->created_at->format('d-M-Y H:i:s'):'' }}</td>
                            </tr>
                            @endforeach
                        @endif

                        @if( count($recruit_order->police['policeClearanceFile']))
                            @foreach($recruit_order->police['policeClearanceFile'] as $file)
                            <tr>
                                <td><a title="Open File" data-uk-tooltip="{pos:'top'}" target="_blank" href="{{ route('police_clearence_download',$file->id?$file->id:0) }}">{{ trim($file->title) }}</a></td>
                                <td>{{ $file->created_at?$file->created_at->format('d-M-Y H:i:s'):'' }}</td>
                            </tr>
                            @endforeach
                        @endif

                        @if(count($recruit_order->visa))
                            <tr>
                                <td><a title="Open File" data-uk-tooltip="{pos:'top'}" target="_blank" href="{{ route('visa_stamp_download',$recruit_order->visa['id']?$recruit_order->visa['id']:0) }}">Visa Stamping</a></td>
                                <td>{{ $recruit_order->visa['created_at']?$recruit_order->visa['created_at']->format('d-M-Y H:i:s'):'' }}</td>
                            </tr>
                        @endif

                        @if(count($recruit_order->finger['fingerPrintfile']))
                            @foreach($recruit_order->finger['fingerPrintfile'] as $file)
                            <tr>
                                <td><a title="Open File" data-uk-tooltip="{pos:'top'}" target="_blank" href="{{ route('fingerprint_file_download',$file->id?$file->id:0) }}">{{ trim($file->title) }}</a></td>
                                <td>{{ $file->created_at?$file->created_at->format('d-M-Y H:i:s'):'' }}</td>
                            </tr>
                            @endforeach
                        @endif

                        @if(count($recruit_order->training['trainingFile']))
                            @foreach($recruit_order->training['trainingFile'] as $file)
                            <tr>
                                <td><a title="Open File" data-uk-tooltip="{pos:'top'}" target="_blank" href="{{ route('training_file_download',$file->id?$file->id:0) }}">{{ trim($file->title) }}</a></td>
                                <td>{{ $file->created_at?$file->created_at->format('d-M-Y H:i:s'):'' }}</td>
                            </tr>
                            @endforeach
                        @endif

                        @if(count($recruit_order->completion['completionFile']))
                            @foreach($recruit_order->completion['completionFile'] as $file)
                            <tr>
                                <td><a title="Open File" data-uk-tooltip="{pos:'top'}" target="_blank" href="{{ route('completion_file_download',$file->id?$file->id:0) }}">{{ trim($file->title) }}</a></td>
                                <td>{{ $file->created_at?$file->created_at->format('d-M-Y H:i:s'):'' }}</td>
                            </tr>
                            @endforeach
                        @endif

                        @if(count($recruit_order->submission['submition_file']))
                            @foreach($recruit_order->submission['submition_file'] as $file)
                            <tr>
                                <td><a title="Open File" data-uk-tooltip="{pos:'top'}" target="_blank" href="{{ route('submission_file_download',$file->id?$file->id:0) }}">{{ trim($file->title) }}</a></td>
                                <td>{{ $file->created_at?$file->created_at->format('d-M-Y H:i:s'):'' }}</td>
                            </tr>
                            @endforeach
                        @endif

                        @if(count($recruit_order->confirmation['confirmationFile']))
                            @foreach($recruit_order->confirmation['confirmationFile'] as $file)
                            <tr>
                                <td><a title="Open File" data-uk-tooltip="{pos:'top'}" target="_blank" href="{{ route('confirmation_file_download',$file->id?$file->id:0) }}">{{ trim($file->title) }}</a></td>
                                <td>{{ $file->created_at?$file->created_at->format('d-M-Y H:i:s'):'' }}</td>
                            </tr>
                            @endforeach
                        @endif

                        @if(count($recruit_order->iqamaReceive))
                            <tr>
                                <td><a title="Open File" data-uk-tooltip="{pos:'top'}" target="_blank" href="{{ route('iqama_receive_download',$recruit_order->iqamaReceive['id']) }}">Iqama Document</a></td>
                                <td>{{ $recruit_order->iqamaReceive['created_at']?$recruit_order->iqamaReceive['created_at']->format('d-M-Y H:i:s'):'' }}</td>
                            </tr>
                        @endif
                        </tbody>

                    </table>
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


        $(window).load(function(){
            $('#sidebar_recruit').addClass('current_section');
            $('#sidebar_customer').addClass('act_item');
            $('.customer_mosaned').addClass('md-bg-blue-grey-100');

            setTimeout(function () {
                $("#sidebar_main_toggle").trigger('click');
            },3000);
        })
    </script>
@endsection