@extends('layouts.main')

@section('title', 'Agreement Paper Create')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('angular')
    <script src="{{url('app/moneyin/invoice/invoice.module.js')}}"></script>
    <script src="{{url('app/moneyin/invoice/invoice.controller.js')}}"></script>
@endsection

@section('content')
    <div class="uk-grid" ng-controller="InvoiceController">
        <div class="uk-width-large-10-10">
            @if(Session::has('msg'))
                <div class="uk-alert uk-alert-success" data-uk-alert>
                    <a href="#" class="uk-alert-close uk-close"></a>
                    {!! Session::get('msg') !!}
                </div>
            @endif
            {!! Form::open(['url' => route('agreement_store'), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Agreement Paper Form</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">

                              <div class="uk-width-medium-3-5">
                                <div class="md-card">
                                    <div class="md-card-content">
                                        <h3 class="heading_a">Select Pax ID <span style="color: red">*</span></h3>
                                        <div class="uk-grid">
                                            <div class="uk-width-medium-2-2">
                                                <select id="selec_adv_1" name="recruit_id[]" multiple>
                                                    @foreach($order as $value)
                                                        <option value="{!! $value->id !!}">{!! $value->paxid !!}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               </div>


                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Country Name</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Country Name</label>
                                        <input class="md-input" type="text"  name="country_name" required>
                                        @if($errors->has('country_name'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('country_name')!!}</span>

                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Gender</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Gender Name</label>
                                        <input class="md-input" type="text" name="gender" value="০১(এক) জন পুরুষ" required>
                                        @if($errors->has('gender'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('gender')!!}</span>

                                        @endif
                                    </div>
                                </div>

                                <br>
                                <br>
                                <hr>
                                <br>
                                <br>


                                <div class="uk-grid uk-ma" data-uk-grid-margin>
                                    <div class="uk-width-1-1 uk-float-left">
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

    <script type="text/javascript">
        $(window).load(function(){
            $("#tiktok2").trigger('click');
            $("#ticktok3").trigger('click');
        })
        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_agreement_index').addClass('act_item');
    </script>

    <script>
        altair_forms.parsley_validation_config();
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection
