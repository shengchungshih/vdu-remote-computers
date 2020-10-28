<?php

namespace App\Models\RdpIS;

use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class Software extends Eloquent
{
    protected $connection = 'rdpis';

    protected $table = 'software';

    protected $primaryKey = 'id';

    public $sequence = null;

    public $timestamps = null;
}
