@extends('layouts.main')

@section('title', 'Contact')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('angular')
    <script src="{{url('app/contact/contact/contact.controller.js')}}"></script>
@endsection

@section('top_bar')
<div id="top_bar">
    <div class="md-top-bar">
        <ul id="menu_top" class="uk-clearfix">
            <li data-uk-dropdown class="uk-hidden-small">
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Contact</span></a>
                <div class="uk-dropdown">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li><a href="{{ route('contact_create') }}">Create Contact</a></li>
                        <li><a href="{{ route('contact') }}">All Contact </a></li>
                    </ul>
                </div>
            </li>

            <li data-uk-dropdown class="uk-hidden-small">
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Category</span></a>
                <div class="uk-dropdown uk-dropdown-scrollable">
                    <ul class="uk-nav uk-nav-dropdown">
                        {{--<li><a href="{{ route('category_create') }}">Create Category</a></li>--}}
                        <li><a href="{{ route('category') }}">All Category</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection
@section('content')
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile"
         xmlns:color="http://www.w3.org/1999/xhtml">
        <div class="uk-width-large-10-10" ng-controller="ContactController">
                {!! Form::open(['url' => 'contact/store', 'method' => 'post', 'class' => 'uk-form-stacked', 'id' => 'user_edit_form', 'files' => 'true']) !!}
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Create Contact</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <h3 class="full_width_in_card heading_c">
                                        General info
                                    </h3>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label for="contact_category_id" class="uk-vertical-align-middle">Category<span style="color: red;" class="asterisc">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <select id="contact_category_id"
                                                    class="contact_category_id"
                                                    name="contact_category_id"
                                                    ng-model="contact_category_id"
                                                    ng-change="getContactType()" required>

                                            </select>
                                        </div>
                                    </div>

                                    {{--<div ng-if="contact_category_id == 1 || contact_category_id == 2" class="uk-grid" data-uk-grid-margin>--}}
                                        {{--<div class="uk-width-medium-1-5 uk-vertical-align">--}}
                                            {{--<label for="agent_id" class="uk-vertical-align-middle">Agent</label>--}}
                                        {{--</div>--}}
                                        {{--<div class="uk-width-medium-2-5">--}}
                                            {{--<select id="agent_id"--}}
                                                    {{--class="agent_id"--}}
                                                    {{--name="agent_id"--}}
                                                    {{--ng-model="agent_id">--}}

                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="first_name">First Name</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="first_name">First Name</label>
                                            <input class="md-input" type="text" id="first_name" name="first_name" value="{{ old('first_name') }}"  />
                                            <p style="color:red;">{{ $errors -> first('first_name') }}</p>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="last_name">Last Name</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="last_name">Last Name</label>
                                            <input class="md-input" type="text" id="last_name" name="last_name" value="{{ old('first_name') }}"  />
                                            <p style="color:red;">{{ $errors -> first('last_name') }}</p>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="display_name">Display Name<span style="color: red;" class="asterisc">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="display_name">Display Name</label>
                                            <input class="md-input" type="text" id="display_name" name="display_name" value="{{ old('first_name') }}" required />
                                            <p style="color:red;">{{ $errors -> first('display_name') }}</p>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="company_name">Company Name</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="company_name">Company Name</label>
                                            <input class="md-input" type="text" id="company_name" name="company_name" />
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="email_address">Email Address</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="email_address">Email Address</label>
                                            <input class="md-input" type="text" id="email_address" name="email_address" />
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="skype_name">Skype Name/Number</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="skype_name">Skype Name/Number</label>
                                            <input class="md-input" type="text" id="skype_name" name="skype_name" />
                                        </div>
                                    </div>
                                    <div class="uk-grid">
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="contact_number_1">Contact Number</label>
                                        </div>
                                        <div class="uk-width-medium-1-5">
                                            <label for="phone_number_1">Contact Number 1</label>
                                            <input class="md-input" type="text" id="phone_number_1" name="phone_number_1"/>
                                            <p style="color:red;">{{ $errors -> first('phone_number_1') }}</p>
                                        </div>
                                        <div class="uk-width-medium-1-5">
                                            <label for="phone_number_2">Contact Number 2</label>
                                            <input class="md-input" type="text" id="phone_number_2" name="phone_number_2" />
                                        </div>
                                        <div class="uk-width-medium-1-5">
                                            <label for="phone_number_3">Contact Number 3</label>
                                            <input class="md-input" type="text" id="phone_number_3" name="phone_number_3" />
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="display_name">Select Profile Picture</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <input class="md-input" type="file" id="profile_picture" name="profile_picture" />
                                        </div>
                                    </div>
                                    <div class="uk-grid">
                                        <div class="uk-width-1-2">
                                            <h3 class="full_width_in_card heading_c">
                                                BILLING ADDRESS
                                            </h3>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="billing_street">Street</label>
                                                </div>
                                                <div class="uk-width-medium-3-4">
                                                    <label for="billing_street">Street</label>
                                                    <input class="md-input" type="text" id="billing_street" name="billing_street" />
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="billing_city">City</label>
                                                </div>
                                                <div class="uk-width-medium-3-4">
                                                    <label for="billing_city">City</label>
                                                    <input class="md-input" type="text" id="billing_city" name="billing_city" />
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="billing_state">State</label>
                                                </div>
                                                <div class="uk-width-medium-3-4">
                                                    <label for="billing_state">State</label>
                                                    <input class="md-input" type="text" id="billing_state" name="billing_state" />
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="billing_zip_code">Zip Code</label>
                                                </div>
                                                <div class="uk-width-medium-3-4">
                                                    <label for="billing_zip_code">Zip Code</label>
                                                    <input class="md-input" type="text" id="billing_zip_code" name="billing_zip_code" />
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="billing_country">Country</label>
                                                </div>
                                                <div class="uk-width-medium-3-4">
                                                    <label for="billing_country">Country</label>
                                                    <input class="md-input" type="text" id="billing_country" name="billing_country" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-1-2">
                                            <h3 class="full_width_in_card heading_c">
                                                SHIPPING ADDRESS
                                            </h3>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="shipping_street">Street</label>
                                                </div>
                                                <div class="uk-width-medium-3-4">
                                                    <label for="shipping_street">Street</label>
                                                    <input class="md-input" type="text" id="shipping_street" name="shipping_street" />
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="shipping_city">City</label>
                                                </div>
                                                <div class="uk-width-medium-3-4">
                                                    <label for="shipping_city">City</label>
                                                    <input class="md-input" type="text" id="shipping_city" name="shipping_city" />
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="shipping_state">State</label>
                                                </div>
                                                <div class="uk-width-medium-3-4">
                                                    <label for="shipping_state">State</label>
                                                    <input class="md-input" type="text" id="shipping_state" name="shipping_state" />
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="shipping_zip_code">Zip Code</label>
                                                </div>
                                                <div class="uk-width-medium-3-4">
                                                    <label for="shipping_zip_code">Zip Code</label>
                                                    <input class="md-input" type="text" id="shipping_zip_code" name="shipping_zip_code" />
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="shipping_country">Country</label>
                                                </div>
                                                <div class="uk-width-medium-3-4">
                                                    <label for="shipping_country">Country</label>
                                                    <input class="md-input" type="text" id="shipping_country" name="shipping_country" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h3 class="full_width_in_card heading_c">
                                        Other Details
                                    </h3>
                                    <div class="uk-grid">
                                        <div class="uk-width-1-1">
                                            <div class="uk-grid uk-grid-width-1-1 uk-grid-width-large-1-2" data-uk-grid-margin>
                                                <div>
                                                    <div class="uk-input-group">
                                                        <span class="uk-input-group-addon">
                                                            <i class="md-list-addon-icon uk-icon-facebook-official"></i>
                                                        </span>
                                                        <input type="text" class="md-input" id="fb_id" name="fb_id" placeholder="facebook.com/user" />
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="uk-input-group">
                                                        <span class="uk-input-group-addon">
                                                            <i class="md-list-addon-icon uk-icon-twitter"></i>
                                                        </span>
                                                        <input type="text" class="md-input" id="tw_id" name="tw_id" placeholder="twitter.com/user" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="full_width_in_card heading_c">
                                        Remarks
                                    </h3>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-1-1">
                                            <label for="about">About</label>
                                            <textarea class="md-input" name="about" id="about" cols="30" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-right">
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
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_contact').addClass('act_item');
    </script>
@endsection