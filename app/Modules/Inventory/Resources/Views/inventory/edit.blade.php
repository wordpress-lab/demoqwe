@extends('layouts.main')

@section('title', 'Inventory')

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

            <li class="uk-hidden-small">
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
            {!! Form::open(['url' => route('inventory_update', ['id' => $id]), 'method' => 'post', 'class' => 'uk-form-stacked', 'id' => 'user_edit_form']) !!}
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
                                    General info
                                </h3>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="item_category_id" class="uk-vertical-align-middle">Category<span style="color: red;" class="asterisc">*</span></label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <select id="item_category_id" name="item_category_id" data-md-selectize required>
                                            <option value="">Select category</option>
                                            @foreach($item_categories as $category)
                                                @if($category->id == $item->item_category_id)
                                                    <option value="{{ $category->id }}" selected>{{ $category->item_category_name }}</option>
                                                @else
                                                    <option value="{{ $category->id }}">{{ $category->item_category_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if($errors->first('item_category_id'))
                                            <div class="uk-text-danger uk-margin-top">Category is required.</div>
                                        @endif

                                        {{--<div id="company" style="display: none;"  class="uk-grid" >--}}

                                            {{--<div class="uk-width-1-1">--}}
                                                {{--<select id="company_id" name="company_id" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select with tooltip">--}}
                                                    {{--<option value="">Select Company</option>--}}
                                                    {{--@foreach($company as $category)--}}
                                                        {{--@if($category->id == $item->company_id)--}}
                                                        {{--<option selected value="{{ $category->id }}">{{ $category->name }}</option>--}}
                                                        {{--@else--}}
                                                          {{--<option value="{{ $category->id }}">{{ $category->name }}</option>--}}
                                                        {{--@endif--}}
                                                    {{--@endforeach--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="item_name">Name<span style="color: red;" class="asterisc">*</span></label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="item_name">Item Name</label>
                                        <input class="md-input" type="text" id="item_name" name="item_name" value="{{ $item->item_name }}" required/>
                                        @if($errors->has('item_name'))
                                            <div class="uk-text-danger uk-margin-top">{{ $errors->first('item_name') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="item_about">About</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="item_about">Item About</label>
                                        <textarea class="md-input" name="item_about" id="item_about" cols="30" rows="4">{{ $item->item_about }}</textarea>
                                        @if($errors->first('item_about'))
                                            <div class="uk-text-danger uk-margin-top">About is required.</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="unit_type">Unit Type</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="unit_type">Unit Type</label>
                                        <input class="md-input" type="text" id="unit_type" name="unit_type" value="{{ $item->unit_type }}"/>
                                        
                                    </div>
                                </div>

                                <h3 class="full_width_in_card heading_c">
                                    <span class="">
                                        <label for="sales_information" class="inline-label">Sales Information</label>
                                    </span>
                                </h3>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="item_sales_rate">Rate</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="item_sales_rate">Item Sales Rate</label>
                                        <input class="md-input" type="text" id="item_sales_rate" name="item_sales_rate"  value="{{ $item->item_sales_rate }}"/>
                                    </div>
                                </div>

                                

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="item_sales_tax" class="uk-vertical-align-middle">Tax</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <select id="item_sales_tax" name="item_sales_tax" data-md-selectize >
                                            <option value="">Select Tax</option>
                                            @foreach($taxs as $taxsdata)
                                                @if($taxsdata->id == $item->item_sales_tax)
                                                <option value="{{$taxsdata->id}}" selected>{{$taxsdata->tax_name}}</option>
                                                @else
                                                <option value="{{$taxsdata->id}}">{{$taxsdata->tax_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if($errors->first('item_sales_tax'))
                                            <div class="uk-text-danger uk-margin-top">Tax is required.</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="item_sales_description">Description</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="item_sales_description">Description</label>
                                        <textarea class="md-input" name="item_sales_description" id="item_sales_description" cols="30" rows="4">{{ $item->item_sales_description }}</textarea>
                                        @if($errors->first('item_sales_description'))
                                            <div class="uk-text-danger uk-margin-top">Description is required.</div>
                                        @endif
                                    </div>
                                </div>

                                <h3 class="full_width_in_card heading_c">
                                    <span class="">
                                        <label for="purchase_information" class="inline-label">Purchase Information</label>
                                    </span>
                                </h3>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="item_purchase_rate">Rate</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="item_purchase_rate">Item Purchase Rate</label>
                                        <input class="md-input" type="text" id="item_purchase_rate" name="item_purchase_rate" value="{{ $item->item_purchase_rate }}"/>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="item_purchase_description">Description</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="item_purchase_description">Description</label>
                                        <textarea class="md-input" name="item_purchase_description" id="item_purchase_description" cols="30" rows="4">{{ $item->item_purchase_description }}</textarea>
                                        @if($errors->first('item_purchase_description'))
                                            <div class="uk-text-danger uk-margin-top">Description is required.</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="reorder_point">Re-order (Point)</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="reorder_point">Item Reorder Point</label>
                                        <input class="md-input" type="text" id="reorder_point" name="reorder_point" value="{{ $item->reorder_point }}"/>
                                        @if($errors->first('reorder_point'))
                                            <div class="uk-text-danger uk-margin-top">Invalid Input.</div>
                                        @endif
                                    </div>
                                </div>
                                {{--<div class="uk-grid" data-uk-grid-margin>--}}
                                    {{--<div class="uk-width-medium-1-5 uk-vertical-align">--}}
                                    {{--</div>--}}
                                    {{--<div class="uk-width-medium-2-5">--}}
                                        {{--<span class="">--}}
                                            {{--<input type="checkbox" name="purchase_information" id="purchase_information" data-md-icheck data-parsley-mincheck="2" />--}}
                                            {{--<label for="purchase_information" class="inline-label">Print Bar Code</label>--}}
                                        {{--</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

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
        {{--$("#item_category_id").on('change',function () {--}}
            {{--if(parseInt($(this).val())==2){--}}
                {{--$("#company").show();--}}
            {{--}else{--}}
                {{--$("#company").hide();--}}
            {{--}--}}
        {{--});--}}

        {{--var item_category_id = "{{ $item->item_category_id }}";--}}
        {{--if(parseInt(item_category_id)==2){--}}
            {{--$("#company").show();--}}
        {{--}--}}

        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_inventory_inventory').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        })
    </script>
@endsection