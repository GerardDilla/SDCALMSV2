class Dashboard_Calendar{
    constructor(){
        this.classes = [];
        this.events = [];
    }
    async fetchClasses(){
        return new Promise((resolve,reject)=>{
            $.ajax({
                url:$('#base_url').val()+'index.php/Dashboard/getClasses',
                method:'post',
                dataType:'json',
                success:function(data){
                    resolve(data)
                }

            })
        }).then(data=>data);
    }
    async renderEvents(){
        this.classes = await this.fetchClasses();
        // console.log(this.classes)
        const dateFilter = (day) => {
            if(day == 'Sun'){
                return '0';
            }
            else if(day == 'M'){
                return '1';
            }
            else if(day == 'T'){
                return '2';
            }
            else if(day == 'W'){
                return '3';
            }
            else if(day == 'H'){
                return '4';
            }
            else if(day == 'F'){
                return '5';
            }
            else if(day == 'S'){
                return '6';
            }
        } 
        var events_list = [];
        var count = 0;
        $.each(this.classes,function(index,value){
            // console.log(value.Day)
            
            if(value.Day!=undefined&&value.Day!=null){
                var day_value = value.Day;
                var day_split = day_value.split(",");
                $.each(day_split,function(index_split,value_split){
                    console.log(value_split)
                        events_list.push({
                            'title' : `${value.Course_Title}`,
                            groupId: 'blueEvents', // recurrent events in this group move together
                            daysOfWeek: [ dateFilter(value_split) ],
                            startTime: value.time_start,
                            endTime: value.time_end
                        });
                    // if(count==0){
                    //     events_list = {
                    //         'title' : `${value.Course_Title}`,
                    //         groupId: 'blueEvents', // recurrent events in this group move together
                    //         daysOfWeek: [ dateFilter(value_split) ],
                    //         startTime: value.time_start,
                    //         endTime: value.time_end
                    //     };
                    // }
                    // else{
                    //     events_list += {
                    //         'title' : `${value.Course_Title}`,
                    //         groupId: 'blueEvents', // recurrent events in this group move together
                    //         daysOfWeek: [ dateFilter(value_split) ],
                    //         startTime: value.time_start,
                    //         endTime: value.time_end
                    //     };
                    // }
                });
            ++count;
            }
        });
        return events_list;
        // alert(this.classes[0])
    }
    async removeDefaultButtons(){
        $('.fc-today-button').hide();
    }
    async renderCalendar(variable){
        
        // if(){

        // }
        const events = await this.renderEvents();
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: variable,
			timeFormat: 'h:mm',
			editable: true,
			droppable: true, // this allows things to be dropped onto the calendar !!!
            // plugins: [ dayGridPlugin, interactionPlugin ],
            events: events,
            
            // editable: true
        });
        calendar.render();
        }
    }

document.addEventListener('DOMContentLoaded', function() {
    var dashboardCalendar = new Dashboard_Calendar();
    dashboardCalendar.renderCalendar('dayGridMonth');
    dashboardCalendar.removeDefaultButtons();
    $('#filterDayType').on('change',function(){
        // alert(this.value)
        $('#calendar').destroy();
        dashboardCalendar.renderCalendar(this.value);
    });
});

