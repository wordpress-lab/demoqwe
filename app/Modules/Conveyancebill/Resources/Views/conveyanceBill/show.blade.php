@extends('layouts.main')

@section('title', 'Conveyance Bill')

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
                                    <h2 class="heading_b"><span class="uk-text-truncate">Show Conveyance Bill</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <h3 class="full_width_in_card heading_c">
                                        <span class="">
                                            <label for="sales_information" class="inline-label">
                                                Basic Information
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
                                                        <label>{{ $conveyance->user->name }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Date:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>{{ date('d F Y', strtotime($conveyance->date)) }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="md-card uk-margin-medium-bottom">
                                        <div class="md-card-content">
                                            <div class="uk-overflow-container">
                                                <table class="uk-table">
                                                    
                                                    <thead>
                                                    <tr>
                                                        <th>From</th>
                                                        <th>To</th>
                                                        <th>Transport</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td>Total Taka</td>
                                                        <td>{{ $sum }}</td>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>
                                                    @foreach($list as $all)
                                                    <tr>
                                                        <td>{{ $all->from }}</td>
                                                        <td>{{ $all->to }}</td>
                                                        <td>{{ $all->transport }}</td>
                                                        <td>{{ $all->amount }}</td>
                                                    </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-4">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                       <p style="line-height: 2px;">  {{ $conveyance['user']['name'] }}</p>
                                                        <label style="text-decoration: overline;">Prepared by</label>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-4">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                       <p style="line-height: 2px;">  {{ $conveyance->checkBy?$conveyance->checkBy->name:'' }}</p>
                                                        <label style="text-decoration: overline;">Checked by</label>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-4">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                       <p style="line-height: 2px;"> {{ $conveyance->approveBy?$conveyance->approveBy->name:'' }} </p>
                                                        <label style="text-decoration: overline;">Approved by</label>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div  class="uk-width-medium-1-4">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-1">
                                                       <p style="line-height: 2px;">  {{ $conveyance->approved_by_chairman?$conveyance->approveByChireman['name']:'' }}</p>
                                                        <label style="text-decoration: overline;">Approved by Chairman</label>
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