@section('roomComputers')


    @if(!empty($currentRoom))
        <div class="computer-room-div" id="room-{{$currentRoom->id}}">
            <h3>
                <b> {{$currentRoom->room_name}}  <br> Kompiuteriuose esanti programinė įranga:</b>
                @if(!empty($currentRoom->getRoomSoftware($currentRoom->id)))
                    @foreach($currentRoom->getRoomSoftware($currentRoom->id) as $software)
                        {{$software->software->software_name.' / '}}
                    @endforeach
                @else
                   Kompiuteriuose esanti programinė įranga neaprašyta
                @endif
            </h3>
            <p> Laisvų kompiuterių kiekis: {{$currentRoom->getFreeComputersCount($currentRoom->id)}} </p>
        </div>


        <table class="table table-condensed table-borderless" id="computer-list">
            <tbody>
                @foreach($currentRoom->getRoomComputers($currentRoom->id) as $computer)
                    <tr>
                        <td class="align-middle"> {{$computer->computer->pc_name}} </td>
                        <td class="text-right">
                            @if(!$computer->computer->getIsComputerReserved($computer->computer_id))
                                @if(empty($computer->computer->rdp_file_url))
                                    <button class="btn btn-dark" aria-disabled="true" disabled> Rezervuoti </button>
                                @else
                                    <a class="btn btn-dark" href="{{env('RDP_FILE_URL_ROOT').'/'.$computer->computer->rdp_file_url}}"> Rezervuoti </a>
                                @endif
                            @else
                                <button class="btn btn-dark" aria-disabled="true" disabled> Rezervuoti </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="computer-room-div">
            <h3> Pasirinkite kompiuterių klasę norint matyti kompiuterių rezervacijas </h3>
        </div>
    @endif

@endsection
