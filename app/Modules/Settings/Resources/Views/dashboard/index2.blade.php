@extends('layouts.admin')

@section('title', 'Ticket Dashboard')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
    @if(Session::has('msg'))
        <div class="uk-alert uk-alert-success" data-uk-alert>
            <a href="#" class="uk-alert-close uk-close"></a>
            {!! Session::get('msg') !!}
        </div>
    @endif

    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile" style="margin-top: 50px;">
        <div class="uk-width-large-10-10">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_content">
                            <div class=" uk-margin-top">
                                <div class="md-card" >


                                    <div style="float: left" class="md-fab-wrapper md-fab-in-card md-fab-speed-dial-horizontal">
                                        <a class="md-fab md-fab-success" href="javascript:void(0)"><i class="material-icons">&#xE85D;</i></a>
                                        <div class="md-fab-wrapper-small">
                                            @if(count($order))
                                                <a class="md-fab md-fab-small md-fab-warning" target="_blank" href="{{ route("ticket_Order_total_pdf",[$id,$start,$end]) }}"><i class="material-icons">&#xE415;</i></a>
                                            @endif

                                        </div>
                                    </div>

                                </div>
                                <h3> Vendor Status</h3>
                                <table class="uk-table" cellspacing="0" width="100%" id="second_table" >
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Order Id</th>
                                        <th>Ticket Number</th>
                                        <th>Payable</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>Order Id</th>
                                        <th>Ticket Number</th>
                                        <th>Payable</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($order as $value)
                                        <tr>
                                            <td>{!! $value->created_at !!}</td>
                                            <td>{!! $value->order_id !!}</td>
                                            <td>{!! $value->ticket_number !!}</td>
                                            <td>{!! $value->bill['amount'] !!}</td>
                                            <td>{!! ($value->bill['amount'])-($value->bill['due_amount']) !!}</td>
                                            <td>{!! $value->bill['due_amount'] !!}</td>
                                            <td class="uk-text-center">
                                                <a href="{!! route('ticket_Order_edit',$value->id) !!}" class="batch-edit"><i class="material-icons">&#xE417;</i></a>
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
        $('#sidebar_ticketing').addClass('current_section');
        $('#sidebar_ticket_dashboard').addClass('act_item');
        $('#second_table').DataTable();
    </script>
@endsection

