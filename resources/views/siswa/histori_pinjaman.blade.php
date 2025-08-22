@extends('layout.main')

@section('title')
Data Histori Pinjaman Siswa
@endsection

@section('title_halaman')
Data Histori Pinjaman Siswa
@endsection


@section('link_halaman')
<a href="{{ url('/siswa/dashboard') }}">Pinjaman </a> >> <a href="{{ url('/siswa/pinjaman/'. auth()->user()->siswa->id_siswa) }}"> Data Histori Pinjaman</a>
@endsection

@section('user')
	{{auth()->user()->siswa->nama_siswa}}
@endsection 

@section('foto_user')
	{{asset('img')}}/{{auth()->user()->siswa->foto_siswa}}
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
							</tr>
						</thead>
						<tbody>
							@foreach ($data_pinjaman as $item)
							<tr>
								<td scope="row">{{$loop->iteration}}</td>
								<td>{{$item->siswa->nis}}</td>
								<td>{{$item->siswa->nama_siswa}}</td>
								<td>{{ date('d-m-Y', strtotime($item->tgl_pinjam)) }}</td>
								<td>{{$item->nominal_pinjaman}}</td>
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


