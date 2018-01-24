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
                                    <h2 class="heading_b"><span class="uk-text-truncate">Show Information</span></h2>
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
                                                        @foreach($item as $all)
                                                            @if($all->id == $information->machine_model_no_1)
                                                            <label>{{ $all->item_name }}</label>
                                                            @endif
                                                        @endforeach
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
                                                        @foreach($item as $all)
                                                            @if($all->id == $information->machine_model_no_2)
                                                                <label>{{ $all->item_name }}</label>
                                                            @endif
                                                        @endforeach
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
                                                        <label>{{ $information->machine_part_no_1 }}</label>
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
                                                        <label>{{ $information->machine_part_no_2 }}</label>
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
                                                        <label>{{ $information->machine_serial_no_1 }}</label>
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
                                                        <label>{{ $information->machine_serial_no_2 }}</label>
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
                                                        <label>{{ $information->machine_quantity_1 }}</label>
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
                                                        <label>{{ $information->machine_quantity_2 }}</label>
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
                                                        <label>{{ $information->machine_warranty_1 }}</label>
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
                                                        <label>{{ $information->machine_warranty_2 }}</label>
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
                                                        <label>{{ $information->machine_unit_price_1 }}</label>
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
                                                        <label>{{ $information->machine_unit_price_2 }}</label>
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
                                                        @foreach($item as $all)
                                                            @if($all->id == $information->optional_model_no_1)
                                                                <label>{{ $all->item_name }}</label>
                                                            @endif
                                                        @endforeach  
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
                                                        @foreach($item as $all)
                                                            @if($all->id == $information->optional_model_no_2)
                                                                <label>{{ $all->item_name }}</label>
                                                            @endif
                                                        @endforeach
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
                                                        <label>{{ $information->optional_part_no_1 }}</label>
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
                                                        <label>{{ $information->optional_part_no_2 }}</label>
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
                                                        <label>{{ $information->optional_serial_no_1 }}</label>
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
                                                        <label>{{ $information->optional_serial_no_2 }}</label>
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
                                                        <label>{{ $information->optional_quantity_1 }}</label>
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
                                                        <label>{{ $information->optional_quantity_2 }}</label>
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
                                                        <label>{{ $information->optional_warranty_1 }}</label>
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
                                                        <label>{{ $information->optional_warranty_2 }}</label>
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
                                                        <label>{{ $information->optional_unit_price_1 }}</label>
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
                                                        <label>{{ $information->optional_unit_price_2 }}</label>
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
                                                        <label>{{ date('d F, Y', strtotime($information->bill_date)) }}</label>
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
                                                        <label>{{ $information->bill_amount }}</label>
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
                                                        <label>{{ $information->business_promotion_amount }}</label>
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
                                                    <input {{ $information->bill_format==0? "checked":"disabled" }} type="radio" name="bill_format" value="0" data-md-icheck/>
                                                    <label class="inline-label">Consolidated</label>
                                                    </p>
                                                    </div>
                                                    <div class="uk-width-medium-1-5">
                                                    <p>
                                                    <input {{ $information->bill_format==1? "checked":"disabled" }} type="radio" name="bill_format" value="1" data-md-icheck/>
                                                    <label class="inline-label">Item Wise</label>
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
                                                    <input {{ $information->customer_type==0? "checked":'disabled' }} type="radio" name="customer_type" value="0" data-md-icheck/>
                                                    <label class="inline-label">Individual</label>
                                                    </p>
                                                    </div>
                                                    <div class="uk-width-medium-1-5">
                                                    <p>
                                                    <input {{ $information->customer_type==1? "checked":'disabled' }} type="radio" name="customer_type" value="1" data-md-icheck/>
                                                    <label class="inline-label">Corporate</label>
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
                                                    <input {{ $information->price_type==0? "checked":'disabled' }} type="radio" name="price_type" value="0" data-md-icheck/>
                                                    <label class="inline-label">Normal</label>
                                                    </p>
                                                    </div>
                                                    <div class="uk-width-medium-1-5">
                                                    <p>
                                                    <input {{ $information->price_type==1? "checked":'disabled' }} type="radio" name="price_type" value="1" data-md-icheck/>
                                                    <label class="inline-label">Project</label>
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
                                                        <textarea class="md-input" name="billing_information_consignee" id="item_about" cols="30" rows="4">{{ $information->billing_information_consignee }}</textarea>
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
                                                        <textarea class="md-input" name="billing_information__different_consignee" id="item_about" cols="30" rows="4">{{ $information->billing_information__different_consignee }}</textarea>
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
                                                    <input {{ $information->payment_terms==1? "checked":'disabled' }} type="radio" name="payment_terms" value="1" data-md-icheck/>
                                                    <label class="inline-label">Cash</label>
                                                    </p>
                                                
                                                    <p>
                                                    <input {{ $information->payment_terms==2? "checked":'disabled' }} type="radio" name="payment_terms" value="2" data-md-icheck/>
                                                    <label class="inline-label">Cheque</label>
                                                    </p>

                                                    <p>
                                                    <input {{ $information->payment_terms==3? "checked":'disabled' }} type="radio" name="payment_terms" value="3" data-md-icheck/>
                                                    <label class="inline-label">TT</label>
                                                    </p>

                                                    <p>
                                                    <input {{ $information->payment_terms==4? "checked":'disabled' }} type="radio" name="payment_terms" value="4" data-md-icheck/>
                                                    <label class="inline-label">Bank Draf</label>
                                                    </p>

                                                    <p>
                                                    <input {{ $information->payment_terms==5? "checked":'disabled' }} type="radio" name="payment_terms" value="5" data-md-icheck/>
                                                    <label class="inline-label">Credit Card</label>
                                                    </p>

                                                    <p>
                                                    <input {{ $information->payment_terms==6? "checked":'disabled' }} type="radio" name="payment_terms" value="6" data-md-icheck/>
                                                    <label class="inline-label">Post Dated Check</label>
                                                    </p>

                                                    <p>
                                                    <input {{ $information->payment_terms==7? "checked":'disabled' }} type="radio" name="payment_terms" value="7" data-md-icheck/>
                                                    <label class="inline-label">Others</label>
                                                    </p>

                                                    <p>
                                                    <input {{ $information->payment_terms==8? "checked":'disabled' }} type="radio" name="payment_terms" value="8" data-md-icheck/>
                                                    <label class="inline-label">Check Before Delivery</label>
                                                    </p>

                                                    <p>
                                                    <input {{ $information->payment_terms==9? "checked":'disabled' }} type="radio" name="payment_terms" value="9" data-md-icheck/>
                                                    <label class="inline-label">PO</label>
                                                    </p>

                                                    <p>
                                                    <input {{ $information->payment_terms==10? "checked":'disabled' }} type="radio" name="payment_terms" value="10" data-md-icheck/>
                                                    <label class="inline-label">Cash Cheque</label>
                                                    </p>

                                                    <p>
                                                    <input {{ $information->payment_terms==11? "checked":'disabled' }} type="radio" name="payment_terms" value="11" data-md-icheck/>
                                                    <label class="inline-label">Partial Payment & Amount</label>
                                                    </p>

                                                    <p>
                                                    <input {{ $information->payment_terms==12? "checked":'disabled' }} type="radio" name="payment_terms" value="12" data-md-icheck/>
                                                    <label class="inline-label">Balance Due Will Clear On</label>
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
                                                        <label>{{ $information->purchaser_name }}</label>
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
                                                        <label>{{ $information->purchaser_designation }}</label>
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
                                                        <label>{{ $information->purchaser_telephone_number }}</label>
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
                                                        <label>{{ $information->purchaser_mobile_no }}</label>
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
                                                        <label>{{ $information->purchaser_email_no }}</label>
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
                                                        <label>{{ $information->purchaser_fax_no }}</label>
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
                                                        <label>{{ $information->charge_of_payment_name }}</label>
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
                                                        <label>{{ $information->charge_of_payment_designation }}</label>
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
                                                        <label>{{ $information->charge_of_payment_telephone_number }}</label>
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
                                                        <label>{{ $information->charge_of_payment_mobile_no }}</label>
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
                                                        <label>{{ $information->charge_of_payment_email_no }}</label>
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
                                                        <label>{{ $information->charge_of_payment_fax_no }}</label>
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
                                                        <input {{ $information->visit_customer_permises==1? "checked":'disabled' }} type="radio" name="visit_customer_permises" value="1" data-md-icheck/>
                                                        <label class="inline-label">Yes</label>
                                                        </p>
                                                    
                                                    
                                                        <p>
                                                        <input {{ $information->visit_customer_permises==0? "checked":'disabled' }} type="radio" name="visit_customer_permises" value="0" data-md-icheck/>
                                                        <label class="inline-label">No</label>
                                                        </p>

                                                        <p>
                                                        <input {{ $information->visit_customer_permises==2? "checked":'disabled' }} type="radio" name="visit_customer_permises" value="2" data-md-icheck/>
                                                        <label class="inline-label">Later</label>
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
                                                        <label>{{ date('F d, Y', strtotime($information->customer_occupying_permises)) }}</label>
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
                                                    <input {{ $information->neighbours_to_confirm_answer==1? "checked":'disabled' }} type="radio" name="neighbours_to_confirm_answer" value="1" data-md-icheck/>
                                                    <label class="inline-label">Yes</label>
                                                    </p>
                                                
                                                
                                                    <p>
                                                    <input {{ $information->neighbours_to_confirm_answer==0? "checked":'disabled' }} type="radio" name="neighbours_to_confirm_answer" value="0" data-md-icheck/>
                                                    <label class="inline-label">No</label>
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
                                                    <input {{ $information->permises_rent==0? "checked":'disabled' }} type="radio" name="permises_rent" value="0" data-md-icheck/>
                                                    <label class="inline-label">Owned</label>
                                                    </p>
                                                
                                                    <p>
                                                    <input {{ $information->permises_rent==1? "checked":'disabled' }} type="radio" name="permises_rent" value="1" data-md-icheck/>
                                                    <label class="inline-label">Rented</label>
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
                                                    <input {{ $information->office_setup==0? "checked":'disabled' }} type="radio" name="office_setup" value="0" data-md-icheck/>
                                                    <label class="inline-label">Old</label>
                                                    </p>
                                                
                                                    <p>
                                                    <input {{ $information->office_setup==1? "checked":'disabled' }} type="radio" name="office_setup" value="1" data-md-icheck/>
                                                    <label class="inline-label">New</label>
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
                                                        <label>{{ $information->no_of_staff}}</label>
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
                                                    <input {{ $information->building_type==0? "checked":'disabled' }} type="radio" name="building_type" value="0" data-md-icheck/>
                                                    <label class="inline-label">Shoplot</label>
                                                    </p>
                                                
                                                    <p>
                                                    <input {{ $information->building_type==1? "checked":'disabled' }} type="radio" name="building_type" value="1" data-md-icheck/>
                                                    <label class="inline-label">House</label>
                                                    </p>

                                                    <p>
                                                    <input {{ $information->building_type==2? "checked":'disabled' }} type="radio" name="building_type" value="2" data-md-icheck/>
                                                    <label class="inline-label">M/Story Building</label>
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
                                                    <input {{ $information->customer_get_contact==0? "checked":'disabled' }} type="radio" name="customer_get_contact" value="0" data-md-icheck/>
                                                    <label class="inline-label">Canvas</label>
                                                    </p>
                                                
                                                    <p>
                                                    <input {{ $information->customer_get_contact==1? "checked":'disabled' }} type="radio" name="customer_get_contact" value="1" data-md-icheck/>
                                                    <label class="inline-label">Inquiry</label>
                                                    </p>

                                                    <p>
                                                    <input {{ $information->customer_get_contact==2? "checked":'disabled' }} type="radio" name="customer_get_contact" value="2" data-md-icheck/>
                                                    <label class="inline-label">Walk in</label>
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
                                                    <input {{ $information->liase_with==0? "checked":'disabled' }} type="radio" name="liase_with" value="0" data-md-icheck/>
                                                    <label class="inline-label">Owner</label>
                                                    </p>
                                                
                                                    <p>
                                                    <input {{ $information->liase_with==1? "checked":'disabled' }} type="radio" name="liase_with" value="1" data-md-icheck/>
                                                    <label class="inline-label">Manager</label>
                                                    </p>

                                                    <p>
                                                    <input {{ $information->liase_with==2? "checked":'disabled' }} type="radio" name="liase_with" value="2" data-md-icheck/>
                                                    <label class="inline-label">Executive</label>
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
                                                    <input {{ $information->confident_of_payment==1? "checked":'disabled' }} type="radio" name="confident_of_payment" value="1" data-md-icheck/>
                                                    <label class="inline-label">Yes</label>
                                                    </p>
                                                
                                                
                                                    <p>
                                                    <input {{ $information->confident_of_payment==0? "checked":'disabled' }} type="radio" name="confident_of_payment" value="0" data-md-icheck/>
                                                    <label class="inline-label">No</label>
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
                                                    <input {{ $information->receive_purchase_order==1? "checked":'disabled' }} type="radio" name="receive_purchase_order" value="1" data-md-icheck/>
                                                    <label class="inline-label">Yes</label>
                                                    </p>
                                                
                                                
                                                    <p>
                                                    <input {{ $information->receive_purchase_order==0? "checked":'disabled' }} type="radio" name="receive_purchase_order" value="0" data-md-icheck/>
                                                    <label class="inline-label">No</label>
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
                                                    <input {{ $information->delivery_product_before==1? "checked":'disabled' }} type="radio" name="delivery_product_before" value="1" data-md-icheck/>
                                                    <label class="inline-label">Yes</label>
                                                    </p>
                                                
                                                    <p>
                                                    <input {{ $information->delivery_product_before==0? "checked":'disabled' }} type="radio" name="delivery_product_before" value="0" data-md-icheck/>
                                                    <label class="inline-label">No</label>
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
                                                        <label>{{ $information->credit_days}}</label>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>       
                                    </div>

                                    <br/>

                                    <h3 class="full_width_in_card heading_c">
                                        <span class="">
                                            <label for="sales_information" class="inline-label">
                                                Executive
                                            </label>
                                        </span>
                                    </h3>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-2-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        @if($information->signature_of_executive === 1)
                                                        <label style="color: green;">Executive approved the form</label>
                                                        @elseif($information->signature_of_executive === 0)
                                                        <label style="color: red;">Executive did not approve the form</label>
                                                        @elseif($information->signature_of_executive === NULL)
                                                        <label style="color: orange;">Executive did not review the form</label>
                                                        @endif
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
                                                        <label>Comments:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>{{ $information->executive_comment }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h3 class="full_width_in_card heading_c">
                                        <span class="">
                                            <label for="sales_information" class="inline-label">
                                                Manager
                                            </label>
                                        </span>
                                    </h3>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-2-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        @if($information->signature_of_manager === 1)
                                                        <label style="color: green;">Manager approved the form</label>
                                                        @elseif($information->signature_of_manager === 0)
                                                        <label style="color: red;">Manager did not approve the form</label>
                                                        @elseif($information->signature_of_manager === NULL)
                                                        <label style="color: orange;">Manager did not review the form</label>
                                                        @endif
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
                                                        <label>Comments:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>{{ $information->manager_comment }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h3 class="full_width_in_card heading_c">
                                        <span class="">
                                            <label for="sales_information" class="inline-label">
                                                Accounts Department
                                            </label>
                                        </span>
                                    </h3>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-2-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        @if($information->signature_of_account === 1)
                                                        <label style="color: green;">Accounts Dept. approved the form</label>
                                                        @elseif($information->signature_of_account === 0)
                                                        <label style="color: red;">Accounts Dept. did not approve the form</label>
                                                        @elseif($information->signature_of_account === NULL)
                                                        <label style="color: orange;">Accounts Dept. did not review the form</label>
                                                        @endif
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
                                                        <label>Comments:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>{{ $information->account_comment }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h3 class="full_width_in_card heading_c">
                                        <span class="">
                                            <label for="sales_information" class="inline-label">
                                                Admin Department
                                            </label>
                                        </span>
                                    </h3>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-2-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        @if($information->signature_of_admin === 1)
                                                        <label style="color: green;">Admin Dept. approved the form</label>
                                                        @elseif($information->signature_of_admin === 0)
                                                        <label style="color: red;">Admin Dept. did not approve the form</label>
                                                        @elseif($information->signature_of_admin === NULL)
                                                        <label style="color: orange;">Admin Dept. did not review the form</label>
                                                        @endif
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
                                                        <label>Comments:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>{{ $information->admin_comment }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h3 class="full_width_in_card heading_c">
                                        <span class="">
                                            <label for="sales_information" class="inline-label">
                                                Managing Director
                                            </label>
                                        </span>
                                    </h3>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-2-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        @if($information->signature_of_director === 1)
                                                        <label style="color: green;">Managing Director approved the form</label>
                                                        @elseif($information->signature_of_director === 0)
                                                        <label style="color: red;">Managing Director did not approve the form</label>
                                                        @elseif($information->signature_of_director === NULL)
                                                        <label style="color: orange;">Managing Director did not review the form</label>
                                                        @endif
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
                                                        <label>Comments:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>{{ $information->director_comment }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h3 class="full_width_in_card heading_c">
                                        <span class="">
                                            <label for="sales_information" class="inline-label">
                                                Billing Officer
                                            </label>
                                        </span>
                                    </h3>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-2-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        @if($information->signature_of_billing_officer === 1)
                                                        <label style="color: green;">Billing officer approved the form</label>
                                                        @elseif($information->signature_of_billing_officer === 0)
                                                        <label style="color: red;">Billing officer did not approve the form</label>
                                                        @elseif($information->signature_of_billing_officer === NULL)
                                                        <label style="color: orange;">Billing officer did not review the form</label>
                                                        @endif
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
                                                        <label>Comments:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>{{ $information->billing_officer_comment }}</label>
                                                    </div>
                                                </div>
                                            </div>
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
        $('#sidebar_aif_view').addClass('act_item');
        $('#sidebar_main_account').addClass('current_section');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
            $("#aif_tick").trigger('click');
            $("#tiktok5").trigger('click');
        })
    </script>
@endsection