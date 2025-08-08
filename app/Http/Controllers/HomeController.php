<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tabungan;
use App\Models\Siswa;
use App\Models\Notifikasi;
use Carbon;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $dt_notifikasi = Notifikasi::where('status_notifikas', 'belum terbaca')->get();
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function login ()
    {
        return view('welcome');
    }

    public function index()
    {
        
        $dt_tabungan_debit = Tabungan::select('nominal_debit', \DB::raw('SUM(nominal_debit) as total_debit'))->get();
        $dt_tabungan_kredit = Tabungan::select('nominal_kredit', \DB::raw('SUM(nominal_kredit) as total_kredit'))->get();
        $dt_tabungan_bln_debit = Tabungan::whereMonth('tgl_transaksi', '=', date('m'))->select('nominal_debit', \DB::raw('SUM(nominal_debit) as total_debit'))->get();
        $dt_tabungan_bln_kredit = Tabungan::whereMonth('tgl_transaksi', '=', date('m'))->select('nominal_kredit', \DB::raw('SUM(nominal_kredit) as total_kredit'))->get();
        $dt_tabungan_hr_debit = Tabungan::where('tgl_transaksi', '=', date('Y-m-d'))->select('nominal_debit', \DB::raw('SUM(nominal_debit) as total_debit'))->get();
        $dt_tabungan_hr_kredit = Tabungan::where('tgl_transaksi', '=', date('Y-m-d'))->select('nominal_kredit', \DB::raw('SUM(nominal_kredit) as total_kredit'))->get();

        // dd($dt_tabungan_debit);
        // $nominal_th_debit = [];
        // $nominal_th_kredit = [];
        // $nominal_bln_kredit = [];
        // $nominal_bln_debit = [];
        // $nominal_hr_debit = [];
        // $nominal_hr_kredit = [];
        // foreach ($dt_tabungan_debit as $dt_tb) {
        //     $nominal_th_debit [] = $dt_tb->nominal_debit;
        // }
        // foreach ($dt_tabungan_kredit as $dt_tb) {
        //     $nominal_th_kredit [] = $dt_tb->nominal_kredit;
        // }

        // foreach ($dt_tabungan_bln_debit as $dt_tb) {
        //     $nominal_bln_debit [] = $dt_tb->nominal_debit;
        // }

// tgl_chart_debit        //     $nominal_bln_kredit [] = $dt_tb->nominal_kredit;
        // }

        // foreach ($dt_tabungan_hr_debit as $dt_hr) {
        //     $nominal_hr_debit [] = $dt_hr->nominal_debit;
        // }

        // foreach ($dt_tabungan_hr_kredit as $dt_hr) {
        //     $nominal_hr_kredit [] = $dt_hr->nominal_kredit;
        // }

        $total_nm_debit = Tabungan::groupBy('tgl_transaksi')->select('nominal_debit', \DB::raw('SUM(nominal_debit) as total_debit'))->get();
        ;
        $total_nm_kredit = Tabungan::groupBy('tgl_transaksi')->select('nominal_kredit', \DB::raw('SUM(nominal_kredit) as total_kredit'))->get();
        $nominal_chart_debit = [];
        $nominal_chart_kredit = [];
        $dt_tgl = Tabungan::groupBy('tgl_transaksi')->select('tgl_transaksi')->get();

        $tgl_chart_debit = [];
        $total_siswa = Siswa::count();

        foreach ($total_nm_debit as $tn) {
            $nominal_chart_debit[] = $tn->total_debit;
        }

        foreach ($total_nm_kredit as $tn) {
            $nominal_chart_kredit[] = $tn->total_kredit;
        }

        
        $tgl_chart = [];

        foreach ($dt_tgl as $tgl) {
            $tgl_chart [] = date('d-m-Y', strtotime($tgl->tgl_transaksi));
        }

        // dd($tgl_chart);

        
        

        $total_th = $dt_tabungan_debit[0]->total_debit - $dt_tabungan_kredit[0]->total_kredit;
        $total_bln = $dt_tabungan_bln_debit[0]->total_debit - $dt_tabungan_bln_kredit[0]->total_kredit;
        $total_hr = $dt_tabungan_hr_debit[0]->total_debit - $dt_tabungan_hr_kredit[0]->total_kredit;

        Blade::directive('currency', function ($expression) {
            return "Rp. <?php echo number_format($expression, 0, ',', '.'); ?>";
        });

        return view('home', compact('total_th', 'total_bln', 'total_hr', 'tgl_chart', 'nominal_chart_debit', 'nominal_chart_kredit', 'total_siswa'));
    }
}
