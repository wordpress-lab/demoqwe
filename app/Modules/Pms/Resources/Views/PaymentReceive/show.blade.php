@extends('layouts.main')

@section('title', 'Pms Invoice Payment Receive Show')

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
                                <h2 style="color:white" class="heading_b"><span class="uk-text-truncate">PMS Payment Receive Show</span></h2>
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>

                        </div>

                        <div class="user_content">
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Receipt Number</th>
                                        <th>Amount</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Receipt Number</th>
                                        <th>Amount</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </tfoot>
                                    @php
                                        $i=1;
                                    @endphp
                                    <tbody>
                                    @foreach($payment as $value)

                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ date('d-m-Y', strtotime($value->date)) }}</td>
                                            <td>{{ 'PR-'.$value->number}}</td>
                                            <td>{{ $value->amount}}</td>

                                            <td class="uk-text-center" style="white-space:nowrap !important;">
                                                
                                                <a href="{{ route('pms_invoice_payment_receive_edit',$value->id) }}">
                                                    <i data-uk-tooltip="{pos:'top'}" title="Edit" style="font-size: 23px;" class="material-icons">&#xE254;</i>
                                                </a>

                                                <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="material-icons">&#xE872;</i></a>
                                                <input type="hidden" class="sites_id" value="{{ $value->id }}">

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
        $('#sidebar_pms').addClass('current_section');
        $('#sidebar_pms_invoice').addClass('act_item');

        $('.delete_btn').click(function () {
            var id = $(this).next('.sites_id').val();

            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "{{ route('pms_invoice_payment_receive_destroy' , ['id' => '']) }}"+"/"+id;
            })
        })
    </script>
@endsection
