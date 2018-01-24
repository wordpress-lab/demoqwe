@extends('layouts.main')

@section('title', 'Edit Iqama Insurance ')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit Iqama Insurance</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                {!! Form::open(['url' => route('iqama_insurance_update',$recruit->id), 'method' => 'POST', 'files' => true]) !!}
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="name" class="uk-vertical-align-middle">Pax Id</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">

                                        <select disabled required id="selec_adv_1" >

                                                <option selected value="{{ $recruit->id }}" >{{ $recruit->paxid }}</option>

                                        </select>
                                        @if($errors->first('recruitingorder_id'))
                                            <div class="uk-text-danger">Pax is required.</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="contact" class="uk-vertical-align-middle">Date of Payment</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="date_of_payment">Date of Payment</label>
                                        <input value="{{ date("Y-m-d",strtotime($recruit->date_of_payment)) }}" required data-uk-datepicker="{format:'YYYY-MM-DD'}" class="md-input" type="text" id="date_of_payment" name="date_of_payment"/>
                                        @if($errors->first('date_of_payment'))
                                            <div class="uk-text-danger">Date is required.</div>
                                        @endif
                                    </div>


                                </div>




                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-5 uk-vertical-align">

                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <div class="uk-width-1-1 uk-float-right">
                                            <button type="submit" class="md-btn md-btn-primary">Submit</button>
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
        $('#sidebar_recruit').addClass('current_section');
        $('#iqama_insurance').addClass('act_item');
        $(window).load(function(){
            $("#tiktok2").trigger('click');
        })

    </script>
@endsection