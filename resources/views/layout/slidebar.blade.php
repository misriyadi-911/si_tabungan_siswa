        <!-- Page wrapper  -->
<!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        @if(auth()->check() && auth()->user()->level == 'admin')
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{url('/beranda')}}"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                    class="hide-menu">Dashboard</span></a>
                        </li>
                        @endif
                        @if(auth()->check() && auth()->user()->level == 'siswa')
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{url('/siswa/dashboard')}}"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                    class="hide-menu">Dashboard</span></a>
                        </li>
                        @endif
                        @if(auth()->check() && auth()->user()->level == 'orang tua')
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{url('/orang_tua/dashboard')}}"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                    class="hide-menu">Dashboard</span></a>
                        </li>
                        @endif
                        
                         @if(auth()->check() && auth()->user()->level == 'siswa')
                         <li class="list-divider"></li>
                         <li class="nav-small-cap"><span class="hide-menu">Data Saldo</span></li>
                         <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i class="icon-wallet"></i><span
                                    class="hide-menu">Lihat Saldo
                                </span></a>
                            <ul aria-expanded="false" class="collapse first-level base-level-line">
                                <li class="sidebar-item"><a href="{{url('/siswa/tabungan/rincian')}}" class="sidebar-link"><span
                                            class="hide-menu"> Rincian Saldo </span></a></li>

                                <li class="sidebar-item"><a href="{{url('/siswa/tabungan/total')}}" class="sidebar-link"><span
                                            class="hide-menu"> Total Saldo </span></a></li>
                            </ul>
                        </li>
                        @endif
                        
                        @if(auth()->check() && auth()->user()->level == 'siswa')
                        {{-- <li class="list-divider"></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i class="icon-wallet"></i><span
                                    class="hide-menu">Pinjaman
                                </span></a>
                            <ul aria-expanded="false" class="collapse first-level base-level-line">
                                <li class="sidebar-item"><a href="{{url('/siswa/pinjaman')}}" class="sidebar-link"><span
                                            class="hide-menu"> Pinjam Uang </span></a></li>

                                <li class="sidebar-item"><a href="{{url('/siswa/cicilan')}}" class="sidebar-link"><span
                                            class="hide-menu"> Bayar Cicilan </span></a></li>
                            </ul>
                        </li> --}}
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Pembayaran</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{url('/siswa/pembayaran')}}"
                                aria-expanded="false">
                                <i class="icon-basket"></i>
                                <span class="hide-menu">Bayar Cicilan</span>
                            </a>
                        </li>

                        <li class="nav-small-cap"><span class="hide-menu">Data Pinjaman</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{url('/siswa/pinjaman/'.auth()->user()->siswa->id_siswa)}}"
                                aria-expanded="false">
                                <i class="icon-basket"></i>
                                <span class="hide-menu">Histori Pinjaman</span>
                            </a>
                        </li>
                        @endif

                        
                        @if(auth()->check() && auth()->user()->level == 'orang tua')
                        <li class="list-divider"></li>
                         <li class="nav-small-cap"><span class="hide-menu">Data Saldo</span></li>
                         
                         <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i class="icon-wallet"></i><span
                                    class="hide-menu">Lihat Saldo
                                </span></a>
                            <ul aria-expanded="false" class="collapse first-level base-level-line">
                                <li class="sidebar-item"><a href="{{url('/orang_tua/tabungan/rincian')}}" class="sidebar-link"><span
                                            class="hide-menu"> Rincian Saldo </span></a></li>

                                <li class="sidebar-item"><a href="{{url('/orang_tua/tabungan/total')}}" class="sidebar-link"><span
                                            class="hide-menu"> Total Saldo </span></a></li>
                            </ul>
                        </li>
                        @endif

                        
                        @if(auth()->check() && auth()->user()->level == 'admin')
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Data Pengguna</span></li>
                        
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i class="icon-user"></i><span
                                    class="hide-menu">Siswa
                                </span></a>
                            <ul aria-expanded="false" class="collapse first-level base-level-line">
                                @foreach ($data_kelas as $kelas)
                                <li class="sidebar-item">
                                    <a href="{{ url('/siswa/'. $kelas->id_kelas) }}/kelas" class="sidebar-link">
                                        <span class="hide-menu"> {{ $kelas->kelas }} </span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{url('/orang_tua')}}"
                                aria-expanded="false">
                                <i class="icon-people"></i>
                                <span class="hide-menu">Orang Tua</span>
                            </a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{url('/admin')}}"
                                aria-expanded="false"><i class="icon-user-follow"></i><span
                                    class="hide-menu">Admin</span></a></li>

                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Data Kelas & Tapel</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{url('/kelas')}}"
                                aria-expanded="false"><i class="icon-chart"></i><span
                                    class="hide-menu">Kelas </span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{url('/tapel')}}"><i class="icon-calender"></i><span
                                    class="hide-menu">Tahun Pelajaran </span></a>
                        </li>

                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Data Tabungan</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i class="icon-wallet"></i><span
                                    class="hide-menu">Input Data
                                </span></a>
                            <ul aria-expanded="false" class="collapse first-level base-level-line">
                                @foreach ($data_kelas as $kelas)
                                <li class="sidebar-item">
                                    <a href="{{ url('/tabungan/tambah/'. $kelas->id_kelas) }}" class="sidebar-link">
                                        <span class="hide-menu"> {{ $kelas->kelas }} </span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i class="icon-wallet"></i><span
                                    class="hide-menu">Lihat Rincian
                                </span></a>
                            <ul aria-expanded="false" class="collapse first-level base-level-line">
                                @foreach ($data_kelas as $kelas)
                                <li class="sidebar-item">
                                    <a href="{{ url('/tabungan/'. $kelas->id_kelas) }}" class="sidebar-link">
                                        <span class="hide-menu"> {{ $kelas->kelas }} </span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i class="icon-wallet"></i><span
                                    class="hide-menu">Lihat Total Saldo
                                </span></a>
                            <ul aria-expanded="false" class="collapse first-level base-level-line">
                                @foreach ($data_kelas as $kelas)
                                <li class="sidebar-item">
                                    <a href="{{ url('/tabungan/total_tabungan/'. $kelas->id_kelas) }}" class="sidebar-link">
                                        <span class="hide-menu"> {{ $kelas->kelas }} </span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="nav-small-cap"><span class="hide-menu">Data Pinjaman</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{url('/pinjaman/histori')}}"
                                aria-expanded="false"><i class="icon-credit-card"></i><span
                                    class="hide-menu">Histori Pinjaman</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{url('/pinjaman/total')}}"
                                aria-expanded="false"><i class="icon-credit-card"></i><span
                                    class="hide-menu">Total Pinjaman</span></a>
                        </li>
                        @endif
                        
                        @if(auth()->check() && auth()->user()->level == 'admin')
                        {{-- <li class="list-divider"></li>

                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{url('/sms')}}"><i class="icon-bubble"></i><span
                                    class="hide-menu">Kirim Pesan</span></a>
                        </li> --}}
                        @endif
                        <li class="list-divider"></li>
                        @if(auth()->check() && auth()->user()->level == 'admin')
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="/logout/admin"
                                aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span
                                    class="hide-menu">Logout</span></a></li>
                        @endif
                        @if(auth()->check() && auth()->user()->level == 'siswa' || auth()->user()->level == 'orang tua')
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="/logout"
                                aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span
                                    class="hide-menu">Logout</span></a></li>
                        @endif
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->