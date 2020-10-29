<?php

namespace App\Http\Controllers;

use App\Http\Services\RoomLoadingService;
use App\Models\RdpIS\Reservations;
use App\Models\RdpIS\Rooms;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    /**
     * @var RoomLoadingService
     */
    private $roomLoadingService;

    public function __construct(RoomLoadingService $roomLoadingService)
    {
        $this->roomLoadingService = $roomLoadingService;
    }


    public function getHomepage()
    {
        return view('homepage', [
            'roomList' => $this->roomLoadingService->getRoomList(),
        ]);
    }

    public function getComputerList(Rooms $room)
    {
        return view('homepage', [
            'roomList' => $this->roomLoadingService->getRoomList(),
            'currentRoom' => $room
        ]);
    }

    public function reserveComputer($computerId)
    {
        $ckods = auth()->user()->cilveks_ckods;
        return $this->roomLoadingService->reserveComputer($ckods, $computerId);
    }
}
