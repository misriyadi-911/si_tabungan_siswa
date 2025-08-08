@extends('layout.main')

@section('title')
  Rincian Tabungan Siswa
@endsection

@section('title_halaman')
  Data Rincian Tabungan Siswa
@endsection

@section('link_halaman')
  <a href="/">Dashboard </a> >> <a href="/orang_tua/tabungan/total"> Rincian Tabungan</a>
@endsection

@section('user')
    {{auth()->user()->orang_tua->nama_orangtua}}
@endsection

@section('content')
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<!-- basic table -->

<div class="row">
    <div class="col-12">
    	
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                	
                		@csrf
                	
                		
                	</div>
                	<div class="row">
                		<div class="col-sm-12">
                			<table>
                				<tr>
                					<td>NIS</td>
                					<td> : </td>
                					<td>{{$data_siswa->nis}}</td>
                				</tr>
                				<tr>
                					<td>Nama</td>
                					<td> : </td>
                					<td>{{$data_siswa->nama_siswa}}</td>
                				</tr>
                				<tr>
                					<td>Kelas</td>
                					<td> : </td>
                					<td>{{$data_siswa->kelas->kelas}}</td>
                				</tr>
                                <tr>
                                    <td>Nama Orang Tua</td>
                                    <td> : </td>
                                    <td>{{$data_siswa->orang_tua->nama_orangtua}}</td>
                                </tr>
                			</table>
                			<hr class="mb-4">              	
		                    <table id="data_table" class="table data_table">
		                        <thead class="bg-primary text-white">
		                            <tr>
		                                <th scope="col" width="65px">No</th>
		                                <th scope="col">Tanggal Transaksi</th>
		                                <th scope="col">Debit</th>
		                                <th scope="col">Kredit</th>
		                                <th scope="col" width="130px">Nominal</th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                        		@foreach ($data_tabungan as $item)
		                        			<tr>
                                                <td width="65px" scope="row">{{$loop->iteration}}</td>
                                                <td>
                                                    {{date('d-m-Y', strtotime($item->tgl_transaksi))}}
                                                </td>
                                                <td width="40px">
                                                    @if($item->nominal_debit > 0)
                                                        
                                                        
                                                        <h3 style="color: #20B2AA">&#10004;</h3>
                                                        <!--<h3 style="color: #00FA9A">&#10004;</h3>-->
                                                    @endif
                                                </td>
                                                <td>
                                                    
                                                    @if($item->nominal_kredit > 0)
                                                        <h3 style="color: #20B2AA">&#10004;</h3>
                                                    @endif
                                                </td>
                                                <td width="130px">
                                                    
                                                    @if($item->nominal_kredit > 0)
                                                        @currency($item->nominal_kredit)
                                                    @endif

                                                    @if($item->nominal_debit > 0)
                                                        @currency($item->nominal_debit)
                                                    @endif


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
                
@endsection


