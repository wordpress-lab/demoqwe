@extends('layouts.main')

@section('title', 'Medical Slip Edit')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('angular')
    <script src="{{url('app/moneyin/invoice/invoice.module.js')}}"></script>
    <script src="{{url('app/moneyin/invoice/invoice.controller.js')}}"></script>
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
                @if(Session::has('delete'))
                    <div class="uk-alert uk-alert-danger" data-uk-alert>
                        <a href="#" class="uk-alert-close uk-close"></a>
                        {!! Session::get('delete') !!}
                    </div>
                @endif
                @if(Session::has('message'))
                    <div class="uk-alert uk-alert-danger" data-uk-alert>
                        <a href="#" class="uk-alert-close uk-close"></a>
                        {!! Session::get('message') !!}
                    </div>
                @endif
            {!! Form::open(['url' => route('medical_slip_form_update',$query->id), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit Medical Slip</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                <div class="md-card">
                                    <div class="md-card-content">
                                        <h3 class="heading_a">Select Pax<span style="color: red">*</span></h3>
                                        <div class="uk-grid">
                                            <div class="uk-width-large-1-2">
                                                <select id="selec_adv_1" name="recruit_id[]" multiple>

                                                   @foreach($rec as $value)
                                                        @foreach($immipax as $item)
                                                            @if($value->id==$item->recruit_id)
                                                                <option value="{!! $item->recruit_id !!}" selected>{!! $item->recruit->paxid !!}</option>
                                                            @endif
                                                        @endforeach
                                                            <option value="{!! $value->id !!}">{!! $value->paxid !!}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="md-card">
                                    <div class="md-card-content">
                                        <h3 class="heading_a">Passport Sent<span style="color: red">*</span></h3>
                                        <div class="uk-grid">
                                            <div class="uk-width-large-1-2">
                                                <select id="selec_adv_3" name="received_status[]" multiple class="pax_id_2">
                                                        @foreach($rec as $value)
                                                            @foreach($gamca_receive_submit as $item)
                                                                @if($value->id==$item->pax_id)
                                                                <option value="{!! $value->id !!}" selected>{!! $value->paxid !!}</option>
                                                                @endif
                                                            @endforeach
                                                            <option value="{!! $value->id !!}">{!! $value->paxid !!}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="md-card">
                                    <div class="md-card-content">
                                        <h3 class="heading_a">Passport Returned<span style="color: red">*</span></h3>
                                        <div class="uk-grid">
                                            <div class="uk-width-large-1-2">
                                                <select id="selec_adv_4" name="submitted_status[]" multiple>
                                                    @foreach($rec as $value)
                                                        @foreach($gamca_receive_submit2 as $item)
                                                            @if($value->id==$item->pax_id)
                                                                <option value="{!! $value->id !!}" selected>{!! $value->paxid !!}</option>
                                                            @endif
                                                        @endforeach
                                                        <option value="{!! $value->id !!}">{!! $value->paxid !!}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Application Date</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select date</label>
                                        <input class="md-input" type="text" id="uk_dp_start" value="{!! $query->dateOfApplication !!}" name="dateOfApplication" data-uk-datepicker="{format:'YYYY-MM-DD'}" required>
                                        @if($errors->has('dateOfApplication'))
                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('dateOfApplication')!!}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="invoice_date">Country Name</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="invoice_date">Select Country Name</label>
                                        <input class="md-input" type="text" id="uk_dp_start" value="{!! $query->country_name !!}" name="country_name">
                                        @if($errors->has('country_name'))
                                            <span style="color:red; position: relative; right:-500px">{!!$errors->first('country_name')!!}</span>
                                        @endif
                                    </div>
                                </div>

                                <br>
                                <br>
                                <br>
                                <!-- <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="visaType">Upload File</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <div class="md-card">
                                            <div class="md-card-content">
                                                <div class="uk-grid form_section" id="d_form_row">
                                                    <div class="uk-width-1-1">
                                                        <div class="uk-input-group">
                                                            <label for="visaType">Title</label>
                                                            <input type="text" id="visaType" class="md-input" name="title[]" />
                                                            <br>
                                                            <br>
                                                            <input type="file" class="md-input" name="img_url[]">
                                                            <span class="uk-input-group-addon">
                                                                     <a href="#" class="btnSectionClone" data-section-clone="#d_form_row"><i class="material-icons md-24">&#xE146;</i></a>
                                                                 </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                               <!--  @foreach($query->gamca_file as $file)
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="visaType">Upload File</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <div class="md-card">
                                                <div class="md-card-content">
                                                    <div class="uk-grid form_section" id="d_form_row">
                                                        <div class="uk-width-1-1">
                                                            <a href="{!! asset('all_image/') !!}/{!! $file->img_url !!}" style="float:right;" class="md-btn md-btn-primary md-btn-mini md-btn-wave-light" download>Download</a>

                                                            <div class="uk-input-group">
                                                                <label for="visaType">Title</label>
                                                                <input type="text" id="visaType" class="md-input" value="{!! $file['title'] !!}"  name="title[{!! 'old_'.$file['id'] !!}]" required="1" />
                                                                <br>
                                                                <br>
                                                                <input type="file" class="md-input" name="img_url[{!! 'old_'.$file['id'] !!}]">
                                                                <input type="hidden" value="{!! $file['id'] !!}" name="img_id[]" >
                                                                <br>
                                                                @if($errors->has('img_url'))
                                                                    <div class="uk-text-danger">{{ $errors->first('img_url') }}</div>
                                                                @endif
                                                                <span class="uk-input-group-addon">
                                                                    <a href="#" class="btnSectionRemove"><i class="material-icons md-24"></i></a>
                                                                 </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <img src="{!! asset('all_image/') !!}/{!! $file->img_url !!}" alt="...." height="60" width="150"/>
                                        </div>
                                    </div>
                                @endforeach -->



                                <hr class="uk-grid-divider">
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-large-1-3">
                                        <span class="uk-text-muted uk-text-small">Created By</span>
                                    </div>
                                    <div class="uk-width-large-2-3">
                                        <span class="uk-text-large uk-text-middle">{!! isset($query->createdBy['name']) ? $query->createdBy['name']:''  !!}</span>
                                    </div>
                                </div>
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-large-1-3">
                                        <span class="uk-text-muted uk-text-small">Updated By</span>
                                    </div>
                                    <div class="uk-width-large-2-3">
                                        <span class="uk-text-large uk-text-middle">{!! isset($query->updatedBy['name']) ? $query->updatedBy['name']:''  !!}</span>
                                    </div>
                                </div>


                                <hr class="uk-grid-divider">
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-large-1-3">
                                        <span class="uk-text-muted uk-text-small">Created At</span>
                                    </div>
                                    <div class="uk-width-large-2-3">
                                        <span class="uk-text-large uk-text-middle">{!! isset($query->created_at) ? $query->created_at:''  !!}</span>
                                    </div>
                                </div>
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-large-1-3">
                                        <span class="uk-text-muted uk-text-small">Updated At</span>
                                    </div>
                                    <div class="uk-width-large-2-3">
                                        <span class="uk-text-large uk-text-middle">{!! isset($query->updated_at) ? $query->updated_at:''  !!}</span>
                                    </div>
                                </div>

                                <br>
                                <br>
                                <hr>
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
    <script type="text/javascript">
        $(window).load(function(){
            $("#tiktok2").trigger('click');
        })
        $('#sidebar_recruit').addClass('current_section');
        $('#medical_slip_form_index').addClass('act_item');
    </script>
    <script>
        altair_forms.parsley_validation_config();
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection
