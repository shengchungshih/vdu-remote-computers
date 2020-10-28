<?php

namespace App\Models\RdpIS;

use App\Models\Luadm\Cilveks;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class Reservations extends Eloquent
{
    protected $connection = 'rdpis';

    protected $table = 'reservations';

    protected $primaryKey = 'id';

    public $sequence = null;

    public $timestamps = null;

    /**
     * @return HasOne
     */
    public function cilveks(): HasOne
    {
        return $this->hasOne(Cilveks::class, 'ckods', 'ckods');
    }

    /**
     * @return HasOne
     */
    public function computers(): HasOne
    {
        return $this->hasOne(Computers::class, 'id', 'computer_id');
    }
}
