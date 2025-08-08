<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';
    public $timestamps = false;
    protected $fillable = ['username', 'password'];

    public function siswa()
    {
    	return $this->belongsTo(Siswa::class,'id_user', 'id_siswa');
    }

    public function orang_tua()
    {
    	return $this->belongsTo(Orang_Tua::class,'id_user', 'id_orangtua');
    }

    public function admin()
    {
    	return $this->belongsTo(Admin::class,'id_user', 'id_admin');
    }
}
