@extends('layouts.main')

@section('title', 'Edit Iqama Receive ')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New Iqama Receive</span></h2>
                            </div>
                        </div>

                        <div class="user_content">
                            <div class="uk-margin-top">
                                {!! Form::open(['url' => route('iqama_receive_update',$Receive->id), 'method' => 'POST', 'files' => true]) !!}
                                        <div class="uk-width-medium-1-1">
                                                        <div class="uk-grid uk-grid-medium form_section" id="d_form_section" data-uk-grid-match>
                                                            <div style="background-color:ghostwhite " class="uk-width-9-10">
                                                                <div class="uk-grid">
                                                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                                                        <label for="contact" class="uk-vertical-align-middle">Pax Id</label>
                                                                    </div>
                                                                    <div class="uk-width-medium-2-5">
                                                                          <h1> {{ $Receive->Recruitorder["paxid"] }}</h1>
                                                                    </div>
                                                                </div>
                                                                <div class="uk-grid">
                                                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                                                        <label for="contact" class="uk-vertical-align-middle">Receive Date</label>
                                                                    </div>
                                                                    <div class="uk-width-medium-2-5">
                                                                        <label for="submission_date">Receive Date</label>
                                                                        <input value="{{ date("Y-m-d",strtotime($Receive["receive_date"])) }}" data-uk-datepicker="{format:'YYYY-MM-DD'}" class="md-input" type="text" id="receive_date" name="receive_date"/>
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
                                                                        <div class="md-card-content">
                                                                            <h3 class="heading_a uk-margin-bottom"></h3>
                                                                            <div class="uk-form-file md-btn md-btn-primary">
                                                                                Select
                                                                                <input onchange="getFileData(this);" name="file_url" id="form-file" type="file">

                                                                            </div>
                                                                            <span id="uploaded_file_name"></span>

                                                                        </div>
                                                                        @if($errors->first('file_url'))
                                                                            <div class="uk-text-danger">File is required.</div>
                                                                        @endif

                                                                        <a style="float: right; position: relative; top: -49px;" target="_blank" href="{{ route("iqama_receive_download",$Receive["id"]) }}" class="batch-edit"><i style="font-size: 40px;" class="material-icons">file_download</i></a>

                                                                    </div>

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
            $("#uploaded_file_name").text(filename);
        }
        $('#sidebar_recruit').addClass('current_section');
        $('#iqama_receive').addClass('act_item');
        $(window).load(function(){
            $("#tiktok2").trigger('click');
            $("#iqama_tiktok").trigger('click');
        })

    </script>
@endsection