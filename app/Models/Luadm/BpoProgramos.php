<?php

namespace App\Models\Luadm;

use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class BpoProgramos extends Eloquent
{
    protected $connection = 'luadm';

    protected $table = 'bpo_programos';

    protected $primaryKey = 'BPO_ID';

    public $sequence = null;

    public $timestamps = null;


    /**
     * Relation between luadm_programma and luadm_bpo_programos tables
     * Not all bpo_programos has relation
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function luadmProgramma()
    {
        return $this->hasOne('App\Models\Luadm\Programma', 'pkods', 'pp_vdu_pkods');
    }
}
