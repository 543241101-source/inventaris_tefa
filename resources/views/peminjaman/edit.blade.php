@extends('layouts.app')

@section('content')
<div class="card border-0 shadow-sm p-4 bg-white" style="max-width: 500px;">
    <h4 class="fw-bold mb-3 text-dark">Proses Pengembalian Barang</h4>
    <p class="text-muted small">Mengubah status menjadi <strong>Dikembalikan</strong> akan memicu penambahan stok otomatis sebanyak <strong>{{ $peminjaman->jumlah_pinjam }} unit</strong> ke database.</p>
    <hr>

    <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <span class="text-muted d-block small">Peminjam:</span>
            <span class="fw-bold fs-5 text-secondary">{{ $peminjaman->peminjam->nama_peminjam }}</span>
        </div>
        <div class="mb-4">
            <span class="text-muted d-block small">Barang & Jumlah:</span>
            <span class="fw-bold text-success">{{ $peminjaman->barang->nama_barang }} ({{ $peminjaman->jumlah_pinjam }} pcs)</span>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold text-danger">Ubah Status Transaksi</label>
            <select name="status_peminjaman" class="form-select border-danger" required>
                <option value="Dipinjam" {{ $peminjaman->status_peminjaman == 'Dipinjam' ? 'selected' : '' }}>Dipinjam (Belum Kembali)</option>
                <option value="Dikembalikan" {{ $peminjaman->status_peminjaman == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan (Stok Masuk)</option>
            </select>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-danger w-100 fw-bold">Update & Selesai</button>
            <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
