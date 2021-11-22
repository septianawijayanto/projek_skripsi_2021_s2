@extends('admin.layouts.master')
@section('konten')
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $title }}</h3>

        </div>
        <div class="panel-body">
            <button type="button" class="btn btn-warning btn-xs btn-refresh"><i class="fa fa-refresh"></i></button>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <!-- Tabel -->
                <table class="table table-responsiv" id="table_transaksi">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Nama Anggota</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Denda</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
                <!-- End Tabel -->
            </div>
        </div>
    </div>
    <!-- AKHIR MODAL -->
@endsection
@section('scripts')


    <script type="text/javascript">
        $(document).ready(function() {
            $('#table_transaksi').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('pengembalian.ajax') }}",
                    type: "GET"
                },
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                }, {
                    data: 'kode_transaksi',
                    name: 'kode_transaksi',
                }, {
                    data: 'nama',
                    name: 'nama'
                }, {
                    data: 'judul_buku',
                    name: 'judul_buku'
                }, {
                    data: 'tgl_pinjam',
                    name: 'tgl_pinjam'
                }, {
                    data: 'tgl_kembali',
                    name: 'tgl_kembali'
                }, {
                    data: 'denda',
                    name: 'denda'
                }, {
                    data: 'status',
                    name: 'status'
                }, {
                    data: 'aksi',
                    name: 'aksi'
                }, ],
                order: [
                    [0, 'DESC']
                ]
            });

            $.ajaxSetup({
                headers: {
                    'X_CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // $(document).ready(function() {
            //     $('.kembalikan').click(function() {
            //         $.post('pengembalian/' + id + '/kembali', function() {

            //         });

            //     });
            // });

            // btn refresh
            $('.btn-refresh').click(function(e) {
                e.preventDefault();
                $('.preloader').fadeIn();
                location.reload();
            })

        });
    </script>


@endsection
