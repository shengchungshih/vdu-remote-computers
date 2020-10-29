@include('base')
@include('components.roomComputers')
@yield('scripts')
@yield('header')
<div class="container">
    <div class="row">
        <div class="sidenav nav sidebar-nav">
            <div id="div-group-list">
                <h4> Kompiuterių klasės </h4>
                <ul class="flex-column nav nav-pills">
                    @foreach($roomList as $room)
                        <li class="nav-item">
                            <a class="nav-link computer_load @if(!empty($currentRoom) && ($room->id === $currentRoom->id)) highlighted-link @endif" href="{{route('getComputerList', ['roomId' => $room->id])}}" data-id="{{$room->id}}"> {{$room->room_name}} </a>
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

    .btn:disabled:hover{
        cursor:not-allowed;
    }

    .sidebar-nav{
        position:fixed;
        z-index:9999;
    }

    .highlighted-link{
        border:2px solid green !important;
        color:green !important;
    }
     .dropdown-submenu {
         position: relative;
     }

    .dropdown-submenu a::after {
        transform: rotate(-90deg);
        position: absolute;
        right: 6px;
        top: .8em;
    }

    .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%;
        margin-left: .1rem;
        margin-right: .1rem;
    }
    .dropdown-item:focus{
        color: red;
        text-decoration: none;
        background-color: initial;
    }
    .computer_load{
        border-bottom: none;
    }
</style>
