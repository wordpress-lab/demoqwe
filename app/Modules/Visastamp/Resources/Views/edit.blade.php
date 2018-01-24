@extends('layouts.main')
@section('title')
    Visa Stamp Edit
@endsection

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection


@section('content')

    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <form action="{{ route('visastamp_update',$recruit->visas['id']) }}" method="post" enctype="multipart/form-data" class="uk-form-stacked" id="user_edit_form">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
                                {{ csrf_field() }}
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate" id="user_edit_uname"> Edit Visa Stamp</span></h2>
                                </div>
                            </div>
                            <div class="user_content">

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Type<span style="color: red;font-size: 20px">*</span></label>
                                    </div>

                                    <div class="uk-width-medium-2-6">
                                        <select onchange="onTypeSelected()" name="type" title="type" id="type" name="type" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}">
                                            <option value="1">Outgonig</option>
                                            <option value="2">Incoming</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="uk-grid" id="sending_date">
                                    <div class="uk-width-medium-1-5">
                                        <label class="uk-vertical-align-middle" for="start_date">Send Date </label>
                                    </div>
                                    <div class="uk-width-1-3">
                                        <label for="start_date">Sending date </label>
                                        <input class="md-input" type="text" value="{!! $recruit->visas['send_date']  !!}" name="send_date" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                    </div>
                                </div>

                                <div class="uk-grid" id="return_date">
                                    <div class="uk-width-medium-1-5">
                                        <label class="uk-vertical-align-middle" for="start_date">Return Date <span style="color: red;font-size: 20px">*</span></label>
                                    </div>
                                    <div class="uk-width-1-3">
                                        <label for="start_date">Return date </label>
                                        <input class="md-input" type="text" value="{!! $recruit->visas['return_date'] !!}"  name="return_date" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                    </div>
                                    <div class="uk-width-medium-1-4">
                                        <label class="uk-vertical-align-middle" for="start_date">
                                        <span class="icheck-inline">
                                            @if($recruit->visas['return_date'])
                                            <input type="checkbox" name="generate" checked value="1" id="val_check_ski" data-md-icheck data-parsley-mincheck="2" />
                                                @else
                                                <input type="checkbox" name="generate" value="1" id="val_check_ski" data-md-icheck data-parsley-mincheck="2" />
                                            @endif
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
                                        <textarea name="comment" id="" cols="10" rows="5" class="md-input">{!! $recruit->visas['comment'] !!}</textarea>
                                    </div>
                                </div>

                                <div class="uk-grid" id="file">
                                    <div class="uk-width-medium-1-5">
                                        <label class="uk-vertical-align-middle" for="start_date">Upload<span style="color: red;font-size: 20px">*</span></label>
                                    </div>
                                    <div class="uk-width-2-6">
                                        <input class="md-input" type="file"  name="img_url">
                                        @if($errors->has('img_url'))
                                            <span style="color:red">{!!$errors->first('img_url')!!}</span>
                                        @endif
                                    </div>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <img src="{!! asset('all_image/') !!}/{!! $recruit->visas['img_url'] !!}" alt="...." height="60" width="150"/>
                                    </div>
                                </div>

                                <div class="uk-grid" id="eapplication">
                                    <div class="uk-width-medium-1-5">
                                        <label class="uk-vertical-align-middle" for="start_date">Sub Visa Number<span style="color: red;font-size: 20px">*</span></label>
                                    </div>
                                    <div class="uk-width-2-6">
                                        <input class="md-input visa_check" type="text"  name="eapplication_no" id="form_eapplication_no" value="{!! $recruit->visas['eapplication_no'] !!}">
                                        <div class="uk-text-danger" id="sub_visa_error"></div>
                                        @if($errors->has('eapplication_no'))
                                            <span style="color:red">{!!$errors->first('eapplication_no')!!}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Register Serial<span style="color: red;font-size: 20px">*</span></label>
                                    </div>
                                    <div class="uk-width-1-3">
                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-1">
                                                <select required id="registerSerial_id" class="md-input data" onchange="myFunction()" name="registerSerial_id[]">
                                                    <option value="" disabled selected hidden>Select Register Serial...</option>
                                                    @foreach($entry as $key=>$value)

                                                        @if(($value['totalserial']>0) || ($value->id==$recruit->registerSerial_id))
                                                            @if($value->id==$recruit->registerSerial_id)
                                                               <option value="{!! $value['id'] !!}/{!! $value['totalserial'] !!}" selected>{!! $value['registerSerial'] !!}</option>
                                                                @else
                                                                <option value="{!! $value['id'] !!}/{!! $value['totalserial'] !!}">{!! $value['registerSerial'] !!}</option>
                                                                @endif
                                                        @endif

                                                    @endforeach
                                                </select>
                                                @if($errors->has('registerSerial_id'))
                                                    <div class="uk-text-danger">{{ $errors->first('registerSerial_id') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="customer_name">Pax Id<span style="color: red;font-size: 20px">*</span></label>
                                    </div>
                                    <div class="uk-width-1-3">
                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-1">
                                                <select id="select_demo_1" class="md-input" name="pax_id">
                                                    <option value="" disabled selected hidden>Select...</option>
                                                    @foreach($order as $value)
                                                        @if($value->id==$recruit->id)
                                                            <option  selected value="{!! $value->id !!}">{!! $value->paxid !!}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @if($errors->has('pax_id'))
                                                    <div class="uk-text-danger">{{ $errors->first('pax_id') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="uk-grid">
                                    <div class="uk-width-1-1 uk-float-right">
                                        <button type="submit" id="submit_button" onclick="calla()" class="md-btn md-btn-primary" >Submit</button>
                                        <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <script type="text/javascript">
        var selected_register = "{{ $recruit->registerSerial_id }}";

        var recruit_list ={};
        var recruit_list_url ="{{ route("visa_stamp_recruitJson") }}";
        window.onload=function () {
            $("#sidebar_recruit").addClass('current_section');
            $("#visa_stamp_to").addClass('act_item');
            $("#tiktok2").trigger('click');

            $.get(recruit_list_url,function (data) {
                recruit_list  = data;


            });
             $('#sending_date').show();
             $('#return_date').hide();
            $('#eapplication').hide();
            $('#file').hide();
        }

        function onTypeSelected() {
            var type = document.getElementById("type").value;
            if (type == 2) {

                $('#return_date').show();
                $('#sending_date').hide();
                $("#registerSerial_id").empty();
                $("#registerSerial_id").append("<option disabled selected hidden value=''>Select Register serial </option>");
                $.each(recruit_list, function(key, data){

                        if(data.id==selected_register)
                        {

                            $("#registerSerial_id").append("<option selected value="+data.id+"/"+data.totalserial+">"+data.registerSerial+"</option>");

                        }
                        else
                        {
                            $("#registerSerial_id").append("<option value=" + data.id + "/" + data.totalserial + ">" + data.registerSerial + "</option>");
                        }

                });
            }
            else {
                $('#sending_date').show();
                $('#return_date').hide();

                $("#registerSerial_id").empty();
                $("#registerSerial_id").append("<option disabled selected hidden value=''>Select Register serial </option>");
                $.each(recruit_list, function(key, data){

                    if(data.totalserial>0 || data.id==selected_register)
                    {

                        if(data.id==selected_register)
                        {

                            $("#registerSerial_id").append("<option selected value="+data.id+"/"+data.totalserial+">"+data.registerSerial+"</option>");

                        }
                        else
                        {
                            $("#registerSerial_id").append("<option value=" + data.id + "/" + data.totalserial + ">" + data.registerSerial + "</option>");
                        }
                    }

                });
            }

            if (type==2){
                $('#eapplication').show();
                $('#file').show();
            }else{
                $('#eapplication').hide();
                $('#file').hide();
            }

        }
    </script>



    <script type="text/javascript">
        function calla(){
            var type=document.getElementById("type").value;
            if (type==2){
                var form_data=$("#user_edit_form").serializeArray();
                var error_free=true;
                    var element=$(".visa_check");
                    element.each(function( index ) {
                        var valid=$(this).val();
                        var error_element=$("span", element.parent());
                        if (!valid){
                            error_free=false;
                            $(this).parent().parent().find(".uk-text-danger").html("This filed is required for incoming");
                        }
                        else{
                            $(this).parent().parent().find(".uk-text-danger").html(" ");
                        }
                    });
                if (!error_free){
                    event.preventDefault(); 
                }
                else{
                }
            }
        }
    </script>
    

@endsection

