<?php

namespace App\Models\RdpIS;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        return RoomComputers::with('computer')->where('room_id', $roomId)->get();
    }

    public function getFreeComputersCount($roomId)
    {
        $computerIdList = RoomComputers::where('room_id', $roomId)->get('computer_id')->toArray();

        return count($computerIdList) - Reservations::whereNull('is_active')->whereIn('computer_id', $computerIdList)->count();
    }
}
