@extends('layouts.main')

@section('title', 'Account Information Form')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('top_bar')
<div id="top_bar">
    <div class="md-top-bar">
        <ul id="menu_top" class="uk-clearfix">
            <li data-uk-dropdown class="uk-hidden-small">
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Inventory</span></a>
                <div class="uk-dropdown">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li><a href="{{route('inventory_create')}}">Create Inventory</a></li>
                        <li><a href="{{route('inventory')}}">All Inventory</a></li>
                    </ul>
                </div>
            </li>

            <li data-uk-dropdown class="uk-hidden-small">
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Category</span></a>
                <div class="uk-dropdown uk-dropdown-scrollable">
                    <ul class="uk-nav uk-nav-dropdown">
                        {{--<li><a href="{{route('inventory_category_create')}}">Create Category</a></li>--}}
                        <li><a href="{{route('inventory_category')}}">All Category</a></li>
                    </ul>
                </div>
            </li>
            <li data-uk-dropdown class="uk-hidden-small">
                <a href="{{route('stock_create')}}"><i class="material-icons">&#xE02E;</i><span>Add Stock</span></a>
            </li>
        </ul>
    </div>
</div>
@endsection
@section('content')
@if(Session::has('message'))
    <div class="uk-alert uk-alert-success" data-uk-alert="">
        <a href="#" class="uk-alert-close uk-close"></a>
        {{ Session::get('message') }}
    </div>
@endif
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            {!! Form::open(['url' => route('aif_execuitive_update' , $executive->id), 'method' => 'post', 'class' => 'uk-form-stacked', 'id' => 'user_edit_form']) !!}
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Executive Approval</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">

                                    <h3 class="full_width_in_card heading_c">
                                        <span class="">
                                            <label for="sales_information" class="inline-label">
                                                Executive Approval
                                            </label>
                                        </span>
                                    </h3>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-7">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-5">
                                                        <label>Approval:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-5">
                                                    <p>
                                                    <label class="inline-label"><input {{ $executive->signature_of_executive==1? "checked":'' }} type="radio" name="signature_of_executive" value="1" data-md-icheck/>
                                                     Approve</label>
                                                    </p>
                                                    </div>
                                                    <div class="uk-width-medium-1-5">
                                                    <p>
                                                    <label class="inline-label"><input {{ $executive->signature_of_executive==0? "checked":'' }} type="radio" name="signature_of_executive" value="0" data-md-icheck/>
                                                     Dis-Approve</label>
                                                    </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>        
                                    </div>


                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-2">
                                                        <label>Comments:</label>
                                                    </div>
                                                    <div class="uk-width-medium-1-1">
                                                        <textarea class="md-input" name="executive_comment" id="item_about" cols="30" rows="4">{{ $executive->executive_comment?$executive->executive_comment:'' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-right">
                                            <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $('#sidebar_aif_view').addClass('act_item');
        $('#sidebar_main_account').addClass('current_section');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
            $("#aif_tick").trigger('click');
            $("#tiktok5").trigger('click');
        })
    </script>
@endsection