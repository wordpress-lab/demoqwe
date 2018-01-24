@extends('layouts.main')

@section('title', 'Pms Employee create')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New Pms Employee</span></h2>
                                <div class="uk-width-medium-1-3">
                                    <div class="md-btn-group">
                                        <a href="{{ route('pms_employees_index') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">All</a>
                                        <a href="{{ route('pms_employees_create') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Add</a>
                                        <a href="{{ URL::previous() }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md-card">
                            {!! Form::open(['url' => route('pms_employees_store'), 'method' => 'POST','files' => true]) !!}
                            <div class="user_content">
                                <div class="uk-margin-top">



                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="code_name">Code Name <i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="code_name">Code Name</label>
                                            <span  class="md-btn md-btn-small md-btn-warning md-btn-wave waves-effect waves-button" id="generate">Generate</span>
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon">EMP-</span>
                                                <input autocomplete="off" style="text-transform: uppercase" class="md-input" type="text" id="code_name" name="code_name" value="{{ $generate_code }}" />

                                            </div>
                                            <span id="code_msg" class="uk-input-group-addon"></span>

                                        </div>

                                        @if($errors->first('code_name'))
                                            <div class="uk-text-danger">Code is required.</div>
                                        @endif
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="father_name">Name <i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="name">Name</label>
                                            <input class="md-input" type="text" id="name" name="name" value="{{old('name')}}" />
                                        </div>
                                        @if($errors->first('name'))
                                            <div class="uk-text-danger">name is required.</div>
                                        @endif
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="father_name">Father Name <i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="father_name">father name</label>
                                            <input class="md-input" type="text" id="father_name" name="father_name" value="{{old('father_name')}}" />
                                        </div>
                                        @if($errors->first('father_name'))
                                            <div class="uk-text-danger">father name is required.</div>
                                        @endif
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="date_of_birth">Date of Birth </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="date_of_birth">Date of Birth</label>
                                            <input class="md-input" type="text" id="date_of_birth" name="date_of_birth" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{old('date_of_birth')}}" />
                                        </div>
                                        @if($errors->first('date_of_birth'))
                                            <div class="uk-text-danger">Date is required.</div>
                                        @endif
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="nationality">Nationality</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="nationality">Nationality</label>
                                            <input class="md-input" type="text" id="nationality" name="nationality" value="{{old('nationality')}}" />
                                            @if($errors->first('nationality'))
                                                <div class="uk-text-danger">nationality is required.</div>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="arrival_date">Arrival Date </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="arrival_date">Arrival Date</label>
                                            <input class="md-input" type="text" id="arrival_date" name="arrival_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{old('arrival_date')}}" />
                                        </div>
                                        @if($errors->first('arrival_date'))
                                            <div class="uk-text-danger">Date is required.</div>
                                        @endif
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="passport_number">Passport Number</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="passport_number">Passport Number</label>
                                            <input class="md-input" type="text" id="passport_number" name="passport_number" value="{{old('passport_number')}}" />
                                        </div>
                                        @if($errors->first('passport_number'))
                                            <div class="uk-text-danger">Passport Number is required.</div>
                                        @endif
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="passport_expiry">Expiry Date </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="passport_expiry">Expiry Date</label>
                                            <input class="md-input" type="text" id="passport_expiry" name="passport_expiry" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{old('passport_expiry')}}" />
                                        </div>
                                        @if($errors->first('passport_expiry'))
                                            <div class="uk-text-danger"> Passport Expiry Date is required.</div>
                                        @endif
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="iqama_number">Iqama Number</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="iqama_number">Iqama Number</label>
                                            <input class="md-input" type="text" id="iqama_number" name="iqama_number" value="{{old('iqama_number')}}" />
                                        </div>
                                        @if($errors->first('iqama_number'))
                                            <div class="uk-text-danger">Iqama number is required.</div>
                                        @endif
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="iqama_expiry">Iqama Date </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="iqama_expiry">Iqama Date</label>
                                            <input class="md-input" type="text" id="iqama_expiry" name="iqama_expiry" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{old('iqama_expiry')}}" />
                                        </div>
                                        @if($errors->first('iqama_expiry'))
                                            <div class="uk-text-danger"> Iqama Expiry Date is required.</div>
                                        @endif
                                    </div>


                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="site_name">Site Name </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <select data-md-selectize name="site_name" id="site_name" class="md-input" data-uk-tooltip="{pos:'top'}" title="Select site">
                                                <option  value="">Select site</option>
                                                @foreach($sites as $value)
                                                    <option value="{{ $value->id }}">{{ $value->company_name }}</option>
                                                @endforeach
                                            </select>                                        </div>
                                        @if($errors->first('site_name'))
                                            <div class="uk-text-danger">Site is required.</div>
                                        @endif
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="basic_salary">Basic Salary</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="basic_salary">Basic Salary</label>
                                            <input onkeypress="numbervalidate()" class="md-input" type="text" id="basic_salary" name="basic_salary"  value="{{old('basic_salary')}}" />
                                        </div>
                                        @if($errors->has('basic_salary'))
                                            <div class="uk-text-danger">{{ $errors->first('basic_salary') }}</div>
                                        @endif
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="food_allowance">Food Allowance</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="basic_salary">Food Allowance</label>
                                            <input onkeypress="numbervalidate()" class="md-input" type="text" id="food_allowance"  name="food_allowance" value="{{old('food_allowance')}}" />
                                            @if($errors->has('food_allowance'))
                                                <div class="uk-text-danger">{{ $errors->first('food_allowance') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="mobile_number">Mobile Number</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="basic_salary">Mobile Number</label>
                                            <input class="md-input" type="text" id="mobile_number"  name="mobile_number" value="{{old('mobile_number')}}" />
                                            @if($errors->has('mobile_number'))
                                                <div class="uk-text-danger">{{ $errors->first('mobile_number') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="food_allowance">Daily Work Hour</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="basic_salary">Daily Work Hour</label>
                                            <input class="md-input" type="text" name="daily_work_hour" value="{{old('daily_work_hour')}}" />
                                            
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="food_allowance">Overtime Amount/hr.</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="basic_salary">Overtime Amount/hr.</label>
                                            <input class="md-input" type="text" name="overtime_amount_per_hour" value="{{ old('overtime_amount_per_hour') }}" />
                                            
                                        </div>
                                    </div>


                                       <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-5 uk-vertical-align">
                                                <label class="uk-vertical-align-middle" for="visaType">Passport File</label>
                                            </div>
                                                <div class="uk-width-medium-2-5">
                                                    <div class="md-card">
                                                        <div class="md-card-content">
                                                            <div class="uk-grid form_section">
                                                                <div class="uk-width-1-1">
                                                                    <div class="uk-input-group">

                                                                        <input type="file" class="md-input" name="passport_url">
                                                                        @if($errors->has('passport_url'))
                                                                            <div class="uk-text-danger">{{ $errors->first('passport_url') }}</div>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                             </div>

                                       <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-5 uk-vertical-align">
                                                <label class="uk-vertical-align-middle" for="visaType">Photo </label>
                                            </div>
                                                <div class="uk-width-medium-2-5">
                                                    <div class="md-card">
                                                        <div class="md-card-content">
                                                            <div class="uk-grid form_section">
                                                                <div class="uk-width-1-1">
                                                                    <div class="uk-input-group">

                                                                        <input type="file" class="md-input" name="photo_url">
                                                                        @if($errors->has('photo_url'))
                                                                            <div class="uk-text-danger">{{ $errors->first('photo_url') }}</div>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                             </div>
                                       <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-5 uk-vertical-align">
                                                <label class="uk-vertical-align-middle" for="visaType">Iqama File </label>
                                            </div>
                                                <div class="uk-width-medium-2-5">
                                                    <div class="md-card">
                                                        <div class="md-card-content">
                                                            <div class="uk-grid form_section">
                                                                <div class="uk-width-1-1">
                                                                    <div class="uk-input-group">

                                                                        <input type="file" class="md-input" name="iqama_url">
                                                                        @if($errors->has('iqama_url'))
                                                                            <div class="uk-text-danger">{{ $errors->first('iqama_url') }}</div>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                             </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="remarks">Remarks</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <textarea name="remarks" cols="30" rows="4" class="md-input no_autosize">{{ old('remarks')}}</textarea>
                                            @if($errors->has('remarks'))
                                                <div class="uk-text-danger">{{ $errors->first('remarks') }}</div>
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
        $("#generate").on("click",function () {
            var newcodegen = null;
            newcodegen= generate();
            $("#code_name").val(newcodegen);

            newcode = newcodegen;
            $.get(newcodeurl,{ code_name:newcode},function (data) {
                if(parseInt(data)){
                    $("#code_msg").text("Already Exist. please try another").css("color","red");
                }else{
                    $("#code_msg").text("Available").css("color","#7cb342");
                }
            });
        });

        $('#sidebar_pms').addClass('current_section');
        $('#sidebar_pms_emp_view').addClass('act_item');
        var newcodeurl = "{{ route("pms_employees_newCode") }}";
        var newcode = null;
        $("#code_name").on("keyup blur input",function () {
          newcode = $(this).val();
         $.get(newcodeurl,{ code_name:newcode},function (data) {
           if(parseInt(data)){
            $("#code_msg").text("Already Exist. please try another").css("color","red");
            }else{
               $("#code_msg").text("Available").css("color","#7cb342");
           }
         })
        })
    </script>
    <script src="{{ asset("admin/assets/js/pages/redeyeCustom.js") }}"></script>
@endsection