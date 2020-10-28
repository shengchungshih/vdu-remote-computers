<?php
namespace App\Models\Luadm;

use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class Iela extends Eloquent
{
    protected $connection = 'luadm';

    protected $table = 'iela';

    protected $primaryKey = 'ikods';

    public $sequence = null;

    public $timestamps = null;

}
