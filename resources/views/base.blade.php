<!doctype html>
@section('scripts')
    <html lang="lt">
    <head>
        <title>VDU Nuotolinio prisijungimo sistema</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css">
        <link href="https://resources.vdu.lt/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet">
        <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">-->

        <link href="https://resources.vdu.lt/css/custom/remote-class/style_new.css" rel="stylesheet">

        <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
        <script type="text/javascript" src="https://resources.vdu.lt/js/default/tether.min.js"></script>
        <script type="text/javascript"
                src="https://resources.vdu.lt/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
        <script type="text/javascript"
                src="https://resources.vdu.lt/js/default/bootstrap-filestyle-2.1.0.min.js"></script>
        <script src="https://resources.vdu.lt/js/default/bootbox.min.js" charset="UTF-8"></script>
    </head>
    @endsection
    @section ('header')
        <body class="navbar-fixed-top">
        <nav class="navbar fixed-top navbar-expand-md  navbar-dark bg-dark">
            <a class="navbar-brand" href="{{route('getHomepage')}}">
                <img src="https://resources.vdu.lt/images/vdu_logo_white_135.png" alt="Vytautas Magnus University">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="z" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Instrukcijos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkUser">
                            <a class="dropdown-item" target="_blank" href="{{url('https://studis.vdu.lt/remote-class/downloads/Win_rdp_pc.pdf')}}">Prieiga iš Windows PC</a>
                            <a class="dropdown-item" target="_blank" href="{{url('https://studis.vdu.lt/remote-class/downloads/Mac_rdp_pc.pdf')}}">Prieiga iš MAC PC</a>
                            <a class="dropdown-item" target="_blank" href="{{url('https://studis.vdu.lt/remote-class/downloads/ACC_rdp.pdf')}}">Prieiga prie Adobe CC</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Programų nuorodos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkUser">
                            <a class="dropdown-item" target="_blank" href="https://www.maxqda.com/trial">MaxQDA trial</a>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons float-left">face</i>&nbsp;&nbsp;{{auth()->user()->name}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkUser">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Atsijungti</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>

            </div>
        </nav>
    @endsection



