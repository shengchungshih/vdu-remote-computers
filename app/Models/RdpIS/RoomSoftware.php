<?php

namespace App\Models\RdpIS;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class RoomSoftware extends Eloquent
{
    protected $connection = 'rdpis';

    protected $table = 'room_software';

    protected $primaryKey = 'id';

    public $sequence = null;

    public $timestamps = null;

    /**
     * @return HasOne
     */
    public function software(): HasOne
    {
        return $this->hasOne(Software::class, 'id', 'software_id');
    }

    /**
     * @return HasOne
     */
    public function rooms(): HasOne
    {
        return $this->hasOne(Rooms::class, 'id', 'room_id');
    }
}
