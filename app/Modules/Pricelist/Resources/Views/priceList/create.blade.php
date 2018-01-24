@extends('layouts.main')

@section('title', 'Price List')

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
            {!! Form::open(['url' => route('price_list_store'), 'method' => 'post', 'class' => 'uk-form-stacked', 'id' => 'user_edit_form']) !!}
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Create New Price Item</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label for="contact" class="uk-vertical-align-middle">Contact Name<span style="color: red;" class="asterisc">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <select id="contact" name="contact" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select with tooltip">
                                                <option value="">Select Contact</option>
                                                @foreach($contact as $all)
                                                <option value="{{ $all->id }}">{{ $all->display_name }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->first('contact'))
                                                <div class="uk-text-danger uk-margin-top">Contact is required.</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label for="item" class="uk-vertical-align-middle">Item Name<span style="color: red;" class="asterisc">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <select id="item" name="item" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select with tooltip">
                                                <option value="">Select Item</option>
                                                @foreach($item as $all)
                                                <option value="{{ $all->id }}">{{ $all->item_name }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->first('item'))
                                                <div class="uk-text-danger uk-margin-top">Item is required.</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="sales_rate">Sales Rate</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="sales_rate" id="sales_rate2">Sales Rate</label>
                                            <input class="md-input" type="text" id="sales_rate" name="sales_rate" value="{{old('sales_rate')}}"/>
                                            
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="purchase_rate">Purchase Rate</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="purchase_rate" id="purchase_rate2">Purchase Rate</label>
                                            <input class="md-input" type="text" id="purchase_rate" name="purchase_rate" value="{{old('purchase_rate')}}"/>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="item_about">Comment</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="item_about">Comment</label>
                                            <textarea class="md-input" name="comment" id="comment" cols="30" rows="4">{{old('comment')}}</textarea>
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
        $('#sidebar_inventory_price_list').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        })
    </script>
    <script type="text/javascript">
        $('#item').change(function () {
            
            var item_id =$(this).val();
            var contact_id =$('#contact').val();
            if (item_id && contact_id) {
                $.get('/price-list/show/'+item_id+'/'+contact_id, function(data) {
                    // var count = data.length;
                    console.log(data);
                    $('#sales_rate2').hide();
                    $('#sales_rate').val(data.sales_rate);
                    $('#purchase_rate2').hide();
                    $('#purchase_rate').val(data.purchase_rate);
                    $('#comment').html(data.comment);
                    // $('.compare-dropdown').html(count);
                });
            }
            
        });
    </script>
@endsection