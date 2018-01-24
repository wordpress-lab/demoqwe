@extends('layouts.main')

@section('title', 'Training')

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
                    <span class="uk-text-muted uk-text-small">Completed</span>
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
    @if(Session::has('msg'))
        <div class="uk-alert uk-alert-success" data-uk-alert>
            <a href="#" class="uk-alert-close uk-close"></a>
            {!! Session::get('msg') !!}
        </div>
    @endif
    @if(Session::has('create'))
        <div class="uk-alert uk-alert-success" data-uk-alert>
            <a href="#" class="uk-alert-close uk-close"></a>
            {!! Session::get('create') !!}
        </div>
    @endif
    @if(Session::has('delete'))
        <div class="uk-alert uk-alert-danger" data-uk-alert>
            <a href="#" class="uk-alert-close uk-close"></a>
            {!! Session::get('delete') !!}
        </div>
    @endif
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
                                <h2 class="heading_b"><span class="uk-text-truncate">Training List</span></h2>
                                @if(session('branch_id')==1)
                                    <div class="uk-grid">
                                        <div class="uk-width-1-2">
                                            <div class="parsley-row">
                                                <select onchange="location = this.value;" id="d_form_select_country" data-md-selectize required>
                                                    <option value="">Select Branch...</option>

                                                    @foreach($branch as $value)
                                                        @if($value->id==$id)
                                                            <option value="{{ route('training_index',$value->id) }}" selected>{!! $value->branch_name !!}</option>
                                                        @else
                                                            <option value="{{ route('training_index',$value->id) }}">{!! $value->branch_name !!}</option>
                                                        @endif
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="uk-grid">
                                        <div class="uk-width-1-2">
                                            <div class="parsley-row">
                                                <select id="d_form_select_country" data-md-selectize required>
                                                    @foreach($branch as $value)
                                                        <option value="{{ route('training_index',$value->id) }}" selected disabled>{!! $value->branch_name !!}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                @endif
                            </div>
                        </div>

                        <div class="user_content">
                            <div class="uk-width-medium-1-1" style="text-align: right;">
                                <a class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light md-bg-blue-grey-400" href="{{ route('training_index',['id' => $count]) }}?all">Show All</a>
                                <a class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light md-bg-deep-orange-400" href="{{ route('training_index') }}">Processing</a>
                            </div>
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Date</th>
                                        <th>Pax Id</th>
                                        <th>Number</th>
                                        <th>Center Name</th>
                                        <th>Reference</th>
                                        <th class="uk-text-right">Action</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Date</th>
                                        <th>Pax Id</th>
                                        <th>Number</th>
                                        <th>Center Name</th>
                                        <th>Reference</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </tfoot>

                                   <?php
                                    $i=1;
                                   ?>

                                    <tbody>
                                    @foreach($recruit as $value)
                                            <tr>
                                                <td>{!! $i++ !!}</td>
                                                <td>{!! $value->training['received_date'] !!}</td>
                                                <td>{!! $value->paxid !!}</td>
                                                <td>{!! $value->training['number'] !!}</td>
                                                <td>{!! $value->training['center_name'] !!}</td>
                                                <td>{{ $value->customer['display_name'] }}</td>
                                                <td class="uk-text-right" style="white-space:nowrap !important;">


                                                    @if(count($value->training['trainingFile']))
                                                        <div class="uk-button-dropdown" data-uk-dropdown="{pos:'left-center'}">
                                                            <button class="md-btn">Report File<i class="material-icons">&#xE313;</i></button>
                                                            <div class="uk-dropdown">
                                                                <ul class="uk-nav uk-nav-dropdown">

                                                                    <p title="see below" class="md-bg-green-500" style="text-align: right; padding: 10px; color: white">Download File <i style="color: white" class="material-icons">&#xE2C4;</i></p>



                                                                    @foreach($value->training['trainingFile'] as $file)
                                                                        <li>
                                                                            <a title="open file" style="text-transform: capitalize" target="_blank" href="{{ route('training_file_download',$file->id?$file->id:0) }}">{{ trim($file->title) }}</a>

                                                                        </li>

                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @if($value->id == $value->training['paxid'])

                                                        <a href="{!! route('training_edit',$value->id) !!}" class="batch-edit"><i class="md-icon material-icons uk-margin-right">&#xE254;</i></a>

                                                @else

                                                        <a href="{!! route('training_create',$value->id) !!}" class="batch-edit"><i class="md-icon material-icons uk-margin-right">+</i></a>

                                                @endif
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
        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_fingerprint_index').addClass('act_item');

        $('.delete_btn').click(function () {
            var id = $(this).next('.fingerprint_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "/fingerprint/delete/"+id;
            })
        })

        function deleterow(link) {
            UIkit.modal.confirm('Are you sure?', function(){
                window.location.href = link;
            });
        }

        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_training').addClass('act_item');
        $(window).load(function(){
            $("#tiktok2").trigger('click');
        })
    </script>
@endsection
