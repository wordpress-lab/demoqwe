@extends('layouts.main')

@section('title', 'Select Agent || Sales Commission')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('top_bar')
    <div id="top_bar">

    </div>
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
                                <h2 class="heading_b"><span class="uk-text-truncate">Select Agent</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="item_purchase_rate">Agent</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <select onchange="location = this.value;" class="md-input" data-md-selectize data-uk-tooltip="{pos:'top'}" title="Select with Agent">
                                            <option value="" disabled selected hidden>Select Agent</option>
                                          @foreach($agent as $value)
                                            <option value="{{ route('sales_commission_create',$value->id) }}">{{ $value->display_name }}</option>
                                          @endforeach
                                        </select>
                                    </div>
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
    <script type="text/javascript">

        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_sales_commission').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        });

    </script>
@endsection