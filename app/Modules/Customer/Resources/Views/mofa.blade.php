@extends('layouts.admin')

@section('title', 'Customer Mofa')

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
                <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">



                    <div class="user_heading_content">
                        <h2 class="heading_b"><span class="uk-text-truncate">Customer Mofa</span></h2>
                    </div>
                </div>
              <div class="md-card">
            <div class="md-card-content">


                <div class="uk-overflow-container uk-margin-bottom">
                    <table class="uk-table uk-table-align-vertical uk-table-nowrap tablesorter tablesorter-altair" id="ts_pager_filter">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Pax Id</th>
                            <th>Mofa Number</th>
                            <th>Iqama Number</th>
                            <th>Mofa Date</th>
                            <th>Medical Center Submit Date</th>
                            <th>status</th>
                            <th class="uk-text-center">Action</th>   </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Pax Id</th>
                            <th>Mofa Number</th>
                            <th>Iqama Number</th>
                            <th>Mofa Date</th>
                            <th>Medical Center Submit Date</th>
                            <th>status</th>
                            <th class="uk-text-center">Action</th>  </tr>
                        </tfoot>

                        @php
                            $i=1;
                        @endphp

                        <tbody>

                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $recruit->paxid }}</td>
                                <td>{{ $recruit->mofas['mofaNumber'] }}</td>
                                <td>{{ $recruit->mofas['iqamaNumber'] }}</td>
                                <td>{{ $recruit->mofas['mofaDate'] }}</td>
                                <td>{{ $recruit->mofas['medical_submit_date'] }}</td>
                                <td>{{ $recruit->mofas['status']? "Ok": "Not ok" }}</td>

                                @if($recruit->id==$recruit->mofas['pax_id'])
                                    <td class="uk-text-center">
                                        <a href="{!! route('mofa_edit',$recruit->mofas['id']) !!}" class="batch-edit"><i class="md-icon material-icons uk-margin-right">&#xE254;</i></a>
                                    </td>
                                @else
                                    <td class="uk-text-center">
                                        <a href="{!! route('mofa_create',$recruit->id) !!}" class="batch-edit"><i class="md-icon material-icons uk-margin-right">+</i></a>
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
        $('.customer_mofa').addClass('md-bg-blue-grey-100');
    </script>
@endsection