@extends('admin.laporan.master')
@section('konten')
    <h2 class="center"><u> LAPORAN DATA BUKU</u></h2>
    <div class="table-responsive">
        <!-- Tabel -->
        <table class="table table-responsiv" id="table_buku">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Buku</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Kelas</th>
                    <th>Tahun Terbit</th>
                    <th>Tahun Pengadaan</th>
                    <th>Penerbit</th>
                    <th>Klasifikasi</th>
                    <th>Jumlah</th>
                    <th>Jumlah Dipinjam</th>
                    <th>Rusak</th>
                    <th>Hilang</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $e => $item)
                    <tr>
                        <td>{{ $e + 1 }}</td>
                        <td>{{ $item->kode }}</td>
                        <td>{{ $item->judul_buku }}</td>
                        <td>{{ $item->penulis }}</td>
                        <td>{{ $item->kelas }}</td>
                        <td>{{ $item->tahun_terbit }}</td>
                        <td>{{ $item->tahun_pengadaan }}</td>
                        <td>{{ $item->penerbit->nama_penerbit }}</td>
                        <td>{{ $item->klasifikasi->nama_klasifikasi }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ $item->jml_dipinjam }}</td>
                        <td>{{ $item->rusak }}</td>
                        <td>{{ $item->hilang }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- End Tabel -->
    </div>
@endsection
