@extends('layout.main')

@section('title')
  Siswa
@endsection

@section('title_halaman')
  Input Data Siswa
@endsection

@section('link_halaman')
  <a href="/">Dashboard </a> >> <a href="/siswa"> Siswa</a> >> Tambah Data
@endsection

@section('content')
    <!-- *************************************************************** -->
                <!-- Start First Cards -->
                <!-- *************************************************************** -->
               
                <form action="{{ url('siswa/tambah') }}" method="post" enctype="multipart/form-data">
                	<input type="hidden" name="level" value="siswa">
	                <div class="row">
	                    <div class="col-md-12 col-lg-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <div class="d-flex align-items-start">
	                                    <h3 class="card-title mb-0">Data Siswa</h3>
	                                </div>
	                                <hr>
	                                <div class="row">
		                                <div class="col-md-6">
		                                	 @csrf
		                                	<div class="form-group">
			                                	<label for="nis">NIS</label>
			                                	<input name="nis" type="text" class="form-control @error('nis') is-invalid @enderror" id="nis" value="{{old('nis')}}">
			                                	@error('nis')
		                                            <p class="text-danger text-sm">{{ $message }}</p>
		                                        @enderror
			                                </div>
			                                <div class="form-group">
			                                	<h5 id="nama_siswa">Nama</h5>
			                                	<input name="nama_siswa" type="text" class="form-control" id="nama_siswa">
			                                </div>
			                                <div class="form-group">
			                                	<label for="alamat_siswa">Alamat</label>
			                                	<textarea name="alamat_siswa" id="alamat_siswa" cols="30" rows="5" class="form-control"></textarea>
			                                </div>
			                                <div class="form-group">
			                                	<label for="nohp_siswa">No HP</label>
			                                	<input name="nohp_siswa" type="text" class="form-control" id="nohp_siswa">
			                                </div>
		                                </div>

		                                <div class="col-md-6">
			                           
			                                <div class="form-group">
			                                	<label for="jenis_kelamin_siswa">Jenis Kelamin</label>
			                                	<select name="jenis_kelamin_siswa" id="jenis_kelamin_siswa" class="form-control">
			                                		<option value="Laki-laki">Laki-laki</option>
			                                		<option value="Perempuan">Perempuan</option>
			                                	</select>
			                                </div>
			                                <div class="form-group">
			                                	<label for="kelas">Kelas</label>
			                                	<select name="kelas" id="kelas" class="form-control">
			                                		<option value="1">X</option>
			                                		<option value="2">XI</option>
			                                		<option value="3">XII</option>
			                                	</select>
			                                </div>
			                                <div class="form-group">
			                                	<label for="foto_siswa">Foto</label>
			                                	<input name="foto_siswa" type="file" name="foto_siswa" class="form-control" id="foto_siswa" value="{{old('foto_siswa')}}">
			                                </div>
			                                <div class="form-group">
			                                	<label for="username">Username</label>
			                                	<input name="username" type="text" class="form-control" id="username">
			                                </div>
			                                <div class="form-group">
			                                	<label for="password">Password</label>
			                                	<input name="password" type="text" class="form-control" id="password">
			                                </div>
		                                </div>
	                                </div>	                                
	                            </div>
	                        </div>
	                    </div>
	                    
	                </div>

	                <div class="row">
	                    <div class="col-md-12 col-lg-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <div class="d-flex align-items-start">
	                                    <h3 class="card-title mb-0">Data Orang Tua</h3>
	                                </div>
	                                <hr>
	                                <div class="form-group">
	                                	<label for="nama_orangtua">Nama Orang Tua/Wali</label>
	                                	<input name="nama_orangtua" type="text" class="form-control" id="nama_orangtua">
	                                </div>
	                                <div class="form-group">
	                                	<label for="alamat_orangtua">Alamat</label>
	                                	<input name="alamat_orangtua" type="text" class="form-control" id="alamat_orangtua">
	                                </div>
	                                <div class="form-group">
	                                	<label for="nohp_orangtua">No HP</label>
	                                	<input name="nohp_orangtua" type="number" class="form-control" id="nohp_orangtua">
	                                </div>                                
	                            </div>
	                        </div>
	                    </div>
	                    
	                </div>

	                <input type="submit" value="SIMPAN" class="form-control btn btn-primary" style="width: 15%">
                </form>

                
@endsection
