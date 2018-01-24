@extends('layouts.admin')

@section('title', 'Manpower Dashboard')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
    <div id="page_content_inner">
        <!-- statistics (small charts) -->
        <div class="uk-grid uk-grid-width-large-1-1 uk-grid-width-medium-1-1 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-sortable data-uk-grid-margin>

            <form class="form-inline" method="post" action="{!! route('manpower_service_dashboard_filter') !!}">
                <div class="uk-grid" data-uk-grid-margin="">
                    <div class="uk-width-large-1-4 uk-width-medium-1-1">
                        <div class="uk-input-group">
                            <label for="uk_dp_end">Start Date</label>
                            <input class="md-input" name="from_date" value="{!! $start !!}" data-uk-datepicker="{format:'YYYY-MM-DD'}" type="text" required>
                        </div>
                        @if($errors->has('from_date'))
                            <span style="color:red">{!!$errors->first('from_date')!!}</span>
                        @endif
                    </div>

                    {!! csrf_field() !!}

                    <div class="uk-width-large-1-4 uk-width-medium-1-1">
                        <div class="uk-input-group">
                            <label for="uk_dp_end">To Date</label>
                            <input class="md-input" name="to_date" value="{!! $end !!}" data-uk-datepicker="{format:'YYYY-MM-DD'}" type="text" required>
                        </div>
                        @if($errors->has('to_date'))
                            <span style="color:red">{!!$errors->first('to_date')!!}</span>
                        @endif
                    </div>
                    <div class="uk-width-large-1-4 uk-width-medium-1-1">
                        <div class="uk-width-medium-1-6">
                            <button class="md-btn" type="submit" data-uk-button>Filter</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="uk-grid uk-grid-width-small-1-2 uk-grid-width-large-1-3 uk-grid-width-xlarge-2-5 uk-text-center uk-sortable sortable-handler" id="dashboard_sortable_cards" data-uk-sortable data-uk-grid-margin>
            <div>
                <div class="md-card md-card-hover md-card-overlay" style="height: 80px">
                    <div class="md-card-content">
                        <div class="epc_chart" data-percent="76" data-bar-color="#03a9f4">
                            @if(count($order)>0)
                                <h1>{!! count($order) !!}</h1>
                            @else
                                <h1>Empty</h1>
                            @endif
                        </div>
                    </div>
                    <div class="md-card-overlay-content" style="background: #02A8F3;color: white;font-weight: bold;">
                        <div class="uk-clearfix md-card-overlay-header">
                            <i style="color:white !important" class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                            <h3 style="color:white !important">
                                Total Issued Order
                            </h3>
                        </div>

                    </div>
                </div>
            </div>

            <div>
                <div class="md-card md-card-hover md-card-overlay" style="height: 80px">
                    <div class="md-card-content">
                        <div class="epc_chart" data-percent="76" data-bar-color="#03a9f4">
                            <?php $v=0; ?>
                            <h1>
                                @foreach($order as $value)
                                    <?php $v+=$value->invoice['total_amount'] ?>
                                @endforeach
                                {!! $v  !!}
                            </h1>
                        </div>
                    </div>
                    <div class="md-card-overlay-content" style="background: #D62728;color: white;font-weight: bold;">
                        <div class="uk-clearfix md-card-overlay-header">
                            <i style="color:white !important" class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                            <h3 style="color:white !important">
                                Total Invoice Amount
                            </h3>
                        </div>

                    </div>
                </div>
            </div>

            <div>
                <div class="md-card md-card-hover md-card-overlay" style="height: 80px">
                    <div class="md-card-content">
                        <div class="epc_chart" data-percent="76" data-bar-color="#03a9f4">
                            <?php $v=0; ?>
                            <h1>
                                @foreach($order as $value)
                                    <?php $v+=$value->bill['amount'] ?>
                                @endforeach
                                {!! $v  !!}
                            </h1>
                        </div>
                    </div>
                    <div class="md-card-overlay-content" style="background: green;color: white;font-weight: bold;">
                        <div class="uk-clearfix md-card-overlay-header">
                            <i style="color:white !important" class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                            <h3 style="color:white !important">
                                Total Payable
                            </h3>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(Session::has('msg'))
        <div class="uk-alert uk-alert-success" data-uk-alert>
            <a href="#" class="uk-alert-close uk-close"></a>
            {!! Session::get('msg') !!}
        </div>
    @endif
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_content">
                            <div class=" uk-margin-bottom">
                                <div class="md-card">


                                    <div class="md-fab-wrapper md-fab-in-card md-fab-speed-dial-horizontal">
                                        <a class="md-fab md-fab-success" href="javascript:void(0)"><i class="material-icons">&#xE85D;</i></a>
                                        <div class="md-fab-wrapper-small">
                                            @if(count($order))
                                                <a class="md-fab md-fab-small md-fab-warning" target="_blank" href="{{ route('manpower_dashboard_ticket_summery_pdf',[$start,$end]) }}"><i class="material-icons">&#xE415;</i></a>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <h3 class="md-bg-cyan-900" style="padding: 10px; color:white;">Manpower Summery</h3>

                                <table style="font-size: 13px;" class="uk-table" cellspacing="0" width="100%" id="data_table" >


                                    <thead>
                                    <tr>

                                        <th>Issue <br/>Date</th>
                                        <th>Order</th>
                                        <th>Customer</th>
                                        <th>Passenger</th>

                                        <th>Passport</th>
                                        <th>Sector</th>
                                        <th>Phone</th>
                                        <th>Progress</th>
                                        <th>Delivery Date</th>
                                        <th>Invoice<br/>Amount</th>
                                        <th>Payable</th>
                                        <th>Status</th>
                                        <th>Vendor</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>

                                        <th>Issue<br/>Date</th>
                                        <th>Order</th>
                                        <th>Customer </th>
                                        <th>Passenger </th>
                                        <th>Passport</th>
                                        <th>Sector</th>
                                        <th>Phone</th>
                                        <th>Progress</th>
                                        <th>Delivery Date</th>
                                        <th>Invoice<br/>Amount</th>
                                        <th>Payable</th>
                                        <th>Status</th>
                                        <th>Vendor</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php $i=1; ?>
                                    @foreach($order as $value)
                                        <tr>

                                            <td>{!! $value->issue_date !!}</td>
                                            <td>{!! $value->order_id !!}</td>
                                            <td>{!! $value->contact['display_name'] !!}</td>
                                            <td>{!! $value['first_name']." ". $value['last_name'] !!}</td>
                                            <td>{!! $value->passport_number !!}</td>
                                            <td>{!! $value->sector !!}</td>
                                            <td>{!! $value->phone !!}</td>
                                            <td>{!! $value->ProgressStatus['title'] !!}</td>
                                            <td>{!! $value->delivery_date !!}</td>
                                            <td>{!! $value->invoice['total_amount'] !!}</td>
                                            <td>{!! $value->bill['amount'] !!}</td>
                                            @if($value->status==0)
                                                <td class="btn btn-danger" style="color: red">Pending</td>
                                            @else
                                                <td class="btn btn-success" style="color: green">Confirm</td>
                                            @endif
                                            <td>{!! $value->vendor['display_name'] !!}</td>
                                            <td class="uk-text-center">
                                                <a href="{!! route('manpower_service_edit',$value->id) !!}" class="batch-edit"><i class="md-icon material-icons uk-margin-right">&#xE254;</i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top: 50px;" class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_content">
                            <div class="uk-margin-top">
                                <div class="md-card" >


                                    <div style="" class="md-fab-wrapper md-fab-in-card md-fab-speed-dial-horizontal">
                                        <a class="md-fab md-fab-success" href="javascript:void(0)"><i class="material-icons">&#xE85D;</i></a>
                                        <div class="md-fab-wrapper-small">
                                            @if(count($total))
                                                <a class="md-fab md-fab-small md-fab-warning" target="_blank" href="{{ route("manpower_dashboard_vendor_pdf",[$start,$end]) }}"><i class="material-icons">&#xE415;</i></a>
                                            @endif

                                        </div>
                                    </div>

                                </div>
                                <h3 class="md-bg-brown-900" style="color:white; padding:10px; "> Vendor Status</h3>
                                <table class="uk-table" cellspacing="0" width="100%" id="third_table" >
                                    <caption>Vendor Status</caption>
                                    <thead>
                                    <tr>
                                        <th>Vendor Name</th>
                                        <th>Total Order</th>
                                        <th>Total Bill</th>
                                        <th>Total Payable</th>
                                        <th>Total Paid</th>
                                        <th>Balance</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th>Vendor Name</th>
                                        <th>Total Order</th>
                                        <th>Total Bill</th>
                                        <th>Total Payable</th>
                                        <th>Total Paid</th>
                                        <th>Balance</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($total as $value)
                                        <tr>
                                            <td>{!! $value->vendor['display_name'] !!}</td>


                                            <td>{{ $value->total_order }}</td>


                                            <td>{!! $value->total_bill !!}</td>
                                            <td>{!! $value->total_amount !!}</td>
                                            <td>{!! ($value->total_amount)-($value->due_amount) !!}</td>
                                            <td>{!! $value->due_amount !!}</td>
                                            <td class="uk-text-center">
                                                <a href="{!! route('manpower_service_total_show',[$value->vendor_id,'start'=>$start,'end'=>$end]) !!}" class="batch-edit"><i class="material-icons">&#xE417;</i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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

        $("#third_table").dataTable({
            "pageLength": 50
        });

        $('#manpower_service_dashboard').addClass('act_item');
        $('#second_table').DataTable();
    </script>
@endsection

