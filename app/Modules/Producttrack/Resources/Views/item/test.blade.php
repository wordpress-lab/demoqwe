@extends('layouts.main')

@section('title', 'Product Item')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('angular')
    <script src="{{url('app/inventory/productItem/item.module.js')}}"></script>
    <script src="{{url('app/inventory/productItem/test.controller.js')}}"></script>
@endsection

@section('content')
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile" ng-controller="ItemController">
        <div class="uk-width-large-10-10">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">
                    <div class="md-card">



                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit Item</span></h2>
                            </div>
                        </div>
                        <div class="user_content">

                                <div class="uk-grid uk-margin-large-top uk-margin-large-bottom" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1">
                                        <table class="uk-table">
                                            <thead>
                                            <tr>
                                                <th class="uk-text-nowrap">Item Category</th>
                                                <th class="uk-text-nowrap">Item </th>
                                                <th class="uk-text-nowrap">Quantity</th>
                                                <th class="uk-text-nowrap">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="form_section" id="data_clone" ng-repeat="item in items track by $index">
                                                <td>
                                                    <select id="item_category_id_@{{ $index }}" name="item_category_id[@{{ $index }}]" ng-model="item_category_id" ng-change="getItem($index)" required>


                                                    </select>
                                                </td>
                                                <td>
                                                    <select title="Select Item" id="item_id_@{{ $index }}" name="item_id[@{{ $index }}]" required>


                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="md-input" placeholder="Enter Quantity" value="@{{ item.total }}" name="total[@{{ $index }}]" required />
                                                </td>
                                                <td class="uk-text-right uk-text-middle">
                                                            <span class="uk-input-group-addon">
                                                                <a ng-click="Remove($index)"><i class="material-icons">&#xE15C;</i></a>
                                                            </span>

                                                </td>
                                            </tr>
                                            <tr style="border-bottom: 0px;" class="form_section" id="data_clone">
                                                <td>

                                                </td>
                                                <td>

                                                </td>
                                                <td>

                                                </td>
                                                <td class="uk-text-right uk-text-middle">
                                                            <span class="uk-input-group-addon">
                                                            <a ng-click="Append()"><i class="material-icons">&#xE147;</i></a></span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="uk-grid uk-ma" data-uk-grid-margin>
                                    <div class="uk-width-1-1 uk-float-left">
                                        <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                        <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection