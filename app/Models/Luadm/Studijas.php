<?php

namespace App\Models\Luadm;

use Illuminate\Support\Facades\DB;
use PDO;
use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class Studijas extends Eloquent
{
    protected $connection = 'luadm';

    protected $table = 'studijas';

    protected $primaryKey = 'studkods';

    public $sequence = null;

    public $timestamps = null;

    /**
     * Relation between luadm_studijas and luadm_cilveks tables on cilveks primary key
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cilveks()
    {
        return $this->hasOne('App\Models\Luadm\Cilveks', 'ckods', 'cilveks_ckods');
    }

    /**
     * Relation between luadm_studijas and luadm_programma tables on programma primary key
     * Programma table has most of the courses information
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function programma()
    {
        return $this->hasOne('App\Models\Luadm\Programma', 'pkods', 'programma_pkods');
    }

    /**
     * Student status column foreign key relation
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function studTekStav()
    {
        return $this->hasOne('App\Models\Luadm\Tips', 'tkods', 'stud_tek_stav');
    }

    /**
     * Returns relation of students faculty
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function strukturv()
    {
        return $this->hasOne('App\Models\Luadm\Strukturv', 'stkods', 'strukturv_macas');
    }

    public function tipsFinanses()
    {
        return $this->hasOne('App\Models\Luadm\Tips', 'tkods', 'tips_finanses');
    }

    public function studAnalize()
    {
        return $this->belongsTo('App\Models\Luadm\StudAnalize', 'stud_studkods', 'studkods');
    }

    public static function getBachelorStudkodsFromCkods(int $ckods)
    {
        return Studijas::where('ckods', $ckods)->orderBy('id', 'desc')->whereHas('studijasProgramma', function ($q) {
            $q->where('tips_limenis', 'B90400');
        })->first()->studkods;
    }

    public function getThesisGrade()
    {
        return StudAnalize::where('stud_studkods', $this->studkods)->first()->dilloma_grade ?? '';
    }

    public function getGradeAvg()
    {
        return StudAnalize::where('stud_studkods', $this->studkods)->first()->aritm_avg ?? '';
    }

    public function getGradeAvgByCredits()
    {
        return StudAnalize::where('stud_studkods', $this->studkods)->first()->kred_avg ?? '';
    }

    public function getGradesByStudyType()
    {
        $binds = ['p_studkods_in' => $this->studkods, 'p_type_in' => 'PAGR'];
        return DB::selectOne('select esp.esp_api.get_VDU_marks(p_studkods_in => :p_studkods_in, p_type_in => :p_type_in) as grade from dual',
            $binds);
    }
}
