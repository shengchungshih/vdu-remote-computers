<?php


namespace App\Models\RdpIS;

use App\Models\Luadm\Cilveks;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class RoomTechnicians extends Eloquent
{
    protected $connection = 'rdpis';

    protected $table = 'room_technicians';

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
    public function rooms(): HasOne
    {
        return $this->hasOne(Rooms::class, 'id', 'room_id');
    }
}
