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
    <!-- MULAI MODAL Rusak Hilang-->
    <div class="modal fade" id="modal-rusak-hilang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-judul"></h5>
                </div>

                <div class="modal-body">
                    <form id="form-rusak-hilang" enctype="multipart/form-data">
                        <div class="form-group ">
                            <input name="id" id="id" required type="hidden" class="form-control" value="">
                        </div>
                        <div class="form-group ">
                            <label for="kode_transaksi">Kode Transaksi</label>
                            <input name="kode_transaksi" id="kode_transaksi" readonly type="text" class="form-control"
                                placeholder="Input Kode Transaksi" value="">
                        </div>
                        <div class="form-group ">
                            <label for="exampleFormControlInput1">Denda Awal</label>
                            <input name="denda" id="denda" required type="text" class="form-control"
                                placeholder="Input Denda Awal" value="">
                        </div>
                        <div class="form-group ">
                            <label for="exampleFormControlInput1">Denda</label>
                            <input name="denda" id="denda" required type="text" class="form-control"
                                placeholder="Input Denda" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary fa fa-close" data-dismiss="modal"> Tutup</button>
                            <button type="submit" id="tombol-simpan" value="create" class="btn btn-primary fa fa-save">
                                Simpan</button>
                        </div>
                    </form>
                </div>
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

            //Tmb Rusak
            $('body').on('click', '.btn-rusak', function() {
                var data_id = $(this).data('id');
                $.get('pengembalian/' + data_id + '/rusak', function(data) {
                    $('#modal-judul').html('Input Denda Rusak');
                    // $('#tombol-simpan').val('btn-rusak');
                    $('#tombol-simpan').html(' Simpan');
                    $('#modal-rusak-hilang').modal('show');
                    $('#id').val(data.id);
                    $('#kode_transaksi').val(data.kode_transaksi);
                    $('#denda').val(data.denda);
                })
            });

            //Tmb Hilang
            $('body').on('click', '.btn-hilang', function() {
                var hilang_id = $(this).data('id');
                $.get('pengembalian/' + hilang_id + '/hilang', function(data) {
                    $('#modal-judul').html('Input Denda Hilang');
                    $('#tombol-simpan').html(' Simpan');
                    $('#modal-rusak-hilang').modal('show');
                    $('#id').val(data.id);
                    $('#kode_transaksi').val(data.kode_transaksi);
                    $('#denda').val(data.denda);
                })
            });

            // btn refresh
            $('.btn-refresh').click(function(e) {
                e.preventDefault();
                $('.preloader').fadeIn();
                location.reload();
            })

        });
    </script>


@endsection
