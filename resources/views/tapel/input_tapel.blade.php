@extends('layout.main')

@section('title')
  Tahun Pelajaran
@endsection

@section('title_halaman')
  Tambah Data Tahun Pelajaran
@endsection

@section('link_halaman')
  <a href="/">Dashboard </a> >> <a href="/tapel"> Tahun Pelajaran</a> >> Tambah Data
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
                                    <h3 class="card-title mb-0">Data Tahun Pelajaran</h3>
                                </div>
                                <hr>
                                @if(session('status'))
                                    <div class="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form action="/tapel/tambah" method="post">
                                @csrf                                 	
	                                <div class="form-group">
	                                	<label for="tapel">Tahun Pelajaran</label>
	                                	<input name="tapel" type="text" class="form-control" id="tapel">
                                        @error('tapel')
                                            <p class="text-danger text-sm">*Wajib Diisi</p>
                                        @enderror
	                                </div>
                                    <div class="form-group">
                                        <label for="status_tapel">Status</label>
                                        <select name="status_tapel" id="status" class="form-control">
                                            <option value="Aktif">Aktif</option>
                                            <option value="Tidak Aktif">Tidak Aktif</option>
                                        </select>
                                    </div>

	                                <input type="submit" value="SIMPAN" class="form-control btn btn-primary mt-3" style="width: 15%">
                                </form>             
                            </div>
                        </div>
                    </div>
                    
                </div>


                
@endsection
