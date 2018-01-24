@extends('layouts.main')

@section('title', 'Police Clearance Edit')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
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
            {!! Form::open(['url' => array('contact/update', 1), 'method' => 'post', 'class' => 'uk-form-stacked', 'id' => 'user_edit_form', 'files' => 'true']) !!}
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">




                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit Medical Certificate</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-grid">
                                <div class="uk-width-large-1-2" >


                                    <div class="md-card-content">
                                        <h3 class="heading_a">Status</h3>

                                        <div class="uk-width-medium-2-5">
                                            <p>
                                                <input name="status" type="radio" name="radio_demo" id="radio_demo_1" data-md-icheck />
                                                <label for="radio_demo_1" class="inline-label">Ok</label>
                                            </p>
                                            <p>
                                                <input name="status"  checked type="radio" name="radio_demo" id="radio_demo_2" data-md-icheck />
                                                <label for="radio_demo_2" class="inline-label">Not Ok</label>
                                            </p>


                                        </div>

                                    </div>



                                </div>

                            </div>

                            <div class="uk-grid">
                                <div class="uk-width-large-1-2">


                                    <div class="uk-input-group">
                                        <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                        <label for="uk_dp_1">Select date</label>
                                        <input name="date" class="md-input" type="text" id="uk_dp_1" data-uk-datepicker="{format:'DD-MM-YYYY'}">
                                    </div>
                                </div>

                            </div>

                            <div class="uk-grid">
                                <div class="uk-width-large-10-10">
                                    <div class="uk-width-1-1 ">
                                        <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                        <a href=" {!! URL::previous() !!}   " type="button" class="md-btn md-btn-flat uk-modal-close">Close</a>
                                    </div>
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
        $('#Hajj_Medicale_Certificate').addClass('act_item');
    </script>
@endsection