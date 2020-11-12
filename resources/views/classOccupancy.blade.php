@inject('roomService', 'App\Http\Services\RoomLoadingService')
@inject('statService', 'App\Http\Services\StatisticsDataService')
@include('base')
@yield('scripts')
@yield('header')
<div class="container-fluid">
    <form action="" method="get">
        <div class="row pb-5">
            <div class="col-md-2">
                <label for="start-date"> @lang('start_date')</label>
                <input type="text" class="form-control datepicker" name="start-date" value="{{$startDate->format('Y-m-d')}}">
            </div>
            <div class="col-md-2">
                <label for="end-date"> @lang('end_date')</label>
                <input type="text" class="form-control datepicker" name="end-date" value="{{$endDate->format('Y-m-d')}}">
            </div>
            <div class="col-md-2">
                <label for="room-id"> @lang('statistics_table_header_computer_class_name') </label>
                <select class="form-control" name="room-id" id="room-id">
                    <option selected value> @lang('all_computer_classes') </option>
                    @foreach($roomList as $room)
                        <option value="{{$room->id}}" @if($room->id == request('room-id')) selected @endif> {{$room->room_name}} </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 mt-4_5">
                <button type="submit" class="btn btn-dark"> Ieškoti </button>
            </div>
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr style="border:2px solid black">
                <th colspan="2"></th>
                @foreach($datePeriod as $date)
                    <th> {{$date->format('Y-m-d')}} </th>
                @endforeach
                <th> @lang('total') </th>
            </tr>
        </thead>
        <tbody>
        @foreach($rooms as $room)
            @php($roomTotal = 0)
            <tr>
            @php($roomComputers = $statService->getRoomComputers($room->id))
            <td rowspan="{{count($roomComputers) + 1}}" style="border: 2px solid black"> {{$room->room_name}} </td>
            @foreach($roomComputers as $computer)
                <tr>
                    <td> {{$computer->computer->pc_name}} </td>
                    @php($total = 0)
                    @foreach($datePeriod as $date)
                        @php($total += $roomComputerOccupancyData[$room->id][$computer->computer->id][$date->format('Y-m-d')] ?? 0)
                        <td class="text-center"> <a target="_blank" href="{{route('getReservationList', ['start-date' => $date->format('Y-m-d'), 'room' => $room->id, 'computer' => $computer->computer->id])}}"> {{$roomComputerOccupancyData[$room->id][$computer->computer->id][$date->format('Y-m-d')] ?? 0}}</a>  </td>
                    @endforeach
                    @php($roomTotal += $total)
                    <td class="text-center" style="border-left: 2px solid black; border-right: 2px solid black"> {{$total}}</td>
                </tr>
            @endforeach
            </tr>
                <tr class="text-center" style="border:2px solid black">
                    <td colspan="999"> @lang('total_reservations_during_period') {{$roomTotal}}</td>
                </tr>
        @endforeach
        </tbody>
    </table>
</div>
<script>
    $(".datepicker").datepicker({
        format: 'yyyy-mm-dd',
        orientation: 'bottom',
        language: 'lt'
    });
</script>
