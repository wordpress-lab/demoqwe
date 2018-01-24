@extends('layouts.admin')

@section('title', 'Customer Stamping')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection



@section('content')
    <div class="uk-width-large-10-10">
        <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
            @include('inc.customer_nav')





            <div class="uk-width-xLarge-8-10  uk-width-large-8-10">
                @if(Session::has('alert.status'))
                    <div class="uk-alert uk-alert-{!! Session::get('alert.status')=="success"? "success":"warning" !!}" data-uk-alert>
                        <a href="#" class="uk-alert-close uk-close"></a>
                        {!! Session::get('alert.message') !!}
                    </div>
               @endif
        <div class="md-card">
            <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">

                <div class="user_heading_content">
                    <h2 class="heading_b"><span class="uk-text-truncate">Customer Stamping</span></h2>
                </div>
            </div>
            <div class="md-card-content">


                <div class="uk-overflow-container uk-margin-bottom">
                    <table class="uk-table uk-table-align-vertical uk-table-nowrap tablesorter tablesorter-altair" id="ts_pager_filter">
                        <thead>
                        <tr>
                            <th data-priority="critical">Serial</th>
                            <th data-priority="6">Sending Date</th>
                            <th data-priority="6">Return Date</th>
                            <th data-priority="2">Pax Id</th>
                            <th data-priority="2">Comments</th>
                            <th class="filter-false remove sorter-false uk-text-center" data-priority="1">Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Serial</th>
                            <th>Sending Date</th>
                            <th>Returning Date</th>
                            <th>Pax Id</th>
                            <th>Comment</th>
                            <th class="uk-text-center">Actions</th>
                        </tr>
                        </tfoot>

                        @php
                            $i=1;
                        @endphp

                        <tbody>
                            <tr>
                                <td>{!! $i++ !!}</td>
                                <td>{!! $recruit->visas['send_date'] !!}</td>
                                <td>{!! $recruit->visas['return_date'] !!}</td>
                                <td>{!! $recruit->paxid !!}</td>
                                <td>{!! $recruit->visas['comment']!!}</td>

                                @if($recruit->id==$recruit->visas['pax_id'])
                                    <td class="uk-text-center">
                                        <a href="{!! route('visastamp_edit',$recruit->visas['id']) !!}" class="batch-edit"><i class="md-icon material-icons uk-margin-right">&#xE254;</i></a>
                                    </td>
                                @else
                                    <td class="uk-text-center">
                                        <a href="{!! route('visastamp_create',$recruit->id) !!}" class="batch-edit"><i class="md-icon material-icons uk-margin-right">+</i></a>
                                    </td>
                                @endif

                            </tr>
                        </tbody>
                    </table>
                </div>
                <ul class="uk-pagination ts_pager">
                    <li data-uk-tooltip title="Select Page">
                        <select class="ts_gotoPage ts_selectize"></select>
                    </li>
                    <li class="first"><a href="javascript:void(0)"><i class="uk-icon-angle-double-left"></i></a></li>
                    <li class="prev"><a href="javascript:void(0)"><i class="uk-icon-angle-left"></i></a></li>
                    <li><span class="pagedisplay"></span></li>
                    <li class="next"><a href="javascript:void(0)"><i class="uk-icon-angle-right"></i></a></li>
                    <li class="last"><a href="javascript:void(0)"><i class="uk-icon-angle-double-right"></i></a></li>
                    <li data-uk-tooltip title="Page Size">
                        <select class="pagesize ts_selectize">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </li>
                </ul>
            </div>
        </div>
      </div>
    </div>
    </div>
    <script>

        function deleterow(link) {
            UIkit.modal.confirm('Are you sure?', function(){
                window.location.href = link;
            });
        }
    </script>
@endsection

@section('scripts')
    <script>

        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_customer').addClass('act_item');
        $('.stamp_stamping').addClass('md-bg-blue-grey-100');
    </script>
@endsection