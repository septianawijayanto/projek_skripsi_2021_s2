@extends('admin.layouts.master')
@section('konten')
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $title }}</h3>

        </div>
        <div class="panel-body">
            <button type="button" class="btn btn-warning btn-xs btn-refresh"><i class="fa fa-refresh"></i></button>
            <a href="javascript:void(0)" class="btn btn-primary btn-xs" id="tombol-tambah"><i class="fa fa-plus"></i> </a>
            <a href="{{ route('anggota.print') }}" class="btn btn-success btn-xs"><i class="fa fa-print"></i></a>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <!-- Tabel -->
                <table class="table table-responsiv" id="table_anggota">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Anggota</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Level</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>JK</th>
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
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group ">
                                    <label for="exampleFormControlInput1">Kode Anggota</label>
                                    <input name="kode_anggota" id="kode_anggota" required type="text" readonly
                                        class="form-control" placeholder="Input Kode Anggota" value="{{ $kode }}">
                                </div>
                                <div class="form-group ">
                                    <label for="exampleFormControlInput1">Nama</label>
                                    <input name="nama" id="nama" required type="text" class="form-control"
                                        placeholder="Input Nama" value="">
                                </div>
                                <div class="form-group ">
                                    <label for="exampleFormControlInput1">Username</label>
                                    <input name="username" id="username" required type="text" class="form-control"
                                        placeholder="Input Username" value="">
                                </div>
                                <div class="form-group">
                                    <label for="level">Level</label>
                                    <select name="level_id" id="level_id" required class="form-control" required>
                                        <option value="">-Pilih-</option>
                                        @foreach ($level as $level)
                                            <option value="{{ $level->id }}">{{ $level->level }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label for="exampleFormControlInput1">Password</label>
                                    <input name="password" id="password" required type="password" class="form-control"
                                        placeholder="Input Password" value="">
                                </div>
                                <div class="form-group ">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input name="tempat_lahir" id="tempat_lahir" required type="text" class="form-control"
                                        placeholder="Input Tempat Lahir" value="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group ">
                                    <label for="exampleFormControlInput1">Tanggal Lahir</label>
                                    <input name="tgl_lahir" id="tgl_lahir" required type="date" class="form-control"
                                        placeholder="Input Tanggal Lahir" value="">
                                </div>
                                <div class="form-group ">
                                    <label for="exampleFormControlInput1">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control" placeholder="Input Alamat"
                                        rows="8"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="agama">Jenis Kelamin</label>
                                    <select name="jk" id="jk" required class="form-control" required>
                                        <option value="">-Pilih-</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label for="no_hp">No Hp</label>
                                    <input name="no_hp" id="no_hp" class="form-control" placeholder="Input No Hp"
                                        type="text">
                                </div>
                            </div>
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



@stop

@section('scripts')


    <script type="text/javascript">
        $(document).ready(function() {
            $('#table_anggota').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('anggota.ajax') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    }, {
                        data: 'kode_anggota',
                        name: 'kode_anggota'
                    }, {
                        data: 'nama',
                        name: 'nama'
                    }, {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'level',
                        name: 'level'
                    },
                    {
                        data: 'tgl_lahir',
                        name: 'tgl_lahir'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'jk',
                        name: 'jk',
                    }, {
                        data: 'action',
                        name: 'action'
                    }
                ],
                order: [
                    [0, 'DESC']
                ]
            });

            // btn refresh
            $('.btn-refresh').click(function(e) {
                e.preventDefault();
                $('.preloader').fadeIn();
                location.reload();
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //Hapus Data
            //Ketika Tombol hapus di klik keluar Modal Hapus 
            $(document).on('click', '.delete', function() {
                dataId = $(this).attr('id');
                $('#konfirmasi-modal').modal('show');
            });
            //jika tombol hapus pada modal konfirmasi di klik maka
            $('#tombol-hapus').click(function() {
                $.ajax({

                    url: "anggota/" + dataId, //eksekusi ajax ke url ini
                    type: 'delete',
                    beforeSend: function() {
                        $('#tombol-hapus').text('Menghapus...'); //set text untuk tombol hapus
                    },
                    success: function(data) { //jika sukses
                        setTimeout(function() {
                            $('#konfirmasi-modal').modal(
                                'hide'); //sembunyikan konfirmasi modal
                            var oTable = $('#table_anggota').dataTable();
                            oTable.fnDraw(false); //reset datatable
                        });
                        toastr.success( //tampilkan toastr warning
                            'Data Berhasil Dihapus',
                        );
                    }
                })
            });
            //TOMBOL TAMBAH DATA
            //jika tombol-tambah diklik maka
            $('#tombol-tambah').click(function() {
                $('#button-simpan').val("create-post"); //valuenya menjadi create-post
                $('#id').val(''); //valuenya menjadi kosong
                $('#form-tambah-edit').trigger("reset"); //mereset semua input dll didalamnya
                $('#modal-judul').html("Tambah Anggota Baru"); //valuenya tambah anggota baru
                $('#modal-tambah-edit').modal('show'); //modal tampil
            });



            //ketika class edit-post yang ada pada tag body di klik maka
            $('body').on('click', '.edit-post', function() {
                var data_id = $(this).data('id');
                $.get('anggota/' + data_id + '/edit', function(data) {
                    $('#modal-judul').html("Edit Data Anggota");
                    $('#tombol-simpan').html("Rubah");
                    $('#modal-tambah-edit').modal('show');

                    //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas               
                    $('#id').val(data.id);
                    $('#kode_anggota').val(data.kode_anggota);
                    $('#nama').val(data.nama);
                    $('#username').val(data.username);
                    $('#level_id').val(data.level_id);
                    $('#password').val(data.password);
                    $('#tgl_lahir').val(data.tgl_lahir);
                    $('#alamat').val(data.alamat);
                    $('#jk').val(data.jk);
                    $('#no_hp').val(data.no_hp);
                    $('#tempat_lahir').val(data.tempat_lahir);

                })
            });


            //SIMPAN & UPDATE DATA DAN VALIDASI (SISI CLIENT)
            //jika id = form-tambah-edit panjangnya lebih dari 0 atau bisa dibilang terdapat data dalam form tersebut maka
            //jalankan jquery validator terhadap setiap inputan dll dan eksekusi script ajax untuk simpan data
            if ($("#form-tambah-edit").length > 0) {
                $("#form-tambah-edit").validate({
                    submitHandler: function(form) {
                        var actionType = $('#tombol-simpan').val();
                        $('#tombol-simpan').html('Menyimpan ...');

                        $.ajax({
                            data: $('#form-tambah-edit')
                                .serialize(), //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                            url: "{{ route('anggota.store') }}", //url simpan data
                            type: "POST", //karena simpan kita pakai method POST
                            dataType: 'json', //data tipe kita kirim berupa JSON
                            success: function(data) { //jika berhasil 
                                $('#form-tambah-edit').trigger("reset"); //form reset
                                $('#modal-tambah-edit').modal('hide'); //modal hide
                                $('#tombol-simpan').html('Simpan'); //tombol simpan
                                var oTable = $('#table_anggota')
                                    .dataTable(); //inialisasi datatable
                                oTable.fnDraw(false); //reset datatable
                                toastr.success( //tampilkan toastr dengan notif data berhasil disimpan pada posisi kanan bawah
                                    'Data Berhasil Disimpan',
                                );
                            },
                            error: function(data) { //jika error tampilkan error pada console
                                console.log('Error:', data);
                                $('#tombol-simpan').html('Simpan');
                            }
                        });
                    }
                })
            }
        });
    </script>


@endsection
