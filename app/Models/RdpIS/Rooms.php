<?php

namespace App\Models\RdpIS;

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

    public function getRoomSoftware($roomId)
    {
        return RoomSoftware::with('software')->where('room_id', $roomId)->get();
    }

    public function getRoomComputers($roomId)
    {
        return RoomComputers::with('computer')->where('room_id', $roomId)->get()
            ->sortBy(function($item, $key){
            return $item->computer->pc_name;
        });
    }

    public function getFreeComputersCount($roomId)
    {
        $computerIdList = RoomComputers::where('room_id', $roomId)->get('computer_id')->toArray();

        $rdplessComputers = Computers::whereIn('id', $computerIdList)->whereNull('rdp_file_url')->get(['id'])->toArray();

        $reservationList = Reservations::whereNull('is_active')->whereIn('computer_id', $computerIdList)->whereNotIn('computer_id', $rdplessComputers)->count();

        return count($computerIdList) - count($rdplessComputers) - $reservationList;
    }
}
