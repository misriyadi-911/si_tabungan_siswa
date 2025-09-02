<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ErrorFormRequest;
use App\Models\Pinjaman;
use App\Models\Tahun_pelajaran;
use App\Models\Tabungan;
use App\Models\Siswa;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PinjamanController extends Controller
{
    public function pinjaman()
    {
        // Logic to retrieve and display data related to pinjaman (loans)
        // This could involve fetching data from the database and passing it to a view
        $data_pinjaman = Pinjaman::all(); // Replace with actual data retrieval logic
        $data_siswa = Siswa::orderBy('nama_siswa', 'asc')->get();
        $data_tapel = Tahun_pelajaran::where('status_tapel','=','aktif')->get();
        return view('pinjaman.data_pinjaman', compact('data_pinjaman', 'data_tapel', 'data_siswa'));
    }
    
    public function total_pinjaman()
    {
        // Logic to retrieve and display data related to pinjaman (loans)
        // This could involve fetching data from the database and passing it to a view
        $data_rekap = Pinjaman::select(
        '*','id_siswa',
        DB::raw('SUM(nominal_pinjaman) as total_pinjaman')
        )
        ->groupBy('id_siswa')
        ->with('siswa')
        ->get()
        ->map(function ($item) {
            $total = $item->total_pinjaman;
            $hibah = ($total >= 1000000) ? floor($total / 1000000) * 20000 : 0;
            $item->total_hibah = $hibah;
            return $item;
        });
        $data_cicilan = Tabungan::where('keterangan', 'like', '%cicilan%')
            ->select(
                '*',
                DB::raw('SUM(nominal_kredit) as total_cicilan')
            )
            ->groupBy('id_siswa')
            ->get()
            ->keyBy('id_siswa');
        $sisa_pinjaman = $data_rekap->map(function ($item) use ($data_cicilan) {
            $total_cicilan = $data_cicilan[$item->id_siswa]->total_cicilan ?? 0;
            $item->sisa_pinjaman = $item->total_pinjaman - $total_cicilan;
            return $item;
        });
        // dd($data_cicilan); 
        $data_tapel = Tahun_pelajaran::where('status_tapel','=','aktif')->get(); // Replace with actual data retrieval logic
        return view('pinjaman.total_pinjaman', compact('data_rekap', 'data_tapel','data_cicilan', 'sisa_pinjaman'));
    }

    public function histori_pinjaman()
    {
        $data_histori = Pinjaman::with('siswa')
            ->orderBy('tgl_pinjam', 'asc')
            ->get();
        return view('pinjaman.histori_pinjaman', compact('data_histori'));
    }

    public function pilih_siswa()
    {
        // Logic to retrieve and display data related to pinjaman (loans)
        // This could involve fetching data from the database and passing it to a view
        $data_siswa = Siswa::orderBy('nama_siswa', 'asc')->get();
        $data_tapel = Tahun_pelajaran::where('status_tapel', '=', 'aktif')->get();
        return view('pinjaman.pilih_siswa', compact('data_siswa', 'data_tapel'));
    }

    public function edit_pinjaman (Request $request)
    {
        $rules = [
            'nominal_pinjaman' => 'required',
        ];

        $text = [
            'nominal_pinjaman.required' => 'Nominal Pinjaman tidak boleh kosong',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);

        if($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $data_pinjaman = Pinjaman::find($request->id_siswa);
        $data_pinjaman->nominal_pinjaman = $request->nominal_pinjaman;
        $data_pinjaman->save();

        return response()->json(['success' => 1, 'text' => 'Data Berhasil Diubah'], 200);
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
        $nominal_debit = Tabungan::where('id_siswa', '=', $request->id_siswa)->sum('nominal_debit');
        $nominal_kredit = Tabungan::where('id_siswa', '=', $request->id_siswa)->sum('nominal_kredit');
        $nominal_saldo = $nominal_debit - $nominal_kredit;
        $allowed_pinjaman = ($nominal_saldo*70)/100;
        if($request->nominal_pinjaman > $allowed_pinjaman) {
            return response()->json([
                'success' => 0,
                'text' => 'Nominal Pinjaman Melebihi Batas. Maksimal Pinjaman Anda 
                        <span style="color:red;">Rp. '.number_format($allowed_pinjaman, 0, ',', '.').'</span> 
                        Dan Total Saldo Anda 
                        <span style="color:red;">Rp. '.number_format($nominal_saldo, 0, ',', '.').'</span>'
            ], 422);
        }else{
            $data_pinjaman->nominal_pinjaman = $request->nominal_pinjaman;
        }
           
        $data_pinjaman->save();
        
        if($data_pinjaman->save()) {
            return response()->json(['text' => 'Data Berhasil Disimpan'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Disimpan'], 400);
        }

    }

    public function hapus_pinjaman ($id_pinjaman)
    {
        $data_pinjaman = Pinjaman::find($id_pinjaman);
        $data_pinjaman->delete();
        return redirect()->back()->with('success', 'Data Pinjaman Berhasil Dihapus');
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
            'nominal_kredit' => 'required',
        ];

        $text = [
            'nominal_kredit.required' => 'Nominal Cicilan tidak boleh kosong',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);

        if($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $data_tabungan = new Tabungan;
        $data_tabungan->id_siswa = $request->id_siswa;
        $data_tabungan->id_tapel = $request->id_tapel;
        $data_tabungan->tgl_transaksi = date('Y-m-d');
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
            return response()->json(['text' => 'Berhasil Bayar Cicilan'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Disimpan'], 400);
        }

    }
}