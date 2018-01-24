@extends('layouts.main')

@section('title', 'Product Item')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
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
                                    <h2 class="heading_b"><span class="uk-text-truncate">{{$phase->product_phase_name}} Phase</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="recipient_name">Recipient Name</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            {{$phase_item->contact->first_name." ".$phase_item->contact->last_name}}
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="issued_by">Issued By</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            {{$phase_item->issuedBy->name}}
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="issued_number">Issued Number</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            {{$phase_item->issued_number}}
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="reference">Reference</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            {{$phase_item->reference}}
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="date">Date</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            {{$phase_item->date}}
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="date">Personal note</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            {{$phase_item->personal_note}}
                                        </div>
                                    </div>
                                   
                                    <div class="uk-grid uk-margin-large-top uk-margin-large-bottom" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-1">
                                            <table class="uk-table">
                                                <thead>
                                                    <tr>
                                                        <th class="uk-text-nowrap">Item Name</th>
                                                        <th class="uk-text-nowrap">Item Category </th>
                                                        <th class="uk-text-nowrap">Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                	@foreach($phase_item_adds as $phase_item_add)
                                                    <tr style="border-bottom: 0px;" class="form_section" id="data_clone">
                                                        
                                                        <td>
                                                            {{$phase_item_add -> itemCategory -> item_category_name}}
                                                        </td>

                                                        <td>
                                                            {{$phase_item_add->item->item_name}}
                                                        </td>

                                                        <td>
                                                            {{$phase_item_add->total}}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
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
        $('#sidebar_inventory_product').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        })
    </script>
@endsection