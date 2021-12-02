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
                <table class="table table-responsiv" id="table_ebook">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Judul Buku</th>
                            <th>Kelas</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Klasifikasi</th>
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
                                    <label for="exampleFormControlInput1">Judul Buku</label>
                                    <input name="judul_buku" id="judul_buku" required type="text" class="form-control"
                                        placeholder="Input Judul Buku" value="">
                                </div>
                                <div class="form-group ">
                                    <label for="exampleFormControlInput1">Penulis</label>
                                    <input name="penulis" id="penulis" required type="text" class="form-control"
                                        placeholder="Input Penulis" value="">
                                </div>
                                <div class="form-group">
                                    <label for="penerbit_id">Penerbit</label>
                                    <select name="penerbit_id" id="penerbit_id" required class="form-control" required>
                                        <option value="">-Pilih-</option>
                                        @foreach ($penerbit as $pen)
                                            <option value="{{ $pen->id }}">{{ $pen->nama_penerbit }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label for="exampleFormControlInput1">File</label>
                                    <input name="file" id="file" required type="file" class="form-control"
                                        placeholder="Input File" value="">
                                </div>
                                <div class="form-group ">
                                    <label for="gambae">Gambar</label>
                                    <input name="gambar" id="gambar" required type="file" class="form-control"
                                        placeholder="Input Gambar" value="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="klasifikasi_id">Klasifikasi</label>
                                    <select name="klasifikasi_id" id="klasifikasi_id" required class="form-control"
                                        required>
                                        <option value="">-Pilih-</option>
                                        @foreach ($klasifikasi as $klaf)
                                            <option value="{{ $klaf->id }}">{{ $klaf->nama_klasifikasi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <select name="kelas" id="kelas" required class="form-control" required>
                                        <option value="">-Pilih-</option>
                                        @foreach ($kelas as $kelas)
                                            <option value="{{ $kelas }}">{{ $kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label for="exampleFormControlInput1">Tahun Terbit</label>
                                    <input name="tahun_terbit" id="tahun_terbit" required type="text" class="form-control"
                                        placeholder="Input Tahun Terbit" value="">
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
@endsection
@section('scripts')


    <script type="text/javascript">
        $(document).ready(function() {
            $('#table_ebook').DataTable({
                processing: true,

                serverSide: true,
                ajax: {
                    url: "{{ route('e-book.ajax') }}",
                    type: "GET"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    }, {
                        data: 'gambar',
                        name: 'gambar'
                    },
                    {
                        data: 'judul_buku',
                        name: 'judul_buku',
                    }, {
                        data: 'kelas',
                        name: 'kelas'
                    }, {
                        data: 'penulis',
                        name: 'penulis'
                    }, {
                        data: 'penerbit',
                        name: 'penerbit'
                    }, {
                        data: 'klasifikasi',
                        name: 'klasifikasi'
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

            // Tombol Tambah
            $('#tombol-tambah').click(function() {
                $('#tombol-simpan').val('create-post');
                $('#id').val('');
                $('#form-tambah-edit').trigger('reset');
                $('#modal-judul').html('Tambah Data E-Book');
                $('#modal-tambah-edit').modal('show')
            });

            //Tombol Edit
            $('body').on('click', '.edit-post', function() {
                var data_id = $(this).data('id');
                $.get('e-book/' + data_id + '/edit', function(data) {
                    $('#modal-judul').html('Edit Data buku');

                    $('#tombol-simpan').html('Rubah');
                    $('#modal-tambah-edit').modal('show');

                    $('#id').val(data.id);
                    $('#judul_buku').val(data.judul_buku);
                    $('#penulis').val(data.penulis);
                    $('#penerbit_id').val(data.penerbit_id);
                    $('#klasifikasi_id').val(data.klasifikasi_id);
                    $('#kelas').val(data.kelas);
                    $('#tahun_terbit').val(data.tahun_terbit);
                    $('#file').val(data.file);

                })
            });

            //Simpan dan Edit STore
            $('body').on('submit', '#form-tambah-edit', function(e) {
                e.preventDefault();
                var actionType = $('#tombol-simpan').val();
                $('#tombol-simpan').html('Menyimpan..');
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('e-book.store') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        $('#form-tambah-edit').trigger("reset");
                        $('#modal-tambah-edit').modal('hide');
                        $('#tombol-simpan').html('Save Changes');
                        var oTable = $('#table_ebook').dataTable();
                        oTable.fnDraw(false);
                        toastr.success('Data Berhasil Disimpan');
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#tombol-simpan').html('Save Changes');
                    }
                });
            });

            //Tombol Hapus
            $(document).on('click', '.delete', function() {
                dataid = $(this).attr('id');
                $('#konfirmasi-modal').modal('show');
            });

            //Delete
            $('#tombol-hapus').click(function() {
                $.ajax({
                    url: "e-book/" + dataid,
                    type: 'delete',
                    beforeSend: function() {
                        $('#tombol-hapus').text('Menghapus...');
                    },
                    success: function(data) {
                        setTimeout(function() {
                            $('#konfirmasi-modal').modal('hide');
                            var oTable = $('#table_ebook').dataTable();
                            oTable.fnDraw(false);
                        });
                        toastr.success('Data Berhasil Dihapus');
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
