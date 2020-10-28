<?php

namespace App\Models\Luadm;

use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class StudMokestisAudit extends Eloquent
{
    protected $connection = 'luadm';

    protected $table = 'stud_mokestis_audit';

    protected $primaryKey = null;

    public $sequence = null;

    public $timestamps = null;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function studijas()
    {
        return $this->hasOne(Studijas::class, 'studkods', 'stud_studkods');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function luser()
    {
        return $this->hasOne(Luser::class, 'username', 'jn_user');
    }
}
