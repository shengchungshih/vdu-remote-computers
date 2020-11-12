@inject('roomService', 'App\Http\Services\RoomLoadingService')
@include('base')
@yield('scripts')
@yield('header')

<div class="container-fluid">
    <form action="" method="get">
        <div class="row pb-3">
            <div class="col-md-2">
                <label for="order-by"> @lang('order_by') </label>
                <select class="form-control" name="order-by">
                    @foreach($orderByList as $key => $val)
                        <option value="{{$key}}" @if($orderBy === $key) selected @endif> {{$val}} </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">
                <label for="start-date"> @lang('start_date') </label>
                <input type="text" name="start-date" class="form-control datepicker" value="{{request('start-date')}}" autocomplete="off">
            </div>
            <div class="col-md-1">
                <label for="end-date"> @lang('end_date') </label>
                <input type="text" name="end-date" class="form-control datepicker" value="{{request('end-date')}}" autocomplete="off">
            </div>
            <div class="col-md-2">
                <label for="room"> @lang('statistics_table_header_computer_class_name') </label>
                <select class="form-control" name="room" id="room">
                    <option selected value> @lang('all_computer_classes') </option>
                    @foreach($roomList as $room)
                        <option value="{{$room->id}}" @if($room->id == request('room')) selected @endif> {{$room->room_name}} </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1 pl-5" style="margin-top:2.5rem">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Y" id="is-active" name="is-active" @if($isActive) checked="checked" @endif>
                    <label class="form-check-label" for="is-active">
                        @lang('is_active')
                    </label>
                </div>
            </div>
            <div class="col-md-1 mt-4_5">
                <button type="submit" class="btn btn-dark"> @lang('search') </button>
            </div>
        </div>
    </form>
    <table class="table table-bordered table-inverse">
        <thead>
            <tr>
                <th> # </th>
                <th> @lang('statistics_table_header_reservation_start') </th>
                <th> @lang('statistics_table_header_reservation_end') </th>
                <th> @lang('statistics_table_header_computer_class_name') </th>
                <th> @lang('statistics_table_header_computer_name') </th>
                <th> @lang('statistics_table_header_user_name_and_surname') </th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $r)
                <tr>
                    <td> {{$r->id}} </td>
                    <td> {{date('Y-m-d H:i:s', strtotime($r->reservation_start_date.' +2 hours'))}} </td>
                    <td> @if(!is_null($r->is_active)){{date('Y-m-d H:i:s', strtotime($r->reservation_end_date.' +2 hours'))}} @endif </td>
                    <td> {{$r->room_name}} </td>
                    <td> {{$r->pc_name}} </td>
                    <td> {{$r->vards.' '.$r->uzvards}} </td>
                </tr>
            @empty
                <tr class="text-center">
                    <td colspan="99"> Nerasta įrašų pagal tokius kriterijus </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @if(!empty($reservations))
        <div class="row">
            <div class="col">{{ $reservations->appends([
                'order-by' => request('order-by'),
                'start-date' => request('start-date'),
                'end-date' => request('end-date'),
                'room' => request('room'),
                'is-active' => request('is-active')
            ])->links('pagination::bootstrap-4') }}</div>
            <div class="col text-right"> <b> Iš viso: {{$reservations->total()}} </b> </div>
        </div>
    @endif
</div>
<script>
    $(".datepicker").datepicker({
        format: 'yyyy-mm-dd',
        orientation: 'bottom',
        language: 'lt'
    });
</script>
