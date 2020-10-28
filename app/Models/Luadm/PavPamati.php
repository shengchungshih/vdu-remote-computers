<?php

namespace App\Models;

use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class PavPamati extends Eloquent
{
    protected $connection = 'luadm';

    protected $table = 'pav_pamati';

    protected $primaryKey = 'pav_pam_id';

    public $sequence = null;

    public $timestamps = null;

    /**
     * Order id
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pavLuis()
    {
        return $this->hasOne('App\Models\Luadm\GrupuPaveles', 'luis_pav_num', 'pav_luis');
    }

    /**
     * student id
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function studStudkods()
    {
        return $this->hasOne('App\Models\Luadm\Studijas', 'studkods', 'stud_studkods');
    }

    /**
     * Luadm_tips code classificator
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipsPamats()
    {
        return $this->hasOne('App\Models\Luadm\Tips', 'tkods', 'tips_pamats');
    }
}
