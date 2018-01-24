@extends('layouts.admin')

@section('title', 'Edit Arrival Recruit')

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
            {!! Form::open(['url' => route('arrival_recruit_update',$recruit->arrival_recruit['id']), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit Arrival Recruit</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">PAx ID</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <select required id="select_demo_1" class="md-input" name="recruitorder_id">
                                            <option value="" disabled selected hidden>Select Pax ...</option>
                                            @foreach($order as $value)
                                                @if($value->id==$recruit->arrival_recruit['recruitorder_id'])
                                                <option value="{!! $value->id !!}" selected>{!! $value->paxid !!}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if($errors->has('recruitorder_id'))
                                            <div class="uk-text-danger">{{ $errors->first('recruitorder_id') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Arrival Number<span style="color: red">*</span></label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Arrival Number</label>
                                        <input class="md-input" value="{!! $recruit->arrival_recruit['arrival_number'] !!}" type="text" name="arrival_number">
                                        @if($errors->has('arrival_number'))
                                                <div class="uk-text-danger">{{ $errors->first('arrival_number') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Upload File</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <input class="md-input" type="file" name="file_url">
                                    </div>

                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <img src="{!! asset('all_image/') !!}/{!! $recruit->arrival_recruit['file_url'] !!}" alt="...." height="60" width="150"/>
                                    </div>
                                </div>



                                <hr class="uk-grid-divider">
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-large-1-3">
                                        <span class="uk-text-muted uk-text-small">Created By</span>
                                    </div>
                                    <div class="uk-width-large-2-3">
                                        <span class="uk-text-large uk-text-middle">{!! isset($recruit->arrival_recruit->createdBy['name']) ? $recruit->arrival_recruit->createdBy['name']:''  !!}</span>
                                    </div>
                                </div>
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-large-1-3">
                                        <span class="uk-text-muted uk-text-small">Updated By</span>
                                    </div>
                                    <div class="uk-width-large-2-3">
                                        <span class="uk-text-large uk-text-middle">{!! isset($recruit->arrival_recruit->updatedBy['name']) ? $recruit->arrival_recruit->updatedBy['name']:''  !!}</span>
                                    </div>
                                </div>


                                <hr class="uk-grid-divider">
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-large-1-3">
                                        <span class="uk-text-muted uk-text-small">Created At</span>
                                    </div>
                                    <div class="uk-width-large-2-3">
                                        <span class="uk-text-large uk-text-middle">{!! isset($recruit->arrival_recruit['created_at']) ? $recruit->arrival_recruit['created_at']:''  !!}</span>
                                    </div>
                                </div>
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-large-1-3">
                                        <span class="uk-text-muted uk-text-small">Updated At</span>
                                    </div>
                                    <div class="uk-width-large-2-3">
                                        <span class="uk-text-large uk-text-middle">{!! isset($recruit->arrival_recruit['updated_at']) ? $recruit->arrival_recruit['updated_at']:''  !!}</span>
                                    </div>
                                </div>

                                <hr>


                                <div class="uk-grid uk-ma" data-uk-grid-margin>
                                    <div class="uk-width-2-5 uk-float-left">
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
        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_arrival_recruit').addClass('act_item');

        
        altair_forms.parsley_validation_config();
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection
