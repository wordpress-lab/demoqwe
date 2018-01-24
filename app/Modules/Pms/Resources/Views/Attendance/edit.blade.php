@extends('layouts.main')

@section('title', 'Pms Attendance edit')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit Pms Attendance</span></h2>
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
                            {!! Form::open(['url' => route('pms_attendance_update',['id'=>$site->id,'date'=>$date]), 'method' => 'POST','files' => true]) !!}
                            <div class="user_content">
                                <div class="uk-margin-top">

                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="Local">Date </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label class="uk-vertical-align-middle" for="Local">{{ date('d-m-Y', strtotime($date)) }} </label>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="company_name">Site Name </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label class="uk-vertical-align-middle" for="company_name">{{ $site->company_name }}</label>
                                        </div>
                                    </div>
                                    
                                    <hr>

                                    
                                        
                                        <table class="uk-table uk-table-hover" id="dt_individual_searchs">
                                            <thead>
                                            <tr>
                                                <th>Employee Name</th>
                                                <th>Entrance Time</th>
                                                <th>Leave Time</th>
                                                <th>Over Time</th>
                                                <th>Absense</th>
                                                <th>Leave</th>
                                            </tr>
                                            </thead>

                                            <tbody id="attendance_list_tbody">
                                            <?php $j=1; $k=0?>
                                            @foreach($attendance as $all)
                                            <?php $i=$loop->index; ?>
                                                <tr>
                                                    <td>{{ 'EMP-'.$all->code_name }}</td>
                                                    <td><input class='md-input' type='text' name='entrance_time[]' id='entrance_time' value='{!!$all->entrance_time!!}' {{ (($all->leave_from!=null)&&($all->leave_to!=null))?'readonly':'data-uk-timepicker={format:"12h"}' }}></td>
                                                    <td><input class='md-input' type='text' name='leave_time[]' id='uk_tp_1' value='{!!$all->leave_time!!}' onchange='leaveTime(this,{{$k++}})' {{ (($all->leave_from!=null)&&($all->leave_to!=null))?'readonly':'data-uk-timepicker={format:"12h"}' }}></td>
                                                    <td><input class='md-input' type='text' name='overtime[]' id='over_time' value='{!!$all->overtime!!}' data-work="{!! $all->employeeId['daily_work_hour'] !!}" {{ (($all->leave_from!=null)&&($all->leave_to!=null))?'readonly':'' }}></td>
                                                    <td><input type='hidden' name='absense[{{ $i }}]' value=0><input type='checkbox' name='absense[{{ $i }}]' class='squaredOne' value='1' {{ $all->absense==1?'checked':'' }} onclick="absense({{$j++}});"></td>
                                                    <td><input type="checkbox" class='squaredOne' disabled {{ (($all->leave_from!=null)&&($all->leave_to!=null))?"checked":"" }} title="{{ (($all->leave_from!=null)&&($all->leave_to!=null))?"From: $all->leave_from to $all->leave_to":"" }}"></td>
                                                    <td hidden><input class='md-input' type='text' name='pms_employee_id[]' id='uk_tp_1' value='{!!$all->id!!}'></td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    
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

        function absense(x){
            var entrance_time = document.getElementById('dt_individual_searchs').rows[x].cells[1].children[0].innerHTML;

            var absense = document.getElementById('dt_individual_searchs').rows[x].cells[3].children[1];

            // if(absense.checked == true){
            //     entrance_time.removeAttribute("data-uk-timepicker");
            //     entrance_time.readOnly = true;
            // }

            console.log(entrance_time);
        }

        function leaveTime(data,x){
            
            var entrance_time_main = document.getElementById('attendance_list_tbody').rows[x].cells[1];
            var entrance_time = $(entrance_time_main).find('#entrance_time').val();
            var leave_time = $(data).val();

            var daily_work_hour_main = document.getElementById('attendance_list_tbody').rows[x].cells[3];
            var daily_work_hour = $(daily_work_hour_main).find('#over_time').data('work');

            var overtime_main = document.getElementById('attendance_list_tbody').rows[x].cells[3];


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