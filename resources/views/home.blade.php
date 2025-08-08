@extends('layout.main')

@section('title')
  Beranda Admin
@endsection

@section('title_halaman')
  Selamat Datang Admin
@endsection

@section('link_halaman')
  Dashboard
@endsection

@section('user')
    {{auth()->user()->admin->nama_admin}}
@endsection 

@section('foto_user')
    {{asset('img')}}/{{auth()->user()->admin->foto_admin}}
@endsection
@section('content')
    <!-- *************************************************************** -->
                <!-- Start First Cards -->
                <!-- *************************************************************** -->
                <div class="card border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h1 class="text-dark mb-1 font-weight-medium font-48">{{$total_siswa}}</h1>
                                    <span
                                        class="badge bg-primary font-12 text-white font-weight-medium badge-pill ml-2 d-lg-block d-md-none">Jumlah Siswa</span>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><a href="{{url('/siswa')}}">Lihat Detail</a></h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <h2 class="opacity-7 text-muted"><i class="icon-user"></i></h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <div class="card text-white">
                      <div class="card-header bg-dark">
                        <h4 class="mb-0 text-white">Total Saldo</h4>
                      </div>

                      <div class="card-body">
                        <h2 class="card-title text-dark">@currency($total_th)</h2>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-group">
                   
                    <div class="card mr-1">
                        <div class="card-body bg-danger">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-white mb-1 font-weight-medium">@currency($total_hr)</h2>
                                    </div>
                                    <h6 class="font-weight-normal mb-0 w-100 text-white">Saldo Hari ini</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <h2 class="opacity-7 text-muted"><i class="fas fa-dollar-sign"></i></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body bg-success">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-white mb-1 font-weight-medium">@currency($total_bln)</h2>
                                    <h6 class="font-weight-normal mb-0 w-100 text-white">Saldo Bulan ini</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <h2 class="opacity-7 text-muted"><i class="fas fa-dollar-sign"></i></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- *************************************************************** -->
                <!-- End First Cards -->
                <!-- *************************************************************** -->
               
                
                <!-- *************************************************************** -->
                <!-- Start Location and Earnings Charts Section -->
                <!-- *************************************************************** -->
                 
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Grafik Saldo Tabungan</h4>
                                <div>
                                    <canvas id="line-chart-x" height="150"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- *************************************************************** -->
                <!-- End Location and Earnings Charts Section -->
                <!-- *************************************************************** -->
                
@endsection

@section('script')
    <script>
        // Dashboard 1 Morris-chart
$(function () {
    "use strict";

//Line Chart

    new Chart(document.getElementById("line-chart-x"), {
      type: 'line',
      data: {
        labels: {!!json_encode($tgl_chart)!!},
        datasets: [{ 
            data: {!!json_encode($nominal_chart_debit)!!},
            label: "Nominal Debit",
            borderColor: "#5f76e8",
            fill: false
            },
            { 
            data: {!!json_encode($nominal_chart_kredit)!!},
            label: "Nominal Kredit",
            borderColor: "rgba(1, 202, 241,1)",
            fill: false
            },        
          ]
      },
      options: {
        title: {
          display: true,
          text: ''
        }
      }
    });

 });    

    </script>
@endsection