@extends('layouts.main')

@section('title', 'Pms Payroll Company Edit')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New Pms Payroll Company</span></h2>
                                <div class="uk-width-medium-1-3">
                                    <div class="md-btn-group">
                                        <a href="{{ route('pms_payroll_company_index') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">All</a>
                                        <a href="{{ route('pms_payroll_company_create') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Add</a>
                                        <a href="{{ URL::previous() }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md-card">
                            {!! Form::open(['url' => route('pms_payroll_company_update',$company->id), 'method' => 'POST','files' => true,'enctype' => 'multipart/form-data']) !!}
                            <div class="user_content">
                                <div class="uk-margin-top">

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="nationality">Name in English <span style="color: red;">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="nationality">Enter Name in English</label>
                                            <input class="md-input" type="text" id="name_en" name="name_en" value="{{$company->name_en}}"/>
                                            @if($errors->has('name_en'))
                                                <div class="uk-text-danger">{{ $errors->first('name_en') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="nationality">Name in Arabic </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="nationality">Enter Name in Arabic</label>
                                            <input class="md-input" type="text" id="name_ar" name="name_ar" value="{{$company->name_ar}}"/>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="nationality">Bank Name </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="nationality">Enter Bank Name</label>
                                            <input class="md-input" type="text" id="bank_name" name="bank_name" value="{{$company->bank_name}}"/>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="nationality">Account Name </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="nationality">Enter Account Name</label>
                                            <input class="md-input" type="text" id="account_name" name="account_name" value="{{$company->account_name}}"/>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="nationality">Account Number </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="nationality">Enter Account Number</label>
                                            <input class="md-input" type="text" id="account_number" name="account_number" value="{{$company->account_number}}"/>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="nationality">IBAN </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="nationality">Enter IBAN Number</label>
                                            <input class="md-input" type="text" id="iban" name="iban" value="{{$company->iban}}"/>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="nationality">Concerned Person Name </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="nationality">Enter Person Name</label>
                                            <input class="md-input" type="text" id="person_name" name="person_name" value="{{$company->person_name}}"/>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="nationality">Concerned Person Contact </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="nationality">Enter Person Number</label>
                                            <input class="md-input" type="text" id="person_contact" name="person_contact" value="{{$company->person_contact}}"/>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="nationality">Address in English </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="nationality">Enter Address in English</label>
                                            <textarea class="md-input" type="text" id="address_en" name="address_en"/>{{ $company->address_en }}</textarea>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="nationality">Address in Arabic </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="nationality">Enter Address in Arabic</label>
                                            <textarea class="md-input" type="text" id="address_ar" name="address_ar"/>{{ $company->address_ar }}</textarea>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="nationality">Email </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="nationality">Enter Email Address</label>
                                            <input class="md-input" type="text" id="email" name="email" value="{{$company->email}}"/>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="nationality">Logo </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <input class="md-input" type="file" id="logo_url" name="logo_url"/>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <img src="{{ asset('uploads/company-logo/'.$company->logo_url) }}" style="width: 100px; height: auto;">
                                        </div>
                                    </div>

                                    <div class="uk-grid uk-ma" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-left">
                                            <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                            <a href="{{ URL::previous() }}" class="md-btn md-btn-flat uk-modal-close">Close</a>
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

       $('#sidebar_pms').addClass('current_section');
        $('#pms_company').addClass('act_item');
        $(window).load(function(){
            $("#pms_tiktok").trigger('click');
            $("#pms_payroll_tiktok").trigger('click');
        })
        
    </script>

@endsection