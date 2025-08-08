<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orang_Tua extends Model
{
    protected $table = 'orang_tua';
    public $timestamps = false;
    protected $primaryKey = 'id_orangtua';

    public function siswa()
    {
    	return $this->hasOne(Siswa::class,'id_siswa', 'id_siswa');
    }
}
