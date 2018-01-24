@extends('layouts.main')

@section('title', 'Update Ticket Tax')

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

                <div class="uk-width-xLarge-10-10  uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate"> Update Ticket Tax</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                {!! Form::open(['url' => route('ticket_tax_update',$tax->id), 'method' => 'POST', 'files' => true]) !!}
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="name" class="uk-vertical-align-middle">Title</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="title">Title</label>
                                        <input class="md-input" type="text" id="title" name="title" value="{{ $tax->title }}"/>
                                        @if($errors->first('title'))
                                            <div class="uk-text-danger">Title is required.</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="contact" class="uk-vertical-align-middle">Amount</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="amount">Amount</label>
                                        <input class="md-input" type="text" id="amount" name="amount" value="{{ $tax->amount }}"/>
                                        @if($errors->first('amount'))
                                            <div class="uk-text-danger">Amount is required.</div>
                                        @endif
                                    </div>


                                </div>




                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-5 uk-vertical-align">

                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <div class="uk-width-1-1 uk-float-right">
                                            <button type="submit" class="md-btn md-btn-primary">Update</button>
                                            <a href="{{ URL::previous() }}" >  <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button></a>
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
    </div>
@endsection
@section('scripts')

@endsection