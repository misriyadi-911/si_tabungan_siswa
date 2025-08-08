@extends('layout.main')

@section('title')
  Admin
@endsection

@section('title_halaman')
  Input Data Admin
@endsection

@section('link_halaman')
  <a href="/">Dashboard </a> >> <a href="/admin"> Admin</a> >> Tambah Data
@endsection

@section('content')
    <!-- *************************************************************** -->
                <!-- Start First Cards -->
                <!-- *************************************************************** -->

                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <h3 class="card-title mb-0">Data Admin</h3>
                                </div>
                                <hr>
                                <form action="/admin/tambah" method="post" enctype="multipart/form-data">
                                @csrf
	                                	<label for="level"></label>
	                                	<input name="level" type="hidden" class="form-control" id="level" value="admin">                          	
	                                <div class="form-group">
	                                	<label for="nama_admin">Nama</label>
	                                	<input name="nama_admin" type="text" class="form-control" id="nama_admin">
	                                </div>
	                                <div class="form-group">
	                                	<label for="alamat_admin">Alamat</label>
	                                	<input name="alamat_admin" type="text" class="form-control" id="alamat_admin">
	                                </div>
	                                <div class="form-group">
	                                	<label for="nohp_admin">No HP</label>
	                                	<input name="nohp_admin" type="number" class="form-control" id="nohp_admin">
	                                </div>
	                                <div class="form-group">
	                                	<label for="foto_admin">Foto</label>
	                                	<input name="foto_admin" type="file" id="foto_admin">
	                                </div>
	                                <div class="form-group">
	                                	<label for="username">Username</label>
	                                	<input name="username" type="text" class="form-control" id="username">
	                                </div>
	                                <div class="form-group">
	                                	<label for="password">Password</label>
	                                	<input name="password" type="text" class="form-control" id="password">
	                                </div>
	                                <!-- <div class="form-group">
	                                	<label for="konfirmasi_password">Konfirmasi Password</label>
	                                	<input type="konfirmasi_password" class="form-control" id="konfirmasi_password">
	                                </div> -->

	                                <input type="submit" value="SIMPAN" class="form-control btn btn-primary mt-3 rounded-pill btn_simpan" style="width: 15%">
                                </form>             
                            </div>
                        </div>
                    </div>
                    
                </div>


                
@endsection
