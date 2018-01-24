@extends('layouts.main')

@section('title', 'Okala')

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
            {!! Form::open(['url' => route('okala_store'), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
                <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                    <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Create New Okala</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="customer_name">Pax Id</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Customer" id="customer_id" name="paxid">
                                                <option value="">Select Pax Id</option>
                                                @foreach($order as $value)
                                                    @if($value->id==$id)
                                                    <option value="{!! $value->id !!}" selected>{!! $value->paxid !!}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @if($errors->has('paxid'))

                                                <span style="color:red; position: relative; right:-500px">{!!$errors->first('paxid')!!}</span>

                                            @endif
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="invoice_date">Okala Date</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="invoice_date">Select date</label>
                                            <input class="md-input" type="text" id="invoice_date" name="date" data-uk-datepicker="{format:'YYYY-MM-DD'}" required>
                                            @if($errors->has('date'))

                                                <span style="color:red; position: relative; right:-500px">{!!$errors->first('date')!!}</span>

                                            @endif
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="invoice_number">Comments </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="invoice_number"></label>
                                            <textarea type="text" name="comment" class="md-input" cols="4" rows="4"></textarea>
                                            @if($errors->has('name'))

                                                <span style="color:red; position: relative; right:-500px">{!!$errors->first('name')!!}</span>

                                            @endif
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="invoice_number">Status</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <span class="icheck-inline">
                                                <input type="radio" id="radio_demo_inline_1" value="1" name="status" data-md-icheck checked/>
                                                <label for="radio_demo_inline_1" class="inline-label">Ok</label>
                                            </span>

                                            <span class="icheck-inline">
                                                <input type="radio" id="radio_demo_inline_2" value="0" name="status" data-md-icheck/>
                                                <label for="radio_demo_inline_2" class="inline-label">Not Ok</label>
                                            </span>
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

    <script>
        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_okala_index').addClass('act_item');
        altair_forms.parsley_validation_config();
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection
