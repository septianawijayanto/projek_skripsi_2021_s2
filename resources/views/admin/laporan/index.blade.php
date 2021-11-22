@extends('admin.layouts.master')
@section('konten')
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $title }}</h3>

        </div>
        <div class="panel-body">
            <button type="button" class="btn btn-warning btn-xs btn-refresh"><i class="fa fa-refresh"></i></button>
            <div class="btn-group dropdown float-right">
                <button type="button" class="btn btn-sm btn-flat btn-primary  dropdown-toggle" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <b><i class="fa fa-print"></i> Laporan Transaksi</b>
                </button>
                <div class="dropdown-menu " x-placement="bottom-start"
                    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                    <a href="{{ route('laporan.all') }}" class="dropdown-item"> Transaksi Semua</a>
                    <br>
                    <a href="{{ url('admin/laporan/peminjamanpdf?status=pinjam') }}" class="dropdown-item"> Transaksi
                        Dipinjam</a>
                    <br>
                    <a href="{{ url('admin/laporan/peminjamanpdf?status=kembali') }}" class="dropdown-item"> Transaksi
                        Pengembalian</a>
                    <br>
                    {{-- <a href="{{ url('admin/laporan/peminjamanpdf?status=rusak') }}" class="dropdown-item">Transaksi
                        Rusak</a>
                    <br>
                    <a href="{{ url('admin/laporan/peminjamanpdf?status=hilang') }}" class="dropdown-item"> Transaksi
                        Hilang</a>
                    <br> --}}
                    {{-- <a href="!#" class="dropdown-item btn-priodepdf" data-toggle="modal" data-target="#modal">Transaksi
                        Periode</a>
                    <br> --}}
                </div>
            </div>
        </div>
        <div class="panel-body">
            <!-- Tabel -->

            <!-- End Tabel -->
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('.btn-refresh').click(function(e) {
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })
    </script>
@endsection
