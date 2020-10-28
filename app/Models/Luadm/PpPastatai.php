<?php

namespace App\Models\Luadm;

use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class PpPastatai extends Eloquent
{
    protected $connection = 'luadm';

    protected $table = 'luadm.pp_pastatai';

    public $sequence = null;

    public $timestamps = null;

}
