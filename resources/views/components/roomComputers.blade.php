@inject('roomService', 'App\Http\Services\RoomLoadingService')
@section('roomComputers')
    @if(!empty($currentRoom))
        <div class="computer-room-div" id="room-{{$currentRoom->id}}">
            <h3> <b> {{$currentRoom->room_name}} </b> </h3>
            <h3> <b> @lang('software_in_computers')</b>
                @if(!empty($currentRoom->getRoomSoftware($currentRoom->id)))
                    @foreach($currentRoom->getRoomSoftware($currentRoom->id) as $software)
                        {{$software->software->software_name.' / '}}
                    @endforeach
                @else
                   @lang('software_not_found')
                @endif
            </h3>
            <h6> @lang('computer_technicians')
                @foreach($roomTechnicians as $technician)
                    {{$technician->cilveks->vards.' '.$technician->cilveks->uzvards.' - '.$technician->cilveks->cil_www.'@vdu.lt /'}}
                @endforeach
            </h6>
            <div class="row align-items-center">
                <div class="col-md-2">
                    <p> @lang('free_computer_amount') {{$currentRoom->getFreeComputersCount($currentRoom->id)}} </p>
                </div>
                @if($roomService->getIfUserHasActiveReservations($roomService->getActiveUserCkods()))
                    <div class="col-md-10">
                        <div class="alert alert-info" style="font-size:14px;"> @lang('cancel_current_reservation_info_message') </div>
                    </div>
                @endif
            </div>
        </div>
        <table class="table table-condensed table-borderless" id="computer-list">
            <tbody>
                @foreach($currentRoom->getRoomComputers($currentRoom->id) as $computer)
                    @if(!empty($computer->computer->rdp_file_url))
                        <tr>
                            <td style="text-align:left"> {{$computer->computer->pc_name}} </td>
                            <td class="text-right">
                                @if(($roomService->getIfUserHasActiveReservations($roomService->getActiveUserCkods())
                                    && $roomService->getUsersActiveReservationPc() !== $computer->computer_id
                                    && !$roomService->getIsComputerReserved($computer->computer_id))
                                    || ($computer->computer->isComputerLecturers() && $roomService->isUserNotLecturer())
                                )
                                    <button class="btn btn-dark" disabled> @lang('reserve') </button>
                                @else
                                    @if(!$roomService->getIsComputerReserved($computer->computer_id))
                                        <form action="{{route('reserveComputer', ['computer' => $computer->computer_id])}}" class="download-form" method="GET">
                                            <button class="btn btn-dark" type="submit"> @lang('reserve') </button>
                                        </form>
                                    @elseif($roomService->getUsersActiveReservationPc() === $computer->computer_id)
                                        <form action="{{route('cancelReservation', ['computer' => $computer->computer_id])}}" method="POST">
                                            @csrf
                                            <button class="btn btn-dark" type="submit"> @lang('cancel_reservation') </button>
                                        </form>
                                    @else
                                        <button class="btn btn-dark" disabled> @lang('reserve') </button>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        @if($roomService->isUserEligableToCancelAllReservationsOfRoom($currentRoom->id))
            <form action="{{route('cancelAllReservations', ['roomId' => $currentRoom->id])}}" method="POST">
                @csrf
                <button class="btn btn-dark"> @lang('cancel_all_reservations') </button>
            </form>
        @endif
    @else
        <div class="computer-room-div">
            <h3> @lang('choose_computers_rooms_info_message') </h3>
            @if($roomService->getIfUserHasActiveReservations($roomService->getActiveUserCkods()))
                <div class="alert alert-info"> @lang('your_currently_reserved_computer')
                    <b>{{$roomService->getUsersActiveReservationPcName($roomService->getUsersActiveReservationPc())}} </b>
                    @lang('at_address') <b>{{$roomService->getUsersActiveReservationRoomName($roomService->getUsersActiveReservationPc())}} </b>
                    <form action="{{route('cancelReservation', ['computer' => $roomService->getUsersActiveReservationPc($roomService->getActiveUserCkods())])}}" method="POST" class="pt-3">
                        @csrf
                        <button class="btn btn-dark" type="submit"> @lang('cancel_reservation') </button>
                    </form>
                </div>
            @endif
        </div>
    @endif
@endsection
