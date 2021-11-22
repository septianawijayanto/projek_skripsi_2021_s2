@extends('admin.layouts.master')
@section('konten')
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $title }}</h3>

        </div>
        <div class="panel-body">
            <button type="button" class="btn btn-warning btn-xs btn-refresh"><i class="fa fa-refresh"></i></button>
            <button id="tombol-tambah" type="button" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></button>
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
    <!-- MULAI MODAL FORM TAMBAH/EDIT-->
    <div class="modal fade" id="modal-tambah-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-judul"></h5>
                </div>

                <div class="modal-body">
                    <form id="form-tambah-edit" enctype="multipart/form-data">
                        <div class="form-group ">
                            <input name="id" id="id" required type="hidden" class="form-control" value="">
                        </div>
                        <div class="form-group ">
                            <label for="exampleFormControlInput1">Koda transaksi</label>
                            <input name="kode_transaksi" id="kode_transaksi" required type="text" class="form-control"
                                placeholder="Input Koda transaksi" value="">
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <select name="level" id="level" required class="form-control" required>
                                <option value="">-Pilih-</option>
                                @foreach ($level as $level)
                                    <option value="{{ $level->id }}">{{ $level->level }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <select name="anggota" id="anggota" required class="form-control" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="klasifikasi">Klasifikasi</label>
                            <select name="klasifikasi" id="klasifikasi" required class="form-control" required>
                                <option value="">-Pilih-</option>
                                @foreach ($klasifikasi as $klasifikasi)
                                    <option value="{{ $klasifikasi->id }}">{{ $klasifikasi->nama_klasifikasi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="buku_id">Judul Buku</label>
                            <select name="buku" id="buku" class="form-control" required>
                                {{-- <option value="">-Pilih-</option> --}}
                            </select>
                        </div>
                        <div class="form-group ">
                            <label for="exampleFormControlInput1">Tanggal Pinjam</label>
                            <input name="tgl_pinjam" id="tgl_pinjam" required type="text" readonly class="form-control"
                                value="{{ date('Y/m/d H:i') }}">
                        </div>
                        <div class="form-group ">
                            <label for="exampleFormControlInput1">Tanggal Kembali</label>
                            <input name="tgl_kembali" id="tgl_kembali" required type="datetime-local" class="form-control"
                                value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="fa fa-close"></i> Tutup</button>
                            <button type="submit" id="tombol-simpan" value="create" class="btn btn-primary"><i
                                    class="fa fa-save"></i> Simpan</button>
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
                    url: "{{ route('transaksi.ajax') }}",
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
                        data: 'action',
                        name: 'action'
                    },

                ],
                order: [
                    [0, 'DESC']
                ]
            });

            $.ajaxSetup({
                headers: {
                    'X_CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //Klasifikasi
            $("#klasifikasi").on('change', function() {
                var klasifikasi_id = $(this).val();
                if (klasifikasi_id) {
                    $.ajax({
                        type: "GET",
                        url: "nama_buku/" + klasifikasi_id,
                        // data: {
                        //     "_token": "{{ csrf_token() }}"
                        // },
                        data: {
                            id: $(this).val()
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data) {
                                $('#buku').empty();
                                $('#buku').append(
                                    '<option hidden>--Pilih Judul Buku--</option>');
                                $.each(data, function(id, judul_buku) {
                                    $('#buku').append(new Option(judul_buku, id))

                                });
                            } else {
                                $('#buku').empty();
                            }
                        }
                    });
                } else {
                    $('#buku').empty();
                }
            });


            // //Level
            $("#level").on('change', function() {
                var level_id = $(this).val();
                if (level_id) {
                    $.ajax({
                        type: "GET",
                        url: "nama_anggota/" + level_id,
                        data: {
                            id: $(this).val()
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data) {
                                $('#anggota').empty();
                                $('#anggota').append(
                                    '<optionn hidden>--Pilih Nama Anggota--</option>');
                                $.each(data, function(id, nama) {
                                    $('#anggota').append(new Option(nama, id))
                                });

                            } else {
                                $('#anggota').empty();
                            }
                        }
                    });
                } else {
                    $('#anggota').empty()
                }
            });


            // Tombol Tambah
            $('#tombol-tambah').click(function() {
                $('#tombol-simpan').val('create-post');
                $('#id').val('');
                $('#form-tambah-edit').trigger('reset');
                $('#modal-judul').html('Tambah Data transaksi');
                $('#modal-tambah-edit').modal('show')
            });



            //Simpan dan Edit STore
            if ($('#form-tambah-edit').length > 0) {
                $('#form-tambah-edit').validate({
                    submitHandler: function(form) {
                        var actionType = $('#tombol-simpan').val();
                        $('#tombol-simpan').html('Menyimpan ...');

                        $.ajax({
                            data: $('#form-tambah-edit').serialize(),
                            url: "{{ route('transaksi.store') }}",
                            type: "POST",
                            dataType: 'json',
                            success: function(data) {
                                $('#form-tambah-edit').trigger('reset');
                                $('#modal-tambah-edit').modal('hide');
                                $('#tombol-simpan').html('Simpan');
                                var oTable = $('#table_transaksi').dataTable();
                                oTable.fnDraw(false);
                                toastr.success('Data Peminjaman Berhasil Disimpan');
                            },
                            error: function(data) {
                                console.log('Eror', data);
                                $('#tombol-simpan').html('Simpan');
                            }
                        })
                    }
                })
            }

            // //ketika class edit-post yang ada pada tag body di klik maka
            // $('body').on('click', '.perpanjang', function() {
            //     var data_id = $(this).data('id');
            //     $.get('transaksi/perpanjang/' + data_id, function(data) {
            //         $('#modal-judul').html("Edit Data Anggota");
            //         $('#tombol-simpan').html("Rubah");
            //         $('#modal-tambah-edit').modal('show');

            //         //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas               
            //         $('#id').val(data.id);
            //         $('#kode_transaksi').hide();;
            //         $('#level').hide();
            //         $('#anggota').hide();
            //         $('#klasifikasi').hide();
            //         $('#buku').hide();
            //         $('#tgl_pinjam').hide();
            //         $('#tgl_kembali').val(data.tgl_kembali);
            //     })
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
