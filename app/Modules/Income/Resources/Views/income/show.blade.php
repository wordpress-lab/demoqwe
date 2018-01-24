@extends('layouts.invoice')

@section('title', 'Income')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('scripts')
    <script>
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_income').addClass('act_item');

        $(window).load(function(){
            $("#tiktok_account").trigger('click');

        })
    </script>
@endsection
@section('styles')
    <style>

        #tiktok_table tr td{
            padding: 5px !important;
        }
        #tiktok_table tr td:nth-child(even){
            text-align: right;
        }

        @media print {
            body {

                margin-top: -100px;
            }

            #print{
                display: none;
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

                        <li class="heading_list">Recent Incomes</li>

                        @foreach($incomes as $income_data)
                            <li>
                                <a href="{{ route('income_show', ['id' => $income_data->id]) }}" class="md-list-content">
                                    <span class="md-list-heading uk-text-truncate">{{ $income_data->customer->display_name }}</span>
                                    <span class="uk-text-small uk-text-muted">{{ $income_data->date }}</span>
                                </a>
                            </li>
                        @endforeach

                        <li class="uk-text-center">
                            <a class="md-btn md-btn-primary md-btn-mini md-btn-wave-light waves-effect waves-button waves-light uk-margin-top" href="{{ route('income') }}">See All</a>
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
                        <div class="md-card-toolbar hidden-print">
                            <div class="md-card-toolbar-actions hidden-print">

                                <span  style="display: none;" id="loaded_n_total"></span>
                                <span  id="status"></span>  <progress id="progressBar" value="0" max="100" style="float: left;margin-right: 15px; margin-top: 10px; height: 20px;width:300px; display: none;"></progress>
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
                                                <a href="{{ route('income_edit', ['id' => $income->id]) }}">Edit</a>
                                            </li>
                                            @if($income->file_url)
                                                <li>
                                                <a id="print" download href="{{ url('income'.'/'.$income->file_url) }}">Attach File</a>
                                                </li>
                                            @endif

                                            <li>
                                                <a class="uk-text-danger" href="{{ route('income_delete', ['id' => $income->id]) }}">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <h3 class="md-card-toolbar-heading-text large" id="invoice_name">Incomes</h3>
                        </div>
                        <div class="md-card-content invoice_content print_bg" style="height: 301px;">
                            @inject('theader', '\App\Lib\TemplateHeader')
                            @if($theader->getBanner()->headerType)
                                <div class="" style="text-align: center;">

                                    <img src="{{ asset($theader->getBanner()->file_url) }}">
                                </div>
                            @else
                                <div class="uk-grid" data-uk-grid-margin style="text-align: center;">
                                    <h1 style="width: 100%; text-align: center;"><img style="text-align: center; margin-top: 20px; " class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/> {{ $OrganizationProfile->company_name }}</h1>
                                </div>
                                <div class="companyinfo" style="text-align: center;">

                                    <p>{{ $OrganizationProfile->street }},{{ $OrganizationProfile->city }},{{ $OrganizationProfile->state }},{{ $OrganizationProfile->country }}</p>

                                    <p style="margin-top: -17px;">{{ $OrganizationProfile->email }},{{ $OrganizationProfile->contact_number }}</p>
                                </div>
                           @endif

                            <div class="uk-grid" data-uk-grid-margin>

                                <div class="uk-width-medium-1-1  uk-vertical-align">
                                    <h2 class="uk-text-success" style="text-align: center">{{ $income->account->account_name }}</h2>

                                </div>

                            </div>
                            <div class="uk-grid">
                                <div  style="width: 80%; margin: auto; margin-top: 10px; " class="uk-width-medium-1-1">
                                    <table border="1" id="tiktok_table" width="100%">
                                        <caption align="center" style="text-align: center">#INC-{{ str_pad($income->income_number,6,'0',STR_PAD_RIGHT) }}</caption>
                                        <tr>
                                            <td>Income Amount</td>
                                            <td><span>BDT {{ $income->amount }} <small>on {{ $income->date }}</small></span></td>
                                        </tr>
                                        @if($income->receive_through_id)

                                        <tr>
                                            <td>Receive Through</td>
                                            <td>{{ $income->accountReceiveThrough->account_name }}</td>
                                        </tr>

                                        @endif
                                        @if($income->invoice_show == "on")
                                            <tr>
                                                <td>Bank Info</td>
                                                <td>{{ $income->bank_info }}</td>
                                            </tr>
                                        @endif
                                       <tr>
                                           <td>Tax Amount</td>
                                           <td>BDT {{ $income->tax_total }} {{ $income->tax_type == 1 ? '(Exclusive)' : '(Inclusive)' }}</td>
                                       </tr>
                                        @if($income->reference)
                                         <tr>
                                             <td>Ref #</td>
                                             <td>{{ $income->reference }}</td>
                                         </tr>
                                        @endif
                                       <tr>
                                           <td>Paid To</td>
                                           <td>{{ $income->customer->display_name }}</td>
                                       </tr>
                                        <caption style="margin-top: 30px;" align="bottom">
                                            <span style="float: left" class="uk-text-small uk-margin-bottom">Customer Signature</span>
                                            <span style="float: right" class="uk-text-small uk-margin-bottom">Company Representative</span>
                                        </caption>
                                    </table>
                                 </div>
                            </div>

                            <div class="uk-grid">
                                <div class="uk-width-1-1">

                                </div>
                            </div>
                            <div class="uk-grid">
                                <div class="uk-width-1-1">
                                    <span class="uk-text-muted uk-text-small uk-text-italic">Notes: {{ $income->note }}</span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

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
             _("status").innerHTML = Math.round(percent) + "% uploaded";
        }

        function completeHandler(event) {
             _("status").innerHTML = event.target.responseText;

            UIkit.modal.alert(event.target.responseText)
            _("progressBar").value = 100;
           // _("progressBar").style.display = "none";
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


