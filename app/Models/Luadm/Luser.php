<?php

namespace App\Models\Luadm;

use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class Luser extends Eloquent
{
    protected $connection = 'luadm';

    protected $table = 'luser';

    protected $primaryKey = null;

    public $sequence = null;

    public $timestamps = null;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cilveks()
    {
        return $this->hasOne(Cilveks::class, 'ckods', 'cilveks_ckods');
    }

}
