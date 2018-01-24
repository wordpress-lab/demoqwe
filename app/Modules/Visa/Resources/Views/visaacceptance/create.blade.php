@extends('layouts.main')

@section('title', 'Visa Acceptance')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
    <div class="uk-grid">
        <div class="uk-width-large-10-10">
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New Visa Acceptance</span></h2>
                                <div class="uk-width-medium-1-3">
                                    <div class="md-btn-group">
                                        <a href="{{ route('visaacceptance') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">All</a>
                                        <a href="{{ route('visaacceptance_create') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Add</a>
                                        <a href="{{ URL::previous() }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md-card">
                            {!! Form::open(['url' => route('visaacceptance_store'), 'method' => 'POST']) !!}
                            <div class="user_content">
                                <div class="uk-margin-top">

                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="Local">Register Serial</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="registerSerial"> RegisterSerial </label>
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Register Serial" id="registerSerial" name="registerSerial">
                                                <option>Select Register Serial</option>
                                                @foreach($regSerial as $value)
                                                    <option value="{{ $value->id }}" > {{ $value->registerSerial }} </option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('registerSerial'))
                                                <br/>
                                                <div class="uk-text-danger">{{ $errors->first('registerSerial') }}</div>
                                            @endif
                                        </div>
                                    </div>




                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="status">Visa Advice Status</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                                <input checked value="1" type="radio" name="visaadvicestatus" id="visaadvicestatus" data-md-icheck />
                                                <label  for="radio_demo_1"  class="inline-label">ok</label>


                                                <input type="radio" value="0" name="visaadvicestatus"  id="visaadvicestatus" data-md-icheck />
                                                <label for="radio_demo_2" class="inline-label">not ok</label>

                                            <p for="Flag_Number">Comments</p>
                                            <div class="uk-form-row">

                                                <textarea name="visa_advice_comments" cols="30" rows="4" class="md-input no_autosize">{{ old('visa_advice_comments')}}</textarea>
                                                @if($errors->has('visa_advice_comments'))
                                                    <div class="uk-text-danger">{{ $errors->first('visa_advice_comments') }}</div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="status">Okala Status</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <input checked value="1" type="radio" name="okala_status" id="okala_status" data-md-icheck />
                                            <label  for="radio_demo_1"  class="inline-label">ok</label>


                                            <input type="radio" value="0" name="okala_status"  id="okala_status" data-md-icheck />
                                            <label for="radio_demo_2" class="inline-label">not ok</label>

                                            <p for="Flag_Number">Okala Comments</p>
                                            <div class="uk-form-row">

                                                <textarea name="okala_comments" cols="30" rows="4" class="md-input no_autosize">{{ old('okala_comments')}}</textarea>
                                                @if($errors->has('okala_comments'))
                                                    <div class="uk-text-danger">{{ $errors->first('okala_comments') }}</div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>


                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="status">Consulator Status</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <input checked value="1" type="radio" name="consulator_status" id="consulator_status" data-md-icheck />
                                            <label  for="radio_demo_1"  class="inline-label">ok</label>


                                            <input type="radio" value="0" name="consulator_status"  id="consulator_status" data-md-icheck />
                                            <label for="radio_demo_2" class="inline-label">not ok</label>

                                            <p for="Flag_Number"> Comments</p>
                                            <div class="uk-form-row">

                                                <textarea name="consulator_comments" cols="30" rows="4" class="md-input no_autosize">{{ old('consulator_comments')}}</textarea>
                                                @if($errors->has('consulator_comments'))
                                                    <div class="uk-text-danger">{{ $errors->first('consulator_comments') }}</div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="status">Power Of Attorney Status</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <input checked value="1" type="radio" name="power_status" id="power_status" data-md-icheck />
                                            <label  for="radio_demo_1"  class="inline-label">ok</label>


                                            <input type="radio" value="0" name="power_status"  id="power_status" data-md-icheck />
                                            <label for="radio_demo_2" class="inline-label">not ok</label>

                                            <p for="Flag_Number">Comments</p>
                                            <div class="uk-form-row">

                                                <textarea name="power_comments" cols="30" rows="4" class="md-input no_autosize">{{ old('power_comments')}}</textarea>
                                                @if($errors->has('power_comments'))
                                                    <div class="uk-text-danger">{{ $errors->first('power_comments') }}</div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>


                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="botaka_status">Botaka Status</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <input checked value="1" type="radio" name="botaka_status" id="botaka_status" data-md-icheck />
                                            <label  for="botaka_status"  class="inline-label">ok</label>


                                            <input type="radio" value="0" name="botaka_status"  id="botaka_status" data-md-icheck />
                                            <label for="botaka_status" class="inline-label">not ok</label>

                                            <p for="Flag_Number">Comments</p>
                                            <div class="uk-form-row">

                                                <textarea name="botaka_comments" cols="30" rows="4" class="md-input no_autosize">{{ old('botaka_comments')}}</textarea>
                                                @if($errors->has('botaka_comments'))
                                                    <div class="uk-text-danger">{{ $errors->first('botaka_comments') }}</div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>


                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="contact_form_status">Contact Form Status</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <input checked value="1" type="radio" name="contact_form_status" id="contact_form_status" data-md-icheck />
                                            <label  for="radio_demo_1"  class="inline-label">ok</label>


                                            <input type="radio" value="0" name="contact_form_status"  id="contact_form_status" data-md-icheck />
                                            <label for="radio_demo_2" class="inline-label">not ok</label>

                                            <p for="Flag_Number">Comments</p>
                                            <div class="uk-form-row">

                                                <textarea name="contact_form_comments" cols="30" rows="4" class="md-input no_autosize">{{ old('contact_form_comments')}}</textarea>
                                                @if($errors->has('contact_form_comments'))
                                                    <div class="uk-text-danger">{{ $errors->first('contact_form_comments') }}</div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>




                                    <div class="uk-grid uk-ma" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-left">
                                            <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                        </div>
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
@endsection
@section('scripts')

<script>
    $(window).load(function(){
        $("#tiktok2").trigger('click');
        $("#ticktok3").trigger('click');
    })
    $('#sidebar_recruit').addClass('current_section');
    $('#sidebar_visaacceptance').addClass('act_item');
</script>

@endsection