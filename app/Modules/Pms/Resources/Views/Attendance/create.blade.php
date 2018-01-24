@extends('layouts.main')

@section('title', 'Pms Attendance create')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
<style type="text/css">
    
    .squaredOne {
        -webkit-appearance: none;
    background-color: #fafafa;
    border: 10px solid #cacece;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05);
    padding: 9px;
    border-radius: 3px;
    display: inline-block;
    position: relative;
}

.squaredOne:active, .squaredOne:checked:active {
    box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px 1px 3px rgba(0,0,0,0.1);
}

.squaredOne:checked {
    background-color: #e9ecee;
    border: 10px solid #009E89;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05), inset 15px 10px -12px rgba(255,255,255,0.1);
    color: #99a1a7;
}

.squaredOne:checked:after {
    content: '\2714';
    font-size: 15px;
    position: absolute;
    top: -10.5px;
    left: -7px;
    color: white;
}

</style>
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
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New Pms Attendance</span></h2>
                                <div class="uk-width-medium-1-3">
                                    <div class="md-btn-group">
                                        <a href="{{ route('pms_attendance_index') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">All</a>
                                        <a href="{{ route('pms_attendance_create') }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Add</a>
                                        <a href="{{ URL::previous() }}" class="md-btn md-btn-small md-btn-primary md-btn-wave">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md-card">
                            {!! Form::open(['url' => route('pms_attendance_store'), 'method' => 'POST','files' => true,'onsubmit' => 'return myValid();']) !!}
                            <div class="user_content">
                                <div class="uk-margin-top">

                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="Local">Date </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="date">Select Date</label>
                                            <input class="md-input" type="text" id="entry_date" name="date" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{ $entry_date }}" />
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="company_name">Site Name </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <select id="site_id" class="md-input" data-uk-tooltip="{pos:'top'}" title="Select with tooltip" name="pms_site_id">
                                                <option value="">Select Site Name...</option>
                                                @foreach($site as $all)
                                                <option value="{{ $all->id }}">{{ $all->company_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span id="demo" style="color: red;"></span>
                                        @if($errors->first('pms_site_id'))
                                            <div class="uk-text-danger">Side Id is required.</div>
                                        @endif
                                    </div>
                                    
                                    <hr>
                                    <div class="uk-overflow-container uk-margin-bottom">
                                        <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                        <table class="uk-table uk-table-hover" id="attendance_list">
                                            <thead>
                                            <tr>
                                                <th>Employee Name</th>
                                                <th>Entrance Time</th>
                                                <th>Leave Time</th>
                                                <th>Over Time</th>
                                                <th>Absence</th>
                                                <th>Leave</th>
                                            </tr>
                                            </thead>

                                            <tbody id="attendance_list_tbody">

                                            </tbody>
                                        </table>
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
        $('#sidebar_pms').addClass('current_section');
        $('#sidebar_pms_attendance_view').addClass('act_item');

        function myValid(){
            var site_id = $('#site_id').val();
            
            if(site_id == ''){
                $('#demo').html('Site Field is required');
                return false;
            }
            
        }

        $('#site_id').on('change',function(e){

            var entry_date = $('#entry_date').val();
            
            var site_id = e.target.value;

            //ajax
            $.get('/ajax-attendance-site/' + site_id +'/' +entry_date, function(data){

                //Suceess Data
                console.log(data);
                $('#attendance_list > tbody').empty();
                
                $.each(data, function(index, siteObj){
                    var entrance_time = (siteObj.entrance_time==null || siteObj.entrance_time=='undefined')?'00:00':siteObj.entrance_time;
                    var leave_time = (siteObj.leave_time==null || siteObj.leave_time=='undefined')?'00:00':siteObj.leave_time;
                    var over_time = (siteObj.overtime==null || siteObj.overtime=='undefined')?'00':siteObj.overtime;
                    var leave_from = siteObj.leave_from;
                    var leave_to = siteObj.leave_to;

                    var date = new Date(leave_to);

                    var main_date = date.getFullYear()+ '-' +(date.getMonth()+1) + '-' + date.getDate();
                    
                    console.log(main_date==entry_date);

                    $('#attendance_list > tbody').append("<tr><td>EMP-"+siteObj.code_name+"</td><td><input class='md-input' type='text' name='entrance_time[]' id='entrance_time' onchange='entranceTime(this,"+index+")' value='"+entrance_time+"'"+(((leave_to!=null)&&(main_date!=entry_date))?' readonly':' data-uk-timepicker=\"{format:\'12h\'}\"')+"></td><td><input class='md-input' type='text' name='leave_time[]' id='uk_tp_1' value='"+leave_time+"' onchange='leaveTime(this,"+index+")'"+(((leave_to!=null)&&(main_date!=entry_date))?' readonly':' data-uk-timepicker=\"{format:\'12h\'}\"')+"></td><td><input type='text' class='md-input' name='overtime["+index+"]' id='over_time' value='"+over_time+"' data-work='"+siteObj.daily_work_hour+"'></td><td><input type='hidden' name='absense["+index+"]' value=0><input type='checkbox' name='absense["+index+"]' class='squaredOne' value='1'></td><td><input type='checkbox' data-uk-tooltip=\"{pos:\'top\'}\" class='squaredOne' disabled "+(((leave_to!=null)&&(main_date!=entry_date))?'checked title="Leave from: '+siteObj.leave_from+' to '+siteObj.leave_to+'"':'')+"></td><td hidden><input id='daily_work_hour' name='pms_employee_id[]' data-from='"+siteObj.leave_from+"' data-to='"+siteObj.leave_to+"' type='text' value='"+siteObj.id+"'></td></tr>");
                    
                });

            });
        });

        function entranceTime(data,y){
            var entrance_time = new Date("October 13, 2014 "+$(data).val());
            var entrance_time_main = entrance_time.getHours()+':'+entrance_time.getMinutes();

            var leave_to_to = document.getElementById('attendance_list_tbody').rows[y].cells[6];
            var leave_to = $(leave_to_to).find('#daily_work_hour').data('to');

            if(leave_to == null){
                leave_to = "October 13, 2014 00:00:00";
            }

            var leave = new Date(leave_to);
            var leave_to_main = leave.getHours()+':'+leave.getMinutes();

            if(leave_to_main>entrance_time_main){
                $(data).val(leave_to_main);
            }
        }

        function leaveTime(data,x){
            
            var entrance_time_main = document.getElementById('attendance_list_tbody').rows[x].cells[1];
            var entrance_time = $(entrance_time_main).find('#entrance_time').val();
            var leave_time = $(data).val();

            var daily_work_hour_main = document.getElementById('attendance_list_tbody').rows[x].cells[3];
            var daily_work_hour = $(daily_work_hour_main).find('#over_time').data('work');

            var leave_from_main = document.getElementById('attendance_list_tbody').rows[x].cells[6];
            var leave_from = $(leave_from_main).find('#daily_work_hour').data('from');

            console.log(leave_from);

            var overtime_main = document.getElementById('attendance_list_tbody').rows[x].cells[3];

            //console.log(daily_work_hour);

            dt1 = new Date("October 13, 2014 "+entrance_time); 
            dt2 = new Date("October 13, 2014 "+leave_time); 

            //console.log(dt2.getTime());
            //console.log(diff_minutes(dt1, dt2));

            var over_time = diff_minutes(dt1, dt2);

            if(over_time<=0){
                over_time = 0;
            }

            if(daily_work_hour == null){
                daily_work_hour = 0;
            }
            console.log(daily_work_hour);
            var over_time_main = (over_time - daily_work_hour);

            if((daily_work_hour == 0) || (over_time_main <= 0)){
                over_time_main = 0;
            }

            $(overtime_main).find('#over_time').val(over_time_main);

            function diff_minutes(dt1, dt2) 
             {
              var diff =(dt2.getTime() - dt1.getTime()) / 1000;
              diff /= 60;
              diff /= 60;
              return diff;
              //return Math.abs(Math.floor(diff));
             } 

        }

    </script>
    
@endsection