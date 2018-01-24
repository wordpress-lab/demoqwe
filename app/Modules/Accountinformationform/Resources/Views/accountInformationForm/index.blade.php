@extends('layouts.main')

@section('title', 'Account Information Form')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('styles')
    <style>
        .uk-form-select{
            color:rgba(0, 0, 0, 0.8) !important;
        }
        .styled-select select {
            background: transparent;
            border: none;
            font-size: 18px;
            height: 29px;
            padding: 5px; /* If you add too much padding here, the options won't show in IE */
            width: 90%;

        }

        .styled-select.slate {
            {{--background: url({{ asset('admin/assets/icons/arrow_down.jpg') }}) no-repeat right center;--}}
            height: 34px;
            width: 240px;
            z-index: 10;
        }

        .styled-select.slate select {

            border-bottom: 1px solid #ccc;
            font-size: 16px;
            height: 34px;
            width: 268px;
        }
        .styled-select.slate option{
            font-size: 16pt;

        }
        .slate   { background-color: #ddd; }
        .slate select   { color: #000; }
        @media screen and (-webkit-min-device-pixel-ratio:0)
        {
            .styled-select.slate {
                background: url({{ asset('admin/assets/icons/arrow_down.jpg') }}) no-repeat right center;

            }
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

                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">

                        <div class="md-card">
                            <div class="md-card-toolbar" style="">
                                <div class="md-card-toolbar-actions hidden-print">




                                    <!--end  -->
                                    <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="true"> <a href="#" data-uk-modal="{target:'#coustom_setting_modal'}"><i class="material-icons">&#xE8B8;</i><span>Custom Setting</span></a>

                                    </div>
                                    <!--coustorm setting modal start -->
                                    <div class="uk-modal" id="coustom_setting_modal">
                                        <div class="uk-modal-dialog">
                                            {!! Form::open(['url' => 'accountinformationform', 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}
                                            <div class="uk-modal-header">
                                                <h3 class="uk-modal-title">Select Date Range {{ session('branch_id')==1?"and Branch":'' }}   <i class="material-icons" data-uk-tooltip="{pos:'top'}" title="headline tooltip">&#xE8FD;</i></h3>
                                            </div>

                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                @if(session('branch_id')==1)
                                                    <div class="uk-width-medium-2-2">
                                                        <div class="uk-input-group">
                                                            <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-building"></i></span>

                                                            <select style="width: 90%" class="styled-select slate"  id="report_account_id" name="branch_id" >

                                                                @if(isset($branch_id))
                                                                    @foreach($branchs as $branch)
                                                                        <option {{ ($branch_id==$branch->id)?"selected":'' }} value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                                                    @endforeach
                                                                @else
                                                                    @foreach($branchs as $branch)
                                                                        <option  value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                                                    @endforeach

                                                                @endif
                                                            </select>

                                                        </div>
                                                        <br/>
                                                    </div>
                                                @endif
                                                <div class="uk-width-large-2-2 uk-width-2-2">
                                                    <div class="uk-input-group">
                                                        <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                        <label for="uk_dp_1">From</label>
                                                        <input value="{{ isset($from_date)?$from_date:date('Y-m-d') }}" required class="md-input" type="text"  name="from_date" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                                    </div>
                                                </div>
                                                <div class="uk-width-large-2-2 uk-width-2-2">
                                                    <div class="uk-input-group">
                                                        <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                        <label for="uk_dp_1">To</label>
                                                        <input value="{{ isset($to_date)?$to_date:date('Y-m-d') }}" required class="md-input" type="text"  name="to_date" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="uk-modal-footer uk-text-right">
                                                <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                                <button type="submit" name="submit" class="md-btn md-btn-flat md-btn-flat-primary">Search</button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                    <!--end  -->
                                </div>

                                <h3 class="md-card-toolbar-heading-text large" id="invoice_name"></h3>
                            </div>
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Account Information Form</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-overflow-container uk-margin-bottom">
                                    <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                    <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                        <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Form ID</th>
                                            <th>Representative Name</th>
                                            <th>Purchaser Name</th>
                                            <th>Updated By</th>
                                            <th>Created At</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                        </thead>

                                        <tfoot>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Form ID</th>
                                            <th>Representative Name</th>
                                            <th>Purchaser Name</th>
                                            <th>Updated By</th>
                                            <th>Created At</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                        </tfoot>

                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach($information as $all)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>AIF-00000{{ $all->id }}</td>
                                                <td>{{ $all->user->name }}</td>
                                                <td>{{ $all->purchaser_name }}</td>
                                                <td>{{ $all->updatedBy->name }}</td>
                                                <td>{{ $all->created_at }}</td>
                                                <td class="uk-text-center">

                                                    <a href="{{ route('aif_show', $all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="View" class="md-icon material-icons">visibility</i></a>
                                                    <a href="{{ route('aif_edit', $all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Edit" class="md-icon material-icons">&#xE254;</i></a>
                                                    <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                                                    <input class="inventory_id" type="hidden" value="{{ route('aif_delete',$all->id) }}">

                                                    <a href="{{ route('aif_pdf', $all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="PDF" class="md-icon material-icons">picture_as_pdf</i></a>

                                                    @if($all->signature_of_executive === NULL)
                                                    <a href="{{ route('aif_execuitive',$all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Execuitive" class="md-icon material-icons">filter_1</i></a>
                                                    @elseif($all->signature_of_executive === 1)
                                                    <a href="{{ route('aif_execuitive',$all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Execuitive" class="md-icon material-icons" style="color: green;">filter_1</i></a>

                                                    @elseif($all->signature_of_executive === 0)
                                                    <a href="{{ route('aif_execuitive',$all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Execuitive" class="md-icon material-icons" style="color: red;">filter_1</i></a>
                                                    @endif

                                                    @if($all->signature_of_manager === 1)
                                                    <a href="{{ route('aif_manager',$all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Manager" class="md-icon material-icons" style="color: green;">filter_2</i></a>
                                                    @elseif($all->signature_of_manager === 0)
                                                    <a href="{{ route('aif_manager',$all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Manager" class="md-icon material-icons" style="color: red;">filter_2</i></a>
                                                    @elseif($all->signature_of_manager===NULL)
                                                    <a href="{{ route('aif_manager',$all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Manager" class="md-icon material-icons">filter_2</i></a>
                                                    @endif

                                                    @if($all->signature_of_account===1)
                                                    <a href="{{ route('aif_account',$all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Account" class="md-icon material-icons" style="color: green;">filter_3</i></a>
                                                    @elseif($all->signature_of_account===0)
                                                    <a href="{{ route('aif_account',$all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Account" class="md-icon material-icons" style="color: red;">filter_3</i></a>
                                                    @elseif($all->signature_of_account===NULL)
                                                    <a href="{{ route('aif_account',$all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Account" class="md-icon material-icons">filter_3</i></a>
                                                    @endif

                                                    @if($all->signature_of_admin===1)
                                                    <a href="{{ route('aif_admin',$all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Admin" class="md-icon material-icons" style="color: green;">filter_4</i></a>
                                                    @elseif($all->signature_of_admin===0)
                                                    <a href="{{ route('aif_admin',$all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Admin" class="md-icon material-icons" style="color: red;">filter_4</i></a>
                                                    @elseif($all->signature_of_admin===NULL)
                                                    <a href="{{ route('aif_admin',$all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Admin" class="md-icon material-icons">filter_4</i></a>
                                                    @endif

                                                    @if($all->signature_of_director===1)
                                                    <a href="{{ route('aif_director',$all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Director" class="md-icon material-icons" style="color: green;">filter_5</i></a>
                                                    @elseif($all->signature_of_director===0)
                                                    <a href="{{ route('aif_director',$all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Director" class="md-icon material-icons" style="color: red;">filter_5</i></a>
                                                    @elseif($all->signature_of_director===NULL)
                                                    <a href="{{ route('aif_director',$all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Director" class="md-icon material-icons">filter_5</i></a>
                                                    @endif

                                                    @if($all->signature_of_billing_officer===1)
                                                    <a href="{{ route('aif_officer',$all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Billing Officer" class="md-icon material-icons" style="color: green;">filter_6</i></a>
                                                    @elseif($all->signature_of_billing_officer===0)
                                                    <a href="{{ route('aif_officer',$all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Billing Officer" class="md-icon material-icons" style="color: red;">filter_6</i></a>
                                                    @elseif($all->signature_of_billing_officer===NULL)
                                                    <a href="{{ route('aif_officer',$all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Billing Officer" class="md-icon material-icons">filter_6</i></a>
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

        $('#sidebar_aif_view').addClass('act_item');


        $('#sidebar_main_account').addClass('current_section');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
            $("#aif_tick").trigger('click');
            $("#tiktok5").trigger('click');
        })
    </script>
@endsection
