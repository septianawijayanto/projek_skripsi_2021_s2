@extends('admin.layouts.master')
@section('konten')
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title" id="judul">{{ $title }}</h3>

        </div>
        <div class="panel-body">
            <button type="button" class="btn btn-warning btn-xs btn-refresh"><i class="fa fa-refresh"></i></button>
            <button id="tombol-tambah" type="button" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></button>
        </div>
        <div class="panel-body">
            <form id="form-tambah-edit" enctype="multipart/form-data">
                <div class="form-group ">
                    <input name="id" id="id" required type="hidden" class="form-control" value="">
                </div>
                <div class="row">
                    <div class="col-lg-5">
                        <div class="form-group ">
                            <label for="nama_sekolah">Nama Sekolah</label>
                            <input name="nama_sekolah" id="nama_sekolah" required type="text" class="form-control"
                                placeholder="Input Nama Sekolah" value="">
                        </div>
                        <div class="form-group ">
                            <label for="alamat">Alamat</label>
                            <input name="alamat" id="alamat" required type="text" class="form-control"
                                placeholder="Input Alamat" value="">
                        </div>
                        <div class="form-group ">
                            <label for="kode_pos">Kode Post</label>
                            <input name="kode_pos" id="kode_pos" class="form-control" placeholder="Input Kode Post">
                        </div>
                        <div class="form-group ">
                            <label for="desa">Desa/Kelurahan</label>
                            <input name="desa" id="desa" class="form-control" placeholder="Input Desa/Kelurahan">
                        </div>
                        <div class="form-group ">
                            <label for="kecamatan">Kecamatan</label>
                            <input name="kecamatan" id="kecamatan" required type="text" class="form-control"
                                placeholder="Input Kecamatan" value="">
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="form-group ">
                            <label for="kabupaten">Kabupaten</label>
                            <input name="kabupaten" id="kabupaten" required type="text" class="form-control"
                                placeholder="Input Kabupaten" value="">
                        </div>
                        <div class="form-group ">
                            <label for="provinsi">Provinsi</label>
                            <input name="provinsi" id="provinsi" required type="text" class="form-control"
                                placeholder="Input Provinsi" value="">
                        </div>
                        <div class="form-group ">
                            <label for="email">Email</label>
                            <input name="email" id="email" required type="text" class="form-control"
                                placeholder="Input Email" value="">
                        </div>
                        <div class="form-group ">
                            <label for="website">Website</label>
                            <input name="website" id="website" required type="text" class="form-control"
                                placeholder="Input Website" value="">
                        </div>
                        <div class="form-group ">
                            <label for="no_telp">No Telepon</label>
                            <input name="no_telp" id="no_telp" required type="text" class="form-control"
                                placeholder="Input No Telepon" value="">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group ">
                            <label for="logo_sekolah">Logo Sekolah</label>
                            <input name="logo_sekolah" id="logo_sekolah" required type="file" class="form-control"
                                placeholder="Input Logo Sekolah" value="">
                        </div>
                        <div class="form-group ">
                            <label for="logo_kab">Kabupaten/Provinsi</label>
                            <input name="logo_kab" id="logo_kab" required type="file" class="form-control"
                                placeholder="Input Logo Kabupaten/Provinsi" value="">
                        </div>
                        <div class="form-group ">
                            <label for="logo">Logo SI</label>
                            <input name="logo" id="logo" required type="file" class="form-control"
                                placeholder="Input Logo SI" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="tombol-simpan" value="create" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')


    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X_CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //Simpan 
            $('body').on('submit', '#form-tambah-edit', function(e) {
                e.preventDefault();
                var actionType = $('#tombol-simpan').val();
                $('#tombol-simpan').html('Menyimpan..');
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('sekolah.store') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        $('#form-tambah-edit').trigger("reset");
                        $('#tombol-simpan').html('Save Changes');
                        toastr.success('Data Berhasil Disimpan');
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#btn-save').html('Save Changes');
                    }
                });
            });

            $('body').on('click', '.tombol-simpan', function() {
                var data_id = $(this).data('id');
                $.get('sekolah/' + data_id + '/edit', function(data) {
                    $('#judul').html('Edit Sekolah');
                    // $('#tombol-simpan').val('edit-post');
                    $('#tombol-simpan').html(' Rubah');
                    // $('#modal-tambah-edit').modal('show');

                    $('#id').val(data.id);
                    $('#nama_sekolah').val(data.nama_sekolah);
                    $('#alamat').val(data.alamat);
                    $('#no_telp').val(data.no_telp);
                    $('#alamat').val(data.alamat)
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
