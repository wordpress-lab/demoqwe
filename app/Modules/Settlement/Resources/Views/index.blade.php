@extends('layouts.main')

@section('title', 'Settlement')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style>
        .order tr td:{
            width:10%;
            white-space:nowrap;
        }
    </style>
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
                                <h2 class="heading_b"><span class="uk-text-truncate">All Recruit</span></h2>
                            </div>
                        </div>
                        @php
                            $i=1;
                        @endphp

                        <div class="user_content">
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <table class="uk-table order" cellspacing="0" width="100%" id="data_table" >
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Pax Id</th>
                                        <th>Passenger Name</th>
                                        <th>Referance</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Pax Id</th>
                                        <th>Passenger Name</th>
                                        <th>Referance</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </tfoot>

                                    <tbody>
                                    @foreach($recruit as $value)

                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $value->paxid }}</td>
                                            <td>{{ $value->passenger_name }}</td>
                                            <td>{{ $value->customer['display_name'] }}</td>
                                            <td style="text-align: center;white-space:nowrap !important;">
                                            	<a href="{!! route('settlement_edit',$value->id) !!}" class="batch-edit"><i class="md-icon material-icons uk-margin-right">hourglass_empty</i></a>
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
        $('#sidebar_recruit').addClass('current_section');
        $('#settlement').addClass('act_item');

        $('.delete_btn').click(function () {
            var id = $(this).next('.order_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
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
