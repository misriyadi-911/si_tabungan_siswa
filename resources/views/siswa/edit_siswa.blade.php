@extends('layout.main')

@section('title')
  Siswa
@endsection

@section('title_halaman')
  Edit Data Siswa
@endsection

@section('link_halaman')
  <a href="/">Dashboard </a> >> <a href="/siswa"> Siswa</a> >> Edit Data
@endsection

@section('content')
    <!-- *************************************************************** -->
                <!-- Start First Cards -->
                <!-- *************************************************************** -->
                
                <form action="/siswa/edit" method="post" enctype="multipart/form-data">
                	<input type="hidden" name="level" value="siswa">
                	<input type="hidden" name="id_siswa" value="{{$data_siswa->id_siswa}}">
	                <div class="row">
	                    <div class="col-md-12 col-lg-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <div class="d-flex align-items-start">
	                                    <h3 class="card-title mb-0">Edit Data Siswa</h3>
	                                </div>
	                                <hr>
	                                <div class="row">
		                                <div class="col-md-6">
		                                	@csrf
		                                	<div class="form-group">
			                                	<label for="nis">NIS</label>
			                                	<input name="nis" type="text" class="form-control" id="nis" disabled="" value="{{$data_siswa->nis}}">
			                                </div>
			                                <div class="form-group">
			                                	<h5 id="nama_siswa">Nama</h5>
			                                	<input name="nama_siswa" type="text" class="form-control" id="nama_siswa" value="{{$data_siswa->nama_siswa}}">
			                                </div>
			                                <div class="form-group">
			                                	<label for="alamat_siswa">Alamat</label>
			                                	<input name="alamat_siswa" id="alamat_siswa" cols="30" rows="5" class="form-control" value="{{$data_siswa->alamat_siswa}}"></input>
			                                </div>
			                                <div class="form-group">
			                                	<label for="nohp_siswa">No HP</label>
			                                	<input name="nohp_siswa" type="text" class="form-control" id="nohp_siswa" value="{{$data_siswa->nohp_siswa}}">
			                                </div>
		                                </div>

		                                <div class="col-md-6">
			                           
			                                <div class="form-group">
			                                	<label for="jenis_kelamin_siswa">Jenis Kelamin</label>
			                                	<select name="jenis_kelamin_siswa" id="jenis_kelamin_siswa" class="form-control">
			                                		<option value="{{$data_siswa->jenis_kelamin_siswa}}">{{$data_siswa->jenis_kelamin_siswa}}</option>
			                                		<option value="" disabled="">-- Pilih Jenis Kelamin --</option>
			                                		<option value="Laki-laki">Laki-laki</option>
			                                		<option value="Perempuan">Perempuan</option>
			                                	</select>
			                                </div>
			                                <div class="form-group">
			                                	<label for="kelas">Kelas</label>
			                                	<select name="kelas" id="kelas" class="form-control">
			                                		<option value="{{$data_siswa->kelas->kelas}}">{{$data_siswa->kelas->kelas}}</option>
			                                		<option value="" disabled="">-- Pilih Kelas --</option>
			                                		<option value="1">X</option>
			                                		<option value="2">XI</option>
			                                		<option value="3">XII</option>
			                                	</select>
			                                </div>
			                                <div class="form-group">
			                                	<label for="foto_siswa">Foto</label>
			                                	<input name="foto_siswa" type="file" name="foto_siswa" class="form-control" id="foto_siswa" value="{{$data_siswa->foto_siswa}}" >
			                                </div>
		                                </div>
	                                </div>	                                
	                            </div>
	                        </div>
	                    </div>
	                    
	                </div>

	               
	                <input type="submit" value="SIMPAN" class="form-control btn btn-primary" style="width: 15%">
                </form>

                
@endsection
