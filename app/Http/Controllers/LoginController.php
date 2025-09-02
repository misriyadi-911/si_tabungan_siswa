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
    	if(Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // dd(Auth::user());
            if(auth()->user()->level == "admin") {
                return redirect('/beranda');
            } else if(auth()->user()->level == "siswa"){
                return redirect('/siswa/dashboard');
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
        return redirect('/login');
    }
}
