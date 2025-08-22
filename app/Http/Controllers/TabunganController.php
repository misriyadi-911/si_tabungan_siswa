<?php

namespace App\Http\Controllers;

use App\Exports\TabunganExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;
use App\Http\Requests\ErrorFormRequest;
use App\Models\Tabungan;
use App\Models\Siswa;
use App\Models\Tahun_pelajaran;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TabunganController extends Controller
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
    
    public function index($id_kelas)
    {
        //$data_tabungan = Tabungan::orderBy('tgl_transaksi');
        $data_tabungan_filter = Tabungan::join('siswa', 'transaksi.id_siswa', '=', 'siswa.id_siswa')
                                ->where('siswa.id_kelas', $id_kelas)
                                ->get();
        return view('tabungan.index', compact('data_tabungan_filter'));
    }

    public function rincian_transaksi ($id_siswa)
    {

        $data_tabungan = Tabungan::where('id_siswa', $id_siswa)->get();
        $data_tapel = Tahun_pelajaran::where('status_tapel','=','aktif')->get();
        return view('tabungan.rincian_transaksi', compact('data_tabungan', 'data_tapel'));
    }   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_kelas)
    {
        $data_siswa = Siswa::where('id_kelas', $id_kelas)->orderBy('nama_siswa', 'asc')->get();
        $data_tapel = Tahun_pelajaran::where('status_tapel','=','aktif')->get();
        return view('tabungan.input_transaksi', compact('data_siswa','data_tapel'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tgl_transaksi' => 'required',
        ],
        ['tgl_transaksi.required' => 'Tanggal transaksi tidak boleh kosong. Harap memilih tanggal transaksi']
        );
        $kelas = $request->id_kelas;
        $jml_siswa = Siswa::where('id_kelas', '=', $kelas)->get()->count();
        $data_transaksi = new Tabungan;
        $id_siswa = $request->id_siswa;
        $tgl_transaksi = $request->tgl_transaksi;
        $id_tapel = $request->id_tapel;
        $nis = $request->nis;
        $nama_siswa = $request->nama_siswa;
        $nominal_debit = $request->nominal_debit;
        $nominal_kredit = $request->nominal_kredit;
        for ($i=0; $i < $jml_siswa; $i++) { 
            $data_transaksi->create([
                'id_siswa' => $id_siswa[$i],
                'id_tapel' => $id_tapel,
                'tgl_transaksi' => $tgl_transaksi,
                'nominal_debit' => $nominal_debit[$i],
                'nominal_kredit' => $nominal_kredit[$i]
            ]);
        }
        return redirect('/tabungan/tambah')->with('tambah_sukses','Data Berhasil Ditambahkan');

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function total_tabungan($id_kelas)
    {
        $id_user = auth()->user()->id_user;
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
        $data_tabungan = Tabungan::join('siswa', 'transaksi.id_siswa', '=', 'siswa.id_siswa')
                                ->groupBy(DB::raw('id_siswa'))
                                ->select('transaksi.*', 'siswa.nama_siswa', 'siswa.id_kelas', DB::raw('SUM(transaksi.nominal_debit) as total_debit'), DB::raw('SUM(transaksi.nominal_kredit) as total_kredit'))
                                ->orderBy('siswa.nama_siswa', 'ASC')
                                ->where('siswa.id_kelas', $id_kelas)
                                ->get();
                                // dd($data_tabungan);
        
                                    // dd($data_tabungan_kredit);
        Blade::directive('currency', function ($expression) {
            return "<?php echo number_format($expression, 0, ',', '.'); ?>";
        });
        
        Blade::directive('tgl_indo', function($expression){
            $bulan = array(
                1 => 'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
            $pecah = explode('-', $expression);
            return $pecah[0];
        });
        
        return view('/tabungan.total_tabungan', compact('data_tabungan'));
    }

    public function edit_transaksi (Request $request)
    {
        $rules = [
            'nominal_debit' => 'required',
            'nominal_kredit' => 'required',
        ];

        $text = [
            'nominal_debit.required' => 'Nominal Debit tidak boleh kosong',
            'nominal_kredit.required' => 'Nominal Kredit tidak boleh kosong',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);

        if($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $data_tabungan = Tabungan::find($request->id_transaksi);
        $data_tabungan->id_siswa = $request->id_siswa;
        $data_tabungan->id_tapel = $request->id_tapel;
        $data_tabungan->tgl_transaksi = date('Y-m-d');
        $data_tabungan->nominal_debit = $request->nominal_debit;
        $data_tabungan->nominal_kredit = $request->nominal_kredit;
        $data_tabungan->save();

        return response()->json([
            'success' => 1, 
            'text' => 'Data Berhasil Diupdate',
            'id_siswa' => $request->id_siswa
        ]);
    }


    public function exportExcel() 
    {
        return Excel::download(new TabunganExport, 'Data Saldo Tabungan.xlsx');
    } 
    
}
