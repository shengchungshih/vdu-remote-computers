<?php
namespace App\Models\Luadm;

use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class ApdzV extends Eloquent
{
    protected $connection = 'luadm';

    protected $table = 'apdz_v';

    protected $primaryKey = 'avkods';

    public $sequence = null;

    public $timestamps = null;

}
