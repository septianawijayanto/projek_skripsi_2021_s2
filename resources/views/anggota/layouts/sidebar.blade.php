<ul class="nav">
    <li><a href="{{ route('dashboard.index') }}" class=""><i class="lnr lnr-home"></i>
            <span>Dashboard</span></a></li>
    <li><a href="{{ route('e-book.index') }}" class=""><i class="lnr lnr-book"></i>
            <span>E-Book</span></a>
    <li><a href="{{ route('buku.index') }}" class=""><i class="lnr lnr-book"></i> <span>Buku</span></a>
    </li>

    @if (Session::get('level_id') =='Siswa')
        <li>
            <a href="#subPages2" data-toggle="collapse" class="collapsed"><i class="lnr lnr-pencil"></i>
                <span>Transaksi</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
            <div id="subPages2" class="collapse ">
                <ul class="nav">
                    <li><a href="{{ route('peminjaman.index') }}" class="">Peminjaman</a></li>
                    {{-- <li><a href="{{ route('transaksi.denda') }}" class="">Denda</a></li> --}}

                </ul>
            </div>
        </li>
    @else
        <li><a href="{{ route('peminjaman.index') }}" class=""><i class="lnr lnr-pencil"></i>
                <span>Histori Transaksi</span></a></li>
    @endif
    <li><a href="{{ url('logout') }}" class=""><i class="lnr lnr-exit"></i> <span>Keluar</span></a>
    </li>

</ul>
