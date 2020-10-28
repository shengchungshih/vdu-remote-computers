<?php
namespace App\Models\Luadm;

use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class Pict extends Eloquent
{
    protected $connection = 'luadm';

    protected $table = 'pict';

    public $sequence = null;

    public $timestamps = null;

}
