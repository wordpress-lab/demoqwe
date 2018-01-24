@extends('layouts.main')

@section('title', 'Archive Order List')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            @if(Session::has('msg'))
                <div class="uk-alert uk-alert-success" data-uk-alert>
                    <a href="#" class="uk-alert-close uk-close"></a>
                    {!! Session::get('msg') !!}
                </div>
            @endif
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Archive Order List</span></h2>
                                <a href="{!! route('order') !!}" class="heading_b pull-right btn btn-success"><span class="uk-text-truncate">Back To Order</span></a>
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
                                        <th>Customer</th>
                                        <th>Package</th>
                                        <th>Register Serial</th>
                                        <th>passportNumber</th>

                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer</th>
                                        <th>Package</th>
                                        <th>Register Serial</th>
                                        <th>passportNumber</th>



                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </tfoot>

                                    <tbody>
                                    @foreach($order as $value)

                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $value->customer['display_name'] }}</td>
                                            <td>{{ $value->package['item_name'] }}</td>
                                            <td>{{ $value->registerserial['visaNumber'] }}</td>

                                            <td>{{ $value->passportNumber }}</td>


                                            <td class="uk-text-center">
                                                <a href="{{ route('order_invoice_show', ['id' => $value->invoice_id?$value->invoice_id:0,'order'=>$value->id]) }}">
                                                    <i data-uk-tooltip="{pos:'top'}" title="Invoice"class="material-icons">library_books</i>
                                                </a>
                                               <a href="{{ route('order_edit', ['id' => $value->id]) }}">
                                                    <i data-uk-tooltip="{pos:'top'}" title="Edit" class="md-icon material-icons">&#xE254;</i>
                                                </a>
                                                <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                                                <input type="hidden" class="order_id" value="{{ $value->id }}">
                                                <a href="{!! route('order_archive_back',$value->id) !!}"><i  title="Archive" class="material-icons">&#xE149;</i></a>
                                                <a href="{{route('customer_update',$value->paxid)}}" class="batch-edit"><i class="md-icon material-icons uk-margin-right">&#xE8F4;</i></a>


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
    </div>
@endsection

@section('scripts')
    <script>


        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_recruit_order').addClass('act_item');


        $('.delete_btn').click(function () {
            var id = $(this).next('.order_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this! If you delete this order all record will be deleted related to this Order",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "{{ route('order_delete') }}"+"/"+id;
            })
        })
    </script>
@endsection
