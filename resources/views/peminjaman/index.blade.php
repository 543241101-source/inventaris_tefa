@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark">Sirkulasi Peminjaman Alat Lab</h2>
        <p class="text-muted mb-0">Petugas Admin maupun User dapat melakukan pencatatan, pembaruan status, dan pembatalan transaksi di halaman ini.</p>
    </div>
    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary fw-semibold">+ Catat Peminjaman Baru</a>
</div>
<div class="mb-3 d-flex gap-2">
    <a href="{{ route('peminjaman.excel') }}" class="btn btn-success btn-sm fw-bold">
        📊 Unduh Laporan Excel (.xlsx)
    </a>
    <a href="{{ route('peminjaman.pdf') }}" class="btn btn-danger btn-sm fw-bold" target="_blank">
        📄 Cetak Berkas PDF (.pdf)
    </a>
</div>
<div class="card border-0 shadow-sm p-3 bg-white">
    <div class="table-responsive">
        <table class="table table-striped align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Nama Siswa</th>
                    <th>Barang Dipinjam</th>
                    <th>Jumlah</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                    <th class="text-center" style="width: 180px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjamans as $p)
                <tr>
                    <td class="fw-bold">{{ $p->peminjam->nama_peminjam }} <br><small class="text-muted">{{ $p->peminjam->kelas }}</small></td>
                    <td>{{ $p->barang->nama_barang }}</td>
                    <td><span class="badge bg-secondary">{{ $p->jumlah_pinjam }} unit</span></td>
                    <td>{{ $p->tanggal_pinjam }}</td>
                    <td>{{ $p->tanggal_kembali ?? '-' }}</td>
                    <td>
                        @if($p->status_peminjaman == 'Dipinjam')
                            <span class="badge bg-warning text-dark">Dipinjam</span>
                        @else
                            <span class="badge bg-success">Dikembalikan</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <form onsubmit="return confirm('Apakah Anda yakin ingin menghapus data transaksi ini?');" action="{{ route('peminjaman.destroy', $p->id) }}" method="POST">
                            <a href="{{ route('peminjaman.edit', $p->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">Belum ada riwayat transaksi peminjaman.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
