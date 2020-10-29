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
        <div class="col-md-12" id="computer-list-div" style="padding-left:15rem">
            @yield('roomComputers')
        </div>
    </div>
</div>
<script>
    $(".computer_load").click(function()
    {
        $(".computer_load").removeClass('highlighted-link')
        $(this).addClass('highlighted-link');
    })
</script>

<style>
    .btn.disabled, .btn:disabled{
        opacity:.6;
        background-color: #ffffff;
        border:1px solid rgb(229, 229, 229);
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
</style>
