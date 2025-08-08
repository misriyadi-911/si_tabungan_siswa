<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Users;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

include("koneksi.php");

class AdminController extends Controller
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
        $data_admin = Admin::all();
        return view ('admin.index', compact('data_admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.input_admin');
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
            'nama_admin' => 'required',
            'alamat_admin' => 'required',
            'nohp_admin' => 'required|min:10|max:12',
            'foto_admin'=>'required|max:2000|mimes:jpeg,png,jpg,gif,svg',
            'username' => 'required|unique:Users,username',
            'password' => 'required',
        ];

        $text = [
            'nama_admin.required' => 'Nama tidak boleh kosong',
            'alamat_admin.required' => 'Alamat tidak boleh kosong',
            'nohp_admin.required'   => 'No HP tidak boleh kosong',
            'nohp_admin.min' => 'No HP Minimal 10 digit',
            'nohp_admin.max' => 'No HP Maksimal 12 digit',
            'foto_admin.required' => 'Foto tidak boleh kosong',
            'foto_admin.max' => 'Ukuran tidak boleh lebih dari 2 MB',
            'foto_admin.mimes' => 'Format file foto harus sesuai',
            'username.unique'  => 'Username sudah dipakai',
            'username.required' => 'username tidak boleh kosong',
            'password.required' => 'password tidak boleh kosong',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);

        if($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }
        $foto_admin = $request->foto_admin->getClientOriginalName().'-'.time().'.'.$request->foto_admin->extension();
        $request->foto_admin->move(public_path('img'), $foto_admin);

        $Admin = new Admin;
        $Admin->nama_admin = $request->nama_admin;
        $Admin->alamat_admin = $request->alamat_admin;
        $Admin->nohp_admin = $request->nohp_admin;
        $Admin->foto_admin = $foto_admin;
        $Admin->save();
        // $data = mysqli_query($conn, "SELECT id_admin FROM admin ORDER BY id_admin DESC");
        // $query = mysqli_fetch_assoc($data);
        $id_admin = Admin::orderByDESC('id_admin')->get();
        
        $User = new Users;
        $User->id_user = $id_admin[0]['id_admin'];
        $User->level = $request->level;
        $User->username = $request->username;
        $User->password = Hash::make($request->password);
        $User->save();

        if($User->save()) {
            return response()->json(['text' => 'Data Berhasil Ditambahkan'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Ditambahkan'], 400);
        }

        return redirect('/admin')->with('tambah_sukses','Data Berhasil Ditambahkan');
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
         $data_admin = Admin::find($id);
         return view('admin.edit_admin', compact('data_admin'));
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
            'nama_admin' => 'required',
            'alamat_admin' => 'required',
            'nohp_admin' => 'required|min:10|max:12',
        ];

        $text = [
            'nama_admin.required' => 'Nama tidak boleh kosong',
            'alamat_admin.required' => 'Alamat tidak boleh kosong',
            'nohp_admin.required'   => 'No HP tidak boleh kosong',
            'nohp_admin.min' => 'No HP Minimal 10 digit',
            'nohp_admin.max' => 'No HP Maksimal 12 digit',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);

        if($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $data_admin = Admin::find($request->id_admin);
        $data_admin->nama_admin     = $request->nama_admin;
        $data_admin->alamat_admin   = $request->alamat_admin;
        $data_admin->nohp_admin     = $request->nohp_admin;

        if($request->foto_admin != null) {
            $foto_admin = $request->foto_admin->getClientOriginalName().'-'.time().'.'.$request->foto_admin->extension();
            $request->foto_admin->move(public_path('img'), $foto_admin);
            $data_admin->foto_admin = $foto_admin;

        } else {
            $data_admin->foto_admin = $request->foto_lama;
        }   
        
        $data_admin->save();

        // Admin::where('id_admin', $request->id_admin)
        //         ->update([
        //             'nama_admin'    => $request->nama_admin,
        //             'alamat_admin'  => $request->alamat_admin,
        //             'nohp_admin'    => $request->nohp_admin,
        //             'foto_admin'    => $foto_admin
        //         ]);

        if($data_admin->save()) {
            return response()->json(['text' => 'Data Berhasil Diubah'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Diubah'], 400);
        }

        return redirect('/admin')->with('ubah_sukses','Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data_admin = Admin::find($id);
        $data_admin->delete();
        Users::where('id_user', '=', $id)->delete();
        return redirect('/admin')->with('hapus_sukses', 'Data Berhasil Dihapus');
    }
}
