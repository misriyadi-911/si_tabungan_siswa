<?php

namespace App\Http\Controllers;
use App\Models\Notifikasi;

use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
	public function sudah_terbaca ()
	{
		$dt_notifikasi = Notifikasi::where('status_notifikasi', 'belum terbaca')->get();
		foreach ($dt_notifikasi as $dt) {
			$dt->status_notifikasi = "sudah terbaca";
			$dt->save();
		}
		
		return redirect('/beranda');
	}

	public function sudah_terbaca_siswa ($id_notifikasi)
	{
		$dt_notifikasi = Notifikasi::where('status_notifikasi', 'belum terbaca')
		->where('id_siswa', $id_notifikasi)
		->get();
		foreach ($dt_notifikasi as $dt) {
			$dt->status_notifikasi = "sudah terbaca";
			$dt->save();
		}
		
		return redirect('/siswa/dashboard');
	}

	public function sudah_terbaca_orangtua ($id_notifikasi)
	{
		$dt_notifikasi = Notifikasi::where('status_notifikasi', 'belum terbaca')
		->where('id_siswa', $id_notifikasi)
		->get();
		foreach ($dt_notifikasi as $dt) {
			$dt->status_notifikasi = "sudah terbaca";
			$dt->save();
		}
		
		return redirect('/orang_tua/dashboard');
	}
}
