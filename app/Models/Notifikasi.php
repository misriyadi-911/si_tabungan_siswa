<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasi';
    public $timestamps = false;
    protected $primaryKey = 'id_notifikasi';

    public function siswa()
    {
    	return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function transaksi()
    {
    	return $this->belongsTo(Tabungan::class, 'id_transaksi', 'id_transaksi');
    }
}
