<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $table = 'pinjaman';
    public $timestamps = false;
    protected $primaryKey = 'id_pinjaman';
    protected $fillable = [
        'id_siswa',
        'id_tapel',
        'tgl_pinjam',
        'nominal_pinjaman',
    ];

    public function siswa()
    {
    	return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }
}
