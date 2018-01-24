@extends('layouts.main')

@section('title', 'Ticket Document Edit ')

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
            {!! Form::open(['url' => route('manpower_service_document_update',$document->id), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Ticket Document Edit</span></h2>
                                <div class="uk-width-medium-1-3">
                                    <div class="md-btn-group">
                                        <a href="{{ route('manpower_service_document_index') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">All</a>
                                        <a href="{{ route('manpower_service_document_create') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Add</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Order Id</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Order id" id="order_id" name="manpower_service_id">
                                            <option value="">Select Order ID</option>
                                            @foreach($manpower as $value)
                                                @if($value->id==$document->manpower_service_id)
                                                <option selected value="{!! $value->id !!}">{!! $value->order_id !!}</option>
                                                @else
                                                    <option value="{!! $value->id !!}">{!! $value->order_id !!}</option>
                                                    @endif
                                            @endforeach
                                        </select>
                                        @if($errors->has('manpower_service_id'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('manpower_service_id')!!}</span>

                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Title</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="name">Title</label>
                                        <input class="md-input" type="text" value="{!! $document->title !!}" id="name" name="title">
                                        @if($errors->has('title'))
                                            <br/>
                                            <span style="color:orangered;">{!!$errors->first('title')!!}</span>

                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="comment">Note</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="note">Note here (optional)</label>
                                        <textarea type="text" name="note" id="note" class="md-input" cols="4" rows="4">{!! $document->note !!}</textarea>
                                        @if($errors->has('comment'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('comment')!!}</span>

                                        @endif
                                    </div>
                                </div>
                                <br>
                                <br>


                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">File Upload</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <input class="md-input" type="file" value="{!! $document->file_url !!}" id="file" name="file_url">
                                        @if($document->file_url)
                                            <br/>
                                            <a download="" href="{{  asset("document/".$document->file_url) }}">Download</a>
                                        @endif
                                        @if($errors->has('file_url'))

                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('file_url')!!}</span>

                                        @endif

                                    </div>
                                </div>


                                <hr class="uk-grid-divider">
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-large-1-3">
                                        <span class="uk-text-muted uk-text-small">Created By</span>
                                    </div>
                                    <div class="uk-width-large-2-3">
                                        <span class="uk-text-large uk-text-middle">{!! isset($document->createdBy['name']) ? $document->createdBy['name']:''  !!}</span>
                                    </div>
                                </div>
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-large-1-3">
                                        <span class="uk-text-muted uk-text-small">Updated By</span>
                                    </div>
                                    <div class="uk-width-large-2-3">
                                        <span class="uk-text-large uk-text-middle">{!! isset($document->updatedBy['name']) ? $document->updatedBy['name']:''  !!}</span>
                                    </div>
                                </div>


                                <hr class="uk-grid-divider">
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-large-1-3">
                                        <span class="uk-text-muted uk-text-small">Created At</span>
                                    </div>
                                    <div class="uk-width-large-2-3">
                                        <span class="uk-text-large uk-text-middle">{!! isset($document->created_at) ? $document->created_at:''  !!}</span>
                                    </div>
                                </div>
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-large-1-3">
                                        <span class="uk-text-muted uk-text-small">Updated At</span>
                                    </div>
                                    <div class="uk-width-large-2-3">
                                        <span class="uk-text-large uk-text-middle">{!! isset($document->updated_at) ? $document->updated_at:''  !!}</span>
                                    </div>
                                </div>

                                <br>
                                <br>
                                <hr>
                                <div class="uk-grid uk-ma" data-uk-grid-margin>
                                    <div class="uk-width-1-1 uk-float-left">
                                        <button type="submit" class="md-btn md-btn-primary" >Update</button>
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
    <br>
    <br>
    <br>
@endsection

@section('scripts')

    <script>
        $('#sidebar_ticket_order_docuemnt').addClass('act_item');
        altair_forms.parsley_validation_config();
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection
