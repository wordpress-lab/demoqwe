@extends('layouts.main')

@section('title', 'Iqama Submission')

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
                    <span class="uk-text-muted uk-text-small">Date Submitted</span>
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
                    <h2 class="uk-margin-remove"><span class="countUpMe"></span> {{ isset($count)?$count:'' }}</h2>
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
                                <h2 class="heading_b"><span class="uk-text-truncate">Iqama Submission</span></h2>
                            </div>
                        </div>

                        @php
                            $i=1;
                        @endphp

                        <div class="user_content">
                            <div class="uk-width-medium-1-1" style="text-align: right;">
                                <a class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light md-bg-blue-grey-400" href="{{ route('iqama_submission_index',['id' => $count]) }}?all">Show All</a>
                                <a class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light md-bg-deep-orange-400" href="{{ route('iqama_submission_index') }}">Processing</a>
                            </div>
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Pax Id</th>
                                        <th>Submission Date</th>
                                        <th>Reference</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Pax Id</th>
                                        <th>Submission Date</th>
                                        <th>Reference</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </tfoot>

                                    <tbody>
                                    @foreach($submission as $value)

                                        <tr>
                                            <td style="width: 8%">{{ $i++ }}</td>
                                            <td>{{ $value->paxid }}</td>
                                            <td>{{ date("Y-m-d",strtotime($value->submission_date)) }}</td>
                                            <td>{{ $value->paxId?$value->paxId->customer['display_name']:'' }}</td>
                                            <td class="uk-text-center" style="white-space:nowrap !important;">
                                                <a href="{{ route("iqama_submission_edit",$value["id"]) }}" class="batch-edit"><i class="md-icon material-icons "></i></a>
                                                {{--<a href="#" class="delete_btn"><i class="md-icon material-icons">&#xE872;</i></a>--}}
                                                {{--<input class="insurance_id" type="hidden" value="{{ route("iqama_submission_destroy",$value["id"]) }}">--}}
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
    <div class="md-fab-wrapper branch-create">
        <a id="add_branch_button" href="{{ route('iqama_submission_create') }}" class="md-fab md-fab-accent branch-create">
            <i class="material-icons">&#xE145;</i>
        </a>
    </div>
@endsection

@section('scripts')
    <script>
        $('.delete_btn').click(function () {
            var url = $(this).next('.insurance_id').val();

            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = url;
            })
        })
    </script>
    <script>
        $('#sidebar_recruit').addClass('current_section');
        $('#iqama_submission').addClass('act_item');
        $(window).load(function(){
            $("#tiktok2").trigger('click');
        })


    </script>
@endsection
