<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ErrorFormRequest;
use App\Models\Pinjaman;
use App\Models\Tahun_pelajaran;
use App\Models\Tabungan;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class PinjamanController extends Controller
{
    public function data_pinjaman()
    {
        // Logic to retrieve and display data related to pinjaman (loans)
        // This could involve fetching data from the database and passing it to a view
        $data_pinjaman = Pinjaman::all();
        $id_user = auth()->user()->id_user;
        $total_pinjaman = Pinjaman::where('id_siswa', '=', $id_user)->sum('nominal_pinjaman');
        Blade::directive('currency', function ($expression) {
            return "Rp. <?php echo number_format($expression, 0, ',', '.'); ?>";
        });
        $data_tapel = Tahun_pelajaran::where('status_tapel','=','aktif')->get(); // Replace with actual data retrieval logic
        return view('pinjaman.data_pinjaman', compact('data_pinjaman', 'data_tapel', 'total_pinjaman'));
    }

    public function proses_pinjam(Request $request)
    {
        $rules = [
            'tgl_pinjam' => 'required|date',
            'nominal_pinjaman' => 'required',
        ];

        $text = [
            'tgl_pinjam.required' => 'Tanggal Pinjam tidak boleh kosong',
            'tgl_pinjam.date' => 'Format Tanggal Pinjam tidak valid',
            'nominal_pinjaman.required' => 'Nominal Pinjaman tidak boleh kosong',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);

        if($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $data_pinjaman = new Pinjaman();
        $data_pinjaman->id_siswa = $request->id_siswa;
        $data_pinjaman->id_tapel = $request->id_tapel;
        $data_pinjaman->tgl_pinjam = $request->tgl_pinjam;
        $data_pinjaman->nominal_pinjaman = $request->nominal_pinjaman;        
        $data_pinjaman->save();
        
        if($data_pinjaman->save()) {
            return response()->json(['text' => 'Data Berhasil Disimpan'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Disimpan'], 400);
        }

    }

    public function data_cicilan()
    {
        // Logic to retrieve and display data related to cicilan (installments)
        // This could involve fetching data from the database and passing it to a view
        $id_user = auth()->user()->id_user;
        $data_cicilan = Tabungan::where('id_siswa', '=', $id_user)
            ->where('keterangan', 'like', '%cicilan%')
            ->orderBy('tgl_transaksi', 'desc')
            ->get();
        $total_cicilan = Tabungan::where('id_siswa', '=', $id_user)
            ->where('keterangan', 'like', '%cicilan%')
            ->sum('nominal_kredit');
        $total_pinjaman = Pinjaman::where('id_siswa', '=', $id_user)->sum('nominal_pinjaman');
        Blade::directive('currency', function ($expression) {
            return "Rp. <?php echo number_format($expression, 0, ',', '.'); ?>";
        });
        $data_tapel = Tahun_pelajaran::where('status_tapel','=','aktif')->get();
        return view('pinjaman.bayar_cicilan', compact('data_cicilan', 'total_cicilan', 'total_pinjaman', 'data_tapel'));
    }

    public function proses_cicilan (Request $request)
    {
        $rules = [
            'tgl_cicilan' => 'required|date',
            'nominal_kredit' => 'required',
        ];

        $text = [
            'tgl_cicilan.required' => 'Tanggal Cicilan tidak boleh kosong',
            'tgl_cicilan.date' => 'Format Tanggal Cicilan tidak valid',
            'nominal_kredit.required' => 'Nominal Cicilan tidak boleh kosong',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);

        if($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $data_tabungan = new Tabungan;
        $data_tabungan->id_siswa = $request->id_siswa;
        $data_tabungan->id_tapel = $request->id_tapel;
        $data_tabungan->tgl_transaksi = $request->tgl_cicilan;
        $data_tabungan->nominal_debit = '0';
        $data_tabungan->nominal_kredit = $request->nominal_kredit;
        $data_tabungan->keterangan = 'cicilan';

        $data_nominal = Tabungan::where('id_siswa', '=', auth()->user()->id_user)->get();
        // dd($dt_tabungan);
        $nominal_debit = [];

        foreach ($data_nominal as $dt_tb) {
            $nominal_debit [] = $dt_tb->nominal_debit;
        }

        $nominal_kredit = [];

        foreach ($data_nominal as $dt_tb) {
            $nominal_kredit [] = $dt_tb->nominal_kredit;
        }

        $total_saldo = array_sum($nominal_debit) - array_sum($nominal_kredit);   

        if($request->nominal_kredit > $total_saldo)
        {
            return response()->json(['success' => 0, 'text' => 'Saldo Tidak Cukup. Saldo Anda Rp. '.number_format($total_saldo, 0, ',', '.')], 422);
        }else {

        }

        $data_tabungan->save();
        if($data_tabungan->save()) {
            return response()->json(['text' => 'Data Berhasil Disimpan'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Disimpan'], 400);
        }

    }
}