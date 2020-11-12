<?php


namespace App\Http\Services;

use App\Models\RdpIS\RoomComputers;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class StatisticsDataService
{
    public function getReservationList(string $orderBy, ?bool $isActive = true, string $startDate = null, string $endDate = null, int $room = null, int $computer = null)
    {
        return DB::connection('rdpis')->table('reservations r')->join('computers c', 'c.id', '=', 'r.computer_id')
            ->join('room_computers rc', 'rc.computer_id', '=', 'c.id')
            ->join('rooms ro', 'ro.id', '=', 'rc.room_id')
            ->join('luadm.cilveks cil', 'cil.ckods', '=', 'r.ckods')
            ->select(['r.id', 'r.ckods', 'r.reservation_start_date', 'r.reservation_end_date',
                'cil.vards', 'cil.uzvards', 'ro.room_name', 'r.is_active', 'c.pc_name'])
            ->when(!is_null($isActive), function($q) {
                $q->whereNull('r.is_active');
            })
            ->when(!is_null($startDate), function($q) use ($startDate) {
                $q->whereDate('r.reservation_start_date', $startDate);
            })
            ->when(!is_null($endDate), function ($q) use ($endDate) {
                $q->whereDate('r.reservation_end_date', $endDate);
            })
            ->when(!is_null($room), function ($q) use ($room){
                $q->where('rc.room_id', $room);
            })
            ->when(!is_null($computer), function($q) use ($computer) {
                $q->where('r.computer_id', $computer);
            })
            ->orderBy($this->getOrderByValue($orderBy))
            ->paginate(25);
    }

    public function getOrderByValue($val = null)
    {
        if (empty($val)) {
            return 'r.id';
        }

        $orderByValArr = [
            'id' => 'r.id',
            'start-date' => 'r.reservation_start_date',
            'end-date' => 'r.reservation_end_date',
            'computer-room' => 'ro.room_name',
            'pc-name' => 'c.pc_name',
            'name' => 'cil.uzvards'
        ];

        return $orderByValArr[$val];

    }
    public function getOrderByOptionList()
    {
         return [
            'id' => 'Id',
            'start-date' => __('statistics_table_header_reservation_start'),
            'end-date' => __('statistics_table_header_reservation_start'),
            'computer-room' => __('statistics_table_header_computer_class_name'),
            'pc-name' => __('statistics_table_header_computer_name'),
            'name' => __('statistics_table_header_user_name_and_surname')
        ];
    }

    public function getRoomComputers(int $roomId)
    {
        return RoomComputers::with('computer')->where('room_id', $roomId)->get();
    }

    public function getRoomComputerOccupancyStats($startDate, $endDate, $roomId = null)
    {
        if ($startDate > $endDate) {
            $temp = $endDate;
            $endDate = $startDate;
            $startDate = $temp;
        }

        $counts = DB::connection('rdpis')->table('reservations r')
            ->join('computers c', 'c.id', '=', 'r.computer_id')
            ->join('room_computers rc', 'rc.computer_id', '=', 'c.id')
            ->join('rooms roo', 'roo.id', '=', 'rc.room_id')
            ->selectRaw('count(trunc(r.reservation_start_date)) as count,'. DB::RAW('trunc(r.reservation_start_date)').' as start_date, rc.room_id, roo.room_name, r.computer_id, c.pc_name')
            ->whereBetween(DB::raw('trunc(r.reservation_start_date)'), [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->when(!is_null($roomId), function($q) use ($roomId) {
                $q->where('rc.room_id', $roomId);
            })
            ->groupBy(DB::raw('trunc(r.reservation_start_date)'), 'rc.room_id', 'roo.room_name', 'r.computer_id', 'c.pc_name')
            ->get();
        $resultArr = [];
        foreach ($counts as $count) {
            $resultArr[$count->room_id][$count->computer_id][explode(' ', $count->start_date)[0]] = $count->count;
        }
        return $resultArr;
    }

    public function getDatePeriodArray(DateTime $startDate, DateTime $endDate)
    {
        $end = $endDate;
        $start = $startDate;

        if ($start > $end )
        {
            $temp = $end;
            $end = $start;
            $start = $temp;
        }
        $interval = new \DateInterval('P1D');

        return new DatePeriod($start, $interval, $end);
    }
}
