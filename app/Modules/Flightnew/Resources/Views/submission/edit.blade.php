@extends('layouts.main')

@section('title', 'Submission Edit')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
<body onsubmit="return myFunc();">
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
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit Submission </span></h2>
                            </div>
                        </div>
                        <div class="md-card">
                            {!! Form::open(['url' => route('submission_update',$submission->id), 'method' => 'POST','files' => true]) !!}
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="Local">Pax Id <i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="Local">Pax </label>
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Pax" id="local_ref" name="pax_id">
                                                <option>Select Pax</option>
                                                @foreach($order as $value)
                                                    @if($value->id ==$submission->pax_id)
                                                    <option selected value=" {{ $value->id }} " > {{ $value->paxid }} </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @if($errors->has('pax_id'))
                                                <div class="uk-text-danger">{{ $errors->first('pax_id') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="payment_date">Submission Date <i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="payment_date">Select date</label>
                                            <input class="md-input" type="text" id="submission_date" value="{!! $submission->submission_date !!}" name="submission_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" />
                                        </div>
                                        @if($errors->has('submission_date'))
                                            <div class="uk-text-danger">{{ $errors->first('submission_date') }}</div>
                                        @endif
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="payment_date">Expected Date of Flight<i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="payment_date">Select date</label>
                                            <input class="md-input" type="text" value="{!! $submission->expected_flight_date !!}" id="expected_flight_date" name="expected_flight_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" />
                                        </div>
                                        @if($errors->has('expected_flight_date'))
                                            <div class="uk-text-danger">{{ $errors->first('expected_flight_date') }}</div>
                                        @endif
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="comments">Comments</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="comments">Comments</label>
                                            <div class="uk-form-row">
                                                <textarea name="comment" cols="30" rows="4" class="md-input no_autosize" id="comment">{{ $submission->comment }}</textarea>
                                                <span style="color:red; position: relative; right:-500px" id="validate"></span>
                                                @if($errors->has('comment'))
                                                    <div class="uk-text-danger">{{ $errors->first('comment') }}</div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>

                                    <br>
                                    <br>
                                    <br>
                                    {{--<div class="uk-grid" data-uk-grid-margin>--}}
                                        {{--<div class="uk-width-medium-1-5 uk-vertical-align">--}}
                                            {{--<label class="uk-vertical-align-middle" for="visaType">Upload File</label>--}}
                                        {{--</div>--}}
                                        {{--<div class="uk-width-medium-2-5">--}}
                                            {{--<div class="md-card">--}}
                                                {{--<div class="md-card-content">--}}
                                                    {{--<div class="uk-grid form_section" id="d_form_row">--}}
                                                        {{--<div class="uk-width-1-1">--}}
                                                            {{--<div class="uk-input-group">--}}
                                                                {{--<label for="visaType">Title</label>--}}
                                                                {{--<input type="text" id="visaType" class="md-input" name="title[]" />--}}
                                                                {{--<br>--}}
                                                                {{--<br>--}}
                                                                {{--<input type="file" class="md-input" name="img_url[]">--}}
                                                                {{--<span class="uk-input-group-addon">--}}
                                                                     {{--<a href="#" class="btnSectionClone" data-section-clone="#d_form_row"><i class="material-icons md-24">&#xE146;</i></a>--}}
                                                                 {{--</span>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                   <!--  @foreach($submission->submition_file as $file)
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
                                                                    {{--<span class="uk-input-group-addon">--}}
                                                                    {{--<a href="#" class="btnSectionRemove"><i class="material-icons md-24"></i></a>--}}
                                                                 {{--</span>--}}
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

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="comments">User</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="comments">Created By  {{ $submission->createdBy->name  }}</label>
                                            <br/>
                                            <label for="comments">Updated By  {{ $submission->updatedBy->name  }}</label>
                                      </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="comments">Date TIme</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="comments">Created At  {{ $submission->created_at  }}</label>
                                            <br/>
                                            <label for="comments">Updated At  {{ $submission->updated_at  }}</label>
                                        </div>
                                    </div>



              <hr>

              <div class="uk-grid uk-ma" data-uk-grid-margin>
                  <div class="uk-width-1-1 uk-float-left">
                      <button type="submit" class="md-btn md-btn-primary" >Update</button>
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
    <script type="text/javascript">
        function myFunc(){
            var comment = $("#comment").val();
            
            if(comment == ''){
                $("#validate").html("Comment field is required!");
                return false;
            }
            
        }
        
    </script>
    
    <script>
        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_submission').addClass('act_item');
        $(window).load(function(){
            $("#tiktok2").trigger('click');
        })
    </script>

@endsection