@extends('layouts.main')

@section('title', 'Contact Category')

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
            <li class="uk-hidden-small">
                <a href="{{route('stock_create')}}"><i class="material-icons">&#xE02E;</i><span>Add Stock</span></a>
            </li>
            <li data-uk-dropdown class="uk-hidden-small">
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Search By Category</span></a>
                <div class="uk-dropdown uk-dropdown-scrollable">
                    <ul class="uk-nav uk-nav-dropdown">
                    <li><a href="{{ route('inventory') }}">All Inventory</a></li>
                    @foreach($item_categories as $item_categories_data)
                        <li><a href="{{ route('inventory_search', ['id' => $item_categories_data->id]) }}">{{ $item_categories_data->item_category_name }}</a></li>
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
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                
                <div class="uk-width-xLarge-10-10  uk-width-large-10-10">
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text">
                                General Information
                            </h3>
                        </div>
                        <div class="md-card-content large-padding">
                            <div class="uk-grid uk-grid-divider uk-grid-medium">
                                <div class="uk-width-large-1-2">

                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Item Name</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle">{{ $item->item_name }}</span>
                                        </div>
                                    </div>
                                    <hr class="uk-grid-divider">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Barcode No :</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            {{ $item->barcode }}
                                        </div>
                                    </div>
                                    <hr class="uk-grid-divider">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Reorder Point:</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            {{ $item->reorder_point }}
                                        </div>
                                    </div>
                                    <hr class="uk-grid-divider">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Category</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            {{ $item->itemCategory->item_category_name }}
                                        </div>
                                    </div>
                                    <hr class="uk-grid-divider">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Unit Type</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            {{ $item->unit_type }}
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="uk-width-large-1-2">
                                    <p>
                                        <span class="uk-text-muted uk-text-small uk-display-block uk-margin-small-bottom">About Item</span>
                                        {{ $item->item_about }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text">
                                Purchase Information
                            </h3>
                        </div>
                        <div class="md-card-content large-padding">
                            <div class="uk-grid uk-grid-divider uk-grid-medium">
                                <div class="uk-width-large-1-2">

                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Purchase Rate</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle">{{ $item->item_purchase_rate }}</span>
                                        </div>
                                    </div>
                                    
                                    <hr class="uk-grid-divider">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Total Purchase:</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            {{ $item->total_purchases }}
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-width-large-1-2">
                                    <p>
                                        <span class="uk-text-muted uk-text-small uk-display-block uk-margin-small-bottom">Purchase Description</span>
                                        {{ $item->item_purchase_description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text">
                                Sales Information
                            </h3>
                        </div>
                        <div class="md-card-content large-padding">
                            <div class="uk-grid uk-grid-divider uk-grid-medium">
                                <div class="uk-width-large-1-2">

                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Sales Rate</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle">{{ $item->item_sales_rate }}</span>
                                        </div>
                                    </div>
                                    
                                    <hr class="uk-grid-divider">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Total Sales:</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            {{ $item->total_sales }}
                                        </div>
                                    </div>
                                    <hr class="uk-grid-divider">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Sales Tax:</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            {{ $item->item_sales_tax }}
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-width-large-1-2">
                                    <p>
                                        <span class="uk-text-muted uk-text-small uk-display-block uk-margin-small-bottom">Purchase Description</span>
                                        {{ $item->item_sales_description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text">
                                Other Information
                            </h3>
                        </div>
                        <div class="md-card-content large-padding">
                            <div class="uk-grid uk-grid-divider uk-grid-medium">
                                <div class="uk-width-large-1-2">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Created By</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            {{ $item->createdBy->name }}
                                        </div>
                                    </div>
                                    <hr class="uk-grid-divider">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Created At</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            {{ $item->created_at }}
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-width-large-1-2">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Updated By</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            {{ $item->updatedBy->name }}
                                        </div>
                                    </div>
                                    <hr class="uk-grid-divider">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Updated At</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            {{ $item->updated_at }}
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
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_inventory_inventory').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        })
    </script>
@endsection