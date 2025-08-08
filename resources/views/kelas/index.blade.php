
@extends('layout.main')

@section('title')
	Data Kelas
@endsection

@section('title_halaman')
  Data Kelas
@endsection

@section('link_halaman')
  <a href="{{ url('/beranda') }}">Dashboard </a> >> <a href="{{ url('/kelas') }}"> Kelas</a>
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
    	<a href="" class="btn btn-primary btn-sm rounded-pill mb-3 btn_tambah" data-toggle="modal" data-target="#modalTambah">
			<i class="fas fa-plus-circle"></i> Tambah Data Kelas
		</a>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="data_table" class="table">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col" style="width: 50%">Kelas</th>
                                <th scope="col" width="80px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        		@foreach ($data_kelas as $item)
                        			<tr>
                        				<td scope="row">{{$loop->iteration}}</td>
                        				<td style="width: 50%">{{$item->kelas}}</td>
                        				<td width="80px">
											<a href="#" class="btn btn-info" data-toggle="modal" data-target="#modalEdit-{{$item->id_kelas}}">
												<i class="fas fa-edit"></i>
											</a>
											<form action="javascript:" method="POST" class="d-inline" id="form-hapus">
												@method('delete')
												<button rel="{{$item->id_kelas}}" rel1="delete" href="javascript:" class="btn btn-danger hapus_data">
													<i class="fas fa-trash"></i>
												</button>
											</form>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kelas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('/kelas/tambah') }}" method="POST">
      <div class="modal-body">
         @csrf
          <div class="form-group">
            <label for="kelas" class="col-form-label">Kelas</label>

            <input type="text" name="kelas" class="form-control" id="kelas">
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
@foreach ($data_kelas as $kel)
<div class="modal fade" id="modalEdit-{{$kel->id_kelas}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Data Kelas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('/kelas/edit') }}" method="POST">
      <div class="modal-body">
         @csrf
          <div class="form-group">
            <label for="kelas" class="col-form-label">Kelas</label>
            <input type="hidden" name="id_kelas" class="form-control" id="id_kelas" value="{{$kel->id_kelas}}">
            <input type="text" name="kelas" class="form-control" id="kelas" value="{{$kel->kelas}}">
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
                        window.location.href = "{{url('/kelas/hapus')}}"+"/"+id;
                        
                }
            })
            console.log(id);
        });	
	 });

	 $('#modalTambah').on('submit', 'form', function(event) {
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
	 			window.location.href = "{{ url('/kelas') }}"
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
                            title : 'Data Berhasil Ditambahkan'
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

   	 $('#modalEdit-{{$kel->id_kelas}}').on('submit', 'form', function(event) {
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
	 			window.location.href = "{{ url('/kelas') }}"
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
                            title : 'Data Berhasil Diubah'
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

