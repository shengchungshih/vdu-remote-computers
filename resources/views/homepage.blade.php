@include('base')
@include('components.roomComputers')
@yield('scripts')
@yield('header')
<div class="container-fluid">
    @if(Session::has('download_url'))
        <meta http-equiv="refresh" content="1;url={{ Session::get('download_url') }}">
    @endif
    <div class="row">
        <div class="flash-message col-md-12">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <p class="alert alert-{{ $msg }} text-center">{{ Session::get('alert-' . $msg) }}</p>
                @endif
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="sidenav nav sidebar-nav">
            <div id="div-group-list">
                <h4> Kompiuterių klasės </h4>
                <ul class="flex-column nav nav-pills">
                    @foreach($roomList as $room)
                        <li class="nav-item">
                            <a class="nav-link computer_load @if(!empty($currentRoom) && ($room->id === $currentRoom->id)) highlighted-link @endif"
                               href="{{route('getComputerList', ['roomId' => $room->id])}}" data-id="{{$room->id}}">
                                    <strong @if($room->getFreeComputersCount($room->id) > 0) style="color:green" @else style="color:red" @endif>
                                        <i class="fas fa-circle"></i>
                                    </strong>
                                {{$room->room_name}}
                            </a>

                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-12" id="computer-list-div" style="padding-left:20rem">
            @yield('roomComputers')
        </div>
    </div>
</div>
<script>
    $(".computer_load").click(function()
    {
        $(".computer_load").removeClass('highlighted-link')
        $(this).addClass('highlighted-link');
    });
    $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');


        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
            $('.dropdown-submenu .show').removeClass("show");
        });


        return false;
    });
</script>

<style>
    .btn.disabled, .btn:disabled{
        opacity:.6;
    }

    .btn{
        cursor:pointer;
    }

    .btn:disabled:hover{
        cursor:not-allowed;
    }

    .sidebar-nav{
        position:fixed;
        z-index:999;
    }

    .highlighted-link{
        border:2px solid green !important;
        color:green !important;
    }

    .computer_load{
        border-bottom: none;
    }
</style>
