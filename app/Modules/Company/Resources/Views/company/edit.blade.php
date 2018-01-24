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
            {!! Form::open(['url' => route('company_update',$company->id), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit  Company</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_number">Company Name<span style="color: red">*</span> </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_number"></label>
                                        <input class="md-input" type="text" id="name" value="{!! $company->name !!}" name="name"/>
                                        @if($errors->has('name'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('name')!!}</span>

                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="nameAr">Company Name (Arabic) </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="nameAr"></label>
                                        <input class="md-input" type="text" value="{{ $company->nameAr }}" id="nameAr" name="nameAr"/>
                                        @if($errors->has('nameAr'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('nameAr')!!}</span>

                                        @endif
                                    </div>
                                </div>


                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_number">ID Number <span style="color: red">*</span> </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_number"></label>
                                        <input class="md-input" type="text" id="name" value="{!! $company->company_code !!}" name="company_code"/>
                                        @if($errors->has('company_code'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('company_code')!!}</span>

                                        @endif
                                    </div>
                                </div>
                                {{--<div class="uk-grid" data-uk-grid-margin>--}}
                                    {{--<div class="uk-width-medium-1-5 uk-vertical-align">--}}
                                        {{--<label class="uk-vertical-align-middle" for="invoice_number">Sponsor Id </label>--}}
                                    {{--</div>--}}
                                    {{--<div class="uk-width-medium-2-5">--}}
                                        {{--<label for="invoice_number">Sponsor Id</label>--}}
                                        {{--<input class="md-input" type="text" value="{!! $company->cofil_id !!}" id="name" name="cofil_id"/>--}}
                                        {{--@if($errors->has('cofil_id'))--}}

                                            {{--<span style="color:red; position: relative; right:-500px">{!!$errors->first('cofil_id')!!}</span>--}}

                                        {{--@endif--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="contactNumber">Contact Number</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="contactNumber"></label>
                                        <input class="md-input" type="text" value="{{ $company->contactNumber }}" id="contactNumber" name="contactNumber"/>
                                        @if($errors->has('contactNumber'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('contactNumber')!!}</span>

                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="companyAddress">Company Address</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">

                                        <textarea class="md-input" type="text" id="companyAddress" name="companyAddress">{{ $company->companyAddress }}</textarea>
                                        @if($errors->has('companyAddress'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('companyAddress')!!}</span>

                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_number">Salary </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="salary"></label>
                                        <input class="md-input" type="text" id="salary" name="salary" value="{!! $company->salary !!}"/>
                                        @if($errors->has('salary'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('salary')!!}</span>

                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_number">Meal Allowance </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="mealallowance"></label>
                                        <input class="md-input" type="text" id="mealallowance" name="mealallowance" value="{!! $company->mealallowance !!}"/>
                                        @if($errors->has('mealallowance'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('mealallowance')!!}</span>

                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_number">Air Transport  </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="airtransport"></label>
                                        <input class="md-input" type="text" id="airtransport" name="airtransport" value="{!! $company->airtransport !!}"/>
                                        @if($errors->has('airtransport'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('airtransport')!!}</span>

                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="Accommodation">Accommodation </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="Accommodation"></label>
                                        <input class="md-input" type="text" id="Accommodation" name="referencename" value="{!! $company->referencename !!}"/>
                                        @if($errors->has('referencename'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('referencename')!!}</span>

                                        @endif
                                    </div>
                                </div>
                                <hr class="uk-grid-divider">
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-large-1-3">
                                        <span class="uk-text-muted uk-text-small">Created By</span>
                                    </div>
                                    <div class="uk-width-large-2-3">
                                        <span class="uk-text-large uk-text-middle">{!! isset($company->createdBy['name']) ? $company->createdBy['name']:''  !!}</span>
                                    </div>
                                </div>
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-large-1-3">
                                        <span class="uk-text-muted uk-text-small">Updated By</span>
                                    </div>
                                    <div class="uk-width-large-2-3">
                                        <span class="uk-text-large uk-text-middle">{!! isset($company->updatedBy['name']) ? $company->updatedBy['name']:''  !!}</span>
                                    </div>
                                </div>


                                <hr class="uk-grid-divider">
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-large-1-3">
                                        <span class="uk-text-muted uk-text-small">Created At</span>
                                    </div>
                                    <div class="uk-width-large-2-3">
                                        <span class="uk-text-large uk-text-middle">{!! isset($company->created_at) ? $company->created_at:''  !!}</span>
                                    </div>
                                </div>
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-large-1-3">
                                        <span class="uk-text-muted uk-text-small">Updated At</span>
                                    </div>
                                    <div class="uk-width-large-2-3">
                                        <span class="uk-text-large uk-text-middle">{!! isset($company->updated_at) ? $company->updated_at:''  !!}</span>
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
                                        <a href="{{ url()->previous() }}" type="button" class="md-btn md-btn-flat uk-modal-close">Close</a>
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
        $('#sidebar_company_index').addClass('act_item');

        altair_forms.parsley_validation_config();
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection
