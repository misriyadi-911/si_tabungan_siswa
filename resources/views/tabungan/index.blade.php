@extends('layout.main')

@section('title')
  Data Rincian Tabungan
@endsection

@section('title_halaman')
  Data Tabungan
@endsection


@section('link_halaman')
  <a href="{{ url('/beranda') }}">Dashboard </a> >> <a href="{{ url('/tabungan/tambah') }}"> Tabungan</a>
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
<form action="/transaksi/tambah" method="post">
<div class="row">
    <div class="col-12">
    	
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                	
                		@csrf
                	
                		
                	</div>
                	<div class="row">
                		<div class="col-sm-12">	                	
		                    <table id="data_table" class="table data_table">
		                        <thead class="bg-primary text-white">
		                            <tr>
		                                <th scope="col" width="65px">No</th>
		                                <th scope="col" width="165px">NIS</th>
		                                <th scope="col">Nama</th>
		                                <th scope="col">Kelas</th>
		                                <th scope="col">Tanggal Transaksi</th>
		                                <th scope="col">Nominal Debit</th>
		                                <th scope="col">Nominal Kredit</th>
		                            </tr>
		                        </thead>
		                        <tbody>
									
		                        		@foreach ($data_tabungan_filter as $item)
		                        			<tr>
		                        				<td width="65px" scope="row">{{$loop->iteration}}</td>
		                        				<td>
		                        					{{$item->siswa->nis}}
		                        				</td>
		                        				<td width="165px">
		                        					{{$item->siswa->nama_siswa}}
		                        				</td>
		                        				<td width="40px">
		                        					{{$item->siswa->kelas->kelas}}
		                        				</td>
		                        				<td>
		                        					{{date('d-m-Y', strtotime($item->tgl_transaksi))}}
		                        				</td>
		                        				<td>
		                        					{{$item->nominal_debit}}                   					
		                        				</td>
		                        				<td>
		                        					{{$item->nominal_kredit}}                   					
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
                
    </div>
</div>
</form>
                
@endsection


