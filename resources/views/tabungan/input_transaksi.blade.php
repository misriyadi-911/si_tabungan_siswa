@extends('layout.main')

@section('title')
  Input Data Tabungan
@endsection

@section('title_halaman')
  Data Tabungan
@endsection

@section('link_halaman')
  <a href="{{ url('/beranda') }}">Dashboard </a> >> <a href="{{ url('/tabungan/tambah') }}"> Input Data Tabungan</a>
@endsection

@section('user')
    {{auth()->user()->admin->nama_admin}}
@endsection 

@section('foto_user')
    {{asset('img')}}/{{auth()->user()->admin->foto_admin}}
@endsection

@section('content')
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<!-- basic table -->
<form action="{{ url('/tabungan/tambah') }}" method="post">
<div class="row">
    <div class="col-12">
    	
        <div class="card">
            <div class="card-body">
            	
                <div class="table-responsive">
                	
                		@csrf
                	<div class="row">
                		<div class="col-lg-8">
                			<input type="date" name="tgl_transaksi" class="form-control mb-3 @error('tgl_transaksi') is-invalid @enderror" style="width: 50%">
                			@error('tgl_transaksi')
	                            <p class="text-danger text-sm">* {{ $message }}</p>
	                        @enderror
                		</div>
                		<div class="col-lg-4">
                			<input type="hidden" name="id_tapel" class="form-control mb-3" width="30%" value="{{$data_tapel[0]->id_tapel}}">
                			@if (!$data_siswa->isEmpty())
								<input type="hidden" name="id_kelas" class="form-control mb-3" width="30%" value="{{$data_siswa[0]->id_kelas}}">
							@else
								<input type="hidden" name="id_kelas" class="form-control mb-3" width="30%" value="">
							@endif

                		</div>
                	</div>
                	<div class="row">
                		<div class="col-sm-12">
                		<!-- <table id="data_table" class="table data_table"> -->	                	
		                    <table id="data_table" class="table data_table">
		                        <thead class="bg-primary text-white">
		                            <tr>
		                                <th scope="col" width="65px">No</th>
		                                <th scope="col" width="165px">NIS</th>
		                                <th scope="col">Nama</th>
		                                <th scope="col">Kelas</th>
		                                <th scope="col">Nominal Debit</th>
		                                <th scope="col">Nominal Kredit</th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                        		@foreach ($data_siswa as $item)
		                        			<tr>
		                        				<td width="65px" scope="row">{{$loop->iteration}}</td>
		                        				<td>
		                        					<input type="hidden" name="id_siswa[]" value="{{$item->id_siswa}}">
		                        					<input type="text" name="nis[]" class="hiddenForm form-control" value="{{$item->nis}}" disabled="">
		                        				</td>
		                        				<td width="165px">
		                        					<input type="text" name="nama_siswa[]" class="hiddenForm  form-control" value="{{$item->nama_siswa}}" disabled="">
		                        				</td>
		                        				<td width="40">
		                        					<input type="text" name="kelas[]" class="hiddenForm  form-control" value="{{$item->kelas->kelas}}" disabled="">
		                        				</td>
		                        				<td>
		                        					<div class="form-group">
		                        						<input type="text" name="nominal_debit[]" class="form-control" value="0">
		                        					</div>                        					
		                        				</td>
		                        				<td>
		                        					<div class="form-group">
		                        						<input type="text" name="nominal_kredit[]" class="form-control" value="0">
		                        					</div>                        					
		                        				</td>
		                        			</tr>
		                        		@endforeach
		                        </tbody>
		                    </table>
		                    
                    	</div>
                    </div>
                    
                </div>
            </div>
        </div>
        <input type="submit" value="SIMPAN" class="ml-auto form-control btn btn-primary" style="width: 15%">

        
    </div>
</div>
</form>
                
@endsection


