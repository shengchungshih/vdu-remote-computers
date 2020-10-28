<?php

namespace App\Models\Luadm;

use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class Kurss extends Eloquent
{
    protected $table = 'kurss';

    protected $connection = 'luadm';

    protected $primaryKey = 'kkods';

    public $sequence = null;

    public $timestamps = null;

    protected $guarded = [];
}
