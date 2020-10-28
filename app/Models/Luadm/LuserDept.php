<?php

namespace App\Models\Luadm;

use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class LuserDept extends Eloquent
{
    protected $connection = 'luadm';

    protected $table = 'luser_dept';

    public $sequence = null;

    public $timestamps = null;

    protected $primaryKey = 'ldid';

    public function cilveks(){
        $this->hasOne('App\Models\Luadm\Cilveks', 'ckods', 'c_ckods');
    }

    public static function getUserFaculties(){
        return LuserDept::where('c_ckods', auth()->user()->cilveks_ckods)->select('dept_stkods')->get()->toArray();
    }
}
