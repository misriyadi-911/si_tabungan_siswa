<?php
use Illuminate\Support\Facades\Crypt;
?>

@extends('layout.main')

@section('title')
  Data User
@endsection

@section('title_halaman')
  Edit Data User
@endsection

@section('user')
	{{ auth()->user()->orang_tua->nama_orangtua }}
@endsection

	
@section('link_halaman')
  <a href="{{url('/beranda')}}">Dashboard </a> >> Edit Data User
@endsection

@section('content')
    <!-- *************************************************************** -->
                <!-- Start First Cards -->
                <!-- *************************************************************** -->

                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <h3 class="card-title mb-0">Data User</h3>
                                </div>
                                <hr>
                                @if(session('success'))
                                	<div class="alert alert-success" role="alert">
                                		{{ session('success') }}
                                	</div>
                                @endif
                                <form action="{{url('/user/edit/')}}" method="post" enctype="multipart/form-data">
                                @csrf
	                                	<label for="level"></label>
	                                	<input type="hidden" name="id_user" class="form-control" value="{{auth()->user()->id_user}}">
	                                	<input name="level" type="hidden" class="form-control" id="level" value="{{auth()->user()->level}}">
	                                	<input type="hidden" name="id_admin" value="{{$data_user[0]->id_user}}">                          	
	                                <div class="form-group">
	                                	<label for="username">Username</label>
	                                	<input name="username" type="text" class="form-control" id="username" value="{{$data_user[0]->username}}">
	                                </div>
	                                <div class="form-group">
	                                	<label for="old_password">Password Saat Ini</label>
	                                	<input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password">
	                                	@error('old_password')
	                                		<div class="text-danger mt-2">{{$message}}</div>
	                                	@enderror
	                                </div>

	                                <div class="form-group">
	                                	<label for="password">Password</label>
	                                	<input name="password" type="password" class="form-control" id="password">
	                                </div>
	                                @error('password')
	                                		<div class="text-danger mt-2">{{$message}}</div>
	                                @enderror

	                                <div class="form-group">
	                                	<label for="password_confirmation">Password Konfirmasi</label>
	                                	<input name="password_confirmation" type="password" class="form-control" id="password_confirmation">
	                                </div>
	                                
	                                <!-- <div class="form-group">
	                                	<label for="konfirmasi_password">Konfirmasi Password</label>
	                                	<input type="konfirmasi_password" class="form-control" id="konfirmasi_password">
	                                </div> -->

	                                <input type="submit" value="SIMPAN" class="form-control btn btn-primary mt-3" style="width: 15%">
                                </form>             
                            </div>
                        </div>
                    </div>
                    
                </div>


                
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
	 			window.location.href = "{{ url('/user/edit')}}/{{auth()->user()->id_user}}/{{auth()->user()->level }}"
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
