<?php

namespace App\Models\Luadm;

use App\Models\MoodleOracle\MdlAssocCourses;
use App\Models\Regis\RgStreams;
use App\Models\Regis\RgSubjects;
use Illuminate\Database\Eloquent\Collection;
use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class Karto extends Eloquent
{
    protected $connection = 'luadm';

    protected $table = 'karto';

    protected $primaryKey = 'id';

    public $sequence = null;

    public $timestamps = null;

    public function studijas()
    {
        return $this->hasOne('App\Models\Luadm\Studijas', 'studkods', 'stud_studkods');
    }

    public function kurss()
    {
        return $this->hasOne('App\Models\Luadm\Kurss', 'kkods', 'kurs_kkods');
    }

    /**
     * @param int $studkods
     * @return mixed
     */
    public static function getGraduationThesisGrade(int $studkods)
    {
        return Karto::where('stud_studkods', $studkods)
            ->whereNotNull('darb_txt')
            ->whereNotNull('kursa_nosauk_txt')
            ->whereBetween('atzime', ['5', '10'])->first()->atzime;
    }

    /**
     * Get a joint regis+karto tables list of subjects
     * @param string $semester
     * @return Collection
     */
    public static function getKartoFileSyncInfo(string $semester, string $orderBy): Collection
    {
        return Karto::join('kurss', 'karto.kurs_kkods', '=', 'kurss.kkods')
            ->leftJoin('regis.rg_streams as rg', 'karto.sraut', '=', 'rg.str_id')
            ->select('kurs_kkods', 'sraut', 'kurss.kkods_ieks', 'kurss.knosauk', 'rg.str_auth_name1', 'rg.str_comment', 'rg.str_location_id', 'rg.str_state_type')
            ->where('tips_macg', $semester)
            ->whereNotIn('sraut', MdlAssocCourses::getMoodleAssocCoursesIds())
            ->orderBy($orderBy)
            ->groupBy(['kurs_kkods', 'sraut', 'kurss.kkods_ieks', 'kurss.knosauk', 'rg.str_auth_name1', 'rg.str_comment', 'rg.str_location_id', 'rg.str_state_type'])
            ->get();
    }

    /**
     * Get ID list of karto+regis subjects
     * @param string $semester
     * @return Collection
     */
    public static function getKartoFileSyncInfoIds(string $semester): Collection
    {
        return Karto::join('kurss', 'karto.kurs_kkods', '=', 'kurss.kkods')
            ->leftJoin('regis.rg_streams as rg', 'karto.sraut', '=', 'rg.str_id')
            ->select('sraut')
            ->where('tips_macg', $semester)
            ->whereNotIn('sraut', MdlAssocCourses::getMoodleAssocCoursesIds())
            ->orderBy('kurss.kkods_ieks')
            ->groupBy(['sraut', 'kurss.kkods_ieks', 'kurss.knosauk', 'rg.str_auth_name1', 'rg.str_comment'])
            ->get();
    }

    /**
     * Get subject information from karto table that do not have any relation with regis table
     * @param string $semester
     * @param $lectType
     * @return Collection
     */
    public static function getKartoFileNoRegisInfo(string $semester, $lectType, string $orderBy): Collection
    {
        return Karto::join('kurss', 'karto.kurs_kkods', '=', 'kurss.kkods')
            ->join('darbinieks d', 'karto.darb_darbkods', '=', 'd.darbkods')
            ->join('cilveks c', 'd.cilveks_ckods', '=', 'c.ckods')
            ->select('kurs_kkods', 'sraut', 'kurss.kkods_ieks', 'kurss.knosauk', 'c.vards', 'c.uzvards')
            ->where('tips_macg', $semester)
            ->whereNotIn('sraut', MdlAssocCourses::getMoodleAssocCoursesIds())
            ->whereNotIn('sraut', RgStreams::getRegisFileSyncInfoIds($semester, $lectType))
            ->orderBy($orderBy)
            ->groupBy(['kurs_kkods', 'sraut', 'kurss.kkods_ieks', 'kurss.knosauk', 'c.vards', 'c.uzvards'])
            ->get();
    }
}
