<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\Kelas;

use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
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
        $data_kelas = Kelas::all();
        return view('kelas.index', compact('data_kelas'));
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
        $rules = [
            'kelas' => 'required|unique:Kelas,kelas'
        ];

        $text = [
            'kelas.required' => 'Kelas tidak boleh kosong',
            'kelas.unique' => 'Kelas sudah ada'
        ];

        $validasi = Validator::make($request->all(), $rules, $text);

        if($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $kelas = new Kelas;
        $kelas->kelas = $request->kelas;
        $kelas->save();
        if($kelas->save()) {
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
    public function update(Request $request)
    {
        $kelas = Kelas::find($request->id_kelas);
        $kelas->kelas = $request->kelas;
        $kelas->save();
        return redirect('/kelas')->with('ubah_sukses','Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kelas::find($id)->delete();
        return redirect('/kelas')->with('hapus_sukses', 'Data Berhasil Dihapus');
    }
}
