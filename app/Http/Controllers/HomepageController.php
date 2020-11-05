<?php

namespace App\Http\Controllers;

use App\Http\Services\RoomLoadingService;
use App\Models\RdpIS\Reservations;
use App\Models\RdpIS\Rooms;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

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


    /**
     * @return Application|Factory|View
     */
    public function getHomepage()
    {
        return view('homepage', [
            'roomList' => $this->roomLoadingService->getRoomList(),
        ]);
    }

    /**
     * @param Rooms $room
     * @return Application|Factory|View
     */
    public function getComputerList(Rooms $room)
    {
        return view('homepage', [
            'roomList' => $this->roomLoadingService->getRoomList(),
            'currentRoom' => $room,
            'roomTechnicians' => $this->roomLoadingService->getRoomTechnicianInfo($room->id)
        ]);
    }

    /**
     * @param $computerId
     * @return RedirectResponse
     */
    public function reserveComputer($computerId): RedirectResponse
    {

        $ckods = $this->roomLoadingService->getActiveUserCkods();
        return $this->roomLoadingService->reserveComputer($ckods, $computerId);
    }

    /**
     * @param $computerId
     * @return RedirectResponse
     */
    public function cancelComputerReservation($computerId): RedirectResponse
    {
        $ckods = $this->roomLoadingService->getActiveUserCkods();
        return $this->roomLoadingService->cancelComputerReservation($ckods, $computerId);
    }

    public function setLanguage($lang): RedirectResponse
    {
        Session::put('applocale', $lang);
        return redirect()->back();
    }

    public function cancelAllRoomReservations($roomId): RedirectResponse
    {
        return $this->roomLoadingService->cancelAllRoomReservations($roomId);
    }
}
