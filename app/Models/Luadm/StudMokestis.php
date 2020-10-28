<?php

namespace App\Models\Luadm;

use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class StudMokestis extends Eloquent
{
    protected $connection = 'luadm';

    protected $table = 'stud_mokestis';

    protected $primaryKey = 'MOK_SQ';

    public $sequence = null;

    public $timestamps = null;

    public function studijas()
    {
        return $this->hasOne('App\Models\Luadm\Studijas', 'studkods', 'stud_studkods');
    }

    public function tips()
    {
        return $this->hasOne('App\Models\Luadm\Tips', 'tkods', 'mok_tipas');
    }

    public function cilveks()
    {
        return $this->hasOne('App\Models\Luadm\Cilveks', 'ckods', 'cilveks_ckods');
    }
}
