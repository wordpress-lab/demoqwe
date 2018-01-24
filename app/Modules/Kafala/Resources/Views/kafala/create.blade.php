@extends('layouts.main')

@section('title', 'Kafala add before 60 days ')

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
                                {!! Form::open(['url' => route('iqama_kafala_store',$kafala["id"]), 'method' => 'POST', 'files' => false]) !!}





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
                                                    <label for="contact" class="uk-vertical-align-middle">Company Name</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <label for="submission_date">Company Name</label>
                                                    <input value="{{ $kafala["company_name"] }}" class="md-input" type="text" id="company_name" name="company_name"/>
                                                    @if($errors->first('company_name'))
                                                        <div class="uk-text-danger">name is required.</div>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label for="contact" class="uk-vertical-align-middle">Date of Kafala</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <label for="date_of_kafala">Date</label>
                                                    <input value="{{ date("Y-m-d",strtotime($kafala["date_of_kafala"]?$kafala["date_of_kafala"]:date("Y-m-d"))) }}" data-uk-datepicker="{format:'YYYY-MM-DD'}" class="md-input" type="text" id="date_of_kafala" name="date_of_kafala"/>
                                                    @if($errors->first('date_of_kafala'))
                                                        <div class="uk-text-danger">date is required.</div>
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
        $('#iqama_kafala_index').addClass('act_item');
        $(window).load(function(){
            $("#tiktok2").trigger('click');


        })

    </script>
@endsection