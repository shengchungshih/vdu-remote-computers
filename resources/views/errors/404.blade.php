<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>404 - VDU Nuotolinio prisijungimo sistema</title>

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
                    <h1 class="error-code">404</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="text-center">Deja, nepavyko surasti jūsų ieškomo puslapio.</p>
                    <p>&nbsp;</p>
                    <p class="text-center"><a href="{{ url('/') }}">Eiti į pradinį puslapį</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
