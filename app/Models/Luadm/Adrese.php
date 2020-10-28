<?php

namespace App\Models\Luadm;

use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class Adrese extends Eloquent
{
    protected $connection = 'luadm';

    protected $table = 'adrese';

    public $sequence = null;

    public $timestamps = null;

    public function adreseCilveksCkods()
    {
        return $this->hasOne('App\Models\Luadm\Cilveks', 'ckods', 'cilveks_ckods');
    }

    public function adreseTipsTkods()
    {
        return $this->hasOne('App\Models\Luadm\Tips', 'tkods', 'tips_tkods');
    }

    public function adreseApdzV()
    {
        return $this->hasOne('App\Models\Luadm\ApdzV', 'avkods', 'apdz_v_avkods');
    }

    public function adreseIela()
    {
        return $this->hasOne('App\Models\Luadm\Iela', 'ikods', 'iela_ikods');
    }
}
