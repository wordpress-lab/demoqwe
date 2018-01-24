@extends('layouts.main')

@section('title', 'System Mails')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
    @if(Session::has('msg'))
        <div class="uk-alert uk-alert-success" data-uk-alert>
            <a href="#" class="uk-alert-close uk-close"></a>
            {!! Session::get('msg') !!}
        </div>
    @endif
    @if(Session::has('update'))
        <div class="uk-alert uk-alert-success" data-uk-alert>
            <a href="#" class="uk-alert-close uk-close"></a>
            {!! Session::get('update') !!}
        </div>
    @endif
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <div class="uk-grid" data-uk-grid-margin>

                <div class="uk-width-large-10-10">
                    <div class="md-card">

                        <div  class="uk-sticky-placeholder" style="height: 81px; margin: 0px;"><div id="page_heading" data-uk-sticky="{ top: 10, media: 960 }" class="uk-sticky-init md-bg-light-blue-900" style="margin: 0px;">
                                <div style="float: right" class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="true"> <a href="#" data-uk-modal="{target:'#coustom_setting_modal'}">
                                        <i  class="md-color-blue-grey-50 material-icons">date_range</i><span  class="md-color-blue-grey-50">Custom Date</span></a>

                                </div>
                                <!--coustorm setting modal start -->
                                <div class="uk-modal" id="coustom_setting_modal">
                                    <div class="uk-modal-dialog">
                                        {!! Form::open(['url' => 'ticket/order/sendmail/show', 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}
                                        <div class="uk-modal-header">
                                            <h3 class="uk-modal-title">Select Date Range  <i class="material-icons" data-uk-tooltip="{pos:'top'}" title="headline tooltip">&#xE8FD;</i></h3>
                                        </div>

                                        <div class="uk-width-large-2-2 uk-width-2-2">
                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                    <label for="uk_dp_1">Form</label>
                                                    <input required class="md-input" type="text" id="uk_dp_1" name="from_date" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                                </div>
                                            </div>
                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                    <label for="uk_dp_1">To</label>
                                                    <input required class="md-input" type="text" id="uk_dp_1" name="to_date" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="uk-modal-footer uk-text-right">
                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                            <button type="submit" name="submit" class="md-btn md-btn-flat md-btn-flat-primary">Search</button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                <h2 class="heading_b"><span style="color: white">System Mails</span></h2>

                            </div></div>


                        <div class="user_content">
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="text-align: center; padding: 1px; line-height: 2px">
                                    <h2>System Mails</h2>
                                    <p>From {{ $start }} to {{ $end }}</p>

                                </div>
                                <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                    <thead>
                                    <tr>

                                        <th>Date</th>
                                        <th>Sent To</th>
                                        <th>Subject</th>
                                        <th>Details</th>
                                        <th>Attachment</th>
                                        <th>Sent By</th>

                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>

                                        <th>Date</th>
                                        <th>Sent To</th>
                                        <th>Subject</th>
                                        <th>Details</th>
                                        <th>Attachment</th>


                                        <th>Sent By</th>


                                    </tr>
                                    </tfoot>

                                    <tbody>

                                    @foreach($email as $value)
                                        <tr>
                                            <td>{{ date('d-m-Y',strtotime($value->created_at)) }}</td>
                                            <td>{{ $value->to }}</td>
                                            <td>{{ str_limit($value->subject,20) }}</td>
                                            <td>{{ str_limit($value->details,15) }}</td>
                                            <td class="uk-text-middle">
                                                {{--<a href="{!! url('path') !!}/{!! $value->file !!}">Open the pdf!</a>--}}
                                                <a href="{{ route('send_mail_show_per_id',['id' => $value->id]) }}"><i class="material-icons">&#xE415;</i></a>
                                            </td>
                                            <td>{{ $value->createdBy->name }}</td>





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

    <script type="text/javascript">
        $('#settings_menu_taxes').addClass('md-list-item-active');
    </script>
@endsection


