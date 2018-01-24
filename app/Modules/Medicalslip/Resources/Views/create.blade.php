@extends('layouts.main')
@section('title')
 Add Medical Report
@endsection

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection


@section('content')

    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
         <form action="{{ route('medicalslip_store') }}"  method="post" class="uk-form-stacked" id="class_store">
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
                                {{ csrf_field() }}
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate" id="user_edit_uname"> Add Medical Report </span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Pax Id</label>
                                    </div>
                                    <div class="uk-width-1-4">
                                        <div class="parsley-row">
                                            <select name="paxid" id="paxid" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="select class">
                                                <option value="">Select Pax ID</option>
                                                @foreach($recrut as $value)
                                                    @if($value->id==$id)
                                                    <option selected value="{!! $value->id !!}">{!! $value->paxid !!}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    @if($errors->has('paxid'))

                                        <span style="color:red">{!!$errors->first('paxid')!!}</span>

                                    @endif
                                </div>

                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-5">
                                        <label for="medicalcn">Medical Centre Name</label>
                                    </div>
                                    <div class="uk-width-1-4">
                                        <div class="parsley-row">
                                            <input type="text" id="medicalcn" name="medical_centre_name" required class="md-input"  />
                                        </div>
                                    </div>
                                    @if($errors->has('medical_centre_name'))

                                        <span style="color:red">{!!$errors->first('medical_centre_name')!!}</span>

                                    @endif
                                </div>

                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-5">
                                        <label for="start_date">Medical date</label>
                                    </div>
                                    <div class="uk-width-1-4">
                                        <input class="md-input" type="text" id="test_date" name="medical_date" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                    </div>
                                    @if($errors->has('medical_date'))

                                        <span style="color:red">{!!$errors->first('medical_date')!!}</span>

                                    @endif
                                </div>

                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="start_date">Medical Report date</label>
                                    </div>
                                    <div class="uk-width-1-4">

                                        <input class="md-input" type="text" id="test_date" name="medical_report_date" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                    </div>
                                    @if($errors->has('medical_report_date'))

                                        <span style="color:red">{!!$errors->first('medical_report_date')!!}</span>

                                    @endif
                                </div>

                                <div class="uk-grid">
                                    <div class="uk-width-1-2 uk-float-right">
                                        <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                        <a href="{{ url()->previous() }}" type="button" class="md-btn md-btn-flat uk-modal-close">Close</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
        </form>
    </div>
    </div>


@endsection

@section('scripts')
    <script>
        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_medical_report').addClass('act_item');
        $(window).load(function(){
            $("#tiktok2").trigger('click');
        })
    </script>
@endsection