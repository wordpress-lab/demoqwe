@extends('layouts.admin')

@section('title', 'All Visa Stamp')

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
                    <h2 class="uk-margin-remove"><span class="countUpMe"></span> {{ $total_sent }}</h2>
                    <span class="uk-text-muted uk-text-small">Total Sent</span>
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
                    <h2 class="uk-margin-remove"><span class="countUpMe"></span> {{ $total_returned }}</h2>
                    <span class="uk-text-muted uk-text-small">Total Returned</span>
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
                    <span class="uk-text-muted uk-text-small">Total Left</span>
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
                                <h2 class="heading_b"><span class="uk-text-truncate">Visa Stamp List</span></h2>
                                @if(session('branch_id')==1)
                                    <div class="uk-grid">
                                        <div class="uk-width-1-2">
                                            <div class="parsley-row">
                                                <select onchange="location = this.value;" id="d_form_select_country" data-md-selectize required>
                                                    <option value="">Select Branch...</option>

                                                    @foreach($branch as $value)
                                                        @if($value->id==$id)
                                                            <option value="{{ route('visastamp',$value->id) }}" selected>{!! $value->branch_name !!}</option>
                                                        @else
                                                            <option value="{{ route('visastamp',$value->id) }}">{!! $value->branch_name !!}</option>
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
                                                        <option value="{{ route('visastamp',$value->id) }}" selected disabled>{!! $value->branch_name !!}</option>
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
                                <a class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light md-bg-blue-grey-400" href="{{ route('visastamp',['id' => $count]) }}?all">Show All</a>
                                <a class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light md-bg-deep-orange-400" href="{{ route('visastamp') }}">Processing</a>
                            </div>
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Sending Date</th>
                                        <th>Returning Date</th>
                                        <th>Pax Id</th>
                                        <th>Comment</th>
                                        <th>Reference</th>
                                        <th class="uk-text-center">Action</th>
                                        <th class="uk-text-center">Visa Form</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Sending Date</th>
                                        <th>Returing Date</th>
                                        <th>Pax Id</th>
                                        <th>Comment</th>
                                        <th>Reference</th>
                                        <th class="uk-text-center">Action</th>
                                        <th class="uk-text-center">Visa Form</th>
                                    </tr>
                                    </tfoot>

                                    <?php
                                    $i=1;
                                    ?>

                                    <tbody>
                                    @foreach($recruit as $value)
                                        <tr>
                                            <td>{!! $i++ !!}</td>
                                            <td>{!! $value->visas['send_date'] !!}</td>
                                            <td>{!! $value->visas['return_date'] !!}</td>
                                            <td>{!! $value->paxid !!}</td>
                                            <td>{!! $value->visas['comment']!!}</td>
                                            <td>{{ $value->customer['display_name'] }}</td>
                                            <td class="uk-text-right" style="white-space:nowrap !important;">

                                                @if(count($value->visa))
                                                    <div class="uk-button-dropdown" data-uk-dropdown="{pos:'left-center'}">
                                                        <button class="md-btn">Report File<i class="material-icons">&#xE313;</i></button>
                                                        <div class="uk-dropdown">
                                                            <ul class="uk-nav uk-nav-dropdown">

                                                                <p title="see below" class="md-bg-green-500" style="text-align: right; padding: 10px; color: white">Download File <i style="color: white" class="material-icons">&#xE2C4;</i></p>

                                                                <hr/>

                                                                <li>
                                                                    <a title="open file" style="text-transform: capitalize" target="_blank" href="{{ route('visa_stamp_download',$value->visa['id']?$value->visa['id']:0) }}">{{ trim($value->visa['eapplication_no']) }}</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @endif

                                            @if($value->id==$value->visas['pax_id'])

                                                    <a title="Edit" href="{!! route('visastamp_edit',$value->id) !!}" class="batch-edit"><i class="material-icons">&#xE254;</i></a>


                                                    @if($value->visas['return_date']!=null)

                                                            @if($value->invoice_id==null)
                                                            <a href="{{ route('order_invoice_show', ['id' => $value->invoice_id?$value->invoice_id:0,'order'=>$value->id]) }}">
                                                                <i data-uk-tooltip="{pos:'top'}" title="Invoice" class="material-icons" style="font-size: 30px;color: darkgray; font-weight: bold;">I</i>
                                                            </a>
                                                            @else
                                                            <a href="{{ route('order_invoice_show', ['id' => $value->invoice_id?$value->invoice_id:0,'order'=>$value->id]) }}">
                                                                    <i data-uk-tooltip="{pos:'top'}" title="Invoice" class="material-icons" style="font-size: 30px;color: darkgreen; font-weight: bold;">I</i>
                                                            </a>
                                                            @endif

                                                            @if($value->bill_id==null)
                                                                <a href="{{ route('visa_stamp_bill_create', ['id' => $value->bill_id?$value->bill_id:0,'order'=>$value->id]) }}">
                                                                    <i data-uk-tooltip="{pos:'top'}" title="Bill" class="material-icons" style="font-size: 30px;color: darkgray; font-weight: bold;">B</i>
                                                                </a>
                                                            @else
                                                                <a href="{{ route('visa_stamp_bill_show', ['id' => $value->bill_id?$value->bill_id:0,'order'=>$value->id]) }}">
                                                                    <i data-uk-tooltip="{pos:'top'}" title="Bill" class="material-icons" style="font-size: 30px;font-weight: bold; color: {{ $value->bill_id?"darkgreen":"darkgray" }}">B</i>
                                                                </a>
                                                            @endif

                                                    @endif

                                            @endif
                                            </td>
                                            <td class="uk-text-center">
                                                @if($value->visaForm)
                                                    <a href="{{ route('visaform_agreement_paper', ['id' => $value->visaForm['id']]) }}">
                                                        <i data-uk-tooltip="{pos:'top'}" title="Paper"   class="md-icon material-icons">layers</i>
                                                    </a>

                                                    <a href="{{ route('visaform_work_agreement', ['id' => $value->visaForm['id']]) }}">
                                                        <i data-uk-tooltip="{pos:'top'}" title="Work Agreement"   class="md-icon material-icons">local_library</i>
                                                    </a>

                                                    <a href="{{ route('visaform_print', ['id' => $value->visaForm['id']]) }}">
                                                        <i data-uk-tooltip="{pos:'top'}" title="Print"  class="md-icon material-icons" style="font-size: 20px;">&#xE8AD;</i>
                                                    </a>

                                                    <a href="{{ route('visaform_edit', ['id' => $value->visaForm['id']]) }}">
                                                        <i data-uk-tooltip="{pos:'top'}" title="Visa Form Edit" class="md-icon material-icons" style="font-size: 20px;">border_color</i>
                                                    </a>

                                                    <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Visa Form Delete" class="md-icon material-icons" style="font-size: 20px;">&#xE872;</i></a>
                                                    <input type="hidden" class="visaform_id" value="{{ $value->visaForm['id'] }}">
                                                @else
                                                    <a href="{{ route('visaform_create', ['id' => $value->id]) }}">
                                                        <i data-uk-tooltip="{pos:'top'}" title="Visa Form Add"   class="md-icon material-icons">add_circle_outline</i>
                                                    </a>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Add branch plus sign -->
                            <div class="md-fab-wrapper branch-create">
                                <a id="add_branch_button" href="{{ route('visastamp_create') }}" class="md-fab md-fab-accent branch-create">
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
        $('#visa_stamp_to').addClass('act_item');

        function deleterow(link) {
            UIkit.modal.confirm('Are you sure?', function(){
                window.location.href = link;
            });
        }

        $('.delete_btn').click(function () {
            var id = $(this).next('.visaform_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                if(id){
                    window.location.href = "{{ route('visaform_destroy') }}"+"/"+id;
                }else {
                    window.location.href = "{{ route('visaform_destroy') }}"+"/"+"%00";
                }

            })
        })
        
    </script>

@endsection
