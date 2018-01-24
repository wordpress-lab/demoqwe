@extends('layouts.main')

@section('title', 'Visa Creation')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
<div class="uk-grid uk-grid-width-large-1-3 uk-grid-width-medium-1-3 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-grid-margin="" data-uk-sortable="" style="text-align: center;">

    <div>
        <div class="md-card">
            <div class="md-card-content">
                <div class="uk-float-right uk-margin-top uk-margin-small-right">
                    <span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span>
                </div>

                <a href="javascript::void(0);">
                    <h2 class="uk-margin-remove"><span class="countUpMe"></span> {{ $total_visa }}</h2>
                    <span class="uk-text-muted uk-text-small">Total Visa</span>
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
                    <h2 class="uk-margin-remove"><span class="countUpMe"></span> {{ $assigned_visa }}</h2>
                    <span class="uk-text-muted uk-text-small">Assigned Visa</span>
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
                                <h2 class="heading_b"><span class="uk-text-truncate">Visa List</span></h2>
                                @if(session('branch_id')==1)
                                    <div class="uk-grid">
                                        <div class="uk-width-1-2">
                                            <div class="parsley-row">
                                                <select onchange="location = this.value;" id="d_form_select_country" data-md-selectize required>
                                                    <option value="">Select Branch...</option>

                                                    @foreach($branch as $value)
                                                        @if($value->id==$id)
                                                            <option value="{{ route('visa',$value->id) }}" selected>{!! $value->branch_name !!}</option>
                                                        @else
                                                            <option value="{{ route('visa',$value->id) }}">{!! $value->branch_name !!}</option>
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
                                                        <option value="{{ route('visa',$value->id) }}" selected disabled>{!! $value->branch_name !!}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                @endif
                                <a href="{!! route('company_index') !!}" style="margin-top: -40px" class="heading_b pull-right btn btn-success">All Companies</a>

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
                                        <th>Date</th>
                                        <th>Ref#</th>
                                        <th>VisaNum</th>
                                        <th>Company</th>
                                        <th>NumOfVisa</th>
                                        <th>leftVisa</th>
                                        <th>RegSerial</th>
                                        <th>IdNum</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Ref#</th>
                                        <th>VisaNum</th>
                                        <th>Company</th>
                                        <th>NumOfVisa</th>
                                        <th>leftVisa</th>
                                        <th>RegSerial</th>
                                        <th>idNum</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </tfoot>

                                    <tbody>
                                    @foreach($visa as $value)

                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td style="white-space:nowrap !important;">{{ $value->date }}</td>
                                            <td>{{ $value->Contact['display_name'] }}</td>
                                            <td>{{ $value->visaNumber }}</td>
                                            <td>{{ $value->Company['name'] }}</td>
                                            <td>{{ $value->numberofVisa }}</td>
                                            <td>{{ $value->left_visa }}</td>
                                            <td>{{ $value->registerSerial }}</td>
                                            <td>{{ $value->idNum }}</td>
                                            <td class="uk-text-right" style="white-space:nowrap !important;">

                                                @if( count($value->visaentryfile))
                                                    <div class="uk-button-dropdown" data-uk-dropdown="{pos:'left-center'}">
                                                        <button class="md-btn">Report File<i class="material-icons">&#xE313;</i></button>
                                                        <div class="uk-dropdown">
                                                            <ul class="uk-nav uk-nav-dropdown">

                                                                <p title="see below" class="md-bg-green-500" style="text-align: right; padding: 10px; color: white">Download File <i style="color: white" class="material-icons">&#xE2C4;</i></p>


                                                                <hr/>
                                                                @foreach($value->visaentryfile as $file)
                                                                    <li>
                                                                        <a title="open file" style="text-transform: capitalize" target="_blank" href="{{ route('visa_order_file_download',$file->id?$file->id:0) }}">{{ trim($file->title) }}</a>

                                                                    </li>

                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @endif

                                                <a href="{{ route('visa_edit', ['id' => $value->id]) }}">
                                                    <i data-uk-tooltip="{pos:'top'}" title="Edit" style="font-size: 23px;" class="material-icons">&#xE254;</i>
                                                </a>
                                                <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="material-icons">&#xE872;</i></a>
                                                <input type="hidden" class="visa_id" value="{{ $value->id }}">

                                            </td>
                                        </tr>

                                    @endforeach


                                    </tbody>
                                </table>
                            </div>
                            <!-- Add branch plus sign -->

                            <div class="md-fab-wrapper branch-create">
                                <a id="add_branch_button" href="{{ route('visa_create') }}" class="md-fab md-fab-accent branch-create">
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
        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_recrut_visa').addClass('act_item');
        $('.delete_btn').click(function () {
            var id = $(this).next('.visa_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "{{ route('visa_delete') }}"+"/"+id;
            })
        })
    </script>
@endsection
