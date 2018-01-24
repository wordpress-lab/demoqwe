@extends('layouts.main')

@section('title', 'Medical Slip')

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
                    <span class="uk-text-muted uk-text-small">Applied Pax</span>
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
                    <span class="uk-text-muted uk-text-small"> Application Left</span>
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
                                <h2 class="heading_b"><span class="uk-text-truncate">Medical Slip</span></h2>
                            </div>
                        </div>

                        <div class="user_content">
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Application Date</th>
                                        <th>Pax Id</th>
                                        <th>Passport Sent</th>
                                        <th>Passport Returned</th>
                                        <th class="uk-text-right">Action</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Application Date</th>
                                        <th>Pax Id</th>
                                        <th>Passport Sent</th>
                                        <th>Passport Returned</th>
                                        <th class="uk-text-right">Action</th>
                                    </tr>
                                    </tfoot>

                                    <?php
//                                        $d=new \App\Lib\Helpers;
                                     $sl = 0;
                                    ?>

                                    <tbody>
                                    @foreach($basis as $value)
                                            <tr>
                                                <td>{!! ++$sl !!}</td>
                                                <td>{!! $value->dateOfApplication  !!}</td>
                                                <td>
                                                    <?php $k=0; ?>
                                                    @foreach($value->medicalslipFromPax as $item)
                                                        @if($k>0), @endif
                                                        {!! $item->paxid !!}
                                                        <?php $k++; ?>
                                                    @endforeach

                                                </td>

                                                <td>

                                                    <div>
                                                        <?php $i=0; ?>
                                                        @foreach($value->gamca_received_submit as $item)

                                                            @if($item->received_status)
                                                                    @if($i>0), @endif
                                                                <span title="{{ $item->created_at }}">  {!! $item->medicalslipFromPax['paxid'] !!} </span>
                                                                    <?php $i++; ?>
                                                            @endif

                                                        @endforeach
                                                    </div>

                                                </td>

                                                <td>
                                                    
                                                    <?php $j=0; ?>
                                                    @foreach($value->gamca_received_submit as $item)

                                                        @if($item->submitted_status)
                                                                @if($j>0),@endif

                                                            {!! $item->medicalslipFromPax['paxid'] !!}
                                                        @endif
                                                            <?php $j++ ?>
                                                    @endforeach
                                                </td>

                                                <td class="uk-text-right" style="white-space:nowrap !important;">

                                                    @if($value->gamca_file->count())
                                                        <div class="uk-button-dropdown" data-uk-dropdown="{pos:'left-center'}">
                                                            <button class="md-btn">Gamca File<i class="material-icons">&#xE313;</i></button>
                                                            <div class="uk-dropdown">
                                                                <ul class="uk-nav uk-nav-dropdown">
                                                                    <p title="see below" class="md-bg-green-500" style="text-align: right; padding: 10px; color: white">Download File <i style="color: white" class="material-icons">&#xE2C4;</i></p>
                                                                    <hr/>
                                                                    @foreach($value->gamca_file as $file)
                                                                        <li>
                                                                            <a title="open file" style="text-transform: capitalize" target="_blank" href="{{ route('gamca_download',$file->id?$file->id:0) }}">{{ trim($file->title) }}</a>

                                                                        </li>

                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <a href="{!! route('medical_slip_form_download',$value->id) !!}" class="batch-edit"><i class="material-icons">file_download</i></a>
                                                    <a href="{!! route('medical_slip_form_edit',$value->id) !!}" class="batch-edit"><i class=" material-icons">&#xE254;</i></a>
                                                    <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="material-icons">&#xE872;</i></a>
                                                    <input type="hidden" class="form_medical_id" value="{{ $value->id }}">
                                                </td>
                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Add branch plus sign -->

                            <div class="md-fab-wrapper branch-create">
                                <a id="add_branch_button" href="{!! route('medical_slip_form_create') !!}" class="md-fab md-fab-accent branch-create">
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
            var id = $(this).next('.form_medical_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "{!! route('medical_slip_form_delete') !!}"+"/"+id;
            })
        })

        function deleterow(link) {
            UIkit.modal.confirm('Are you sure?', function(){
                window.location.href = link;
            });
        }
    </script>
    <script type="text/javascript">
        // $(window).load(function(){
        //     $("#sidebar_hrmbb").trigger('click');
        // })
        // $('#sidebar_recruit').addClass('current_section');
        // $('#sidebar_hrmbb').addClass('act_item');

        $('#sidebar_recruit').addClass('current_section');

        $('#medical_slip_form_indexsss').addClass('act_item');

        $(window).load(function(){
            $("#tiktok2").trigger('click');
        })

    </script>
@endsection
