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
                    <a href="{{ route('laporan.harian') }}" class="dropdown-item"> Transaksi Hari Ini</a>
                    <a href="!#" class="dropdown-item btn-priodepdf" data-toggle="modal" data-target="#modal">Transaksi
                        Periode</a>
                    <br>
                    <a href="{{ url('admin/laporan/print?status=pinjam') }}" class="dropdown-item"> Transaksi
                        Dipinjam</a>
                    <br>
                    <a href="{{ url('admin/laporan/print?status=kembali') }}" class="dropdown-item"> Transaksi
                        Pengembalian</a>
                    <br>
                    <a href="{{ url('admin/laporan/print?status=rusak') }}" class="dropdown-item">Transaksi
                        Rusak</a>
                    <br>
                    <a href="{{ url('admin/laporan/print?status=hilang') }}" class="dropdown-item"> Transaksi
                        Hilang</a>
                    <br>
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
    <!--Modal-->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-default modal-dialog-centered modal-" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    Pilih Panggal
                </div>
                <div class="modal-body">

                    <form role="form" action="{{ url('admin/laporan/periode') }}" method="get">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Dari Tanggal</label>
                                <input type="date" class="form-control datepicker" id="inputtgl" placeholder="Dari Tanggal"
                                    name="dari" autocomplete="off" value="{{ date('Y-m-d') }}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Sampai tanggal</label>
                                <input type="date" class="form-control datepicker" name="sampai" id="inputtgl2"
                                    placeholder="Sampai Tanggal" autocomplete="off" value="{{ date('Y-m-d') }}">
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                    class="fa  fa-power-off"></i> Tutup</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End Modal-->
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
