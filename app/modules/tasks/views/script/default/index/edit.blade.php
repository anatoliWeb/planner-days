@extends('template.default.index')

@section('controller')
<div class="row">
    <div>
        <div>
            <div id="fullcalendar"></div>
        </div>
    </div>
</div>
@stop

@section('style')
@stop

@section('script')
<script>

    (function($, win){
                var tasksIndex = function(){
                    this.init();
                };
            tasksIndex.prototype = {
                // my modal Box
                modalBox : $("#boxModal"),
                modalBoxHead : null,
                modalBoxBody : null,
                modalBoxFooter : null,
                calendarBlock: $('#fullcalendar'),
                loadingBlock: $('#loading'),

                init: function(){
                    me = this;
                    me.initData();
                    me.initEvent();
                },
                initData: function(){
                    // init modal box
                    me.modalBoxHead = me.modalBox.find(".modal-title");
                    me.modalBoxBody = me.modalBox.find(".modal-body");
                    me.modalBoxFooter = me.modalBox.find(".modal-footer");
                    // init calendar
                    me.fullCalendar();
                },
                initEvent: function(){
                    // init event
                },
                fullCalendar: function(){
                    me.calendarBlock.fullCalendar({
                        customButtons:{
                            newEvent:{
                                text: "add Event",
                                click: me.createEvent
                            }
                        },
                        header:{
                            left: 'prev,next today newEvent',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay'
                        },
                        businessHours: true,
                        selectable: true,
                        selectHelper: true,
                        // new evenet
                        select: function(start, end) {
                            me.createEvent({
                               'start': start.format("MM/DD/YYYY 09:00")+" AM",
                               'end'  : start.format("MM/DD/YYYY 06:00")+" PM"
                            });
                        },
                        // edit event or show
                        eventClick: me.editEvent,
                        eventResize: me.dragEvent,
                        eventDrop: me.dragEvent,
                        editable: true,
                        eventLimit: true, // allow "more" link when too many events
                        events:{ url: '{{action('Tasks_IndexController@postEvents')}}' },
                        loading: function(bool) {
                            me.loadingBlock.toggle(bool);
                        }
                    })
                },
                createEvent: function($data){
                    var data = {};
                    if($data.start !== undefined){
                        data.start = $data.start;
                    }
                    if($data.end !== undefined){
                        data.end = $data.end;
                    }

                    me.formEditEvent(data);
                },
                editEvent: function(event){
                    var data = {};
                    data.id = event.id;

                    me.formEditEvent(data);
                    return false;
                },
                formEditEvent: function(data){
                    $.ajax({url: '{{action('Tasks_IndexController@getEventForm')}}','data': data})
                        .done(function(json){
                            if(json.success){
                                me.modalBoxHead.text('Create Event');
                                me.modalBoxBody.html(json.template);
                                me.modalBoxFooter
                                    .off('click', '.submit-form', me.saveEventDataForm)
                                    .on('click', '.submit-form', me.saveEventDataForm)
                                    ;
                                me.modalBox.modal('show');
                                me.initDateDimePicker();

                            }else{
                                alert("Error load form");
                                me.modalBox.modal('hide');
                            }
                        }).fail(function (jqXHR, textStatus) {
                              console.log("Request failed: " + textStatus);
                              me.modalBox.modal('hide');
                        });

//                    me.modalBox.modal('show');
                },
                saveEventDataForm: function(){
                    var data = me.modalBoxBody.find('#modal-form').serialize(), id=me.modalBoxBody.find('input[name="id"]').val();
                    if(id > 0){
                        me.calendarBlock.fullCalendar('removeEvents', id);
                    }

                    $.ajax({url: '{{action('Tasks_IndexController@postEventForm')}}','data': data,'type':'post'})
                        .done(function(json){
                            if(json.success){
                                me.calendarBlock.fullCalendar('renderEvent', json.data, true);
                            }
                            me.modalBox.modal('hide');
                        }).fail(function (jqXHR, textStatus) {
                              console.log("Request failed: " + textStatus);
                              me.modalBox.modal('hide');
                        });
                },
                dragEvent: function(event, delta, revertFunc ){
                    var data = {};
                    data.id = event.id;
                    data.start = event.start.format();
                    data.end = event.end.format();

                    $.ajax({url: '{{action('Tasks_IndexController@postEventAction')}}','data': data,'type':'post'}).fail(function(){
                        revertFunc();
                    });

                },
                initDateDimePicker: function(){
                    var counts = 0;
                    $('.datetimepicker').each(function(){
                        var _this = $(this),val = _this.find("input").val(), data = {};
                        if(val.length){
                            data.defaultDate = val;
                        }
                        _this.removeClass('datetimepicker').addClass('datetimepicker'+counts);
                        $('.datetimepicker'+counts).datetimepicker(data);
                        counts ++;
                    });
                }
            };
            var tmpTasksIndex = win.tasksIndex = new tasksIndex();
        })(jQuery, window);
</script>
@stop