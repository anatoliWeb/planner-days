<head>
    <meta charset="UTF-8">
    <title>{{!empty($headTitle) ? $headTitle : Config::get('app.nameSite')}}</title>
    {{ HTML::style(URL::to('css/bootstrap.min.css'))}}
    {{ HTML::style(URL::to('css/bootstrap-theme.min.css'))}}
    {{ HTML::style(URL::to('css/style.css')) }}
    <style>@yield('style')</style>
</head>