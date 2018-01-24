@extends('layouts.main')

@section('title', 'Kafala add after 60 days ')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Add Kafala before 60 days</span></h2>
                            </div>
                        </div>

                        <div class="user_content">
                            <div class="uk-margin-top">
                                {!! Form::open(['url' => route('iqama_kafala_after_store',$kafala["id"]), 'method' => 'POST', 'files' => true]) !!}





                                <div class="uk-width-medium-1-1">

                                        <div style="background-color:ghostwhite " class="uk-width-9-10">
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label for="contact" class="uk-vertical-align-middle">Pax Id</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">

                                               <h4>{{ $kafala["paxid"] }}</h4>

                                                </div>
                                            </div>
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label for="contact" class="uk-vertical-align-middle">Grama Rate/month</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <label for="grama_rate">Grama rate</label>
                                                    <input  onkeypress='numbervalidate(event)' value="{{ $kafala["grama_rate"] }}" class="md-input" type="text" id="grama_rate" name="grama_rate"/>
                                                    @if($errors->first('grama_rate'))
                                                        <div class="uk-text-danger">grama rate is required.</div>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label for="contact" class="uk-vertical-align-middle">Receive Date</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <label for="receive_date">Date</label>
                                                    <input value="{{ date("Y-m-d",strtotime($kafala["date_of_kafala"]?$kafala["receive_date"]:date("Y-m-d"))) }}" data-uk-datepicker="{format:'YYYY-MM-DD'}" class="md-input" type="text" id="receive_date" name="receive_date"/>
                                                    @if($errors->first('receive_date'))
                                                        <div class="uk-text-danger">date is required.</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label for="contact" class="uk-vertical-align-middle">Date of Payment to Company</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <label for="date_of_payment">Date</label>
                                                    <input value="{{ date("Y-m-d",strtotime($kafala["date_of_payment"]?$kafala["date_of_payment"]:date("Y-m-d"))) }}" data-uk-datepicker="{format:'YYYY-MM-DD'}" class="md-input" type="text" id="date_of_payment" name="date_of_payment"/>
                                                    @if($errors->first('date_of_payment'))
                                                        <div class="uk-text-danger">date is required.</div>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label for="contact" class="uk-vertical-align-middle">Payment Record</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">

                                                    <h3 class="heading_a uk-margin-bottom"></h3>
                                                    <div class="uk-form-file md-btn md-btn-primary">
                                                        Choose
                                                        <input onchange="getFileData(this);" name="file_url" id="form-file" class="file_upload_limit" type="file">
                                                    </div>
                                                    <span id="uploaded_file_name"></span>

                                                    @if($errors->first('file_url'))
                                                        <div id="file_status" class="uk-text-danger">File is required.</div>
                                                    @endif
                                                </div>
                                                <div class="uk-width-medium-1-3">
                                                    <input  type="hidden" value="{{ $kafala["file_url"] }}" name="old_file">
                                                    @if(is_file(public_path($kafala["file_url"])))
                                                        <a download target="_blank" href="{{ $userType==0?asset($kafala["file_url"]):'' }}"  class="batch-edit"><i style="font-size: 25px;!important;" class="material-icons">file_download</i></a>
                                                    @endif
                                                </div>
                                            </div>



                                        </div>







                                </div>






                                <br/>

                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <button type="submit" class="md-btn md-btn-primary">Submit</button>
                                        <a href="{{ URL::previous() }}" >  <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button></a>
                                    </div>
                                    <div class="uk-width-medium-2-5">

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
        $('#iqama_tiktok').addClass('current_section');
        $('#iqama_kafala_after_index').addClass('act_item');
        $(window).load(function(){
            $("#tiktok2").trigger('click');


        })

    </script>
@endsection