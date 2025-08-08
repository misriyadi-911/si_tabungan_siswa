@extends('layout.main')

@section('title')
  Kirim SMS
@endsection

@section('title_halaman')
  Kirim Pesan Ke Wali
@endsection

@section('link_halaman')
  <a href="{{ url('/beranda') }}">Dashboard </a> >> <a href="{{ url('/sms') }}"> Kirim Pesan</a>
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
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="data_table" class="table">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Wali Dari</th>
                                <th scope="col">No HP</th>
                                <th scope="col" width="80px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($data_orangtua as $item)
                                    <tr>
                                        <td scope="row">{{$loop->iteration}}</td>
                                        <td>
                                            <input type="text" name="nama_orangtua" value="{{$item->nama_orangtua}}" disabled="">
                                        </td>
                                        <td>
                                            <input type="text" name="nama_siswa" value="{{$item->siswa->nama_siswa}}" disabled="">
                                        </td>
                                        <td>
                                            <input style="width: 150px" type="text" name="nohp_orangtua" value="{{$item->nohp_orangtua}}" disabled="">
                                        </td>
                                        <td width="80px">
                                            <a href="{{ url('/sendSms') }}/{{$item->id_orangtua}}" class="badge badge-info">
                                                Kirim SMS
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

<!-- Start modal Edit -->
@foreach ($data_orangtua as $ortu)
<div class="modal fade" id="modalEdit-{{$ortu->id_orangtua}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Data Orang Tua</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('/orang_tua/edit') }}" method="POST">
      <div class="modal-body">
         @csrf
          <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <h3 class="card-title mb-0">Data Orang Tua</h3>
                        </div>
                        <hr>
                        @csrf
                            <input type="hidden" name="id_orangtua" value="{{$ortu->id_orangtua}}">                                     
                            <div class="form-group">
                                <label for="nama_orangtua">Nama</label>
                                <input name="nama_orangtua" type="text" class="form-control" id="nama_orangtua" value="{{$ortu->nama_orangtua}}">
                                @error('nama_orangtua')
                                    <p class="text-danger text-sm">*Wajib Diisi</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="alamat_orangtua">Alamat</label>
                                <input name="alamat_orangtua" type="text" class="form-control" id="alamat_orangtua" value="{{$ortu->alamat_orangtua}}">
                                @error('alamat_orangtua')
                                    <p class="text-danger text-sm">*Wajib Diisi</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nohp_orangtua">No HP</label>
                                <input name="nohp_orangtua" type="number" class="form-control" id="nohp_orangtua" value="{{$ortu->nohp_orangtua}}">
                                @error('nohp_orangtua')
                                    <p class="text-danger text-sm">*Wajib Diisi</p>
                                @enderror
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
                window.location.href = "{{ url('/orang_tua') }}"
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