@extends('layouts.admin')

@section('title', 'Add FingerPrint')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('content')

    <div class="uk-grid" ng-controller="InvoiceController">
        <div class="uk-width-large-10-10">
            @if(Session::has('msg'))
                <div class="uk-alert uk-alert-success" data-uk-alert>
                    <a href="#" class="uk-alert-close uk-close"></a>
                    {!! Session::get('msg') !!}
                </div>
            @endif
            {!! Form::open(['url' => route('fingerprint_store', $order->id), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
                <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                    <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Create New Finger Print</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="customer_name">Pax Id <i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            
                                            <label class="uk-vertical-align-middle" for="customer_name">{{ $order->paxid }}</label>
                                            
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="invoice_date">Date</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="invoice_date">Select date</label>
                                            <input class="md-input" type="text" id="uk_dp_1" name="date" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="invoice_date">Number</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="invoice_date">Select Number</label>
                                            <input class="md-input" type="text" name="number">
                                            
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="invoice_date">BMET Status</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <span class="icheck-inline">
                                                <input type="radio" name="bmet_status" id="radio_demo_inline_1" value="1" data-md-icheck />
                                                <label for="radio_demo_inline_1" class="inline-label">Ok</label>
                                            </span>
                                            <span class="icheck-inline">
                                                <input type="radio" name="bmet_status" id="radio_demo_inline_2" value="0" data-md-icheck checked/>
                                                <label for="radio_demo_inline_2" class="inline-label">Not ok</label>
                                            </span>
                                            
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="invoice_number">Comments </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="invoice_number"></label>
                                            <textarea type="text" name="comment" class="md-input" cols="4" rows="4"></textarea>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-5 uk-vertical-align">
                                                <label class="uk-vertical-align-middle" for="visaType">Upload File</label>
                                            </div>
                                                <div class="uk-width-medium-2-5">
                                                    <div class="md-card">
                                                        <div class="md-card-content">
                                                            <div class="uk-grid form_section" id="d_form_row">
                                                                <div class="uk-width-1-1">
                                                                    <div class="uk-input-group">
                                                                        <label for="visaType">Title</label>
                                                                        <input type="text" id="visaType" class="md-input"  name="title[]" required/>
                                                                        <br>
                                                                        <br>
                                                                        <input type="file" class="md-input" name="img_url[]" required>

                                                                        {{--<span class="uk-input-group-addon">--}}
                                                                           {{--<a href="#" class="btnSectionClone" data-section-clone="#d_form_row"><i class="material-icons md-24">&#xE146;</i></a>--}}
                                                                       {{--</span>--}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                             </div>
                                           <hr>



                                    <div class="uk-grid uk-ma" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">

                                        </div>
                                        <div class="uk-width-2-5 uk-float-left">
                                            <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('scripts')

    <script>
        $('#sidebar_recruit').addClass('current_section');

        $('#sidebar_finger_2').addClass('act_item');

        $(window).load(function(){
            $("#tiktok2").trigger('click');
        })
        altair_forms.parsley_validation_config();
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection
