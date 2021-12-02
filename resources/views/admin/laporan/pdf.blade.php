@extends('admin.laporan.master')
@section('konten')

    <h2 class="center">Laporan</h2>
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
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $e => $item)
                    <tr>
                        <td>{{ $e + 1 }}
                        </td>
                        <td>{{ $item->kode_transaksi }}</td>
                        <td>{{ $item->anggota->nama }}</td>
                        <td>{{ $item->buku->judul_buku }}</td>
                        <td>{{ $item->tgl_pinjam }}</td>
                        <td>{{ $item->tgl_kembali }}</td>
                        <td>{{ $item->denda }}</td>
                        <td>{{ $item->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- End Tabel -->
    </div>
@endsection
