@extends('layout.main')

@section('title')
  Data Rincian Tabungan
@endsection

@section('title_halaman')
  Data Rincian Tabungan
@endsection


@section('link_halaman')
  <a href="{{ url('/beranda') }}">Dashboard </a> >> <a href="{{ url('/tabungan/tambah') }}"> Rincian Tabungan</a>
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
                            <table>
                				<tr>
                					<td>NIS</td>
                					<td> : </td>
                					<td>{{$data_tabungan[0]->siswa->nis}}</td>
                				</tr>
                				<tr>
                					<td>Nama</td>
                					<td> : </td>
                					<td>{{$data_tabungan[0]->siswa->nama_siswa}}</td>
                				</tr>
                				<tr>
                					<td>Kelas</td>
                					<td> : </td>
                					<td>{{$data_tabungan[0]->siswa->kelas->kelas}}</td>
                				</tr>
                			</table>
                			<hr class="mb-4">	                	
		                    <table id="data_table" class="table data_table">
		                        <thead class="bg-primary text-white">
		                            <tr>
		                                <th scope="col" width="65px">No</th>
		                                <th scope="col">Tanggal Transaksi</th>
		                                <th scope="col">Nominal Debit</th>
		                                <th scope="col">Nominal Kredit</th>
		                                <th scope="col">Aksi</th>
		                            </tr>
		                        </thead>
		                        <tbody>
									
		                        		@foreach ($data_tabungan as $item)
		                        			<tr>
		                        				<td width="65px" scope="row">{{$loop->iteration}}</td>
		                        				<td>
		                        					{{date('d-m-Y', strtotime($item->tgl_transaksi))}}
		                        				</td>
		                        				<td>
		                        					{{$item->nominal_debit}}                   					
		                        				</td>
		                        				<td>
		                        					{{$item->nominal_kredit}}                   					
		                        				</td>
												<td>
													<a href="" class="btn btn-info" data-toggle="modal" data-target="#modalEdit-{{$item->id_transaksi}}">
														<i class="fas fa-edit" ></i>
													</a>
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

<!-- Start modal edit -->
@foreach ($data_tabungan as $data)
<div class="modal fade" id="modalEdit-{{$data->id_transaksi}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ubah Data Tabungan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ url('/tabungan/edit') }}" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
					@csrf
					<input type="hidden" name="level" value="admin">
					<input type="hidden" name="id_transaksi" value="{{$data->id_transaksi}}">
					<input type="hidden" name="id_siswa" value="{{$data->id_siswa}}">
					<input type="hidden" name="id_tapel" value="{{$data_tapel[0]->id_tapel}}">
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<div class="card">
								<div class="card-body">
									<div class="d-flex align-items-start">
										<h3 class="card-title mb-0">Edit Data Tabungan</h3>
									</div>
									<hr>
									<div class="row">
										<div class="col">
											@csrf
											<div class="form-group">
												<label for="nis">NIS</label>
												<input name="nis" type="text" class="form-control" id="nis" disabled="" value="{{$data->siswa->nis}}" readonly>
											</div>
											<div class="form-group">
												<h5 id="nama_siswa">Nama</h5>
												<input name="nama_siswa" type="text" class="form-control" id="nama_siswa" value="{{$data->siswa->nama_siswa}}" readonly>
											</div>
											<div class="form-group">
												<label for="tgl_transaksi">Tanggal Transaksi</label>
												<input name="tgl_transaksi" id="tgl_transaksi" cols="30" rows="5" class="form-control" value="{{$data->tgl_transaksi}}" readonly>
											</div>
											<div class="form-group">
												<label for="nominal_debit">Nominal Debit</label>
												<input name="nominal_debit" type="number" class="form-control" id="nominal_debit" value="{{$data->nominal_debit}}">
											</div>
											<div class="form-group">
												<label for="nominal_kredit">Nominal Kredit</label>
												<input name="nominal_kredit" type="number" class="form-control" id="nominal_kredit" value="{{$data->nominal_kredit}}">
											</div>
										</div>
									</div>	                                
								</div>
							</div>
						</div>

					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<input type="submit" class="btn btn-primary" value="Simpan">

				</div>
			</form>
		</div>
	</div>
</div>
@endforeach
                
@endsection

@section('script')
<script>
$(document).ready(function() {
    // DataTable untuk tabel utama
    if (!$.fn.DataTable.isDataTable('#data_table')) {
        $('#data_table').DataTable({
            responsive: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ entri",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri"
            }
        });
    }

    // Ajax Form Submission
    $(document).on('submit', 'form', function(event) {
        event.preventDefault();
        $.ajax({
            url : $(this).attr('action'),
            type : $(this).attr('method'),
            typeData : "JSON",
            data : new FormData(this),
            processData:false,
            contentType:false,
            success : function(res) {
                window.location.href = "{{ url('/tabungan/rincian') }}/" + res.id_siswa;
                const Toast = Swal.mixin({
                    toast : true,
                    position : 'top-end',
                    showConfirmButton : false,
                    timer : 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
                Toast.fire({
                    icon : 'success',
                    title : res.text
                });
            },
            error : function (xhr) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: xhr.responseJSON.text,
                    showConfirmButton: false,
                    timer: 1500
                });
            } 
        });
    });
});
</script>
@endsection


