@extends('layouts.main')

@section('title', 'Iqama delivery Clearance ')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')

    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>

                <div class="uk-width-xLarge-10-10  uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New Iqama delivery clearance</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                {!! Form::open(['url' => route('iqama_Delivery_Clearance_store'), 'method' => 'POST', 'files' => 'true', 'enctype' => 'multipart/form-data' , 'onsubmit' => 'return upload();']) !!}
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="name" class="uk-vertical-align-middle">Pax Id <i style="color: red">*</i></label>
                                    </div>
                                    <div class="uk-width-medium-2-3">

                                        <select required id="selec_adv_1" name="recruitingorder_id[]" multiple>
                                            @foreach($recruit as $item)
                                                <option value="{{ $item->id }}" >{{ $item->paxid }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->first('recruitingorder_id'))
                                            <div class="uk-text-danger">Pax is required.</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="contact" class="uk-vertical-align-middle">Status <i style="color: red">*</i></label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                       <span class="icheck-inline">
                                            <input value="1" type="radio" name="status" id="radio_demo_1" data-md-icheck />
                                            <label for="radio_demo_1" class="inline-label">Yes</label>
                                        </span>
                                           <span class="icheck-inline">
                                            <input  value="0" type="radio" name="status" id="radio_demo_2" data-md-icheck />
                                            <label for="radio_demo_2" class="inline-label">No</label>
                                        </span>
                                           @if($errors->first('status'))
                                            <div class="uk-text-danger">Status is required.</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1">
                                        <div class="uk-form-row">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5">
                                                    <label>Comments:</label>
                                                </div>
                                                <div class="uk-width-medium-1-2">
                                                    <label for="comments">Comments</label>
                                                    <input type="text" id="comments" class="md-input" name="comments"/>
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


                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-5 uk-vertical-align">

                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <div class="uk-width-1-1 uk-float-right">
                                            <button type="submit" class="md-btn md-btn-primary">Submit</button>
                                            <a href="{{ URL::previous() }}" >  <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button></a>
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
        });

        function upload(){
            var comment = $('#comments').val();
            var file_url = $('#file_url').val();

            if(comment=='' && file_url==''){
                $('#all_msg').html("Comment Field Or File Field choosen first");
                return false;
            }

            // if(comment=='' || file_url==''){

            //     if(comment==''){
            //         $('#comment_msg').html("Comment Field is required");
            //         return false;
            //     }
            //     if(file_url==''){
            //         $('#file_msg').html("File Field is required");
            //         return false;
            //     }
                
            // }
            else{
                return true;
            }
            
        }

    </script>
@endsection