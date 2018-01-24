@extends('layouts.main')

@section('title', 'Submission')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
<div class="uk-grid uk-grid-width-large-1-3 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-grid-margin="" data-uk-sortable="" style="text-align: center;">

    <div>
        <div class="md-card">
            <div class="md-card-content">
                <div class="uk-float-right uk-margin-top uk-margin-small-right">
                    <span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span>
                </div>

                <a href="javascript::void(0);">
                    <h2 class="uk-margin-remove"><span class="countUpMe"></span> {{ $flight_date }}</h2>
                    <span class="uk-text-muted uk-text-small">Expected Flight Date</span>
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
                    <h2 class="uk-margin-remove"><span class="countUpMe"></span> {{ $owner_approve }}</h2>
                    <span class="uk-text-muted uk-text-small">Owner Approved</span>
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
                                <h2 class="heading_b"><span class="uk-text-truncate">Submission List</span></h2>
                                @if(session('branch_id')==1)
                                    <div class="uk-grid">
                                        <div class="uk-width-1-2">
                                            <div class="parsley-row">
                                                <select onchange="location = this.value;" id="d_form_select_country" data-md-selectize required>
                                                    <option value="">Select Branch...</option>
                                                    @foreach($branch as $value)
                                                        @if($value->id==$id)
                                                            <option value="{{ route('submission',$value->id) }}" selected>{!! $value->branch_name !!}</option>
                                                        @else
                                                            <option value="{{ route('submission',$value->id) }}">{!! $value->branch_name !!}</option>
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
                                                        <option value="{{ route('submission',$value->id) }}" selected disabled>{!! $value->branch_name !!}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                @endif
                            </div>
                        </div>

                        @php
                            $i=1;
                        @endphp

                        <div class="user_content">
                            <div class="uk-width-medium-1-1" style="text-align: right;">
                                <a class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light md-bg-blue-grey-400" href="{{ route('submission',['id' => $count]) }}?all">Show All</a>
                                <a class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light md-bg-deep-orange-400" href="{{ route('submission') }}">Processing</a>
                            </div>
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Pax Id</th>
                                        <th>Submission Date</th>
                                        <th>Expected Flight Date</th>
                                        <th>Due-Amount</th>
                                        <th>Reference</th>
                                        <th class="uk-text-center">Action</th>
                                        <th class="uk-text-center">Owner Approval</th>
                                        <th class="uk-text-center">Ticket Approval</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Pax Id</th>
                                        <th>Submission Date</th>
                                        <th>Expected Flight Date</th>
                                        <th>Due-Amount</th>
                                        <th>Reference</th>
                                        <th class="uk-text-center">Action</th>
                                        <th class="uk-text-center">Owner Approval</th>
                                        <th class="uk-text-center">Ticket Approval</th>
                                    </tr>
                                    </tfoot>

                                    <tbody>
                                    @foreach($recruit as $value)

                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $value->paxid }}</td>
                                            <td>{{ $value->submission['submission_date'] }}</td>
                                            <td>{{ $value->submission['expected_flight_date'] }}</td>
                                            <td>{{ $value->invoice['due_amount'] }}</td>
                                            <td>{{ $value->customer['display_name'] }}</td>
                                            <td class="uk-text-right" style="white-space:nowrap !important;">

                                                <!-- @if(count($value->submission['submition_file']))
                                                    <div class="uk-button-dropdown" data-uk-dropdown="{pos:'left-center'}">
                                                        <button class="md-btn">Report File<i class="material-icons">&#xE313;</i></button>
                                                        <div class="uk-dropdown">
                                                            <ul class="uk-nav uk-nav-dropdown">

                                                                <p title="see below" class="md-bg-green-500" style="text-align: right; padding: 10px; color: white">Download File <i style="color: white" class="material-icons">&#xE2C4;</i></p>


                                                                <hr/>
                                                                @foreach($value->submission['submition_file'] as $file)
                                                                    <li>
                                                                        <a title="open file" style="text-transform: capitalize" target="_blank" href="{{ route('submission_file_download',$file->id?$file->id:0) }}">{{ trim($file->title) }}</a>

                                                                    </li>

                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @endif -->

                                                @if($value->order_file->count())
                                                <div class="uk-button-dropdown" data-uk-dropdown="{pos:'left-center'}">
                                                    <button class="md-btn">Order File<i class="material-icons">&#xE313;</i></button>
                                                    <div class="uk-dropdown">
                                                        <ul class="uk-nav uk-nav-dropdown">

                                                                <p title="see below" class="md-bg-green-500" style="text-align: right; padding: 10px; color: white">Download File <i style="color: white" class="material-icons">&#xE2C4;</i></p>


                                                            <hr/>
                                                            @foreach($value->order_file as $file)
                                                                <li>
                                                                    <a title="open file" style="text-transform: capitalize" target="_blank" href="{{ route('order_download',$file->id?$file->id:0) }}">{{ trim($file->title) }}</a>

                                                               </li>

                                                                @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                                @endif
                                            @if($value->id==$value->submission['pax_id'])

                                                @if($value->newflight)
                                                <a title="flight pdf" href="{!! route('flight_card_pdf',$value->id) !!}" class="batch-edit"><i class="material-icons">&#xE415;</i></a>
                                                @endif
                                                <a href="{!! route('submission_edit',$value->submission['id']) !!}" class="batch-edit"><i class="md-icon material-icons uk-margin-right">&#xE254;</i></a>

                                            @else
                                                @if($value->newflight)
                                                <a title="flight pdf" href="{!! route('flight_card_pdf',$value->id) !!}" class="batch-edit"><i class="material-icons">&#xE415;</i></a>
                                                @endif
                                                <a href="{!! route('submission_create',$value->id) !!}" class="batch-edit"><i class="md-icon material-icons uk-margin-right">+</i></a>

                                            @endif
                                            </td>


                                            <td class="uk-text-center">
                                                @if($value["owner_approval"]==1)
                                                <a href="{!! route('owner_approval',$value->id) !!}" class="batch-edit"><i class="material-icons" style="font-size: 30px;color: green">&#xE913;</i></a>
                                                @elseif($value["owner_approval"]==null)
                                                <a href="{!! route('owner_approval',$value->id) !!}" class="batch-edit"><i class="material-icons" style="font-size: 30px;color: #555555; ">&#xE913;</i></a>
                                                @elseif($value["owner_approval"]==0)
                                                <a href="{!! route('owner_approval',$value->id) !!}" class="batch-edit"><i class="material-icons" style="font-size: 30px;color: red">&#xE913;</i></a>
                                                @endif
                                            </td>

                                            <td class="uk-text-center">
                                                @if($value->submission["ticket_approval"]=="1")
                                                <a href="{!! route('ticket_approval',$value->id) !!}" class="batch-edit"><i class="material-icons" style="font-size: 30px;color: green">&#xE913;</i></a>
                                                @elseif($value->submission["ticket_approval"]=="0")
                                                <a href="{!! route('ticket_approval',$value->id) !!}" class="batch-edit"><i class="material-icons" style="font-size: 30px;color: red">&#xE913;</i></a>
                                                @else
                                               <a href="{!! route('ticket_approval',$value->id) !!}" class="batch-edit"><i class="material-icons" style="font-size: 30px;color: #555555; ">&#xE913;</i></a>
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
        $('#sidebar_submission').addClass('act_item');
        $(window).load(function(){
            $("#tiktok2").trigger('click');
        })

        $('.delete_btn').click(function () {
            var id = $(this).next('.mofa_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "{{ route('fit_card_delete') }}"+"/"+id;
            })
        })
    </script>
@endsection
