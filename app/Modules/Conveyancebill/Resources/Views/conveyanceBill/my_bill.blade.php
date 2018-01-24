@extends('layouts.main')

@section('title', 'Conveyance Bill')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
<style type="text/css">
    
    .squaredOne {
        -webkit-appearance: none;
    background-color: #fafafa;
    border: 10px solid #cacece;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05);
    padding: 9px;
    border-radius: 3px;
    display: inline-block;
    position: relative;
}

.squaredOne:active, .squaredOne:checked:active {
    box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px 1px 3px rgba(0,0,0,0.1);
}

.squaredOne:checked {
    background-color: #e9ecee;
    border: 10px solid #009E89;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05), inset 15px 10px -12px rgba(255,255,255,0.1);
    color: #99a1a7;
}

.squaredOne:checked:after {
    content: '\2714';
    font-size: 15px;
    position: absolute;
    top: -10.5px;
    left: -7px;
    color: white;
}

</style>
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
            <form action="" class="uk-form-stacked" id="user_edit_form">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Conveyance Bill Form</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-overflow-container uk-margin-bottom">
                                    <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                    <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                        <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Conveyance Bill ID</th>
                                            <th>Date</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                        </thead>

                                        <tfoot>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Conveyance Bill ID</th>
                                            <th>Date</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                        </tfoot>

                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach($conveyance as $all)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $all->id }}</td>
                                                <td>{{ $all->date }}</td>
                                                <td class="uk-text-center">

                                                    <a href="{{ route('cnb_show', $all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="View" class="md-icon material-icons">visibility</i></a>
                                                    <a href="{{ route('cnb_edit', $all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Edit" class="md-icon material-icons">&#xE254;</i></a>
                                                    <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                                                    <input class="inventory_id" type="hidden" value="{{ route('cnb_delete',$all->id) }}">

                                                    <a href="{{ route('cnb_pdf', $all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="PDF" class="md-icon material-icons">picture_as_pdf</i></a>

                                                    @if(empty($all->approved_by))
                                                        <input type="checkbox" data-uk-tooltip="{pos:'top'}" title="Approved" class="aa squaredOne" id="approved" name="approved_by" disabled />
                                                    @else
                                                        <input type="checkbox" data-uk-tooltip="{pos:'top'}" title="Approved" class="aa squaredOne" id="approved" name="approved_by" checked disabled />
                                                    @endif

                                                    @if(empty($all->approved_by_chairman))
                                                        <input type="checkbox" data-uk-tooltip="{pos:'top'}" title="Approved By Chairman" class="aa squaredOne" id="approved_by_chairman" name="approved_by_chairman" )" disabled />
                                                    @else
                                                        <input type="checkbox" data-uk-tooltip="{pos:'top'}" title="pproved By Chairman" class="aa squaredOne" id="approved_by_chairman" name="approved_by_chairman" )" checked disabled />
                                                    @endif
                                                    
                                                    
                                                    @if(empty($all->checked_by))
                                                    <i data-uk-tooltip="{pos:'top'}" title="Check" class="md-icon material-icons">filter_1</i>
                                                    @else
                                                    <i data-uk-tooltip="{pos:'top'}" title="Check" class="md-icon material-icons" style="color: green;">filter_1</i>
                                                    @endif


                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Add branch plus sign -->

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
        $('#sidebar_cnb_add').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        });

        $(window).load(function(){
            $("#tiktok6").trigger('click');
        })

    </script>

@endsection
