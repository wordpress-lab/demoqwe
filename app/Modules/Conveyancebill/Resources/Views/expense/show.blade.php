@extends('layouts.invoice')

@section('title', 'Print Expense')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @inject('theader', '\App\Lib\TemplateHeader')
    @include('inc.sidebar')
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
                font-size: 14px;
                margin-top: -50px;
            }
            p, h1,h2{
                font-size: 12px;
            }


       @if($theader->getBanner()->headerType)
          .companyinfo{
              position: relative;
              top:-10px;
          }
          img.logo_regular{
                display: none;
            }
          #account_name{
            margin-top: -0px;
              font-size: 15px !important;
          }

          #hrd{
              margin-top: -10px;
          }
          .user_content{
           position: relative;
           top:-40px;
          }
            .uk-vertical-align-middle, label, h3{
                font-size: 11px;
            }
         @else

            .companyinfo{
                position: relative;
                top:0px;
            }

            #account_name{
                margin-top: -15px;
                font-size: 15px !important;
            }

            #hrd{
                margin-top: -10px;
            }
            .user_content{
                position: relative;
                top:-40px;
            }
            .user_content>.uk-grid{

            }
            .uk-vertical-align-middle, label, h3{
                font-size: 11px;
            }
        }
          @endif
        }
    </style>

@endsection

@section('content')
    <div class="uk-width-medium-10-10 uk-container-center reset-print">

        <div class="uk-grid uk-grid-collapse" data-uk-grid-margin>
            <div class="uk-width-large-2-10 hidden-print uk-visible-large">
                <div class="md-list-outside-wrapper">
                    <ul class="md-list md-list-outside">

                        <li class="heading_list">Recent Expenses</li>

                        @foreach($expenses as $expense_data)
                            <li>
                                <a href="{{ route('expense_show', ['id' => $expense_data->id]) }}" class="md-list-content">
                                    <span class="md-list-heading uk-text-truncate">{{ $expense_data->customer->display_name }}</span>
                                    <span class="uk-text-small uk-text-muted">{{ $expense_data->date }}</span>
                                </a>
                            </li>
                        @endforeach

                        <li class="uk-text-center">
                            <a class="md-btn md-btn-primary md-btn-mini md-btn-wave-light waves-effect waves-button waves-light uk-margin-top" href="{{ route('expense') }}">See All</a>
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
                                <span id="status"></span> <progress id="progressBar" value="0" max="100" style="float: left;margin-right: 15px; margin-top: 10px; height: 20px;width:300px; display: none;"></progress>
                                <div  style="float: left;margin-right: 15px; height: 14px;" class="uk-form-file md-btn md-btn-wave-light">
                                    Upload file
                                    <input name="file1" id="file1" type="file" onchange="uploadFile()">
                                </div>
                                @if($expense->save==1)
                                    <a  href="{!! route('expense_update_mark',$expense->id) !!}" id="popup" style="float: left;margin-right: 15px" class="md-btn md-btn-primary md-btn-mini md-btn-wave-light waves-effect waves-button waves-light">Mark as Open</a>
                                @endif
                                <i class="md-icon material-icons" id="invoice_print"></i>
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="false">
                                    <i class="md-icon material-icons"></i>
                                    <div class="uk-dropdown" aria-hidden="true">
                                        <ul class="uk-nav">
                                            <li>
                                                <a href="{{ route('expense_edit', ['id' => $expense->id]) }}">Edit</a>
                                            </li>
                                            @if($expense->file_url)
                                                <li>
                                                    <a download href="{{ url($expense->file_url) }}">Attach File</a>
                                                </li>
                                             @endif

                                            <li>
                                                <a class="uk-text-danger" href="{{ route('expense_delete', ['id' => $expense->id]) }}">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <h3 class="md-card-toolbar-heading-text large" id="invoice_name">Expense</h3>
                        </div>
                        <div class="md-card-content invoice_content print_bg" style="height: 301px;">
                            @include('inc.alert')

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
                            <h2 id="account_name" style="text-align: center;">{{ $expense->account->account_name }} <br/> <span>{{ $expense->save?"Draft":'' }}</span> </h2>
                              <hr id="hrd" />
                                <div class="uk-grid">
                                    <div  style="width: 80%; margin: auto; " class="uk-width-medium-1-1">
                                    <table border="1" id="tiktok_table" width="100%">
                                        <caption align="center" style="text-align: center">#EXP-{{ str_pad($expense->expense_number,6,'0',STR_PAD_RIGHT) }}</caption>

                                        <tr>
                                            <td>Expense Amount</td>
                                            <td><span>BDT {{ $expense->amount }} <small>on {{ $expense->date }}</small></span></td>
                                        </tr>
                                        @if($expense->paid_through_id)


                                                <tr>
                                                    <td>Paid Through</td>
                                                    <td>{{ $expense->accountPaidThrough->account_name }}</td>
                                                </tr>
                                        @endif
                                        @if($expense->invoice_show == "on")
                                            <tr>
                                                <td> Bank Info</td>
                                                <td>{{ $expense->bank_info }}</td>
                                            </tr>
                                        @endif
                                       <tr>
                                          <td>Tax Amount</td>
                                          <td>BDT {{ $expense->tax_total }} {{ $expense->tax_type == 1 ? '(Exclusive)' : '(Inclusive)' }}</td>
                                       </tr>
                                        @if($expense->reference)
                                           <tr>
                                               <td>Ref #</td>
                                               <td>{{ $expense->reference }}</td>
                                           </tr>
                                        @endif
                                       <tr>
                                           <td>Paid To</td>
                                           <td>{{ $expense->customer->display_name }}</td>
                                       </tr>
                                      <caption style="margin-top: 30px;" align="bottom">
                                          <span style="float: left" class="uk-text-small uk-margin-bottom">Customer Signature</span>
                                          <span style="float: right" class="uk-text-small uk-margin-bottom">Company Representative</span>
                                      </caption>
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
                _("progressBar").value = 0;
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

          //  UIkit.modal.alert(event.target.responseText)
            _("progressBar").value = 100;
            _("progressBar").style.display = "block";
        }

        function errorHandler(event) {
              _("status").innerHTML = "Upload Failed";
            alert("Upload Failed");
            _("progressBar").style.display = "none";
        }

        function abortHandler(event) {
            // _("status").innerHTML = "Upload Aborted";
            alert("Upload Aborted");
            _("progressBar").style.display = "none";
        }
        $('#sidebar_money_out').addClass('current_section');
        $('#sidebar_expense').addClass('act_item');

    </script>

@endsection
