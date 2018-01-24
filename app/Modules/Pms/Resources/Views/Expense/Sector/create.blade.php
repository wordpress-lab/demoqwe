@extends('layouts.main')

@section('title', 'Pms Expense Sector create')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
    <div class="uk-grid">
        <div class="uk-width-large-10-10">
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New Pms Expense Sector</span></h2>
                                <div class="uk-width-medium-1-3">
                                    <div class="md-btn-group">
                                        <a href="{{ route('pms_expense_sector_index') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">All</a>
                                        <a href="{{ route('pms_expense_sector_create') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Add</a>
                                        <a href="{{ URL::previous() }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md-card">
                            {!! Form::open(['url' => route('pms_expense_sector_store'), 'method' => 'POST','files' => false]) !!}
                            <div class="user_content">
                                <div class="uk-margin-top">

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="company_name">Name <i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="name">Name</label>
                                            <input class="md-input" type="text" id="name" name="name" value="{{old('name')}}" />
                                        </div>
                                        @if($errors->first('name'))
                                            <div class="uk-text-danger">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="company_name">Note</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <textarea name="note" cols="30" rows="4" class="md-input no_autosize">{{ old('note')}}</textarea>
                                            @if($errors->has('note'))
                                                <div class="uk-text-danger">{{ $errors->first('note') }}</div>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="uk-grid uk-ma" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-left">
                                            <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script>
        $('#sidebar_pms').addClass('current_section');
        $('#sidebar_pms_expense_list').addClass('act_item');
        $(window).load(function(){
            $("#pms_tiktok").trigger('click');
            $("#pms_expense_tiktok").trigger('click');
        })
    </script>
    <script src="{{ asset("admin/assets/js/pages/redeyeCustom.js") }}"></script>
@endsection