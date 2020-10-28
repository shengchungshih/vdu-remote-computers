<?php

namespace App\Models\Luadm;

use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class StudAnalize extends Eloquent
{
    protected $connection = 'luadm';

    protected $table = 'stud_analize';

    protected $primaryKey = null;

    public $sequence = null;

    public $timestamps = null;

    public function studkods(){
        return $this->hasOne('App\Models\Luadm\Studijas', 'studkods', 'stud_studkods');
    }
}
