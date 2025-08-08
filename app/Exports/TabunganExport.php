<?php

namespace App\Exports;

use App\Models\Tabungan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\withMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;

class TabunganExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     $bulan = request()->bulan;
    // 	$data_tabungan = Tabungan::groupBy(\DB::raw('id_siswa'))
    //                             ->select('*', \DB::raw('SUM(nominal_debit) as total_debit'), \DB::raw('SUM(nominal_kredit) as total_kredit'))
    //                             ->whereMonth('tgl_transaksi', $bulan)
    //                             ->get();
    //     if(count($data_tabungan) == 0) {
    //         echo "data tidak ditemukan";
    //         dd();
    //     }
    //     return $data_tabungan;
    // }

    public function view(): View
    {
    	$bulan = request()->bulan;
        $id_kelas = request()->id_kelas;
        $data_tabungan = Tabungan::join('siswa', 'transaksi.id_siswa', '=', 'siswa.id_siswa')
                                ->groupBy(\DB::raw('id_siswa'))
                                ->select('transaksi.*', \DB::raw('SUM(nominal_debit) as total_debit'), \DB::raw('SUM(nominal_kredit) as total_kredit'))
                                ->orderBy('siswa.nama_siswa', 'ASC')
                                
                                ->where('siswa.id_kelas', '=', $id_kelas)
                                ->get();
        if(count($data_tabungan) == 0){
            echo "data tidak ditemukan";
            dd();   
        }
        return view('tabungan.eksport',compact('data_tabungan'));
    }

    // public function map($data_tabungan): array
    // {
    //     return [
    //         $data_tabungan->siswa->nama_siswa,
    //         $data_tabungan->siswa->kelas->kelas,
    //         $data_tabungan->total_debit,
    //         $data_tabungan->total_kredit,
    //         $data_tabungan->total_debit - $data_tabungan->total_kredit,
    //     ];
    // }

    // public function headings(): array
    // {
    //     return [
    //         'NAMA',
    //         'KELAS',
    //         'DEBIT',
    //         'KREDIT',
    //         'TOTAL SALDO',
    //     ];
    // }
}
