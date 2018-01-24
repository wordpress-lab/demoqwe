@extends('layouts.main')

@section('title', 'Reception Category')

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
                        {{--<li><a href="{{route('inventory_category_create')}}">Edit Category</a></li>--}}
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
            {!! Form::open(['url' => route('reception_category_update' , $category->id), 'method' => 'post', 'class' => 'uk-form-stacked', 'id' => 'user_edit_form' , 'onsubmit' => 'return valid();']) !!}
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Create Reception Category</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Name</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label>Enter Name</label>
                                        <input type="text" name="name" class="md-input uk-form-width-large" id="name" value="{{ $category->name }}"/>
                                        <span style="color:red; position: relative;" id="msg">
                                        {{ $errors->has('name')?$errors->first('name'):'' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Summary Details</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label>Summary</label>
                                        <textarea cols="30" rows="4" class="md-input" name="summary">{{ $category->summary }}</textarea>
                                    </div>
                                </div>

                                <div class="uk-grid">
                                    <div class="uk-width-1-1">
                                        <button type="submit" href="#" class="md-btn md-btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <!-- google web fonts -->
@endsection
@section('scripts')
    <script type="text/javascript">
        $('#sidebar_hrm').addClass('current_section');
        $('#sidebar_hrm_view').addClass('act_item');

        $(window).load(function(){
            $("#tiktok6").trigger('click');
        })
    </script>

    <script type="text/javascript">
        function valid(){
            var input = document.getElementById('name').value;
            
            if(input == ""){
                document.getElementById('msg').innerHTML = "The name field is required.";
                return false;
            }
        }
    </script>
@endsection