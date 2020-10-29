<?php


namespace App\Http\Services;


use App\Models\RdpIS\Computers;
use App\Models\RdpIS\Reservations;
use App\Models\RdpIS\RoomComputers;
use App\Models\RdpIS\Rooms;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class RoomLoadingService
{
    /**
     * @return Rooms[]|Collection
     */
    public function getRoomList()
    {
        return Rooms::orderBy('room_name')->get();
    }

    public function reserveComputer($ckods, $computerId): RedirectResponse
    {
        if (empty($ckods) || empty($computerId)) {
            return redirect()->back()->with('alert-warning', 'Įvyko klaida rezervuojant kambarį, perkraukite puslapį ir mėginkite dar kartą.');
        }

        if ($this->getIfUserHasActiveReservations($ckods)) {
            return redirect()->back()->with('alert-warning', 'Jūs jau turite užrezervuotą kompiuterį.');
        }

        if ($this->getIsComputerReserved($computerId)) {
            return redirect()->back()->with('alert-warning', 'Kompiuteris šiuo metu užrezervuotas.');
        }

        if ($this->isComputerLecturers($computerId) && empty(auth()->user()->ez_lecturer_id)) {
            return redirect()->back()->with('alert-warning', 'Dėstytojų kompiuterius gali rezervuoti tik dėstytojai :)');
        }

        $reservation = new Reservations();

        $reservation->computer_id = $computerId;
        $reservation->ckods = $ckods;
        $reservation->reservation_start_date = date('Y-m-d H:i:s');
        $reservation->save();

        $fullRdpUrl = env('RDP_FILE_URL_ROOT').'/'.$this->getComputerRdpFileUrl($computerId);

        Session::flash('download_url', $fullRdpUrl); // Since we cant do two requests we flash the download url to a session and the once redirected we use the meta tag to download the file
        return redirect()->back()->with('alert-success', 'Sėkmingai užrezervavote kompiuterį.');
    }

    public function cancelComputerReservation($ckods, $computerId): RedirectResponse
    {
        $r = Reservations::where(['ckods' => $ckods, 'computer_id' => $computerId])->whereNull('is_active')->first();

        if (empty($r)) {
            return redirect()->back()->with('alert-warning', 'Nerasta reservacija atšaukimui.');
        }

        $r->is_active = 0;
        $r->reservation_end_date = date('Y-m-d H:i:s');
        $r->save();

        return redirect()->back()->with('alert-success', 'Sėkmingai atšaukėte kompiuterio rezervaciją.');
    }

    public function getIsComputerReserved($computerId): bool
    {
        return Reservations::where('computer_id', $computerId)->whereNull('is_active')->count() > 0;
    }

    public function getIfUserHasActiveReservations($ckods): bool
    {
        return Reservations::where('ckods', $ckods)->whereNull('is_active')->count() > 0;
    }

    public function getComputerRdpFileUrl($computerId)
    {
        return Computers::where('id', $computerId)->first()->rdp_file_url;
    }

    public function getFullComputerRdpFileUrl($computerId): string
    {
        return env('RDP_FILE_URL_ROOT').'/'.$this->getComputerRdpFileUrl($computerId);
    }

    public function isComputerLecturers($computerId): bool
    {
        return Computers::where('id', $computerId)->first()->is_computer_lecturers === '1';
    }

    public function getUsersActiveReservationPc($ckods = null)
    {
        if(is_null($ckods)) {
            $ckods = $this->getActiveUserCkods();
        }
        return Reservations::where('ckods', $ckods)->whereNull('is_active')->first()->computer_id;
    }

    public function getActiveUserCkods()
    {
        return auth()->user()->cilveks_ckods;
    }

    public function getUsersActiveReservationPcName($computer_id)
    {
        return Computers::where('id', $computer_id)->first()->pc_name;
    }

    public function getUsersActiveReservationRoomName($computer_id)
    {
        return RoomComputers::with('rooms')->where('computer_id', $computer_id)->first()->rooms->room_name;
    }
}
