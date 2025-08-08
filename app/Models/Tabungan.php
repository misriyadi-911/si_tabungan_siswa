<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    protected $table = 'transaksi';
    public $timestamps = false;
    protected $primaryKey = 'id_transaksi';
    protected $fillable = ['id_siswa', 'id_tapel', 'tgl_transaksi', 'nominal_debit', 'nominal_kredit'];

    public function siswa()
    {
    	return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }
}
