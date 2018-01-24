@extends('layouts.main')

@section('title', 'Ticket Document')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection


@section('content')
    <div class="uk-grid" ng-controller="InvoiceController">
        <div class="uk-width-large-10-10">
            @if(Session::has('msg'))
                <div class="uk-alert uk-alert-success" data-uk-alert>
                    <a href="#" class="uk-alert-close uk-close"></a>
                    {!! Session::get('msg') !!}
                </div>
            @endif
            {!! Form::open(['url' => route('ticket_document_store'), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New Ticket Document</span></h2>
                                <div class="uk-width-medium-1-3">
                                    <div class="md-btn-group">
                                        <a href="{{ route('ticket_document_index') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">All</a>
                                        <a href="{{ route('ticket_document_create') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Add</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Order Id <span style="color: red">*</span> </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Order id" id="order_id" name="order_id" required>
                                            <option value="">Select Order ID</option>
                                            @foreach($order as $value)
                                                <option value="{!! $value->id !!}">{!! $value->order_id !!}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('order_id'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('order_id')!!}</span>

                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Title</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="name">Title</label>
                                        <input class="md-input" type="text" id="name" name="title">
                                        @if($errors->has('title'))
                                             <br/>
                                            <span style="color:orangered;">{!!$errors->first('title')!!}</span>

                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="comment">Note </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="note">Note here (optional)</label>
                                        <textarea type="text" name="note" id="note" class="md-input" cols="4" rows="4"></textarea>
                                        @if($errors->has('comment'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('comment')!!}</span>

                                        @endif
                                    </div>
                                </div>
                                <br>
                                <br>
                                <br>


                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">File Upload</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <input class="md-input" type="file" id="file" name="file_url" required>
                                        @if($errors->has('file_url'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('file_url')!!}</span>

                                        @endif
                                    </div>
                                </div>
                                <br>
                                <br>
                                <br>

                                <div class="uk-grid uk-ma" data-uk-grid-margin>
                                    <div class="uk-width-1-1 uk-float-left">
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

    <script>
        $('#sidebar_ticket_order_docuemnt').addClass('act_item');
        altair_forms.parsley_validation_config();
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection
