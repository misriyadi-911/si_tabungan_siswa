@extends('layout.main')

@section('title')
	Data Tahun Pelajaran
@endsection

@section('title_halaman')
  Data Tahun Pelajaran
@endsection


@section('link_halaman')
  <a href="{{ url('/beranda') }}">Dashboard </a> >> <a href="{{ url('/tapel') }}"> Tahun Pelajaran</a>
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
<div class="row">
    <div class="col-12">
    	<a href="{{ url('/tapel/tambah') }}" class="btn btn-primary btn-sm rounded-pill mb-3 btn_tambah" data-toggle = "modal" data-target = "#modalTambah">
			<i class="fas fa-plus-circle"></i> Tambah Data Tahun Pelajaran
		</a>
    	
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="data_table" class="table">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tahun Pelajaran</th>
                                <th scope="col">Status</th>
                                <th scope="col" width="80px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        		@foreach ($data_tapel as $item)
                        			<tr>
                        				<td scope="row">{{$loop->iteration}}</td>
                        				<td>{{$item->tapel}}</td>
                        				<td>{{$item->status_tapel}}</td>
										<td width="80px">
											<a href="#" class="btn btn-info" data-toggle="modal" data-target="#modalEdit-{{$item->id_tapel}}">
												<i class="fas fa-edit"></i>
											</a>
											<a href="javasript:" class="btn btn-danger hapus_data" rel="{{$item->id_tapel}}">
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

<!-- Start modal tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Tahun Pelajaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('/tapel/tambah') }}" method="POST">
      <div class="modal-body">
        @csrf                                 	
        <div class="form-group">
        	<label for="tapel">Tahun Pelajaran</label>
        	<input name="tapel" type="text" class="form-control" id="tapel">
            @error('tapel')
                <p class="text-danger text-sm">*Wajib Diisi</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="status_tapel">Status</label>
            <select name="status_tapel" id="status" class="form-control">
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
            </select>
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
<!-- End modal tambah -->

<!-- Start modal Edit -->
@foreach ($data_tapel as $tapel)
<div class="modal fade" id="modalEdit-{{$tapel->id_tapel}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Data Tahun Pelajaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('/tapel/edit') }}" method="POST">
      <div class="modal-body">
         @csrf
          <div class="form-group">
            <label for="kelas" class="col-form-label">Tahun Pelajaran</label>
            <input type="hidden" name="id_tapel" class="form-control" id="id_tapel" value="{{$tapel->id_tapel}}">
            <input type="text" name="tapel" class="form-control" id="tapel" value="{{$tapel->tapel}}">
          </div>

          <div class="form-group">
		      <label for="status_tapel">Status</label>
		      <select name="status_tapel" id="status" class="form-control">
		      <option value="{{$tapel->status_tapel}}">{{$tapel->status_tapel}}</option>
		      <option value="" disabled="">-- Pilih Status --</option>
		      <option value="Aktif">Aktif</option>
		      <option value="Tidak Aktif">Tidak Aktif</option>
		      </select>
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
<!-- End modal Edit -->
                
@endsection

@section('script')
<script>
	$(document).ready(function(){
	 	$('.hapus_data').on('click', function(){
            var id = $(this).attr('rel');
            var deleteFuntiom = $(this).attr('rel1');
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
                        window.location.href = "{{ url ('/tapel/hapus') }}"+"/"+id;
                        
                }
            })
            console.log(id);
        });	
	 });

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
        window.location.href = "{{ url('/tapel') }}"
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


