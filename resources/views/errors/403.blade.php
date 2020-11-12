<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>403 - VDU Nuotolinio prisijungimo sistema </title>

    <link href="https://resources.vdu.lt/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://resources.vdu.lt/css/unified-login/style.css" rel="stylesheet">
</head>
<body>
<div class="container h-100">
    <div class="h-100 row align-items-md-center justify-content-md-center">
        <div class="col-sm-12 col-md-9 col-login">
            <div class="row">
                <div class="col-md-7 col-logo">
                    <a href="{{ url('/') }}" class="logo"><img src="https://resources.vdu.lt/images/vdu_logo_cherry_500.png" alt=""></a>
                </div>
                <div class="col-md-5">
                    <h1 class="error-code">403</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="text-center">@lang('no_permission_to_view_page')</p>
                    @if(auth()->user())
                        <p class="text-center">@lang('you_are_using_system_as') <strong>{{ auth()->user()->name }}</strong>. <a href="{{ url('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">@lang('logout')</a>?</p>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            {{ csrf_field() }}
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
