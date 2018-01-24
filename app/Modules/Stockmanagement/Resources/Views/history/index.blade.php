@extends('layouts.main')

@section('title', 'Stock Management')

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
                        <li><a href="{{route('inventory_category_create')}}">Create Category</a></li>
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
    <h3 class="heading_b uk-margin-bottom">Stock History</h3>

    <div class="md-card">
        <div class="md-card-content">
            <div class="uk-overflow-container uk-margin-bottom">
                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Item Name</th>
                        <th>Item Category</th>
                        <th>Total</th>
                        <th>Updated At</th>
                        <th>Updated By</th>
                        <th class="uk-text-center">Action</th>
                    </tr>
                    </thead>

                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Total</th>
                        <th>Updated At</th>
                        <th>Updated By</th>
                        <th class="uk-text-center">Action</th>
                    </tr>
                    </tfoot>

                    <tbody>
                    <?php $total = 1; ?>
                    @foreach($stocks as $stock)
                    <tr>
                        <td>{{ $total++ }}</td>
                        <td>{{ $stock->item->item_name }}</td>
                        <td>{{ $stock->itemCategory->item_category_name }}</td>
                        <td>{{ $stock->total }}</td>
                        <td>{{ $stock->updated_at }}</td>
                        <td>{{ $stock->updatedBy->name }}</td>
                        <td class="uk-text-center">
                            <a href="{{ route('stock_edit',['id' => $stock->id]) }}"><i data-uk-tooltip="{pos:'top'}" title="Edit" class="md-icon material-icons">&#xE254;</i></a>
                            <input type="hidden" class="item_id" value="{{ $stock->item->id }}">
                            <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                            <input type="hidden" class="stock_id" value="{{ $stock->id }}">
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="md-fab-wrapper">
        <a class="md-fab md-fab-accent" href="{{ route('stock_history_create',['id' => $id]) }}">
            <i class="material-icons">&#xE145;</i>
        </a>
    </div>
@endsection

@section('scripts')
    <script>
        $('.delete_btn').click(function () {
            var stock_id = $(this).next('.stock_id').val();
            var item_id = $(this).prev('.item_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "/stock-management/history/"+item_id+"/delete/"+stock_id;
            })
        })
    </script>
    <script type="text/javascript">
        $('#sidebar_inventory').addClass('current_section');
        $('#sidebar_inventory_inventory').addClass('act_item');
    </script>
@endsection
