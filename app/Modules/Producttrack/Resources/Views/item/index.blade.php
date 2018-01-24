@extends('layouts.main')

@section('title', 'Contact Category')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('angular')
    <script src="{{url('app/inventory/productphase/phase.module.js')}}"></script>
    <script src="{{url('app/inventory/productphase/phase.controller.js')}}"></script>
@endsection

@section('content')
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile" ng-controller="PhaseController">
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
                                    <h2 class="heading_b"><span class="uk-text-truncate">Phase Item</span></h2>
                                </div>
                            </div>
                            @foreach($product_phases as $product_phase)  
                            
                             
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <?php $i = 0; ?>
                                    <h3 class="full_width_in_card heading_c">
                                        <span>{{$product_phase->product_phase_name}} Phase</span>
                                        <div class="uk-float-right">
                                            <input type="checkbox" name="first_phase_{{ $i }}" id="first_phase_{{ $product_phase->id }}" {{$product_phase->status ? 'checked' : ''}} ng-click="Complete({{$product_phase->id}})"/>
                                            <label class="inline-label" for="first_phase_{{ $product_phase->id }}" id="first_phase_level_{{ $product_phase->id }}" >{{$product_phase->status ? 'Complete' : 'Uncomplete'}}</label>
                                        </div>
                                    </h3>
                                        <?php $i++ ?>

                                    <div class="uk-overflow-container uk-margin-bottom">
                                        <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>


                                        <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                            <thead>
                                            <tr>
                                                <th>Item Name</th>
                                                <th>Totall quantity</th>
                                                <th>Recepient Name</th>
                                                <th>Issued By</th>
                                                <th>Issued Number</th>
                                                <th>Reference</th>
                                                <th>Date:</th>
                                                <th class="uk-text-center">Action</th>
                                            </tr>
                                            </thead>

                                            <tfoot>
                                            <tr>
                                                <th>Item Name</th>
                                                <th>Totall quantity</th>
                                                <th>Recepient Name</th>
                                                <th>Issued By</th>
                                                <th>Issued Number</th>
                                                <th>Reference</th>
                                                <th>Date:</th>
                                                <th class="uk-text-center">Action</th>
                                            </tr>
                                            </tfoot>

                                            <tbody>
                                            @foreach($product_phase->productPhaseItems as $items)

                                            @foreach($items->productPhaseItemAdds as $item)
                                            <tr>
                                                <td>
                                                    {{$item->item->item_name}}
                                                </td>
                                                <td>
                                                    {{$item->total}}
                                                </td>
                                                <td>
                                                    {{$items->contact->first_name." ".$items->contact->last_name}}
                                                </td>
                                                <td>
                                                    {{$items->issuedBy->name}}
                                                </td>
                                                <td>
                                                    {{$items->issued_number}}
                                                </td>
                                                <td>
                                                    {{$items->reference}}
                                                </td>
                                                <td>
                                                    {{$items->date}}
                                                </th>
                                                <td class="uk-text-center">
                                                    <a href="{{ route('product_phase_item_show',['id' => $items->id]) }}"><i data-uk-tooltip="{pos:'top'}" title="View" class="md-icon material-icons">&#xE8F4;</i></a>
                                                    <a href="{{ route('product_phase_item_edit',['id' => $items->id]) }}"><i data-uk-tooltip="{pos:'top'}" title="Edit" class="md-icon material-icons">&#xE254;</i></a>
                                                    <a href="{{ route('product_phase_item_delete',['id' => $items->id]) }}"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @endforeach()
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
        $('#sidebar_inventory_product').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        })
    </script>
@endsection