<?php

namespace App\Models\RdpIS;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class Rooms extends Eloquent
{
    protected $connection = 'rdpis';

    protected $table = 'rooms';

    protected $primaryKey = 'id';

    public $sequence = null;

    public $timestamps = null;

    private $id;
    private $room_name;
    private $room_status;

    /**
     * @param $roomId
     * @return RoomSoftware[]|Builder[]|Collection
     */
    public function getRoomSoftware($roomId)
    {
        return RoomSoftware::with('software')->where('room_id', $roomId)->get();
    }

    /**
     * @param $roomId
     * @return RoomComputers[]|Builder[]|Collection
     */
    public function getRoomComputers($roomId)
    {
        return RoomComputers::whereHas('computer', function($q){
            $q->whereNull('status');
        })->with(['computer' => function($q){
            $q->whereNull('status');
        }])->where('room_id', $roomId)
            ->get()
            ->sortBy(function($item, $key) {
                return $item->computer->pc_name ?? '';
        });
    }

    /**
     * @param $roomId
     * @return int|void
     */
    public function getFreeComputersCount($roomId)
    {
        $computerIdList = RoomComputers::where('room_id', $roomId)->get('computer_id')->toArray();

        $rdplessComputers = Computers::whereIn('id', $computerIdList)->whereNull('rdp_file_url')->get(['id'])->toArray();

        $reservationList = Reservations::whereNull('is_active')->whereIn('computer_id', $computerIdList)->whereNotIn('computer_id', $rdplessComputers)->count();

        return count($computerIdList) - $reservationList;
    }
}
