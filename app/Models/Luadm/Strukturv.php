<?php

namespace App\Models\Luadm;

use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class Strukturv extends Eloquent
{
    protected $connection = 'luadm';

    protected $table = 'strukturv';

    protected $primaryKey = 'STKODS';

    public $sequence = null;

    public $timestamps = null;

    public static function getFacultyList(){
        return Strukturv::where('strukturv_stkods', 'lll000000000')->where('st_code', 'B71100')->orderBy('stnosauk')->get();
    }
}
