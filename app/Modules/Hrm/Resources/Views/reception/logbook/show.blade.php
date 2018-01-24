@extends('layouts.main')

@section('title', 'Reception Logbook')

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
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Category</span></a>
                <div class="uk-dropdown uk-dropdown-scrollable">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li><a href="{{route('reception_category_index')}}">All Category</a></li>
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
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Show Reception Logbook</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Category</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label class="uk-vertical-align-middle" for="customer_name">{{ $category->categoryId->name }}</label>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Associated Contact</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label class="uk-vertical-align-middle" for="customer_name">{{ $category->name }}</label>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Organization Name</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label class="uk-vertical-align-middle" for="customer_name">{{ $category->organization_name }}</label>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Phone Number</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label class="uk-vertical-align-middle" for="customer_name">{{ $category->contact_number }}</label>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Email</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label class="uk-vertical-align-middle" for="customer_name">{{ $category->email }}</label>
                                    </div>
                                </div>

                                <h3 class="full_width_in_card heading_c">
                                    <span class="">
                                        <label for="sales_information" class="inline-label">
                                            Location
                                        </label>
                                    </span>
                                </h3>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Street</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label class="uk-vertical-align-middle" for="customer_name">{{ $category->location_street }}</label>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">City</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label class="uk-vertical-align-middle" for="customer_name">{{ $category->location_city }}</label>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">State</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label class="uk-vertical-align-middle" for="customer_name">{{ $category->location_state }}</label>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Zip Code</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label class="uk-vertical-align-middle" for="customer_name">{{ $category->location_zip_code }}</label>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Country</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label class="uk-vertical-align-middle" for="customer_name">{{ $category->location_country }}</label>
                                    </div>
                                </div>

                                <h3 class="full_width_in_card heading_c">
                                    <span class="">
                                        <label for="sales_information" class="inline-label">
                                            Informations
                                        </label>
                                    </span>
                                </h3>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Department</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label class="uk-vertical-align-middle" for="customer_name">{{ $category->department }}</label>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Item Name</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label class="uk-vertical-align-middle" for="customer_name">{{ isset ($category->itemId)?$category->itemId->item_name:'' }}</label>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Symptom</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label class="uk-vertical-align-middle" for="customer_name">{{ $category->symptom }}</label>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Remark</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label class="uk-vertical-align-middle" for="customer_name">{{ $category->remark }}</label>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Meeting Date</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <div class="uk-input-group">
                                            <label class="uk-vertical-align-middle" for="customer_name">{{ date('d-m-Y', strtotime($category->meeting_date)) }}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Meeting Date</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <div class="uk-input-group">
                                            <label class="uk-vertical-align-middle" for="customer_name">{{ $category->meeting_time }}</label>
                                        </div>
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                </div>
           
        </div>
    </div>
    <!-- google web fonts -->
@endsection
@section('scripts')
    <script type="text/javascript">
        $('#sidebar_hrm').addClass('current_section');
        $('#sidebar_hrm_view').addClass('act_item');

        $(window).load(function(){
            $("#tiktok6").trigger('click');
        })
    </script>

@endsection