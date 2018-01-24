@extends('layouts.main')

@section('title', 'Mofa Edit')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit Mofa </span></h2>
                            </div>
                        </div>
                        <div class="md-card">
                            {!! Form::open(['url' => route('mofa_update',$mofa->id), 'method' => 'POST','files' => true]) !!}
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="payment_date">Mofa Date <i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="payment_date">Select date</label>
                                            <input class="md-input" type="text" id="mofa_date" name="mofa_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{ $mofa->mofaDate }}" />
                                        </div>
                                        @if($errors->first('mofa_date'))
                                            <div class="uk-text-danger">Date is required.</div>
                                        @endif
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="Local">Pax Id <i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="Local">Pax </label>
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Pax" id="local_ref" name="pax_ref">
                                                <option>Select Pax</option>
                                                @foreach($order as $value)
                                                    @if($value->id ==$mofa->pax_id)
                                                    <option selected value=" {{ $value->id }} " > {{ $value->paxid }} </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @if($errors->has('pax_ref'))
                                                <div class="uk-text-danger">{{ $errors->first('pax_ref') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="mofa_number">Mofa Number <i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="mofa_number">Mofa Number</label>
                                            <input class="md-input" type="text" id="mofa_number" name="mofa_number" value="{{ $mofa->mofaNumber }}" />
                                            @if($errors->has('mofa_number'))
                                                <div class="uk-text-danger">{{ $errors->first('mofa_number') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="iqamaNumber">Iqama Number</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="iqamaNumber">Iqama Number</label>
                                            <input class="md-input" type="text" id="iqamaNumber" name="iqamaNumber" value="{{ $mofa->iqamaNumber }} " />

                                        </div>
                                    </div> -->

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="iqamaNumber">Profession</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="iqamaNumber">Profession</label>
                                            <input class="md-input" type="text" id="profession" value="{!! $mofa->profession !!}"  name="profession" />
                                            @if($errors->has('profession'))
                                                <div class="uk-text-danger">{{ $errors->first('profession') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="payment_date">Medical Center Submit Date <i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="payment_date">Select date</label>
                                            <input class="md-input" type="text" id="mofa_date" value="{!! $mofa->medical_submit_date !!}" name="medical_submit_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" />
                                        </div>
                                        @if($errors->has('medical_submit_date'))
                                            <div class="uk-text-danger">{{ $errors->first('medical_submit_date') }}</div>
                                        @endif
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="status">Status</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <p>
                                                <input {{ $mofa->status==1 ? "checked":'' }}  value="1" type="radio" name="status" id="status" data-md-icheck />
                                                <label  for="radio_demo_1"  class="inline-label">ok</label>
                                            </p>
                                            <p>
                                                <input {{ $mofa->status==0 ? "checked":'' }} type="radio" value="0" name="status"  id="status" data-md-icheck />
                                                <label for="status" class="inline-label">not ok</label>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="comments">Comments</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="comments">Comments</label>
                                            <div class="uk-form-row">
                                                <textarea name="comments" cols="30" rows="4" class="md-input no_autosize">{{ $mofa->comment }}</textarea>
                                                @if($errors->has('comments'))
                                                    <div class="uk-text-danger">{{ $errors->first('comments') }}</div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>

                                    <br>
                                    <br>
                                    <br>
                                    <div class="uk-grid main_upload_sec"  data-uk-grid-margin>
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
                                    </div>
                                    @foreach($mofa->mofa_file as $file)
                                        <div class="uk-grid " data-uk-grid-margin>
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
                                                                    <input id="img_url" type="file" class="md-input" name="img_url[{!! 'old_'.$file['id'] !!}]">
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
                                    @endforeach

                                    <br>
                                    <br>
                                    <br>
                                    <br>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="comments">User</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="comments">Created By  {{ $mofa->createdBy->name  }}</label>

                                            <br/>

                                            <label for="comments">Updated By  {{ $mofa->updatedBy->name  }}</label>

                                      </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="comments">Date TIme</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <label for="comments">Created At  {{ $mofa->created_at  }}</label>

                                            <br/>

                                            <label for="comments">Updated At  {{ $mofa->updated_at  }}</label>

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

    <script>
        setInterval(function () {
            var uploadedfile = document.querySelectorAll('#img_url').length;
          //  var old = document.querySelectorAll('.old').length;

            if(uploadedfile>=1){

              $('.main_upload_sec').hide();
              $('.btnSectionRemove').hide();

            }else{
               $('.main_upload_sec').show();
               $('.btnSectionRemove').show();
            }




        },1000);

        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_mofa').addClass('act_item');
        $(window).load(function(){
            $("#tiktok2").trigger('click');
        })
    </script>

@endsection