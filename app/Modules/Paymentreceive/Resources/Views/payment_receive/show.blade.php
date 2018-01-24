@extends('layouts.invoice')

@section('title', 'Payment Received')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('styles')
    <style>



        #second_duplicate_page{
            display: none;
        }
        #table_center th,td{
            border-color: black !important;
            padding: 2px 2px !important;
            text-align: center !important;

        }
        table#info{
            margin-top: 10px;
            font-size: 12px !important;

            border: 1px solid black !important;

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
            h1,p,h2 {
                font-size: 13px;
            }
          #second_duplicate_page{
              display: block;
              page-break-before: always;
          }
          #company_h{
              margin-top: 20px;
          }

            #table_center th,td{

               font-size: 13px;

            }

            #payemnt_rec{

            }
            #payemnt_code{
                position: relative;


            }

            #address_info{
                position: relative;
                 top:-60px;

            }
           #recieve{
               position: relative;

           }
           #amount{
               font-size: 00px;
           }

            table#info{
                width: 80%;
                position: relative;
                top:-70px;

            }
          #excess_payment{
              position: relative;
              top:-100px;

          }
            #table_center{
                position: relative;
                top:-140px;

            }
        #look{
            position: relative;

           }
          body{
           margin-top: -50px;
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

                        <li class="heading_list">Recent Payments</li>
                        @foreach($paymentreceives as $data)
                        @if($data->id == $paymentreceive->id)
                        <?php $active_class = 'md-list-item-active'?>
                        @else
                         <?php $active_class = ''?>
                        @endif
                        <li class="{{$active_class}}">
                            <a href="{{ route('payment_received_show', ['id' => $data->id]) }}" class="md-list-content" type="button">
                            <span class="md-list-heading uk-text-truncate">{{$data->paymentContact->display_name}}</br>
                            <span class="uk-text-small uk-text-muted">{{ $data->payment_date }}</span>
                            </span>
                            <span class="uk-text-small uk-text-muted">
                                @foreach($data->PaymentReceiveEntryData as $PREData)
                                    @foreach($invoice as $invoiceData)
                                    @if($PREData->invoice_id == $invoiceData->id)
                                    {{$invoiceData->invoice_number}}
                                    @endif
                                    @endforeach
                                @endforeach
                            </span>
                            </a>
                        </li>


                        @endforeach
                        <li class="uk-text-center">
                            <a class="md-btn md-btn-primary md-btn-mini md-btn-wave-light waves-effect waves-button waves-light uk-margin-top" href="{{route('payment_received')}}">See All</a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="uk-width-large-8-10">
                <div class="md-card md-card-single main-print">
                    <div id="invoice_preview">
                        <div class="md-card-toolbar hidden-print">
                            <div class="md-card-toolbar-actions hidden-print">

                                <span  style="display: none;" id="loaded_n_total"></span>
                                <span id="status"></span> <progress id="progressBar" value="0" max="100" style="float: left;margin-right: 15px; margin-top: 10px; height: 20px;width:300px; display: none;"></progress>
                                <div  style="float: left;margin-right: 15px; height: 14px;" class="uk-form-file md-btn md-btn-wave-light">
                                    Upload file
                                    <input name="file1" id="file1" type="file" onchange="uploadFile()">
                                </div>
                                <i class="md-icon material-icons" id="invoice_print"></i>
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="false">
                                    <i class="md-icon material-icons"></i>
                                    <div class="uk-dropdown" aria-hidden="true">
                                        <ul class="uk-nav">
                                            <li>
                                                <a href="{{ route('payment_received_edit', ['id' => $paymentreceive->id]) }}">Edit</a>
                                            </li>
                                            <li>
                                                <a href="#">Email</a>
                                            </li>
                                            @if($paymentreceive->file_url)
                                            <li>
                                                <a href="{{route('payment_received_download', ['id' => $paymentreceive->id])}}">Attach File</a>
                                            </li>
                                           @endif
                                            <li>
                                                <a href="#">Use Credits</a>
                                            </li>
                                            <li>
                                                <a class="uk-text-danger" href="{{ route('payment_received_delete', ['id' => $paymentreceive->id]) }}">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md-card-content invoice_content print_bg" style="height: 301px;">
                            @inject('theader', '\App\Lib\TemplateHeader')
                            @if($theader->getBanner()->headerType)
                                <div class="" style="text-align: center;">

                                    <img src="{{ asset($theader->getBanner()->file_url) }}">
                                </div>
                            @else
                                <div class="uk-grid" data-uk-grid-margin style="text-align: center;">
                                    <h1 id="company_h" style="width: 100%; text-align: center;"><img id="company" style="text-align: center;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/> {{ $OrganizationProfile->company_name }}</h1>
                                </div>
                                <div class="" style="text-align: center;">

                                    <p>{{ $OrganizationProfile->street }},{{ $OrganizationProfile->city }},{{ $OrganizationProfile->state }},{{ $OrganizationProfile->country }}</p>

                                    <p style="margin-top: -17px;">{{ $OrganizationProfile->email }},{{ $OrganizationProfile->contact_number }}</p>
                                </div>
                            @endif
                            <div  class="uk-grid" data-uk-grid-margin>

                                <div class="uk-width-5-5" style="font-size: 12px;">
                                    <div class="uk-grid">
                                        <h2 id="payemnt_rec" style="text-align: center; width: 100%;" class="">PAYMENT RECEIPT</h2>
                                        <p id="payemnt_code" style="text-align: center; width: 100%;" class="uk-text-small uk-text-muted uk-margin-top-remove"># PR-{{ str_pad($paymentreceive->pr_number, 6, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>

                            </div>

                            <div class="uk-grid">
                                <div class="uk-width-small-1-2 uk-row-first">
                                    <div id="address_info" class="uk-margin-bottom">
                                        <span class="uk-text-muted uk-text-small uk-text-italic">Bill To:</span>
                                        <address>
                                            <p><strong>{{ $paymentreceive->paymentContact->display_name }}</strong></p>
                                           @if(!empty($paymentreceive->paymentContact->company_name) && !empty($paymentreceive->paymentContact->phone_number_1))
                                            <p>
                                                {{ $paymentreceive->paymentContact->company_name }},
                                                {{ $paymentreceive->paymentContact->phone_number_1 }}
                                            </p>
                                           @endif
                                            <p>Billing Address-
                                                @if(!empty($paymentreceive->paymentContact->billing_street))
                                                {{ $paymentreceive->paymentContact->billing_street }},
                                                @endif
                                                @if(!empty($paymentreceive->paymentContact->billing_city))
                                                {{ $paymentreceive->paymentContact->billing_city }},
                                                @endif
                                                @if(!empty($paymentreceive->paymentContact->billing_state))
                                                {{ $paymentreceive->paymentContact->billing_state }},
                                                @endif
                                                @if(!empty($paymentreceive->paymentContact->billing_zip_code))
                                                {{ $paymentreceive->paymentContact->billing_zip_code }},
                                                @endif
                                                {{ $paymentreceive->paymentContact->billing_country }}
                                            </p>
                                            <p>Shipping address-
                                                @if(!empty($paymentreceive->paymentContact->shipping_street))
                                                {{ $paymentreceive->paymentContact->shipping_street }},
                                                @endif
                                                @if(!empty($paymentreceive->paymentContact->shipping_city))
                                                {{ $paymentreceive->paymentContact->shipping_city }},
                                                @endif
                                                @if(!empty($paymentreceive->paymentContact->shipping_state))
                                                {{ $paymentreceive->paymentContact->shipping_state }},
                                                @endif
                                                @if(!empty($paymentreceive->paymentContact->shipping_zip_code))
                                                {{ $paymentreceive->paymentContact->shipping_zip_code }},
                                                @endif
                                                {{ $paymentreceive->paymentContact->shipping_country }}
                                            </p>
                                        </address>
                                    </div>
                                </div>
                                <div id="recieve" class="uk-width-small-1-2 uk-row-first">


                                        <?php $amount = $paymentreceive->amount;?>


                                    <table id="info" class="uk-table inv_top_right_table">

                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom">Amount Received : </td>
                                            <td class="uk-text-right no-border-bottom">BDT <?php echo number_format((float)$amount, 2, '.', '');?></td>
                                        </tr>
                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom">Payment Date :</td>
                                            <td class="uk-text-right no-border-bottom">{{date('d-m-Y', strtotime($paymentreceive->payment_date))}}</td>
                                        </tr>
                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom">Reference Number :</td>
                                            <td class="uk-text-right no-border-bottom">{{$paymentreceive->reference}}</td>
                                        </tr>
                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom">Payment Mode :</td>
                                            <td class="uk-text-right no-border-bottom">{{$paymentreceive->PaymentMode->mode_name}}</td>
                                        </tr>
                                        @if($paymentreceive->invoice_show=="on")
                                            <tr class="uk-table-middle">
                                                <td class="no-border-bottom">Bank Info :</td>
                                                <td class="uk-text-right no-border-bottom">{{$paymentreceive->bank_info }}</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>

                            <div id="excess_payment" class="uk-grid">
                                <div class="uk-width-small-1-2 uk-row-first">
                                    <div class="uk-margin-bottom">

                                        <address>
                                            <p><strong></strong></p>
                                        </address>
                                    </div>
                                </div>
                            </div>

                            <div class="uk-grid " style="font-size: 12px;">
                                <div class="uk-width-1-1">
                                    <table id="table_center" border="1" class="uk-table">
                                        <caption><span>Over payment: {{$paymentreceive->excess_payment}}</span></caption>
                                        <thead>
                                        <tr class="uk-text-upper">
                                            <th>Invoice Number</th>
                                            <th>Invoice Date</th>
                                            <th>Invoice Amount </th>
                                            <th>Payment Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($paymentreceive->PaymentReceiveEntryData as $PREData)
                                         @foreach($invoice as $invoiceData)
                                        @if($PREData->invoice_id == $invoiceData->id)
                                        <tr class="uk-table-middle">
                                            <td> INV-{{ str_pad($invoiceData->invoice_number, 6, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{date('d-m-Y', strtotime($invoiceData->invoice_date))}}</td>
                                            <td>{{$invoiceData->total_amount}}</td>
                                            <td>{{$PREData->amount}}</td>
                                        </tr>

                                        @endif
                                         @endforeach
                                        @endforeach

                                        </tbody>

                                        <caption align="bottom" style="padding-top: 30px;">
                                            <span class="uk-text-small"style="float: left !important;">Customer Signature</span>
                                            <span style="float: right" class="uk-text-small">Company Representative</span>
                                        </caption>


                                    </table>

                                </div>
                            </div>

                          <div id="second_duplicate_page">
                            @if($theader->getBanner()->headerType)
                                <div class="" style="text-align: center;">

                                    <img src="{{ asset($theader->getBanner()->file_url) }}">
                                </div>
                            @else
                                <div class="uk-grid" data-uk-grid-margin style="text-align: center;">
                                    <h1 id="company_h" style="width: 100%; text-align: center;"><img id="company" style="text-align: center;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/> {{ $OrganizationProfile->company_name }}</h1>
                                </div>
                                <div class="" style="text-align: center;">

                                    <p>{{ $OrganizationProfile->street }},{{ $OrganizationProfile->city }},{{ $OrganizationProfile->state }},{{ $OrganizationProfile->country }}</p>

                                    <p style="margin-top: -17px;">{{ $OrganizationProfile->email }},{{ $OrganizationProfile->contact_number }}</p>
                                </div>
                            @endif
                            <div  class="uk-grid" data-uk-grid-margin>

                                <div class="uk-width-5-5" style="font-size: 12px;">
                                    <div class="uk-grid">
                                        <h2 id="payemnt_rec" style="text-align: center; width: 100%;" class="">PAYMENT RECEIPT</h2>
                                        <p id="payemnt_code" style="text-align: center; width: 100%;" class="uk-text-small uk-text-muted uk-margin-top-remove"># PR-{{ str_pad($paymentreceive->pr_number, 6, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>

                            </div>

                            <div class="uk-grid">
                                <div class="uk-width-small-1-2 uk-row-first">
                                    <div id="address_info" class="uk-margin-bottom">
                                        <span class="uk-text-muted uk-text-small uk-text-italic">Bill To:</span>
                                        <address>
                                            <p><strong>{{ $paymentreceive->paymentContact->display_name }}</strong></p>
                                            @if(!empty($paymentreceive->paymentContact->company_name) && !empty($paymentreceive->paymentContact->phone_number_1))
                                                <p>
                                                    {{ $paymentreceive->paymentContact->company_name }},
                                                    {{ $paymentreceive->paymentContact->phone_number_1 }}
                                                </p>
                                            @endif
                                            <p>Billing Address-
                                                @if(!empty($paymentreceive->paymentContact->billing_street))
                                                    {{ $paymentreceive->paymentContact->billing_street }},
                                                @endif
                                                @if(!empty($paymentreceive->paymentContact->billing_city))
                                                    {{ $paymentreceive->paymentContact->billing_city }},
                                                @endif
                                                @if(!empty($paymentreceive->paymentContact->billing_state))
                                                    {{ $paymentreceive->paymentContact->billing_state }},
                                                @endif
                                                @if(!empty($paymentreceive->paymentContact->billing_zip_code))
                                                    {{ $paymentreceive->paymentContact->billing_zip_code }},
                                                @endif
                                                {{ $paymentreceive->paymentContact->billing_country }}
                                            </p>
                                            <p>Shipping address-
                                                @if(!empty($paymentreceive->paymentContact->shipping_street))
                                                    {{ $paymentreceive->paymentContact->shipping_street }},
                                                @endif
                                                @if(!empty($paymentreceive->paymentContact->shipping_city))
                                                    {{ $paymentreceive->paymentContact->shipping_city }},
                                                @endif
                                                @if(!empty($paymentreceive->paymentContact->shipping_state))
                                                    {{ $paymentreceive->paymentContact->shipping_state }},
                                                @endif
                                                @if(!empty($paymentreceive->paymentContact->shipping_zip_code))
                                                    {{ $paymentreceive->paymentContact->shipping_zip_code }},
                                                @endif
                                                {{ $paymentreceive->paymentContact->shipping_country }}
                                            </p>
                                        </address>
                                    </div>
                                </div>
                                <div id="recieve" class="uk-width-small-1-2 uk-row-first">


                                    <?php $amount = $paymentreceive->amount;?>


                                    <table id="info" class="uk-table inv_top_right_table">

                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom">Amount Received : </td>
                                            <td class="uk-text-right no-border-bottom">BDT <?php echo number_format((float)$amount, 2, '.', '');?></td>
                                        </tr>
                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom">Payment Date :</td>
                                            <td class="uk-text-right no-border-bottom">{{date('d-m-Y', strtotime($paymentreceive->payment_date))}}</td>
                                        </tr>
                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom">Reference Number :</td>
                                            <td class="uk-text-right no-border-bottom">{{$paymentreceive->reference}}</td>
                                        </tr>
                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom">Payment Mode :</td>
                                            <td class="uk-text-right no-border-bottom">{{$paymentreceive->PaymentMode->mode_name}}</td>
                                        </tr>
                                        @if($paymentreceive->invoice_show=="on")
                                            <tr class="uk-table-middle">
                                                <td class="no-border-bottom">Bank Info :</td>
                                                <td class="uk-text-right no-border-bottom">{{$paymentreceive->bank_info }}</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>

                            <div id="excess_payment" class="uk-grid">
                                <div class="uk-width-small-1-2 uk-row-first">
                                    <div class="uk-margin-bottom">

                                        <address>
                                            <p><strong></strong></p>
                                        </address>
                                    </div>
                                </div>
                            </div>

                            <div class="uk-grid " style="font-size: 12px;">
                                <div class="uk-width-1-1">
                                    <table id="table_center" border="1" class="uk-table">
                                        <caption><span>Over payment: {{$paymentreceive->excess_payment}}</span></caption>
                                        <thead>
                                        <tr class="uk-text-upper">
                                            <th>Invoice Number</th>
                                            <th>Invoice Date</th>
                                            <th>Invoice Amount </th>
                                            <th>Payment Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($paymentreceive->PaymentReceiveEntryData as $PREData)
                                            @foreach($invoice as $invoiceData)
                                                @if($PREData->invoice_id == $invoiceData->id)
                                                    <tr class="uk-table-middle">
                                                        <td> INV-{{ str_pad($invoiceData->invoice_number, 6, '0', STR_PAD_LEFT) }}</td>
                                                        <td>{{date('d-m-Y', strtotime($invoiceData->invoice_date))}}</td>
                                                        <td>{{$invoiceData->total_amount}}</td>
                                                        <td>{{$PREData->amount}}</td>
                                                    </tr>

                                                @endif
                                            @endforeach
                                        @endforeach

                                        </tbody>

                                        <caption align="bottom" style="padding-top: 30px;">
                                            <span class="uk-text-small"style="float: left !important;">Customer Signature</span>
                                            <span style="float: right" class="uk-text-small">Company Representative</span>
                                        </caption>


                                    </table>

                                </div>
                            </div>
                           </div>
                        </div>
                    </div>
                </div>

                <div class="hidden-print">
                    <div class="uk-margin-large-top">
                        <h2 class="heading_b">More Information</h2>
                    </div>

                    @if($paymentreceive->file_url)
                    <div class="ük-grid uk-margin-top" data-uk-grid-margin>
                        <div class="md-card md-card-single main-print">
                            <div class="uk-grid uk-margin-large-bottom">
                                <div class="uk-width-1-1">
                                    <table class="uk-table inv_top_right_table">
                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom"><a href="{{route('payment_received_download', ['id' => $paymentreceive->id])}}">Attachment(s) added</a></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="ük-grid uk-margin-top" data-uk-grid-margin>
                        <div class="md-card md-card-single main-print">
                            <div class="uk-grid uk-margin-large-bottom">
                                <div class="uk-width-1-1">
                                    <table class="uk-table inv_top_right_table">
                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom">Deposit To :</td>
                                            <td class="uk-text-right no-border-bottom">{{$paymentreceive->account->account_name}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="uk-margin-top">
                        <h2 class="heading_b">Payment History</h2>
                    </div>

                    <div class="ük-grid uk-margin-top" data-uk-grid-margin>
                        <div class="md-card md-card-single main-print">
                            <div class="uk-grid uk-margin-large-bottom">
                                <div class="uk-width-1-1">
                                    <table class="uk-table">
                                        <thead>
                                        <tr class="uk-text-upper">
                                            <th>Date</th>
                                            <th>Description</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="uk-table-middle">
                                            <td>{{$paymentreceive->updated_at->format('d-m-Y')}}</td>
                                            <td>Payment of amount <?php $amount = $paymentreceive->amount;?>
                                                BDT <?php echo number_format((float)$amount, 2, '.', '');?> received and applied for
                                                @foreach($paymentreceive->PaymentReceiveEntryData as $PREData)
                                                @foreach($invoice as $invoiceData)
                                                @if($PREData->invoice_id == $invoiceData->id)
                                                {{$invoiceData->invoice_number}}
                                                @endif
                                                @endforeach
                                                @endforeach
                                                 by {{$paymentreceive->updatedBy->name}}</td>
                                        </tr>
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

@endsection

@section('scripts')
    <script>
        $('#sidebar_main_account').addClass('current_section');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');

        })
        $('#sidebar_payment_recieve').addClass('act_item');

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
    </script>
@endsection
