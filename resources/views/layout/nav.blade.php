<?php  

    use App\Models\Notifikasi;

?>

<header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand">
                        <!-- Logo icon -->
                        @if(auth()->user()->level == 'orang tua')
                        <a href="{{url('/orang_tua/dashboard')}}">
                            <b class="logo-icon">
                                <!-- Dark Logo icon -->
                                <img src="{{asset('Template')}}/assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                                <!-- Light Logo icon -->
                                <img src="{{asset('Template')}}/assets/images/logo-icon.png" alt="homepage" class="light-logo" />
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text -->
                            <span class="logo-text">
                                <!-- dark Logo text -->
                                <img src="{{asset('Template')}}/assets/images/icon-text.png" alt="homepage" class="dark-logo" />
                                <!-- Light Logo text -->
                                <img src="{{asset('Template')}}/assets/images/icon-text-putih.png" class="light-logo" alt="homepage" />
                            </span>
                        </a>
                        @endif

                        @if(auth()->user()->level == 'siswa')
                        <a href="{{url('/siswa/dashboard')}}">
                            <b class="logo-icon">
                                <!-- Dark Logo icon -->
                                <img src="{{asset('Template')}}/assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                                <!-- Light Logo icon -->
                                <img src="{{asset('Template')}}/assets/images/logo-icon.png" alt="homepage" class="light-logo" />
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text -->
                            <span class="logo-text">
                                <!-- dark Logo text -->
                                <img src="{{asset('Template')}}/assets/images/icon-text.png" alt="homepage" class="dark-logo" />
                                <!-- Light Logo text -->
                                <img src="{{asset('Template')}}/assets/images/icon-text-putih.png" class="light-logo" alt="homepage" />
                            </span>
                        </a>
                        @endif
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    @if(auth()->user()->level == 'siswa')
      
                    <ul class="navbar-nav float-left ml-auto ml-3 pl-1">
                        <!-- Notification -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle pl-md-3 position-relative" href="javascript:void(0)"
                                id="bell" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <span><i data-feather="bell" class="svg-icon"></i></span>
                                <span class="badge badge-primary notify-no rounded-circle">
                                    <?php 

                                        $dt_notifikasi = Notifikasi::where('status_notifikasi', 'belum terbaca')
                                        ->where('id_siswa', auth()->user()->id_user)
                                        ->get();
                                        echo count($dt_notifikasi);                                        

                                    ?>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="message-center notifications position-relative">
                                            <!-- Message -->
                                            <?php 
                                                $dt_notifikasi = Notifikasi::where('status_notifikasi', 'belum terbaca')
                                                ->where('id_siswa', auth()->user()->id_user)
                                                ->get(); 
                                                foreach ($dt_notifikasi as $item) {
                                                
                                                ?>
                                            <!-- Message -->
                                            <a href="javascript:void(0)"
                                                class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <div class="btn btn-primary rounded-circle btn-circle"><i class="text-white icon-bell"></i></div>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h6 class="message-title mb-0 mt-1">Pembayaran {{$item->transaksi->keterangan}}</h6>
                                                    <span class="font-12 text-nowrap d-block text-muted">
                                                        Pembayaran {{$item->transaksi->keterangan}} sebesar <b> Rp. {{number_format($item->transaksi->nominal_kredit, 0, ',', '.')}} berhasil</b>
                                                    </span>
                                                    
                                                    <span class="font-12 text-nowrap d-block text-muted">
                                                        {{date('d-m-Y', strtotime($item->transaksi->tgl_transaksi))}}
                                                    </span>
                                                </div>
                                            </a>
                                            
                                        <?php } ?>
                                        </div>
                                    </li>
                                    <li>
                                        @if(count($dt_notifikasi) != 0)
                                        <a class="nav-link pt-3 text-center text-dark" href="{{ url('/notifikasi/sudah-terbaca/'.$dt_notifikasi[0]->id_siswa) }}">

                                            <strong>Tandai semua sudah dibaca</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                        @endif
                                        @if(count($dt_notifikasi) == 0)
                                        <div class="w-75 d-inline-block v-middle pl-2">
                                            <span class="font-12 text-nowrap d-block text-muted">
                                                Tidak Ada Notifikasi
                                            </span>
                                            
                                        </div>
                                        @endif
                                            
                                        
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- End Notification -->
                        <!-- ============================================================== -->
                        
                    </ul>
                     @endif

                     @if(auth()->user()->level == 'orang tua')
      
                    <ul class="navbar-nav float-left ml-auto ml-3 pl-1">
                        <!-- Notification -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle pl-md-3 position-relative" href="javascript:void(0)"
                                id="bell" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <span><i data-feather="bell" class="svg-icon"></i></span>
                                <span class="badge badge-primary notify-no rounded-circle">
                                    <?php 

                                        $dt_notifikasi = Notifikasi::where('status_notifikasi', 'belum terbaca')
                                        ->where('id_siswa', auth()->user()->id_user)
                                        ->get();
                                        echo count($dt_notifikasi);                                        

                                    ?>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="message-center notifications position-relative">
                                            <!-- Message -->
                                            <?php 
                                                $dt_notifikasi = Notifikasi::where('status_notifikasi', 'belum terbaca')
                                                ->where('id_siswa', auth()->user()->id_user)
                                                ->get(); 
                                                foreach ($dt_notifikasi as $item) {
                                                
                                                ?>
                                            <!-- Message -->
                                            <a href="javascript:void(0)"
                                                class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <div class="btn btn-primary rounded-circle btn-circle"><i class="text-white icon-bell"></i></div>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h6 class="message-title mb-0 mt-1">Pembayaran {{$item->transaksi->keterangan}}</h6>
                                                    <span class="font-12 text-nowrap d-block text-muted">
                                                        Pembayaran {{$item->transaksi->keterangan}} oleh <b>    {{$item->siswa->nama_siswa}} </b> sebesar <b> Rp. {{number_format($item->transaksi->nominal_kredit, 0, ',', '.')}}</b>
                                                    </span>
                                                    
                                                    <span class="font-12 text-nowrap d-block text-muted">
                                                        {{date('d-m-Y', strtotime($item->transaksi->tgl_transaksi))}}
                                                    </span>
                                                </div>
                                            </a>
                                            
                                        <?php } ?>
                                        </div>
                                    </li>
                                    <li>
                                        @if(count($dt_notifikasi))
                                        <a class="nav-link pt-3 text-center text-dark" href="{{ url('/notifikasi/sudah-terbaca-orang_tua/'.$dt_notifikasi[0]->id_siswa) }}">

                                            <strong>Tandai semua sudah dibaca</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                        @endif
                                        @if(count($dt_notifikasi) == 0)
                                        <div class="w-75 d-inline-block v-middle pl-2">
                                            <span class="font-12 text-nowrap d-block text-muted">
                                                Tidak Ada Notifikasi
                                            </span>
                                            
                                        </div>
                                        @endif
                                            
                                        
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- End Notification -->
                        <!-- ============================================================== -->
                        
                    </ul>
                     @endif
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                @if(auth()->user()->level == 'admin' || auth()->user()->level == 'siswa')
                                <img src="@yield('foto_user')" alt="admin" class="rounded-circle"
                                    width="40">
                                @endif
                                <span class="ml-2 d-none d-lg-inline-block"><span>Halo, </span> <span
                                        class="text-dark">@yield('user')</span> <i data-feather="chevron-down"
                                        class="svg-icon"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                @if(auth()->user()->level == 'siswa')
                                <a class="dropdown-item" href="{{url('/user/edit_siswa')}}/{{auth()->user()->id_user}}/{{auth()->user()->level}}"><i data-feather="user"
                                        class="svg-icon mr-2 ml-1"></i>
                                    Edit Akun
                                </a>
                                @endif

                                @if(auth()->user()->level == 'orang tua')
                                <a class="dropdown-item" href="{{url('/user/edit')}}/{{auth()->user()->id_user}}/{{auth()->user()->level}}"><i data-feather="user"
                                        class="svg-icon mr-2 ml-1"></i>
                                    Edit Akun
                                </a>
                                @endif

                                @if(auth()->user()->level == 'admin')
                                <a class="dropdown-item" href="{{url('/user/edit_a')}}/{{auth()->user()->id_user}}/{{auth()->user()->level}}"><i data-feather="user"
                                        class="svg-icon mr-2 ml-1"></i>
                                    Edit Akun
                                </a>
                                @endif                                 <!-- <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="/logout"><i data-feather="power"
                                        class="svg-icon mr-2 ml-1"></i>
                                    Logout</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->