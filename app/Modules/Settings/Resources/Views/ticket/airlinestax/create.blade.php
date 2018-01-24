@extends('layouts.main')

@section('title', 'airlines Tax')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('top_bar')
    <div id="top_bar">

    </div>
@endsection
@section('content')
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile"
         xmlns:color="http://www.w3.org/1999/xhtml">
        <div class="uk-width-large-10-10">
            {!! Form::open(['url' => 'ticket/settings/airlinestax/store', 'method' => 'post', 'class' => 'uk-form-stacked', 'id' => 'user_edit_form', 'files' => 'true']) !!}
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Create Airlines Expense</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="contact_category_id" class="uk-vertical-align-middle">Airlines</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <select name="airline_id" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" required>
                                            <option value="">Select Airlines</option>
                                            @foreach($airlines as $airline)
                                                <option value="{{ $airline->id }}">{{ $airline->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="contact_category_id" class="uk-vertical-align-middle">Tax</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <div class="uk-grid form_section" id="form_row">
                                            <div class="uk-width-1-1">
                                                <div class="uk-input-group">

                                                    <select id="tickettax_id"  name="tickettax_id[]" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}">
                                                        <option value="">Select Tax</option>
                                                        @foreach($tax as $value)
                                                            <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                        @endforeach
                                                    </select>


                                                    <span class="uk-input-group-addon">
                                                          <a href="#" class="btnSectionClone" data-section-clone="#form_row"><i class="material-icons md-24"></i></a>
                                                            </span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-1-1 uk-float-right">
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


    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/select2.min.js"></script>
    <script type="text/javascript">
        $('select').select2();
        $('#sidebar_contact').addClass('current_section');
    </script>
@endsection