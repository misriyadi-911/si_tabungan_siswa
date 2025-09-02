<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Orang_Tua;
use App\Models\Users;
use App\Models\Tabungan;
use App\Models\Pinjaman;
use App\Models\Tahun_pelajaran;
use App\Models\Notifikasi;

use App\Http\Requests\ErrorFormRequest;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class SiswaController extends Controller
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
        $data_siswa = Siswa::orderBy('nama_siswa', 'asc')->get();
        return view('siswa.index', compact('data_siswa'));
    }

    public function indexByKelas($id_kelas)
    {
        $data_siswa = Siswa::where('id_kelas', $id_kelas)->orderBy('nama_siswa', 'asc')->get();
        return view('siswa.index', compact('data_siswa'));
    }

    public function histori_pinjaman ($id_siswa)
    {
        $data_pinjaman = Pinjaman::where('id_siswa', $id_siswa)->get();
        return view('siswa.histori_pinjaman', compact('data_pinjaman'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('siswa.input_siswa');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'nis' => 'required|unique:Siswa,nis|',
        //     'foto'=>'mimes:jpeg,png,jpg,gif,svg'
        // ]);

        $rules = [
            'nis' => 'required|unique:Siswa,nis',
            'nama_siswa' => 'required',
            'alamat_siswa' => 'required',
            'nohp_siswa' => 'required|min:10|max:12',
            'jenis_kelamin_siswa' => 'required',
            'kelas' => 'required',
            'foto_siswa'=>'required|max:2000|mimes:jpeg,png,jpg,gif,svg',
            'username' => 'required|unique:Users,username',
            'password' => 'required',
            'nama_orangtua' => 'required',
            'alamat_orangtua' => 'required',
            'nohp_orangtua' => 'required|min:10|max:12'
        ];

        $text = [
            'nis.required' => 'NIS tidak boleh kosong',
            'nis.unique'   => 'NIS sudah ada',
            'nama_siswa.required' => 'Nama tidak boleh kosong',
            'alamat_siswa.required' => 'Alamat tidak boleh kosong',
            'nohp_siswa.required'   => 'No HP tidak boleh kosong',
            'nohp_siswa.min' => 'No HP Minimal 10 digit',
            'nohp_siswa.max' => 'No HP Maksimal 12 digit',
            'jenis_kelamin_siswa.required' => 'Pilih jenis kelamin terlebih dahulu',
            'kelas.required' => 'kelas tidak boleh kosong',
            'foto_siswa.required' => 'Foto tidak boleh kosong',
            'foto_siswa.max' => 'Ukuran tidak boleh lebih dari 2 MB',
            'foto_siswa.mimes' => 'Format file foto harus sesuai',
            'username.required' => 'username tidak boleh kosong',
            'username.unique' => 'username sudah terpakai',
            'password.required' => 'password tidak boleh kosong',
            'nama_orangtua.required' => 'Nama wali tidak boleh kosong',
            'alamat_orangtua.required' => 'Alamat wali tidak boleh kosong',
            'nohp_orangtua.required' => 'No HP wali tidak boleh kosong',
            'nohp_orangtua.min' => 'No HP Minimal 10 digit',
            'nohp_orangtua.max' => 'No HP Maksimal 12 digit',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);

        if($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $foto_siswa = $request->foto_siswa->getClientOriginalName().'-'.time().'.'.$request->foto_siswa->extension();
        $request->foto_siswa->move(public_path('img'), $foto_siswa);

        // $no_rekening;

        $data       = Siswa::all()->count();
        $dataSiswa  = Siswa::orderByDESC('id_siswa')->limit(1)->get();
        
        if($data==0){
            $no_rekening = $request->nis.'0001';
        } else {
            if($dataSiswa[0]['id_siswa'] < 9){
                $no_rekening = $request->nis.'000'.($dataSiswa[0]['id_siswa']+1);
            }else if($dataSiswa[0]['id_siswa'] >= 9 && $dataSiswa[0]['id_siswa'] < 99) {
                $no_rekening = $request->nis.'00'.($dataSiswa[0]['id_siswa']+1);
            }else {
                $no_rekening = $request->nis.'0'.($dataSiswa[0]['id_siswa']+1);
            }
            
        }

        $Siswa                      = new Siswa;
        $Siswa->nis                 = $request->nis;
        $Siswa->nama_siswa          = $request->nama_siswa;
        $Siswa->alamat_siswa        = $request->alamat_siswa;
        $Siswa->nohp_siswa          = $request->nohp_siswa;
        if($request->jenis_kelamin_siswa == null) {
            return response()->json(['success' => 0, 'text' => 'Pilih Jenis Kelamin terlebih dahulu'], 422);
        } else {
            $Siswa->jenis_kelamin_siswa = $request->jenis_kelamin_siswa;
        }
        $Siswa->id_kelas            = $request->kelas;
        $Siswa->no_rekening         = $no_rekening;
        $Siswa->foto_siswa          = $foto_siswa;
        $Siswa->save();

        $data_idSiswa  = Siswa::orderByDESC('id_siswa')->limit(1)->get();
        $id_siswa = $data_idSiswa[0]['id_siswa'];

        $data_siswa = Siswa::find($id_siswa);
        $data_siswa->id_orangtua = $data_siswa->id_siswa;
        $data_siswa->save();

        $Orang_Tua                  = new Orang_Tua;
        $Orang_Tua->id_siswa        = $id_siswa;
        $Orang_Tua->nama_orangtua   = $request->nama_orangtua;
        $Orang_Tua->alamat_orangtua = $request->alamat_orangtua;
        $Orang_Tua->nohp_orangtua   = $request->nohp_orangtua;
        $Orang_Tua->save();

        $User = new Users;
        $User->id_user  = $id_siswa;
        $User->level    = 'siswa';
        $User->username = $request->username;
        $User->password = bcrypt($request->password);
        $User->save();

        $dataOrangTua = Orang_Tua::orderByDESC('id_orangtua')->limit(1)->get();
        $id_orangtua  = $dataOrangTua[0]['id_orangtua'];

        $User2 = new Users;
        $User2->id_user = $id_orangtua;
        $User2->level = 'orang tua';
        $User2->username = 'wali'.$request->username;
        $User2->password = Hash::make($request->password);
        $User2->save();
        // return redirect('/siswa')->with('tambah_sukses','Data Berhasil Ditambahkan');

        if($User2->save()) {
            return response()->json(['text' => 'Data Berhasil Ditambahkan'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Ditambahkan'], 400);
        }
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
        $data_siswa = Siswa::find($id);
        return view('siswa.edit_siswa', compact('data_siswa'));
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
        $data_siswa = Siswa::find($request->id_siswa);

        $rules = [
            'nama_siswa' => 'required',
            'alamat_siswa' => 'required',
            'nohp_siswa' => 'required|min:10|max:12',
            'jenis_kelamin_siswa' => 'required',
            'kelas' => 'required',
        ];

        $text = [
            'nama_siswa.required' => 'Nama tidak boleh kosong',
            'alamat_siswa.required' => 'Alamat tidak boleh kosong',
            'nohp_siswa.required'   => 'No HP tidak boleh kosong',
            'nohp_siswa.min' => 'No HP Minimal 10 digit',
            'nohp_siswa.max' => 'No HP Maksimal 12 digit',
            'jenis_kelamin_siswa.required' => 'Jenis kelamin tidak boleh kosong',
            'kelas.required' => 'kelas tidak boleh kosong',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);

        if($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $data_siswa->nama_siswa = $request->nama_siswa;
        $data_siswa->alamat_siswa = $request->alamat_siswa;
        $data_siswa->nohp_siswa = $request->nohp_siswa;
        $data_siswa->jenis_kelamin_siswa = $request->jenis_kelamin_siswa;
        $data_siswa->id_kelas = $request->kelas;

        if($request->foto_siswa != null) {

            $foto_siswa = $request->foto_siswa->getClientOriginalName().'-'.time().'.'.$request->foto_siswa->extension();
            $request->foto_siswa->move(public_path('img'), $foto_siswa);

            
            $data_siswa->foto_siswa = $foto_siswa;
        }else {
            $data_siswa->foto_siswa = $request->foto_lama;
        }
            
        $data_siswa->save();

        if($data_siswa->save()) {
            return response()->json(['text' => 'Data Berhasil Diubah'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Diubah'], 400);
        }

        return redirect('/siswa')->with('ubah_sukses','Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data_siswa = Siswa::find($id);
        $data_siswa->delete();
        Orang_Tua::where('id_siswa','=',$id)->delete();
        Tabungan::where('id_siswa', $id)->delete();
        Pinjaman::where('id_siswa', $id)->delete();

        Users::where('id_user','=',$id)
                ->where('level', 'siswa')
                ->delete();

        $user_ortu = new Users;
        $user_ortu->where('id_user', '=', $id)
                  ->where('level', 'orang tua')
                  ->delete();
        Notifikasi::where('id_siswa', $id)->delete();

        return redirect('/siswa')->with('hapus_sukses', 'Data Berhasil Dihapus');
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
        $total_pinjaman = Pinjaman::where('id_siswa', $id_user)->sum('nominal_pinjaman');
        $total_cicilan = Tabungan::where('id_siswa', $id_user)->where('keterangan', '=', 'cicilan')->sum('nominal_kredit'); 
        $sisa_pinjaman = $total_pinjaman - $total_cicilan;
        $nominal_chart_debit = [];
        $nominal_chart_kredit = [];
        $kredit = [];
        $dt_tgl = Tabungan::groupBy('tgl_transaksi')->select('tgl_transaksi')->where('id_siswa', $id_user)->get();                                               
        $tgl_chart_debit = [];
        $tgl_chart_kredit = [];

        foreach ($total_nm_debit as $tn) {
            $nominal_chart_debit[] = $tn->total;
        }
        foreach ($total_nm_kredit as $tn) {
            $nominal_chart_kredit[] = $tn->total;
        }
        

        foreach ($dt_tgl as $tgl) {
            $tgl_chart_debit [] = date('d-m-Y', strtotime($tgl->tgl_transaksi));
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

        return view('siswa.dashboard', compact('total_th', 'total_bln', 'total_hr', 'tgl_chart_debit', 'tgl_chart_kredit', 'nominal_chart_debit', 'nominal_chart_kredit', 'total_pinjaman', 'total_cicilan', 'sisa_pinjaman', 'sisa_pinjaman','total_cicilan'));
    }

    public function rincian_tabungan ()
    {
        $id_user = auth()->user()->id_user;
        $data_tabungan = Tabungan::where("id_siswa", "=", $id_user)->orderBy('tgl_transaksi')->get();
        $data_siswa = Siswa::find($id_user);
        Blade::directive('currency', function ($expression) {
            return "<?php echo number_format($expression, 0, ',', '.'); ?>";
        });
        return view('/siswa.rincian_tabungan', compact('data_tabungan', 'data_siswa'));
        
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
        
        

        return view('/siswa.total_tabungan', compact('data_tabungan', 'data_siswa', 'total'));
    }

    public function input_bayar ()
    {
        $data_tapel = Tahun_pelajaran::where('status_tapel','=','aktif')->get();
        return view('siswa.pembayaran', compact('data_tapel'));
    }

    public function proses_bayar(Request $request)
    {
        $rules = [
            'nominal' => 'required',
        ];

        $text = [
            'nominal.required' => 'Nominal tidak boleh kosong',
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
        $data_tabungan->nominal_kredit = $request->nominal;
        $data_tabungan->keterangan = $request->jenis_pembayaran;

         $data_nominal = Tabungan::where('id_siswa', '=', auth()->user()->id_user)->get();
        // dd($dt_tabungan);
        $nominal_debit = [];

        foreach ($data_nominal as $dt_tb) {
            $nominal_debit [] = $dt_tb->nominal_debit;
        }

        $total_debit = array_sum($nominal_debit);;

        if($request->nominal > $total_debit)
        {
            return response()->json(['success' => 0, 'text' => 'Saldo Tidak Cukup. Saldo Anda Rp. '.number_format($total_debit, 0, ',', '.')], 422);
        }else {

        }

        $data_tabungan->save();

        $data_id_transaksi = Tabungan::orderByDESC('id_transaksi')->limit(1)->get();
        $id_transaksi = $data_id_transaksi[0]['id_transaksi'];

        $data_notifikasi = new Notifikasi;
        $data_notifikasi->id_siswa = $request->id_siswa;
        $data_notifikasi->id_transaksi = $id_transaksi;
        $data_notifikasi->status_notifikasi = 'belum terbaca';
        $data_notifikasi->save();

        if($data_notifikasi->save()) {
            return response()->json(['text' => 'Data Berhasil Disimpan'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Disimpan'], 400);
        }

    }
}
