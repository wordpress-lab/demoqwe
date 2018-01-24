@extends('layouts.main')

@section('title', 'Company Edit')

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
            {!! Form::open(['url' => route('form_basis_update',$basis->id), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit  Form Basis</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_number">Company Name EN </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_number"></label>
                                        <input class="md-input" type="text" id="name" value="{!! isset($basis->companyNameEN)?$basis->companyNameEN:'' !!}" name="companyNameEN"/>
                                        @if($errors->has('name'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('name')!!}</span>

                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_number">Company Name BN </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_number"></label>
                                        <input class="md-input" type="text" id="name" value="{!! isset($basis->companyNameBN)?$basis->companyNameBN:'' !!}" name="companyNameBN"/>
                                        @if($errors->has('name'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('name')!!}</span>

                                        @endif
                                    </div>
                                </div>


                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_number">Owner Name EN </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_number"></label>
                                        <input class="md-input" type="text" id="name" value="{!! isset($basis->ownerNameEN)?$basis->ownerNameEN:'' !!}" name="ownerNameEN"/>
                                        @if($errors->has('name'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('name')!!}</span>

                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_number">Owner Name BN </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_number"></label>
                                        <input class="md-input" type="text" id="name" value="{!! isset($basis->ownerNameBN)?$basis->ownerNameBN:'' !!}" name="ownerNameBN"/>
                                        @if($errors->has('name'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('name')!!}</span>

                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_number">Address EN </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_number"></label>
                                        <input class="md-input" type="text" id="name" value="{!! isset($basis->addressEN)?$basis->addressEN:'' !!}" name="addressEN"/>
                                        @if($errors->has('name'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('name')!!}</span>

                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_number">Address BN </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_number"></label>
                                        <input class="md-input" type="text" id="name" value="{!! isset($basis->addressBN)?$basis->addressBN:'' !!}" name="addressBN"/>
                                        @if($errors->has('name'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('name')!!}</span>

                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_number">Licence EN </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_number"></label>
                                        <input class="md-input" type="text" id="name" value="{!! isset($basis->licenceEN)?$basis->licenceEN:'' !!}" name="licenceEN"/>
                                        @if($errors->has('name'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('name')!!}</span>

                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_number">Licence BN </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_number"></label>
                                        <input class="md-input" type="text" id="name" value="{!! isset($basis->licenceBN)?$basis->licenceBN:'' !!}" name="licenceBN"/>
                                        @if($errors->has('name'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('name')!!}</span>

                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_number">Owner Designation EN </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_number"></label>
                                        <input class="md-input" type="text" id="name" value="{!! isset($basis->ownerDesignationEN)?$basis->ownerDesignationEN:'' !!}" name="ownerDesignationEN"/>
                                        @if($errors->has('name'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('name')!!}</span>

                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_number">Owner Designation BN </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_number"></label>
                                        <input class="md-input" type="text" id="name" value="{!! isset($basis->ownerDesignationBN)?$basis->ownerDesignationBN:'' !!}" name="ownerDesignationBN"/>
                                        @if($errors->has('name'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('name')!!}</span>

                                        @endif
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
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')

    <script>




        $(window).load(function(){
            $("#tiktok2").trigger('click');
        })
        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_form_basis_edit').addClass('act_item');
        altair_forms.parsley_validation_config();
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection
