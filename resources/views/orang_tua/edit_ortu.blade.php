@extends('layout.main')

@section('title')
  Orang Tua
@endsection

@section('title_halaman')
  Edit Data Orang Tua
@endsection

@section('link_halaman')
  <a href="/">Dashboard </a> >> <a href="/orang_tua"> Orang Tua</a> >> Edit Data
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
                                    <h3 class="card-title mb-0">Data Orang Tua</h3>
                                </div>
                                <hr>
                                @if(session('status'))
                                    <div class="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form action="{{ url('/orang_tua/edit') }}" method="post">
                                @csrf
                                    <input type="hidden" name="id_orangtua" value="{{$data_orangtua->id_orangtua}}">                                 	
	                                <div class="form-group">
	                                	<label for="nama_orangtua">Nama</label>
	                                	<input name="nama_orangtua" type="text" class="form-control" id="nama_orangtua" value="{{$data_orangtua->nama_orangtua}}">
                                        @error('nama_orangtua')
                                            <p class="text-danger text-sm">*Wajib Diisi</p>
                                        @enderror
	                                </div>
                                    <div class="form-group">
                                        <label for="alamat_orangtua">Alamat</label>
                                        <input name="alamat_orangtua" type="text" class="form-control" id="alamat_orangtua" value="{{$data_orangtua->alamat_orangtua}}">
                                        @error('alamat_orangtua')
                                            <p class="text-danger text-sm">*Wajib Diisi</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="nohp_orangtua">No HP</label>
                                        <input name="nohp_orangtua" type="text" class="form-control" id="nohp_orangtua" value="{{$data_orangtua->nohp_orangtua}}">
                                        @error('nohp_orangtua')
                                            <p class="text-danger text-sm">*Wajib Diisi</p>
                                        @enderror
                                    </div>

	                                <input type="submit" value="SIMPAN" class="form-control btn btn-primary mt-3" style="width: 15%">
                                </form>             
                            </div>
                        </div>
                    </div>
                    
                </div>


                
@endsection
