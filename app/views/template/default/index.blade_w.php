@if(!Request::ajax())
    <!DOCTYPE html>
    <html lang="{{App::getLocale()}}">
        @include('template.default.head')
        <body>
            @if(empty($offBlockHead))
                @include('template.default.bodyHeader')
            @endif
            <div class="container">
@endif
                @yield('controller')
@if(!Request::ajax())
            </div>
            @if(empty($offBlockFooter))
                @include('template.default.bodyFooter')
            @endif
            @include('template.default.modal')
            @include('template.default.scriptBottom')
        </body>

    </html>
@endif