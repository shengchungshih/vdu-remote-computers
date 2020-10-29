@inject('roomService', 'App\Http\Services\RoomLoadingService')
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
                    @if($computer->computer->isComputerLecturers())
                        @if(!empty(auth()->user()->ez_lecturer_id)) // ar destytojas
                            @if(!empty($computer->computer->rdp_file_url))
                                <tr>
                                    <td class="align-middle"> {{$computer->computer->pc_name}} </td>
                                    <td class="text-right">
                                        @if(!$roomService->getIsComputerReserved($computer->computer_id))
                                            <form target="_blank" action="{{route('reserveComputer', ['computer' => $computer->computer_id])}}" method="GET">
                                                <button class="btn btn-dark" type="submit"> Rezervuoti </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endif
                    @else
                        @if(!empty($computer->computer->rdp_file_url))
                        <tr>
                            <td style="text-align:left"> {{$computer->computer->pc_name}} </td>
                            <td class="text-right">
                                @if(!$roomService->getIsComputerReserved($computer->computer_id))
                                    <form target="_new" action="{{route('reserveComputer', ['computer' => $computer->computer_id])}}" class="download-form" method="GET">
                                        <button class="btn btn-dark" type="submit"> Rezervuoti </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endif
                    @endif
                @endforeach
            </tbody>
        </table>
    @else
        <div class="computer-room-div">
            <h3> Pasirinkite kompiuterių klasę norint matyti kompiuterių rezervacijas </h3>
        </div>
    @endif
@endsection
