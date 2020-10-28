<?php
namespace App\Models;

use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class StudPaveles extends Eloquent
{
    protected $connection = 'luadm';

    protected $table = 'stud_paveles';

    protected $primaryKey = null;

    public $sequence = null;

    public $timestamps = null;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * relation with grupu_paveles table
     */
    public function grupuPaveles()
    {
        return $this->hasOne('App\Models\Luadm\GrupuPaveles', 'luis_pav_num', 'pav_luis');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * orders(Įsakymų) semester
     */
    public function tipsSemestras()
    {
        return $this->hasOne('App\Models\Luadm\Tips', 'tkods', 'tips_semestras');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     *  students return to studies semester
     */
    public function tipsSemReturn()
    {
        return $this->hasOne('App\Models\Luadm\Tips', 'tkods', 'tips_sem_return');
    }
}
