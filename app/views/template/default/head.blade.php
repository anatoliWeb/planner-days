<head>
    <meta charset="UTF-8">
    <title>{{!empty($headTitle) ? $headTitle : Config::get('app.nameSite')}}</title>
	@yield('head')
	{{ HTML::style(URL::to('css/bootstrap.min.css'))}}
    {{ HTML::style(URL::to('css/bootstrap-theme.min.css'))}}

    @if(!empty($bootstrapSwitch)){{ HTML::style(URL::to('css/bootstrap-switch.min.css'))}}@endif
    @if(!empty($bootstrapColorPicker)){{ HTML::style(URL::to('css/bootstrap-colorpicker.min.css'))}}@endif
    @if(!empty($bootstrapDateTimePicker)){{ HTML::style(URL::to('css/bootstrap-datetimepicker.css'))}}@endif
    @if(!empty($bootstrapDateTimePicker)){{ HTML::style(URL::to('css/bootstrap-datetimepicker-standalone.css'))}}@endif
    @if(!empty($jqueryUi) || !empty($fullCalendar)){{ HTML::style(URL::to('css/jquery-ui.min.css'))}}@endif
    @if(!empty($fullCalendar)){{ HTML::style(URL::to('css/fullcalendar.min.css'))}}@endif
    @if(!empty($fullCalendar)){{ HTML::style(URL::to('css/fullcalendar.print.css'),array('media'=>'print'))}}@endif

	{{ HTML::style(URL::to('css/style.css')) }}
	
    <style>@yield('style')</style>
</head>