@extends('layouts.main')

@section('title', 'Pms site edit')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit Site</span></h2>
                                <div class="uk-width-medium-1-3">
                                    <div class="md-btn-group">
                                        <a href="{{ route('pms_sites_index') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">All</a>
                                        <a href="{{ route('pms_sites_create') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Add</a>
                                        <a href="{{ URL::previous() }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md-card">
                            {!! Form::open(['url' => route('pms_sites_update',['id'=>$site->id]), 'method' => 'POST','files' => true]) !!}
                            <div class="user_content">
                                <div class="uk-margin-top">



                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="company_name">Company Name <i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="company_name">Company Name</label>
                                            <input class="md-input" type="text" id="company_name" name="company_name" value="{{$site->company_name }}" />
                                        </div>
                                        @if($errors->first('company_name'))
                                            <div class="uk-text-danger">Company is required.</div>
                                        @endif
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="company_name">Address<i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <textarea name="address" cols="30" rows="4" class="md-input no_autosize">{{ $site->address }}</textarea>
                                            @if($errors->has('address'))
                                                <div class="uk-text-danger">{{ $errors->first('address') }}</div>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="contact_person">Contact Person <i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="contact_person">Contact Person</label>
                                            <input class="md-input" type="text" id="contact_person" name="contact_person" value="{{ $site->contact_person }}" />
                                        </div>
                                        @if($errors->first('contact_person'))
                                            <div class="uk-text-danger">Contact Person is required.</div>
                                        @endif
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="position">Position</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="position">Position</label>
                                            <input class="md-input" type="text" id="position" name="position" value="{{ $site->position }}" />
                                        </div>
                                        @if($errors->first('position'))
                                            <div class="uk-text-danger">Position is required.</div>
                                        @endif
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="contact_number">Contact Number</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="contact_number">Contact Number</label>
                                            <input class="md-input" type="text" id="contact_number" name="contact_number" value="{{ $site->contact_number }}" />
                                        </div>
                                        @if($errors->first('contact_number'))
                                            <div class="uk-text-danger">Contact Number is required.</div>
                                        @endif
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="wages_rate">Wages Rates</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="wages_rate">Wages rates</label>
                                            <input onkeypress="numbervalidate()" class="md-input" type="text" id="wages_rate" name="wages_rate" value="{{ $site->wages_rate }}" />
                                        </div>
                                        @if($errors->first('wages_rate'))
                                            <div class="uk-text-danger">wages rate is required.</div>
                                        @endif
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="Local">Contract Period From </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="billing_period_from">Contract Period From Date</label>
                                            <input class="md-input" type="text" id="billing_period_from" name="billing_period_from" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{$site->billing_period_from=="0000-00-00"?"":$site->billing_period_from }}" />
                                        </div>
                                        @if($errors->first('billing_period_from'))
                                            <div class="uk-text-danger">Date is required.</div>
                                        @endif
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="billing_period_to">Contract Period To</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="billing_period_to">Contract Period To Date</label>
                                            <input class="md-input" type="text" id="billing_period_to" name="billing_period_to" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{ $site->billing_period_to=="0000-00-00"?"":$site->billing_period_to }}" />

                                        </div>
                                        @if($errors->has('billing_period_to'))
                                            <div class="uk-text-danger">{{ $errors->first('billing_period_to') }}</div>
                                        @endif
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="bill_to">Bill to <i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <input class="md-input" type="text" id="bill_to"  name="bill_to" value="{{ $site->bill_to }}" />
                                            @if($errors->has('bill_to'))
                                                <div class="uk-text-danger">{{ $errors->first('bill_to') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                       <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-5 uk-vertical-align">
                                                <label class="uk-vertical-align-middle" for="visaType">Contact File</label>
                                            </div>
                                                <div class="uk-width-medium-2-5">
                                                    <div class="md-card">
                                                        <div class="md-card-content">
                                                            <div class="uk-grid form_section">
                                                                <div class="uk-width-1-1">
                                                                    <div class="uk-input-group">

                                                                        <input type="file" class="md-input" name="contact_paper_url">
                                                                        @if($errors->has('contact_paper_url'))
                                                                            <div class="uk-text-danger">{{ $errors->first('contact_paper_url') }}</div>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                           <div class="uk-width-medium-1-3">
                                           @if($site->contact_paper_url)
                                           <a title="open file" style="text-transform: capitalize" target="_blank" href="{{ route('pms_sites_download',$site->contact_paper_url?$site->id:0) }}">Download</a>
                                           @endif

                                           </div>
                                             </div>

                                             <hr>

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
        $('#sidebar_pms_site_view').addClass('act_item');
    </script>
    <script src="{{ asset("admin/assets/js/pages/redeyeCustom.js") }}"></script>
@endsection