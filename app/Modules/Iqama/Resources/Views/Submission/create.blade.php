@extends('layouts.main')

@section('title', 'Iqama Insurance ')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New Iqama Submission</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                {!! Form::open(['url' => route('iqama_submission_store'), 'method' => 'POST', 'files' => true]) !!}
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="name" class="uk-vertical-align-middle">Pax Id</label>
                                    </div>
                                    <div class="uk-width-medium-2-3">

                                        <select required id="selec_adv_1" name="recruitingorder_id[]" multiple>
                                            @foreach($recruit as $item)
                                                <option value="{{ $item->id }}" >{{ $item->paxid }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->first('recruitingorder_id'))
                                            <div class="uk-text-danger">Pax is required.</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="contact" class="uk-vertical-align-middle">Date of Submission</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="submission_date">Date of Submission</label>
                                        <input required data-uk-datepicker="{format:'YYYY-MM-DD'}" class="md-input" type="text" id="submission_date" name="submission_date"/>
                                        @if($errors->first('submission_date'))
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
        $('#iqama_submission').addClass('act_item');
        $(window).load(function(){
            $("#tiktok2").trigger('click');
        })

    </script>
@endsection