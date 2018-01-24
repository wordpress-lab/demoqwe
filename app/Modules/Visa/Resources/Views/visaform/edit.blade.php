@extends('layouts.main')

@section('title', 'Visa Form Edit')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit Visa Form</span></h2>
                                <div class="uk-width-medium-1-3">
                                    <div class="md-btn-group">
                                        <a href="{{ route('visastamp') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">All</a>
                                        <a href="{{ URL::previous() }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md-card">
                            {!! Form::open(['url' => route('visaform_update',$visa->id), 'method' => 'POST']) !!}
                            <div class="user_content">
                                <div class="uk-margin-top">

                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="Local">Pax Id</label>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <label for="paxid"> {{ $visa->pax['paxid'] }}</label>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="so">S/O</label>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <label for="so"> S/O </label>
                                            <input class="md-input" type="text" id="so" name="so"  value="{{ $visa->so  }}" />

                                        </div>
                                    </div>

                                    @php
                                   $k=0;
                                   $ag = 0;
                                   @endphp


                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="bulk">Form Bulk info</label>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            @foreach($visa->formBulk as $key=> $item )
                                                @php
                                                    $k=$key;
                                                @endphp
                                            <div class="uk-grid uk-grid-medium form_section " data-uk-grid-match="" data-section-added="{{ $key }}">
                                                <div class="uk-width-9-10" style="min-height: 118px;">
                                                    <div class="uk-grid">
                                                        <div class="uk-width-1-2">
                                                            <div class="parsley-row">
                                                                <div class="md-input-wrapper"><label style="position: relative; top:-20px;"> Name</label><input type="text" value="{{ $item->name }}" class="md-input" name="name[][s_{{ $key }}:i_0]"><span class="md-input-bar "></span></div>

                                                            </div>
                                                        </div>
                                                        <div class="uk-width-1-2">
                                                            <div class="parsley-row">
                                                                <div class="md-input-wrapper"><label style="position: relative; top:-20px;">Gender</label><input type="text" list="genderlist" class="md-input" value="{{ $item->gender }}" name="gender[][s_{{ $key }}:i_1]"><span class="md-input-bar "></span></div>

                                                                <datalist id="genderlist">
                                                                    <option value="Male"> </option>
                                                                    <option value="Female"></option>
                                                                </datalist>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="uk-grid">
                                                        <div class="uk-width-1-2">
                                                            <div class="parsley-row">
                                                                <div class="md-input-wrapper"><label style="position: relative; top:-20px;">Date of Birth</label><input class="md-input" type="text" value="{{ $item->dateofBirth }}" id="visa_date" name="dateofBirth[][s_{{ $key }}:i_2]" data-uk-datepicker="{format:'DD/MM/YYYY'}" value=""><span class="md-input-bar "></span></div>

                                                            </div>
                                                        </div>
                                                        <div class="uk-width-1-2">
                                                            <div class="parsley-row">
                                                                <div class="md-input-wrapper"><label style="position: relative; top:-20px;">Relationship</label><input type="text" class="md-input"  value="{{ $item->relationship }}" name="relationship[][s_{{ $key }}:i_3]" autocomplete="on"><span class="md-input-bar "></span></div>

                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>


                                                <div class="uk-width-1-10 uk-text-center" style="min-height: 118px;">
                                                    <div class="uk-vertical-align uk-height-1-1">
                                                        <div class="uk-vertical-align-middle">
                                                            <a href="#" class="btnSectionRemove"><i class="material-icons md-24"></i></a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            @endforeach
                                            <div class="uk-grid uk-grid-medium form_section " id="bulk" data-uk-grid-match="" data-section-added="{{ $k }}">
                                                <div class="uk-width-9-10">
                                                    <div class="uk-grid">
                                                        <div class="uk-width-1-2">
                                                            <div class="parsley-row">
                                                                <label> Name</label>
                                                                <input type="text" class="md-input" name="name[]" >
                                                            </div>
                                                        </div>
                                                        <div class="uk-width-1-2">
                                                            <div class="parsley-row">
                                                                <label>Gender</label>
                                                                <input type="text" list="genderlist" class="md-input" name="gender[]" >
                                                                <datalist id="genderlist">
                                                                    <option value="Male">
                                                                    <option value="Female">
                                                                    <option value="Gay">

                                                                </datalist>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="uk-grid">
                                                        <div class="uk-width-1-2">
                                                            <div class="parsley-row">
                                                                <label>Date of Birth</label>
                                                                <input class="md-input" type="text" id="visa_date" name="dateofBirth[]" data-uk-datepicker="{format:'DD/MM/YYYY'}" value="{{old('dateofBirth')}}" />
                                                            </div>
                                                        </div>
                                                        <div class="uk-width-1-2">
                                                            <div class="parsley-row">
                                                                <label>Relationship</label>
                                                                <input type="text" class="md-input" name="relationship[]" autocomplete="on" >
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>


                                                <div class="uk-width-1-10 uk-text-center">
                                                    <div class="uk-vertical-align uk-height-1-1">
                                                        <div class="uk-vertical-align-middle">
                                                            <a href="#" class="btnSectionClone" data-section-clone="#bulk"><i class="material-icons md-36">&#xE146;</i></a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="Local">Office Date</label>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <label for="officeDate"> Office Date </label>
                                            <input class="md-input" type="text" id="officeDate" name="officeDate" data-uk-datepicker="{format:'DD/MM/YYYY'}" value="{{ $visa->officeDate }}" />

                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="Local">Authorization</label>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <label for="authorization"> Authorization </label>
                                            <input class="md-input" type="text" id="authorization" name="authorization"  value="{{ $visa->authorization }}" />

                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="footerNumber">Footer Number</label>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <label for="footerNumber"> Footer Number </label>
                                            <input class="md-input" type="text" id="footerNumber" name="footerNumber"  value="{{ $visa->footerNumber }}" />

                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="agreement">Visa Agreement </label>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                           @foreach($visa->agreement as $key=>$item)
                                                @php
                                                    $ag=$key;
                                                @endphp
                                            <div class="uk-grid uk-grid-medium form_section " data-uk-grid-match="" data-section-added="{{ $key }}">
                                                <div class="uk-width-9-10" style="min-height: 232px;">
                                                    <div class="uk-grid">
                                                        <div class="uk-width-1-2">

                                                            <div class="uk-form-row">

                                                                <p for="Flag_Number">Agreement (EN) </p>
                                                                <div class="md-input-wrapper"><textarea name="agreementEn[][s_{{ $key }}:i_0]" cols="40" rows="7" class="md-input  " style="overflow-x: hidden; word-wrap: break-word; height: 193px;"> {{ $item->agreementEn }}</textarea><span class="md-input-bar "></span></div>
                                                            </div>
                                                        </div>
                                                        <div class="uk-width-1-2">

                                                            <div class="uk-form-row">
                                                                <p for="Flag_Number">Agreement (AR)</p>
                                                                <div class="md-input-wrapper"><textarea name="agreementAr[][s_{{ $key }}:i_1]" cols="40" rows="7" class="md-input " style="overflow-x: hidden; word-wrap: break-word; height: 193px;"> {{ $item->agreementAr }} </textarea><span class="md-input-bar "></span></div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                </div>


                                                <div class="uk-width-1-10 uk-text-center" style="min-height: 232px;">
                                                    <div class="uk-vertical-align uk-height-1-1">
                                                        <div class="uk-vertical-align-middle">
                                                            <a href="#" class="btnSectionRemove"><i class="material-icons md-24"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            <div class="uk-grid uk-grid-medium form_section " id="agreement" data-uk-grid-match="" data-section-added="{{ $ag }}">
                                                <div class="uk-width-9-10">
                                                    <div class="uk-grid">
                                                        <div class="uk-width-1-2">

                                                            <div class="uk-form-row">
                                                                <p for="Flag_Number">Agreement (EN) </p>
                                                                <textarea name="agreementEn[]" cols="40" rows="7" class="md-input ">{{ old('agreementEn')}}</textarea>
                                                                @if($errors->has('agreementEn'))
                                                                    <div class="uk-text-danger">{{ $errors->first('agreementEn') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="uk-width-1-2">

                                                            <div class="uk-form-row">
                                                                <p for="Flag_Number">Agreement (AR)</p>
                                                                <textarea name="agreementAr[]" cols="40" rows="7" class="md-input">{{ old('agreementAr')}}</textarea>
                                                                @if($errors->has('agreementAr'))
                                                                    <div class="uk-text-danger">{{ $errors->first('agreementAr') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="uk-width-1-10 uk-text-center">
                                                    <div class="uk-vertical-align uk-height-1-1">
                                                        <div class="uk-vertical-align-middle">
                                                            <a href="#" class="btnSectionClone" data-section-clone="#agreement"><i class="material-icons md-36">&#xE146;</i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
    $('#sidebar_recruit').addClass('current_section');
    $('#visa_stamp_to').addClass('act_item');
</script>

@endsection