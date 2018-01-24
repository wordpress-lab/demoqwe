@extends('layouts.main')

@section('title', 'Hajj  Gift pack Edit')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style>
        .btnSectionRemove i.md-24 {

            font-size: 50px !important ;
            vertical-align: -80px !important;
        }


    </style>
@endsection

@section('top_bar')
    <div id="top_bar">
        <div class="md-top-bar">
            <ul id="menu_top" class="uk-clearfix">
                <li data-uk-dropdown class="uk-hidden-small">
                    <a href="#"><i class="material-icons">&#xE02E;</i><span>Medical</span></a>
                    <div class="uk-dropdown">
                        <ul class="uk-nav uk-nav-dropdown">
                            <li><a href="{{ route('Hajj_Medicale_Certificate') }}">Medical Cerificate</a></li>

                        </ul>
                    </div>
                </li>
                <li data-uk-dropdown class="uk-hidden-small">
                    <a href="#"><i class="material-icons">&#xE02E;</i><span>Police</span></a>
                    <div class="uk-dropdown">
                        <ul class="uk-nav uk-nav-dropdown">
                            <li><a href="{{ route('Hajj_Police_Clearence') }}">Police Clearence</a></li>

                        </ul>
                    </div>
                </li>



            </ul>
        </div>
    </div>
@endsection
@section('content')
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10" ng-controller="ContactEditController">
            {!! Form::open(['url' => array('hajj/giftpack/store', 1), 'method' => 'post', 'class' => 'uk-form-stacked', 'id' => 'user_edit_form', 'files' => 'true']) !!}
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">



                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit Gift </span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">

                                <div class="uk-grid form_section" id="d_form_row" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-3" >
                                        <div class="md-card">
                                            <div class="md-card-content">

                                                <div class="uk-grid">
                                                    <div class="uk-width-large-1-1 uk-width-1-1">
                                                        <select id="d_form_select_country" data-md-selectize required>
                                                            <option value="">Product...</option>
                                                            <option value="a">country A</option>
                                                            <option value="b">country B</option>
                                                            <option value="c">country C</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <div class="md-card">
                                            <div class="md-card-content">

                                                <div class="uk-grid">
                                                    <div class="uk-width-large-1-1 uk-width-1-1">
                                                        <label>Quantity</label>
                                                      <input type="text" class="md-input">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <div class="uk-grid">
                                            <div  class="uk-width-medium-1-4">
                                         <span class="uk-input-group-addon">
                                            <a href="#" class="btnSectionClone" data-section-clone="#d_form_row"><i style="color:orange; font-size: 50px; vertical-align: -80px;" class="material-icons md-24">&#xE146;</i></a>
                                        </span>
                                           </div>
                                         </div>
                                     </div>

                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-1-1 uk-float-right">
                                        <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                        <a href="{{ route('Hajj_GiftPack') }}" type="button" class="md-btn md-btn-flat uk-modal-close">Close</a>
                                    </div>

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
    <script type="text/javascript">
        $('#Hajj').addClass('current_section');
        $('#Hajj_GiftPack').addClass('act_item');
    </script>>
@endsection