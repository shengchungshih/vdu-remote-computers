<?php

namespace App\Models\RdpIS;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class RoomComputers extends Eloquent
{
    protected $connection = 'rdpis';

    protected $table = 'room_computers';

    protected $primaryKey = 'id';

    public $sequence = null;

    public $timestamps = null;

    /**
     * @return HasOne
     */
    public function rooms(): HasOne
    {
        return $this->hasOne(Rooms::class, 'id', 'room_id');
    }

    /**
     * @return HasOne
     */
    public function computer(): HasOne
    {
        return $this->hasOne(Computers::class, 'id', 'computer_id');
    }


}
