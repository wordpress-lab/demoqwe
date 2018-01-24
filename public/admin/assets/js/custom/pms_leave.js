
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
                value: today,
                change: startChange,
                parseFormats: ["MM/dd/yyyy"]
            }).data("kendoDateTimePicker");

            var end = $("#end").kendoDateTimePicker({
                value: today,
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
                        $('#leave_left').html(count_date(leave)+" Left");
                        $("#leave_left").css("color", "red");
                    }
                    else{
                        $('#leave_left').html(count_date(leave)+" Available");
                        $("#leave_left").css("color", "green");
                    }
                    

                });
                
            });

        });

        $('#pms_employee_id').on('change',function(){

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
                        $('#leave_left').html(count_date(leave)+" Left");
                        $("#leave_left").css("color", "red");
                    }
                    else{
                        $('#leave_left').html(count_date(leave)+" Available");
                        $("#leave_left").css("color", "green");
                    }
                    

                });
                
            });

        });
        