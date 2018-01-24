@extends('layouts.main')

@section('title', 'Iqama Receive ')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New Iqama Recipient</span></h2>
                            </div>
                        </div>

                        <div class="user_content">
                            <div class="uk-margin-top">
                                {!! Form::open(['url' => route('iqama_Delivery_receipient_store'), 'method' => 'POST', 'files' => false]) !!}





                                        <div class="uk-width-medium-1-1">
                                                        <div class="uk-grid uk-grid-medium form_section" id="d_form_section" data-uk-grid-match>
                                                            <div style="background-color:ghostwhite " class="uk-width-9-10">
                                                                <div class="uk-grid">
                                                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                                                        <label for="contact" class="uk-vertical-align-middle">Pax Id</label>
                                                                    </div>
                                                                    <div class="uk-width-medium-2-5">
                                                                        <select required name="recruitingorder_id[]" data-md-selectize id="select_demo_5" class="md-input" title="Select with Paxid">>
                                                                          @foreach($recruit as $item)
                                                                              <option value="{{ $item->id }}"> {{ $item->paxid }}</option>
                                                                          @endforeach
                                                                        </select>

                                                                        @if($errors->first('recruitingorder_id'))
                                                                            <div class="uk-text-danger">Pax is required.</div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="uk-grid">
                                                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                                                        <label for="contact" class="uk-vertical-align-middle">Recipient Name</label>
                                                                    </div>
                                                                    <div class="uk-width-medium-2-5">
                                                                        <label for="submission_date">Recipient Name</label>
                                                                        <input required  class="md-input" type="text" id="recipient_name" name="recipient_name[]"/>
                                                                        @if($errors->first('recipient_name'))
                                                                            <div class="uk-text-danger">name is required.</div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="uk-width-1-3">
                                                                        <div class="uk-vertical-align-middle">
                                                                            <a href="#" class="btnSectionClone" data-section-clone="#d_form_section"><i class="material-icons md-36">&#xE146;</i></a>
                                                                        </div>
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
           $(myFile).parent(".uk-form-file").next().text(filename);
        }
        $('#iqama_tiktok').addClass('current_section');
        $('#iqama_Delivery_receipient_index').addClass('act_item');
        $(window).load(function(){
            $("#tiktok2").trigger('click');
            $("#iqama_tiktok").trigger('click');
            $("#iqama_tiktok_delivery").trigger('click')
        })

    </script>
@endsection