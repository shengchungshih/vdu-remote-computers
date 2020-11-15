<?php

namespace App\Http\Controllers;

use App\Http\Services\RoomLoadingService;
use App\Http\Services\StatisticsDataService;
use DateTime;
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
        $computer = $req->get('computer');
        return view('reservationLog', [
            'reservations' => $this->dataService->getReservationList($orderBy, $isActive, $startDate, $endDate, $room, $computer),
            'orderByList' => $this->dataService->getOrderByOptionList(),
            'orderBy' => $orderBy,
            'roomList' => $this->roomLoadingService->getRoomList(),
            'isActive' => $isActive
        ]);
    }

    public function getClassOccupancy(Request $req)
    {
        $startDate = new DateTime($req->get('start-date'));
        $endDate = new DateTime($req->get('end-date').' +1 day');
        $roomId = $req->get('room-id');
        if(is_null($req->get('start-date')) && is_null($req->get('end-date'))) {
            $startDate = new DateTime('now -14 days');
            $endDate = new DateTime('now');
        } elseif (!$req->exists('end-date')) {
            $endDate = new DateTime('now');
        } elseif (!$req->exists('start-date')) {
            $startDate = $endDate->modify('-14 days');
        }
        return view('classOccupancy', [
            'roomList' => $this->roomLoadingService->getRoomList(),
            'rooms' => $this->roomLoadingService->getRoomList($roomId),
            'roomComputerOccupancyData' => $this->dataService->getRoomComputerOccupancyStats($startDate, $endDate, $roomId),
            'datePeriod' => $this->dataService->getDatePeriodArray($startDate, $endDate),
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
    }
}
