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
    <script src="{{url('app/inventory/productItem/itemEdit.controller.js')}}"></script>
@endsection

@section('content')
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile" ng-controller="ItemController">
        <div class="uk-width-large-10-10">
            {!! Form::open(['url' => route('product_phase_item_update', ['id' => $product_phase_item->id]), 'method' => 'post', 'class' => 'uk-form-stacked', 'id' => 'user_edit_form']) !!}
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">
                        <div class="md-card">

                            <input type="hidden" ng-init="item_id='asdfg'" value="{{$item_id}}" name="item_id" ng-model="item_id">

                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Edit Item</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="recipient_name">Recipient Name</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <select title="Select Recipient" id="recipient_id" name="recipient_id" required data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}">
                                                <option value="">Select Recipient</option>
                                                @foreach($recipients as $recipient)
                                                    @if($recipient->id == $product_phase_item->recipient_id)
                                                        <option value="{{ $recipient->id }}" selected>{{ $recipient->first_name." ".$recipient->last_name }}</option>
                                                    @else
                                                        <option value="{{ $recipient->id }}">{{ $recipient->first_name." ".$recipient->last_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @if($errors->first('recipient_id'))
                                                <div class="uk-text-danger uk-margin-top">Recipient is required.</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="issued_by">Issued By</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <select title="Select Recipient" id="issued_by" name="issued_by" required data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}">
                                                <option value="">Select User</option>
                                                @foreach($issue_creators as $issue_creator)

                                                    @if($issue_creator->id == $product_phase_item->issued_by)
                                                        <option value="{{ $issue_creator->id }}" selected>{{ $issue_creator->name}}</option>
                                                    @else
                                                        <option value="{{ $issue_creator->id }}">{{ $issue_creator->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @if($errors->first('issued_by'))
                                                <div class="uk-text-danger uk-margin-top">Issued By is required.</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="issued_number">Issued Number</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="issued_number">Enter issued number</label>
                                            <input  class="md-input" type="text" id="issued_number" name="issued_number" value="{{$product_phase_item->issued_number}}" required/>
                                        </div>
                                    </div>
                                    @if($errors->first('issued_number'))
                                        <div class="uk-text-danger uk-margin-top">Issued Numbery is required.</div>
                                    @endif

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="reference">Reference</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="reference">Enter Reference</label>
                                            <input class="md-input" type="text" id="reference" name="reference" value="{{$product_phase_item->reference}}" required/>
                                        </div>
                                    </div>
                                    @if($errors->first('reference'))
                                        <div class="uk-text-danger uk-margin-top">Reference is required.</div>
                                    @endif

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="date">Date</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="date">Enter date</label>
                                            <input class="md-input" type="text" id="date" name="date" data-uk-datepicker="{format:'DD.MM.YYYY'}" value="{{$product_phase_item->date}}" required/>
                                        </div>
                                    </div>
                                    @if($errors->first('date'))
                                        <div class="uk-text-danger uk-margin-top">Date is required.</div>
                                    @endif
                                   
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

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-1">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-1">
                                                    <label for="personal_note">Personal note</label>
                                                    <textarea class="md-input" id="personal_note" name="personal_note" required>{{$product_phase_item->personal_note}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($errors->first('personal_note'))
                                        <div class="uk-text-danger uk-margin-top">Personal Note is required.</div>
                                    @endif
                                                                        
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

            {!! Form::close() !!}
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