@extends('layouts.main')

@section('title', 'Mofa')

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
                    <span class="uk-text-muted uk-text-small">Mofa Ok</span>
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
                    <span class="uk-text-muted uk-text-small">Mofa Left</span>
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
                                <h2 class="heading_b"><span class="uk-text-truncate">Mofa List</span></h2>
                                @if(session('branch_id')==1)
                                    <div class="uk-grid">
                                        <div class="uk-width-1-2">
                                            <div class="parsley-row">
                                                <select onchange="location = this.value;" id="d_form_select_country" data-md-selectize required>
                                                    <option value="">Select Branch...</option>
                                                    @foreach($branch as $value)
                                                        @if($value->id==$id)
                                                            <option value="{{ route('mofa',$value->id) }}" selected>{!! $value->branch_name !!}</option>
                                                        @else
                                                            <option value="{{ route('mofa',$value->id) }}">{!! $value->branch_name !!}</option>
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
                                                        <option value="{{ route('mofa',$value->id) }}" selected disabled>{!! $value->branch_name !!}</option>
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
                                <a class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light md-bg-blue-grey-400" href="{{ route('mofa',['id' => $count]) }}?all">Show All</a>
                                <a class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light md-bg-deep-orange-400" href="{{ route('mofa') }}">Processing</a>
                            </div>
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Pax Id</th>
                                        <th>Mofa Number</th>
                                        <th>Mofa Date</th>
                                        <th>Medical Center Submit Date</th>
                                        <th>Status</th>
                                        <th>Reference</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Pax Id</th>
                                        <th>Mofa Number</th>
                                        <th>Mofa Date</th>
                                        <th>Medical Center Submit Date</th>
                                        <th>Status</th>
                                        <th>Reference</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </tfoot>

                                    <tbody>
                                    @foreach($recruit as $value)

                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $value->paxid }}</td>
                                            <td>{{ $value->mofas['mofaNumber'] }}</td>
                                            <td>{{ $value->mofas['mofaDate'] }}</td>
                                            <td>{{ $value->mofas['medical_submit_date'] }}</td>

                                            @if($value->mofas['status'] == '1')
                                                <td>Ok</td>
                                            @elseif($value->mofas['status'] == '0')
                                                <td>Not ok</td>
                                            @else

                                                <td></td>

                                            @endif
                                            <td>{{ $value->customer['display_name'] }}</td>

                                            <td class="uk-text-right" style="white-space:nowrap !important;">

                                                @if(count($value->mofas['mofa_file']) || count($value->order_file))

                                                    <div class="uk-button-dropdown" data-uk-dropdown="{pos:'left-center'}">
                                                        <button class="md-btn">Mofa File<i class="material-icons">&#xE313;</i></button>
                                                        <div class="uk-dropdown">
                                                            <ul class="uk-nav uk-nav-dropdown">

                                                                <p title="see below" class="md-bg-green-500" style="text-align: right; padding: 10px; color: white">Download File <i style="color: white" class="material-icons">&#xE2C4;</i></p>

                                                                @if(count($value->mofas['mofa_file']))
                                                                <hr/>
                                                                @foreach($value->mofas['mofa_file'] as $file)
                                                                    <li>
                                                                        <a title="open file" style="text-transform: capitalize" target="_blank" href="{{ route('mofa_mofa_download',$file->id?$file->id:0) }}">{{ trim($file->title) }}</a>

                                                                    </li>

                                                                @endforeach
                                                                @endif

                                                                @if(count($value->order_file))
                                                                <hr/>
                                                                @foreach($value->order_file as $file)
                                                                    <li>
                                                                        <a title="open file" style="text-transform: capitalize" target="_blank" href="{{ route('order_download',$file->id?$file->id:0) }}">{{ trim($file->title) }}</a>
                                                                   </li>

                                                                @endforeach
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @endif

                                            @if($value->id==$value->mofas['pax_id'])

                                            <a href="{!! route('mofa_edit',$value->mofas['id']) !!}" class="batch-edit"><i class="md-icon material-icons uk-margin-right">&#xE254;</i></a>

                                            @else

                                           <a href="{!! route('mofa_create',$value->id) !!}" class="batch-edit"><i class="md-icon material-icons uk-margin-right">+</i></a>

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
        $('#sidebar_mofa').addClass('act_item');
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
                window.location.href = "{{ route('mofa_delete') }}"+"/"+id;
            })
        })
    </script>
@endsection
