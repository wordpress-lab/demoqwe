@extends('layouts.main')

@section('title', 'Medicals Slip Report')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
<div class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-4 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-grid-margin="" data-uk-sortable="" style="text-align: center;">

    <div>
        <div class="md-card">
            <div class="md-card-content">
                <div class="uk-float-right uk-margin-top uk-margin-small-right">
                    <span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span>
                </div>

                <a href="javascript::void(0);">
                    <h2 class="uk-margin-remove"><span class="countUpMe"></span> {{ $fit }}</h2>
                    <span class="uk-text-muted uk-text-small">Fit</span>
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
                    <h2 class="uk-margin-remove"><span class="countUpMe"></span> {{ $unfit }}</h2>
                    <span class="uk-text-muted uk-text-small">Unfit</span>
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
                    <h2 class="uk-margin-remove"><span class="countUpMe"></span> {{ $visit_date }}</h2>
                    <span class="uk-text-muted uk-text-small">Next Visit Date</span>
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
                                <h2 class="heading_b"><span class="uk-text-truncate">Medical Report</span></h2>
                                @if(session('branch_id')==1)
                                    <div class="uk-grid">
                                        <div class="uk-width-1-2">
                                            <div class="parsley-row">
                                                <select onchange="location = this.value;" id="d_form_select_country" data-md-selectize required>
                                                    <option value="">Select Branch...</option>

                                                    @foreach($branch as $value)
                                                        @if($value->id==$id)
                                                            <option value="{{ route('medicalslip',$value->id) }}" selected>{!! $value->branch_name !!}</option>
                                                        @else
                                                            <option value="{{ route('medicalslip',$value->id) }}">{!! $value->branch_name !!}</option>
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
                                                        <option value="{{ route('medicalslip',$value->id) }}" selected disabled>{!! $value->branch_name !!}</option>
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
                                <a class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light md-bg-blue-grey-400" href="{{ route('medicalslip',['id' => $count]) }}?all">Show All</a>
                                <a class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light md-bg-deep-orange-400" href="{{ route('medicalslip') }}">Processing</a>
                            </div>
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Pax ID</th>
                                        <th>Medical Date</th>
                                        <th>Status</th>
                                        <th>Medical Report Date</th>
                                        <th>Reference</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Pax ID</th>
                                        <th>Medical Date</th>
                                        <th>Status</th>
                                        <th>Medical Report Date</th>
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
                                            <td>{!! $value->paxid !!}</td>
                                            <td>{!! $value->medical_slip['medical_date'] !!}</td>
                                            @if($value->medical_slip['status']=='1')
                                                <td>Fit</td>
                                            @elseif($value->medical_slip['status']=='0')
                                                <td>Unfit</td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td>{!! $value->medical_slip['medical_report_date']  !!}</td>
                                            <td>{{ $value->customer['display_name'] }}</td>
                                            <td class="uk-text-right" style="white-space:nowrap !important;">
                                                {{--@if($value->report_file->count())--}}
                                                    {{--<div class="uk-button-dropdown" data-uk-dropdown="{pos:'left-center'}">--}}
                                                        {{--<button class="md-btn">Report File<i class="material-icons">&#xE313;</i></button>--}}
                                                        {{--<div class="uk-dropdown">--}}
                                                            {{--<ul class="uk-nav uk-nav-dropdown">--}}

                                                                {{--<p title="see below" class="md-bg-green-500" style="text-align: right; padding: 10px; color: white">Download File <i style="color: white" class="material-icons">&#xE2C4;</i></p>--}}



                                                                {{--@foreach($value->report_file as $file)--}}
                                                                    {{--<li>--}}
                                                                        {{--<a title="open file" style="text-transform: capitalize" target="_blank" href="{{ route('medicalslip_file_download',$file->id?$file->id:0) }}">{{ trim($file->title) }}</a>--}}

                                                                    {{--</li>--}}

                                                                {{--@endforeach--}}
                                                            {{--</ul>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--@endif--}}

                                            @if($value->id==$value->medical_slip['pax_id'])
                                            <a href="{!! route('medicalslip_edit',$value->medical_slip['id']) !!}" class="batch-edit"><i class="md-icon material-icons uk-margin-right">&#xE254;</i></a>

                                            @else
                                             <a href="{!! route('medicalslip_create',$value->id) !!}" class="batch-edit"><i class="md-icon material-icons uk-margin-right">+</i></a>
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
        $('#sidebar_medical_report').addClass('act_item');
        $(window).load(function(){
            $("#tiktok2").trigger('click');
        })
    </script>
@endsection

