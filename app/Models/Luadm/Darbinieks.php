<?php

namespace App\Models\Luadm;

use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class Darbinieks extends Eloquent
{
    protected $connection = 'luadm';

    protected $table = 'darbinieks';

    protected $primaryKey = 'DARBKODS';

    public $sequence = null;

    public $timestamps = null;

    public function cilveks()
    {
        return $this->hasOne(Cilveks::class, 'ckods', 'cilveks_ckods');
    }

    /**
     * Get workers name and surname from worker code
     * @param Darbinieks $darb
     * @return string
     */
    public function getNameSurnameFromDarbkods(): string
    {
        $cilv = Cilveks::where('ckods', $this->cilveks_ckods)->first();
        return $cilv->vards.' '.$cilv->uzvards;
    }


}
