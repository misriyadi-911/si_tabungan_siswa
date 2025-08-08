<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahun_pelajaran extends Model
{
    protected $table = 'tahun_pelajaran';
    public $timestamps = false;
    protected $primaryKey = 'id_tapel';	
}
