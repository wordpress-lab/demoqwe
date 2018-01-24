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
                                    <div class="spinner"></div>
                                    <table class="uk-table" cellspacing="0" width="100%" id="data_table_1" >
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
                                            <th class="uk-text-center">Created At</th>
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
                                            <th class="uk-text-center">Created At</th>
                                        </tr>
                                        </tfoot>

                                        <tbody>

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


    <script type="text/javascript">
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_inventory_inventory').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');



        })

        var all_inventory_list = "{{ route("inventory_api_all_inventory_list") }}";
        var all_inventory_view = "{{ route('inventory_show',["id"=>'']) }}";
        var all_inventory_edit = "{{ route('inventory_edit',["id"=>'']) }}";
        var all_stock_history = "{{ route('stock_history',["id"=>'']) }}";
        var all_stock_history_create = "{{ route('stock_history_create',["id"=>'']) }}";
        var all_inventory_delete = "{{ route('inventory_delete',["id"=>'']) }}";
        window.onload = function () {
            $.get(all_inventory_list,function (datalist) {
                var data = [];

                   $.each(datalist, function(k, v) {
                       var actiondata = {};
                       actiondata.id = v.id;
                       var date_created_at = v.format_created_at;
                       actiondata.item_category_id = v.item_category_id;

                       data.push([++k,v.item_name, v.item_category_name||' ', v.total_purchases, v.total_sales, v.total_purchases- v.total_sales,v.reorder_point,actiondata,date_created_at] );
                });



                $('#data_table_1').DataTable({
                    "pageLength": 50,
                    data:           data,
                    deferRender:    true,
                    "columnDefs": [
                        {
                            "targets": 7,
                            "render": function ( link, type, row )
                            {
                                var inventory_url = '';
                                if(link.item_category_id == 1){
                                  inventory_url+="<a href="+all_stock_history+"/"+link.id+"><i data-uk-tooltip title='History' class='material-icons'>&#xE85C;</i></a>";
                                }
                                inventory_url+= "<a target='_blank' href="+all_inventory_view+"/"+link.id+">"+'<i data-uk-tooltip="{pos:\'top\'}" title="View" class=" material-icons">&#xE8F4;</i>'+"</a>";
                                inventory_url+="<a target='_blank' href="+all_inventory_edit+"/"+link.id+">"+'<i data-uk-tooltip="{pos:\'top\'}" title="Edit" class=" material-icons">&#xE254;</i>'+"</a>";
                                inventory_url+=  "<a onclick='removeItem(this);' class='delete_btn'><i data-uk-tooltip=\"{pos:'top'}\" title='Delete' class='material-icons'>&#xE872;</i></a>";
                                inventory_url+=  "<input class='inventory_id' type='hidden' value="+all_inventory_delete+'/'+link.id+">";
                                if(link.item_category_id == 1){
                                    inventory_url+= "<a href="+all_stock_history_create+"/"+link.id+"><i data-uk-tooltip=\"{pos:'top'}\" title='Add Stock' class='material-icons'>&#xE147;</i></a>";
                                }
                                return inventory_url;
                            }
                        }
                    ]
                });
                $(".spinner").remove();
            });


        };

        function removeItem(row)
        {
            var url = $(row).next('.inventory_id').val();

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
        }
    </script>
@endsection
