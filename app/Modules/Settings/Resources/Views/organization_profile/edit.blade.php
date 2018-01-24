@extends('layouts.main')

@section('title', 'Access Level')

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
                <div class="uk-width-xLarge-2-10 uk-width-large-2-10">
                    <div class="md-list-outside-wrapper">
                        @include('inc.settings_menu')
                    </div>
                </div>
                <div class="uk-width-xLarge-8-10  uk-width-large-8-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Update Organization Profile</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                {!! Form::open(['url' => route('organization_profile_update'), 'method' => 'POST', 'files' => true]) !!}
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="image" class="uk-vertical-align-middle">Logo</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <div class="uk-width-1-1 uk-margin-bottom">
                                            <div class="uk-thumbnail-mini">
                                                <img src="{{ url('uploads/op-logo/'.$op->logo) }}" alt="">
                                            </div>
                                        </div>
                                        <input type="file" id="logo" name="logo"/>
                                        @if($errors->first('logo'))
                                            <div class="uk-text-danger">Logo is required.</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="display_name" class="uk-vertical-align-middle">Display Name</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="display_name">Display Name</label>
                                        <input class="md-input" type="text" id="display_name" name="display_name" value="{{ $op->display_name }}"/>
                                        @if($errors->first('display_name'))
                                            <div class="uk-text-danger">Display name is required.</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="company_name" class="uk-vertical-align-middle">Company Name</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="company_name">Company Name</label>
                                        <input class="md-input" type="text" id="company_name" name="company_name" value="{{ $op->company_name }}"/>
                                        @if($errors->first('company_name'))
                                            <div class="uk-text-danger">Company name is required.</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="street" class="uk-vertical-align-middle">Street</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="street">Street</label>
                                        <input class="md-input" type="text" id="street" name="street" value="{{ $op->street }}"/>
                                        @if($errors->first('street'))
                                            <div class="uk-text-danger">Street is required.</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="city" class="uk-vertical-align-middle">City</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="city">City</label>
                                        <input class="md-input" type="text" id="city" name="city" value="{{ $op->city }}"/>
                                        @if($errors->first('city'))
                                            <div class="uk-text-danger">City is required.</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="state" class="uk-vertical-align-middle">State</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="state">State</label>
                                        <input class="md-input" type="text" id="state" name="state" value="{{ $op->state }}"/>
                                        @if($errors->first('state'))
                                            <div class="uk-text-danger">State is required.</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="country" class="uk-vertical-align-middle">Country</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="country">Country</label>
                                        <input class="md-input" type="text" id="country" name="country" value="{{ $op->country }}"/>
                                        @if($errors->first('country'))
                                            <div class="uk-text-danger">Country is required.</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="zip_code" class="uk-vertical-align-middle">Zip Code</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="zip_code">Zip Code</label>
                                        <input class="md-input" type="text" id="zip_code" name="zip_code" value="{{ $op->zip_code }}"/>
                                        @if($errors->first('zip_code'))
                                            <div class="uk-text-danger">Zip code is required.</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="website" class="uk-vertical-align-middle">Website</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="website">Website</label>
                                        <input class="md-input" type="text" id="website" name="website" value="{{ $op->website }}"/>
                                        @if($errors->first('website'))
                                            <div class="uk-text-danger">Website is required.</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="contact_number" class="uk-vertical-align-middle">Contact Number</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="contact_number">Contact Number</label>
                                        <input class="md-input" type="text" id="contact_number" name="contact_number" value="{{ $op->contact_number }}"/>
                                        @if($errors->first('contact_number'))
                                            <div class="uk-text-danger">Contact Number is required.</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="email" class="uk-vertical-align-middle">Email</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="email">Email</label>
                                        <input class="md-input" type="text" id="email" name="email" value="{{ $op->email }}"/>
                                        @if($errors->first('email'))
                                            <div class="uk-text-danger">Email is required.</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="etin" class="uk-vertical-align-middle">ETIN</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="etin">Etin</label>
                                        <input class="md-input" type="text" id="etin" name="etin" value="{{ $op->etin }}"/>
                                        @if($errors->first('etin'))
                                            <div class="uk-text-danger">Etin is required.</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="email" class="uk-vertical-align-middle">Vat Number</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="vat_number">Vat Number</label>
                                        <input class="md-input" type="text" id="vat_number" name="vat_number" value="{{ $op->vat_number }}"/>
                                        @if($errors->first('vat_number'))
                                            <div class="uk-text-danger">Vat Number is required.</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid">
                                    <div class="uk-width-1-1 uk-float-right">
                                        <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                        <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
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
    <script type="text/javascript">
        $('#settings_menu_profile').addClass('md-list-item-active');
    </script>
@endsection