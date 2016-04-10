@extends('template.default.index')

@section('controller')
<div class="row">
    <div>
        <div>
            <div id='loading'>loading...</div>
            <div id="fullcalendar"></div>
        </div>
    </div>
</div>
@stop

@section('style')
#loading {
		display: none;
		position: absolute;
		top: 10px;
		right: 10px;
	}

	#calendar {
		max-width: 900px;
		margin: 0 auto;
	}
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
                    header:{
                        left: 'prevYear,prev,next,nextYear today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    businessHours: true,
                    googleCalendarApiKey: 'AIzaSyDcnW6WejpTOCffshGDDb4neIrXVUA1EAE',

                    events:{ url: '{{action('Tasks_IndexController@postEvents')}}' },
                    eventSources: [
                                {
                                    googleCalendarId: 'usa__en@holiday.calendar.google.com'
                                }
                                ],
                    eventClick: me.showEvent,
                    // US Holidays

                    {{--events: 'usa__en@holiday.calendar.google.com',--}}
                    loading: function(bool) {
                        me.loadingBlock.toggle(bool);
                    }
                })
            },
            showEvent: function(event){
                data={};
                data.id = event.id;
                $.ajax({url: '{{action('Tasks_IndexController@postEventBlock')}}','data': data,'type':'post'})
                    .done(function(json){
                        if(json.success){
                            me.modalBoxHead.text(json.title);
                            me.modalBoxBody.html(json.template);
                            me.modalBoxFooter
                                .off('click', '.submit-form', me.saveEventDataForm)
                                .on('click', '.submit-form', me.saveEventDataForm)
                                ;
                            me.modalBoxFooter.hide();
                            me.modalBox.modal('show');
                        }else{
                            alert("Error load form");
                            me.modalBox.modal('hide');
                        }
                    }).fail(function (jqXHR, textStatus) {
                          console.log("Request failed: " + textStatus);
                          me.modalBox.modal('hide');
                    });
            }
        };
        var tmpTasksIndex = win.tasksIndex = new tasksIndex();
    })(jQuery, window);
</script>
@stop