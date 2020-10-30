<?php

namespace App\Models\RdpIS;

use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class Computers extends Eloquent
{
    protected $connection = 'rdpis';

    protected $table = 'computers';

    protected $primaryKey = 'id';

    public $sequence = null;

    public $timestamps = null;

    /**
     * @param $computerId
     * @return bool
     */
    public function getIsComputerReserved($computerId): bool
    {
        return Reservations::where('computer_id', $computerId)->whereNull('is_active')->count() > 0;
    }

    /**
     * @return bool
     */
    public function isComputerLecturers(): bool
    {
        return $this->is_computer_lecturers === '1';
    }
}
