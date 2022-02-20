@extends('admin.laporan.master')
@section('konten')
    <h2 class="center"><u> LAPORAN DATA ANGGOTA</u></h2>
    <div class="table-responsive">
        <!-- Tabel -->
        <table class="table table-responsiv" id="table_anggota">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Level</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Agama</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($data as $e => $item)
                    <tr>
                        <td>{{ $e + 1 }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->level->level }}</td>
                        <td>{{ $item->tgl_lahir }}</td>
                        <th>{{ $item->alamat }}</th>
                        <td>{{ $item->agama }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- End Tabel -->
    </div>
@endsection
