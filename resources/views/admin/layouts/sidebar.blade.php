<aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{url('admin/dashboard')}}"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                    class="hide-menu">Dashboard</span></a></li>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Mode Kasir</span></li>

                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="app-chat.html"
                                aria-expanded="false"><i data-feather="message-square" class="feather-icon"></i><span
                                    class="hide-menu">Pembayaran</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="app-calendar.html"
                                aria-expanded="false"><i data-feather="calendar" class="feather-icon"></i><span
                                    class="hide-menu">Laporan Penjualan</span></a></li>

                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Pengelolaan</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{url('admin/kategori_produk')}}"
                                aria-expanded="false"><i data-feather="calendar" class="feather-icon"></i><span
                                    class="hide-menu">Kategori Produk</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                    class="hide-menu">Stok Produk</span></a>
                            <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                <li class="sidebar-item">
                                    <a href="{{route('produk.index')}}" class="sidebar-link">
                                        <span class="hide-menu"> Semua Produk </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{route('produk.kategori', ['id' => 1])}}" class="sidebar-link">
                                        <span class="hide-menu"> Aneka Mie </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{route('produk.kategori', ['id' => 2])}}" class="sidebar-link">
                                        <span class="hide-menu"> Minuman </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{route('produk.kategori', ['id' => 3])}}" class="sidebar-link">
                                        <span class="hide-menu"> Cemilan </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{route('produk.kategori', ['id' => 4])}}" class="sidebar-link">
                                        <span class="hide-menu"> Aneka Nasi </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="app-calendar.html"
                                aria-expanded="false"><i data-feather="calendar" class="feather-icon"></i><span
                                    class="hide-menu">Reservasi Meja</span></a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>