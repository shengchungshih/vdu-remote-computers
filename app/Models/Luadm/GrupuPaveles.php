<?php
namespace App\Models;

use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class GrupuPaveles extends Eloquent
{
    protected $connection = 'luadm';

    protected $table = 'grupu_paveles';

    protected $primaryKey = 'luis_pav_num';

    public $sequence = null;

    public $timestamps = null;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * Priemimo klasifikatoriaus pavadinimas
     */
    public function tipsPavele()
    {
        return $this->hasOne('App\Models\Luadm\Tips', 'tkods', 'tips_pavele');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * Ar registruotas ar ne?
     */
    public function grupuPiezimes()
    {
        return $this->hasOne('App\Models\Luadm\Tips', 'tkods', 'piezimes');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function amkodsIzdeva()
    {
        return $this->hasOne('App\Models\Luadm\Tips', 'tkods', 'amkods_izdeva');
    }

    public function tipsStatus()
    {
        return $this->hasOne('App\Models\Luadm\Tips', 'tkods', 'tips_statuss');
    }

    public function grupuJaunaVertiba()
    {
        return $this->hasOne('App\Models\Luadm\Tips', 'tkods', 'jauna_vertiba');
    }

    public static function checkIfOrderFileExists($luisPavNum)
    {
        return GrupuPaveles::where('luis_pav_num', $luisPavNum)->whereNotNull('isak_file_url')->exists();
    }

    public static function getOrderFileUrl($luisPavNum)
    {
        return GrupuPaveles::where('luis_pav_num', $luisPavNum)->get()->first()->isak_file_url;
    }
}
