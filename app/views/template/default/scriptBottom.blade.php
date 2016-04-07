{{ HTML::script(URL::to('js/jQuery/jquery-1.11.3.min.js'))}}
{{ HTML::script(URL::to('js/bootstrap.min.js'))}}
{{ HTML::script(URL::to('js/jQuery/jquery-ui.min.js'))}}
@yield('scriptLibrary')
{{ HTML::script(URL::to('js/script.js'))}}
@yield('script')
