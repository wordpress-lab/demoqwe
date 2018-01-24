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
            <form action="" class="uk-form-stacked" id="user_edit_form">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Inventory Item List</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-overflow-container uk-margin-bottom">
                                    <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                    <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                        <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Total Purchase</th>
                                            <th>Total Sales</th>
                                            <th>Total Stock</th>
                                            <th>Re-order</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                        </thead>

                                        <tfoot>
                                        <tr>
                                           <th>Serial</th>
                                           <th>Name</th>
                                            <th>Category</th>
                                            <th>Total Purchase</th>
                                            <th>Total Purchase</th>
                                            <th>Total Stock</th>
                                            <th>Re-order</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                        </tfoot>
                                        <?php $i=1; ?>
                                        <tbody>
                                        @foreach($items as $item)
                                            <tr>
                                                <td>{!! $i++ !!}</td>
                                                <td>{{ $item->item_name }}</td>
                                                <td>{{ $item->item_category_name }}</td>
                                                <td>{{ $item->total_purchases }}</td>
                                                <td>{{ $item->total_sales }}</td>
                                                <td>{{ $item->total_purchases - $item->total_sales}}</td>
                                                <td>{{ $item->reorder_point }}</td>
                                                <td class="uk-text-right" style="white-space:nowrap !important;">
                                                    @if($item->item_category_id == 1)
                                                        <a href="{{ route('stock_history',['id' => $item->id]) }}"><i data-uk-tooltip title="History" class="material-icons">&#xE85C;</i></a>
                                                    @endif

                                                    <a href="{{ route('inventory_show',['id' => $item->id]) }}"><i data-uk-tooltip="{pos:'top'}" title="View" class=" material-icons">&#xE8F4;</i></a>
                                                    <a href="{{ route('inventory_edit',['id' => $item->id]) }}"><i data-uk-tooltip="{pos:'top'}" title="Edit" class=" material-icons">&#xE254;</i></a>
                                                    <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="material-icons">&#xE872;</i></a>
                                                    <input class="inventory_id" type="hidden" value=" {{ route('inventory_delete',$item->id) }}">

                                                    @if($item->item_category_id == 1)
                                                        <a href="{{ route('stock_history_create',['id' => $item->id]) }}"><i data-uk-tooltip="{pos:'top'}" title="Add Stock" class="material-icons">&#xE147;</i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Add branch plus sign -->

                                <div class="md-fab-wrapper branch-create">
                                    <a id="add_branch_button" href="{{ route('inventory_create') }}" class="md-fab md-fab-accent branch-create">
                                        <i class="material-icons">&#xE145;</i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $('.delete_btn').click(function () {
            var url = $(this).next('.inventory_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = url;
            })
        })
    </script>

    <script type="text/javascript">
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_inventory_inventory').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        })
    </script>
@endsection
