@extends('layout.main')

@section('title')
Pilih Siswa
@endsection

@section('title_halaman')
Pilih Siswa
@endsection


@section('link_halaman')
<a href="{{ url('/pinjaman') }}">Pinjaman </a> >> <a href="{{ url('/pinjaman/pilih_siswa') }}"> Pilih Siswa</a>
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
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="data_table" class="table data_table">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">NIS</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_siswa as $item)
                            <tr>
                                <td scope="row">{{$loop->iteration}}</td>
                                <td>{{$item->nis}}</td>
                                <td>{{$item->nama_siswa}}</td>
                                <td>
                                    <a href="" class="btn btn-success" data-toggle="modal" data-target="#modalPinjam-{{ $item->id_siswa }}">
                                        <i class="fas fa-check-circle"></i>
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


<!-- Start modal tambah -->
@foreach($data_siswa as $siswa)
<div class="modal fade" id="modalPinjam-{{$siswa->id_siswa}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Pinjaman</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('/proses_pinjam') }}" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
         @csrf
          <input type="hidden" name="id_siswa" value="{{$siswa->id_siswa}}">
          <input type="hidden" name="id_tapel" value="{{$data_tapel[0]->id_tapel}}">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        <h3 class="card-title mb-0">Masukkan Data Pinjaman</h3>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
											<div class="form-group">
                                                <h5 id="tgl_pinjam">Tanggal Pinjam</h5>
												{{-- <input type="hidden" name="id_tapel" class="form-control mb-3" width="30%" value="{{$data_tapel[0]->id_tapel}}"> --}}
												{{-- <input type="hidden" name="id_siswa" class="form-control mb-3" width="30%" value="{{auth()->user()->siswa->id_siswa}}"> --}}
                                                <input name="tgl_pinjam" type="date" class="form-control" id="tgl_pinjam">
                                            </div>
                                            <div class="form-group">
                                                <h5 id="nominal_pinjaman">Nominal Pinjaman</h5>
                                                <input name="nominal_pinjaman" type="number" class="form-control" id="nominal_pinjaman">
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
@endforeach
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
                window.location.href = "{{ url('/pinjaman') }}"
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


