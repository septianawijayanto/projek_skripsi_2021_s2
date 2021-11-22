<ul class="nav">
    <li><a href="{{ route('dashboard') }}" class=""><i class="lnr lnr-home nav-link" id="Dashboard"></i>
            <span>Dashboard</span></a></li>
    </li>
    <li>
        <a href="#data" data-toggle="collapse" class="collapsed"><i class="fa fa-database"></i> <span>Master
                Data</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="data" class="collapse ">
            <ul class="nav">
                <li><a href="{{ route('anggota') }}"><i class="fa fa-circle-thin"></i> Anggota</a></li>
                <li><a href="{{ route('penerbit') }}" class=""><i class="fa fa-circle-thin"></i>
                        Penerbit</a></li>
                <li><a href="{{ route('klasifikasi') }}" class=""><i class="fa fa-circle-thin"></i>
                        Klasifikasi</a></li>
                <li><a href="{{ route('e-book') }}" class=""><i class="fa fa-circle-thin"></i>
                        E-Book</a></li>
                <li><a href="{{ route('buku') }}" class=""><i class="fa fa-circle-thin"></i> Buku</a>
                </li>
            </ul>
        </div>
    </li>
    <li>
        <a href="#transaksi" data-toggle="collapse" class="collapsed"><i class="lnr lnr-pencil"></i>
            <span>Transaksi</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="transaksi" class="collapse ">
            <ul class="nav">
                <li><a href="{{ route('transaksi') }}" class=""><i class="fa fa-circle-thin"></i>
                        Peminjaman</a></li>
                <li><a href="{{ route('pengembalian') }}" class=""><i class="fa fa-circle-thin"></i>
                        Pengembalian</a></li>
                <li><a href="{{ route('denda') }}" class=""><i class="fa fa-circle-thin"></i> Denda </a>
                </li>

            </ul>
        </div>
    </li>
    <li><a href="{{ route('laporan') }}" class=""><i class="lnr lnr-dice"></i>
            <span>Laporan</span></a>
    </li>
    <li>
        <a href="#pengaturan" data-toggle="collapse" class="collapsed"><i class="fa fa-gear"></i>
            <span>Pengaturan</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="pengaturan" class="collapse ">
            <ul class="nav">
                <li><a href="{{ route('sekolah') }}" class=""><i class="fa fa-circle-thin"></i>
                        pSekolah</a></li>
            </ul>
        </div>
    </li>
    <li><a href="{{ url('logout') }}" class=""><i class="lnr lnr-exit"></i> <span>Keluar</span></a>
    </li>

</ul>
