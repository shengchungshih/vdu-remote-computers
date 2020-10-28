<div class="computer-room-div" id="room-{{$room->id}}">
    <h3>
        <b> {{$room->room_name}}  <br> Kompiuteriuose esanti programinė įranga:</b>
        @if(!empty($room->getRoomSoftware($room->id)))
            @foreach($room->getRoomSoftware($room->id) as $software)
                {{$software->software->software_name.' / '}}
            @endforeach
        @else
           Kompiuteriuose esanti programinė įranga neaprašyta
        @endif
    </h3>
    <p> Laisvų kompiuterių kiekis: {{$room->getFreeComputersCount($room->id)}} </p>
</div>


<table class="table table-condensed table-borderless" id="computer-list">
    <tbody>
        @foreach($room->getRoomComputers($room->id) as $computer)
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

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip({
            html: true
        });
    });
</script>

