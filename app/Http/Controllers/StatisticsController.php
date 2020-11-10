<?php

namespace App\Http\Controllers;

use App\Http\Services\RoomLoadingService;
use App\Http\Services\StatisticsDataService;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    /**
     * @var StatisticsDataService
     */
    private $dataService;
    /**
     * @var RoomLoadingService
     */
    private $roomLoadingService;

    public function __construct(StatisticsDataService $dataService, RoomLoadingService $roomLoadingService)
    {
        $this->dataService = $dataService;
        $this->roomLoadingService = $roomLoadingService;
    }

    public function getReservationList(Request $req)
    {
        $orderBy = $req->get('order-by', 'id');
        $isActive = $req->get('is-active');
        $startDate = $req->get('start-date');
        $endDate = $req->get('end-date');
        $room = $req->get('room');
        //dd($this->dataService->getReservationList());
        return view('reservationLog', [
            'reservations' => $this->dataService->getReservationList($orderBy, $isActive, $startDate, $endDate, $room),
            'orderByList' => $this->dataService->getOrderByOptionList(),
            'orderBy' => $orderBy,
            'roomList' => $this->roomLoadingService->getRoomList(),
            'isActive' => $isActive
        ]);
    }
}
