<!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center text-muted">
                Sistem Informasi Tabungan Digital Siswa | {{date('Y')}}
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('Template')}}/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="{{asset('Template')}}/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="{{asset('Template')}}/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="{{asset('Template')}}/dist/js/app-style-switcher.js"></script>
    <script src="{{asset('Template')}}/dist/js/feather.min.js"></script>
    <script src="{{asset('Template')}}/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="{{asset('Template')}}/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('Template')}}/dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="{{asset('Template')}}/assets/extra-libs/c3/d3.min.js"></script>
    <script src="{{asset('Template')}}/assets/extra-libs/c3/c3.min.js"></script>
    <script src="{{asset('Template')}}/assets/libs/chartist/dist/chartist.min.js"></script>
    <!-- <script src="{{asset('Template')}}/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script> -->
    <script src="{{asset('Template')}}/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{asset('Template')}}/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
    <!-- <script src="{{asset('Template')}}/dist/js/pages/dashboards/dashboard1.min.js"></script> -->
    <script src="{{asset('Template')}}/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('Template')}}/dist/js/pages/datatable/datatable-basic.init.js"></script>
     <!--Morris JavaScript -->
    <!-- <script src="{{asset('Template')}}/assets/libs/raphael/raphael.min.js"></script>
    <script src="{{asset('Template')}}/assets/libs/morris.js/morris.min.js"></script>
    <script src="{{asset('Template')}}/dist/js/pages/morris/morris-data.js"></script> -->


    <script src="{{asset('Template')}}/assets/libs/chart.js/dist/Chart.min.js"></script>
    <script src="{{asset('sweetAlert')}}/dist/sweetalert2.all.min.js"></script>
    <!-- <script src="{{asset('sweetAlert')}}/toastr.min.js"></script> -->

    <script>
        $(document).ready( function () {
            $('#data_table').DataTable();
           
        } );

        @if(Session::has('hapus_sukses'))
        const Toast = Swal.mixin({
                            toast : true,
                            position : 'top-end',
                            icon : 'warning',
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
                            title : 'Data Berhasil Dihapus'
                        })
        @endif

        @if(Session::has('ubah_sukses'))
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
        @endif
        @if(Session::has('tambah_sukses'))
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
        @endif
        @if(Session::has('login_gagal'))
        Swal.fire({
                      position: 'top-end',
                      icon: 'error',
                      title: 'Username atau Password salah',
                      showConfirmButton: false,
                      timer: 1500
        })
        @endif

        @if(Session::has('kirim_sukses'))
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
                            title : 'Kirim pesan berhasil'
                        })
        @endif

        
    </script>
    
    @yield('script')
</body>

</html>