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
                <table class="table table-responsiv" id="tabel_admin">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Admin</th>
                            <th>Username</th>
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
                            <label for="exampleFormControlInput1">Nama</label>
                            <input name="nama" id="nama" required type="text" class="form-control"
                                placeholder="Input Nama" value="">
                        </div>
                        <div class="form-group ">
                            <label for="exampleFormControlInput1">Username</label>
                            <input name="username" id="username" required type="text" class="form-control"
                                placeholder="Input Username" value="">
                        </div>
                        <div class="form-group ">
                            <label for="exampleFormControlInput1">Password</label>
                            <input name="password" id="password" required type="password" class="form-control"
                                placeholder="Input Password" value="">
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
            $('#tabel_admin').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin') }}",
                    type: "GET"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    }, {
                        data: 'nama',
                        name: 'nama',
                    },
                    {
                        data: 'username',
                        name: 'username',
                    }, {
                        data: 'action',
                        name: 'action'
                    }
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

            // Tombol Tambah
            $('#tombol-tambah').click(function() {
                $('#tombol-simpan').val('create-post');
                $('#id').val('');
                $('#form-tambah-edit').trigger('reset');
                $('#modal-judul').html('Tambah Data admin');
                $('#modal-tambah-edit').modal('show')
            });

            //Tombol Edit
            $('body').on('click', '.edit-post', function() {
                var data_id = $(this).data('id');
                $.get('admin/' + data_id + '/edit', function(data) {
                    $('#modal-judul').html('Edit Data admin');
                    $('#tombol-simpan').html('Rubah');
                    $('#modal-tambah-edit').modal('show');

                    $('#id').val(data.id);
                    $('#nama').val(data.nama);
                    $('#username').val(data.username);
                    $('#password').val(data.password);
                })
            });

            //Simpan dan Edit STore
            if ($('#form-tambah-edit').length > 0) {
                $('#form-tambah-edit').validate({
                    submitHandler: function(form) {
                        var actionType = $('#tombol-simpan').val();
                        $('#tombol-simpan').html('Menyimpan ...');

                        $.ajax({
                            data: $('#form-tambah-edit').serialize(),
                            url: "{{ route('admin.store') }}",
                            type: "POST",
                            dataType: 'json',
                            success: function(data) {
                                $('#form-tambah-edit').trigger('reset');
                                $('#modal-tambah-edit').modal('hide');
                                $('#tombol-simpan').html('Simpan');
                                var oTable = $('#tabel_admin').dataTable();
                                oTable.fnDraw(false);
                                toastr.success('Data Berhasil Disimpan');
                            },
                            error: function(data) {
                                console.log('Eror', data);
                                $('#tombol-simpan').html('Simpan');
                            }
                        })
                    }
                })
            }

            //Tombol Hapus
            $(document).on('click', '.delete', function() {
                dataid = $(this).attr('id');
                $('#konfirmasi-modal').modal('show');
            });

            //Delete
            $('#tombol-hapus').click(function() {
                $.ajax({
                    url: "admin/" + dataid,
                    type: 'delete',
                    beforeSend: function() {
                        $('#tombol-hapus').text('Menghapus...');
                    },
                    success: function(data) {
                        setTimeout(function() {
                            $('#konfirmasi-modal').modal('hide');
                            var oTable = $('#tabel_admin').dataTable();
                            oTable.fnDraw(false);
                        });
                        toastr.success('Data Berhasil Dihapus');
                    },
                    error: function(data) {
                        setTimeout(function() {
                            $('#konfirmasi-modal').modal('hide');
                        });
                        toastr.warning('Data Berelasi');
                    }

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
