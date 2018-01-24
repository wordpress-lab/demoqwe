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
@if(Session::has('message'))
    <div class="uk-alert uk-alert-success" data-uk-alert="">
        <a href="#" class="uk-alert-close uk-close"></a>
        {{ Session::get('message') }}
    </div>
@endif
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            {!! Form::open(['url' => route('reception_logbook_store'), 'method' => 'post', 'class' => 'uk-form-stacked', 'id' => 'user_edit_form' , 'onsubmit' => 'return valid();']) !!}
                
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Create Reception Logbook</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Category<span style="color: red;">*</span></label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <select id="category_id" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select with tooltip" name="category_id">
                                            <option value="">Select Category</option>
                                            @foreach($category as $all)
                                            <option value="{{ $all->id }}">{{ $all->name }}</option>
                                            @endforeach
                                        </select>
                                        <span style="color:red; position: relative;" id="msg">
                                        {{ $errors->has('category_id')?$errors->first('category_id'):'' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Associated Contact</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <select id="contact" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select with tooltip" name="associated_contact" onchange="info()">
                                            <option value="">Select Contact</option>
                                            <option value="0">No Associated Contact</option>
                                            @foreach($contact as $all)
                                            <option value="{{ $all->id }}">{{ $all->display_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Name</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <input type="text" name="name" class="md-input uk-form-width-large" id="name"/>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Organization Name</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <input type="text" name="organization_name" class="md-input uk-form-width-large" id="organization_name"/>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Phone Number</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <input type="text" name="contact_number" class="md-input uk-form-width-large" id="contact_number"/>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Email</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <input type="text" name="email" class="md-input uk-form-width-large" id="email"/>
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
                                        <input type="text" name="location_street" class="md-input uk-form-width-large" id="location_street"/>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">City</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <input type="text" name="location_city" class="md-input uk-form-width-large" id="location_city"/>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">State</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <input type="text" name="location_state" class="md-input uk-form-width-large" id="location_state"/>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Zip Code</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <input type="text" name="location_zip_code" class="md-input uk-form-width-large" id="location_zip_code"/>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Country</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <input type="text" name="location_country" class="md-input uk-form-width-large" id="location_country"/>
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
                                        <input type="text" name="department" class="md-input uk-form-width-large" id="department"/>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Item Name</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <select id="select_demo_5" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select with tooltip" name="item_name">
                                            <option value="">Select Item</option>
                                            @foreach($item as $all)
                                            <option value="{{ $all->id }}">{{ $all->item_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Symptom</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <input type="text" name="symptom" class="md-input uk-form-width-large" id="symptom"/>
                                        <span style="color:red; position: relative;" id="msg">
                                        {{ $errors->has('symptom')?$errors->first('symptom'):'' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Remark</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <input type="text" name="remark" class="md-input uk-form-width-large" id="remark"/>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Meeting Date</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <div class="uk-input-group">
                                            <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                            <label for="uk_dp_1">Select date</label>
                                            <input class="md-input" type="text" name="meeting_date" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                            <span style="color:red; position: relative;" id="msg">
                                            {{ $errors->has('meeting_date')?$errors->first('meeting_date'):'' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Meeting Date</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <div class="uk-input-group">
                                            <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-clock-o"></i></span>
                                            <label for="uk_tp_1">Select time</label>
                                            <input class="md-input" type="text" name="meeting_time" data-uk-timepicker>
                                            <span style="color:red; position: relative;" id="msg">
                                            {{ $errors->has('meeting_time')?$errors->first('meeting_time'):'' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="uk-grid">
                                    <div class="uk-width-1-1">
                                        <button type="submit" href="#" class="md-btn md-btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
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

    <script type="text/javascript">
        function info(){
            var contact_id = document.getElementById('contact').value;

            if(contact_id == 0){

                $('#name').val('');
                $('#name').prop('disabled', false);
                $('#organization_name').val('');
                $('#organization_name').prop('disabled', false);
                $('#contact_number').val('');
                $('#contact_number').prop('disabled', false);
                $('#email').val('');
                $('#email').prop('disabled', false);
                $('#location_street').val('');
                $('#location_street').prop('disabled', false);
                $('#location_city').val('');
                $('#location_city').prop('disabled', false);
                $('#location_state').val('');
                $('#location_state').prop('disabled', false);
                $('#location_zip_code').val('');
                $('#location_zip_code').prop('disabled', false);
                $('#location_country').val('');
                $('#location_country').prop('disabled', false);

            }
            else{
                
                $.get('/hrm/reception/info/' + contact_id, function(data){

                $('#name').val(data.display_name);
                $('#name').prop('disabled', true);
                $('#organization_name').val(data.company_name);
                $('#organization_name').prop('disabled', true);
                $('#contact_number').val(data.phone_number_1);
                $('#contact_number').prop('disabled', true);
                $('#email').val(data.email_address);
                $('#email').prop('disabled', true);
                $('#location_street').val(data.shipping_street);
                $('#location_street').prop('disabled', true);
                $('#location_city').val(data.shipping_city);
                $('#location_city').prop('disabled', true);
                $('#location_state').val(data.shipping_state);
                $('#location_state').prop('disabled', true);
                $('#location_zip_code').val(data.shipping_zip_code);
                $('#location_zip_code').prop('disabled', true);
                $('#location_country').val(data.shipping_country);
                $('#location_country').prop('disabled', true);
                
                });
            }
        
        }

        function valid(){
            var input = document.getElementById('category_id').value;
            
            if(input == ""){
                document.getElementById('msg').innerHTML = "This Category field is required.";
                return false;
            }
        }
    </script>
@endsection