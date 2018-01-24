@extends('layouts.invoice')

@section('title', 'Bill')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('scripts')
    <script src="{{url('app/moneyout/bill/bill.module.js')}}"></script>
    <script src="{{url('app/moneyout/bill/bill.excessPayment.js')}}"></script>
@endsection

@section('styles')

    <style>



        #table_center th,td{
            border-bottom-color: black !important;
        }
        table#info{
            font-size: 12px !important;
            line-height: 2px;
            border: 1px solid black !important;
            min-width: 200px;
            float:right;
        }
        table#info tr td{
            border: 1px solid black !important;
        }
        table#info tr{
            padding: 0px;
            border: 1px solid black !important;
        }
        @media print {
            body {

                margin-top: -100px;
            }
        }
    </style>
@endsection
@section('content')
    <div class="uk-width-medium-10-10 uk-container-center reset-print">
        <div class="uk-grid uk-grid-collapse" data-uk-grid-margin>
            <div class="uk-width-large-2-10 hidden-print uk-visible-large">
                <div class="md-list-outside-wrapper">
                    <ul class="md-list md-list-outside">

                        <li class="heading_list">Recent Bills</li>

                        @foreach($bills as $bill_data)
                        <li>
                            <a href="{{ route('bill_show', ['id' => $bill_data->id]) }}" class="md-list-content">
                                <span class="md-list-heading uk-text-truncate">{{ $bill_data->customer->display_name }} <span class="uk-text-small uk-text-muted">{{ date('d-m-Y',strtotime($bill_data->bill_date)) }}</span></span>
                                <span class="uk-text-small uk-text-muted">BILL-{{ $bill_data->bill_number }}</span>
                            </a>
                        </li>
                        @endforeach

                        <li class="uk-text-center">
                            <a class="md-btn md-btn-primary md-btn-mini md-btn-wave-light waves-effect waves-button waves-light uk-margin-top" href="{{ route('bill') }}">See All</a>
                        </li>

                    </ul>
                </div>
            </div>

            <?php
            $helper = new \App\Lib\Helpers;
            ?>

            <div class="uk-width-large-8-10">
                <div class="md-card md-card-single main-print">
                    <div id="invoice_preview">
                        <div class="md-card-toolbar">
                            <div class="md-card-toolbar-actions hidden-print">

                                <span  style="display: none;" id="loaded_n_total"></span>
                                <span id="status"></span> <progress id="progressBar" value="0" max="100" style="float: left;margin-right: 15px; margin-top: 10px; height: 20px;width:300px; display: none;"></progress>
                                <div  style="float: left;margin-right: 15px; height: 14px;" class="uk-form-file md-btn md-btn-wave-light">
                                    Upload file
                                    <input name="file1" id="file1" type="file" onchange="uploadFile()">
                                </div>
                                @if($bill->save==1)
                                    <a  href="{!! route('bill_update_mark',$bill->id) !!}" id="popup" style="float: left;margin-right: 15px" class="md-btn md-btn-primary md-btn-mini md-btn-wave-light waves-effect waves-button waves-light">Mark as Open</a>
                                @endif
                                <i class="md-icon material-icons" id="invoice_print"></i>
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="false">
                                    <i class="md-icon material-icons"></i>
                                    <div class="uk-dropdown" aria-hidden="true">
                                        <ul class="uk-nav">
                                            <li>
                                                <a href="{{ route('bill_edit', ['id' => $bill->id]) }}">Edit</a>
                                            </li>
                                            @if($bill->file_url)
                                                <li>
                                                    <a download href="{{ url($bill->file_url) }}">Attach File</a>
                                                </li>
                                            @endif
                                            <li>
                                                <a class="uk-text-danger" href="">Delete</a>
                                            </li>
                                            <li>
                                                <a data-uk-modal="{target:'#modal_header_footer1'}" href="#">Use Excess Payment</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('purchase_return_index',$bill->id) }}" target="_blank">Purchase Return</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <h3 class="md-card-toolbar-heading-text large" id="invoice_name">BILL-{{ $bill->bill_number }}</h3>
                        </div>
                        <div class="md-card-content invoice_content print_bg" style="height: 301px;">
                            @include('inc.alert')
                            @inject('theader', '\App\Lib\TemplateHeader')
                            @if($theader->getBanner()->headerType)
                                <div class="" style="text-align: center;">

                                    <img src="{{ asset($theader->getBanner()->file_url) }}">
                                </div>
                            @else
                                <div class="uk-grid" data-uk-grid-margin style="text-align: center; margin-top:50px;">
                                    <h1 style="width: 100%; text-align: center;"><img style="text-align: center;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/> {{ $OrganizationProfile->company_name }}</h1>
                                </div>
                                <div class="" style="text-align: center;">

                                    <p>{{ $OrganizationProfile->street }},{{ $OrganizationProfile->city }},{{ $OrganizationProfile->state }},{{ $OrganizationProfile->country }}</p>

                                    <p style="margin-top: -17px;">{{ $OrganizationProfile->email }},{{ $OrganizationProfile->contact_number }}</p>
                                </div>
                            @endif
                            <div class="uk-grid" data-uk-grid-margin>
                                
                                <div class="uk-width-5-5" style="font-size: 12px;">
                                    <div class="uk-grid">
                                        <h2 style="text-align: center; width: 90%;" class="">BILL</h2>
                                        <p style="text-align: center; width: 90%;" class="uk-text-small uk-text-muted uk-margin-top-remove"># BILL-{{ str_pad($bill->bill_number, 6, '0', STR_PAD_LEFT) }} <br/> <b>{{ $bill->save?"Draft":'' }}</b></p>

                                    </div>
                                </div>
                                
                            </div>
                            <input type="hidden" name="invoice_id">

                            <div class="uk-grid">
                                <div class="uk-width-small-1-2 uk-row-first">
                                    <div class="uk-margin-bottom">
                                        <span class="uk-text-muted uk-text-small uk-text-italic">Bill From:</span>
                                        <address>
                                            <p><strong>{{ $bill->customer->display_name }}</strong></p>
                                            @if(!empty($bill->customer->company_name) && !empty($bill->customer->phone_number_1))
                                            <p>
                                                {{ $bill->customer->company_name }},
                                                {{ $bill->customer->phone_number_1 }}
                                            </p>
                                            @endif
                                            <p>Billing Address-
                                                @if(!empty($bill->customer->billing_street))
                                                {{ $bill->customer->billing_street }},
                                                @endif
                                                @if(!empty($bill->customer->billing_city))
                                                {{ $bill->customer->billing_city }},
                                                @endif
                                                @if(!empty($bill->customer->billing_state))
                                                {{ $bill->customer->billing_state }},
                                                @endif
                                                @if(!empty($bill->customer->billing_zip_code))
                                                {{ $bill->customer->billing_zip_code }},
                                                @endif
                                                {{ $bill->customer->billing_country }}
                                            </p>
                                            <p>Shipping address-
                                                @if(!empty($bill->customer->shipping_street))
                                                {{ $bill->customer->shipping_street }},
                                                @endif
                                                @if(!empty($bill->customer->shipping_city))
                                                {{ $bill->customer->shipping_city }},
                                                @endif
                                                @if(!empty($bill->customer->shipping_state))
                                                {{ $bill->customer->shipping_state }},
                                                @endif
                                                @if(!empty($bill->customer->shipping_zip_code))
                                                {{ $bill->customer->shipping_zip_code }},
                                                @endif
                                                {{ $bill->customer->shipping_country }}
                                            </p>
                                        </address>
                                    </div>
                                </div>
                                <div class="uk-width-small-1-2">
                                    <p style="text-align: right; width: 99%; margin: 0; padding: 0;" class="uk-text-small uk-margin-right-remove">Balance Due</p>
                                    <h2 style="text-align: right; width: 99%;" class="uk-margin-top-remove">BDT {{ $bill->due_amount }}</h2>
                                    <table id="info" class="uk-table inv_top_right_table">
                                        <tr class="uk-table-middle">
                                            <td class="uk-text-right no-border-bottom">Bill Date :</td>
                                            <td class="uk-text-right no-border-bottom">{{ $bill->bill_date }}</td>
                                        </tr>
                                        <tr class="uk-table-middle">
                                            <td class="uk-text-right no-border-bottom">Due Date :</td>
                                            <td class="uk-text-right no-border-bottom">{{ $bill->due_date }}</td>
                                        </tr>
                                        @if(isset($bill->Ticket))
                                            <tr style="white-space:nowrap; line-height: 10px;">
                                                <td class="uk-text-right "> Passenger Name :</td>
                                                <td style="white-space:nowrap; text-align: right">{!! strlen($bill->Ticket->first_name)>25?$bill->Ticket->first_name."<br/>":$bill->Ticket->first_name." " !!} {{ $bill->Ticket->last_name }} </td>
                                            </tr>

                                            <tr >
                                                <td class="uk-text-right " style="word-wrap: break-word"> Ticket Number :</td>
                                                <td class="uk-text-right ">{{ $bill->Ticket->ticket_number }}</td>
                                            </tr>
                                        @elseif(isset($bill->Recruit))
                                            <tr style="white-space:nowrap; line-height: 10px;">
                                                <td class="uk-text-right "> Passport Number :</td>
                                                <td style="white-space:nowrap; text-align: right">{{ $bill->Recruit->passportNumber }} </td>
                                            </tr>

                                            <tr >
                                                <td class="uk-text-right " style="word-wrap: break-word"> Visa Number </td>
                                                <td class="uk-text-right ">{{ $bill->Recruit->registerserial?$bill->Recruit->registerserial->visaNumber:'' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="uk-text-right " style="word-wrap: break-word"> Passenger Name :</td>
                                                <td class="uk-text-right ">{{ $bill->Recruit['passenger_name'] }}</td>
                                            </tr>
                                        @elseif(isset($bill->ticketRefund))
                                        <tr style="white-space:nowrap; line-height: 10px;">
                                            <td style="text-align: right;"> Passenger Name:</td>
                                            <td style="white-space:nowrap; text-align: right">{{ $bill->ticketRefund['first_name'].' '.$bill->ticketRefund['last_name'] }}</td>
                                        </tr>

                                        <tr >
                                         <td class="uk-text-right " style="word-wrap: break-word"> Ticket Number:</td>
                                         <td class="uk-text-right ">{{ $bill->ticketRefund['ticket_number'] }}</td>
                                        </tr>
                                        @endif

                                         @if($bill->e_ticket_number)
                                            <tr class="uk-table-middle">
                                                <td class="uk-text-right no-border-bottom">E-Ticket Number :</td>
                                                <td class="uk-text-right no-border-bottom">{{ $bill->e_ticket_number }}</td>
                                            </tr>

                                            <tr class="uk-table-middle">
                                                <td class="uk-text-right no-border-bottom">Passport Number :</td>
                                                <td class="uk-text-right no-border-bottom">{{ $bill->passportNumber }}</td>
                                            </tr>
                                            <tr class="uk-table-middle">
                                                <td class="uk-text-right no-border-bottom">Passenger Name :</td>
                                                <td class="uk-text-right no-border-bottom">{{ $bill->passenger_name }}</td>
                                            </tr>

                                         @endif
                                    </table>
                                </div>
                            </div>
                            <div class="uk-grid uk-margin-large-bottom">
                                <div class="uk-width-1-1">
                                    <table id="table_center" border="1" class="uk-table">
                                        <thead>
                                        <tr class="uk-text-upper">
                                            <th>#</th>
                                            <th>Particulars</th>
                                            <th class="uk-text-right">Desc</th>
                                            <th class="uk-text-right">Qty</th>
                                            <th class="uk-text-right">Rate</th>
                                            <th class="uk-text-right">Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($bill_entries as $bill_entry)
                                        <tr class="uk-table-middle">
                                            <td>1</td>
                                            <td>{{ $bill_entry->item->item_name }} @if($bill_entry->description)<br>{{$bill_entry->description}}@endif</td>
                                            <td class="no-border-bottom">{{ $bill_entry['description'] }}</td>
                                            <td class="uk-text-right">{{ $bill_entry->quantity.' '.$bill_entry->item['unit_type'] }}</td>
                                            <td class="uk-text-right">{{ $bill_entry->rate }}</td>
                                            <td class="uk-text-right">{{ $bill_entry->amount }}</td>
                                        </tr>
                                        @endforeach
                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="uk-text-right no-border-bottom">Sub Total</td>
                                            <td class="uk-text-right no-border-bottom">{{ $sub_total }}</td>
                                        </tr>
                                        @if($bill->total_tax>0)
                                        <tr class="uk-table-middle hidden">
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="uk-text-right no-border-bottom">Tax</td>
                                            <td class="uk-text-right no-border-bottom">{{ $bill->total_tax }}</td>
                                        </tr>
                                        @endif
                                        <tr class="uk-table-middle">
                                            @if($bill->shipping_charge)
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="uk-text-right">
                                            Vat
                                            @if($bill->shipping_charge>0)
                                            ({{number_format(($bill->amount - $sub_total -$bill->shipping_charge)*100/$sub_total,2)}}%)
                                            @else
                                            ( {{number_format(($bill->amount - $sub_total)*100/$sub_total,2)}}% )
                                            @endif

                                            </td>
                                            <td class="uk-text-right">
                                            @if($bill->shipping_charge>0)
                                            {{ number_format($bill->amount - $sub_total -$bill->shipping_charge,2) }}
                                            @else
                                            {{ number_format($bill->amount - $sub_total,2) }}
                                            @endif
                                            </td>
                                            @endif
                                        </tr>

                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="uk-text-right no-border-bottom">Total</td>
                                            <td class="uk-text-right no-border-bottom">{{ $bill->amount }}</td>
                                        </tr>
                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="uk-text-right no-border-bottom" style="background: #efefef">Balance Due</td>
                                            <td class="uk-text-right no-border-bottom" style="background: #efefef">BDT {{ $bill->due_amount }}</td>
                                        </tr>
                                        <tr class="uk-table-middle">

                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="uk-text-right no-border-bottom" style="background: #efefef">Total Paid</td>
                                            <td class="uk-text-right no-border-bottom" style="background: #efefef">BDT {{ ($bill->amount - $bill->due_amount) }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="uk-grid">
                                <div class="uk-width-1-2" style="text-align: left">
                                    <p class="uk-text-small uk-margin-bottom">Customer Signature</p>
                                </div>
                                <div class="uk-width-1-2" style="text-align: right">
                                    <p class="uk-text-small uk-margin-bottom">Company Representative</p>
                                </div>
                            </div>
                            <div class="uk-grid">
                                <div class="uk-width-1-2">
                                    <p class="uk-text-small uk-margin-bottom">Looking forward for your business.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hidden-print">
                    <div class="uk-margin-large-top">
                        <h2 class="heading_b">Payment Made</h2>
                    </div>

                    <div class="ük-grid uk-margin-top" data-uk-grid-margin>
                        <div class="md-card md-card-single main-print">
                            <div class="uk-grid uk-margin-large-bottom">
                                <div class="uk-width-1-1">
                                    <table class="uk-table">
                                        <thead>
                                        <tr class="uk-text-upper">
                                            <th>Date</th>
                                            <th class="uk-text-right">Payment#</th>
                                            <th class="uk-text-right">Reference#</th>
                                            <th class="uk-text-right">Payment Mode</th>
                                            <th class="uk-text-right">Amount</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($payment_made_entries as $payment_made_entry)
                                            <tr class="uk-table-middle">
                                                <td>{{ $payment_made_entry->paymentMade->payment_date }}</td>
                                                <td class="uk-text-right">Payment</td>
                                                <td class="uk-text-right">{{ $payment_made_entry->paymentMade->reference }}</td>
                                                <td class="uk-text-right">{{ $payment_made_entry->paymentMade->paymentMode->mode_name }}</td>
                                                <td class="uk-text-right">BDT {{ $payment_made_entry->amount }}</td>
                                                <td class="uk-text-right" >
                                                    <a href="{{ route('payment_made_edit', ['id' => $payment_made_entry->payment_made_id]) }}"><i data-uk-tooltip="{pos:'top'}" title="Edit" class="md-icon material-icons">&#xE254;</i></a>
                                                    <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                                                    <input type="hidden" class="payment_made_entry_id" value="{{ $payment_made_entry->id }}">
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

        {{--model--}}
        @include('bill::bill.use_excess_payments')

    </div>
@endsection

@section('sweet_alert')
    <script>
        function _(el) {
            return document.getElementById(el);
        }

        function uploadFile(){
            _("progressBar").style.display = "block";
            var file = _("file1").files[0];


            var size= file.size/1024/1024;
            if(size>10){
                _("status").innerHTML = "file size not allowed";
                _("status").style.color = "red";
                return false;
            }
            _("status").style.color = "black";
            // alert(file.name+" | "+file.size+" | "+file.type);
            var formdata = new FormData();
            formdata.append("file1", file);
            var ajax = new XMLHttpRequest();
            ajax.upload.addEventListener("progress", progressHandler, false);
            ajax.addEventListener("load", completeHandler, false);
            ajax.addEventListener("error", errorHandler, false);
            ajax.addEventListener("abort", abortHandler, false);
            ajax.open("POST", window.location.href);
            ajax.send(formdata);
        }

        function progressHandler(event) {
            _("loaded_n_total").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
            var percent = (event.loaded / event.total) * 100;
            _("progressBar").value = Math.round(percent);
             _("status").innerHTML = Math.round(percent) + "% uploaded... please wait";
        }

        function completeHandler(event) {
             _("status").innerHTML = event.target.responseText;

           // UIkit.modal.alert(event.target.responseText)
            _("progressBar").value = 100;
            _("progressBar").style.display = "block";
        }

        function errorHandler(event) {
            //  _("status").innerHTML = "Upload Failed";
            alert("Upload Failed");
            _("progressBar").style.display = "none";
        }

        function abortHandler(event) {
            // _("status").innerHTML = "Upload Aborted";
            alert("Upload Aborted");
            _("progressBar").style.display = "none";
        }
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_bill').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        });

        $('.delete_btn').click(function () {
            var id = $(this).next('.payment_made_entry_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this! If you delete this",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "/payment-made/delete-payment-made-entry/"+id;
            })
        })

    </script>
@endsection
