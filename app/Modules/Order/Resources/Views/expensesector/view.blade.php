@extends('layouts.main')

@section('title', 'Contact')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('top_bar')
<div id="top_bar">
    <div class="md-top-bar">
        <ul id="menu_top" class="uk-clearfix">


            <li data-uk-dropdown class="uk-hidden-small">
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Sector</span></a>
                <div class="uk-dropdown">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li><a href="{{ route('order_expense_sector_create') }}">Create Sector</a></li>
                        <li><a href="{{ route('order_expense_sector') }}">All Sector </a></li>
                    </ul>
                </div>
            </li>
            @inject('Categories', 'App\Lib\Category')
            <li data-uk-dropdown class="uk-hidden-small">
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Search By Sector</span></a>
                <div class="uk-dropdown uk-dropdown-scrollable">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li><a href="{{ route('order_expense_sector') }}">All Sector</a></li>
                        @foreach($Categories->ExpenseSector() as $documentCategory)
                            <li><a href="{{ route('order_expense_sector_search', ['id' => $documentCategory->id]) }}">{{ $documentCategory->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection
@section('content')
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
                                 <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        
                                         @if($contact->profile_pic_url)
                                            <img alt="user avatar" src="{{url($contact->profile_pic_url)}}">
                                        @else
                                            <img alt="user avatar" src="{{url('admin/assets/img/avatars/user.png')}}">
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">{{ $contact->first_name }} {{ $contact->last_name }}</span></h2>
                                    <h2 class="heading_b"><span class="uk-text-truncate">{{ $contact->display_name }}</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <h3 class="full_width_in_card heading_c">
                                        General info
                                    </h3>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label for="category_id" class="uk-vertical-align-middle">Branch</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            {{ $contact->branch->branch_name }}
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label for="category_id" class="uk-vertical-align-middle">Category</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            {{ $contact->contactCategory->contact_category_name }}
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="company_name">Company Name</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label class="uk-vertical-align-middle" for="company_name">{{ $contact->company_name }}</label>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="email_address">Email Address</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                           <label class="uk-vertical-align-middle" for="email_address">{{ $contact->email_address }}</label>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="skype_name">Skype Name/Number</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label class="uk-vertical-align-middle" for="skype_name">{{ $contact->skype_name }}</label>
                                        </div>
                                    </div>
                                    <div class="uk-grid">
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="contact_number_1">Contact Number</label>
                                        </div>
                                        <div class="uk-width-medium-1-5">
                                            <label for="phone_number_1"{{ $contact->phone_number_1 }}</label>
                                           
                                        </div>
                                        <div class="uk-width-medium-1-5">
                                            <label for="phone_number_2">{{ $contact->phone_number_2 }}</label>
                                        </div>
                                        <div class="uk-width-medium-1-5">
                                            <label for="phone_number_3">{{ $contact->phone_number_3 }}</label>
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
                                                    <label for="billing_street">{{ $contact->billing_street }}</label>
                                                   
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="billing_city">City</label>
                                                </div>
                                                <div class="uk-width-medium-3-4">
                                                    <label for="billing_city">{{ $contact->billing_city }}</label>
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="billing_state">State</label>
                                                </div>
                                                <div class="uk-width-medium-3-4">
                                                    <label for="billing_state">{{ $contact->billing_state }}</label>
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="billing_zip_code">Zip Code</label>
                                                </div>
                                                <div class="uk-width-medium-3-4">
                                                    <label for="billing_zip_code">{{ $contact->billing_zip_code }}</label>
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="billing_country">Country</label>
                                                </div>
                                                <div class="uk-width-medium-3-4">
                                                    <label for="billing_country">{{ $contact->billing_country }}</label>
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
                                                    <label for="shipping_street">{{ $contact->shipping_street }}</label>
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="shipping_city">City</label>
                                                </div>
                                                <div class="uk-width-medium-3-4">
                                                    <label for="shipping_city">{{ $contact->shipping_city }}</label>
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="shipping_state">State</label>
                                                </div>
                                                <div class="uk-width-medium-3-4">
                                                    <label for="shipping_state">{{ $contact->shipping_state }}</label>
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="shipping_zip_code">Zip Code</label>
                                                </div>
                                                <div class="uk-width-medium-3-4">
                                                    <label for="shipping_zip_code">{{ $contact->shipping_zip_code }}</label>
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="shipping_country">Country</label>
                                                </div>
                                                <div class="uk-width-medium-3-4">
                                                    <label for="shipping_country">{{ $contact->shipping_country }}</label>
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
                                                        <label for="shipping_country">{{ $contact->fb_id }}</label>
                                                        
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="uk-input-group">
                                                        <span class="uk-input-group-addon">
                                                            <i class="md-list-addon-icon uk-icon-twitter"></i>
                                                        </span>
                                                        <label for="shipping_country">{{ $contact->tw_id }}</label>
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
                                            <p>{{ $contact->about }}</p>
                                        </div>
                                    </div>
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
        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_order_expense_sector').addClass('act_item');


        $(window).load(function(){
            $("#tiktok2").trigger('click');
        })
    </script>
@endsection