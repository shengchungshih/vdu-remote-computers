<?php

namespace App\Models\Luadm;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class Cilveks extends Eloquent
{
    protected $connection = 'luadm';

    protected $table = 'luadm.cilveks';

    protected $primaryKey = 'CKODS';

    public $sequence = null;

    public $timestamps = null;

    /**
     * Lytis
     * @return HasOne
     */
    public function tipsDzimums()
    {
        return $this->hasOne(Tips::class, 'tkods', 'tips_dzimums');
    }

    /**
     * Pilietybė
     */
    public function tipsPilsoniba()
    {
        return $this->hasOne(Tips::class, 'tkods', 'tips_pilsoniba');
    }


    public function studijas()
    {
        return $this->hasMany(Studijas::class, 'cilveks_ckods', 'ckods');
    }
    /**
     * get personal id codes from cilveks ckods field, one ckods should have only one unique personal code
     * @param $ckods
     * @return mixed
     */
    public static function getPersCodeFromCkods($ckods)
    {
        return self::where('ckods', $ckods)->get()->first()->pers_kods;
    }

    public static function getCkodsFromPersCode($perscode)
    {
        return self::where('pers_kods', $perscode)->get()->first()->ckods;
    }

}
