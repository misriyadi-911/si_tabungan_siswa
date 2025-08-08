<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    public $timestamps = false;
    protected $primaryKey = 'id_siswa';

    public function kelas()
    {
    	return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function orang_tua() 
    {
    	return $this->belongsTo(Orang_Tua::class, 'id_siswa', 'id_orangtua');
    }

}
