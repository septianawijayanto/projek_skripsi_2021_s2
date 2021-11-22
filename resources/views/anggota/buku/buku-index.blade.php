@extends('anggota.layouts.master')
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
                <table class="table table-responsiv" id="table_buku">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Kode buku</th>
                            <th>Nama buku</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Klasifikasi</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>

                </table>
                <!-- End Tabel -->
            </div>
        </div>
    </div>
@endsection
@section('scripts')


    <script type="text/javascript">
        $(document).ready(function() {
            $('#table_buku').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('buku.index') }}",
                    type: "GET"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    }, {
                        data: 'gambar',
                        name: 'gambar'
                    }, {
                        data: 'kode',
                        name: 'kode',
                    },
                    {
                        data: 'judul_buku',
                        name: 'judul_buku',
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
                        data: 'jumlah',
                        name: 'jumlah'
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
            })

        });
    </script>


@endsection
