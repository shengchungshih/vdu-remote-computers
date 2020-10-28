<?php

namespace App\Models\RdpIS;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class ReservationsLog extends Eloquent
{
    protected $connection = 'rdpis';

    protected $table = 'reservations_log';

    protected $primaryKey = 'id';

    public $sequence = null;

    public $timestamps = null;

    /**
     * @return HasOne
     */
    public function reservation(): HasOne
    {
        return $this->hasOne(Reservations::class, 'id', 'reservation_id');
    }
}
