@extends('layouts.main')

@section('title', 'Pms Expense Sector')

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
                                <h2 style="color:white" class="heading_b"><span class="uk-text-truncate">All Sector</span></h2>
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>

                        </div>

                        @php
                            $i=1;
                        @endphp


                        <div class="user_content">
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Expense Number</th>
                                        <th>Date</th>
                                        <th>Sector</th>
                                        <th>Amount</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Expense Number</th>
                                        <th>Date</th>
                                        <th>Sector</th>
                                        <th>Amount</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </tfoot>

                                    <tbody>
                                    @foreach($expense as $value)

                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td style="white-space:nowrap !important;">EXP-{{ $value->number }}</td>

                                            <td>{{ date("d-m-Y",strtotime($value->date)) }}</td>
                                            <td>{{ $value->sector["name"] }}</td>
                                            <td>{{ $value->amount }}</td>
                                            <td>{{ $value->paid }}</td>
                                            <td>{{ $value->due }}</td>
                                            <td class="uk-text-right" style="white-space:nowrap !important;">
                                                <a href="{{ route('pms_expense_pdf', ['id' => $value->id]) }}">
                                                    <i data-uk-tooltip="{pos:'top'}" title="PDF" style="font-size: 23px;" class="material-icons">picture_as_pdf</i>
                                                </a>
                                               <a href="{{ route('pms_expense_edit', ['id' => $value->id]) }}">
                                                    <i data-uk-tooltip="{pos:'top'}" title="Edit" style="font-size: 23px;" class="material-icons">&#xE254;</i>
                                                </a>
                                                <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="material-icons">&#xE872;</i></a>
                                                <input type="hidden" class="sites_id" value="{{ route('pms_expense_destroy',["id"=>$value->id]) }}">
                                                <a href="{{ route('pms_expense_history', ['id' => $value->id]) }}">
                                                    <i data-uk-tooltip="{pos:'top'}" title="History" style="font-size: 23px;" class="material-icons">assignment</i>
                                                </a>
                                                <a href="{{ route('pms_expense_pay', ['id' => $value->id]) }}">
                                                    <i data-uk-tooltip="{pos:'top'}" title="Pay" style="font-size: 23px;" class="material-icons">money_off</i>
                                                </a>
                                            </td>
                                        </tr>

                                    @endforeach


                                    </tbody>
                                </table>
                            </div>
                            <!-- Add branch plus sign -->

                            <div class="md-fab-wrapper branch-create">
                                <a id="add_branch_button" href="{{ route('pms_expense_create') }}" class="md-fab md-fab-accent branch-create">
                                    <i class="material-icons">&#xE145;</i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#sidebar_pms').addClass('current_section');
        $('#sidebar_pms_expense_list_2').addClass('act_item');
        $(window).load(function(){
            $("#pms_tiktok").trigger('click');
            $("#pms_expense_tiktok").trigger('click');
        })
        $('.delete_btn').click(function () {
            var link = $(this).next('.sites_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = link;
            })
        })
    </script>
@endsection
