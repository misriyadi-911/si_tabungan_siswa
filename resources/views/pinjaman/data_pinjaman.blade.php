@extends('layout.main')

@section('title')
Data Pinjaman
@endsection

@section('title_halaman')
Data Pinjaman
@endsection


@section('link_halaman')
<a href="{{ url('/beranda') }}">Pinjaman </a> >> <a href="{{ url('/siswa') }}"> Data Pinjaman</a>
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
								<th scope="col">Total Pinjaman</th>
								<th scope="col">Total Cicilan</th>
								<th scope="col">Sisa Pinjaman</th>
								<th scope="col">Hibah</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($data_rekap as $item)
							<tr>
								<td scope="row">{{$loop->iteration}}</td>
								<td>{{$item->siswa->nis}}</td>
								<td>{{$item->siswa->nama_siswa}}</td>
								<td>@currency($item->total_pinjaman)</td>
								<td>@currency($data_cicilan[$item->id_siswa]->total_cicilan ?? 0)</td>
								<td>@currency($item->sisa_pinjaman)</td>
								<td>@currency($item->total_hibah)</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Start modal tambah -->
{{--  --}}
<!-- End modal tambah -->
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

    $('#modalPinjam').on('shown.bs.modal', function () {
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
                window.location.href = "{{ url('/siswa/pinjaman') }}"
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


