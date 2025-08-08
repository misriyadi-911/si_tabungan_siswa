@extends('layout.main')

@section('title')
  Data Admin
@endsection

@section('title_halaman')
  Data Admin
@endsection


@section('link_halaman')
  <a href="{{ url('/beranda') }}">Dashboard </a> >> <a href="{{ url('/admin') }}"> Admin</a>
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
		<a href="#" class="btn btn-primary btn-sm rounded-pill mb-3 btn_tambah" data-toggle="modal" data-target="#modalTambah">
			<i class="fas fa-plus-circle"></i> Tambah Data Admin
		</a>	        
		<div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="data_table" class="table">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">No HP</th>
                                <th scope="col" width="80px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        		@foreach ($data_admin as $item)
                        			<tr>
                        				<td scope="row">{{$loop->iteration}}</td>
                        				<td><img style="width: 50px" src="{{asset('img')}}/{{$item->foto_admin}}" alt=""></td>
                        				<td>{{$item->nama_admin}}</td>
                        				<td>{{$item->alamat_admin}}</td>
                        				<td>{{$item->nohp_admin}}</td>
                        				<td width="80px">	
											<a href="#" class="btn btn-info" data-toggle="modal" data-target="#modalEdit-{{$item->id_admin}}">
												<i class="fas fa-edit"></i>
											</a>
											<a href="javascript:" class="btn btn-danger hapus_data" rel="{{$item->id_admin}}">
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('admin/tambah') }}" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
        @csrf                                 	
        <input name="level" type="hidden" class="form-control" id="level" value="admin">                          	
        <div class="form-group">
        	<label for="nama_admin">Nama</label>
        	<input name="nama_admin" type="text" class="form-control" id="nama_admin">
        </div>
        <div class="form-group">
        	<label for="alamat_admin">Alamat</label>
        	<input name="alamat_admin" type="text" class="form-control" id="alamat_admin">
        </div>
        <div class="form-group">
        	<label for="nohp_admin">No HP</label>
        	<input name="nohp_admin" type="number" class="form-control" id="nohp_admin">
        </div>
        <div class="form-group">
        	<label for="foto_admin">Foto</label>
        	<input name="foto_admin" type="file" id="foto_admin">
        </div>
        <div class="form-group">
        	<label for="username">Username</label>
        	<input name="username" type="text" class="form-control" id="username">
        </div>
        <div class="form-group">
        	<label for="password">Password</label>
        	<input name="password" type="password" class="form-control" id="password">
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
@foreach ($data_admin as $admin)
<div class="modal fade" id="modalEdit-{{$admin->id_admin}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Data Tahun Pelajaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('/admin/edit') }}" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
         @csrf
         <label for="level"></label>
    	<input name="level" type="hidden" class="form-control" id="level" value="admin">
    	<input type="hidden" name="id_admin" value="{{$admin->id_admin}}">                          	
	    <div class="form-group">
	    	<label for="nama_admin">Nama</label>
	    	<input name="nama_admin" type="text" class="form-control" id="nama_admin" value="{{$admin->nama_admin}}">
	    </div>
	    <div class="form-group">
	    	<label for="alamat_admin">Alamat</label>
	    	<input name="alamat_admin" type="text" class="form-control" id="alamat_admin" value="{{$admin->alamat_admin}}">
	    </div>
	    <div class="form-group">
	    	<label for="nohp_admin">No HP</label>
	    	<input name="nohp_admin" type="number" class="form-control" id="nohp_admin" value="{{$admin->nohp_admin}}">
	    </div>
	    <div class="form-group">
	    	<label for="foto_admin">Foto</label>
	    	<img src="{{asset('img')}}/{{$admin->foto_admin}}" width="50%">
	        <input type="hidden" name="foto_lama" value="{{$admin->foto_admin}}">
	    	<input name="foto_admin" type="file" id="foto_admin" value="{{$admin->foto_admin}}">
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
                        window.location.href = "{{ url ('/admin/hapus') }}"+"/"+id;
                        
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
	 			window.location.href = "{{ url('/admin') }}"
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
