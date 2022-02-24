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
                    <th>Jenis Kelamin</th>
                    <th>Level</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>No Hp</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $e => $item)
                    <tr>
                        <td>{{ $e + 1 }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->jk }}</td>
                        <td>{{ $item->level->level }}</td>
                        <td>{{ $item->tempat_lahir }}</td>
                        <td>{{ $item->tgl_lahir }}</td>
                        <td>{{ $item->no_hp }}</td>
                        <th>{{ $item->alamat }}</th>

                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- End Tabel -->
    </div>
@endsection
