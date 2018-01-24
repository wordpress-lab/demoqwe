@extends('layouts.main')

@section('title', 'Invoice')

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
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Invoice List</span></h2>
                            </div>
                        </div>

                        <?php
                            $helper = new \App\Lib\Helpers;
                        ?>

                        <div class="user_content">
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Invoice#</th>
                                        <th>Customer Name</th>
                                        <th>Status</th>
                                        <th>Due Date</th>
                                        <th>Amount</th>
                                        <th>Balance Due</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Invoice#</th>
                                        <th>Customer Name</th>
                                        <th>Status</th>
                                        <th>Due Date</th>
                                        <th>Amount</th>
                                        <th>Balance Due</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </tfoot>

                                    <tbody>
                                    <?php $i = 1;?>
                                    @foreach($invoices as $invoice)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{date('d-m-Y', strtotime($invoice->invoice_date)) }}</td>
                                            <td>INV-{{ str_pad($invoice->invoice_number, 6, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $invoice->customer->first_name }} {{ $invoice->customer->last_name }}</td>
                                            <td
                                                @if($helper->getPaymentStatus($invoice->id) == "Paid")
                                                    style="color:green;"
                                                @endif
                                                @if($helper->getPaymentStatus($invoice->id) == "Partially Paid")
                                                    style="color:blue;"
                                                @endif
                                                @if($helper->getPaymentStatus($invoice->id) == "Due to Paid")
                                                    style="color:red;"
                                                @endif
                                            >
                                                {{ $helper->getPaymentStatus($invoice->id) }}
                                            </td>
                                            <td
                                               @if( $helper->dueDate($invoice->id) == "Over Date")
                                                    style="color:red;"
                                               @endif
                                            >
                                                {{ $helper->dueDate($invoice->id) }}
                                            </td>
                                            <td>{{ $invoice->total_amount }}</td>
                                            <td>BDT {{ $helper->getDueBalance($invoice->id) }}</td>
                                            <td class="uk-text-center">
                                                <a href="{{ route('invoice_show', ['id' => $invoice->id]) }}"><i data-uk-tooltip="{pos:'top'}" title="View" class="md-icon material-icons">visibility</i></a>
                                                <a href="{{ route('invoice_edit', ['id' => $invoice->id]) }}"><i data-uk-tooltip="{pos:'top'}" title="Edit" class="md-icon material-icons">&#xE254;</i></a>
                                                <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                                                <input type="hidden" class="invoice_id" value="{{ $invoice->id }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Add branch plus sign -->

                            <div class="md-fab-wrapper branch-create">
                                <a id="add_branch_button" href="{{ route('invoice_create') }}" class="md-fab md-fab-accent branch-create">
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
        $('.delete_btn').click(function () {
            var id = $(this).next('.invoice_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "/invoice/delete/"+id;
            })
        })
    </script>
@endsection
