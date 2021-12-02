@extends('admin.laporan.master')
@section('konten')

    <h5 class="center"><u> Kwitansi Denda</u></h5>
    <table id="pseudo-demo">
        <thead>
            <tr>
                <td>Kode Pinjam</td>
                <td>Nama</td>
                <td>Buku</td>
                <td>Tanggal Pinjam</td>
                <td>Tanggal Kembali</td>
                <td>Status Peminjaman</td>
                <td>Denda</td>
                <td>Status</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $data->kode_transaksi }}</td>
                <td>{{ $data->anggota->nama }}</td>
                <td>{{ $data->buku->judul }}</td>
                <td> {{ date('d/m/y', strtotime($data->tgl_pinjam)) }}</td>
                <td> {{ date('d/m/y', strtotime($data->tgl_kembali)) }}</td>
                <td>{{ $data->status }}</td>
                <td><span class="badge badge-danger">Rp. {{ number_format($data->denda, 0) }}</span></td>
                @if ($data->status_denda == 1)
                    <td> <span class="label label-danger">Belum Lunas</span></td>
                @else($data->status_denda==2)
                    <td> <span class="label label-primary">Lunas</span></td>
                @endif
            </tr>
        </tbody>
    </table>

@endsection
