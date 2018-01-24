@extends('layouts.main')

@section('title', 'Recruit Expense')

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
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Sector</span></a>
                <div class="uk-dropdown">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li><a href="{{ route('order_expense_sector_create') }}">Create Sector</a></li>
                        <li><a href="{{ route('order_expense_sector') }}">All Sector </a></li>
                    </ul>
                </div>
            </li>
            @inject('Categories', 'App\Lib\Category')
            @inject('Helper', 'App\Lib\Helpers')
            <li data-uk-dropdown class="uk-hidden-small">
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Search By Sector</span></a>
                <div class="uk-dropdown uk-dropdown-scrollable">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li><a href="{{ route('order_expense_sector') }}">All Sector</a></li>
                        @foreach($Categories->ExpenseSector() as $documentCategory)
                            <li><a href="{{ route('document_category_search', ['id' => $documentCategory->id]) }}">{{ $documentCategory->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection

@section('content')
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
                                    <h2 class="heading_b"><span class="uk-text-truncate">Expense List</span></h2>
                                </div>
                            </div>
                            <?php
                            $i=1;
                           ?>
                            <div class="user_content">
                                <div class="uk-overflow-container uk-margin-bottom">
                                    <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                    <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                        <thead>
                                        <tr>
                                            <th style="width: 5%">Serial</th>
                                            <th>Date</th>
                                            <th>Sector</th>
                                            <th>Pax Id</th>
                                            <th>Vendor</th>
                                            <th>Amount</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                        </thead>

                                        <tfoot>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Date</th>
                                            <th>Sector</th>
                                            <th>Pax Id</th>
                                            <th>Vendor</th>
                                            <th>Amount</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                        </tfoot>

                                        <tbody>
                                        @if($sector)
                                        @foreach($sector as $value)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ date("d-m-Y",strtotime($value->created_at)) }}</td>
                                                <td>{{ $value->Sector->title }}</td>
                                                <td>
                                                    @foreach ($value->paxId as $v)

                                                     {{ $v->paxid }}

                                                   @endforeach
                                                </td>
                                                <td>{!! isset($value->expense_id)?$Helper->vendor($value->expense_id):'' !!}{{ isset($value->sales_commission_id)?$value->salesCommission["Agents"]["display_name"]:'' }}  </td>
                                                <td>{{ isset($value->expense_id)?$value->amount['amount']:'' }}{{ isset($value->sales_commission_id)?$value->salesCommission['amount']:'' }}</td>
                                                <td class="uk-text-right">

                                                    @if(isset($value->expense_id))
                                                    <a href="{{ route('expense_show',['id'=>$value->expense_id]) }}"><b style="color: darkgreen" class="md-icon material-icons">&#69;</b></a>
                                                    @endif
                                                   @if(isset($value->sales_commission_id))
                                                            <a href="{{ route('sales_commission_show',['id'=>$value->sales_commission_id ]) }}"><b style="color: darkgreen" class="md-icon material-icons">&#83;</b></a>
                                                   @endif
                                                    <a href="{{ route('order_expense_accounts_edit',['id'=>$value['id']]) }}"><i data-uk-tooltip="{pos:'top'}" title="Edit" class="md-icon material-icons">&#xE254;</i></a>
                                                    <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}"  title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                                                   <input data-expense="{{ $value['expense_id'] }}" id="recruite_id" type="hidden" value="{{ $value['id'] }}">

                                                </td>
                                            </tr>
                                        @endforeach
                                        @endif    
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Add branch plus sign -->

                                <div class="md-fab-wrapper branch-create">
                                    <a id="add_branch_button" href="{{ route('order_expense_accounts_create') }}" class="md-fab md-fab-accent branch-create">
                                        <i class="material-icons">&#xE145;</i>
                                    </a>
                                </div>
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
            var recruite_id = $(this).next('#recruite_id').val();
            var expense_id = $(this).next('#recruite_id').data("expense");


            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
            window.location.href = "{{ route('order_expenses_delete') }}"+"/"+recruite_id;
            })
        })



        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_order_expense_accounts').addClass('act_item');
        $(window).load(function(){
            $("#tiktok2").trigger('click');
        })
    </script>



@endsection

