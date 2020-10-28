<?php
namespace App\Models\Luadm;

use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class Tips extends Eloquent
{
    protected $connection = 'luadm';

    protected $table = 'tips';

    protected $primaryKey = 'TKODS';

    public $sequence = null;

    public $timestamps = null;

    public function tipsTkods()
    {
        return $this->hasMany('App\Model\Luadm\Tips', 'tips_tkods', 'tkods');
    }

    public static function getStudentStages()
    {
        return self::where('tips_tkods', 'B90000')->whereNotNull('status')->get();
    }

    public static function getSemesterList()
    {
        return self::where('tips_tkods', 'FO0000')->whereNotNull('tnosauka')->orderByDesc('tkods')->get(['tkods', 'tnosauk']);
    }

    public static function getActiveSemester()
    {
        return self::where('status', 'like', '%lT%')->first()->tkods;
    }
}
