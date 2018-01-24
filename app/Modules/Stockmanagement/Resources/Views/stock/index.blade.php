@extends('layouts.main')

@section('title', 'Stock Management')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
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
                                <h2 class="heading_b"><span class="uk-text-truncate">Stock Item List</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Total</th>
                                        <th>Re-order</th>
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
                                        <th>Re-order</th>
                                        <th>Updated At</th>
                                        <th>Updated By</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </tfoot>

                                    <tbody>
                                    <?php $count = 1; ?>
                                    @foreach($items as $item)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $item->item_name }}</td>
                                        <td>{{ $item->itemCategory->item_category_name }}</td>
                                        <td>
                                            <?php $sum = 0; ?>
                                            @foreach($item->stocks as $stock)
                                                <?php $sum += $stock->total; ?>
                                            @endforeach
                                            {{ $sum }}
                                        </td>
                                        <td>{{ $item->reorder_point }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td>{{ $item->updatedBy->name }}</td>
                                        <td class="uk-text-center">
                                            <a href="{{ route('stock_history',['id' => $item->id]) }}"><i data-uk-tooltip title="History" class="md-icon material-icons">&#xE85C;</i></a>
                                            <a href="{{ route('inventory_show',['id' => $item->id]) }}"><i data-uk-tooltip="{pos:'top'}" title="View" class="md-icon material-icons">&#xE8F4;</i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="md-fab-wrapper">
        <a class="md-fab md-fab-accent" href="{{ route('stock_create') }}">
            <i class="material-icons">&#xE145;</i>
        </a>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $('#sidebar_inventory').addClass('current_section');
        $('#sidebar_inventory_inventory').addClass('act_item');
    </script>
@endsection