<?php


namespace App\Http\Services;

use Illuminate\Support\Facades\DB;

class StatisticsDataService
{
    public function getReservationList(string $orderBy, ?bool $isActive = true, string $startDate = null, string $endDate = null, int $room = null)
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
}
