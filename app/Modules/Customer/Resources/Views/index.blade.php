@extends('layouts.admin')

@section('title', 'All Customer')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
            <div class="uk-width-large-10-10">
                <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
                    <div class="user_heading_content">
                        <h2 class="heading_b"><span class="uk-text-truncate">Customer</span></h2>
                        @if(session('branch_id')==1)
                            <div class="uk-grid">
                                <div class="uk-width-1-2">
                                    <div class="parsley-row">
                                        <select onchange="location = this.value;" id="d_form_select_country" data-md-selectize required>
                                            <option value="">Select Branch...</option>

                                            @foreach($branch as $value)
                                                @if($value->id==$id)
                                                    <option value="{{ route('customer',$value->id) }}" selected>{!! $value->branch_name !!}</option>
                                                @else
                                                    <option value="{{ route('customer',$value->id) }}">{!! $value->branch_name !!}</option>
                                                @endif
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="uk-grid">
                                <div class="uk-width-1-2">
                                    <div class="parsley-row">
                                        <select id="d_form_select_country" data-md-selectize required>
                                            @foreach($branch as $value)
                                                <option value="{{ route('customer',$value->id) }}" selected disabled>{!! $value->branch_name !!}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>

                        @endif
                    </div>
                </div>
                <div class="md-card">
                    <div class="md-card-content">

                        <div class="uk-margin-bottom">
                            <a href="#" class="md-btn uk-margin-right" id="printTable">Print Table</a>
                            <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}">
                                <button class="md-btn">Columns <i class="uk-icon-caret-down"></i></button>
                                <div class="uk-dropdown">
                                    <ul class="uk-nav uk-nav-dropdown" id="columnSelector"></ul>
                                </div>
                            </div>
                        </div>
                        <div class="uk-overflow-container uk-margin-bottom">
                            <table class="uk-table uk-table-align-vertical uk-table-nowrap tablesorter tablesorter-altair" id="data_table">
                                <thead>
                                <tr>
                                    <th data-priority="critical">Serial</th>
                                    <th data-priority="2">PaxID</th>
                                    <th data-priority="6">Passenger Name</th>
                                    <th data-priority="6">Passport Number</th>
                                    <th data-priority="1">Contact Number</th>
                                    <th data-priority="2">Reference Name</th>
                                    <th class="filter-false remove sorter-false uk-text-center" data-priority="1">Actions</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th data-priority="critical">Serial</th>
                                    <th data-priority="2">PaxID</th>
                                    <th data-priority="6">Passenger Name</th>
                                    <th data-priority="6">Passport Number</th>
                                    <th data-priority="1">Contact Number</th>
                                    <th data-priority="2">Reference Name</th>
                                    <th class="filter-false remove sorter-false uk-text-center" data-priority="1">Actions</th>
                                </tr>
                                </tfoot>
                                <?php
                                $i=1;
                                ?>
                                <tbody>
                                <tr>
                                    @foreach($recruit as $value)
                                        <td>{!! $i++ !!}</td>
                                        <td>{!! $value->paxid !!}</td>
                                        <td>{!! $value->passenger_name !!}</td>
                                        <td>{!! $value->passportNumber !!}</td>
                                        <td>{!! $value->customer['phone_number_1']  !!}</td>
                                        <!-- <td>{!! $value->customer['first_name']   !!}</td> -->
                                        <td>{!! $value->customer['display_name'] !!}</td>
                                    <td class="uk-text-center">
                                        <a href="{{route('customer_update',$value->paxid)}}" class="batch-edit"><i class="md-icon material-icons uk-margin-right">&#xE8F4;</i></a>
                                       {{-- <a href="#" class="batch-edit" data-uk-modal="{target:'#edit_modal{{$data->course_id}}'}"><i class="md-icon material-icons uk-margin-right">&#xE254;</i></a>--}}
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <ul class="uk-pagination ts_pager">
                            <li data-uk-tooltip title="Select Page">
                                <select class="ts_gotoPage ts_selectize"></select>
                            </li>
                            <li class="first"><a href="javascript:void(0)"><i class="uk-icon-angle-double-left"></i></a></li>
                            <li class="prev"><a href="javascript:void(0)"><i class="uk-icon-angle-left"></i></a></li>
                            <li><span class="pagedisplay"></span></li>
                            <li class="next"><a href="javascript:void(0)"><i class="uk-icon-angle-right"></i></a></li>
                            <li class="last"><a href="javascript:void(0)"><i class="uk-icon-angle-double-right"></i></a></li>
                            <li data-uk-tooltip title="Page Size">
                                <select class="pagesize ts_selectize">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                </select>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
@endsection

@section('scripts')
    <script>
        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_customer').addClass('act_item');
    </script>


@endsection