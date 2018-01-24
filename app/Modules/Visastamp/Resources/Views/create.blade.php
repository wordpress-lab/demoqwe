@extends('layouts.admin')

@section('title', 'Add Visa Stamp')

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

                @if(Session::has('error'))
                    <div class="uk-alert uk-alert-danger" data-uk-alert>
                        <a href="#" class="uk-alert-close uk-close"></a>
                        {!! Session::get('error') !!}
                    </div>
                @endif
            {!! Form::open(['url' => route('visastamp_store'), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Add New Visa Stamp </span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-5 uk-vertical-align">
                                <label class="uk-vertical-align-middle" for="customer_name">Type</label>
                            </div>

                            <div class="uk-width-medium-2-6">
                                <select onchange="onTypeSelected()" name="type" title="type" id="type" name="type" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}">
                                    <option @if(old('type')==1) selected @endif value="1">Outgoing </option>
                                    <!-- <option @if(old('type')==2) selected @endif value="2">Incoming </option> -->
                                </select>
                                @if($errors->has('send_date'))
                                    <span style="color:red">{!!$errors->first('send_date')!!}</span>
                                @endif
                            </div>
                        </div>
                        <div class="uk-grid" id="sending_date">
                            <div class="uk-width-medium-1-5">
                                <label class="uk-vertical-align-middle"  for="start_date">Sending date </label>
                            </div>
                            <div class="uk-width-2-6">
                                <label for="start_date">Sending date </label>
                                <input class="md-input" type="text"  name="send_date" data-uk-datepicker="{format:'YYYY-MM-DD'}">

                            </div>

                        </div>
                        <div class="uk-grid" id="return_date">
                            <div class="uk-width-medium-1-5">
                                <label class="uk-vertical-align-middle" for="start_date">Return date </label>
                            </div>
                            <div class="uk-width-2-6">
                                <label for="start_date">Return date </label>
                                <input class="md-input" type="text"  name="return_date" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                @if($errors->has('return_date'))
                                    <span style="color:red">{!!$errors->first('return_date')!!}</span>
                                @endif
                            </div>
                            <div class="uk-width-medium-1-4">
                                <label class="uk-vertical-align-middle" for="start_date">
                                    <span class="icheck-inline">
                                        <input type="checkbox" name="generate" value="1" id="val_check_ski" data-md-icheck data-parsley-mincheck="2" />
                                        <label for="val_check_ski" class="inline-label"> <span style="color: green">Generate Invoice and Bill</span></label>
                                    </span>
                                </label>
                            </div>
                        </div>

                            <div class="uk-grid" id="return_date">
                                <div class="uk-width-medium-1-5">
                                    <label class="uk-vertical-align-middle" for="start_date">Comments </label>
                                </div>
                                <div class="uk-width-2-6">
                                    <label for="start_date">Comments</label>
                                    <textarea name="comment" id="" cols="10" rows="5" class="md-input"></textarea>
                                </div>
                            </div>
                      </div>



                        {{--<div class="uk-grid" data-uk-grid-margin>--}}

                            {{--<div class="uk-width-medium-1-5 uk-vertical-align">--}}
                                {{--<label class="uk-vertical-align-middle" for="Local">Register Serial<span style="color: red">*</span></label>--}}
                            {{--</div>--}}
                            {{--<div class="uk-width-medium-2-5">--}}
                                {{--<label for="Local">RegisterSerial </label>--}}
                                {{--<select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Serail" id="local_ref" name="registerSerial_id">--}}
                                    {{--<option>Select RegisterSerial</option>--}}
                                    {{--@foreach($registerserial as $value)--}}
                                        {{--<option value=" {{ $value->id }} " > {{ $value->registerSerial }} </option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}
                        {{--</div>--}}


                        <div class="uk-grid" data-uk-grid-margin style="padding-left: 100px">
                            <div class="uk-width-medium-3-5">
                                <div class="md-card">
                                    <div class="md-card-content">
                                        <form action="" data-parsley-validate>
                                            <div class="uk-grid uk-grid-medium form_section form_section_separator" id="d_form_section" data-uk-grid-match>
                                                <div class="uk-width-9-10">
                                                    <div class="uk-grid">
                                                        <div class="uk-width-1-1">
                                                            <div class="parsley-row" id="eapplication">
                                                                <label>Sub Visa Number</label>
                                                                <input type="text" class="md-input visa_check" name="eapplication_no[]" id="form_eapplication_no"  required>
                                                            </div>
                                                            <div class="uk-text-danger" id="sub_visa_error"></div>
                                                            @if($errors->has('eapplication_no'))
                                                                <div class="uk-text-danger">{{ $errors->first('eapplication_no') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="uk-grid">
                                                        <div class="uk-width-1-1">
                                                            <div class="uk-grid" data-uk-grid-margin>
                                                                <div class="uk-width-medium-1-1">
                                                                    <select required id="select_demo_1" class="md-input" name="pax_id[]" onchange="recruitDetails(this)">
                                                                        <option value="" disabled selected hidden>Select Pax ...</option>
                                                                            @foreach($recruit as $value)
                                                                                <option value="{!! $value->id !!}">{!! $value->paxid !!}</option>
                                                                            @endforeach
                                                                    </select>
                                                                    <input id="remarks" class="md-input" readonly style="border:none; color: green;">
                                                                    @if($errors->has('pax_id'))
                                                                        <div class="uk-text-danger">{{ $errors->first('pax_id') }}</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="uk-grid">
                                                        <div class="uk-width-1-1">
                                                            <div class="uk-grid" data-uk-grid-margin>
                                                                <div class="uk-width-medium-1-1">
                                                                    <select required id="registerSerial_id" class="md-input data" onchange="myFunction()" name="registerSerial_id[]">
                                                                        <option value="" disabled selected hidden>Select Register Serial...</option>

                                                                    </select>
                                                                        <span style="color:red" id="danger"></span>
                                                                        <span style="color:green" id="success"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="uk-grid">
                                                        <div class="uk-width-1-1">
                                                            <div class="parsley-row" id="file">
                                                                <input type="file" class="md-input" name="img_url[]" required>
                                                                @if($errors->has('img_url'))
                                                                    <div class="uk-text-danger">{{ $errors->first('img_url') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="uk-width-1-10 uk-text-center">
                                                    <div class="uk-vertical-align uk-height-1-1">
                                                        <div class="uk-vertical-align-middle">
                                                            <a href="#" class="btnSectionClone" data-section-clone="#d_form_section"><i class="material-icons md-36">&#xE146;</i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                                <div class="uk-grid" data-uk-grid-margin-bottom>
                                    <div class="uk-width-medium-1-5">

                                    </div>
                                    <div class="uk-width-1-5" id="button">
                                        <button type="submit" id="ttttt" onclick="calla()" class="md-btn md-btn-primary" >Submit</button>
                                        <a href="{{ url()->previous() }}" type="button" class="md-btn md-btn-flat uk-modal-close">Close</a>
                                    </div>
                                </div>
                       <br/>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>



    {{--<script>--}}

        {{--function myFunction() {--}}

           {{--var data=$('.data').val();--}}

            {{--$.ajax({--}}
                {{--type: "post",--}}
                {{--url: "{!! route('visastamp_test') !!}",--}}
                {{--data: {id: data},--}}
                {{--success: function (data) {--}}

                   {{--if (data.status){--}}
                       {{--$('#danger').html(data.status).fadeIn();--}}
                       {{--$('#success').html('Data Available').fadeOut();--}}
                       {{--$('#ttttt').hide();--}}

                   {{--}else{--}}
                       {{--$('#danger').html(data.status).fadeOut();--}}
                       {{--$('#success').html('Data Available').fadeIn();--}}
                       {{--$('#ttttt').show();--}}
                   {{--}--}}
                {{--}--}}
            {{--});--}}

        {{--}--}}

    {{--</script>--}}

    <script>
        $("#customer_id").clone().prependTo("#customer_id");


    </script>

    <script>
        var recruit_list ={};
        var recruit_list_url ="{{ route("visa_stamp_recruitJson") }}";

        var main_node=document.getElementById('repeat0');
        var i=0;
        function addrow()
        {
            var clo=main_node.cloneNode(true);
            clo.id="repeat" + (++i);
            main_node.parentNode.appendChild(clo);
        }

        window.onload=function ()
        {
            $.get(recruit_list_url,function (data) {
                recruit_list  = data;


            });

            $('#sending_date').show();
            $('#return_date').hide();
            $('#eapplication').hide();
            $('#file').hide();
            setTimeout(function(){
                $.each(recruit_list, function(key, data){
                    
                    if(data.totalserial>0)
                    {
                        $("#registerSerial_id").append("<option value="+data.id+"/"+data.totalserial+">"+data.registerSerial+"</option>");
                    }
                });
            }, 3000);
            // document.getElementById("sending_date").style.display = 'none';
            // document.getElementById("return_date").style.display = 'block';
        }
        function onTypeSelected(){

            var type=document.getElementById("type").value;
            if(type==2)
            {
                document.getElementById("sending_date").style.display='none';
                document.getElementById("return_date").style.display='block';
                $("#registerSerial_id").empty();
                $("#registerSerial_id").append("<option disabled selected hidden value=''>Select Register serial </option>");
                $.each(recruit_list, function(key, data){

                       $("#registerSerial_id").append("<option value="+data.id+"/"+data.totalserial+">"+data.registerSerial+"</option>");


                });

            }
            else
            {
                document.getElementById("sending_date").style.display='block';
                document.getElementById("return_date").style.display='none';
                $("#registerSerial_id").empty();
                $("#registerSerial_id").append("<option disabled selected hidden value=''>Select Register serial </option>");
                $.each(recruit_list, function(key, data){

                    if(data.totalserial>0)
                    {
                        $("#registerSerial_id").append("<option value="+data.id+"/"+data.totalserial+">"+data.registerSerial+"</option>");
                    }

                });
            }

           if (type==2)
           {
               $('#eapplication').show();
               $('#file').show();
           }
           else
           {
               $('#eapplication').hide();
               $('#file').hide();
           }

        }
    </script>

    <script type="text/javascript">
        function calla(){
            var type=document.getElementById("type").value;
            if (type==2){
                var form_data=$("#my_profile").serializeArray();
                var error_free=true;
                    var element=$(".visa_check");
                    element.each(function( index ) {
                        var valid=$(this).val();
                        var error_element=$("span", element.parent());
                        if (!valid){
                            error_free=false;
                            $(this).parent().parent().parent().find(".uk-text-danger").html("This filed is required for incoming");
                        }
                        else{
                            $(this).parent().parent().parent().find(".uk-text-danger").html(" ");
                        }
                    });
                if (!error_free){
                    event.preventDefault(); 
                }
                else{
                }
            }
        }

        function recruitDetails(ele){
            var pax_id = $(ele).val();
            console.log($(ele).parent().parent().find('#remarks').html());
            $.get("{{route('visa_stamp_recruitDetailsJson',['id' => ''])}}/"+pax_id,function(data){
                if($.isEmptyObject(data)){
                    $(ele).parent().parent().find('#remarks').val(' ');
                }else{
                    $(ele).parent().parent().find('#remarks').val(data.remarks);
                }
            });
            
        }

        
    </script>


@endsection

@section('scripts')
<script>
    $('#sidebar_recruit').addClass('current_section');
    $('#visa_stamp_to').addClass('act_item');
</script>
@endsection

