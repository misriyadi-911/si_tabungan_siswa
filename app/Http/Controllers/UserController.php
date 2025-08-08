<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ErrorFormRequest;
use App\Models\Users;
use Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class UserController extends Controller
{
    public function edit($id, $level)
    {
        $data_user = Users::where('id_user', $id)
        					->where('level', $level)
        					->get();
        $nama_user;
        $foto_user;
        // dd($level);
        if($level = "orang tua") {
            $nama_user = auth()->user()->orang_tua->nama_orangtua;
            $foto_user = auth()->user()->siswa->foto_siswa;
        } if($level = "siswa") {
            $nama_user = auth()->user()->siswa->nama_siswa;
            $foto_user = auth()->user()->siswa->foto_siswa;
        }
        // dd($nama_user);

        return view('user.edit_user', compact('data_user', 'nama_user', 'foto_user'));
    }

    public function update (Request $request)
    {

    	$id_user = $request->id_user;
    	$level = $request->level;
    	$username = $request->username;
    	$password = $request->password;
    	
    	$rules = [
            'old_password' => 'required',
    		'password' => 'required|string|confirmed',
        ];

        $text = [
            'old_password.required' => 'Password saat ini tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'password.confirmed' => 'Password konfirmasi tidak cocok'
        ];

        $validasi = Validator::make($request->all(), $rules, $text);

        if($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

    	$currentPassword = auth()->user()->password;
    	$old_password = $request->old_password;
    	// dd($currentPassword);
    	
    	if(Hash::check($old_password, $currentPassword)) {
    		// auth()->user()->update([
    		// 	'usename'  => $request->username,
    		// 	'password' => bcrypt($request->password)
    		// ]);
    		$data_user = Users::where('id_user', $id_user)
        					->where('level', $level)
        					->get();
	        $data_user[0]->username = $username;
	        $data_user[0]->password = bcrypt($password);
	        $data_user[0]->save();
    		return response()->json(['text' => 'Data Berhasil Diubah'], 200);
    	}else {
    		return response()->json(['success' => 0, 'text' => 'Masukkan password saat ini yang benar'], 422);
    	}
    }

    public function edit_siswa($id, $level)
    {
        $data_user = Users::where('id_user', $id)
                            ->where('level', $level)
                            ->get();
        // dd($nama_user);

        return view('user.edit_user_siswa', compact('data_user'));
    }

    public function update_siswa (Request $request)
    {

        $id_user = $request->id_user;
        $level = $request->level;
        $username = $request->username;
        $password = $request->password;
        
        $rules = [
            'old_password' => 'required',
            'password' => 'required|string|confirmed',
        ];

        $text = [
            'old_password.required' => 'Password saat ini tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'password.confirmed' => 'Password konfirmasi tidak cocok'
        ];

        $validasi = Validator::make($request->all(), $rules, $text);

        if($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $currentPassword = auth()->user()->password;
        $old_password = $request->old_password;
        // dd($currentPassword);
        
        if(Hash::check($old_password, $currentPassword)) {
            // auth()->user()->update([
            //  'usename'  => $request->username,
            //  'password' => bcrypt($request->password)
            // ]);
            $data_user = Users::where('id_user', $id_user)
                            ->where('level', $level)
                            ->get();
            $data_user[0]->username = $username;
            $data_user[0]->password = bcrypt($password);
            $data_user[0]->save();
            return response()->json(['text' => 'Data Berhasil Diubah'], 200);
        }else {
            return response()->json(['success' => 0, 'text' => 'Masukkan password saat ini yang benar'], 422);
        }
    }

    public function edit_admin($id, $level)
    {
        $data_user = Users::where('id_user', $id)
                            ->where('level', $level)
                            ->get();

        return view('user.edit_user_admin', compact('data_user'));
    }

    public function update_admin (Request $request)
    {

        $id_user = $request->id_user;
        $level = $request->level;
        $username = $request->username;
        $password = $request->password;
        
        $rules = [
            'old_password' => 'required',
            'password' => 'required|string|confirmed',
        ];

        $text = [
            'old_password.required' => 'Password saat ini tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'password.confirmed' => 'Password konfirmasi tidak cocok'
        ];

        $validasi = Validator::make($request->all(), $rules, $text);

        if($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $currentPassword = auth()->user()->password;
        $old_password = $request->old_password;
        // dd($currentPassword);
        
        if(Hash::check($old_password, $currentPassword)) {
            // auth()->user()->update([
            //  'usename'  => $request->username,
            //  'password' => bcrypt($request->password)
            // ]);
            $data_user = Users::where('id_user', $id_user)
                            ->where('level', $level)
                            ->get();
            $data_user[0]->username = $username;
            $data_user[0]->password = bcrypt($password);
            $data_user[0]->save();
            return response()->json(['text' => 'Data Berhasil Diubah'], 200);
        }else {
            return response()->json(['success' => 0, 'text' => 'Masukkan password saat ini yang benar'], 422);
        }
    }
}
