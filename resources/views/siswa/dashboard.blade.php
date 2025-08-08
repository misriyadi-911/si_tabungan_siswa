@extends('layout.main')

@section('title')
  Dashboard Siswa
@endsection

@section('title_halaman')
  Dashboard Siswa
@endsection

@section('link_halaman')
  <a href="/siswa/dashboard">Dashboard Siswa</a>
@endsection

@section('user')
    {{auth()->user()->siswa->nama_siswa}}
@endsection

@section('foto_user')
    {{asset('img')}}/{{auth()->user()->siswa->foto_siswa}}
@endsection

@section('content')
    <!-- *************************************************************** -->
                <!-- Start First Cards -->
                <!-- *************************************************************** -->

                <div class="row">
                  <div class="col-6">
                    <div class="card text-white">
                      <div class="card-header bg-dark">
                        <h4 class="mb-0 text-white">Total Saldo</h4>
                      </div>

                      <div class="card-body">
                        <h2 class="card-title text-dark">@currency($total_th)</h2>
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
                                    <span class="opacity-7 text-muted"><i data-feather="file-plus"></i></span>
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
                                    <span class="opacity-7 text-muted"><i data-feather="globe"></i></span>
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
                                <h4 class="card-title">Grafik Jumlah Debit Tabungan</h4>
                                <div>
                                    <canvas id="line-chart-x" height="150"></canvas>
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
        labels: {!!json_encode($tgl_chart_debit)!!},
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
          }
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