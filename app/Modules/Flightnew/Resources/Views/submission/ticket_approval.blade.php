@extends('layouts.main')

@section('title', 'Ticket Approval')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
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
                                <h2 class="heading_b"><span class="uk-text-truncate">Ticket Approval</span></h2>

                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" style="padding-top: 50px">
                        <div class="uk-width-1-1">
                            <div class="uk-grid uk-grid-width-1-1 uk-grid-width-large-1-2" data-uk-grid-margin>
                                <div>
                                    <a href="{!! route('ticket_approval_confirm',$recruit['id']) !!}" class="md-btn md-btn-facebook md-btn-large md-btn-block md-btn-icon"><i class="material-icons">&#xE876;</i>Yes</a>
                                </div>
                                <div>
                                    <a href="{!! route('ticket_approval_not_confirm',$recruit['id']) !!}" class="md-btn md-btn-gplus md-btn-large md-btn-block md-btn-icon"><i class="material-icons">&#xE14C;</i>No</a>
                                </div>
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

    </script>
@endsection
