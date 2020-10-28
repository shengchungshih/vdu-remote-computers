<?php


namespace app\Http\Services;


use App\Models\RdpIS\Rooms;
use Illuminate\Database\Eloquent\Collection;

class RoomLoadingService
{
    /**
     * @return Rooms[]|Collection
     */
    public function getRoomList()
    {
        return Rooms::orderBy('room_name')->get();
    }

    public function getAllRoomInformation()
    {
        return Rooms::from('rooms as r')->join('room_computers rc', 'r.id', '=', 'rc.room_id')
            ->join('computers c', 'c.id', '=', 'rc.computer_id')
            ->join('room_software rs', 'rs.room_id', 'r.id')
            ->join('software s', 's.id', '=', 'rs.software_id')
            ->first();
    }
}
