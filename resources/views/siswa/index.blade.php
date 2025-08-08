@extends('layout.main')

@section('title')
Data Siswa
@endsection

@section('title_halaman')
Data Siswa
@endsection


@section('link_halaman')
<a href="{{ url('/beranda') }}">Dashboard </a> >> <a href="{{ url('/siswa') }}"> Siswa</a>
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
		<a href="#" class="btn btn-primary btn-sm rounded-pill mb-3"
			data-toggle="modal" data-target="#modalTambah"
			id="btnTambahSiswa">
			<i class="fas fa-plus-circle"></i> Tambah Data Siswa
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
								<th scope="col">Kelas</th>
								<th scope="col">Alamat</th>
								<th scope="col">Jenis Kelamin</th>
								<th scope="col">No HP</th>
								<th scope="col" width="150px">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($data_siswa as $item)
							<tr>
								<td scope="row">{{$loop->iteration}}</td>
								<td>{{$item->nis}}</td>
								<td>{{$item->nama_siswa}}</td>
								<td>{{$item->kelas->kelas}}</td>
								<td>{{$item->alamat_siswa}}</td>
								<td>{{$item->jenis_kelamin_siswa}}</td>
								<td>{{$item->nohp_siswa}}</td>
								<td width="150px" class="text-center">
									<a href="" class="btn btn-success" data-toggle="modal" data-target="#modalDetail-{{$item->id_siswa}}">
										<i class="fas fa-eye"></i>
									</a>			

									<a href="" class="btn btn-info" data-toggle="modal" data-target="#modalEdit-{{$item->id_siswa}}">
										<i class="fas fa-edit" ></i>
									</a>

									<a href="javascript:" class="btn btn-danger hapus_data" rel="{{$item->id_siswa}}">
										<i class="fas fa-trash"></i>
									</a>
									{{-- <a href="javascript:" class="btn btn-danger luluskan mt-3" rel="{{$item->id_siswa}}">
										<div class="badge">Luluskan Siswa</div>
									</a> --}}
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
				<h5 class="modal-title" id="btnTambahSiswa">Tambah Data Siswa</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ url('/siswa/tambah') }}" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
					@csrf
					<input type="hidden" name="level" value="siswa">
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<div class="card">
								<div class="card-body">
									<div class="d-flex align-items-start">
										<h3 class="card-title mb-0">Data Siswa</h3>
									</div>
									<hr>
									<div class="row">
										<div class="col-md-6">
											@csrf
											<div class="form-group">
												<label for="nis">NIS</label>
												<input name="nis" type="text" class="form-control @error('nis') is-invalid @enderror" id="nis">
												@error('nis')
												<p class="text-danger text-sm">{{ $message }}</p>
												@enderror
											</div>
											<div class="form-group">
												<h5 id="nama_siswa">Nama</h5>
												<input name="nama_siswa" type="text" class="form-control" id="nama_siswa">
											</div>
											<div class="form-group">
												<label for="alamat_siswa">Alamat</label>
												<input name="alamat_siswa" id="alamat_siswa" cols="30" rows="5" class="form-control"></input>
											</div>
											<div class="form-group">
												<label for="nohp_siswa">No HP</label>
												<input name="nohp_siswa" type="text" class="form-control" id="nohp_siswa">
											</div>

											<div class="form-group">
												<label for="jenis_kelamin_siswa">Jenis Kelamin</label>
												<select name="jenis_kelamin_siswa" id="jenis_kelamin_siswa" class="form-control">
													<option value="Laki-laki">Laki-laki</option>
													<option value="Perempuan">Perempuan</option>
												</select>
											</div>
										</div>

										<div class="col-md-6">                           

											<div class="form-group">
												<label for="kelas">Kelas</label>
												<select name="kelas" id="select_kelas_tambah" class="form-control">
													@foreach($data_kelas as $kelas)
														<option value="{{$kelas->id_kelas}}">{{$kelas->kelas}}</option>
													@endforeach
												</select>
											</div>
											<div class="form-group">
												<label for="foto_siswa">Foto</label>
												<input name="foto_siswa" type="file" name="foto_siswa" class="form-control" id="foto_siswa">
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
									</div>	                                
								</div>
							</div>
						</div>

					</div>

					<div class="row">
						<div class="col-md-12 col-lg-12">
							<div class="card">
								<div class="card-body">
									<div class="d-flex align-items-start">
										<h3 class="card-title mb-0">Data Orang Tua</h3>
									</div>
									<hr>
									<div class="form-group">
										<label for="nama_orangtua">Nama Orang Tua/Wali</label>
										<input name="nama_orangtua" type="text" class="form-control" id="nama_orangtua">
									</div>
									<div class="form-group">
										<label for="alamat_orangtua">Alamat</label>
										<input name="alamat_orangtua" type="text" class="form-control" id="alamat_orangtua">
									</div>
									<div class="form-group">
										<label for="nohp_orangtua">No HP</label>
										<input name="nohp_orangtua" type="number" class="form-control" id="nohp_orangtua">
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

<!-- Start modal Detail -->
@foreach ($data_siswa as $siswa)
<div class="modal fade" id="modalDetail-{{$siswa->id_siswa}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Detail Data Siswa</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="card">
					<div class="row">
						<div class="col-md-4">
							<img class="card-img-top img-fluid" src="{{asset('img')}}/{{$siswa->foto_siswa}}"
							alt="Card image cap" style="width: : 80%">
						</div>
						<hr>
						<div class="col-md-8">
							<div class="row">
								<div class="col-6">Nama Siswa</div>
								<div class="col-6">: {{$siswa->nama_siswa}}</div>
							</div>
							<div class="row">
								<div class="col-6">NIS</div>
								<div class="col-6">: {{$siswa->nis}}</div>
							</div>
							<div class="row">
								<div class="col-6">Alamat</div>
								<div class="col-6">: {{$siswa->alamat_siswa}}</div>
							</div>
							<div class="row">
								<div class="col-6">No HP</div>
								<div class="col-6">: {{$siswa->nohp_siswa}}</div>
							</div>
							<div class="row">
								<div class="col-6">Jenis Kelamin</div>
								<div class="col-6">: {{$siswa->jenis_kelamin_siswa}}</div>
							</div>
							<div class="row">
								<div class="col-6">Kelas</div>
								<div class="col-6">: {{$siswa->kelas->kelas}}</div>
							</div>
							<div class="row">
								<div class="col-6">No Rekening</div>
								<div class="col-6">: {{$siswa->no_rekening}}</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-6">Nama Orang Tua</div>
								<div class="col-6">: {{$siswa->orang_tua->nama_orangtua}}</div>
							</div>
							<div class="row">
								<div class="col-6">Alamat Orang Tua</div>
								<div class="col-6">: {{$siswa->orang_tua->alamat_orangtua}}</div>
							</div>
							<div class="row">
								<div class="col-6">No HP Orang Tua</div>
								<div class="col-6">: {{$siswa->orang_tua->nohp_orangtua}}</div>
							</div>
						</div>
					</div>
						<!-- <img class="card-img-top img-fluid" src="{{asset('img')}}/{{$siswa->foto_siswa}}" alt="Card image cap" style="width: : 80%">
						<div class="card-body">
							<h4 class="card-title">{{$siswa->nama_siswa}}</h4>
							<hr>
							<p class="card-text">NIS : {{$siswa->nis}}</p>
							<p class="card-text">Alamat : {{$siswa->alamat_siswa}}</p>
							<p class="card-text">No HP : {{$siswa->nohp_siswa}}</p>
							<p class="card-text">Jenis Kelamin : {{$siswa->jenis_kelamin_siswa}}</p>
							<p class="card-text">Kelas : {{$siswa->kelas->kelas}}</p>
							<p class="card-text">No Rekening : {{$siswa->no_rekening}}</p>
							<hr>
							<p class="card-text">Nama Orang Tua : {{$siswa->orang_tua->nama_orangtua}}</p>
							<p class="card-text">Alamat Orang Tua : {{$siswa->orang_tua->alamat_orangtua}}</p>
							<p class="card-text">No HP Orang Tua : {{$siswa->orang_tua->nohp_orangtua}}</p>
						</div> -->
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	@endforeach
	<!-- End modal Detail -->

<!-- Start modal Edit -->
@foreach ($data_siswa as $siswa)
<div class="modal fade" id="modalEdit-{{$siswa->id_siswa}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ubah Data Siswa</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ url('/siswa/edit') }}" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
					@csrf
					<input type="hidden" name="level" value="siswa">
					<input type="hidden" name="id_siswa" value="{{$siswa->id_siswa}}">
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<div class="card">
								<div class="card-body">
									<div class="d-flex align-items-start">
										<h3 class="card-title mb-0">Edit Data Siswa</h3>
									</div>
									<hr>
									<div class="row">
										<div class="col-md-6">
											@csrf
											<div class="form-group">
												<label for="nis">NIS</label>
												<input name="nis" type="text" class="form-control" id="nis" disabled="" value="{{$siswa->nis}}">
											</div>
											<div class="form-group">
												<h5 id="nama_siswa">Nama</h5>
												<input name="nama_siswa" type="text" class="form-control" id="nama_siswa" value="{{$siswa->nama_siswa}}">
											</div>
											<div class="form-group">
												<label for="alamat_siswa">Alamat</label>
												<input name="alamat_siswa" id="alamat_siswa" cols="30" rows="5" class="form-control" value="{{$siswa->alamat_siswa}}"></input>
											</div>
											<div class="form-group">
												<label for="nohp_siswa">No HP</label>
												<input name="nohp_siswa" type="text" class="form-control" id="nohp_siswa" value="{{$siswa->nohp_siswa}}">
											</div>
										</div>

										<div class="col-md-6">

											<div class="form-group">
												<label for="jenis_kelamin_siswa">Jenis Kelamin</label>
												<select name="jenis_kelamin_siswa" id="jenis_kelamin_siswa" class="form-control">
													<option value="{{$siswa->jenis_kelamin_siswa}}">{{$siswa->jenis_kelamin_siswa}}</option>
													<option value="" disabled="">-- Pilih Jenis Kelamin --</option>
													<option value="Laki-laki">Laki-laki</option>
													<option value="Perempuan">Perempuan</option>
												</select>
											</div>
											<div class="form-group">
												<label for="kelas">Kelas</label>	
													<select name="kelas" id="select_kelas_edit-{{$siswa->id_siswa}}" class="form-control">
														@foreach($data_kelas as $kelas)
															<option value="{{$kelas->id_kelas}}">{{$kelas->kelas}}</option>
														@endforeach
													</select>
											</div>
											<div class="form-group">
												<label for="foto_siswa">Foto</label>
												<img src="{{asset('img')}}/{{$siswa->foto_siswa}}" width="50%">
												<input type="hidden" name="foto_lama" value="{{$siswa->foto_siswa}}">
												<input name="foto_siswa" type="file" class="form-control" id="foto_siswa" value="{{$siswa->foto_siswa}}" >
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
	<!-- End modal Edit -->

	@endsection

	@section('script')
	<script>

		$(document).ready(function () {
			// Ambil id_kelas dari segment URL
			const urlSegment = window.location.pathname.split('/');
			const id_kelas_from_url = urlSegment[2]; // /siswa/1 → index 2 = 1

			// Saat tombol tambah diklik, isi select kelas-nya
			$('#btnTambahSiswa').on('click', function () {
				if (id_kelas_from_url) {
					$('#select_kelas_tambah').val(id_kelas_from_url);
				}
			});
		});

		@foreach ($data_siswa as $siswa)
			$('#modalEdit-{{$siswa->id_siswa}}').on('shown.bs.modal', function () {
				// Ambil ID kelas dari data siswa
				var id_kelas_siswa = "{{ $siswa->kelas->id_kelas }}";

				// Set nilai select sesuai id_kelas
				$('#select_kelas_edit-{{$siswa->id_siswa}}').val(id_kelas_siswa);
			});
		@endforeach


		$(document).ready(function(){
		// Swal.fire({
		//   position: 'top-end',
		//   icon: 'error',
		//   title: 'Your work has been saved',
		//   showConfirmButton: false,
		//   timer: 1500
		// })
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
					window.location.href = "{{ url ('/siswa/hapus') }}"+"/"+id;

				}
			})
			console.log(id);
		});

		$('.luluskan').on('click', function(){
			var id = $(this).attr('rel');
			Swal.fire({
				title : 'Luluskan Siswa',
				text : 'Apakah kamu yakin ingin meluluskan siswa ? Siswa yang diluluskan akan terhapus dari data siswa',
				icon : 'warning',
				showCancelButton : true,
				confirmButtonColor : '#d33',
				cancelButtonColor : '#3085d6',
				confirmButtonText : 'Luluskan'
			}).then((result) => {

				if(result.isConfirmed){
					window.location.href = "{{ url ('/siswa/hapus') }}"+"/"+id;

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
					window.location.href = "{{ url('/siswa') }}"
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


