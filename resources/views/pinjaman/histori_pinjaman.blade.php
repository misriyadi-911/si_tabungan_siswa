@extends('layout.main')

@section('title')
Data Histori Pinjaman
@endsection

@section('title_halaman')
Data Histori Pinjaman
@endsection


@section('link_halaman')
<a href="{{ url('/beranda') }}">Pinjaman </a> >> <a href="{{ url('/pinjaman/histori') }}"> Data Histori Pinjaman</a>
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

{{-- <div class="row">
    <div class="col-12">
    <div class="card text-white">
        <div class="card-header bg-dark">
        <h4 class="mb-0 text-white">Total Pinjaman</h4>
        </div>

        <div class="card-body">
        <h2 class="card-title text-dark">@currency($total_pinjaman)</h2>
        </div>
    </div>
    </div>
</div> --}}

<!-- basic table -->
<div class="row">
	<div class="col-12">
		<a href="/pinjaman/pilih_siswa" class="btn btn-primary btn-sm rounded-pill mb-3 btn_tambah" data-toggle="" data-target="">
			<i class="fas fa-plus-circle"></i> Tambah Data Pinjaman
		</a>
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="data_table" class="table data_table">
						<thead class="bg-primary text-white">
							<tr>
								<th scope="col">No</th>
								<th scope="col">NIS</th>
								<th scope="col">Nama</th>
								<th scope="col">Tanggal Pinjam</th>
								<th scope="col">Nominal Pinjam</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($data_histori as $item)
							<tr>
								<td scope="row">{{$loop->iteration}}</td>
								<td>{{$item->siswa->nis}}</td>
								<td>{{$item->siswa->nama_siswa}}</td>
								<td>{{ date('d-m-Y', strtotime($item->tgl_pinjam)) }}</td>
								<td>{{$item->nominal_pinjaman}}</td>
                                <td>
                                    <a href="" class="btn btn-info" data-toggle="modal" data-target="#modalEdit-{{$item->id_pinjaman}}">
										<i class="fas fa-edit" ></i>
									</a>

									<a href="javascript:" class="btn btn-danger hapus_data" rel="{{$item->id_pinjaman}}">
										<i class="fas fa-trash"></i>
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


<!-- Start modal edit -->
@foreach ($data_histori as $data)
<div class="modal fade" id="modalEdit-{{$data->id_pinjaman}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ubah Data Pinjaman</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ url('/pinjaman/edit') }}" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
					@csrf
					<input type="hidden" name="level" value="siswa">
					<input type="hidden" name="id_siswa" value="{{$data->id_pinjaman}}">
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<div class="card">
								<div class="card-body">
									<div class="d-flex align-items-start">
										<h3 class="card-title mb-0">Edit Data Pinjaman</h3>
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
												<label for="tgl_pinjam">Tanggal Pinjam</label>
												<input name="tgl_pinjam" id="tgl_pinjam" cols="30" rows="5" class="form-control" value="{{$data->tgl_pinjam}}" readonly>
											</div>
											<div class="form-group">
												<label for="nominal_pinjaman">Nominal</label>
												<input name="nominal_pinjaman" type="number" class="form-control" id="nominal_pinjaman" value="{{$data->nominal_pinjaman}}">
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

    $('#modalEdit').on('shown.bs.modal', function () {
        if (!$.fn.DataTable.isDataTable('#data_table_modal')) {
            $('#data_table_modal').DataTable({
                responsive: true,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ entri",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri"
                }
            });
        }
    });

    $('.hapus_data').on('click', function(){
        var id = $(this).attr('rel');
        Swal.fire({
            title : 'Hapus Data',
            text : 'Apakah kamu yakin ingin menghapus data ?',
            icon : 'warning',
            showCancelButton : true,
            confirmButtonColor : '#d33',
            cancelButtonColor : '#3085d6',
            confirmButtonText : 'Hapus'
        }).then((result) => {

            if(result.isConfirmed){
                window.location.href = "{{ url ('/pinjaman/hapus') }}"+"/"+id;

            }
        })
        console.log(id);
    });

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
                window.location.href = "{{ url('/pinjaman/histori') }}"
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


