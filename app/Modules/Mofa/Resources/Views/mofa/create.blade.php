@extends('layouts.main')

@section('title', 'Mofa create')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New Mofa</span></h2>
                                <div class="uk-width-medium-1-3">
                                    <div class="md-btn-group">
                                        <a href="{{ route('mofa') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">All</a>
                                        <a href="{{ route('mofa_create',$id) }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Add</a>
                                        <a href="{{ URL::previous() }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md-card">
                            {!! Form::open(['url' => route('mofa_store'), 'method' => 'POST','files' => true]) !!}
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="payment_date">Mofa Date <i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="payment_date">Select date</label>
                                            <input class="md-input" type="text" id="mofa_date" name="mofa_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" />
                                        </div>
                                        @if($errors->first('mofa_date'))
                                            <div class="uk-text-danger">Date is required.</div>
                                        @endif
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="Local">Pax Id <i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="Local">Pax </label>
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Pax" id="local_ref" name="pax_ref">
                                                <option>Select Pax</option>
                                                @foreach($order as $value)
                                                    @if($value->id==$id)
                                                    <option selected value=" {{ $value->id }} " > {{ $value->paxid }} </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @if($errors->has('pax_ref'))
                                                <div class="uk-text-danger">{{ $errors->first('pax_ref') }}</div>
                                            @endif
                                        </div>
                                    </div>



                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="mofa_number">Mofa Number<i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="mofa_number">mofa Number</label>
                                            <input class="md-input" type="text" id="mofa_number" name="mofa_number" />
                                            @if($errors->has('mofa_number'))
                                                <div class="uk-text-danger">{{ $errors->first('mofa_number') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="iqamaNumber">Iqama Number</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="iqamaNumber">Iqama Number</label>
                                            <input class="md-input" type="text" id="iqamaNumber"  name="iqamaNumber" />
                                            @if($errors->has('iqamaNumber'))
                                                <div class="uk-text-danger">{{ $errors->first('iqamaNumber') }}</div>
                                            @endif
                                        </div>
                                    </div> -->
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="iqamaNumber">Profession</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="iqamaNumber">Profession</label>
                                            <input class="md-input" type="text" id="profession"  name="profession" />
                                            @if($errors->has('profession'))
                                                <div class="uk-text-danger">{{ $errors->first('profession') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="payment_date">Medical Center Submit Date <i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="payment_date">Select date</label>
                                            <input class="md-input" type="text" id="mofa_date" name="medical_submit_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" />
                                        </div>
                                        @if($errors->has('medical_submit_date'))
                                            <div class="uk-text-danger">{{ $errors->first('medical_submit_date') }}</div>
                                        @endif
                                    </div>


                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="status">Status</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <p>
                                                <input checked value="1" type="radio" name="status" id="status" data-md-icheck />
                                                <label  for="radio_demo_1"  class="inline-label">Ok</label>
                                            </p>
                                            <p>
                                                <input type="radio" value="0" name="status"  id="status" data-md-icheck />
                                                <label for="radio_demo_2" class="inline-label">Not ok</label>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="Flag_Number">Comments</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <div class="uk-form-row">
                                                <textarea name="comments" cols="30" rows="4" class="md-input no_autosize"></textarea>
                                                @if($errors->has('comments'))
                                                    <div class="uk-text-danger">{{ $errors->first('comments') }}</div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="visaType">Upload File</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <div class="md-card">
                                                <div class="md-card-content">
                                                    <div class="uk-grid form_section" id="d_form_row">
                                                        <div class="uk-width-1-1">
                                                            <div class="uk-input-group">
                                                                <label for="visaType">Title</label>
                                                                <input type="text" id="visaType" class="md-input"  name="title[]" required="1" />
                                                                <br>
                                                                <br>
                                                                <input type="file" class="md-input" name="img_url[]" required="1">
                                                                @if($errors->has('img_url'))
                                                                    <div class="uk-text-danger">{{ $errors->first('img_url') }}</div>
                                                                @endif
                                                                {{--<span class="uk-input-group-addon">--}}
                                                                   {{--<a href="#" class="btnSectionClone" data-section-clone="#d_form_row"><i class="material-icons md-24">&#xE146;</i></a>--}}
                                                                {{--</span>--}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

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
    $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_mofa').addClass('act_item');
        $(window).load(function(){
            $("#tiktok2").trigger('click');
        })
</script>


@endsection