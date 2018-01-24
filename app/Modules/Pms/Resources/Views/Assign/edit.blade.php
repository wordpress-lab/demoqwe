@extends('layouts.main')

@section('title', 'Leave Assign Edit')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit new sites assign</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                {!! Form::open(['url' => route('pms_leave_assign_update',$assign->id), 'method' => 'POST', 'files' => true]) !!}
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="name" class="uk-vertical-align-middle">Employee</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                       <select id="pms_employee_id" class="md-input" name="pms_employee_id" disabled>
                                            <option value="">Select Employee...</option>
                                            @foreach($employee as $all)
                                            <option value="{{ $all->id }}" {{ ($all->id == $assign->pms_employee_id)?'selected':'' }}>EMP-{{ $all->code_name }}</option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="name" class="uk-vertical-align-middle">Allowed Leave</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                       <label for="leave_left" id="leave_left" class="uk-vertical-align-middle">0 days</label>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="name" class="uk-vertical-align-middle">From</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                       <div class="demo-section k-content">
                                            <div class="uk-form-row">
                                                <input type="text" id="start" name="start" value="{{ $assign->leave_from }}"/>
                                                @if($errors->has('start'))
                                                    <div class="uk-text-danger">{{ $errors->first('start') }}</div>
                                                @endif
                                            </div>
                                            <div class="uk-form-row">
                                                <input type="text" id="end" name="end" value="{{ $assign->leave_to }}"/>
                                                @if($errors->has('end'))
                                                    <div class="uk-text-danger">{{ $errors->first('end') }}</div>
                                                @endif
                                            </div>
                                        </div>
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
        $('#sidebar_pms').addClass('current_section');
        $('#pms_leave_assign').addClass('act_item');
        $(window).load(function(){
            $("#pms_tiktok").trigger('click');
            $("#pms_payroll_leave_tiktok").trigger('click');
        })
    </script>

    <script type="text/javascript">
        // $('.k-content :input').kendoDateTimePicker({
        //   value: new Date()
        // });

        $(document).ready(function() {
            function startChange() {
                var startDate = start.value(),
                endDate = end.value();

                var date = new Date(startDate), y = date.getFullYear(), m = date.getMonth();
                var firstDay = new Date(y, 0, 1);
                var lastDay = new Date(y, m + 1, 0);

                var lastDayYear = new Date(y, 12, 0);

                console.log(lastDayYear);
                //var e = new Date(startDate);

                if (startDate) {
                    startDate = new Date(startDate);
                    startDate.setDate(startDate.getDate());
                    //console.log(startDate.setDate(startDate.getDate()));
                    end.min(startDate);
                    end.max(lastDayYear);
                } else if (endDate) {
                    start.max(new Date(endDate));
                } else {
                    endDate = new Date();
                    start.max(endDate);
                    end.min(endDate);
                }
            }

            function endChange() {
                var endDate = end.value(),
                startDate = start.value();
                
                var e = new Date(startDate);

                //console.log(e.getFullYear());

                if (endDate) {
                    endDate = new Date(endDate);
                    endDate.setDate(endDate.getDate());
                    start.max(endDate);
                } else if (startDate) {
                    end.min(new Date(startDate));
                } else {
                    endDate = new Date();
                    start.max(endDate);
                    end.min(endDate);
                }
            }

            var today = kendo.date.today();

            var start = $("#start").kendoDateTimePicker({
                
                change: startChange,
                parseFormats: ["MM/dd/yyyy"]
            }).data("kendoDateTimePicker");

            var end = $("#end").kendoDateTimePicker({
                
                change: endChange,
                parseFormats: ["MM/dd/yyyy"]
            }).data("kendoDateTimePicker");
            //console.log(lastDayYear);
            //start.min(start.value());
            end.min(start.value());
        });

        $('#start').on('change',function(){
            var start = $('#start').val();

            dt1 = new Date(start);
            //console.log(dt1);
        });

        $('#end').on('change',function(){
            var start = $('#start').val();
            var end = $('#end').val();

            var pms_employee_id = $('#pms_employee_id').val();

            dt1 = new Date(start);
            dt2 = new Date(end);

            var difference_input = (dt2.getTime() - dt1.getTime());

            //$('#leave_left').html(diff_minutes(dt1,dt2));

            function diff_minutes(dt1, dt2){
                var diff =(dt2.getTime() - dt1.getTime()) / 1000;
                var numdays = Math.floor(diff / 86400);
                var numhours = Math.floor((diff % 86400) / 3600);
                var numminutes = Math.floor(((diff % 86400) % 3600) / 60);
                var numseconds = ((diff % 86400) % 3600) % 60;

                return numdays + " days " + numhours + " hours " + numminutes + " minutes " + numseconds + " seconds";
              // diff /= 60;
              // diff /= 60;
              // diff /= 24;
              //return diff;
              //return Math.abs(Math.floor(diff));
             }

            function count_date(date){
                var last_leave = (date - difference_input)/1000;

                var numdays = Math.abs(Math.floor(last_leave / 86400));
                var numhours = Math.abs(Math.floor((last_leave % 86400) / 3600));
                var numminutes = Math.abs(Math.floor(((last_leave % 86400) % 3600) / 60));
                var numseconds = Math.abs(((last_leave % 86400) % 3600) % 60);

                return numdays + " days " + numhours + " hours " + numminutes + " minutes " + numseconds + " seconds";

            } 

        // Count PMS Leave Settings
            $.get("{{route('pms_leave_day')}}", function(data){
                var allow_leave = (data*86400000);
                $.get("{{route('pms_allow_leave_day',['id'=>''])}}/"+pms_employee_id, function(data2){
                    var leave = (allow_leave - data2);

                    var total_count =  (leave - difference_input);
                    
                    if(total_count<0){
                        $('#leave_left').html(count_date(leave)+" Extra");
                        $("#leave_left").css("color", "red");
                    }
                    else{
                        $('#leave_left').html(count_date(leave)+" Available");
                        $("#leave_left").css("color", "green");
                    }
                    

                });
                
            });

        });

        $(document).ready(function(){

            var pms_employee_id = $('#pms_employee_id').val();

            function count_date(date){
                var last_leave = date/1000;

                var numdays = Math.abs(Math.floor(last_leave / 86400));
                var numhours = Math.abs(Math.floor((last_leave % 86400) / 3600));
                var numminutes = Math.abs(Math.floor(((last_leave % 86400) % 3600) / 60));
                var numseconds = Math.abs(((last_leave % 86400) % 3600) % 60);

                return numdays + " days " + numhours + " hours " + numminutes + " minutes " + numseconds + " seconds";

            }

            $.get("{{route('pms_leave_day')}}", function(data){
                var allow_leave = (data*86400000);
                $.get("{{route('pms_allow_leave_day',['id'=>''])}}/"+pms_employee_id, function(data2){
                    var leave = (allow_leave - data2);
                    
                    if(leave<0){
                        $('#leave_left').html(count_date(leave)+" Extra");
                        $("#leave_left").css("color", "red");
                    }
                    else{
                        $('#leave_left').html(count_date(leave)+" Available");
                        $("#leave_left").css("color", "green");
                    }
                    

                });
                
            });

        });
        
    </script>
    
@endsection