<?php

namespace App\Models\Luadm;

use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;


class StudMokejimai extends Eloquent
{
    protected $connection = 'luadm';

    protected $table = 'stud_mokejimai';

    protected $primaryKey = null;

    public $sequence = null;

    public $timestamps = null;
}
