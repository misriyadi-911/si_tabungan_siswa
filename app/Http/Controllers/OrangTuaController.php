<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orang_Tua;
use App\Models\Siswa;
use App\Models\Tabungan;

use App\Http\Requests\ErrorFormRequest;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OrangTuaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    public function index()
    {
        $data_orangtua = Orang_Tua::all();
        return view('orang_tua.index', compact('data_orangtua'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_orangtua = Orang_Tua::find($id);
        return view('orang_tua.edit_ortu', compact('data_orangtua'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = [
            'nama_orangtua' => 'required',
            'alamat_orangtua' => 'required',
            'nohp_orangtua' => 'required|min:10|max:12',
        ];

        $text = [
            'nama_orangtua.required' => 'Nama tidak boleh kosong',
            'alamat_orangtua.required' => 'Alamat tidak boleh kosong',
            'nohp_orangtua.required'   => 'No HP tidak boleh kosong',
            'nohp_orangtua.min' => 'No HP Minimal 10 digit',
            'nohp_orangtua.max' => 'No HP Maksimal 12 digit',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);

        if($validasi->fails()) {
            return response()->json(['text' => $validasi->errors()->first()], 422);
        }

        $data_orangtua = Orang_Tua::find($request->id_orangtua);
        $data_orangtua->nama_orangtua = $request->nama_orangtua;
        $data_orangtua->alamat_orangtua = $request->alamat_orangtua;
        $data_orangtua->nohp_orangtua = $request->nohp_orangtua;
        $data_orangtua->save();

        if($data_orangtua->save()) {
            return response()->json(['text' => 'Data Berhasil Diubah'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Diubah'], 400);
        }

        return redirect('/orang_tua')->with('ubah_sukses','Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function dashboard()
    {
        $id_user = auth()->user()->id_user;
        // $dt_tabungan_debit = Tabungan::where('id_siswa', '=', $id_user)
        //                         ->where('jenis_transaksi', '=', 'Debit')
        //                         ->get();
        // $dt_tabungan_kredit = Tabungan::where('id_siswa', '=', $id_user)
        //                         ->where('jenis_transaksi', '=', 'Kredit')
        //                         ->get();

        $dt_tabungan_debit = Tabungan::select('nominal_debit', DB::raw('SUM(nominal_debit) as total_debit'))
                                        ->where('id_siswa', '=', $id_user)
                                        ->get();
        $dt_tabungan_kredit = Tabungan::select('nominal_kredit', DB::raw('SUM(nominal_kredit) as total_kredit'))                           ->where('id_siswa', '=', $id_user)
                                        ->get();
        // $dt_tabungan_bln_debit = Tabungan::whereMonth('tgl_transaksi', '=', date('m'))
        //                         ->where('id_siswa', $id_user)
        //                         ->where('jenis_transaksi', '=', 'Debit')->get();
                                        // $dt_tabungan_bln_kredit = Tabungan::whereMonth('tgl_transaksi', '=', date('m'))
        //                         ->where('id_siswa', $id_user)
        //                         ->where('jenis_transaksi', '=', 'Kredit')->get();

        $dt_tabungan_bln_debit = Tabungan::whereMonth('tgl_transaksi', '=', date('m'))
                                ->where('id_siswa', $id_user)
                                ->select('nominal_debit', DB::raw('SUM(nominal_debit) as total_debit'))
                                ->get();
        $dt_tabungan_bln_kredit = Tabungan::whereMonth('tgl_transaksi', '=', date('m'))
                                ->where('id_siswa', $id_user)
                                ->select('nominal_kredit', DB::raw('SUM(nominal_kredit) as total_kredit'))
                                ->get();
        
        // $dt_tabungan_hr_debit = Tabungan::where('tgl_transaksi', '=', date('Y-m-d'))
        //                         ->where('id_siswa', $id_user)
        //                         ->where('jenis_transaksi', '=', 'Debit')
        //                         ->get();
        // $dt_tabungan_hr_kredit = Tabungan::where('tgl_transaksi', '=', date('Y-m-d'))
        //                         ->where('id_siswa', $id_user)
        //                         ->where('jenis_transaksi', '=', 'Kredit')
        //                         ->get();

        $dt_tabungan_hr_debit = Tabungan::where('tgl_transaksi', '=', date('Y-m-d'))
                                ->where('id_siswa', $id_user)
                                ->select('nominal_debit', DB::raw('SUM(nominal_debit) as total_debit'))
                                ->get();
        $dt_tabungan_hr_kredit = Tabungan::where('tgl_transaksi', '=', date('Y-m-d'))
                                ->where('id_siswa', $id_user)
                                ->select('nominal_kredit', DB::raw('SUM(nominal_kredit) as total_kredit'))
                                ->get();
        // dd($dt_tabungan);
        // $nominal_th_debit = [];
        // $nominal_th_kredit = [];
        // $nominal_bln_debit = [];
        // $nominal_bln_kredit = [];
        // $nominal_hr_debit = [];
        // $nominal_hr_kredit = [];


        // foreach ($dt_tabungan_debit as $dt_tb) {
        //     $nominal_th_debit [] = $dt_tb->nominal;
        // }

        // foreach ($dt_tabungan_kredit as $dt_tb) {
        //     $nominal_th_kredit [] = $dt_tb->nominal;
        // }

        

        // foreach ($dt_tabungan_bln_debit as $dt_tb) {
        //     $nominal_bln_debit [] = $dt_tb->nominal;
        // }

        // foreach ($dt_tabungan_bln_kredit as $dt_tb) {
        //     $nominal_bln_kredit [] = $dt_tb->nominal;
        // }

        // foreach ($dt_tabungan_hr_debit as $dt_hr) {
        //     $nominal_hr_debit [] = $dt_hr->nominal;
        // }

        // foreach ($dt_tabungan_hr_kredit as $dt_hr) {
        //     $nominal_hr_kredit [] = $dt_hr->nominal;
        // }

                

        $total_nm_debit = Tabungan::groupBy('tgl_transaksi')
                    ->select('nominal_debit', DB::raw('SUM(nominal_debit) as total'))
                    ->where('id_siswa', $id_user)
                    ->get();
        $total_nm_kredit = Tabungan::groupBy('tgl_transaksi')
                    ->select('nominal_kredit', DB::raw('SUM(nominal_kredit) as total'))
                    ->where('id_siswa', $id_user)
                    ->get();
        $nominal_chart_debit = [];
        $nominal_chart_kredit = [];
        $kredit = [];
        $dt_tgl = Tabungan::groupBy('tgl_transaksi')->select('tgl_transaksi')->where('id_siswa', $id_user)->get();                                               
        $tgl_chart = [];
        $tgl_chart_kredit = [];

        foreach ($total_nm_debit as $tn) {
            $nominal_chart_debit[] = $tn->total;
        }
        foreach ($total_nm_kredit as $tn) {
            $nominal_chart_kredit[] = $tn->total;
        }
        

        foreach ($dt_tgl as $tgl) {
            $tgl_chart [] = date('d-m-Y', strtotime($tgl->tgl_transaksi));
        }

        

        

        // $total_hr_debit = array_sum($nominal_hr_debit);
        // $total_hr_kredit = array_sum($nominal_hr_kredit);
        // $total_bln_debit = array_sum($nominal_bln_debit);
        // $total_bln_kredit = array_sum($nominal_bln_kredit);
        // $total_th_debit = array_sum($nominal_th_debit);
        // $total_th_kredit = array_sum($nominal_th_kredit);
        // $total_th = $total_th_debit-$total_th_kredit;
        // $total_bln =$total_bln_debit-$total_bln_kredit;
        // $total_hr = $total_hr_debit-$total_hr_kredit;
        
        $total_th = $dt_tabungan_debit[0]->total_debit - $dt_tabungan_kredit[0]->total_kredit;
        $total_bln = $dt_tabungan_bln_debit[0]->total_debit - $dt_tabungan_bln_kredit[0]->total_kredit;
        $total_hr = $dt_tabungan_hr_debit[0]->total_debit - $dt_tabungan_hr_kredit[0]->total_kredit;

        Blade::directive('currency', function ($expression) {
            return "Rp. <?php echo number_format($expression, 0, ',', '.'); ?>";
        });
        return view('orang_tua.dashboard', compact('total_th', 'total_bln', 'total_hr', 'tgl_chart', 'nominal_chart_debit', 'nominal_chart_kredit'));
    }

    public function rincian_tabungan ()
    {
        $id_user = auth()->user()->id_user;
        $user = auth()->user(); // login sebagai orang tua
        $orangtua = $user->orang_tua; // relasi user ke orang tua
        $data_tabungan = Tabungan::where("id_siswa", "=", $id_user)->orderBy('tgl_transaksi')->get();
        $data_siswa = $orangtua?->siswa;
        $data_orangtua = Orang_Tua::where('id_siswa', '1');
        Blade::directive('currency', function ($expression) {
            return "<?php echo number_format($expression, 0, ',', '.'); ?>";
        });
        return view('orang_tua.rincian_tabungan', compact('data_tabungan', 'data_siswa', 'data_orangtua'));
        
    }

    public function total_tabungan ()
    {
        $id_user = auth()->user()->id_user;
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
        $data_tabungan = Tabungan::where("id_siswa", "=", $id_user)
                                    ->groupBy(DB::raw('MONTH(tgl_transaksi)'))
                                    ->get();
        $data_total_tabungan_debit = Tabungan::where("id_siswa", "=", $id_user)
                                    ->select('nominal_debit')
                                    ->get();
        $data_total_tabungan_kredit = Tabungan::where("id_siswa", "=", $id_user)
                                    ->select('nominal_kredit')
                                    ->get();
        $total_debit = [];
        $total_kredit = [];
        foreach ($data_total_tabungan_debit as $dt) {
            $total_debit [] = $dt->nominal_debit;
        }
        foreach ($data_total_tabungan_kredit as $dt) {
            $total_kredit [] = $dt->nominal_kredit;
        }

        $total = array_sum($total_debit) - array_sum($total_kredit);
        $data_siswa = Siswa::find($id_user);
        Blade::directive('currency', function ($expression) {
            return "<?php echo number_format($expression, 0, ',', '.'); ?>";
        });
        

        return view('orang_tua.total_tabungan', compact('data_tabungan', 'data_siswa', 'total'));
    }
}
