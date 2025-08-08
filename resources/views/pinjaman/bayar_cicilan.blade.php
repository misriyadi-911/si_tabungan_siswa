@extends('layout.main')

@section('title')
Data Cicilan
@endsection

@section('title_halaman')
Bayar Cicilan
@endsection


@section('link_halaman')
<a href="{{ url('/beranda') }}">Pinjaman </a> >> <a href="{{ url('/siswa') }}"> Bayar Cicilan</a>
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

<div class="row">
    <div class="col-6">
        <div class="card text-white">
            <div class="card-header bg-dark">
            <h4 class="mb-0 text-white">Total Cicilan</h4>
            </div>

            <div class="card-body">
            <h2 class="card-title text-dark">@currency($total_cicilan)</h2>
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="card text-white">
            <div class="card-header bg-dark">
            <h4 class="mb-0 text-white">Total Pinjaman</h4>
            </div>

            <div class="card-body">
            <h2 class="card-title text-dark">@currency($total_pinjaman)</h2>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card text-white">
            <div class="card-header bg-danger">
            <h4 class="mb-0 text-white">Sisa Pinjaman</h4>
            </div>

            <div class="card-body">
            <h2 class="card-title text-dark">@currency($total_pinjaman - $total_cicilan)</h2>
            </div>
        </div>
    </div>
</div>

<!-- basic table -->
<div class="row">
	<div class="col-12">
		<a href="" class="btn btn-primary btn-sm rounded-pill mb-3 btn_tambah" data-toggle="modal" data-target="#modalCicil">
			<i class="icon-basket-loaded"></i> Bayar Cicilan
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
							</tr>
						</thead>
						<tbody>
							@foreach ($data_cicilan as $item)
							<tr>
								<td scope="row">{{$loop->iteration}}</td>
								<td>{{$item->siswa->nis}}</td>
								<td>{{$item->siswa->nama_siswa}}</td>
								<td>{{$item->tgl_transaksi}}</td>
								<td>{{$item->nominal_kredit}}</td>
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
<div class="modal fade" id="modalCicil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Cicilan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('/siswa/proses_cicilan') }}" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
         @csrf
          <input type="hidden" name="id_siswa" value="{{auth()->user()->id_user}}">
          <input type="hidden" name="id_tapel" value="{{$data_tapel[0]->id_tapel}}">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        <h3 class="card-title mb-0">Masukkan Data Cicilan</h3>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
											<div class="form-group">
                                                <h5 id="tgl_pinjam">Tanggal</h5>
												{{-- <input type="hidden" name="id_tapel" class="form-control mb-3" width="30%" value="{{$data_tapel[0]->id_tapel}}"> --}}
												{{-- <input type="hidden" name="id_siswa" class="form-control mb-3" width="30%" value="{{auth()->user()->siswa->id_siswa}}"> --}}
                                                <input name="tgl_cicilan" type="date" class="form-control" id="tgl_pinjam">
                                            </div>
                                            <div class="form-group">
                                                <h5 id="nominal_kredit">Nominal</h5>
                                                <input name="nominal_kredit" type="number" class="form-control" id="nominal_kredit">
                                            </div>
                                        </div>
                                    </div>                                  
                                </div>
                            </div>
                        </div>
                        
                    </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-tutup" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Simpan">

      </div>
      </form>
    </div>
  </div>
</div>
<!-- End modal tambah -->
	@endsection

	@section('script')
	<script>
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
                console.log(res);
                window.location.href = "{{ url('/siswa/cicilan') }}"
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
                        })
                        Toast.fire({
                            icon : 'success',
                            title : res.text
                        })
                },
                error : function (xhr) {
                    // toastr.error(res.responseJSON.text, 'Gagal');
                    Swal.fire({
                      position: 'top-end',
                      icon: 'error',
                      title: xhr.responseJSON.text,
                      showConfirmButton: false,
                      timer: 1500
                    })
                } 
        })
     });        
</script>
	@endsection


