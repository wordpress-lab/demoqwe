@extends('layouts.main')

@section('title', 'Account Information Form')

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
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Inventory</span></a>
                <div class="uk-dropdown">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li><a href="{{route('inventory_create')}}">Create Inventory</a></li>
                        <li><a href="{{route('inventory')}}">All Inventory</a></li>
                    </ul>
                </div>
            </li>

            <li data-uk-dropdown class="uk-hidden-small">
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Category</span></a>
                <div class="uk-dropdown uk-dropdown-scrollable">
                    <ul class="uk-nav uk-nav-dropdown">
                        {{--<li><a href="{{route('inventory_category_create')}}">Create Category</a></li>--}}
                        <li><a href="{{route('inventory_category')}}">All Category</a></li>
                    </ul>
                </div>
            </li>
            <li data-uk-dropdown class="uk-hidden-small">
                <a href="{{route('stock_create')}}"><i class="material-icons">&#xE02E;</i><span>Add Stock</span></a>
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
            {!! Form::open(['url' => route('aif_store'), 'method' => 'post', 'class' => 'uk-form-stacked', 'id' => 'user_edit_form']) !!}
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Create New Item</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <h3 class="full_width_in_card heading_c">
                                        <span class="">
                                            <label for="sales_information" class="inline-label">
                                                Machines
                                            </label>
                                        </span>
                                    </h3>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Model No 1:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <select id="select_demo_5" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select with tooltip" name="machine_model_no_1">
                                                            <option value="">Select Item</option>
                                                            @foreach($item as $all)
                                                            <option value="{{ $all->id }}">{{ $all->item_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Model No 2:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <select id="select_demo_5" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select with tooltip" name="machine_model_no_2">
                                                            <option value="">Select Item</option>
                                                            @foreach($item as $all)
                                                            <option value="{{ $all->id }}">{{ $all->item_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Part No 1:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="text" class="md-input" name="machine_part_no_1"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Part No 2:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="text" class="md-input" name="machine_part_no_2"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Serial No 1:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="text" class="md-input" name="machine_serial_no_1"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Serial No 2:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="text" class="md-input" name="machine_serial_no_2"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Quantity 1:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="text" class="md-input" name="machine_quantity_1"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Quantity 2:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="text" class="md-input" name="machine_quantity_2"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Warranty 1:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="text" class="md-input" name="machine_warranty_1"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Warranty 2:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="text" class="md-input" name="machine_warranty_2"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Unit Price 1:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="text" class="md-input" name="machine_unit_price_1"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Unit Price 2:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="text" class="md-input" name="machine_unit_price_2"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h3 class="full_width_in_card heading_c">
                                        <span class="">
                                            <label for="sales_information" class="inline-label">
                                                Optional Items
                                            </label>
                                        </span>
                                    </h3>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Model No 1:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <select id="select_demo_5" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select with tooltip" name="optional_model_no_1">
                                                            <option value="">Select Item</option>
                                                            @foreach($item as $all)
                                                            <option value="{{ $all->id }}">{{ $all->item_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Model No 2:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <select id="select_demo_5" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select with tooltip" name="optional_model_no_2">
                                                            <option value="">Select Item</option>
                                                            @foreach($item as $all)
                                                            <option value="{{ $all->id }}">{{ $all->item_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Part No 1:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="text" class="md-input" name="optional_part_no_1"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Part No 2:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="text" class="md-input" name="optional_part_no_2"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Serial No 1:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="text" class="md-input" name="optional_serial_no_1"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Serial No 2:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="text" class="md-input" name="optional_serial_no_2"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Quantity 1:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="text" class="md-input" name="optional_quantity_1"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Quantity 2:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="text" class="md-input" name="optional_quantity_2"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Warranty 1:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="text" class="md-input" name="optional_warranty_1"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Warranty 2:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="text" class="md-input" name="optional_warranty_2"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Unit Price 1:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="text" class="md-input" name="optional_unit_price_1"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Unit Price 2:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="text" class="md-input" name="optional_unit_price_2"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h3 class="full_width_in_card heading_c">
                                        <span class="">
                                            <label for="sales_information" class="inline-label">
                                                Bill Information
                                            </label>
                                        </span>
                                    </h3>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-3">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Bill Date:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <label for="uk_dp_1">Select date</label>
                                                        <input class="md-input" type="text" name="bill_date" id="uk_dp_1" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-3">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Bill Amount (Total):</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="number" class="md-input" name="bill_amount"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-3">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Business Promotion Amount:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="number" class="md-input" name="business_promotion_amount"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-7">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-5">
                                                        <label>Bill Format:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-5">
                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="bill_format" value="0" data-md-icheck/>
                                                     Consolidated</label>
                                                    </p>
                                                    </div>
                                                    <div class="uk-width-medium-1-5">
                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="bill_format" value="1" data-md-icheck/>
                                                     Item Wise</label>
                                                    </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>        
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-7">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-5">
                                                        <label>Customer Type:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-5">
                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="customer_type" value="0" data-md-icheck/>
                                                     Individual</label>
                                                    </p>
                                                    </div>
                                                    <div class="uk-width-medium-1-5">
                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="customer_type" value="1" data-md-icheck/>
                                                     Corporate</label>
                                                    </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>        
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-7">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-5">
                                                        <label>Price Type:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-5">
                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="price_type" value="0" data-md-icheck/>
                                                     Normal</label>
                                                    </p>
                                                    </div>
                                                    <div class="uk-width-medium-1-5">
                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="price_type" value="1" data-md-icheck/>
                                                     Project</label>
                                                    </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>        
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Business Informtion (Consignee):</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <textarea class="md-input" name="billing_information_consignee" id="item_about" cols="30" rows="4"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Bill Information(if Consignee is different):</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <textarea class="md-input" name="billing_information__different_consignee" id="item_about" cols="30" rows="4"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-7">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-5">
                                                        <label>Payment Terms:</label>
                                                    </div>
                                                    
                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="payment_terms" value="1" data-md-icheck/>
                                                     Cash</label>
                                                    </p>
                                                
                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="payment_terms" value="2" data-md-icheck/>
                                                     Cheque</label>
                                                    </p>

                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="payment_terms" value="3" data-md-icheck/>
                                                     TT</label>
                                                    </p>

                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="payment_terms" value="4" data-md-icheck/>
                                                     Bank Draf</label>
                                                    </p>

                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="payment_terms" value="5" data-md-icheck/>
                                                     Credit Card</label>
                                                    </p>

                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="payment_terms" value="6" data-md-icheck/>
                                                     Post Dated Check</label>
                                                    </p>

                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="payment_terms" value="7" data-md-icheck/>
                                                     Others</label>
                                                    </p>

                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="payment_terms" value="8" data-md-icheck/>
                                                     Check Before Delivery</label>
                                                    </p>

                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="payment_terms" value="9" data-md-icheck/>
                                                     PO</label>
                                                    </p>

                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="payment_terms" value="10" data-md-icheck/>
                                                     Cash Cheque</label>
                                                    </p>

                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="payment_terms" value="11" data-md-icheck/>
                                                     Partial Payment & Amount</label>
                                                    </p>

                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="payment_terms" value="12" data-md-icheck/>
                                                     Balance Due Will Clear On</label>
                                                    </p>
                                                    
                                                </div>
                                            </div>
                                        </div>        
                                    </div>

                                    <h3 class="full_width_in_card heading_c">
                                        <span class="">
                                            <label for="sales_information" class="inline-label">
                                                Purchaser
                                            </label>
                                        </span>
                                    </h3>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Name:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="text" class="md-input" name="purchaser_name"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Designation:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="text" class="md-input" name="purchaser_designation"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Tel No:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="number" class="md-input" name="purchaser_telephone_number"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Mobile No:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="number" class="md-input" name="purchaser_mobile_no"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Email No:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="text" class="md-input" name="purchaser_email_no"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Fax No:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="number" class="md-input" name="purchaser_fax_no"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h3 class="full_width_in_card heading_c">
                                        <span class="">
                                            <label for="sales_information" class="inline-label">
                                                Person in Charge of Payment
                                            </label>
                                        </span>
                                    </h3>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Name:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="text" class="md-input" name="charge_of_payment_name"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Designation:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="text" class="md-input" name="charge_of_payment_designation"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Tel No:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="number" class="md-input" name="charge_of_payment_telephone_number"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Mobile No:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="number" class="md-input" name="charge_of_payment_mobile_no"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Email No:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="text" class="md-input" name="charge_of_payment_email_no"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Fax No:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <input type="number" class="md-input" name="charge_of_payment_fax_no"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <br/><br/><br/>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-7">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-3-5">
                                                        <label>1. Have you Visited the customer's permises?</label>
                                                    </div>
                                                    
                                                        <p>
                                                        <label class="inline-label"><input type="radio" name="visit_customer_permises" value="1" data-md-icheck/>
                                                         Yes</label>
                                                        </p>
                                                    
                                                    
                                                        <p>
                                                        <label class="inline-label"><input type="radio" name="visit_customer_permises" value="0" data-md-icheck/>
                                                         No</label>
                                                        </p>

                                                        <p>
                                                        <label class="inline-label"><input type="radio" name="visit_customer_permises" value="2" data-md-icheck/>
                                                         Later</label>
                                                        </p>
                                                    
                                                </div>
                                            </div>
                                        </div>       
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-7">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-3-5">
                                                        <label>2. How Long the customer been occupying the permises?</label>
                                                    </div>
                                                    
                                                    <div class="uk-width-medium-1-5">
                                                        <label for="uk_dp_1">Select date</label>
                                                        <input class="md-input" type="text" name="customer_occupying_permises" id="uk_dp_1" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>       
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-7">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-3-5">
                                                        <label>3. Have you checked with the neighbours to confirm anser giver in question no 2?</label>
                                                    </div>
                                                    
                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="neighbours_to_confirm_answer" value="1" data-md-icheck/>
                                                     Yes</label>
                                                    </p>
                                                
                                                
                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="neighbours_to_confirm_answer" value="0" data-md-icheck/>
                                                     No</label>
                                                    </p>
                                                    
                                                </div>
                                            </div>
                                        </div>       
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-7">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-3-5">
                                                        <label>4. Is the permises rented or owned?</label>
                                                    </div>
                                                    
                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="permises_rent" value="0" data-md-icheck/>
                                                     Owned</label>
                                                    </p>
                                                
                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="permises_rent" value="1" data-md-icheck/>
                                                     Rented</label>
                                                    </p>
                                                    
                                                </div>
                                            </div>
                                        </div>       
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-7">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-3-5">
                                                        <label>5. How is the office setup?</label>
                                                    </div>
    
                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="office_setup" value="0" data-md-icheck/>
                                                     Old</label>
                                                    </p>
                                                
                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="office_setup" value="0" data-md-icheck/>
                                                     New</label>
                                                    </p>
                                                    
                                                </div>
                                            </div>
                                        </div>       
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-7">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-3-5">
                                                        <label>6. No of staff?</label>
                                                    </div>
    
                                                    <div class="uk-width-medium-1-5">
                                                        <label for="uk_dp_1">Select no</label>
                                                        <input class="md-input" type="number" name="no_of_staff">
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>       
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-7">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-3-5">
                                                        <label>7. Building Type?</label>
                                                    </div>
    
                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="building_type" value="0" data-md-icheck/>
                                                     Shoplot</label>
                                                    </p>
                                                
                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="building_type" value="1" data-md-icheck/>
                                                     House</label>
                                                    </p>

                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="building_type" value="2" data-md-icheck/>
                                                     M/Story Building</label>
                                                    </p>
                                                    
                                                </div>
                                            </div>
                                        </div>       
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-7">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-3-5">
                                                        <label>8. How did customer get into contact with you?</label>
                                                    </div>
    
                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="customer_get_contact" value="0" data-md-icheck/>
                                                     Canvas</label>
                                                    </p>
                                                
                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="customer_get_contact" value="1" data-md-icheck/>
                                                     Inquiry</label>
                                                    </p>

                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="customer_get_contact" value="3" data-md-icheck/>
                                                     Walk in</label>
                                                    </p>
                                                    
                                                </div>
                                            </div>
                                        </div>       
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-7">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-3-5">
                                                        <label>9. Who did you liase with?</label>
                                                    </div>
    
                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="liase_with" value="0" data-md-icheck/>
                                                     Owner</label>
                                                    </p>
                                                
                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="liase_with" value="1" data-md-icheck/>
                                                     Manager</label>
                                                    </p>

                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="liase_with" value="2" data-md-icheck/>
                                                     Executive</label>
                                                    </p>
                                                    
                                                </div>
                                            </div>
                                        </div>       
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-7">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-3-5">
                                                        <label>10. Are you confident of the payment?</label>
                                                    </div>
                                                    
                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="confident_of_payment" value="1" data-md-icheck/>
                                                     Yes</label>
                                                    </p>
                                                
                                                
                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="confident_of_payment" value="0" data-md-icheck/>
                                                     No</label>
                                                    </p>
                                                    
                                                </div>
                                            </div>
                                        </div>       
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-7">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-3-5">
                                                        <label>11. Have you receive the Purchase Order?</label>
                                                    </div>
                                                    
                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="receive_purchase_order" value="1" data-md-icheck/>
                                                     Yes</label>
                                                    </p>
                                                
                                                
                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="receive_purchase_order" value="0" data-md-icheck/>
                                                     No</label>
                                                    </p>
                                                    
                                                </div>
                                            </div>
                                        </div>       
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-7">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-3-5">
                                                        <label>12. Have you delivered any product before?</label>
                                                    </div>
                                                    
                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="delivery_product_before" value="1" data-md-icheck/>
                                                     Yes</label>
                                                    </p>
                                                
                                                    <p>
                                                    <label class="inline-label"><input type="radio" name="delivery_product_before" value="0" data-md-icheck/>
                                                     No</label>
                                                    </p>
                                                    
                                                </div>
                                            </div>
                                        </div>       
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-7">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-3-5">
                                                        <label>13. Required Credit Days?</label>
                                                    </div>
    
                                                    <div class="uk-width-medium-1-5">
                                                        <label for="uk_dp_1">Days</label>
                                                        <input class="md-input" type="number" name="credit_days">
                                                    </div>
                                                    
                                                </div>
                                            </div>
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
      
        $('#sidebar_aif_add').addClass('act_item');
        $('#sidebar_main_account').addClass('current_section');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
            $("#aif_tick").trigger('click');
            $("#tiktok5").trigger('click');
        })
    </script>
@endsection