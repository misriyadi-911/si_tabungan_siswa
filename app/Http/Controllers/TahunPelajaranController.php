<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tahun_pelajaran;

use Illuminate\Support\Facades\Validator;

class TahunPelajaranController extends Controller
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
        $data_tapel = Tahun_pelajaran::all();
        return view('tapel.index', compact('data_tapel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tapel.input_tapel');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'tapel' => 'required|unique:tahun_pelajaran,tapel',
            'status_tapel' => 'required'
        ];

        $text = [
            'tapel.required' => 'Tahun Pelajaran tidak boleh kosong',
            'tapel.unique' => 'Tahun Pelajaran sudah ada',
            'status_tapel' => 'Status tapel tidak boleh kosong'
        ];

        $validasi = Validator::make($request->all(), $rules, $text);

        if($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $Tahun_pelajaran = new Tahun_pelajaran;
        $Tahun_pelajaran->tapel = $request->tapel;
        $Tahun_pelajaran->status_tapel = $request->status_tapel;
        $Tahun_pelajaran->save();
        if($Tahun_pelajaran->save()) {
            return response()->json(['text' => 'Data Berhasil Disimpan'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Disimpan'], 400);
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
    public function edit($id_tapel)
    {
        $data_tapel = Tahun_pelajaran::find($id_tapel);
        return view('tapel.edit_tapel', compact('data_tapel'));
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
            'tapel' => 'required',
            'status_tapel' => 'required'
        ];

        $text = [
            'tapel.required' => 'Tahun Pelajaran tidak boleh kosong',
            'status_tapel' => 'Status tapel tidak boleh kosong'
        ];

        $validasi = Validator::make($request->all(), $rules, $text);

        if($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $data_tapel = Tahun_pelajaran::find($request->id_tapel);
        $data_tapel->tapel          = $request->tapel;
        $data_tapel->status_tapel   = $request->status_tapel;
        $data_tapel->save();

        if($data_tapel->save()) {
            return response()->json(['text' => 'Data Berhasil Diubah'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Diubah'], 400);
        }

        return redirect('/tapel')->with('ubah_sukses','Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tahun_pelajaran::find($id)->delete();
        return redirect('/tapel')->with('hapus_sukses', 'Data Berhasil Dihapus');
    }
}
