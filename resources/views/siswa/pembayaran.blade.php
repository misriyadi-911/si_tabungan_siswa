@extends('layout.main')

@section('title')
  Pembayaran
@endsection

@section('title_halaman')
  Pembayaran
@endsection

@section('link_halaman')
  <a href="{{url('/siswa/dashboard')}}">Dashboard </a> >> <a href="{{url('/siswa/pembayaran')}}"> Pembayaran</a>
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
<!-- basic table -->
<!-- Row -->
    {{-- <div class="row">
        <div class="col-12 mt-4">
            <h2 class="mb-0">Pilih Jenis Pembayaran</h2>
            <p class="text-muted mt-0">Pilih jenis pembayaran di bawah ini untuk melakukan pembayaran</code></p>
        </div>
        <div class="col-md-6">
            <div class="card border-dark text-center">
                <div class="card-header bg-info pt-4 pb-4">
                    <h1 class="mb-0 text-white display-4"><i class="icon-basket-loaded"></i></h1>
                </div>
                <div class="card-body">
                    <h3 class="card-title text-info">HAFLATUL IMTIHAN (HIMA)</h3>
                    <br>
                    <a href="" class="btn btn-info" data-toggle="modal" data-target="#modalHima">Bayar</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-info text-center">
                <div class="card-header bg-dark pt-4 pb-4">
                    <h4 class="mb-0 text-white display-4"><i class="icon-basket-loaded"></i></h4>
                </div>
                <div class="card-body">
                    <h3 class="card-title text-dark">BIAYA KELAS AKHIR</h3>
                    <br>
                    <a href="" class="btn btn-dark" data-toggle="modal" data-target="#modalKelasAkhir">Bayar</a>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="row">
        <div class="col-md-6">
            <div class="card border-dark text-center">
                <div class="card-header bg-danger pt-4 pb-4">
                    <h4 class="mb-0 text-white display-4"><i class="icon-basket-loaded"></i></h4>
                </div>
                <div class="card-body">
                    <h3 class="card-title text-danger">DENDA</h3>
                    <br>
                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#modalDenda">Bayar</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-info text-center">
                <div class="card-header bg-success pt-4 pb-4">
                    <h4 class="mb-0 text-white display-4"><i class="icon-basket-loaded"></i></h4>
                </div>
                <div class="card-body">
                    <h3 class="card-title text-success">REKREASI</h3>
                    <br>
                    <a href="" class="btn btn-success" data-toggle="modal" data-target="#modalRekreasi">Bayar</a>
                </div>
            </div>
        </div>
    </div> --}}
    
    <div class="row">
        <div class="col">
            <div class="card border-dark text-center">
                <div class="card-header bg-danger pt-4 pb-4">
                    <h4 class="mb-0 text-white display-4"><i class="icon-basket-loaded"></i></h4>
                </div>
                <div class="card-body">
                    <h3 class="card-title text-danger">BAYAR CICILAN HUTANG</h3>
                    <br>
                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#modalDenda">Bayar</a>
                </div>
            </div>
        </div>
    </div>
    

<!-- start modal bayar hima -->
<div class="modal fade" id="modalHima" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('/siswa/proses_bayar') }}" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
         @csrf
          <input type="hidden" name="id_siswa" value="{{auth()->user()->id_user}}">
          <input type="hidden" name="id_tapel" value="{{$data_tapel[0]->id_tapel}}">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        <h3 class="card-title mb-0">Masukkan Data Pembayaran</h3>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="jenis_pembayaran">Jenis Pembayaran</label>
                                                <input type="hidden" name="jenis_pembayaran" class="hiddenForm  form-control" value="HAFLATUL IMTIHAN (HIMA)">
                                                <input type="text" class="hiddenForm  form-control" value="HAFLATUL IMTIHAN (HIMA)" disabled="">
                                            </div>
                                            <div class="form-group">
                                                <h5 id="nominal">Nominal</h5>
                                                <input name="nominal" type="number" class="form-control" id="nominal">
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
<!-- end modal bayar Hima -->

<!-- start modal bayar biaya kelas akhir -->
<div class="modal fade" id="modalKelasAkhir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('/siswa/proses_bayar') }}" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
         @csrf
          <input type="hidden" name="id_siswa" value="{{auth()->user()->id_user}}">
          <input type="hidden" name="id_tapel" value="{{$data_tapel[0]->id_tapel}}">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        <h3 class="card-title mb-0">Masukkan Data Pembayaran</h3>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="jenis_pembayaran">Jenis Pembayaran</label>
                                                <input type="hidden" name="jenis_pembayaran" class="hiddenForm  form-control" value="Biaya kelas akhir">
                                                <input type="text" class="hiddenForm  form-control" value="Biaya kelas akhir" disabled="">
                                            </div>
                                            <div class="form-group">
                                                <h5 id="nominal">Nominal</h5>
                                                <input name="nominal" type="number" class="form-control" id="nominal">
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
<!-- end modal biaya kelas akhir -->

<!-- start modal bayar denda -->
<div class="modal fade" id="modalDenda" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
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
                                        <h3 class="card-title mb-0">Masukkan Data Pembayaran</h3>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="jenis_pembayaran">Jenis Pembayaran</label>
                                                <input type="hidden" name="jenis_pembayaran" class="hiddenForm  form-control" value="cicilan">
                                                <input type="text" class="hiddenForm  form-control" value="cicilan" disabled="">
                                            </div>
                                            <div class="form-group">
                                                <h5 id="nominal">Nominal</h5>
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
<!-- end modal denda-->   

<!-- start modal bayar rekreasi -->
<div class="modal fade" id="modalRekreasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
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
                                        <h3 class="card-title mb-0">Masukkan Data Pembayaran</h3>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="jenis_pembayaran">Jenis Pembayaran</label>
                                                <input type="hidden" name="jenis_pembayaran" class="hiddenForm  form-control" value="Rekreasi">
                                                <input type="text" class="hiddenForm  form-control" value="Rekreasi" disabled="">
                                            </div>
                                            <div class="form-group">
                                                <h5 id="nominal">Nominal</h5>
                                                <input name="nominal" type="number" class="form-control" id="nominal">
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
<!-- end modal rekreasi-->                  
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
                window.location.href = "{{ url('/siswa/dashboard') }}"
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


