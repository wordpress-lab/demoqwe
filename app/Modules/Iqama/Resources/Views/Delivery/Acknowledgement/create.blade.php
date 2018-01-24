@extends('layouts.main')

@section('title', 'Iqama Acknowledgement ')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')

    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>

                <div class="uk-width-xLarge-10-10  uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Add Acknowledgement</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                {!! Form::open(['url' => route('iqama_Delivery_acknowledgement_add_store',$recruit['id']), 'method' => 'POST', 'files' => true]) !!}
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="name" class="uk-vertical-align-middle">Pax Id</label>
                                    </div>
                                    <div class="uk-width-medium-2-3">

                                        <h2>{{ $recruit["paxid"] }}</h2>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="contact" class="uk-vertical-align-middle">Recipient Name</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <h2>{{ $recruit["rec_recipient_name"] }}</h2>

                                    </div>


                                </div>
                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="contact" class="uk-vertical-align-middle">Receive Date</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="submission_date">Receive Date</label>
                                        <input value="{{ date("Y-m-d",strtotime($recruit["ack_receive_date"]?$recruit["ack_receive_date"]:date("Y-m-d"))) }}" required data-uk-datepicker="{format:'YYYY-MM-DD'}" class="md-input" type="text" id="receive_date" name="receive_date"/>
                                        @if($errors->first('receive_date'))
                                            <div class="uk-text-danger">Date is required.</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="contact" class="uk-vertical-align-middle">Iqama Card</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">

                                            <h3 class="heading_a uk-margin-bottom"></h3>
                                            <div class="uk-form-file md-btn md-btn-primary">
                                             Choose
                                            <input onchange="getFileData(this);" name="file_url" id="form-file" type="file">
                                            </div>
                                            <span id="uploaded_file_name"></span>

                                        @if($errors->first('file_url'))
                                            <div class="uk-text-danger">File is required.</div>
                                        @endif
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <input type="hidden" value="{{ $recruit["ack_file_url"] }}" name="old_file">
                                        @if(is_file(public_path($recruit["ack_file_url"])))
                                            <a download target="_blank" href="{{ $userType==0?asset($recruit["ack_file_url"]):'' }}"  class="batch-edit"><i style="font-size: 25px;!important;" class="material-icons">file_download</i></a>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-5 uk-vertical-align">

                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <div class="uk-width-1-1 uk-float-left">
                                            <button type="submit" class="md-btn md-btn-primary">Save</button>
                                            <a href="{{ URL::previous() }}" >  <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button></a>
                                        </div>
                                    </div>

                                </div>
                                {!! Form::close() !!}
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
        function getFileData(myFile){
            var file = myFile.files[0];
            var filename = file.name;
            $(myFile).parent(".uk-form-file").next().text(filename);
        }
        $('#sidebar_recruit').addClass('current_section');
        $('#iqama_Delivery_acknowledgement_index').addClass('act_item');
        $(window).load(function(){
            $("#tiktok2").trigger('click');
            $("#iqama_tiktok").trigger('click');
            $("#iqama_tiktok_delivery").trigger('click')
        })

    </script>
@endsection