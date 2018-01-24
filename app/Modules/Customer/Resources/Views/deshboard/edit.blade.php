@extends('layouts.admin')

@section('title', 'Customer')

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
                @include('inc.customer_nav')




                <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
                    <div class="uk-width-large-10-10">
                        {!! Form::open(['url' => array('customer/information/update', 0), 'method' => 'post', 'class' => 'uk-form-stacked']) !!}
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-large-10-10">
                                <div class="md-card">
                                    <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">


                                        <div class="user_heading_content">
                                            <h2 class="heading_b"><span class="uk-text-truncate">Edit Customer</span></h2>
                                        </div>
                                    </div>
                                    <div class="user_content">
                                        <div class="uk-margin-top">
                                            <h3 class="full_width_in_card heading_c">
                                                General info
                                            </h3>

                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="first_name">First Name</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <label for="first_name">First Name</label>
                                                    <input class="md-input" type="text" id="first_name" name="first_name" value="" required />
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="last_name">Last Name</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <label for="last_name">Last Name</label>
                                                    <input class="md-input" type="text" id="last_name" name="last_name"  value="" required />
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="display_name">Display Name</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <label for="display_name">Display Name</label>
                                                    <input class="md-input" type="text" id="display_name" name="display_name" value="" />
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="company_name">Company Name</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <label for="company_name">Company Name</label>
                                                    <input class="md-input" type="text" id="company_name" name="company_name" value="" />
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="email_address">Email Address</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <label for="email_address">Email Address</label>
                                                    <input class="md-input" type="text" id="email_address" name="email_address" value="" />
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="skype_name">Skype Name/Number</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <label for="skype_name">Skype Name/Number</label>
                                                    <input class="md-input" type="text" id="skype_name" name="skype_name" value="" />
                                                </div>
                                            </div>
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="contact_number_1">Contact Number</label>
                                                </div>
                                                <div class="uk-width-medium-1-5">
                                                    <label for="phone_number_1">Contact Number 1</label>
                                                    <input class="md-input" type="text" id="phone_number_1" name="phone_number_1" value="" />
                                                </div>
                                                <div class="uk-width-medium-1-5">
                                                    <label for="phone_number_2">Contact Number 2</label>
                                                    <input class="md-input" type="text" id="phone_number_2" name="phone_number_2" value="" />
                                                </div>
                                                <div class="uk-width-medium-1-5">
                                                    <label for="phone_number_3">Contact Number 3</label>
                                                    <input class="md-input" type="text" id="phone_number_3" name="phone_number_3" value="" />
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
                                                            <input class="md-input" type="text" id="billing_street" name="billing_street" value="" />
                                                        </div>
                                                    </div>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-4 uk-vertical-align">
                                                            <label class="uk-vertical-align-middle" for="billing_city">City</label>
                                                        </div>
                                                        <div class="uk-width-medium-3-4">
                                                            <label for="billing_city">City</label>
                                                            <input class="md-input" type="text" id="billing_city" name="billing_city" value="" />
                                                        </div>
                                                    </div>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-4 uk-vertical-align">
                                                            <label class="uk-vertical-align-middle" for="billing_state">State</label>
                                                        </div>
                                                        <div class="uk-width-medium-3-4">
                                                            <label for="billing_state">State</label>
                                                            <input class="md-input" type="text" id="billing_state" name="billing_state" value="" />
                                                        </div>
                                                    </div>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-4 uk-vertical-align">
                                                            <label class="uk-vertical-align-middle" for="billing_zip_code">Zip Code</label>
                                                        </div>
                                                        <div class="uk-width-medium-3-4">
                                                            <label for="billing_zip_code">Zip Code</label>
                                                            <input class="md-input" type="text" id="billing_zip_code" name="billing_zip_code" value="" />
                                                        </div>
                                                    </div>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-4 uk-vertical-align">
                                                            <label class="uk-vertical-align-middle" for="billing_country">Country</label>
                                                        </div>
                                                        <div class="uk-width-medium-3-4">
                                                            <label for="billing_country">Country</label>
                                                            <input class="md-input" type="text" id="billing_country" name="billing_country" value="" />
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
                                                            <input class="md-input" type="text" id="shipping_street" name="shipping_street" value="" />
                                                        </div>
                                                    </div>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-4 uk-vertical-align">
                                                            <label class="uk-vertical-align-middle" for="shipping_city">City</label>
                                                        </div>
                                                        <div class="uk-width-medium-3-4">
                                                            <label for="shipping_city">City</label>
                                                            <input class="md-input" type="text" id="shipping_city" name="shipping_city" value="" />
                                                        </div>
                                                    </div>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-4 uk-vertical-align">
                                                            <label class="uk-vertical-align-middle" for="shipping_state">State</label>
                                                        </div>
                                                        <div class="uk-width-medium-3-4">
                                                            <label for="shipping_state">State</label>
                                                            <input class="md-input" type="text" id="shipping_state" name="shipping_state" value="" />
                                                        </div>
                                                    </div>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-4 uk-vertical-align">
                                                            <label class="uk-vertical-align-middle" for="shipping_zip_code">Zip Code</label>
                                                        </div>
                                                        <div class="uk-width-medium-3-4">
                                                            <label for="shipping_zip_code">Zip Code</label>
                                                            <input class="md-input" type="text" id="shipping_zip_code" name="shipping_zip_code" value="" />
                                                        </div>
                                                    </div>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-4 uk-vertical-align">
                                                            <label class="uk-vertical-align-middle" for="shipping_country">Country</label>
                                                        </div>
                                                        <div class="uk-width-medium-3-4">
                                                            <label for="shipping_country">Country</label>
                                                            <input class="md-input" type="text" id="shipping_country" name="shipping_country" value="" />
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
                                                                <input type="text" class="md-input" id="fb_id" name="fb_id" value="" />
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="uk-input-group">
                                                        <span class="uk-input-group-addon">
                                                            <i class="md-list-addon-icon uk-icon-twitter"></i>
                                                        </span>
                                                                <input type="text" class="md-input" id="tw_id" name="tw_id" value="" />
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
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <!-- handlebars.js -->
    <script src="{{ url('admin/bower_components/handlebars/handlebars.min.js')}}"></script>
    <script src="{{ url('admin/assets/js/custom/handlebars_helpers.min.js')}}"></script>

    <!--  invoices functions -->


@endsection

