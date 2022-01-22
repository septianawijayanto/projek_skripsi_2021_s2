@extends('admin.laporan.master')
@section('konten')


<h5 class="center"><u> LAPORAN DATA TRANSAKSI {{ $dari}} SAMPAI {{$sampai}}</u></h5>

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
                        <td>Rp. {{ number_format($item->denda, 0) }}</td>
                        <td>{{ $item->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- End Tabel -->
    </div>
@endsection
