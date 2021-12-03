@extends('admin.laporan.master')
@section('konten')

    @if (request('status') == 'kembali')
        <h2 class="center"><u> LAPORAN DATA TRANSAKSI KEMBALI</u></h2>
    @elseif(request('status') == 'pinjam')
        <h2 class="center"><u> LAPORAN DATA TRANSAKSI DIPINJAM</u></h2>
    @elseif(request('status') == 'rusak')
        <h2 class="center"><u> LAPORAN DATA TRANSAKSI RUSAK</u></h2>
    @elseif(request('status') == 'hilang')
        <h2 class="center"><u> LAPORAN DATA TRANSAKSI HILANG</u></h2>
    @elseif(request('status') == 'tolak')
        <h2 class="center"><u> LAPORAN DATA TRANSAKSI DITOLAK</u></h2>
    @else
        <h2 class="center"><u> LAPORAN DATA TRANSAKSI</u></h2>
    @endif

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
