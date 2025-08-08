@extends('layout.main')

@section('title')
  Data Total Tabungan
@endsection

@section('title_halaman')
  Data Total Tabungan Siswa
@endsection

@section('link_halaman')
  <a href="{{ url('/') }}">Dashboard </a> >> <a href="{{ url('/siswa/tabungan/total') }}"> Total Tabungan</a>
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

<?php 

    use Illuminate\Support\Carbon;

?>

<div class="row">
    <div class="col-12">
    	
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                	
                		@csrf
                	
                		
                	</div>
                	<div class="row">
                		<div class="col-sm-12">
                            <div class="row">
                                <div class="col-4 align-self-center">
                                    <table>
                                        <!--
                                        <tr>
                                            <td>Bulan</td>
                                            <td> : </td>
                                            <td>{{Carbon::now()->isoFormat('MMMM')}}</td>
                                            <td>
                                        </tr>
                                        -->
                                    </table>
                                </div>
                                
                                <div class="col-6 align-self-center">
                                    <div class="float-right">
                                        <form action="{{url('tabungan/exportExcel')}}" method="post">
                                            @csrf
                                            @if ($data_tabungan->isNotEmpty())
                                                <input type="hidden" name="id_kelas" value="{{ $data_tabungan[0]->id_kelas }}">
                                            @else
                                                <input type="hidden" name="id_kelas" value="">
                                            @endif
                                                <!--
                                                <select name="bulan" id="" class="form-control">
                                                    <option value="<?php $dt = Carbon::now(); echo "0".$dt->month; ?>">{{Carbon::now()->isoFormat('MMMM')}}</option>
                                                    <hr><hr><hr>
                                                    <option value="01">Januari</option>
                                                    <option value="02">Februari</option>
                                                    <option value="03">Maret</option>
                                                    <option value="04">April</option>
                                                    <option value="05">Mei</option>
                                                    <option value="06">Juni</option>
                                                    <option value="07">Juli</option>
                                                    <option value="08">Agustus</option>
                                                    <option value="09">September</option>
                                                    <option value="10">Oktober</option>
                                                    <option value="11">November</option>
                                                    <option value="11">Desember</option>
                                                </select>
                                                -->

                                            <!-- <input type="submit" class="btn btn-sm btn-primary mt-3" value="Export Excel"> -->
                                        
                                    </div>
                                </div>
                                <div class="col-2 align-self-center">
                                    <div class="float-right">
                                            @csrf

                                            <input type="submit" class="btn btn-sm btn-success" value="Export Excel">  
                                            </form>              
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-7 align-self-center">
                                    <table>
                                        <tr>
                                            
                                                
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                			
                            
                			<hr class="mb-4">              	
		                    <table id="data_table" class="table data_table">
                                <a href=""></a>
		                        <thead class="bg-primary text-white">
		                            <tr>
		                                <th scope="col" width="65px">No</th>
		                                <th scope="col">Nama</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Debit</th>
                                        <th scope="col">Kredit</th>
		                                <th scope="col" width="130px">Total</th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                        		@foreach ($data_tabungan as $item)
		                        			<tr>
		                        				<td width="65px" scope="row">{{$loop->iteration}}</td>
		                        				<td>
                                                   {{ $item->siswa->nama_siswa }}
		                        					
		                        				</td>
		                        				<td>
		                        					{{ $item->siswa->kelas->kelas }}                  					
		                        				</td>
                                                <td>
                                                    @currency($item->total_debit)
                                                </td>
                                                <td>
                                                    @currency($item->total_kredit)
                                                </td>
                                                <td>
                                                    @currency($item->total_debit - $item->total_kredit)
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
                
@endsection


