@extends('layouts.main')

@section('title', ' Airline Tax')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Airline Tax</span></h2>
                            </div>
                        </div>
                     @php
                         $air = new \App\Lib\Airlines();
                     @endphp

                        <div class="user_content">
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                    <thead>
                                    <tr>

                                        <th>Serial</th>
                                        <th>Airline</th>
                                        <th>Tax</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>

                                        <th>Serial</th>
                                        <th>Pax Id</th>
                                        <th>Created At</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </tfoot>

                                    <tbody>
                                    @foreach($airlinetax as $key=>$value)

                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>

                                                @foreach($value->tax as $item)
                                                   {{ $item->title }} ,
                                                @endforeach
                                            </td>

                                            <td class="uk-text-center">


                                                <a href="{{ route('ticket_airlinestax_edit', ['id' => $value->id]) }}">
                                                    <i data-uk-tooltip="{pos:'top'}" title="Edit" class="md-icon material-icons" style="font-size: 20px;">&#xE254;</i>
                                                </a>
                                                <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons" style="font-size: 20px;">&#xE872;</i></a>
                                                <input type="hidden" class="ticket_airlinestax_id" value="{{ $value->id }}">

                                            </td>
                                        </tr>

                                    @endforeach


                                    </tbody>
                                </table>
                            </div>
                            <!-- Add branch plus sign -->

                            <div class="md-fab-wrapper branch-create">
                                <a id="add_branch_button" href="{{ route('ticket_airlinestax_create') }}" class="md-fab md-fab-accent branch-create">
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
            var id = $(this).next('.ticket_airlinestax_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                if(id){
                    window.location.href = "{{ route('ticket_airlinestax_destroy') }}"+"/"+id;
                }else {
                    window.location.href = "{{ route('ticket_airlinestax_destroy') }}"+"/"+"%00";
                }

            })
        })
    </script>
@endsection
