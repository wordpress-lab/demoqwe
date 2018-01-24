@extends('layouts.main')

@section('title', ' Owner Iqama Clearance Approval')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Owner Clearance Approval</span></h2>

                            </div>
                        </div>
                    </div>
                    <br><br>
                    {!! Form::open(['method' => 'POST', 'enctype' => 'multipart/form-data' , 'id' => 'myForm']) !!}

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5">
                                        <label>Comments:</label>
                                    </div>
                                    <div class="uk-width-medium-1-2">
                                        <label for="comments">Comments</label>
                                        <input type="text" id="comments" class="md-input" name="comments" value="{{ $recruit['comments'] }}"/>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-5 uk-vertical-align">
                            <label for="contact" class="uk-vertical-align-middle">Update</label>
                        </div>
                        <div class="uk-width-medium-2-5">
                            <div class="md-card">
                                <div class="md-card-content">
                                    <div class="uk-grid form_section" id="d_form_row">
                                        <div class="uk-width-1-1">
                                            <div class="uk-input-group">
                        
                                                <input type="file" class="md-input" name="file_url" id="file_url">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <span style="color: red;" id="all_msg"></span>
                        </div>
                    </div>


                    <div class="uk-grid" style="padding-top: 2px">
                        <div class="uk-width-1-1">
                            <h2 style="padding: 15px; background-color: #003377 ;color: white; margin-bottom: 25px; text-align: center">
                                @if(is_null($recruit["iqamaclearance_status"]))
                                  Still now no Approval
                                @elseif($recruit["iqamaclearance_status"])
                                    Already Approved
                                @elseif($recruit["iqamaclearance_status"]==0)
                                    Not Approved
                                @else
                                @endif
                            </h2>
                        </div>
                        <div class="uk-width-1-1">

                            <div class="uk-grid uk-grid-width-1-1 uk-grid-width-large-1-2" data-uk-grid-margin>

                                <div>
                                    <button type="submit" id="first_btn" class="md-btn md-btn-facebook md-btn-large md-btn-block md-btn-icon"><i class="material-icons">&#xE876;</i>Yes</button>
                                </div>
                                <div>
                                    <button type="submit" id="second_btn" class="md-btn md-btn-gplus md-btn-large md-btn-block md-btn-icon"><i class="material-icons">&#xE14C;</i>No</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#sidebar_recruit').addClass('current_section');
        $('#iqama_delivery_clearance').addClass('act_item');
        $(window).load(function(){
            $("#tiktok2").trigger('click');
            $("#iqama_tiktok").trigger('click');
            $("#iqama_tiktok_delivery").trigger('click');
        })

        $('#first_btn').click(function(){
            var form = document.getElementById("myForm")
            form.action = "{{ route('iqama_Delivery_Approval_update',['status'=>1,'id'=>$recruit->id]) }}";
            form.submit();
        });

        $('#second_btn').click(function(){
            var form = document.getElementById("myForm")
            form.action = "{!! route('iqama_Delivery_Approval_update',['status'=>0,'id'=>$recruit->id]) !!}";
            form.submit();
        });

    </script>
@endsection
