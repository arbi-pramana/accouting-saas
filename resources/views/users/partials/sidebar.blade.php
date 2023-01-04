<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <div class="nav-user">
            <h5>{{Auth::guard('users')->user()->name}}</h5>
            <p>{{Auth::guard('users')->user()->type}}</p>
        </div>
        <ul class="metismenu" id="menu">
            <li class="nav-label">Main</li>
            <li>
                <a href="app-profile.html">
                    <i class="mdi mdi-view-dashboard"></i>
                    <span class="nav-text">Summary Dashboard</span>
                </a>
            </li>
            <li>
                <a class="has-arrow" href="#" aria-expanded="false">
                    <i class=" mdi mdi-chart-bar"></i>
                    <span class="nav-text">Laporan</span>
                </a>
                <ul aria-expanded="false">
                    <li>
                        <a href="index2.html">Laporan Penjualan</a>
                    </li>
                    <li>
                        <a href="index3.html">Laporan Pembelian</a>
                    </li>
                    <li>
                        <a href="index4.html">Kartu Stok Barang</a>
                    </li>
                    <li>
                        <a href="index5.html">Buku Hutang</a>
                    </li>
                    <li>
                        <a href="index6.html">Buku Piutang</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="#" aria-expanded="false">
                    <i class="mdi mdi-book-open-page-variant"></i>
                    <span class="nav-text">Transaksi</span>
                </a>
                <ul aria-expanded="false">
                    <li>
                        <a href="{{route('purchase.index')}}">Pembelian</a>
                    </li>
                    <li>
                        <a href="{{route('sale.index')}}">Penjualan</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="#" aria-expanded="false">
                    <i class="fa fa-pencil"></i>
                    <span class="nav-text">Double Entry</span>
                </a>
                <ul aria-expanded="false">
                    <li>
                        <a href="{{route('coa.index')}}">
                            Chart of Account
                        </a>
                    </li>
                    <li>
                        <a href="{{route('journal.index')}}">Entri Jurnal</a>
                    </li>
                    <li>
                        <a href="{{route('users.report.neraca')}}">Laporan Neraca</a>
                    </li>
                    <li>
                        <a href="{{route('users.report.laba-rugi')}}">Laporan Laba Rugi</a>
                    </li>
                    <li>
                        <a href="{{route('users.report.buku-besar')}}">Buku Besar</a>
                    </li>
                </ul>
            </li>
            <li class="nav-label">Setup</li>
            <li>
                <a class="has-arrow" href="#" aria-expanded="false">
                    <i class="mdi mdi-table-edit"></i>
                    <span class="nav-text">Data Master</span>
                </a>
                <ul aria-expanded="false">
                    <li>
                        <a href="{{route('product-category.index')}}">Kategori Barang</a>
                    </li>
                    <li>
                        <a href="{{route('product.index')}}">Data Barang</a>
                    </li>
                    <li>
                        <a href="{{route('customer.index')}}">Data Pelanggan</a>
                    </li>
                    <li>
                        <a href="{{route('supplier.index')}}">Data Supplier</a>
                    </li>
                    <li>
                        <a href="{{route('employee.index')}}">Data Karyawan</a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="{{route('users.business-info')}}">
                    <i class="fa fa-gears"></i>
                    <span class="nav-text">Business Info</span>
                </a>
            </li>
            <li class="">
                <a href="documentation.html">
                    <i class="fa fa-question-circle"></i>
                    <span class="nav-text">Help</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- #/ nk nav scroll -->
</div>