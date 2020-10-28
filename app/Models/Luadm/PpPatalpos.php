<?php

namespace App\Models\Luadm;

use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class PpPatalpos extends Eloquent
{
    protected $connection = 'luadm';

    protected $table = 'luadm.pp_patalpos';

    public $sequence = null;

    public $timestamps = null;

    public function ppPastatai()
    {
        return $this->hasOne(PpPastatai::class, 'id', 'pastatai_id');
    }
}
