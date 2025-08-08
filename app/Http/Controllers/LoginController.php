<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tabungan;
use App\Models\Pinjaman;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Blade;


class LoginController extends Controller
{

	public function index() {
		return view('v_login');
	}

    public function postlogin (Request $request)
    {
    	if(Auth::attempt($request->only('username', 'password'))) {
            if(auth()->user()->level == "admin") {
                return redirect('/login')->with('admin', 'Tidak bisa login');
            } else if(auth()->user()->level == "siswa"){
                return redirect('/orang_tua/dashboard');
            } else if(auth()->user()->level == "orang tua"){
                return redirect('/orang_tua/dashboard');
            }
    		
    	}

    	return redirect('/login')->with('login_gagal', 'Username atau Password salah');
    }

    public function postlogin_siswa (Request $request)
    {
        if(Auth::attempt($request->only('username', 'password'))) {
            if(auth()->user()->level == "admin") {
                return redirect('/login')->with('admin', 'Tidak bisa login');
            } else if(auth()->user()->level == "siswa"){
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

                return view('siswa.dashboard', compact('total_th', 'total_bln', 'total_hr', 'tgl_chart_debit', 'tgl_chart_kredit', 'nominal_chart_debit', 'nominal_chart_kredit', 'total_pinjaman'));
            } else if(auth()->user()->level == "orang tua"){
                return redirect('/orang_tua/dashboard');
            }
    		
    	}

        return redirect('/login')->with('login_gagal', 'Username atau Password salah');
    }

    public function form_admin()
    {
        return view('login_admin');
    }

    public function postloginAdmin (Request $request)
    {
        if(Auth::attempt($request->only('username', 'password'))) {
            if(auth()->user()->level == "admin") {
                return redirect('/beranda');
            } else if(auth()->user()->level == "siswa"){
                return redirect('/login/admin')->with('bukan_admin', 'Anda tidak punya hak akses');
            } else if(auth()->user()->level == "orang_tua"){
                return redirect('/login/admin')->with('bukan_admin', 'Anda tidak punya hak akses');
            }
            
        }

        return redirect('/login/admin')->with('login_gagal', 'Username atau Password salah');
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function logout_admin()
    {
        Auth::logout();
        return redirect('/login/admin');
    }
}
