@extends('layouts.admin')

@section('title', 'Report')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('content')

         <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
                <div class="uk-width-large-10-10">
                    <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                         @include('inc.customer_nav')



                    </div>
                </div>
            </div>

@endsection
@section('scripts')
    <!-- handlebars.js -->
    <script src="{{ url('admin/bower_components/handlebars/handlebars.min.js')}}"></script>
    <script src="{{ url('admin/assets/js/custom/handlebars_helpers.min.js')}}"></script>


@endsection