@extends('layouts.main')

@section('title', 'Kafala after 60 days')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
<div class="uk-grid uk-grid-width-large-1-2 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-grid-margin="" data-uk-sortable="" style="text-align: center;">

    <div>
        <div class="md-card">
            <div class="md-card-content">
                <div class="uk-float-right uk-margin-top uk-margin-small-right">
                    <span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span>
                </div>

                <a href="javascript::void(0);">
                    <h2 class="uk-margin-remove"><span class="countUpMe"></span> {{ $completed }}</h2>
                    <span class="uk-text-muted uk-text-small">Kafala Assigned</span>
                </a>
            </div>
        </div>
    </div>


    <div>
        <div class="md-card">
            <div class="md-card-content">
                <div class="uk-float-right uk-margin-top uk-margin-small-right">
                    <span class="peity_orders peity_data">64/100</span>
                </div>

                <a href="javascript::void(0);">
                    <h2 class="uk-margin-remove"><span class="countUpMe"></span> {{ $left }}</h2>
                    <span class="uk-text-muted uk-text-small">Left</span>
                </a>
            </div>
        </div>
    </div>

</div>

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Kafala After 60 days</span></h2>
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
                                        <th>Pax Id</th>
                                        <th>Passenger Name</th>
                                        <th>Reference</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Pax Id</th>
                                        <th>Passenger Name</th>
                                        <th>Reference</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </tfoot>

                                    <tbody>
                                 @foreach($acknowledgement as $item)
                                     <tr>
                                         <td>{{ $i++ }}</td>
                                         <td>{{ $item["paxid"] }}</td>
                                         <td>{{ $item["passenger_name"] }}</td>
                                         <td>{{ $item['display_name'] }}</td>
                                         <td style="text-align: center">
                                             @if($item->after_status)
                                             <a href="{{ route("iqama_kafala_after_create",$item["id"]) }}"><i style="font-size: 25px; color: green" class="material-icons">edit</i> </a>
                                             @else
                                             <a href="{{ route("iqama_kafala_after_create",$item["id"]) }}"><i style="font-size: 25px;" class="material-icons">note_add</i> </a>
                                             @endif
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
        $('#iqama_kafala_after_index').addClass('act_item');
        $(window).load(function(){
            $("#tiktok2").trigger('click');


        })


    </script>
@endsection
