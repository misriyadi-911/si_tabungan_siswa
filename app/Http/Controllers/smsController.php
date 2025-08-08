<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;
use Illuminate\Support\Facades\DB;

use App\Models\Orang_Tua;
use App\Models\Tabungan;

class smsController extends Controller
{
    public function index()
    {
        $data_orangtua = Orang_Tua::all();
        return view('sms', compact('data_orangtua'));
    }

    public function sendSms($id){
    	$data_orangtua = Orang_Tua::find($id);
        $dt_tabungan_debit = Tabungan::select('nominal_debit', DB::raw('SUM(nominal_debit) as total_debit'))
                                        ->where('id_siswa', '=', $data_orangtua->id_siswa)
                                        ->get();
        $dt_tabungan_kredit = Tabungan::select('nominal_kredit', DB::raw('SUM(nominal_kredit) as total_kredit'))
                                        ->where('id_siswa', '=', $data_orangtua->id_siswa)
                                        ->get();;
        $data_saldo = $dt_tabungan_debit[0]->total_debit - $dt_tabungan_kredit[0]->total_kredit;

        
        $idmesin = "454";
        $pin = "085720";

        $no_tujuan = $data_orangtua->nohp_orangtua;
        $message = "Total Saldo ".$data_orangtua->siswa->nama_siswa." saat ini adalah Rp.". number_format($data_saldo, 0, ',', '.');
        $pesan = str_replace(" ", "%20", $message);

        // create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, "https://sms.indositus.com/sendsms.php?idmesin=$idmesin&pin=$pin&to=$no_tujuan&text=$pesan");

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //string agar dapat dijalankan pada localhost
        //mematikan ssl verify
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);
        return redirect('/sms')->with("kirim_sukses", "Kirim pesan berhasil");
    }
}
