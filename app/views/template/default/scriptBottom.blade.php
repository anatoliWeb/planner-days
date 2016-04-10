{{ HTML::script(URL::to('js/jQuery/jquery-1.11.3.min.js'))}}
{{ HTML::script(URL::to('js/bootstrap.min.js'))}}
@if(!empty($bootstrapSwitch)){{ HTML::script(URL::to('js/bootstrap-switch.min.js'))}}@endif
@if(!empty($moment) || !empty($fullCalendar)){{ HTML::script(URL::to('js/moment.min.js'))}}@endif
@if(!empty($bootstrapColorPicker)){{ HTML::script(URL::to('js/bootstrap-colorpicker.min.js'))}}@endif
@if(!empty($bootstrapDateTimePicker)){{ HTML::script(URL::to('js/bootstrap-datetimepicker.js'))}}@endif
@if(!empty($jqueryUi) || !empty($fullCalendar)){{ HTML::script(URL::to('js/jQuery/jquery-ui.min.js'))}}@endif
@if(!empty($tinymce)){{ HTML::script(URL::to('tinymce/tinymce.min.js'))}}@endif
@if(!empty($fullCalendar)){{ HTML::script(URL::to('js/fullcalendar/fullcalendar.min.js'))}}@endif
@if(!empty($fullCalendar)){{ HTML::script(URL::to('js/fullcalendar/lang/'.Config::get('app.locale').'.js'))}}@endif
@if(!empty($fullCalendar)){{ HTML::script(URL::to('js/fullcalendar/gcal.js'))}}@endif

@yield('scriptLibrary')
{{ HTML::script(URL::to('js/script.js'))}}
@yield('script')
