@extends('layouts.main')

@section('title', 'Bank Account')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
    <div class="uk-grid" ng-controller="InvoiceController">
        <div class="uk-width-large-10-10">
                <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                    <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Details Bank Info</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="customer_name">Account Type :</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="date">{{$bank->type}}</label>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="customer_name">Paid Through:</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="date">{{$payment_mode->account_name}}</label>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="customer_name">Account:</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="date">{{$accounts->account_name}}</label>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="customer_name">Bank Name :</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="date">{{$bank->contact->display_name}}</label>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="particulars">Particulars :</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="particulars">{{$bank->particulars}}</label>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="date">Date :</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="date">{{$bank->date}}</label>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="cheque_number">Cheque Number :</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="cheque_number">{{$bank->cheque_number}}</label>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="total_amount">Total Amount :</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="total_amount">{{$bank->total_amount}}</label>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="notes">Notes :</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="notes">{{$bank->notes}}</label>
                                        </div>
                             	    </div>
                                    <div  id="print" class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="notes">Files :</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            @if($bank->file_url)
                                                <a  download href="{{ url($bank->file_url) }}"><p class="uk-text-medium uk-margin-bottom">Download Attachment</p></a>
                                            @endif
                                        </div>

                                    </div>
                                    <div id="print" class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">

                                        </div>

                                        <div class="uk-width-medium-1-2">

                                            <progress id="progressBar" value="0" max="100" style="width:100%;display:none;" ></progress>
                                            <div  style="float: left;margin-right: 15px; height: 14px;" class="uk-form-file md-btn md-btn-wave-light">
                                                Upload file
                                                <input name="file1" id="file1" type="file" onchange="uploadFile()">
                                            </div>

                                            <span  id="status"></span>
                                            <span  id="loaded_n_total"></span>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
@section('styles')
    <style>


        @media print {


            #print{
                display: none;
            }
        }
    </style>
@endsection
@section('scripts')

    <script>
        altair_forms.parsley_validation_config();
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

    <script type="text/javascript">
        $('#sidebar_bank').addClass('current_section');
        $('#sidebar_bank_bank').addClass('act_item');
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

           // UIkit.modal.alert(event.target.responseText)
            _("progressBar").value = 0;
           // _("progressBar").style.display = "none";
            _("progressBar").value = 100;
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
